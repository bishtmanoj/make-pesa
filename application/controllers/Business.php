<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include("./vendor/autoload.php");
require(APPPATH.'libraries/twilio-php-master/Twilio/autoload.php');
class Business extends CI_Controller {


	 public function __construct() {

		parent::__construct();

		$this->load->model('core_model');
		$this->load->model('business_model');
		$this->load->model('myaccount_model');
		
		// Get core Site settings
		$this->site_settings = $this->core_model->get_bk_core_settings();
		
		// Get core User
		$this->user = $this->core_model->get_bk_core_user();
		$this->load->library('form_validation');
		
		// Get theme path
		$this->themename = $this->core_model->get_core_bk_theme_name();
		
		// Language file
		$this->lang->load('business');
		
		// Get default card
		$this->default_card = $this->core_model->get_bk_core_get_card_default();
		
		// Verification status
		$this->verification_id = $this->core_model->get_verification_id();
		$this->verification_address = $this->core_model->get_verification_address();
		
		
		
	 }
	 
	public function index()
	{
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		} elseif ($this->site_settings->site_maintanace == 1) {
			redirect('errors/maintanance');
		}
		
		$data['list_money'] = $this->myaccount_model->getlistmoney();
		$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
		$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
		$data['list_card'] = $this->myaccount_model->bk_getlistcard();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('myaccount_meta_title');
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/home', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
	}
	
	/* Wallet
	******/
	public function wallet($page_type = '')
	{
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		} elseif ($this->site_settings->site_maintanace == 1) {
			redirect('errors/maintanance');
		}
		
		if (empty($page_type)) {
		
		$data['list_card'] = $this->myaccount_model->bk_getlistcard();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('wallet_meta_title');
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/wallet/home', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		
		
	} elseif ($page_type == 'bank') {

		
		
		/* Form validate */
			$this->form_validation->set_rules('acno', $this->lang->line('wallet_add_bank_number'), 'required|numeric');
			$this->form_validation->set_rules('acname', $this->lang->line('wallet_add_bank_bank_ac_name'), 'required|htmlspecialchars');
			$this->form_validation->set_rules('swift', $this->lang->line('wallet_add_bank_swift_code'), 'required|htmlspecialchars');
			$this->form_validation->set_rules('bankname', $this->lang->line('wallet_add_bank_bankname'), 'required|htmlspecialchars');
			$this->form_validation->set_rules('branchname', $this->lang->line('wallet_add_bank_branch_name'), 'required|htmlspecialchars');
			$this->form_validation->set_rules('country', $this->lang->line('wallet_add_bank_country'), 'htmlspecialchars');
			$this->form_validation->set_rules('city', $this->lang->line('wallet_add_bank_city'), 'required|htmlspecialchars');

			if ($this->form_validation->run() == FALSE) {

				$data['list_card'] = $this->myaccount_model->bk_getlistcard();
				$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
				$data['list_pending_bank'] = $this->myaccount_model->bk_get_pending_listbank();
				$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
				$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
				$data['title'] = $this->lang->line('wallet_meta_title');
				$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
				$this->load->view($this->themename.'/layout/globe/business/header_navbar');
				$this->load->view($this->themename.'/layout/business/wallet/home', $data);
				$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
				$this->load->view($this->themename.'/layout/globe/business/footer_end');

			} else {


				if (!$this->myaccount_model->bk_add_bank($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('wallet_add_bank_failed', TRUE);
					redirect('business/wallet');

				} else {

					$this->session->set_flashdata('wallet_add_bank_success', TRUE);


						redirect('business/wallet');

				}
			}

		/* End form */
		} elseif ($page_type == 'card') {

		/* Verify code */
		if(isset($_POST['verify-card'])){
		/* Form card Verify validate */
		$this->form_validation->set_rules('code', $this->lang->line('wallet_verify_form_code'), 'trim|numeric|htmlspecialchars|max_length[6]|callback_verify_card_code_validate');

		 if ($this->form_validation->run() == FALSE)
                {
		$data['list_card'] = $this->myaccount_model->bk_getlistcard();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('wallet_meta_title');
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
				$this->load->view($this->themename.'/layout/globe/business/header_navbar');
				$this->load->view($this->themename.'/layout/business/wallet/home', $data);
				$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
				$this->load->view($this->themename.'/layout/globe/business/footer_end');

		} else  {
						/* Verify code */
						
						if (!$this->core_model->verify_card_code_update($this->input->post(NULL, TRUE))) {
				$this->session->set_flashdata('wallet_verify_card_code_failed', TRUE);
				redirect('business/wallet');
						} else {
				
				$card_get = $this->core_model->get_bk_core_get_card_details($this->input->post(NULL, TRUE));
				// Email Notification
				if ($this->site_settings->email_notification) {
				$data['user'] = $this->core_model->core_get_user_with_email($this->session->email);
				$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
				$this->email->to($this->session->email);
				$this->email->subject(''.$this->lang->line('verify_card_success_email_subject').' '.$this->site_settings->site_name.'');
				$this->email->message($this->load->view($this->themename.'/layout/email/verified-card', $data, TRUE));

				$this->email->send();
				}
				
				
				
				// SMS Notification
				if ($this->site_settings->sms_notification) {
				//Infobip
				if ($this->site_settings->sms_infobip) {
				$to_number = $this->user->mobile;
				$sms_body = $this->lang->line('verify_card_success_sms_subject')
					.'. '.$this->lang->line('verify_card_success_sms_card_number').' '.substr_replace($card_get->number, str_repeat('X', 5), 4, 5).'';
				$this->helper->infobip_sms($to_number, $sms_body);
				}//End infobip
				
				// Twilio
				if ($this->site_settings->sms_twilio) {
				$sid = $this->site_settings->twilio_sid; // Your Account SID from www.twilio.com/console
				$token = $this->site_settings->twilio_token; // Your Auth Token from www.twilio.com/console

				$client = new Twilio\Rest\Client($sid, $token);
				$message = $client->messages->create(
				  $this->user->mobile, // Text this number
				  array(
				    'from' => $this->site_settings->twilio_number, // From a valid Twilio number
				    'body' => $this->lang->line('verify_card_success_sms_subject')
					.'. '.$this->lang->line('verify_card_success_sms_card_number').' '.substr_replace($card_get->number, str_repeat('X', 5), 4, 5).''
				  )
				);
				}// End twilio
				}
				
				$this->session->set_flashdata('wallet_verify_card_code_success', TRUE);
				redirect('business/wallet');
						}
						/* End verify */
				}
		}
		/* End form */
		
		/* Card add */
		if(isset($_POST['wallet-card-add'])){
		$this->form_validation->set_rules('cardnumber', $this->lang->line('wallet_card_add_check_card_exist_form'), 'trim|numeric|htmlspecialchars|max_length[6]|callback_check_card_exist_validate');	
		if ($this->form_validation->run() == FALSE)	{
			
		$data['list_card'] = $this->myaccount_model->bk_getlistcard();
		$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['title'] = $this->lang->line('wallet_meta_title');
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/wallet/home', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		} else  {
		
		
		// Mastercard
		if ($this->site_settings->mgs_accept) {		
		
				
				// End Mastercard
				
		}else {// else start
			
			
			// Stripe
		if ($this->site_settings->stripe_accept) {
		try{
			$money = str_replace(''.$this->user->curr_symb.'', '', $this->site_settings->card_add_fee);
			$amount = number_format((float)$this->site_settings->card_add_fee*100., 0, '.', '');
			$token = \Stripe\Token::create(array(
			"card" => array(
			'name' => $this->input->post('name'),
			"number" => $this->input->post('cardnumber'),
			"exp_month" => $this->input->post('expirymonth'),
			"exp_year" => $this->input->post('expiryyear'),
			"cvc" => $this->input->post('cvc')
			)
			));
			$charge = \Stripe\Charge::create(array('source'=>$token,
										'amount'=>$amount,
										'description' => ''.$this->site_settings->site_name.' Deposit - '.$this->session->email.'',
		
								'currency'=>$this->user->curr_word));
								
		$amountok = number_format($this->site_settings->card_add_fee, 2, '.', '');
		$storedata = array(
		'date' => time(),
		'sender' => $this->session->id,
		'sender_name' => $this->session->full_name,
		'sender_email' => $this->session->email,
		'status' => 'Processed',
		'payment_type' => 'Card Verified',
		'payment_method' => 'Card',
		'userid' => $this->session->id,
		'receiver' => 'Card - '.str_pad(substr($this->input->post('cardnumber'), -4), strlen($this->input->post('cardnumber')), '*', STR_PAD_LEFT).'',
		'txn_id' => $charge->id,
		'total' => number_format($this->site_settings->card_add_fee, 2, '.', ''),
		'amount' => $amountok
			);
            $complete = $this->myaccount_model->wallet_card_add($storedata);
            if ($complete) {
				
				// Success
				// SMS Notification
				if ($this->site_settings->sms_notification) {
				$get_code_sent = $this->core_model->core_get_card_details($this->input->post('cardnumber', TRUE));				
				
				//Infobip
				if ($this->site_settings->sms_infobip) {
				$to_number = $this->user->mobile;
				$sms_body = $this->lang->line('verify_card_code_sms_subject')
				.' '.$get_code_sent->code.'';
				$this->helper->infobip_sms($to_number, $sms_body);
				}//End infobip
				
				// Twilio
				if ($this->site_settings->sms_twilio) {
				$sid = $this->site_settings->twilio_sid; // Your Account SID from www.twilio.com/console
				$token = $this->site_settings->twilio_token; // Your Auth Token from www.twilio.com/console

				$client = new Twilio\Rest\Client($sid, $token);
				$message = $client->messages->create(
				$this->user->mobile, // Text this number
				array(
				'from' => $this->site_settings->twilio_number, // From a valid Twilio number
				'body' => $this->lang->line('verify_card_code_sms_subject')
				.' '.$get_code_sent->code.''
				)
				);
				}// End twilio
				}
				
				$this->session->set_flashdata('wallet_card_add_success', TRUE);
				redirect('business/wallet');
            } else {
				$this->session->set_flashdata('wallet_card_add_failed', TRUE);
				redirect('business/wallet');
            }		
		}catch (Exception $e){
			//$note = $e->getMessage();
			$this->session->set_flashdata('payment_card_status', $e->getMessage());
			redirect('business/wallet');
		}
		
		}else {
		// End Stripe
		// Other Card Proccessors
		$this->session->set_flashdata('payment_card_status', $this->lang->line('payment_verify_with_card_not_available'));
		redirect('business/wallet');
}		
	
			
			
			}// else
		}
		}else {
			redirect('business/wallet');
		}
		/* End card */
		
		} elseif ($page_type == 'carddefault') {
		
		/* Form validate */
			$this->form_validation->set_rules('id', 'Card ID', 'required|htmlspecialchars');

			if ($this->form_validation->run() == FALSE) {

				$data['list_card'] = $this->myaccount_model->bk_getlistcard();
				$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
				$data['list_pending_bank'] = $this->myaccount_model->bk_get_pending_listbank();
				$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
				$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
				$data['title'] = $this->lang->line('wallet_meta_title');
				$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
				$this->load->view($this->themename.'/layout/globe/business/header_navbar');
				$this->load->view($this->themename.'/layout/business/wallet/home', $data);
				$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
				$this->load->view($this->themename.'/layout/globe/business/footer_end');

			} else {


				if (!$this->myaccount_model->bk_remove_default_card($this->input->post(NULL, TRUE))) {

			        
					if (!$this->myaccount_model->bk_update_default_card($this->input->post(NULL, TRUE))) {
						$this->session->set_flashdata('wallet_add_deafult_card_failed', TRUE);
						redirect('business/wallet');
					}else {
						$this->session->set_flashdata('wallet_add_deafult_card_success', TRUE);
						redirect('business/wallet');
					}
					

				} else {

					if (!$this->myaccount_model->bk_update_default_card($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('wallet_add_deafult_card_failed', TRUE);
					redirect('business/wallet');
					}else {
						
						$this->session->set_flashdata('wallet_add_deafult_card_success', TRUE);
						redirect('business/wallet');
					}

				}
			}
			
		} elseif ($page_type == 'cardremove') {
		
		/* Form validate */
			$this->form_validation->set_rules('id', 'Card ID', 'required|htmlspecialchars');

			if ($this->form_validation->run() == FALSE) {

				$data['list_card'] = $this->myaccount_model->bk_getlistcard();
				$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
				$data['list_pending_bank'] = $this->myaccount_model->bk_get_pending_listbank();
				$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
				$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
				$data['title'] = $this->lang->line('wallet_meta_title');
				$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
				$this->load->view($this->themename.'/layout/globe/business/header_navbar');
				$this->load->view($this->themename.'/layout/business/wallet/home', $data);
				$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
				$this->load->view($this->themename.'/layout/globe/business/footer_end');

			} else {


				if (!$this->myaccount_model->bk_remove_card($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('wallet_remove_card_failed', TRUE);
					redirect('business/wallet');

				} else {

					$this->session->set_flashdata('wallet_remove_card_success', TRUE);


						redirect('business/wallet');

				}
			}
			
			} elseif ($page_type == 'bankremove') {
			
		/* Form validate */
			$this->form_validation->set_rules('id', 'BANK ID', 'required|htmlspecialchars');

			if ($this->form_validation->run() == FALSE) {

				$data['list_card'] = $this->myaccount_model->bk_getlistcard();
				$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
				$data['list_pending_bank'] = $this->myaccount_model->bk_get_pending_listbank();
				$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
				$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
				$data['title'] = $this->lang->line('wallet_meta_title');
				$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
				$this->load->view($this->themename.'/layout/globe/business/header_navbar');
				$this->load->view($this->themename.'/layout/business/wallet/home', $data);
				$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
				$this->load->view($this->themename.'/layout/globe/business/footer_end');

			} else {


				if (!$this->myaccount_model->bk_remove_bank($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('wallet_remove_bank_failed', TRUE);
					redirect('business/wallet');

				} else {

					$this->session->set_flashdata('wallet_remove_bank_success', TRUE);


						redirect('business/wallet');

				}
			}
		
		}//elseif
	}
	
	
	
	public function activity() {

		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		} elseif ($this->site_settings->site_maintanace == 1) {
			redirect('errors/maintanance');
		}
		
		//Get Total Records Count
        $this->db->select("*");
        $this->db->from("transactions");
        
		$where = "userid = '".$this->session->id."' AND sender = '".$this->session->id."' OR receiver = '".$this->session->email."'";
		$this->db->like($where);
		if (!empty($this->input->get('start', TRUE) || $this->input->get('end', TRUE))) {
		$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($this->input->get('start', TRUE))). '" and "'. date('Y-m-d', strtotime($this->input->get('end', TRUE))).'"');
        }elseif (!empty($this->input->get('transaction', TRUE))) {
            $this->db->like('sender_email', $this->input->get('transaction', TRUE));
			$this->db->or_like('receiver_email', $this->input->get('transaction', TRUE));
			$this->db->or_like('txn_id', $this->input->get('transaction', TRUE));
		}
		
		$transactionresultCount = $this->db->get();

        $totalRecords = $transactionresultCount->num_rows();
        $limit = $this->site_settings->activity_show_page_transaction;

        if (!empty($this->input->get('transaction', TRUE))) {
            $config["base_url"] = base_url('business/activity?transaction=' . $this->input->get('transaction', TRUE));
        } else {
            $config["base_url"] = base_url('business/activity?transaction=&'.$this->input->get('start', TRUE).'&'.$this->input->get('end', TRUE).'');
        }

        $config["total_rows"] = $totalRecords;
        $config["per_page"] = $limit;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['enable_query_strings'] = TRUE;
        $config['num_links'] = 2;
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>';
        $config['prev_link'] = '<i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>';
        $this->pagination->initialize($config);
        $str_links = $this->pagination->create_links();
        $links = explode('&nbsp;', $str_links);

        $offset = 0;
        if (!empty($_GET['per_page'])) {
            $pageNo = $_GET['per_page'];
            $offset = ($pageNo - 1) * $limit;
        }
        
        //Get actual result from all records with pagination
        $this->db->select("*");
        $this->db->from("transactions");
        if (!empty($this->input->get('start', TRUE) || $this->input->get('end', TRUE))) {
		$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($this->input->get('start', TRUE))). '" and "'. date('Y-m-d', strtotime($this->input->get('end', TRUE))).'"');
        }elseif (!empty($this->input->get('transaction', TRUE))) {
            $this->db->like('sender_email', $this->input->get('transaction', TRUE));
			$this->db->or_like('receiver_email', $this->input->get('transaction', TRUE));
			$this->db->or_like('txn_id', $this->input->get('transaction', TRUE));
		}
		
		$where = "userid = '".$this->session->id."' AND sender = '".$this->session->id."' OR receiver = '".$this->session->email."'";
		$this->db->like($where);
		$this->db->limit($limit, $offset);
        $transactionresult = $this->db->get();
		$data['title'] = $this->lang->line('activity_meta_title_activity');
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
        $this->load->view($this->themename.'/layout/personal/activity/home', array(
            'totalResult' => $totalRecords,
            'transaction' => $transactionresult->result(),
            'links' => $links
        ));
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
    }
	
	
	/* Transfer
	******/
	public function transfer($method = '')
	{
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		} elseif ($this->site_settings->site_maintanace == 1) {
			redirect('errors/maintanance');
		}
		
		if (empty($method)) {
		$data['title'] = $this->lang->line('transfer_meta_title');
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/transfer/home', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		
		}else if ($method == 'success') {
		
		if ($this->session->type_sent == 'request' || $this->session->type_sent == 'sent') {
		$data['title'] = $this->lang->line('transfer_success_meta_title');
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/transfer/success', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		
		// Payment redirect
		
		if (isset($_POST['payment-another'])) {
			if ($this->session->type_sent == 'request') {
			
			$this->session->unset_userdata(array('type_sent', 'requested_info', 'payer_id'));
			redirect('business/transfer/request');
			
			} elseif ($this->session->type_sent == 'sent') {
				
				$this->session->unset_userdata(array('type_sent', 'requested_info', 'payer_id'));
				redirect('business/transfer/send');
			}
		}
		
		if (isset($_POST['payment-go-back'])) {
			
			if ($this->session->type_sent == 'request') {
			
			$this->session->unset_userdata(array('type_sent', 'requested_info', 'payer_id'));
			redirect('business');
			
			} elseif ($this->session->type_sent == 'sent') {
				
				$this->session->unset_userdata(array('type_sent', 'requested_info', 'payer_id'));
				redirect('business');
			}	
		}
		
		}else {
			redirect('business');
		}
		
		}// elseif
		
	}

	/* 
	******/
	public function transfer_method($page_type)
	{
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		} elseif ($this->site_settings->site_maintanace == 1) {
			redirect('errors/maintanance');
		}
		
		if (empty($page_type)) {
			redirect('business');

		} elseif ($page_type == 'send') {

		
		if ($this->site_settings->user_send_money == 0) {
			redirect('business');
		} elseif ($this->user->send_money == 0) {
			redirect('errors/account');
		}
		
		/* Form validate */
		$this->form_validation->set_rules('next_email', $this->lang->line('send_payment_send_form_recepient_validate'), 'trim|htmlspecialchars|callback_send_payment_email_validate');
		
		 if ($this->form_validation->run() == FALSE)
                {
        $data['title'] = $this->lang->line('transfer_send_meta_title');
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/transfer/send/home', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
                }
                else
                {
					$receipt_check = $this->core_model->core_get_user_with_email($this->input->post('next_email', TRUE));
				if ($receipt_check->status == 0) {

			        $this->session->set_flashdata('receipt_not_get_payment', TRUE);
					redirect('business/transfer/send');

				} else {
					// User sessions store
					

						$this->session->payer_id = $this->input->post('next_email', TRUE);
						redirect('business/transfer/send/complete');


				}

                }

		/* End form */
		} elseif ($page_type == 'request') { 
		
		if ($this->site_settings->user_request_money == 0) {
			redirect('myaccount');
		} elseif ($this->user->request_money == 0) {
			redirect('errors/account');
		}
		
		// Request form
		/* Form validate */
		$this->form_validation->set_rules('amount', $this->lang->line('transfer_request_form_amount_validate'), 'required|numeric');
		$this->form_validation->set_rules('receipt', $this->lang->line('transfer_request_form_receipt_validate'), 'trim|htmlspecialchars|callback_request_payment_receipt_validate');
		$this->form_validation->set_rules('note', $this->lang->line('transfer_request_form_receipt_validate'), 'trim|htmlspecialchars');
		 if ($this->form_validation->run() == FALSE)
                {
		$data['recepient'] = $this->core_model->get_bk_core_recepient_details();
        $data['title'] = $this->lang->line('transfer_request_payment_meta_title');
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/transfer/request/priview', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
                }
                else
                {
				if (!$this->core_model->request_money($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('payment_request_failed', TRUE);
					redirect('business/transfer/request');

				} else {
						// Email to receipt email
						if ($this->site_settings->email_notification) {
						$data['user'] = $this->core_model->core_get_user_with_email($this->input->post('receipt', TRUE));
						$data['amount'] = $this->input->post('amount', TRUE);
						$user_check = $this->core_model->core_get_user_with_email($this->input->post('receipt', TRUE));
						$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
						$this->email->to($this->input->post('receipt', TRUE));
						$this->email->subject(''.$this->lang->line('payment_request_subject').' '.$this->site_settings->site_name.'');
						$this->email->message($this->load->view($this->themename.'/layout/email/payment-request', $data, TRUE));

						$this->email->send();
						}
						
						
						//SMS Notification
						if ($this->site_settings->sms_notification) {
				
						$get_user_info = $this->core_model->core_get_user_with_email($this->input->post('receipt', TRUE));
						
						//infobip
						if ($this->site_settings->sms_infobip) {
						$to_number = $get_user_info->mobile;
						$sms_body = ''.$this->lang->line('payment_request_sms_subject_hello').''.$get_user_info->full_name.' '.$this->lang->line('payment_request_sms_subject_you').''.$this->user->full_name.'('.$this->user->email.') '.$this->user->curr_word.''.$this->input->post('amount', TRUE).'';
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
						'body' => $this->lang->line('payment_request_sms_subject_hello')
						.' '.$get_user_info->full_name.'! '.$this->lang->line('payment_request_sms_subject_you').' 
						'.$this->user->full_name.'('.$this->user->email.') '.$this->user->curr_word.''.$this->input->post('amount', TRUE).''
						)
						);
				}// End twilio
						}
						
						$this->session->type_sent = 'request';
						$this->session->requested_info = $this->lang->line('transfer_success_requested').
						$this->user->curr_symb.''.$this->input->post('amount', TRUE).' '.$this->user->curr_word.' 
						'.$this->lang->line('transfer_success_requested_to').' '.$this->input->post('receipt', TRUE).'';
						
						redirect('business/transfer/success');

				}
				}
				// End request payment

		/* End form */
		
		
		// End request
		} elseif ($page_type == 'cancel') {
			
		if ($this->session->payer_id) {
			$this->session->unset_userdata(array('payer_id'));
			redirect('business/transfer/send');
		} else {
			redirect('business/transfer/');
		}
		} elseif ($page_type == 'repeat') {
			if ($this->input->get('email', TRUE)) {
				// $this->form_validation->set_rules('next_email', $this->lang->line('send_payment_send_form_recepient_validate'), 'trim|htmlspecialchars|callback_send_payment_email_validate');
		$this->form_validation->set_rules('amount', $this->lang->line('send_payment_complete_form_amount_validate'), 'required|numeric');
		$this->form_validation->set_rules('note', $this->lang->line('send_payment_complete_form_note_validate'), 'trim|htmlspecialchars');
		 if ($this->form_validation->run() == FALSE)
                {
		$data['recepient'] = $this->core_model->get_bk_core_recepient_details();
        $data['title'] = $this->lang->line('transfer_send_complete_meta_title');
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/transfer/send/repeat', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
                }
                else
                {
				$fees = $this->input->post('amount', TRUE)*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
				// Send payment with payment method_exists
				if ($amount > $this->helper->transaction_balance()) {

				
				// Mastercard
		if ($this->site_settings->mgs_accept) {
		
				// End Mastercard
				}else {// Else start
			
			// Other Payment
			
			// Stripe
		if ($this->site_settings->stripe_accept) {
		try{
		$cardget = $this->core_model->get_bk_core_get_card_default();
		$fees = $this->input->post('amount')*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
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
						'description' => ''.$this->site_settings->site_name.' Send Payment by - '.$this->session->email.'',
		
				'currency'=>$this->user->curr_word));
								
		$senderget = $this->core_model->core_get_user_with_email($this->session->email);
		$receiverget = $this->core_model->core_get_user_with_email($this->input->post('next_email'));
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
		'userid' => $this->session->id,
		'txn_id' => $charge->id,
		'dispute' => '0',
		'note' => $this->input->post('note'),
		'total' => number_format($this->input->post('amount'), 2, '.', ''),
		'amount' => $amount,
		'date' => time()
			);
            $complete = $this->core_model->card_send_money($storedata);
            if ($complete) {
				
				// Success
				// Email to Receiver email
						if ($this->site_settings->email_notification) {
						$data['user'] = $this->core_model->core_get_user_with_email($this->input->post('next_email', TRUE));
						$data['amount'] = $this->input->post('amount', TRUE);
						$user_check = $this->core_model->core_get_user_with_email($this->input->post('next_email', TRUE));
						$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
						$this->email->to($this->input->post('next_email', TRUE));
						$this->email->subject(''.$this->lang->line('Payment_made_subject').' '.$this->site_settings->site_name.'');
						$this->email->message($this->load->view($this->themename.'/layout/email/payment-sent', $data, TRUE));

						$this->email->send();
						}
						
						// SMS Notification
						if ($this->site_settings->sms_notification) {
						$get_user_info = $this->core_model->core_get_user_with_email($this->input->post('next_email', TRUE));
						
						//Infobip
						if ($this->site_settings->sms_infobip) {
						$to_number = $get_user_info->mobile;
						$sms_body = $this->lang->line('payment_sent_sms_subject_hello')
						.' '.$get_user_info->full_name.'! '.$this->lang->line('payment_sent_sms_subject_received').' 
						'.$this->site_settings->site_name.'
						'.$this->lang->line('payment_sent_sms_subject_from').'
						'.$this->user->full_name.'('.$this->user->email.') '.$this->user->curr_word.''.$this->input->post('amount', TRUE).'';
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
						'.$this->user->full_name.'('.$this->user->email.') '.$this->user->curr_word.''.$this->input->post('amount', TRUE).''
						)
						);
						}// End twilio
						}
				
				$this->session->type_sent = 'sent';
						$this->session->sent_info = $this->lang->line('transfer_success_sent').
						$this->user->curr_symb.''.$this->input->post('amount', TRUE).' '.$this->user->curr_word.' 
						'.$this->lang->line('transfer_success_sent_to').' '.$this->input->post('next_email', TRUE).'</br>
						'.$this->lang->line('transfer_success_card_sent_info').' '.substr_replace($cardget->number, str_repeat('X', 5), 4, 5).'';
						
						redirect('business/transfer/success');
            } else {
				$this->session->set_flashdata('payment_send_card_failed', TRUE);
				redirect('business');
            }		
		}catch (Exception $e){
			//$note = $e->getMessage();
			$this->session->set_flashdata('payment_card_status', $e->getMessage());
			redirect('business');
		} // End Stripe
		}else {
		
		$this->session->set_flashdata('payment_card_status', $this->lang->line('payment_with_card_not_available'));
		redirect('business');
		}
				
			
				}// Else

				} else {
					
					// Paid with with Balance
					
					if (!$this->core_model->send_money($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('balance_payment_failed', TRUE);
					redirect('business/');

				} else {
						// Email to Payer email
						if ($this->site_settings->email_notification) {
						
						$data['user'] = $this->core_model->core_get_user_with_email($this->input->post('next_email', TRUE));
						$data['amount'] = $this->input->post('amount', TRUE);
						$user_check = $this->core_model->core_get_user_with_email($this->input->post('next_email', TRUE));
						$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
						$this->email->to($this->input->post('next_email', TRUE));
						$this->email->subject(''.$this->lang->line('Payment_made_subject').' '.$this->site_settings->site_name.'');
						$this->email->message($this->load->view($this->themename.'/layout/email/payment-sent', $data, TRUE));

						$this->email->send();
						
						}
						
						
						// SMS Notification
						if ($this->site_settings->sms_notification) {
						$get_user_info = $this->core_model->core_get_user_with_email($this->input->post('next_email', TRUE));
						
						//infobip
						if ($this->site_settings->sms_infobip) {
						$to_number = $get_user_info->mobile;
						$sms_body = ''.$this->lang->line('payment_sent_sms_subject_hello').''.$get_user_info->full_name.' '.$this->lang->line('payment_sent_sms_subject_from').''.$this->user->full_name.'('.$this->user->email.') '.$this->user->curr_word.''.$this->input->post('amount', TRUE).'';
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
						'body' => $this->lang->line('payment_sent_sms_subject_hello')
						.' '.$get_user_info->full_name.'! '.$this->lang->line('payment_sent_sms_subject_from').' 
						'.$this->user->full_name.'('.$this->user->email.') '.$this->user->curr_word.''.$this->input->post('amount', TRUE).''
						)
						);
						}// End twilio
						}
						
						$this->session->type_sent = 'sent';
						$this->session->sent_info = $this->lang->line('transfer_success_sent').
						$this->user->curr_symb.''.$this->input->post('amount', TRUE).' '.$this->user->curr_word.' 
						'.$this->lang->line('transfer_success_sent_to').' '.$this->input->post('next_email', TRUE).'';
						
						redirect('business/transfer/success');
						


				}
					
					// End Paid with Balance
				}
				// End sending with payment method

                }
				
				// End form
			} else {
				redirect('business');
			}
			
		} elseif ($page_type == 'complete') { 
		
		if ($this->session->payer_id) {
		// Preview form
		
		
		/* Form validate */
		$this->form_validation->set_rules('next_email', $this->lang->line('send_payment_send_form_recepient_validate'), 'trim|htmlspecialchars|callback_send_payment_email_validate');
		$this->form_validation->set_rules('amount', $this->lang->line('send_payment_complete_form_amount_validate'), 'required|numeric');
		$this->form_validation->set_rules('note', $this->lang->line('send_payment_complete_form_note_validate'), 'trim|htmlspecialchars');
		 if ($this->form_validation->run() == FALSE)
                {
		$data['recepient'] = $this->core_model->get_bk_core_recepient_details();
        $data['title'] = $this->lang->line('transfer_send_complete_meta_title');
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/transfer/send/priview', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
                }
                else
                {
				$fees = $this->input->post('amount', TRUE)*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
				$amount = $this->input->post('amount', TRUE) + $fees;
				// Send payment with payment method_exists
				if ($amount > $this->helper->transaction_balance()) {

					
				// Mastercard
		
		if ($this->site_settings->mgs_accept) {
		
				// End Mastercard
				}else {// Else start
			
			// Other Proccessors
		// Stripe
		
		if ($this->site_settings->stripe_accept) {
		try{
		$cardget = $this->core_model->get_bk_core_get_card_default();
		$fees = $this->input->post('amount')*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
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
						'description' => ''.$this->site_settings->site_name.' Send Payment by - '.$this->session->email.'',
		
				'currency'=>$this->user->curr_word));
								
		$senderget = $this->core_model->core_get_user_with_email($this->session->email);
		$receiverget = $this->core_model->core_get_user_with_email($this->input->post('next_email'));
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
		'userid' => $this->session->id,
		'txn_id' => $charge->id,
		'dispute' => '0',
		'note' => $this->input->post('note'),
		'total' => number_format($this->input->post('amount'), 2, '.', ''),
		'amount' => $amount,
		'date' => time()
			);
            $complete = $this->core_model->card_send_money($storedata);
            if ($complete) {
				
				// Success
				// Email to Receiver email
						if ($this->site_settings->email_notification) {
						$data['user'] = $this->core_model->core_get_user_with_email($this->input->post('next_email', TRUE));
						$data['amount'] = $this->input->post('amount', TRUE);
						$user_check = $this->core_model->core_get_user_with_email($this->input->post('next_email', TRUE));
						$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
						$this->email->to($this->input->post('next_email', TRUE));
						$this->email->subject(''.$this->lang->line('Payment_made_subject').' '.$this->site_settings->site_name.'');
						$this->email->message($this->load->view($this->themename.'/layout/email/payment-sent', $data, TRUE));

						$this->email->send();
						}
						
						// SMS Notification
						if ($this->site_settings->sms_notification) {
						$get_user_info = $this->core_model->core_get_user_with_email($this->input->post('next_email', TRUE));
						
						//Infobip
						if ($this->site_settings->sms_infobip) {
						$to_number = $get_user_info->mobile;
						$sms_body = $this->lang->line('payment_sent_sms_subject_hello')
						.' '.$get_user_info->full_name.'! '.$this->lang->line('payment_sent_sms_subject_received').' 
						'.$this->site_settings->site_name.'
						'.$this->lang->line('payment_sent_sms_subject_from').'
						'.$this->user->full_name.'('.$this->user->email.') '.$this->user->curr_word.''.$this->input->post('amount', TRUE).'';
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
						'.$this->user->full_name.'('.$this->user->email.') '.$this->user->curr_word.''.$this->input->post('amount', TRUE).''
						)
						);
						}// End twilio
						}
				
				$this->session->type_sent = 'sent';
						$this->session->sent_info = $this->lang->line('transfer_success_sent').
						$this->user->curr_symb.''.$this->input->post('amount', TRUE).' '.$this->user->curr_word.' 
						'.$this->lang->line('transfer_success_sent_to').' '.$this->input->post('next_email', TRUE).'</br>
						'.$this->lang->line('transfer_success_card_sent_info').' '.substr_replace($cardget->number, str_repeat('X', 5), 4, 5).'';
						
						redirect('business/transfer/success');
            } else {
				$this->session->set_flashdata('payment_send_card_failed', TRUE);
				redirect('business');
            }		
		}catch (Exception $e){
			//$note = $e->getMessage();
			$this->session->set_flashdata('payment_card_status', $e->getMessage());
			redirect('business');
		} // End Stripe
		}else {
		
		$this->session->set_flashdata('payment_card_status', $this->lang->line('payment_with_card_not_available'));
		redirect('business');
		}
			
				}// Else end

				} else {
					
					// Paid with with Balance
					
					if (!$this->core_model->send_money($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('balance_payment_failed', TRUE);
					redirect('business/');

				} else {
						
						// Email to Payer email
						if ($this->site_settings->email_notification) {
						
						$data['user'] = $this->core_model->core_get_user_with_email($this->input->post('next_email', TRUE));
						$data['amount'] = $this->input->post('amount', TRUE);
						$user_check = $this->core_model->core_get_user_with_email($this->input->post('next_email', TRUE));
						$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
						$this->email->to($this->input->post('next_email', TRUE));
						$this->email->subject(''.$this->lang->line('Payment_made_subject').' '.$this->site_settings->site_name.'');
						$this->email->message($this->load->view($this->themename.'/layout/email/payment-sent', $data, TRUE));

						$this->email->send();
						
						}
						
						// SMS Notification
						if ($this->site_settings->sms_notification) {
						$get_user_info = $this->core_model->core_get_user_with_email($this->input->post('next_email', TRUE));
						
				//infobip
						if ($this->site_settings->sms_infobip) {
						$to_number = $get_user_info->mobile;
				$sms_body = ''.$this->lang->line('payment_sent_sms_subject_hello').''.$get_user_info->full_name.' '.$this->lang->line('payment_sent_sms_subject_from').''.$this->user->full_name.'('.$this->user->email.') '.$this->user->curr_word.''.$this->input->post('amount', TRUE).'';
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
						'body' => $this->lang->line('payment_sent_sms_subject_hello')
						.' '.$get_user_info->full_name.'! '.$this->lang->line('payment_sent_sms_subject_from').' 
						'.$this->user->full_name.'('.$this->user->email.') '.$this->user->curr_word.''.$this->input->post('amount', TRUE).''
						)
						);
				}// End twilio
						}
						
						$this->session->type_sent = 'sent';
						$this->session->sent_info = $this->lang->line('transfer_success_sent').
						$this->user->curr_symb.''.$this->input->post('amount', TRUE).' '.$this->user->curr_word.' 
						'.$this->lang->line('transfer_success_sent_to').' '.$this->input->post('next_email', TRUE).'';
						
						redirect('business/transfer/success');


				}
					
					// End Paid with Balance
				}
				// End sending with payment method

                }
				
		/* End form */
		
		
		} else {
			redirect('business/transfer/send');
		}
		}
		
	}
	
	// Accept request payment
	function accept_requestmoney()
    {
		if ($this->helper->user_islogin()) {
			$fees = $this->input->get('amount', TRUE)*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
			$amount = $this->input->get('amount', TRUE) + $fees;
		if ($amount > $this->helper->transaction_balance()) {

		// Mastercard
		
		if ($this->site_settings->mgs_accept) {
		
				// End Mastercard
				}else {// Else start
			
			
			// Other Proccessors
			// Stripe
		if ($this->site_settings->stripe_accept) {
		try{
		$cardget = $this->core_model->get_bk_core_get_card_default();
		$fees = $this->input->get('amount')*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
		$amount = $this->input->get('amount') - $fees;
		$amountplusfees = $this->input->get('amount') + $fees;
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
						'description' => ''.$this->site_settings->site_name.' Send Payment by - '.$this->session->email.'',
		
				'currency'=>$this->user->curr_word));
								
		$senderget = $this->core_model->core_get_user_with_email($this->session->email);
		$receiverget = $this->core_model->core_get_user_with_email($this->input->get('email'));
		// Get receive name
		if ($receiverget->myaccount_name) {
			$receiver_name = $receiverget->myaccount_name;
		}else {
			$receiver_name =  $receiverget->full_name;
		}
		
		// Get sender name
		if ($senderget->myaccount_name) {
			$sender_name = $senderget->myaccount_name;
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
		'status' => 'Processed',
		'payment_type' => 'sent',
		'payment_method' => 'Card',
		'userid' => $this->session->id,
		'dispute' => '0',
		'txn_id' => $charge->id,
		'note' => ''
			);
        $complete = $this->core_model->card_request_accept_money($storedata);
            if ($complete) {
				
				// Success
				// Email to Receiver email
						if ($this->site_settings->email_notification) {
						$data['user'] = $this->core_model->core_get_user_with_email($this->input->get('email', TRUE));
						$data['amount'] = $this->input->get('amount', TRUE);
						$user_check = $this->core_model->core_get_user_with_email($this->input->get('email', TRUE));
						$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
						$this->email->to($this->input->get('email', TRUE));
						$this->email->subject(''.$this->lang->line('Payment_made_subject').' '.$this->site_settings->site_name.'');
						$this->email->message($this->load->view($this->themename.'/layout/email/payment-sent', $data, TRUE));

						$this->email->send();
						}
						
						// SMS Notification
						if ($this->site_settings->sms_notification) {
						$get_user_info = $this->core_model->core_get_user_with_email($this->input->get('email', TRUE));
						
						//Infobip
						if ($this->site_settings->sms_infobip) {
						$to_number = $get_user_info->mobile;
						$sms_body = $this->lang->line('payment_sent_sms_subject_hello')
						.' '.$get_user_info->full_name.'! '.$this->lang->line('payment_sent_sms_subject_received').' 
						'.$this->site_settings->site_name.'
						'.$this->lang->line('payment_sent_sms_subject_from').'
						'.$this->user->full_name.'('.$this->user->email.') '.$this->user->curr_word.''.$this->input->get('amount', TRUE).'';
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
						'.$this->user->full_name.'('.$this->user->email.') '.$this->user->curr_word.''.$this->input->get('amount', TRUE).''
						)
						);
						}// End twilio
						}
						
						$this->session->type_sent = 'sent';
						$this->session->sent_info = $this->lang->line('transfer_success_sent').
						$this->user->curr_symb.''.$this->input->get('amount', TRUE).' '.$this->user->curr_word.' 
						'.$this->lang->line('transfer_success_sent_to').' '.$this->input->get('email', TRUE).'</br>
						'.$this->lang->line('transfer_success_card_sent_info').' '.substr_replace($cardget->number, str_repeat('X', 5), 4, 5).'';
						
						redirect('business/transfer/success');
            } else {
				$this->session->set_flashdata('payment_send_card_failed', TRUE);
				redirect('business');
            }		
		}catch (Exception $e){
			//$note = $e->getMessage();
			$this->session->set_flashdata('payment_card_status', $e->getMessage());
			redirect('business');
		} // End Stripe
		}else {
		
		$this->session->set_flashdata('payment_card_status', $this->lang->line('payment_with_card_not_available'));
		redirect('business');
		}
		
				}// Else end
				
		
		} else {
		
		// Paid with balance
		
			if (!$this->core_model->accept_request()) {

			        $this->session->set_flashdata('balance_payment_failed', TRUE);
					redirect('business/');
			} else {
						$this->session->unset_userdata(array('payer_id'));
						// Email to Receiver email
						$data['user'] = $this->core_model->core_get_user_with_email($this->input->get('email', TRUE));
						$data['amount'] = $this->input->get('amount', TRUE);
						$user_check = $this->core_model->core_get_user_with_email($this->input->get('email', TRUE));
						$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
						$this->email->to($this->input->post('email', TRUE));
						$this->email->subject(''.$this->lang->line('Payment_made_subject').' '.$this->site_settings->site_name.'');
						$this->email->message($this->load->view($this->themename.'/layout/email/payment-sent', $data, TRUE));

						$this->email->send();
						
						$this->session->type_sent = 'sent';
						$this->session->sent_info = $this->lang->line('transfer_success_sent').
						$this->user->curr_symb.''.$this->input->get('amount', TRUE).' '.$this->user->curr_word.' 
						'.$this->lang->line('transfer_success_sent_to').' '.$this->input->get('email', TRUE).'';
						
						redirect('business/transfer/success');
						


				}
					
					// End Paid with Balance

		}
    } else {
		redirect('business');
	}
	}
	
	public function cancel_requestmoney()
    {
		
		if ($this->session->id) {
			if (!$this->core_model->cancel_request()) {
				$this->session->set_flashdata('cancel_requestmoney_failed', TRUE);
				redirect('business');
			} else {
		$this->session->set_flashdata('cancel_requestmoney_success', TRUE);
        redirect('business');
			}
		} else {
			redirect('business');

		}
    }
	
	public function resend_request()
    {
		
		if ($this->session->id) {
			if (!$this->core_model->resend_request()) {
				$this->session->set_flashdata('payment_request_failed', TRUE);
				redirect('business');
			} else {
		$this->session->set_flashdata('payment_request_success', TRUE);
        redirect('business');
			}
		} else {
			redirect('business');

		}
    }
	
	public function remove_request()
    {
		
		if ($this->session->id) {
			if (!$this->core_model->delete_request()) {
				$this->session->set_flashdata('cancel_requestmoney_failed', TRUE);
				redirect('business');
			} else {
		$this->session->set_flashdata('cancel_requestmoney_success', TRUE);
        redirect('business');
			}
		} else {
			redirect('business');

		}
    }

	public function refund() {
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		} elseif ($this->site_settings->site_maintanace == 1) {
			redirect('errors/maintanance');
		}
			
			$this->form_validation->set_rules('amount', $this->lang->line('refund_form_amount_validate'), 'required|numeric|trim');
			$this->form_validation->set_rules('transaction_id', $this->lang->line('refund_form_transaction_id_validate'), 'trim|htmlspecialchars|required');
			$this->form_validation->set_rules('receiver', $this->lang->line('refund_form_receiver_validate'), 'trim|htmlspecialchars|required');
			


			if ($this->form_validation->run() == FALSE) {

				$data['list_money'] = $this->myaccount_model->getlistmoney();
				$data['list_pending_money'] = $this->myaccount_model->get_pending_listmoney();
				$data['pending_money'] = $this->myaccount_model->bk_get_pending_balance();
				$data['list_card'] = $this->myaccount_model->bk_getlistcard();
				$data['list_bank'] = $this->myaccount_model->bk_getlistbank();
				$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
				$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
				$data['title'] = $this->lang->line('myaccount_meta_title');
				$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
				$this->load->view($this->themename.'/layout/globe/business/header_navbar');
				$this->load->view($this->themename.'/layout/business/home', $data);
				$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
				$this->load->view($this->themename.'/layout/globe/business/footer_end');

			} else {


				$amount = $this->input->post('amount', TRUE);
				if ($amount > $this->helper->transaction_balance()) {

				// Mastercard
		
		if ($this->site_settings->mgs_accept) {
			
				// End Mastercard
				}else {// Else start
			
			// Payment Proccessors
			// Stripe
			
		if ($this->site_settings->stripe_accept) {
		try{
		$cardget = $this->core_model->get_bk_core_get_card_default();
		$fees = $this->input->post('amount')*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
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
						'description' => ''.$this->site_settings->site_name.' Refund Payment by - '.$this->session->email.'',
		
				'currency'=>$this->user->curr_word));
								
		$senderget = $this->core_model->core_get_user_with_email($this->session->email);
		$receiverget = $this->core_model->core_get_user_with_email($this->input->post('receiver'));
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
		'status' => 'Processed',
		'payment_type' => 'refund',
		'amount' => $this->input->post('amount'),
		'userid' => $this->session->id,
		'dispute' => '0',
		'date' => time(),
		'note' => 'Payment Refund'
			);
        
		$complete = $this->core_model->refund_money_with_card($storedata);
            if ($complete) {
				
				// Success
				// Email to Receiver email
						if ($this->site_settings->email_notification) {
						$data['user'] = $this->core_model->core_get_user_with_email($this->input->post('receiver', TRUE));
						$data['amount'] = $this->input->post('amount', TRUE);
						$user_check = $this->core_model->core_get_user_with_email($this->input->post('receiver', TRUE));
						$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
						$this->email->to($this->input->post('receiver', TRUE));
						$this->email->subject(''.$this->lang->line('Payment_made_subject').' '.$this->site_settings->site_name.'');
						$this->email->message($this->load->view($this->themename.'/layout/email/payment-sent', $data, TRUE));

						$this->email->send();
						}
						
						// SMS Notification
						if ($this->site_settings->sms_notification) {
						$get_user_info = $this->core_model->core_get_user_with_email($this->input->post('receiver', TRUE));
						
						//Infobip
						if ($this->site_settings->sms_infobip) {
						$to_number = $get_user_info->mobile;
						$sms_body = $this->lang->line('payment_refund_sms_subject_hello')
						.' '.$get_user_info->full_name.'! '.$this->lang->line('payment_refund_sms_subject_received').' 
						'.$this->site_settings->site_name.'
						'.$this->lang->line('payment_refund_sms_subject_from').'
						'.$this->user->full_name.'('.$this->user->email.') '.$this->user->curr_word.''.$this->input->post('amount', TRUE).'';
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
						'body' => $this->lang->line('payment_refund_sms_subject_hello')
						.' '.$get_user_info->full_name.'! '.$this->lang->line('payment_refund_sms_subject_received').' 
						'.$this->site_settings->site_name.'
						'.$this->lang->line('payment_refund_sms_subject_from').'
						'.$this->user->full_name.'('.$this->user->email.') '.$this->user->curr_word.''.$this->input->post('amount', TRUE).''
						)
						);
						}// End twilio
						}
						
						$this->session->type_sent = 'sent';
						$this->session->sent_info = $this->lang->line('transfer_success_refund_sent').
						$this->user->curr_symb.''.$this->input->post('amount', TRUE).' '.$this->user->curr_word.' 
						'.$this->lang->line('transfer_success_sent_to').' '.$this->input->post('receiver', TRUE).'</br>
						'.$this->lang->line('transfer_success_card_sent_info').' '.substr_replace($cardget->number, str_repeat('X', 5), 4, 5).'';
						
						redirect('business/transfer/success');
            } else {
				$this->session->set_flashdata('payment_send_card_failed', TRUE);
				redirect('business');
            }		
		}catch (Exception $e){
			//$note = $e->getMessage();
			$this->session->set_flashdata('payment_card_status', $e->getMessage());
			redirect('business');
		} // End Stripe
		}else {
		
		$this->session->set_flashdata('payment_card_status', $this->lang->line('payment_with_card_not_available'));
		redirect('business');
		}
				}// Else end
				} else {
					
					// Paid with with Balance
					
					if (!$this->core_model->refund_money($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('balance_payment_failed', TRUE);
					redirect('business/');

				} else {
						// Email to Payer email
						if ($this->site_settings->email_notification) {
						$data['user'] = $this->core_model->core_get_user_with_email($this->input->post('receiver', TRUE));
						$data['amount'] = $this->input->post('amount', TRUE);
						$user_check = $this->core_model->core_get_user_with_email($this->input->post('receiver', TRUE));
						$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
						$this->email->to($this->input->post('receiver', TRUE));
						$this->email->subject(''.$this->lang->line('Payment_made_subject').' '.$this->site_settings->site_name.'');
						$this->email->message($this->load->view($this->themename.'/layout/email/payment-sent', $data, TRUE));

						$this->email->send();
						}
						
						
				// SMS Notification		
				if ($this->site_settings->sms_notification) {
				$get_user_info = $this->core_model->core_get_user_with_email($this->input->post('receiver', TRUE));
						
				//Infobip
				if ($this->site_settings->sms_infobip) {
				$to_number = $this->user->mobile;
				$sms_body = $this->lang->line('wallet_bank_pending_email_sms_notes');
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
						'body' => $this->lang->line('payment_refund_sms_subject_hello')
						.' '.$get_user_info->full_name.'! '.$this->lang->line('payment_refund_sms_subject_received').' 
						'.$this->site_settings->site_name.'
						'.$this->lang->line('payment_refund_sms_subject_from').'
						'.$this->user->full_name.'('.$this->user->email.') '.$this->user->curr_word.''.$this->input->post('amount', TRUE).''
						)
						);	
				}// End twilio
				}
						
						$this->session->type_sent = 'sent';
						$this->session->sent_info = $this->lang->line('transfer_success_refund_sent').
						$this->user->curr_symb.''.$this->input->post('amount', TRUE).' '.$this->user->curr_word.' 
						'.$this->lang->line('transfer_success_sent_to').' '.$this->input->post('receiver', TRUE).'';
						
						redirect('business/transfer/success');


				}
					
					// End Paid with Balance
				}
				// End

			}

		}
	
	/* Sending fees check callback validate
	*/
	public function bk_sendmoney_fees_validate() {

			$fees = $this->input->post('amount', TRUE)*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
			$amount = $this->input->post('amount', TRUE) + $fees;

				if ($amount > $this->helper->transaction_balance()) {

					$this->form_validation->set_message('bk_sendmoney_fees_validate', $this->lang->line('send_payment_complete_error_validate_fees_check'));
					return FALSE;

				}
			}
			
	/* Verify card code callback validate
	*/
	public function verify_card_code_validate() {
	$codecheck = $this->core_model->core_get_card_verify_code($this->input->post('code', TRUE));
		if (empty(trim($this->input->post('code', TRUE)))) {
			$this->form_validation->set_message('verify_card_code_validate', $this->lang->line('verify_card_code_validate_empty'));
		return FALSE;
		} elseif ($codecheck == FALSE) {
		$this->form_validation->set_message('verify_card_code_validate', $this->lang->line('verify_card_code_validate_error'));
		return FALSE;
		}
	}
	
	/* Card check if exist callback validate
	*/
	public function check_card_exist_validate() {
	$codecheck = $this->core_model->core_get_card_details($this->input->post('cardnumber', TRUE));
		if (empty(trim($this->input->post('cardnumber', TRUE)))) {
			$this->form_validation->set_message('check_card_exist_validate', $this->lang->line('check_card_exist_validate_empty'));
		return FALSE;
		} elseif (!$codecheck == FALSE) {
		$this->form_validation->set_message('check_card_exist_validate', $this->lang->line('check_card_exist_validate'));
		return FALSE;
		}
	}
	
	/* Bank check if exist callback validate
	*/
	public function check_bank_exist_validate() {
	$codecheck = $this->core_model->get_bk_core_get_local_bank_data($this->input->post('acno', TRUE));
		if (empty(trim($this->input->post('acno', TRUE)))) {
			$this->form_validation->set_message('check_bank_exist_validate', $this->lang->line('check_bank_exist_validate_empty'));
		return FALSE;
		} elseif (!$codecheck == FALSE) {
		$this->form_validation->set_message('check_bank_exist_validate', $this->lang->line('check_bank_exist_validate'));
		return FALSE;
		}
	}
	
	/* Send receipt validate Form callback validate
	*/
	public function send_payment_email_validate() {
	if (empty(trim($this->input->post('next_email', TRUE)))) {
		$this->form_validation->set_message('send_payment_email_validate', $this->lang->line('send_payment_email_validate_empty_value'));
		return FALSE;
	} else {
		// validate value Email, Username and Mobile
		$usercheck = $this->core_model->core_get_user_with_email($this->input->post('next_email', TRUE));
		if ($usercheck == FALSE) {
		$this->form_validation->set_message('send_payment_email_validate', $this->lang->line('send_payment_email_validate_no_email_mobile'));
		return FALSE;
		 // End validate value
		} else {
		$user_check = $this->core_model->core_get_user_with_email($this->input->post('next_email', TRUE));
		if ($this->input->post('next_email', TRUE) == $this->session->email) {
		$this->form_validation->set_message('send_payment_email_validate', $this->lang->line('send_payment_email_validate_yourself'));
		return FALSE;
		} else {
		$user_check = $this->core_model->core_get_user_with_email($this->input->post('next_email', TRUE));
		if ($this->session->mobile == $this->input->post('next_email', TRUE)) {
		$this->form_validation->set_message('send_payment_email_validate', $this->lang->line('send_payment_email_validate_yourself'));
		return FALSE;
		}

		}
	}
	}
	}
	
	/* Request receipt validate Form callback validate
	*/
	public function request_payment_receipt_validate() {
	if (empty(trim($this->input->post('receipt', TRUE)))) {
		$this->form_validation->set_message('request_payment_receipt_validate', $this->lang->line('request_payment_email_validate_empty_value'));
		return FALSE;
	} else {
		// validate value Email, Username and Mobile
		$usercheck = $this->core_model->core_get_user_with_email($this->input->post('receipt', TRUE));
		if ($usercheck == FALSE) {
		$this->form_validation->set_message('request_payment_receipt_validate', $this->lang->line('request_payment_email_validate_no_email_mobile'));
		return FALSE;
		 // End validate value
		} else {
		$user_check = $this->core_model->core_get_user_with_email($this->input->post('receipt', TRUE));
		if ($this->input->post('receipt', TRUE) == $this->session->email) {
		$this->form_validation->set_message('request_payment_receipt_validate', $this->lang->line('request_payment_email_validate_yourself'));
		return FALSE;
		} else {
		$user_check = $this->core_model->core_get_user_with_email($this->input->post('receipt', TRUE));
		if ($this->session->mobile == $this->input->post('receipt', TRUE)) {
		$this->form_validation->set_message('request_payment_receipt_validate', $this->lang->line('request_payment_email_validate_yourself'));
		return FALSE;
		}

		}
	}
	}
	}
	
	
	public function settings($page_type) {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		} elseif ($this->site_settings->site_maintanace == 1) {
			redirect('errors/maintanance');
		}
		
		if ($page_type == 'account') {

		$data['title'] = $this->lang->line('settings_account_meta_title');
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/settings/account/home', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		
		// form post
		if (isset($_POST['update-profile-name'])){
			
			$this->form_validation->set_rules('first_name', $this->lang->line('settings_account_form_first_name_validate'), 'trim|htmlspecialchars|required');
			$this->form_validation->set_rules('last_name', $this->lang->line('settings_account_form_last_name_validate'), 'trim|htmlspecialchars|required');
			$this->form_validation->set_rules('business_name', $this->lang->line('settings_account_form_business_name_validate'), 'trim|htmlspecialchars|required');
			
			if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('account_update_form_empty_failed', TRUE);
					redirect('business/settings/account');
		
			} else {
				if (!$this->core_model->profile_name_update($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('account_update_failed', TRUE);
					redirect('business/settings/account');
					
				} else {
					
					$this->session->set_flashdata('account_update_success', TRUE);
					redirect('business/settings/account');
				}
				
			}
		}elseif (isset($_POST['update-profile-image'])){
			
			$filefolder = './uploads/'.$this->session->id;
	 if(!file_exists($filefolder))
        {
                   mkdir($filefolder, 0777, true);
        }
      $config['upload_path']   = $filefolder;
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = 1024 * 8;
	  $config['max_filename'] = '255';
	  $config['image_library']    = 'gd2';
	  $config['quality']      = 80;
	  $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);
	  $this->upload->initialize($config);


		$filenameprotect = $this->security->sanitize_filename($this->upload->do_upload('image'), TRUE);
      if (!$filenameprotect) {
         $this->session->set_flashdata('account_update_form_empty_failed', TRUE);
                redirect('business/settings/account');
      }else {

		$data = $this->upload->data();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $data['full_path'];
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 256;
        $config['height'] = 256;
        $this->load->library('image_lib', $config);
		$this->image_lib->resize();
					
		$dataprotect = $this->security->xss_clean($data['file_name']);
		$filedata = $filefolder.'/'.$dataprotect;
            $file_name = $this->core_model->bk_core_profile_image($filedata );
            if($file_name)
            {
				unlink($this->user->image);
                $this->session->set_flashdata('account_update_success', TRUE);
                redirect('business/settings/account');
            }
            else
            {
                unlink($data['full_path']);
                $this->session->set_flashdata('account_update_form_empty_failed', TRUE);
                redirect('business/settings/account');
            }
      }
		}elseif (isset($_POST['update-profile-idcard'])){
			
			$this->form_validation->set_rules('idcard_type', $this->lang->line('settings_account_update_idcard_type_form_number_validate'), 'trim|htmlspecialchars|required');
			$this->form_validation->set_rules('number', $this->lang->line('settings_account_update_idcard_form_number_validate'), 'trim|htmlspecialchars|required');
			
			if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('account_update_form_empty_failed', TRUE);
					redirect('business/settings/account');
		
			} else {
				if (!$this->core_model->profile_idcard_update($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('account_update_failed', TRUE);
					redirect('business/settings/account');
					
				} else {
					
					$this->session->set_flashdata('account_update_success', TRUE);
					redirect('business/settings/account');
				}
				
			}
			
		}elseif (isset($_POST['update-profile-address'])){
			
			$this->form_validation->set_rules('address1', $this->lang->line('settings_account_update_address_form_address1_validate'), 'trim|htmlspecialchars|required');
			$this->form_validation->set_rules('address2', $this->lang->line('settings_account_update_address_form_address2_validate'), 'trim|htmlspecialchars');
			$this->form_validation->set_rules('city', $this->lang->line('settings_account_update_address_form_city_validate'), 'trim|htmlspecialchars|required');
			$this->form_validation->set_rules('state', $this->lang->line('settings_account_update_address_form_state_validate'), 'trim|htmlspecialchars|required');
			$this->form_validation->set_rules('postal_code', $this->lang->line('settings_account_update_address_form_postal_code_validate'), 'trim|htmlspecialchars|numeric');
			
			if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('account_update_validate_form_failed', validation_errors());
					redirect('business/settings/account');
		
			} else {
				if (!$this->core_model->profile_address_update($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('account_update_failed', TRUE);
					redirect('business/settings/account');
					
				} else {
					
					$this->session->set_flashdata('account_update_success', TRUE);
					redirect('business/settings/account');
				}
				
			}
			
		}// End isset
		
		}elseif ($page_type == 'security') {

		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		
		$data['title'] = $this->lang->line('settings_security_meta_title');
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/settings/security/home', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		
		// Form post
		if (isset($_POST['update-security-password'])){
			
			/* Form validate */
		$this->form_validation->set_rules('current_password', $this->lang->line('settings_security_update_form_current_password_validate'), 'trim|htmlspecialchars|callback_security_password_update_validate');
		$this->form_validation->set_rules('password', $this->lang->line('settings_security_update_form_new_password_validate'), array('trim', 'htmlspecialchars', 'min_length[6]', 'regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/]', 'required'), array('regex_match' => $this->lang->line('settings_security_update_form_password_strong_validate')));
		$this->form_validation->set_rules('confirm_password', $this->lang->line('settings_security_update_form_confirm_password_validate'), 'required|matches[password]|trim|htmlspecialchars');
		 if ($this->form_validation->run() == FALSE)
                {
        
					$this->session->set_flashdata('security_update_validate_form_failed', validation_errors());
					redirect('business/settings/security');     
                }
                else
                {
				if (!$this->core_model->security_password_update($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('security_update_failed', TRUE);
					redirect('business/settings/security');

				} else {
					
					// Change Password email
						$this->session->set_flashdata('security_update_success', TRUE);
						redirect('business/settings/security');
					
					
				}
				}// form
			
		}elseif (isset($_POST['update-security-pin'])){
			
			/* Form validate */
		$this->form_validation->set_rules('pin', $this->lang->line('settings_security_update_form_pin_validate'), array('trim', 'htmlspecialchars', 'max_length[6]', 'numeric', 'required'));
		$this->form_validation->set_rules('confirm_pin', $this->lang->line('settings_security_update_form_confirm_pin_validate'), 'required|matches[pin]|trim|htmlspecialchars');
		 if ($this->form_validation->run() == FALSE)
                {
        
					$this->session->set_flashdata('security_update_validate_form_failed', validation_errors());
					redirect('business/settings/security');     
                }
                else
                {
				if (!$this->core_model->security_pin_update($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('security_update_failed', TRUE);
					redirect('business/settings/security');

				} else {
					
					// Change Password email
						$this->session->set_flashdata('security_update_success', TRUE);
						redirect('business/settings/security');
					
					
				}
			}
			
		}// isset
		
		}elseif ($page_type == 'payments') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		
		$data['title'] = $this->lang->line('settings_payments_meta_title');
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/settings/payments/home', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		
		}elseif ($page_type == 'notifications') {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		}
		
		$data['title'] = $this->lang->line('settings_notifications_meta_title');
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/settings/notifications/home', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		
		}// page type
	}
	
	/* Security Password update callback validate
	*/
	public function security_password_update_validate() {
	$user_check = $this->core_model->core_get_user_with_email($this->user->email);
		if (!password_verify(trim($this->input->post('current_password', TRUE)), $user_check->password)) {
		$this->form_validation->set_message('security_password_update_validate', $this->lang->line('settings_security_update_form_password_validate_callback'));	
		return FALSE;
		}
	}	
	
	
	public function verification() {
		
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('business');
		} elseif ($this->helper->ac_is_admin()) {
			redirect('admin');
		} elseif ($this->site_settings->site_maintanace == 1) {
			redirect('errors/maintanance');
		}
		
		$data['sumcardbank_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		$data['sumbankac_yesno'] = $this->myaccount_model->bk_get_account_bank_sum();
		
		$data['title'] = $this->lang->line('verification_meta_title');
		
		$this->load->view($this->themename.'/layout/globe/business/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/business/header_navbar');
		$this->load->view($this->themename.'/layout/business/verification/home', $data);
		$this->load->view($this->themename.'/layout/globe/business/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/business/footer_end');
		
		// ID file upload
		if (isset($_POST['verification-id']) || isset($_POST['verification-address'])){
			
	$filefolder = './uploads/'.$this->session->id.'verification';
	 if(!file_exists($filefolder))
        {
                   mkdir($filefolder, 0777, true);
        }
      $config['upload_path']   = $filefolder;
      $config['allowed_types'] = 'gif|jpg|jpeg|png|zip|pdf';
      $config['max_size'] = 1024 * 8;
	  $config['max_filename'] = '255';
	  $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);
	  $this->upload->initialize($config);


		$filenameprotect = $this->security->sanitize_filename($this->upload->do_upload('file'), TRUE);
      if (!$filenameprotect) {
         $this->session->set_flashdata('verification_error_file_type', TRUE);
                redirect('business/verification');
      }else {

		$data = $this->upload->data();
					
		$dataprotect = $this->security->xss_clean($data['file_name']);
		$filedata = $filefolder.'/'.$dataprotect;
            
			if(isset($_POST['verification-id'])){
			$file_name = $this->core_model->bk_core_verification_id_store($filedata );
            
			if($file_name)
            {
				// Email notification
				if ($this->site_settings->email_notification) {
					$data['email'] = $this->session->email;
					$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
    				$this->email->to($this->session->email);
    				$this->email->subject(''.$this->lang->line('verification_submit_id_email_subject').' '.$this->site_settings->site_name.'');
    				$this->email->message($this->load->view($this->themename.'/layout/email/id-verification-submit', $data, TRUE));

    				$this->email->send();
					}
					
					// SMS Notification
						if ($this->site_settings->sms_notification) {
						//Infobip
						if ($this->site_settings->sms_infobip) {
						$to_number = $this->user->mobile;
						$sms_body = $this->user->full_name.''.$this->lang->line('verification_submit_id_sms_subject').'';
						$this->helper->infobip_sms($to_number, $sms_body);
						}//End infobip
						
						// Twilio
						if ($this->site_settings->sms_twilio) {
						$sid = $this->site_settings->twilio_sid; // Your Account SID from www.twilio.com/console
						$token = $this->site_settings->twilio_token; // Your Auth Token from www.twilio.com/console

						$client = new Twilio\Rest\Client($sid, $token);
						$message = $client->messages->create(
						$this->user->mobile, // Text this number
						array(
						'from' => $this->site_settings->twilio_number, // From a valid Twilio number
						'body' => $this->user->full_name.''.$this->lang->line('verification_submit_id_sms_subject').''
						)
						);
						}// End twilio
						}
				
				$this->session->set_flashdata('verification_submit_success', TRUE);
                redirect('business/verification');
            }
            else
            {
                $this->session->set_flashdata('verification_submit_failed', TRUE);
                redirect('business/verification');
            }
			}// isset
			
			if(isset($_POST['verification-address'])){
			$file_name = $this->core_model->bk_core_verification_address_store($filedata );
            
			if($file_name)
            {
					// Email notification
				if ($this->site_settings->email_notification) {
					$data['email'] = $this->session->email;
					$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
    				$this->email->to($this->session->email);
    				$this->email->subject(''.$this->lang->line('verification_submit_id_email_subject').' '.$this->site_settings->site_name.'');
    				$this->email->message($this->load->view($this->themename.'/layout/email/id-verification-submit', $data, TRUE));

    				$this->email->send();
					}
					
					// SMS Notification
						if ($this->site_settings->sms_notification) {
						//Infobip
						if ($this->site_settings->sms_infobip) {
						$to_number = $this->user->mobile;
						$sms_body = $this->user->full_name.''.$this->lang->line('verification_submit_id_sms_subject').'';
						$this->helper->infobip_sms($to_number, $sms_body);
						}//End infobip
						
						// Twilio
						if ($this->site_settings->sms_twilio) {
						$sid = $this->site_settings->twilio_sid; // Your Account SID from www.twilio.com/console
						$token = $this->site_settings->twilio_token; // Your Auth Token from www.twilio.com/console

						$client = new Twilio\Rest\Client($sid, $token);
						$message = $client->messages->create(
						$this->user->mobile, // Text this number
						array(
						'from' => $this->site_settings->twilio_number, // From a valid Twilio number
						'body' => $this->user->full_name.''.$this->lang->line('verification_submit_id_sms_subject').''
						)
						);
						}// End twilio
						}
						
				$this->session->set_flashdata('verification_submit_success', TRUE);
                redirect('business/verification');
            }
            else
            {
                $this->session->set_flashdata('verification_submit_failed', TRUE);
                redirect('business/verification');
            }
			}// isset
      }
		}
		// End upload
	}
	
	
}
