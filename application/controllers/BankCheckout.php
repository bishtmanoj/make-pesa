<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include("./vendor/autoload.php");
class BankCheckout extends CI_Controller {


	 public function __construct() {

		parent::__construct();

		$this->load->model('core_model');
		$this->load->model('myaccount_model');
		$this->load->model('checkout_model');
		
		// Get core Site settings
		$this->site_settings = $this->core_model->get_bk_core_settings();
		
		// Get core User
		$this->user = $this->core_model->get_bk_core_user();
		$this->load->library('form_validation');
		
		// Get theme path
		$this->themename = $this->core_model->get_core_bk_theme_name();
		
		// Language file
		$this->lang->load(array('myaccount', 'signin', 'checkout'));
		
		$stripe = array(
			"secret_key" => $this->site_settings->stripe_secret_key,
			"public_key" => $this->site_settings->stripe_key
		);
		\Stripe\Stripe::setApiKey($stripe["secret_key"]);
	 }
	
	public function index() {
		
		if ($this->input->post('type', TRUE) == 'buy') {
		$this->form_validation->set_rules('item_name', 'Item name', 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('item_number', 'Item number', 'required|trim|numeric');
		$this->form_validation->set_rules('amount', 'Amount', 'required|trim|numeric');
		$this->form_validation->set_rules('currency_code', 'Currency code', 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('business', 'Merchant Email or ID', 'required|trim|htmlspecialchars');
		 if ($this->form_validation->run() == FALSE)
                {
		echo validation_errors();
                }else {
				
		
	$merchant_check = $this->core_model->core_get_merchant_with_email_or_id($this->input->post('business', TRUE));		
    if ($merchant_check['email']) {
	$this->session->item_name = $this->input->post('item_name', TRUE);
	$this->session->item_number = $this->input->post('item_number', TRUE);
	$this->session->amount = $this->input->post('amount', TRUE);
	$this->session->curr = $this->input->post('currency_code', TRUE);
	$this->session->business = $merchant_check['email'];
	$this->session->type = $this->input->post('type', TRUE);
	$this->session->shipping = $this->input->post('shipping', TRUE);
	$this->session->return_url = $this->input->post('return', TRUE);
	$this->session->cancel_url = $this->input->post('cancel_return', TRUE);
	
	redirect('checkout/signin');
	}else {
	echo 'Sorry your Merchant email or ID is not correct';
	}	
	}
		}else {
			echo 'Check your checkout Post type';
		}
	}
	
	
	
	/* Processing Checkout payment
	***/
	public function pay() {
		
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount');
		}
		
		if ($this->session->business) {
		$this->form_validation->set_rules('amount', 'Amount', 'numeric');
		if ($this->form_validation->run() == FALSE) {
		$data['user'] = $this->core_model->core_get_user_with_email($this->session->business);
        $data['list_card'] = $this->core_model->core_get_active_card();
		$data['title'] = $this->lang->line('checkout_pay_meta_title');
		$this->load->view($this->themename.'/layout/globe/checkout/header_meta', $data);
		$this->load->view($this->themename.'/layout/checkout/pay/home', $data);
		$this->load->view($this->themename.'/layout/globe/footer_end');
        
		}else {
			// Payment processing
			if ($this->input->post('pay_with', TRUE) == 'balance') {
				$fees = $this->session->amount*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
				$amount = $this->session->amount + $fees;
				// Send payment with payment method_exists
				if ($amount > $this->helper->transaction_balance()) {

				// Error no Balance
		$this->session->set_flashdata('checkout_pay_no_balance', TRUE);
		redirect('checkout/pay');
		}else {
			// Post data
				// Shipping item
				if ($this->session->shipping == '1') {
					
					$shipping = $this->checkout_model->checkout_paid_item_shipping();
				}else {
					$shipping = $this->checkout_model->checkout_paid_item();
				}
				
				if (!$shipping) {

			        $this->session->set_flashdata('checkout_pay_balance_failed', TRUE);
					redirect('checkout/pay');
		} else {

				// Email to Payer email
			if ($this->site_settings->email_notification) {
			
			$data['user'] = $this->core_model->core_get_user_with_email($this->session->business);
			$data['amount'] = $this->session->amount;
			$user_check = $this->core_model->core_get_user_with_email($this->session->business);
			$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
			$this->email->to($this->session->email);
			$this->email->subject(''.$this->lang->line('Payment_made_subject').' '.$this->site_settings->site_name.'');
			$this->email->message($this->load->view($this->themename.'/layout/email/payment-sent', $data, TRUE));

			$this->email->send();
			
			}
			
			// SMS Notification
			if ($this->site_settings->sms_notification) {
			$get_user_info = $this->core_model->core_get_user_with_email($this->session->business);
			
			//Infobip
			if ($this->site_settings->sms_infobip) {
			$to_number = $get_user_info->mobile;
			$sms_body = $this->lang->line('payment_sent_sms_subject_hello')
			.' '.$get_user_info->full_name.'! '.$this->lang->line('payment_sent_sms_subject_received').' 
			'.$this->site_settings->site_name.'
			'.$this->lang->line('payment_sent_sms_subject_from').'
			'.$get_user_info->full_name.'('.$get_user_info->email.') '.$this->session->curr.''.$this->input->post('amount', TRUE).'';
			$this->helper->infobip_sms($to_number, $sms_body);
			}//End infobip
			
			// Twilio
			if ($this->site_settings->sms_twilio) {
			$sid = $this->site_settings->twilio_sid; // Your Account SID from www.twilio.com/console
			$token = $this->site_settings->twilio_token; // Your Auth Token from www.twilio.com/console

			$client = new Twilio\Rest\Client($sid, $token);
			$message = $client->messages->create(
			$get_user_info->mobile, // Text this number
			array(
			'from' => $this->site_settings->twilio_number, // From a valid Twilio number
			'body' => $this->lang->line('payment_sent_sms_subject_hello')
			.' '.$get_user_info->full_name.'! '.$this->lang->line('payment_sent_sms_subject_received').' 
			'.$this->site_settings->site_name.'
			'.$this->lang->line('payment_sent_sms_subject_from').'
			'.$get_user_info->full_name.'('.$get_user_info->email.') '.$this->session->curr.''.$this->input->post('amount', TRUE).''
			)
			);
			}// End twilio
			}
		$this->session->done ='complete';
		$this->helper->checkout_remove_business_session();
		redirect('checkout/complete');

				}//insert data
		}//amount
			}else {
				// Pay with card
				// Mastercard
		if ($this->site_settings->mgs_accept) {
		
				
				// End Mastercard
				}else {
			// Other payment
			if ($this->site_settings->stripe_accept) {
				// Stripe proccessing
	try{
		$cardget = $this->checkout_model->checkout_pay_get_card($this->input->post(NULL, TRUE));		
		$fees = $this->session->amount*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
		$amount = $this->session->amount - $fees;
		$amountplusfees = $this->session->amount + $fees;
		$pay_amount = number_format((float)$amountplusfees*100., 0, '.', '');
		
		$card_charge_amount = number_format((float)$amountplusfees*100., 0, '.', '');
			$token = \Stripe\Token::create(array(
			"card" => array(
			'name' => $cardget->name,
			"number" => $cardget->number,
			"exp_month" => $cardget->month,
			"exp_year" => $cardget->exp_year,
			"cvc" => $cardget->cvc
			)
			));
			$charge = \Stripe\Charge::create(array('source'=>$token,
						'amount'=>$pay_amount,
						'description' => ''.$this->site_settings->site_name.' Product paid by - '.$this->session->email.'',
		
				'currency'=>$this->session->curr));
								
		
	if ($this->session->shipping == '1') {
		$shipping = '1';
		}else {
		$shipping = '';	
		}
		
		$senderget = $this->core_model->core_get_user_with_email($this->session->email);
		$receiverget = $this->core_model->core_get_user_with_email($this->session->business);
		// Get receive name
		if ($receiverget->business_name) {
			$receiver_name = $receiverget->business_name;
		}else {
			$receiver_name =  $receiverget->full_name;
		}
		
		// Get sender name
		if ($senderget->business_name) {
			$sender_name = $senderget->business_name;
		}else {
			$sender_name =  $senderget->full_name;
		}
		
			
		$storedata = array(
		
		'sender' => $this->session->id,
		'sender_name' => $sender_name,
		'sender_email' => $senderget->email,
		'receiver' => $receiverget->email,
		'receiver_name' => $receiver_name,
		'receiver_email' => $receiverget->email,
		'receiver_mobile' => $receiverget->mobile,
		'fees' => number_format($fees, 2, '.', ''),
		'status' => 'Processed',
		'payment_type' => 'sent',
		'payment_method' => 'Card',
		'protection' => '1',
		'dispute' => '0',
		'shipping' => $shipping,
		'item_name' => $this->session->item_name,
		'item_number' => $this->session->item_number,
		'currency_code' => $this->session->curr,
		'address1' => $this->user->address1,
		'address2' => $this->user->city,
		'address3' => $this->user->country,
		'address4' => $this->user->postal_code,
		'userid' => $this->session->id,
		'txn_id' => $charge->id,
		'total' => number_format($this->session->amount, 2, '.', ''),
		'amount' => $amount,
		'date' => time()
			);
			
        $complete = $this->core_model->card_send_money($storedata);
            if ($complete) {
				
		// Email to Payer email
			if ($this->site_settings->email_notification) {
			
			$data['user'] = $this->core_model->core_get_user_with_email($this->session->business);
			$data['amount'] = $this->session->amount;
			$user_check = $this->core_model->core_get_user_with_email($this->session->business);
			$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
			$this->email->to($this->session->email);
			$this->email->subject(''.$this->lang->line('Payment_made_subject').' '.$this->site_settings->site_name.'');
			$this->email->message($this->load->view($this->themename.'/layout/email/payment-sent', $data, TRUE));

			$this->email->send();
			
			}
		
		// SMS Notification
			if ($this->site_settings->sms_notification) {
			$get_user_info = $this->core_model->core_get_user_with_email($this->session->business);
			
			//Infobip
			if ($this->site_settings->sms_infobip) {
			$to_number = $get_user_info->mobile;
			$sms_body = $this->lang->line('payment_sent_sms_subject_hello')
			.' '.$get_user_info->full_name.'! '.$this->lang->line('payment_sent_sms_subject_received').' 
			'.$this->site_settings->site_name.'
			'.$this->lang->line('payment_sent_sms_subject_from').'
			'.$get_user_info->full_name.'('.$get_user_info->email.') '.$this->session->curr.''.$this->input->post('amount', TRUE).'';
			$this->helper->infobip_sms($to_number, $sms_body);
			}//End infobip
			
			// Twilio
			if ($this->site_settings->sms_twilio) {
			$sid = $this->site_settings->twilio_sid; // Your Account SID from www.twilio.com/console
			$token = $this->site_settings->twilio_token; // Your Auth Token from www.twilio.com/console

			$client = new Twilio\Rest\Client($sid, $token);
			$message = $client->messages->create(
			$get_user_info->mobile, // Text this number
			array(
			'from' => $this->site_settings->twilio_number, // From a valid Twilio number
			'body' => $this->lang->line('payment_sent_sms_subject_hello')
			.' '.$get_user_info->full_name.'! '.$this->lang->line('payment_sent_sms_subject_received').' 
			'.$this->site_settings->site_name.'
			'.$this->lang->line('payment_sent_sms_subject_from').'
			'.$get_user_info->full_name.'('.$get_user_info->email.') '.$this->session->curr.''.$this->input->post('amount', TRUE).''
			)
			);
			}// End twilio
		}
			$this->session->done ='complete';
			$this->helper->checkout_remove_business_session();
			redirect('checkout/complete');
            } else {
			$this->session->set_flashdata('payment_send_card_failed', TRUE);
			redirect('myaccount/');
            }		
		}catch (Exception $e){
			$this->session->set_flashdata('payment_card_status', $e->getMessage());
			redirect('checkout/pay');
		} 
	// End Stripe 
			}else {
			$this->session->set_flashdata('payment_card_status', $this->lang->line('checkout_with_card_not_available'));
			redirect('checkout/pay');
			}
			
			//End Other payment
				}
			}
		}
			
		}
	}
	
	/* Complete payment
	***/
	public function complete() {
		
		if ($this->session->type == 'buy') {
			if ($this->session->done == 'complete') {
		$data['title'] = $this->lang->line('checkout_complete_meta_title');
		$this->load->view($this->themename.'/layout/globe/checkout/header_meta', $data);
		$this->load->view($this->themename.'/layout/checkout/complete/home', $data);
		$this->load->view($this->themename.'/layout/globe/footer_end');
		
		if ($this->session->return_url) {
		$return_url = ''.$this->session->return_url.'?amount='.$this->session->amount.'&currency_code='.$this->session->curr.'&payer='.$this->session->email.'&item_name='.$this->session->item_name.'&item_number='.$this->session->item_number.'&TXD='.$this->session->transaction_id.'';
		}else {
		$return_url = site_url();
		}
		
		$this->output->set_header('refresh:5; url='.$return_url);
		//$this->helper->logout();
			}else {
			redirect('checkout/pay');	
			}
		}else {
			redirect('checkout/pay');
		}
	}
	
	/* Succes guest payment
	***/
	public function success() {
		
		$data['title'] = $this->lang->line('checkout_success_meta_title');
		$this->load->view($this->themename.'/layout/globe/checkout/header_meta', $data);
		$this->load->view($this->themename.'/layout/checkout/success-guest/home', $data);
		$this->load->view($this->themename.'/layout/globe/footer_end');
		$return_url = site_url();
		$this->output->set_header('refresh:10; url='.$return_url);
			
	}
	
	/* Failed payment
	***/
	public function failed() {
		
		$data['title'] = $this->lang->line('checkout_failed_meta_title');
		$this->load->view($this->themename.'/layout/globe/checkout/header_meta', $data);
		$this->load->view($this->themename.'/layout/checkout/failed-guest/home', $data);
		$this->load->view($this->themename.'/layout/globe/footer_end');
		
		if ($this->session->cancel_url) {
			if ($this->session->cancel_url == site_url('checkout/failed')) {
			$return_url = site_url();
			}else {
				
			$return_url = $this->session->cancel_url;
			}	
		}else {
		$return_url = site_url();
		}
		
		$this->output->set_header('refresh:10; url='.$return_url);
		//$this->helper->logout();
			
	}
	
	/* Card for Guest payment
	***/
	public function card() {
		if ($this->session->type == 'buy') {
			$this->form_validation->set_rules('cardnumber', $this->lang->line('checkout_card_form_card_number'), 'required|numeric');
			$this->form_validation->set_rules('expirymonth', $this->lang->line('checkout_card_form_card_month'), 'required|numeric');
			$this->form_validation->set_rules('expiryyear', $this->lang->line('checkout_card_form_card_year'), 'required|numeric');
			$this->form_validation->set_rules('cvc', $this->lang->line('checkout_card_form_card_cvc'), 'required|numeric');
			
			$this->form_validation->set_rules('email', 'Email', 'required|htmlspecialchars');
			$this->form_validation->set_rules('first_name', 'First name', 'required|htmlspecialchars');
			$this->form_validation->set_rules('last_name', 'Last name', 'required|htmlspecialchars');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|htmlspecialchars');
			$this->form_validation->set_rules('country', 'Country', 'required|htmlspecialchars');
			$this->form_validation->set_rules('city', 'City', 'required|htmlspecialchars');

			if ($this->form_validation->run() == FALSE) {

		$data['user'] = $this->core_model->core_get_user_with_email($this->session->business);
		$data['title'] = $this->lang->line('checkout_card_meta_title');
		$this->load->view($this->themename.'/layout/globe/checkout/header_meta', $data);
		$this->load->view($this->themename.'/layout/checkout/card/home', $data);
		$this->load->view($this->themename.'/layout/globe/footer_end');

			} else {
		// Mastercard
		if ($this->site_settings->mgs_accept) {
		
				
				// End Mastercard
				}else {
		if ($this->site_settings->stripe_accept) {
			
			// Stripe proccessing
	try{
		$cardget = $this->checkout_model->checkout_pay_get_card($this->input->post(NULL, TRUE));		
		$fees = $this->session->amount*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
		$amount = $this->session->amount - $fees;
		$amountplusfees = $this->session->amount + $fees;
		$pay_amount = number_format((float)$amountplusfees*100., 0, '.', '');
		
		$card_charge_amount = number_format((float)$amountplusfees*100., 0, '.', '');
			$token = \Stripe\Token::create(array(
			"card" => array(
			'name' => ''.$this->input->post('first_name').' '.$this->input->post('last_name').'',
			"number" => $this->input->post('cardnumber'),
			"exp_month" => $this->input->post('expirymonth'),
			"exp_year" => $this->input->post('expiryyear'),
			"cvc" => $this->input->post('cvc')
			)
			));
			$charge = \Stripe\Charge::create(array('source'=>$token,
						'amount'=>$pay_amount,
						'description' => ''.$this->site_settings->site_name.' Product paid by - '.$this->input->post('email').'',
		
				'currency'=>$this->session->curr));
								
		
	$receiverget = $this->core_model->core_get_user_with_email($this->session->business);
		// Get receive name
		if ($receiverget->business_name) {
			$receiver_name = $receiverget->business_name;
		}else {
			$receiver_name =  $receiverget->full_name;
		}
		
		$storedata = array(
		
		'sender_name' => ''.$this->input->post('first_name').' '.$this->input->post('last_name').'',
		'sender_email' => $this->input->post('email'),
		'receiver' => $receiverget->email,
		'receiver_name' => $receiver_name,
		'receiver_email' => $receiverget->email,
		'receiver_mobile' => $receiverget->mobile,
		'fees' => number_format($fees, 2, '.', ''),
		'status' => 'Processed',
		'payment_type' => 'sent',
		'payment_method' => 'Card',
		'item_name' => $this->session->item_name,
		'item_number' => $this->session->item_number,
		'currency_code' => $this->session->curr,
		'userid' => $_SERVER['REMOTE_ADDR'],
		'note' => 'Paid by Guest email '.$this->input->post('email').' you can cantact if you need any other information',
		'txn_id' => 'TXT'.rand(1000, 9999).'TZ'.time().'',
		'total' => number_format($this->session->amount, 2, '.', ''),
		'amount' => $amount,
		'date' => time()
			);
			
            $complete = $this->core_model->card_send_money($storedata);
            if ($complete) {
				
		// Email to Payer email
			if ($this->site_settings->email_notification) {
			
			$data['user'] = $this->core_model->core_get_user_with_email($this->session->business);
			$data['amount'] = $this->session->amount;
			$user_check = $this->core_model->core_get_user_with_email($this->session->business);
			$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
			$this->email->to($this->session->email);
			$this->email->subject(''.$this->lang->line('Payment_made_subject').' '.$this->site_settings->site_name.'');
			$this->email->message($this->load->view($this->themename.'/layout/email/payment-sent', $data, TRUE));

			$this->email->send();
			
			}
			
			// SMS Notification
			if ($this->site_settings->sms_notification) {
			$get_user_info = $this->core_model->core_get_user_with_email($this->session->business);
			
			//Infobip
			if ($this->site_settings->sms_infobip) {
			$to_number = $get_user_info->mobile;
			$sms_body = $this->lang->line('payment_sent_sms_subject_hello')
			.' '.$get_user_info->full_name.'! '.$this->lang->line('payment_sent_sms_subject_received').' 
			'.$this->site_settings->site_name.'
			'.$this->lang->line('payment_sent_sms_subject_from').'
			'.$get_user_info->full_name.'('.$get_user_info->email.') '.$this->session->curr.''.$this->input->post('amount', TRUE).'';
			$this->helper->infobip_sms($to_number, $sms_body);
			}//End infobip
			
			// Twilio
			if ($this->site_settings->sms_twilio) {
			$sid = $this->site_settings->twilio_sid; // Your Account SID from www.twilio.com/console
			$token = $this->site_settings->twilio_token; // Your Auth Token from www.twilio.com/console

			$client = new Twilio\Rest\Client($sid, $token);
			$message = $client->messages->create(
			$get_user_info->mobile, // Text this number
			array(
			'from' => $this->site_settings->twilio_number, // From a valid Twilio number
			'body' => $this->lang->line('payment_sent_sms_subject_hello')
			.' '.$get_user_info->full_name.'! '.$this->lang->line('payment_sent_sms_subject_received').' 
			'.$this->site_settings->site_name.'
			'.$this->lang->line('payment_sent_sms_subject_from').'
			'.$get_user_info->full_name.'('.$get_user_info->email.') '.$this->session->curr.''.$this->input->post('amount', TRUE).''
			)
			);
			}// End twilio
		}
			$this->session->email = $this->input->post('email', TRUE);
			$this->session->done ='complete';
			$this->session->transaction_id = $charge->id;
			$this->helper->checkout_remove_business_session();
			redirect('checkout/complete');
            } else {
			$this->session->set_flashdata('payment_send_card_failed', TRUE);
			redirect('myaccount/');
            }		
		}catch (Exception $e){
			$this->session->set_flashdata('payment_card_status', $e->getMessage());
			redirect('checkout/card');
		} 
	// End Stripe
		}else {
			$this->session->set_flashdata('payment_card_status', $this->lang->line('checkout_with_card_not_available'));
			redirect('checkout/card');
		}
				}
			}
			
		}else {
			redirect('myaccount');
		}
	}
	
	
	
	/* Signin in checkout
	***/
	public function signin() {
		
		if ($this->helper->user_islogin()) {
			redirect('checkout/pay');
		}
		if ($this->session->business) {
		/* Form validate */
		$this->form_validation->set_rules('email_username_mobile', $this->lang->line('signup_personal_form_validate_email'), 'trim|htmlspecialchars|callback_checkout_form_check_validate');
		$this->form_validation->set_rules('password', $this->lang->line('signup_personal_form_validate_email'), 'trim|htmlspecialchars');

		 if ($this->form_validation->run() == FALSE)
                {
		$data['user'] = $this->core_model->core_get_user_with_email($this->session->business);
        $data['title'] = $this->lang->line('checkout_signin_meta_title');
		$this->load->view($this->themename.'/layout/globe/checkout/header_meta', $data);
		$this->load->view($this->themename.'/layout/checkout/signin/home', $data);
		$this->load->view($this->themename.'/layout/globe/footer_end');
                }
                else
                {
					$userlogin = $this->core_model->core_get_user_with_email($this->input->post('email_username_mobile', TRUE));
				if ($userlogin->status == 0) {

			        $this->session->set_flashdata('checkout_signin_delete_failed', TRUE);
					redirect('checkout/signin');
					
				}elseif ($this->session->business == $userlogin->email) {
					
				$this->session->set_flashdata('checkout_signin_yourself_failed', $this->lang->line('checkout_form_validate_signin_yourself'));
				redirect('checkout/signin');	

				} else {
					// User sessions store
					$usersession = $this->core_model->core_get_user_with_email($this->input->post('email_username_mobile', TRUE));
					$this->session->id = $usersession->id;
					$this->session->country = $usersession->country;
					$this->session->email = $usersession->email;
					$this->session->full_name = $usersession->full_name;
					$this->session->mobile = $usersession->mobile;
					$this->session->account_type = $usersession->account_type;
					
						redirect('checkout/pay');


				}

                }

		/* End form */
		
		} else {
			redirect('myaccount');
		}
	}

	/* Signin Form callback validate
	*/
	public function checkout_form_check_validate() {
	if (empty(trim($this->input->post('email_username_mobile', TRUE))) || empty(trim($this->input->post('password', TRUE)))) {
		$this->form_validation->set_message('checkout_form_check_validate', $this->lang->line('checkout_form_validate_empty_value'));
		return FALSE;
	} else {
		// validate value Email, Username and Mobile
		$usercheck = $this->core_model->core_get_user_with_email($this->input->post('email_username_mobile', TRUE));
		if ($usercheck == FALSE) {
		$this->form_validation->set_message('checkout_form_check_validate', $this->lang->line('checkout_form_validate_no_username_email_mobile'));
		return FALSE;
		 // End validate value
		} else {
		$user_check = $this->core_model->core_get_user_with_email($this->input->post('email_username_mobile', TRUE));
		if (!password_verify(trim($this->input->post('password', TRUE)), $user_check->password)) {
		$this->form_validation->set_message('checkout_form_check_validate', $this->lang->line('checkout_form_validate_no_password_pin'));
		return FALSE;
		}

		}
	}
	}
	
	
}
