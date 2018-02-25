<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include("./vendor/autoload.php");
class Fund extends CI_Controller {


	 public function __construct() {

		parent::__construct();

		$this->load->model('core_model');
		$this->load->model('myaccount_model');
		
		// Get core Site settings
		$this->site_settings = $this->core_model->get_bk_core_settings();
		
		// Get core User
		$this->user = $this->core_model->get_bk_core_user();
		$this->load->library('form_validation');
		
		// Get theme path
		$this->themename = $this->core_model->get_core_bk_theme_name();
		
		// Language file
		if ($this->helper->ac_is_personal()) {
		$this->lang->load(array('fund', 'myaccount'));
		}
		if ($this->helper->ac_is_business()) {
			$this->lang->load(array('fund', 'business'));
		}
		
		// Get default card
		$this->default_card = $this->core_model->get_bk_core_get_card_default();
		
		// Stripe setting
		$stripe = array(
			"secret_key" => $this->site_settings->stripe_secret_key,
			"public_key" => $this->site_settings->stripe_key
		);
		\Stripe\Stripe::setApiKey($stripe["secret_key"]);
		
	 }
	 
	public function index()
	{
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		} elseif ($this->site_settings->site_maintanace == 1) {
			redirect('errors/maintanance');
		}
		
		if ($this->user->add_fund == 1) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->myaccount_model->bk_getlistcard();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('fund_meta_title');
		
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/home', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/home', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		}else {
			redirect('errors/account');
		}
	}
	
	public function add($page_type = '')
	{
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		} elseif ($this->site_settings->site_maintanace == 1) {
			redirect('errors/maintanance');
		}
		
		if ($this->user->add_fund == 1) {
		if (empty($page_type)) {
			redirect('fund/');
			
		}else if ($page_type == 'card') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		
		$this->form_validation->set_rules('amount', $this->lang->line('fund_add_card_form_amount_validate'), 'trim|numeric|required');
		$this->form_validation->set_rules('card', 'Select Card', 'trim|numeric|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('fund_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/deposit/card', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/deposit/card', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
		
		if ($this->site_settings->mgs_accept) {
				// Mastercard proccessing
				// End Mastercard
				
				}else {
				// Other Proccessor	
				
	if ($this->site_settings->stripe_accept) {
	// Stripe proccessing
	try{
		$cardget = $this->core_model->get_bk_core_get_local_card();
		$fees = $this->input->post('amount')*$this->site_settings->card_deposit_percentage_fees/100 + $this->site_settings->card_deposit_flat_fees;
		$amount = $this->input->post('amount') - $fees;
		$amountplusfees = $this->input->post('amount') + $fees;
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
						'amount'=>$card_charge_amount,
						'description' => ''.$this->site_settings->site_name.' Deposit by - '.$this->session->email.'',
		
				'currency'=>$this->user->curr_word));
								
		$senderget = $this->core_model->core_get_user_with_email($this->user->email);
		$fees = $this->input->post('amount')*$this->site_settings->card_deposit_percentage_fees/100 + $this->site_settings->card_deposit_flat_fees;
	
	// Get sender name
		if ($senderget->business_name) {
			$sender_name = $senderget->business_name;
		}else {
			$sender_name =  $senderget->full_name;
		}
		
		
		$storedata = array(
		
		'sender' => $this->session->id,
		'sender_name' => $sender_name,
		'sender_email' => $this->session->email,
		'receiver' => ''.$this->helper->card_type_name(''.$cardget->card_type.'').' - '.str_pad(substr($cardget->number, -4), strlen($cardget->number), '*', STR_PAD_LEFT).'',
		'fees' => number_format($fees, 2, '.', ''),
		'status' => 'Processed',
		'payment_type' => 'Deposit',
		'payment_method' => 'Card',
		'userid' => $this->session->id,
		'txn_id' => $charge->id,
		'dispute' => '0',
		'total' => number_format($this->input->post('amount'), 2, '.', ''),
		'amount' => number_format($amount, 2, '.', ''),
		'fees' => number_format($fees, 2, '.', ''),
		'date' => time()
			);
		$complete = $this->core_model->fund_deposit_with_card($storedata);
            if ($complete) {
				
				// Success
				// SMS Notification
		if ($this->site_settings->sms_notification) {
		$get_user_info = $this->core_model->core_get_user_with_email($this->session->email);
		
		//infobip
		if ($this->site_settings->sms_infobip) {
		$to_number = $get_user_info->mobile;
				$sms_body = ''.$this->lang->line('Deposit_sms_subject_hello').' '.$get_user_info->full_name.' '.$this->lang->line('Deposit_sms_subject_have').' '.$this->user->curr_word.' '.$this->input->post('amount', TRUE).' '.$this->lang->line('Deposit_sms_subject_to_wallet_a').''.$this->lang->line('Deposit_sms_subject_with_method').' '.$this->helper->card_type_name(''.$cardget->card_type.'').'-'.substr_replace($cardget->number, str_repeat('X', 5), 4, 5).', '.$this->lang->line('Deposit_sms_subject_link_go').'';
				$this->helper->infobip_sms($to_number, $sms_body);
		}// End infobip
		
		// Twilio
		if ($this->site_settings->sms_twilio) {
		$sid = $this->site_settings->twilio_sid; // Your Account SID from www.twilio.com/console
		$token = $this->site_settings->twilio_token; // Your Auth Token from www.twilio.com/console

		$client = new Twilio\Rest\Client($sid, $token);
		$message = $client->messages->create(
		$get_user_info->mobile, // Text this number
		array(
		'from' => $this->site_settings->twilio_number, // From a valid Twilio number
		'body' => $sms_body = ''.$this->lang->line('Deposit_sms_subject_hello').' '.$get_user_info->full_name.' '.$this->lang->line('Deposit_sms_subject_have').' '.$this->user->curr_word.' '.$this->input->post('amount', TRUE).' '.$this->lang->line('Deposit_sms_subject_to_wallet_a').''.$this->lang->line('Deposit_sms_subject_with_method').' '.$this->helper->card_type_name(''.$cardget->card_type.'').'-'.substr_replace($cardget->number, str_repeat('X', 5), 4, 5).', '.$this->lang->line('Deposit_sms_subject_link_go').''
		)
		);
				}// End twilio
		}
			$this->session->set_flashdata('payment_send_card_success', TRUE);
			redirect('fund/add/card/');
            } else {
			$this->session->set_flashdata('payment_card_status', $this->lang->line('fund_deposit_card_ajax_failed'));
			redirect('fund/add/card/');
            }		
		}catch (Exception $e){
			$this->session->set_flashdata('payment_card_status', $e->getMessage());
			redirect('fund/add/card/');
		} 
	// End Stripe
	}else {
	$this->session->set_flashdata('payment_card_status', $this->lang->line('fund_payment_with_card_not_available'));
	redirect('fund/add/card/');
					
	}
	// End other Proccessor
				
	}
		
		}
	}else if ($page_type == 'bank') {


		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_add_card_form_amount_validate'), 'trim|numeric|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('fund_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/deposit/bank', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/deposit/bank', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			if (!$this->core_model->fund_deposit_with_bank($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_deposit_failed', TRUE);
					redirect('fund/add/bank/');

				} else {

					$this->session->set_flashdata('fund_bank_deposit_success', TRUE);


						redirect('fund/add/bank/');

				}
		}
	}else if ($page_type == 'mpesa') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_add_amount_form_amount_validate'), 'trim|numeric|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('fund_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/deposit/mpesa', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/deposit/mpesa', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			if (!$this->core_model->fund_deposit_with_mpesa($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_deposit_failed', TRUE);
					redirect('fund/add/mpesa/');

				} else {

					$this->session->set_flashdata('fund_mobile_deposit_success', TRUE);


						redirect('fund/add/mpesa/');

				}
		}
		
	}else if ($page_type == 'tigopesa') {
		
				
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_add_amount_form_amount_validate'), 'trim|numeric|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('fund_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/deposit/tigopesa', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/deposit/tigopesa', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			if (!$this->core_model->fund_deposit_with_tigopesa($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_deposit_failed', TRUE);
					redirect('fund/add/tigopesa/');

				} else {

					$this->session->set_flashdata('fund_mobile_deposit_success', TRUE);


						redirect('fund/add/tigopesa/');

				}
		}
		
	
	}else if ($page_type == 'mtn') {
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_add_amount_form_amount_validate'), 'trim|numeric|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('fund_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/deposit/mtn', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/deposit/mtn', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			if (!$this->core_model->fund_deposit_with_mtn($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_deposit_failed', TRUE);
					redirect('fund/add/mtn/');

				} else {

					$this->session->set_flashdata('fund_mobile_deposit_success', TRUE);


						redirect('fund/add/mtn/');

				}
		}
		
	
	}else if ($page_type == 'orange') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_add_amount_form_amount_validate'), 'trim|numeric|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('fund_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/deposit/orange', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/deposit/orange', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			if (!$this->core_model->fund_deposit_with_orange($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_deposit_failed', TRUE);
					redirect('fund/add/orange/');

				} else {

					$this->session->set_flashdata('fund_mobile_deposit_success', TRUE);


						redirect('fund/add/orange/');

				}
		}
		
	
	
	}else if ($page_type == 'bitcoin') {
		
		if ($this->site_settings->user_deposit_fund == 1) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('fund_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/deposit/bitcoin', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/deposit/bitcoin', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		} else {
			redirect('myaccount');
		}
	

	}else if ($page_type == 'paypal') {
		
		if ($this->site_settings->user_deposit_fund == 1) {
		if ($this->site_settings->paypal_url_live == 1) {
			$paypal_url_live = 'https://www.paypal.com/cgi-bin/webscr';
		}else {
			$paypal_url_live = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		}
		
		$data['paypal_url_live'] = $paypal_url_live;
		$data['paypal_url_cancel'] = base_url().'fund/add/paypalcancel';
		$data['paypal_url_return'] = base_url().'fund/add/paypaldone';
		$data['paypal_url_ipn'] = base_url().'ipn/paypal';
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('fund_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/deposit/paypal', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/deposit/paypal', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		} else {
			redirect('myaccount');
		}
		
	}else if ($page_type == 'paypaldone') {
		$this->session->set_flashdata('fund_other_deposit_success', TRUE);
		redirect('fund/add/paypal');
		
	}else if ($page_type == 'paypalcancel') {
		$this->session->set_flashdata('fund_other_deposit_cancel', TRUE);
		redirect('fund/add/paypal');
	
	}else if ($page_type == 'local') {
		
		if ($this->session->otp_code == 1) {
			redirect('fund/add/local_otp');
		}
		
		if ($this->site_settings->user_deposit_fund == 1) {
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['local_bank'] = $this->myaccount_model->bk_nigeria_getlistbank();
		$data['local_card'] = $this->core_model->core_get_local_active_card();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('fund_meta_title');
		
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/deposit/local_card', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/deposit/local_card', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		}
		else {
			redirect('myaccount');
		}
	}else if ($page_type == 'local_otp') {
		
		if ($this->session->otp_code == 1) {
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['local_bank'] = $this->myaccount_model->bk_nigeria_getlistbank();
		$data['local_card'] = $this->core_model->core_get_local_active_card();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('fund_meta_title');
		
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/deposit/tabs/local_otp', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/deposit/tabs/local_otp', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		}
		else {
			redirect('myaccount');
		}
	}else if ($page_type == 'western') {


		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_add_card_form_amount_validate'), 'trim|numeric|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('fund_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/deposit/western', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/deposit/western', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			if (!$this->core_model->fund_deposit_with_western($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_deposit_failed', TRUE);
					redirect('fund/add/western/');

				} else {

					$this->session->set_flashdata('fund_western_deposit_success', TRUE);


						redirect('fund/add/western/');

				}
		}
		
		}else if ($page_type == 'voucher') {


		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		
		$this->form_validation->set_rules('pin', $this->lang->line('fund_deposit_voucher_pin_deposit'), 'trim|numeric|htmlspecialchars|max_length[19]|callback_validate_voucher_pin');
		$this->form_validation->set_rules('amount', $this->lang->line('fund_add_card_form_amount_validate'), 'trim|numeric|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('fund_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/deposit/voucher', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/deposit/voucher', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			
			if (!$this->core_model->fund_deposit_with_voucher($this->input->post(NULL, TRUE))) {

					$this->session->set_flashdata('fund_deposit_failed', TRUE);
					redirect('fund/add/voucher/');

				} else {

					// Update pin balance
					$this->core_model->voucher_report($this->input->post(NULL, TRUE));
					$pincheck = $this->core_model->core_get_voucher_code_pin_session($this->input->post('pin', TRUE));
					$pin_amount = $pincheck['amount'] - $this->input->post('amount', TRUE);
					$this->core_model->deposit_amount_pin_update($this->input->post('pin'), $pin_amount);
					$this->session->set_flashdata('fund_other_deposit_success', TRUE);


						redirect('fund/add/voucher/');

				}
		}
	}// elseif	
	
	}else {
			redirect('errors/account');
		}
	}
	
	
	public function withdraw($page_type = '')
	{
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		} elseif ($this->site_settings->site_maintanace == 1) {
			redirect('errors/maintanance');
		}
		
		if ($this->user->withdraw_fund == 1) {
		if (empty($page_type)) {
			
			if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		
		if ($this->site_settings->user_withdraw_fund == 1) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->myaccount_model->bk_getlistcard();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('withdraw_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/withdraw/home', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/withdraw/home', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		} else {
			redirect('myaccount');
		}
			
			
		}else if ($page_type == 'card') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		
		$this->form_validation->set_rules('amount', $this->lang->line('fund_add_card_form_amount_validate'), 'trim|numeric|required');
		$this->form_validation->set_rules('card', $this->lang->line('fund_withdraw_card_form_select_validate'), 'trim|numeric|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('withdraw_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/withdraw/method/card', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/withdraw/method/card', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			
				$fees = $this->input->post('amount', TRUE)*$this->site_settings->withdraw_bank_percentage_fees/100 + $this->site_settings->withdraw_bank_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
			if ($amount > $this->helper->transaction_balance()) {

				$this->session->set_flashdata('fund_withdraw_balance_zero', TRUE);
					redirect('fund/withdraw/bank/');

				} else {
					
					if (!$this->core_model->fund_withdraw_with_card($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_withdraw_failed', TRUE);
					redirect('fund/withdraw/bank/');

				} else {

					$this->session->set_flashdata('fund_withdraw_success', TRUE);


						redirect('fund/withdraw/bank/');

				}

				}
				
			
		}
	}else if ($page_type == 'bank') {


		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_add_card_form_amount_validate'), 'trim|numeric|required');
		$this->form_validation->set_rules('bank', $this->lang->line('fund_withdraw_bank_form_account_validate'), 'trim|numeric|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('withdraw_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/withdraw/method/bank', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/withdraw/method/bank', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			$fees = $this->input->post('amount', TRUE)*$this->site_settings->withdraw_card_percentage_fees/100 + $this->site_settings->withdraw_card_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
			if ($amount > $this->helper->transaction_balance()) {

				$this->session->set_flashdata('fund_withdraw_balance_zero', TRUE);
					redirect('fund/withdraw/bank/');

				} else {
					
					if (!$this->core_model->fund_withdraw_with_bank($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_withdraw_failed', TRUE);
					redirect('fund/withdraw/bank/');

				} else {

					$this->session->set_flashdata('fund_withdraw_success', TRUE);


						redirect('fund/withdraw/bank/');

				}
				}
		}
	}else if ($page_type == 'mpesa') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_withdraw_amount_form_amount_validate'), 'trim|numeric|required');
		$this->form_validation->set_rules('mobile', $this->lang->line('fund_withdraw_mobile_form_amount__req_validate'), 'trim|numeric|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('withdraw_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/withdraw/method/mpesa', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/withdraw/method/mpesa', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			$fees = $this->input->post('amount', TRUE)*$this->site_settings->withdraw_mpesa_percentage_fees/100 + $this->site_settings->withdraw_mpesa_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
			if ($amount > $this->helper->transaction_balance()) {

				$this->session->set_flashdata('fund_withdraw_balance_zero', TRUE);
					redirect('fund/withdraw/mpesa/');

				} else {
					
					if (!$this->core_model->fund_withdraw_with_mpesa($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_withdraw_failed', TRUE);
					redirect('fund/withdraw/mpesa/');

				} else {

					$this->session->set_flashdata('fund_withdraw_success', TRUE);


						redirect('fund/withdraw/mpesa/');

				}

				}
		}
		
	}else if ($page_type == 'tigopesa') {
		
				
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_withdraw_amount_form_amount_validate'), 'trim|numeric|required');
		$this->form_validation->set_rules('mobile', $this->lang->line('fund_withdraw_mobile_form_amount__req_validate'), 'trim|numeric|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('withdraw_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/withdraw/method/tigopesa', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/withdraw/method/tigopesa', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			$fees = $this->input->post('amount', TRUE)*$this->site_settings->withdraw_tigopesa_percentage_fees/100 + $this->site_settings->withdraw_tigopesa_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
			if ($amount > $this->helper->transaction_balance()) {

				$this->session->set_flashdata('fund_withdraw_balance_zero', TRUE);
					redirect('fund/withdraw/tigopesa/');

				} else {
					
					if (!$this->core_model->fund_withdraw_with_tigopesa($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_withdraw_failed', TRUE);
					redirect('fund/withdraw/tigopesa/');

				} else {

					$this->session->set_flashdata('fund_withdraw_success', TRUE);


						redirect('fund/withdraw/tigopesa/');

				}

				}
		}
		
	
	}else if ($page_type == 'mtn') {
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_withdraw_amount_form_amount_validate'), 'trim|numeric|required');
		$this->form_validation->set_rules('mobile', $this->lang->line('fund_withdraw_mobile_form_amount__req_validate'), 'trim|numeric|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('withdraw_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/withdraw/method/mtn', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/withdraw/method/mtn', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			$fees = $this->input->post('amount', TRUE)*$this->site_settings->withdraw_mtn_percentage_fees/100 + $this->site_settings->withdraw_mtn_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
			if ($amount > $this->helper->transaction_balance()) {

				$this->session->set_flashdata('fund_withdraw_balance_zero', TRUE);
					redirect('fund/withdraw/mtn/');

				} else {
					
					if (!$this->core_model->fund_withdraw_with_mtn($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_withdraw_failed', TRUE);
					redirect('fund/withdraw/mtn/');

				} else {

					$this->session->set_flashdata('fund_withdraw_success', TRUE);


						redirect('fund/withdraw/mtn/');

				}

				}
		}
		
	
	}else if ($page_type == 'orange') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_withdraw_amount_form_amount_validate'), 'trim|numeric|required');
		$this->form_validation->set_rules('mobile', $this->lang->line('fund_withdraw_mobile_form_amount__req_validate'), 'trim|numeric|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('withdraw_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/withdraw/method/orange', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/withdraw/method/orange', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			$fees = $this->input->post('amount', TRUE)*$this->site_settings->withdraw_orange_percentage_fees/100 + $this->site_settings->withdraw_orange_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
			if ($amount > $this->helper->transaction_balance()) {

				$this->session->set_flashdata('fund_withdraw_balance_zero', TRUE);
					redirect('fund/withdraw/orange/');

				} else {
					
					if (!$this->core_model->fund_withdraw_with_orange($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_withdraw_failed', TRUE);
					redirect('fund/withdraw/orange/');

				} else {

					$this->session->set_flashdata('fund_withdraw_success', TRUE);


						redirect('fund/withdraw/orange/');

				}

				}
		}
		
		
	
	}else if ($page_type == 'bitcoin') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_withdraw_amount_form_amount_validate'), 'trim|numeric|required');
		$this->form_validation->set_rules('address', $this->lang->line('fund_withdraw_btc_form_address_validate'), 'trim|htmlspecialchars|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('withdraw_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/withdraw/method/bitcoin', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/withdraw/method/bitcoin', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			$fees = $this->input->post('amount', TRUE)*$this->site_settings->withdraw_bitcoin_percentage_fees/100 + $this->site_settings->withdraw_bitcoin_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
			if ($amount > $this->helper->transaction_balance()) {

				$this->session->set_flashdata('fund_withdraw_balance_zero', TRUE);
					redirect('fund/withdraw/bitcoin/');

				} else {
					
					if (!$this->core_model->fund_withdraw_with_bitcoin($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_withdraw_failed', TRUE);
					redirect('fund/withdraw/bitcoin/');

				} else {

					$this->session->set_flashdata('fund_withdraw_success', TRUE);


						redirect('fund/withdraw/bitcoin/');

				}

				}
		}
		
		
	}else if ($page_type == 'paypal') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_withdraw_amount_form_amount_validate'), 'trim|numeric|required');
		$this->form_validation->set_rules('paypal_email', $this->lang->line('fund_withdraw_paypal_form_email_validate'), 'trim|htmlspecialchars|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('withdraw_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/withdraw/method/paypal', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/withdraw/method/paypal', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			$fees = $this->input->post('amount', TRUE)*$this->site_settings->withdraw_paypal_percentage_fees/100 + $this->site_settings->withdraw_paypal_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
			if ($amount > $this->helper->transaction_balance()) {

				$this->session->set_flashdata('fund_withdraw_balance_zero', TRUE);
					redirect('fund/withdraw/paypal/');

				} else {
					
					if (!$this->core_model->fund_withdraw_with_paypal($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_withdraw_failed', TRUE);
					redirect('fund/withdraw/paypal/');

				} else {

					$this->session->set_flashdata('fund_withdraw_success', TRUE);


						redirect('fund/withdraw/paypal/');

				}

				}
		}
		
		
	}else if ($page_type == 'western') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_withdraw_amount_form_amount_validate'), 'trim|numeric|required');
		$this->form_validation->set_rules('name', $this->lang->line('fund_withdraw_western_form_name_validate'), 'trim|htmlspecialchars|required');
		$this->form_validation->set_rules('city', $this->lang->line('fund_withdraw_western_form_city_validate'), 'trim|htmlspecialchars|required');
		$this->form_validation->set_rules('country', $this->lang->line('fund_withdraw_western_form_country_validate'), 'trim|htmlspecialchars|required');
		$this->form_validation->set_rules('phone', $this->lang->line('fund_withdraw_western_form_name_validate'), 'trim|numeric|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('withdraw_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/withdraw/method/western', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/withdraw/method/western', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			$fees = $this->input->post('amount', TRUE)*$this->site_settings->withdraw_western_percentage_fees/100 + $this->site_settings->withdraw_western_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
			if ($amount > $this->helper->transaction_balance()) {

				$this->session->set_flashdata('fund_withdraw_balance_zero', TRUE);
					redirect('fund/withdraw/western/');

				} else {
					
					if (!$this->core_model->fund_withdraw_with_western($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_withdraw_failed', TRUE);
					redirect('fund/withdraw/western/');

				} else {

					$this->session->set_flashdata('fund_withdraw_success', TRUE);


						redirect('fund/withdraw/western/');

				}

				}
		}
	
	}else if ($page_type == 'moneygram') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_withdraw_amount_form_amount_validate'), 'trim|numeric|required');
		$this->form_validation->set_rules('name', $this->lang->line('fund_withdraw_moneygram_form_name_validate'), 'trim|htmlspecialchars|required');
		$this->form_validation->set_rules('city', $this->lang->line('fund_withdraw_moneygram_form_city_validate'), 'trim|htmlspecialchars|required');
		$this->form_validation->set_rules('country', $this->lang->line('fund_withdraw_moneygram_form_country_validate'), 'trim|htmlspecialchars|required');
		$this->form_validation->set_rules('phone', $this->lang->line('fund_withdraw_moneygram_form_name_validate'), 'trim|numeric|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('withdraw_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/withdraw/method/moneygram', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/withdraw/method/moneygram', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			$fees = $this->input->post('amount', TRUE)*$this->site_settings->withdraw_moneygram_percentage_fees/100 + $this->site_settings->withdraw_moneygram_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
			if ($amount > $this->helper->transaction_balance()) {

				$this->session->set_flashdata('fund_withdraw_balance_zero', TRUE);
					redirect('fund/withdraw/moneygram/');

				} else {
					
					if (!$this->core_model->fund_withdraw_with_moneygram($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_withdraw_failed', TRUE);
					redirect('fund/withdraw/moneygram/');

				} else {

					$this->session->set_flashdata('fund_withdraw_success', TRUE);


						redirect('fund/withdraw/moneygram/');

				}

				}
		}
		
		}else if ($page_type == 'perfectmoney') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_withdraw_amount_form_amount_validate'), 'trim|numeric|required');
		$this->form_validation->set_rules('perfectmoney_address', $this->lang->line('fund_withdraw_perfectmoney_form_address_validate'), 'trim|htmlspecialchars|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('withdraw_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/withdraw/method/perfectmoney', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/withdraw/method/perfectmoney', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			$fees = $this->input->post('amount', TRUE)*$this->site_settings->withdraw_perfectmoney_percentage_fees/100 + $this->site_settings->withdraw_perfectmoney_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
			if ($amount > $this->helper->transaction_balance()) {

				$this->session->set_flashdata('fund_withdraw_balance_zero', TRUE);
					redirect('fund/withdraw/perfectmoney/');

				} else {
					
					if (!$this->core_model->fund_withdraw_with_perfectmoney($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_withdraw_failed', TRUE);
					redirect('fund/withdraw/perfectmoney/');

				} else {

					$this->session->set_flashdata('fund_withdraw_success', TRUE);


						redirect('fund/withdraw/perfectmoney/');

				}

				}
		}
		
		}else if ($page_type == 'neteller') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_withdraw_amount_form_amount_validate'), 'trim|numeric|required');
		$this->form_validation->set_rules('neteller_email', $this->lang->line('fund_withdraw_neteller_form_email_validate'), 'trim|htmlspecialchars|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('withdraw_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/withdraw/method/neteller', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/withdraw/method/neteller', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			$fees = $this->input->post('amount', TRUE)*$this->site_settings->withdraw_neteller_percentage_fees/100 + $this->site_settings->withdraw_neteller_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
			if ($amount > $this->helper->transaction_balance()) {

				$this->session->set_flashdata('fund_withdraw_balance_zero', TRUE);
					redirect('fund/withdraw/neteller/');

				} else {
					
					if (!$this->core_model->fund_withdraw_with_neteller($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_withdraw_failed', TRUE);
					redirect('fund/withdraw/neteller/');

				} else {

					$this->session->set_flashdata('fund_withdraw_success', TRUE);


						redirect('fund/withdraw/neteller/');

				}

				}
		}
		
		}else if ($page_type == 'skrill') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_withdraw_amount_form_amount_validate'), 'trim|numeric|required');
		$this->form_validation->set_rules('skrill_email', $this->lang->line('fund_withdraw_skrill_form_email_validate'), 'trim|htmlspecialchars|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('withdraw_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/withdraw/method/skrill', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/withdraw/method/skrill', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			$fees = $this->input->post('amount', TRUE)*$this->site_settings->withdraw_skrill_percentage_fees/100 + $this->site_settings->withdraw_skrill_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
			if ($amount > $this->helper->transaction_balance()) {

				$this->session->set_flashdata('fund_withdraw_balance_zero', TRUE);
					redirect('fund/withdraw/skrill/');

				} else {
					
					if (!$this->core_model->fund_withdraw_with_skrill($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_withdraw_failed', TRUE);
					redirect('fund/withdraw/skrill/');

				} else {

					$this->session->set_flashdata('fund_withdraw_success', TRUE);


						redirect('fund/withdraw/skrill/');

				}

				}
		}
		
		}else if ($page_type == 'payza') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_withdraw_amount_form_amount_validate'), 'trim|numeric|required');
		$this->form_validation->set_rules('payza_email', $this->lang->line('fund_withdraw_payza_form_email_validate'), 'trim|htmlspecialchars|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('withdraw_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/withdraw/method/payza', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/withdraw/method/payza', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			$fees = $this->input->post('amount', TRUE)*$this->site_settings->withdraw_payza_percentage_fees/100 + $this->site_settings->withdraw_payza_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
			if ($amount > $this->helper->transaction_balance()) {

				$this->session->set_flashdata('fund_withdraw_balance_zero', TRUE);
					redirect('fund/withdraw/payza/');

				} else {
					
					if (!$this->core_model->fund_withdraw_with_payza($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_withdraw_failed', TRUE);
					redirect('fund/withdraw/payza/');

				} else {

					$this->session->set_flashdata('fund_withdraw_success', TRUE);


						redirect('fund/withdraw/payza/');

				}

				}
		}
		
		}else if ($page_type == 'payu') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		$this->form_validation->set_rules('amount', $this->lang->line('fund_withdraw_amount_form_amount_validate'), 'trim|numeric|required');
		$this->form_validation->set_rules('payu_address', $this->lang->line('fund_withdraw_payu_form_address_validate'), 'trim|htmlspecialchars|required');
		if ($this->form_validation->run() == FALSE) {
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('withdraw_meta_title');
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/withdraw/method/payu', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/withdraw/method/payu', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		
		}else {
			$fees = $this->input->post('amount', TRUE)*$this->site_settings->withdraw_payu_percentage_fees/100 + $this->site_settings->withdraw_payu_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
			if ($amount > $this->helper->transaction_balance()) {

				$this->session->set_flashdata('fund_withdraw_balance_zero', TRUE);
					redirect('fund/withdraw/payu/');

				} else {
					
					if (!$this->core_model->fund_withdraw_with_payu($this->input->post(NULL, TRUE))) {

											$this->session->set_flashdata('fund_withdraw_failed', TRUE);
					redirect('fund/withdraw/payu/');

				} else {

					$this->session->set_flashdata('fund_withdraw_success', TRUE);


						redirect('fund/withdraw/payu/');

				}

				}
		}
	}// elseif	
	
	}else {
			redirect('errors/account');
		}
	}
	
	/* Stripe card processing */
	
	public function stripe_card_check($data){
		if(isset($_POST['fund-add-card'])){
		
		$complete = "";
		$note = "";
		$cardget = $this->core_model->core_check_card_info($this->input->post('card', TRUE));
		try{
		$fees = $this->input->post('amount')*$this->site_settings->card_deposit_percentage_fees/100 + $this->site_settings->card_deposit_flat_fees;
		$amount = $this->input->post('amount') - $fees;
		$amountplusfees = $this->input->post('amount') + $fees;
		$amountstripe = number_format((float)$amountplusfees*100., 0, '.', '');
		
		
			$data = array(
				'number' => $cardget->number,
				'name' => $cardget->name,
				'exp_month' => $cardget->month,
				'exp_year'=> $cardget->exp_year,
				'cvc' => $cardget->cvc,
				'description' => ''.$this->site_settings->site_name.' Send by - '.$this->session->email.'',
				'amount' => $amountstripe
			);
			
			$token = \Stripe\Token::create(array(
			"card" => array(
			'name' => $data['name'],
			"number" => $data['number'],
			"exp_month" => $data['exp_month'],
			"exp_year" => $data['exp_year'],
			"cvc" => $data['cvc']
			)
			));
			/*$mycard = array('number' => $data['number'],
							'name' => $data['name'],
							'exp_month' => $data['exp_month'],
							'exp_year' => $data['exp_year'],
							'cvc' => $data['cvc'],);*/
			$charge = \Stripe\Charge::create(array('source'=>$token,
													'amount'=>$data['amount'],
													'description' => $data['description'],
		
											'currency'=>$this->site_settings->curr_word));
											
		// Get sender name
		if ($this->user->business_name) {
			$sender_name = $this->user->business_name;
		}else {
			$sender_name =		$this->session->full_name;
		}
		
		$storedata = array(
		
		'sender' => $this->session->id,
		'sender_name' => $sender_name,
		'sender_email' => $this->session->email,
		'receiver' => 'Card - '.str_pad(substr($data['number'], -4), strlen($data['number']), '*', STR_PAD_LEFT).'',
		'fees' => number_format($fees, 2, '.', ''),
		'status' => 'Processed',
		'payment_type' => 'Deposit',
		'payment_method' => 'Card',
		'userid' => $this->session->id,
		'txn_id' => $charge->id,
		'total' => number_format($this->input->post('amount'), 2, '.', ''),
		'amount' => $amount,
		'date' => time()
			);
												$complete = $this->core_model->fund_deposit_with_card($storedata);
												if ($complete) {
				$this->session->set_flashdata('fund_deposit_success', TRUE);
				redirect('fund/add/card/');
												} else {
				$this->session->set_flashdata('fund_deposit_failed', TRUE);
				redirect('fund/add/card/');
												}		
		}catch (Exception $e){
			$note = $e->getMessage();
		}	
		return $note;
		}
		
		}
		
		public function submit($method) {
			
			if (empty($method)) {
				redirect('fund/');
			
			}elseif ($method == 'pin') {
				if ($this->site_settings->user_deposit_fund == 1) {
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['local_bank'] = $this->myaccount_model->bk_nigeria_getlistbank();
		$data['local_card'] = $this->core_model->core_get_local_active_card();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('fund_meta_title');
		
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/deposit/tabs/local_pin', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/deposit/tabs/local_pin', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		}
		else {
			redirect('myaccount');
		}
			}elseif ($method == 'phone') {
				
			}elseif ($method == 'otp') {	
			
			if ($this->site_settings->user_deposit_fund == 1) {
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->core_model->core_get_active_card();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('fund_meta_title');
		
		if ($this->helper->ac_is_business()) {
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/fund/deposit/tabs/local_card_otp', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		}
		
		if ($this->helper->ac_is_personal()) {
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/personal/fund/deposit/tabs/local_card_otp', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}
		
		
		}
		else {
			redirect('myaccount');
		}
			}
		}
		
	/* Voucher pin Form callback validate
	*/
	public function validate_voucher_pin() {
	if (empty(trim($this->input->post('pin', TRUE))) || empty(trim($this->input->post('cvv', TRUE)))) {
		$this->form_validation->set_message('validate_voucher_pin', $this->lang->line('validate_voucher_pin_empty_field'));
		return FALSE;
	} else {
		// Validate PIN
		$pincheck = $this->core_model->core_get_voucher_pin_code($this->input->post(NULL, TRUE));
		if ($pincheck == FALSE) {
		$this->form_validation->set_message('validate_voucher_pin', $this->lang->line('validate_voucher_pin_no_pin'));
		return FALSE;
		 // End validate value	
		} else {
		$pincheck = $this->core_model->core_get_voucher_pin_code($this->input->post(NULL, TRUE));
		if ($this->input->post('amount', TRUE) > $pincheck['amount']) {
		$this->form_validation->set_message('validate_voucher_pin', $this->lang->line('validate_voucher_pin_no_amount'));
		return FALSE;
		}

		}
	}
	}
}
