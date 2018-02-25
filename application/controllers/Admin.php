<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	 public function __construct() {

		parent::__construct();

		$this->load->model('core_model');
		$this->load->model('admin_model');
		
		// Get core Site settings
		$this->site_settings = $this->core_model->get_bk_core_settings();
		$this->load->library('form_validation');
		// Get core User
		$this->user = $this->admin_model->get_bk_core_user();
		
		// Get list User
		$this->userlist = $this->admin_model->get_bk_admin_user_list($this->input->get('id', TRUE));
		
		// Get core Count
		$this->user_total_count = $this->admin_model->get_bk_user_count();
		$this->pending_deposit_total_count = $this->admin_model->admin_pending_deposit_count();
		$this->pending_withdrawal_total_count = $this->admin_model->admin_pending_withdrawal_count();
		$this->pending_verification_total_count = $this->admin_model->admin_pending_verification_count();
		
		// Get theme path
		$this->themename = $this->core_model->get_core_bk_theme_name();
		
		// Language file
		$this->lang->load(array('admin'));
	 }
	 
	public function index()
	{
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
		$data['title'] = $this->lang->line('admin_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/home', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');
		
		
	}
	
	public function setting($method = '') {
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
		
		if (empty($method)) {
		/* Form validate */
		$checkbox = array('user_register',
		'user_send_money',
		'user_request_money',
		'user_deposit_fund',
		'user_withdraw_fund',
		'site_maintanace');

					foreach ($checkbox as $value) {
						if (empty($this->input->post($value, TRUE))) {
							$_POST[$value] = '0';
						}
					}
		$this->form_validation->set_rules('user_register', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'User Registration'));
		$this->form_validation->set_rules('user_send_money', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Send money'));
		$this->form_validation->set_rules('user_request_money', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Request money'));
		$this->form_validation->set_rules('user_withdraw_fund', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Withdraw Fund'));
		$this->form_validation->set_rules('site_maintanace', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Maintanace Mode'));
		$this->form_validation->set_rules('site_name', $this->lang->line('admin_setting_form_validate_site_name'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('site_email', $this->lang->line('admin_setting_form_validate_site_email'), 'trim|htmlspecialchars|max_length[250]|required');
		$this->form_validation->set_rules('site_description', $this->lang->line('admin_setting_form_validate_site_description'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('site_keywords', $this->lang->line('admin_setting_form_validate_site_keywords'), 'trim|htmlspecialchars');
		$this->form_validation->set_rules('card_add_fee', $this->lang->line('admin_setting_form_placeholder_card_verification_fees'), 'required|trim|numeric');
		$this->form_validation->set_rules('curr_word', 'Currency Code', 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('curr_symb', 'Currency Symbol', 'required|trim|htmlspecialchars');
		 if ($this->form_validation->run() == FALSE)
                {
        $data['title'] = $this->lang->line('admin_setting_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/manage/setting', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');      
                }
                else
                {
				if (!$this->admin_model->admin_settings($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('admin_setting_failed', TRUE);
					redirect('admin/setting');

				} else {
					
						$this->session->set_flashdata('admin_setting_success', TRUE);
						redirect('admin/setting');
					
					
				}
				 
                }
				
		/* End form */
		
		}elseif ($method == 'notification') {
			
			/* Form validate */
		$checkbox = array(
		'sms_notification',
		'email_notification',
		'sms_infobip',
		'sms_twilio');

					foreach ($checkbox as $value) {
						if (empty($this->input->post($value, TRUE))) {
							$_POST[$value] = '0';
						}
					}
		$this->form_validation->set_rules('sms_notification', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'SMS Notification'));
		$this->form_validation->set_rules('email_notification', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Email Notification'));
		$this->form_validation->set_rules('twilio_number', $this->lang->line('admin_notification_form_placeholder_twilio_number'), 'trim|numeric');
		$this->form_validation->set_rules('twilio_sid', $this->lang->line('admin_notification_form_placeholder_twilio_sid'), 'trim|htmlspecialchars');
		$this->form_validation->set_rules('twilio_token', $this->lang->line('admin_notification_form_placeholder_twilio_token'), 'trim|htmlspecialchars');
		$this->form_validation->set_rules('email_notification_email', $this->lang->line('admin_notification_form_placeholder_email_address'), 'trim|htmlspecialchars');
		 if ($this->form_validation->run() == FALSE)
                {
        $data['title'] = $this->lang->line('admin_setting_notification_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/manage/notification', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');      
                }
                else
                {
				if (!$this->admin_model->admin_settings($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('admin_setting_failed', TRUE);
					redirect('admin/setting/notification');

				} else {
					
						$this->session->set_flashdata('admin_setting_success', TRUE);
						redirect('admin/setting/notification');
					
					
				}
				 
                }
		

		
		}elseif ($method == 'payment') {
		/* Form validate */
		$checkbox = array('stripe_accept');

					foreach ($checkbox as $value) {
						if (empty($this->input->post($value, TRUE))) {
							$_POST[$value] = '0';
						}
					}
		$this->form_validation->set_rules('stripe_accept', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Stripe choose'));
		 if ($this->form_validation->run() == FALSE)
                {
        $data['title'] = $this->lang->line('admin_setting_payment_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/manage/payment', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');      
                }
                else
                {
				if (!$this->admin_model->admin_settings($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('admin_setting_failed', TRUE);
					redirect('admin/setting/payment');

				} else {
					
						$this->session->set_flashdata('admin_setting_success', TRUE);
						redirect('admin/setting/payment');
					
					
				}
				 
                }
				
		/* End form */
		
		
		}elseif ($method == 'secure') {
		/* Form validate */
		$checkbox = array('two_factor_login');

					foreach ($checkbox as $value) {
						if (empty($this->input->post($value, TRUE))) {
							$_POST[$value] = '0';
						}
					}
		$this->form_validation->set_rules('two_factor_login', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Signin'));
		 if ($this->form_validation->run() == FALSE)
                {
        $data['title'] = $this->lang->line('admin_setting_secure_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/manage/secure', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');      
                }
                else
                {
				if (!$this->admin_model->admin_settings($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('admin_setting_failed', TRUE);
					redirect('admin/setting/secure');

				} else {
					
						$this->session->set_flashdata('admin_setting_success', TRUE);
						redirect('admin/setting/secure');
					
					
				}
				 
                }
				
		/* End form */
		} //Elseif
	}
	
	public function fees($method = '') {
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
		
		if (empty($method)) {
			redirect('admin');
		}
		
		if ($method == 'deposit') {
		/* Form validate */
		$this->form_validation->set_rules('card_deposit_percentage_fees', $this->lang->line('admin_payment_fees_form_validate_flat_fees'), 'required|trim|numeric');
		if ($this->form_validation->run() == FALSE)
                {
        $data['title'] = $this->lang->line('admin_payment_fees_deposit_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/transaction/fees/deposit/home', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');      
                }
                else
                {
				if (!$this->admin_model->admin_settings($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('admin_setting_failed', TRUE);
					redirect('admin/fees/deposit');

				} else {
					
						$this->session->set_flashdata('admin_setting_success', TRUE);
						redirect('admin/fees/deposit');
					
					
				}
				 
                }
				
		/* End form */
		
		}elseif ($method == 'withdraw') {
			
			/* Form validate */
		$this->form_validation->set_rules('card_withdraw_percentage_fees', $this->lang->line('admin_payment_fees_form_validate_flat_fees'), 'required|trim|numeric');
		if ($this->form_validation->run() == FALSE)
                {
        $data['title'] = $this->lang->line('admin_payment_fees_withdraw_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/transaction/fees/withdraw/home', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');      
                }
                else
                {
				if (!$this->admin_model->admin_settings($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('admin_setting_failed', TRUE);
					redirect('admin/fees/withdraw');

				} else {
					
						$this->session->set_flashdata('admin_setting_success', TRUE);
						redirect('admin/fees/withdraw');
					
					
				}
				 
                }
				
		/* End form */
		}
	}
	
	
	public function method($method = '') {
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
		
		if (empty($method)) {
			redirect('admin');
		}
		
		if ($method == 'deposit') {
		/* Form validate */
		$checkbox = array('deposit_method_card',
		'deposit_method_bank',
		'deposit_method_mpesa',
		'deposit_method_tigopesa',
		'deposit_method_mtn',
		'deposit_method_orange',
		'deposit_method_paypal',
		'paypal_url_live',
		'deposit_method_bitcoin',
		'deposit_method_western');

					foreach ($checkbox as $value) {
						if (empty($this->input->post($value, TRUE))) {
							$_POST[$value] = '0';
						}
					}

		$this->form_validation->set_rules('deposit_method_card', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Card'));
		$this->form_validation->set_rules('deposit_method_bank', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Bank'));
		$this->form_validation->set_rules('deposit_method_mpesa', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'M-PESA'));
		$this->form_validation->set_rules('deposit_method_tigopesa', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'TIGO-PESA'));
		$this->form_validation->set_rules('deposit_method_mtn', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'MTN'));
		$this->form_validation->set_rules('deposit_method_orange', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'ORANGE'));
		$this->form_validation->set_rules('deposit_method_paypal', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Paypal'));
		$this->form_validation->set_rules('paypal_url_live', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Paypal live'));
		$this->form_validation->set_rules('deposit_method_bitcoin', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Bitcoin'));
		$this->form_validation->set_rules('deposit_method_western', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Western Union'));
					
		if ($this->form_validation->run() == FALSE)
                {
        $data['title'] = $this->lang->line('admin_payment_method_deposit_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/transaction/method/deposit/home', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');      
                }
                else
                {
				if (!$this->admin_model->admin_settings($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('admin_setting_failed', TRUE);
					redirect('admin/method/deposit');

				} else {
					
						$this->session->set_flashdata('admin_setting_success', TRUE);
						redirect('admin/method/deposit');
					
					
				}
				 
                }
				
		/* End form */
		
		}elseif ($method == 'withdraw') {
			
			/* Form validate */
		$checkbox = array('withdraw_method_card',
		'withdraw_method_bank',
		'withdraw_method_mpesa',
		'withdraw_method_tigopesa',
		'withdraw_method_mtn',
		'withdraw_method_orange',
		'withdraw_method_paypal',
		'withdraw_method_bitcoin',
		'withdraw_method_western',
		'withdraw_method_moneygram',
		'withdraw_method_perfectmoney',
		'withdraw_method_neteller',
		'withdraw_method_skrill',
		'withdraw_method_payza',
		'withdraw_method_payu');

					foreach ($checkbox as $value) {
						if (empty($this->input->post($value, TRUE))) {
							$_POST[$value] = '0';
						}
					}
		$this->form_validation->set_rules('withdraw_method_card', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Card'));
		$this->form_validation->set_rules('withdraw_method_bank', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Bank'));
		$this->form_validation->set_rules('withdraw_method_mpesa', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'M-PESA'));
		$this->form_validation->set_rules('withdraw_method_tigopesa', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'TIGO-PESA'));
		$this->form_validation->set_rules('withdraw_method_mtn', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'MTN'));
		$this->form_validation->set_rules('withdraw_method_orange', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'ORANGE'));
		$this->form_validation->set_rules('withdraw_method_paypal', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Paypal'));
		$this->form_validation->set_rules('withdraw_method_bitcoin', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Bitcoin'));
		$this->form_validation->set_rules('withdraw_method_western', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Western Union'));
		
		
		if ($this->form_validation->run() == FALSE)
                {
        $data['title'] = $this->lang->line('admin_payment_method_withdraw_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/transaction/method/withdraw/home', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');      
                }
                else
                {
				if (!$this->admin_model->admin_settings($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('admin_setting_failed', TRUE);
					redirect('admin/method/withdraw');

				} else {
					
						$this->session->set_flashdata('admin_setting_success', TRUE);
						redirect('admin/method/withdraw');
					
					
				}
				 
                }
				
		/* End form */
		}
	}
	
	
	public function selectaccount() {
		if (!$this->helper->user_islogin()) {
			redirect('myaccount');
		} elseif ($this->input->post('account', TRUE) == 1) {
			redirect('admin/adduser/personal');
		} elseif ($this->input->post('account', TRUE) == 2) {
			redirect('admin/adduser/business');
		}
		
		$data['title'] = $this->lang->line('admin_adduser_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/manage/adduser/account-choose', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');
	}
	
	public function addpersonal() {
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
		/* Form validate */
		$this->form_validation->set_rules('country', $this->lang->line('admin_adduser_personal_form_validate_country'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('email', $this->lang->line('admin_adduser_personal_form_validate_email'), 'trim|htmlspecialchars|max_length[250]|required|valid_email|is_unique[users.email]', array('is_unique' => $this->lang->line('admin_adduser_personal_form_validate_email_unique')));
		$this->form_validation->set_rules('first_name', $this->lang->line('admin_adduser_personal_form_validate_first_name'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('last_name', $this->lang->line('admin_adduser_personal_form_validate_last_name'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('mobile', $this->lang->line('admin_adduser_personal_form_validate_mobile'), 'numeric|trim|htmlspecialchars|max_length[30]|required|is_unique[users.mobile]', array('is_unique' => $this->lang->line('admin_adduser_personal_form_validate_mobile_unique')));
		$this->form_validation->set_rules('password', $this->lang->line('admin_adduser_personal_form_validate_password'), array('trim', 'htmlspecialchars', 'min_length[6]', 'regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/]', 'required'), array('regex_match' => $this->lang->line('admin_adduser_personal_form_password_strong')));
		$this->form_validation->set_rules('confim_password', $this->lang->line('admin_adduser_personal_form_validate_confim_password'), 'required|matches[password]|trim|htmlspecialchars');
		 
		if ($this->form_validation->run() == FALSE)
                {
        $data['title'] = $this->lang->line('admin_adduser_personal_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/manage/adduser/personal', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');      
                }
                else
                {
				if (!$this->admin_model->personal_add($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('personal_add_failed', TRUE);
					redirect('admin/adduser/personal');

				} else {
					
						$this->session->set_flashdata('personal_add_success', TRUE);
						redirect('admin/adduser/personal');
					
					
				}
				 
                }
				
		/* End form */
	}
	
	public function addbusiness() {
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
		/* Form validate */
				$this->form_validation->set_rules('email', $this->lang->line('admin_adduser_business_form_validate_email'), 'trim|htmlspecialchars|max_length[250]|required|valid_email|is_unique[users.email]', array('is_unique' => $this->lang->line('admin_adduser_business_form_validate_email_unique')));
		$this->form_validation->set_rules('country', $this->lang->line('admin_adduser_business_form_validate_country'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('city', $this->lang->line('admin_adduser_business_form_validate_city'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('state', $this->lang->line('admin_adduser_business_form_validate_state'), 'trim|htmlspecialchars');
		$this->form_validation->set_rules('postal_code', $this->lang->line('admin_adduser_business_form_validate_postal_code'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('first_name', $this->lang->line('admin_adduser_business_form_placeholder_first_name'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('last_name', $this->lang->line('admin_adduser_business_form_placeholder_last_name'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('business_name', $this->lang->line('admin_adduser_business_form_validate_business_name'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('address1', $this->lang->line('admin_adduser_business_form_validate_address1'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('address2', $this->lang->line('admin_adduser_business_form_validate_address2'), 'trim|htmlspecialchars');
		$this->form_validation->set_rules('mobile', $this->lang->line('admin_adduser_business_form_validate_mobile'), 'numeric|trim|htmlspecialchars|max_length[30]|required|is_unique[users.mobile]', array('is_unique' => $this->lang->line('admin_adduser_business_form_validate_mobile_unique')));
		$this->form_validation->set_rules('password', $this->lang->line('admin_adduser_business_form_validate_password'), array('trim', 'htmlspecialchars', 'min_length[6]', 'regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/]', 'required'), array('regex_match' => $this->lang->line('admin_adduser_business_form_password_strong')));
		$this->form_validation->set_rules('confim_password', $this->lang->line('admin_adduser_business_form_validate_confim_password'), 'required|matches[password]|trim|htmlspecialchars');
		 
		if ($this->form_validation->run() == FALSE)
                {
        $data['title'] = $this->lang->line('admin_adduser_busines_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/manage/adduser/business', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');      
                }
                else
                {
				if (!$this->admin_model->business_add($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('business_add_failed', TRUE);
					redirect('admin/adduser/business');

				} else {
					
						$this->session->set_flashdata('business_add_success', TRUE);
						redirect('admin/adduser/business');
					
					
				}
				 
                }
				
		/* End form */
	}
	
	public function manage() {
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
		 //pagination settings
        $config['base_url'] = site_url('admin/manage');
        $config['total_rows'] = $this->db->count_all('users');
        $config['per_page'] = '7';
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        // Show user
        $data['userlist'] = $this->admin_model->get_user_search($config["per_page"], $data['page'], NULL);
        $data['pagination'] = $this->pagination->create_links();
        
        $data['title'] = $this->lang->line('admin_manage_user_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/manage/search', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');
		
	}
	
	
	public function search_transaction() {
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
        // get search string
        $search = $this->input->post("transaction");

        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

        // pagination settings
        $config = array();
        $config['base_url'] = site_url("admin/transaction/$search");
        $config['total_rows'] = $this->admin_model->get_count_transaction_search($search);
        $config['per_page'] = '5';
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // Show user
        $data['userlist'] = $this->admin_model->get_all_transaction_search($config['per_page'], $data['page'], $search);

        $data['pagination'] = $this->pagination->create_links();
        
        $data['title'] = $this->lang->line('admin_all_transaction_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/transaction/all_transaction', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');
		
	}
	
	public function verification() {
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
		 //pagination settings
        $config['base_url'] = site_url('admin/verification');
        $config['total_rows'] = $this->admin_model->admin_pending_verification_count();
        $config['per_page'] = '7';
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        // Show verification
        $data['userlist'] = $this->admin_model->get_verification_search($config["per_page"], $data['page'], NULL);
        $data['pagination'] = $this->pagination->create_links();
        
		$this->form_validation->set_rules('id', 'ID', 'required|numeric');
        if ($this->form_validation->run() == FALSE) {
		$data['title'] = $this->lang->line('admin_verification_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/manage/verification', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');
		 
		 }else {
				if(isset($_POST['verification-approval'])){
				if (!$this->admin_model->verification_update($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('verification_approval_failed', TRUE);
					redirect('admin/verification');

				} else {
					
				// Account Verified
				if (!$this->admin_model->verification_verify_account($this->input->post(NULL, TRUE))) {
							
					$this->session->set_flashdata('verification_account_failed', TRUE);
					redirect('admin/verification');

				} else {
				
				// Email notification
				if ($this->site_settings->email_notification) {
					if ($this->input->post('card') == 1) {
							$email_body = $this->themename.'/layout/email/id-verification-approval';
						}elseif ($this->input->post('card') == 2) {
							$email_body = $this->themename.'/layout/email/address-verification-approval';
						}
					$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
    				$this->email->to($this->input->post('email'));
    				$this->email->subject(''.$this->lang->line('verification_submit_document_email_subject').' '.$this->site_settings->site_name.'');
    				$this->email->message($this->load->view($email_body, $data, TRUE));

    				$this->email->send();
					}
					
					
						// SMS Notification
							if ($this->site_settings->sms_notification) {
							//Infobip
							if ($this->site_settings->sms_infobip) {
							if ($this->input->post('card') == 1) {
							$sms_body = $this->lang->line('verification_submit_id_sms_subject');
						}elseif ($this->input->post('card') == 2) {
							$sms_body = $this->lang->line('verification_submit_address_sms_subject');
						}
							$to_number = $this->input->post('mobile');
							$this->helper->infobip_sms($to_number, $sms_body);
							}//End infobip
							
							// Twilio
							if ($this->site_settings->sms_twilio) {
						$sid = $this->site_settings->twilio_sid; // Your Account SID from www.twilio.com/console
						$token = $this->site_settings->twilio_token; // Your Auth Token from www.twilio.com/console

						$client = new Twilio\Rest\Client($sid, $token);
						if ($this->input->post('card') == 1) {
							$sms_body = $this->lang->line('verification_submit_id_sms_subject');
						}else {
							$sms_body = $this->lang->line('verification_submit_address_sms_subject');
						}
						$message = $client->messages->create(
						$this->input->post('mobile'), // Text this number
						array(
						'from' => $this->site_settings->twilio_number, // From a valid Twilio number
						'body' => $this->session->full_name.''.$sms_body.''
						)
						);
							}// End twilio
							}
						
						$this->session->set_flashdata('verification_approval_success', TRUE);
						redirect('admin/verification');
						
				}
					
					
				}
				}// isset
				
				if(isset($_POST['verification-cancel'])){
				if (!$this->admin_model->verification_cancel($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('verification_cancel_failed', TRUE);
					redirect('admin/verification');

				} else {
					
						// Email notification
				if ($this->site_settings->email_notification) {
					if ($this->input->post('card') == 1) {
							$email_body = $this->themename.'/layout/email/id-verification-cancel';
						}else {
							$email_body = $this->themename.'/layout/email/address-verification-cancel';
						}
					$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
    				$this->email->to($this->input->post('email'));
    				$this->email->subject(''.$this->lang->line('verification_cancel_document_email_subject').' '.$this->site_settings->site_name.'');
    				$this->email->message($this->load->view($email_body, $data, TRUE));

    				$this->email->send();
					}
					
					/*
					// SMS Notification
						if ($this->site_settings->sms_notification) {
							
						}
						*/
						
						// SMS Notification
							if ($this->site_settings->sms_notification) {
							//Infobip
							if ($this->site_settings->sms_infobip) {
							if ($this->input->post('card') == 1) {
							$sms_body = $this->lang->line('verification_cancel_id_sms_subject');
						}else {
							$sms_body = $this->lang->line('verification_cancel_address_sms_subject');
						}
							$to_number = $this->user->mobile;
							$this->helper->infobip_sms($to_number, $sms_body);
							}//End infobip
							
							// Twilio
							if ($this->site_settings->sms_twilio) {
						$sid = $this->site_settings->twilio_sid; // Your Account SID from www.twilio.com/console
						$token = $this->site_settings->twilio_token; // Your Auth Token from www.twilio.com/console

						$client = new Twilio\Rest\Client($sid, $token);
						if ($this->input->post('card') == 1) {
							$sms_body = $this->lang->line('verification_cancel_id_sms_subject');
						}else {
							$sms_body = $this->lang->line('verification_cancel_address_sms_subject');
						}
						$message = $client->messages->create(
						$this->input->post('mobile'), // Text this number
						array(
						'from' => $this->site_settings->twilio_number, // From a valid Twilio number
						'body' => $this->session->full_name.''.$sms_body.''
						)
						);
							}// End twilio
							}
						
						$this->session->set_flashdata('verification_cancel_success', TRUE);
						redirect('admin/verification');
					
					
				}
				}// isset
				 
             }
		
	}
	
	public function pending_transaction($method = '') {
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
		
		if (empty($method)) {
			redirect('admin');
	
		}elseif ($method == 'deposit') {
	
        //pagination settings
		 
        $config['base_url'] = site_url('admin/pending/deposit');
        $config['total_rows'] = $this->admin_model->admin_count_pending_deposit();
        $config['per_page'] = '10';
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        // Show user
        $data['pending'] = $this->admin_model->admin_pending_deposit($config["per_page"], $data['page'], NULL);
        $data['pagination'] = $this->pagination->create_links();
        
        if(isset($_POST['cancel-deposit'])){
			if (!$this->admin_model->admin_cancel_deposit_accept($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('pending_cancel_failed', TRUE);
					redirect('admin/pending/deposit');

				} else {

					$this->session->set_flashdata('pending_cancel_success', TRUE);


						redirect('admin/pending/deposit');

				}
		}else {
		$this->form_validation->set_rules('transaction_id', $this->lang->line('pending_deposit_form_transaction_id'), 'required|htmlspecialchars');

			if ($this->form_validation->run() == FALSE) {
		$data['title'] = $this->lang->line('admin_deposit_pending_transaction_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/transaction/pending_deposit_transaction', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');
		
		} else {
			
			if (!$this->admin_model->admin_pending_deposit_accept($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('pending_accept_deposit_failed', TRUE);
					redirect('admin/pending/deposit');

				} else {

					$this->session->set_flashdata('pending_accept_deposit_success', TRUE);


						redirect('admin/pending/deposit');

				}
		}
		}
		}elseif ($method == 'withdraw') {
			
			
        //pagination settings
		 
        $config['base_url'] = site_url('admin/pending/withdraw');
        $config['total_rows'] = $this->admin_model->admin_count_pending_withdrawal();
        $config['per_page'] = '10';
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        // Show user
        $data['pending'] = $this->admin_model->admin_pending_withdrawal($config["per_page"], $data['page'], NULL);
        $data['pagination'] = $this->pagination->create_links();
        
		if(isset($_POST['cancel-withdraw'])){
			if (!$this->admin_model->admin_cancel_withdrawal_accept($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('pending_cancel_failed', TRUE);
					redirect('admin/pending/withdraw');

				} else {

					$this->session->set_flashdata('pending_cancel_success', TRUE);


						redirect('admin/pending/withdraw');

				}
		}else {
        $this->form_validation->set_rules('transaction_id', $this->lang->line('pending_withdrawal_form_transaction_id'), 'required|htmlspecialchars');

			if ($this->form_validation->run() == FALSE) {
		$data['title'] = $this->lang->line('admin_withdrawal_pending_transaction_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/transaction/pending_withdraw_transaction', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');
		
		} else {
			
			if (!$this->admin_model->admin_pending_withdrawal_accept($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('pending_accept_withdrawal_failed', TRUE);
					redirect('admin/pending/withdraw');

				} else {

					$this->session->set_flashdata('pending_accept_withdrawal_success', TRUE);


						redirect('admin/pending/withdraw');

				}
		}
		}
		}
		 
		
	}
	
	function search()
    {
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
        // get search string
        $search = $this->input->post("user_name");

        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

        // pagination settings
        $config = array();
        $config['base_url'] = site_url("admin/search/$search");
        $config['total_rows'] = $this->admin_model->get_user_count_search($search);
        $config['per_page'] = "10";
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        // Show user
        $data['userlist'] = $this->admin_model->get_user_search($config['per_page'], $data['page'], $search);

        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = $this->lang->line('admin_manage_user_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/manage/search', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');
    }
	
	public function profile()
	{
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		} elseif (empty($this->userlist->id)) {
			redirect('myaccount');
		}
		
		$data['title'] = $this->lang->line('admin_profile_meta_title');
		$this->load->view($this->themename.'/layout/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/manage/profile', $data);
		$this->load->view($this->themename.'/layout/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/footer_end');
	}
	
	public function edit()
	{
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		} elseif (empty($this->userlist->id)) {
			redirect('myaccount');
		}
		
		if(isset($_POST['edit-user'])){
		$checkbox = array(
		'send_money',
		'request_money',
		'add_fund',
		'withdraw_fund',
		'verified');

					foreach ($checkbox as $value) {
						if (empty($this->input->post($value, TRUE))) {
							$_POST[$value] = '0';
						}
					}
		$this->form_validation->set_rules('user_send_money', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Send money'));
		$this->form_validation->set_rules('user_request_money', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Request money'));
		$this->form_validation->set_rules('add_fund', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Add Fund'));
		$this->form_validation->set_rules('withdraw_fund', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Withdraw Fund'));
		$this->form_validation->set_rules('verified', '', 'htmlspecialchars|in_list[1,0]', array('in_list' => 'Account Verified'));
		$this->form_validation->set_rules('first_name', $this->lang->line('admin_edit_user_form_first_name'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('last_name', $this->lang->line('admin_edit_user_form_last_name'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('country', $this->lang->line('admin_edit_user_form_country'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('email', $this->lang->line('admin_edit_user_form_email'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('mobile', $this->lang->line('admin_edit_user_form_mobile'), 'required|trim|numeric');
		$this->form_validation->set_rules('password', $this->lang->line('admin_editt_form_update_password'), 'trim|htmlspecialchars');
		}
		
		if(isset($_POST['deposit-fund'])){
		$this->form_validation->set_rules('name', $this->lang->line('admin_editt_form_add_deposit_bank_name'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('amount', $this->lang->line('admin_editt_form_add_deposit_amount'), 'required|trim|numeric');
		$this->form_validation->set_rules('date', $this->lang->line('admin_editt_form_add_deposit_date'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('txn_id', $this->lang->line('admin_editt_form_add_deposit_transaction_id'), 'trim|htmlspecialchars');
		$this->form_validation->set_rules('deposit_by', $this->lang->line('admin_editt_form_add_deposit_deposit_by'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('deposit_with', $this->lang->line('admin_editt_form_add_deposit_deposit_with'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('email', $this->lang->line('admin_editt_form_add_deposit_email'), 'required|trim|htmlspecialchars');
		}
		
		if(isset($_POST['withdraw-fund'])){
		$this->form_validation->set_rules('name', $this->lang->line('admin_editt_form_add_withdraw_bank_name'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('amount', $this->lang->line('admin_editt_form_add_withdraw_amount'), 'required|trim|numeric');
		$this->form_validation->set_rules('date', $this->lang->line('admin_editt_form_add_withdraw_date'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('txn_id', $this->lang->line('admin_editt_form_add_withdraw_transaction_id'), 'trim|htmlspecialchars');
		$this->form_validation->set_rules('withdraw_by', $this->lang->line('admin_editt_form_add_withdraw_withdraw_by'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('withdraw_with', $this->lang->line('admin_editt_form_add_withdraw_withdraw_with'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('email', $this->lang->line('admin_editt_form_add_withdraw_email'), 'required|trim|htmlspecialchars');
		}
		
		if ($this->form_validation->run() == FALSE)
                {
		$data['title'] = $this->lang->line('admin_edit_user_add_meta_title');
		$this->load->view($this->themename.'/layout/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/manage/edit', $data);
		$this->load->view($this->themename.'/layout/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/footer_end');
		
		}else {
				// edit user 
				
				if(isset($_POST['edit-user'])){
				if (!$this->admin_model->edit_user_update($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('edit_user_failed', TRUE);
					redirect('admin/edit?id='.$this->userlist->id.'');

				} else {
					
						$this->session->set_flashdata('edit_user_success', TRUE);
						redirect('admin/edit?id='.$this->userlist->id.'');
					
					
				}
				}
				// End edit user
				
			// Deposit fund
			
			if(isset($_POST['deposit-fund'])){
				
				if (!$this->admin_model->edit_user_payment_deposit($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('edit_user_failed', TRUE);
					redirect('admin/edit?id='.$this->userlist->id.'');

				} else {
					
						$this->session->set_flashdata('edit_user_success', TRUE);
						redirect('admin/edit?id='.$this->userlist->id.'');
					
					
				}
				
			}
			// End deposit fund
			
			// Withdraw fund
			
			if(isset($_POST['withdraw-fund'])){
				
				if (!$this->admin_model->edit_user_payment_withdraw($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('edit_user_failed', TRUE);
					redirect('admin/edit?id='.$this->userlist->id.'');

				} else {
					
						$this->session->set_flashdata('edit_user_success', TRUE);
						redirect('admin/edit?id='.$this->userlist->id.'');
					
					
				}
				
			}
			// End Withdraw fund
				 
                }
	}
	
	public function delete_user() {
		if ($this->user->account_type == 0) {
		if (!$this->admin_model->delete_user(trim($this->input->get('id', TRUE)))) {

			        $this->session->set_flashdata('admin_delete_user_failed', TRUE);
					redirect('admin/manage');

				} else {
						$this->session->set_flashdata('admin_delete_user_success', TRUE);
						redirect('admin/manage');
					
					
				}
	} else {
		redirect('myaccount');
	}
	}
	
	public function payment($method = '') {
		
		if (empty($method)) {
			redirect('admin');
		}
		
		if ($method == 'all') {
			
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
		
		//Get Total Records Count
        $this->db->select("*");
        $this->db->from("transactions");
        
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
            $config["base_url"] = base_url('admin/payment/all?transaction=' . $this->input->get('transaction', TRUE));
        } else {
            $config["base_url"] = base_url('admin/payment/all?transaction=&'.$this->input->get('start', TRUE).'&'.$this->input->get('end', TRUE).'');
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
		
		$this->db->limit($limit, $offset);
        $transactionresult = $this->db->get();
		$data['title'] = $this->lang->line('admin_payment_page_all_meta_title');
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
        $this->load->view($this->themename.'/layout/admin/transaction/activity/home', array(
            'totalResult' => $totalRecords,
            'transaction' => $transactionresult->result(),
            'links' => $links
        ));
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		}elseif ($method == 'add') {
			
			if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
		
		$this->form_validation->set_rules('amount', $this->lang->line('admin_payment_page_add_form_amount'), 'required|trim|numeric');
		$this->form_validation->set_rules('email', $this->lang->line('admin_payment_page_add_form_email'), 'trim|htmlspecialchars|callback_send_payment_email_validate');
		$this->form_validation->set_rules('payment_type', $this->lang->line('admin_payment_page_add_form_payment_type'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('status_type', $this->lang->line('admin_payment_page_add_form_status_type'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('note', $this->lang->line('admin_payment_page_add_form_note'), 'trim|htmlspecialchars');

			if ($this->form_validation->run() == FALSE) {
		$data['title'] = $this->lang->line('admin_payment_page_add_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/transaction/add_transaction', $data);
		$this->load->view($this->themename.'/layout/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/footer_end');
		
		} else {
			
			if ($this->input->post('payment_type', TRUE) == 'Deposit') {
				$payment_type_post = $this->admin_model->add_payment_deposit($this->input->post(NULL, TRUE));
			}else {
				$payment_type_post = $this->admin_model->add_payment_send($this->input->post(NULL, TRUE));
			}
			
			if (!$payment_type_post) {

			        $this->session->set_flashdata('payment_add_failed', TRUE);
					redirect('admin/payment/add');

				} else {

					$this->session->set_flashdata('payment_add_success', TRUE);


						redirect('admin/payment/add');

				}
		}
		
		//isset
			
		}
	}
	
	public function refund() {
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
		
		if (isset($_POST['refund'])) {
		$senderget = $this->core_model->core_get_user_with_email($this->input->post('sender_email'));
		$receiverget = $this->core_model->core_get_user_with_email($this->input->post('receiver_email'));
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
		
		'sender' => $senderget->id,
		'sender_name' => $sender_name,
		'sender_email' => $senderget->email,
		'receiver' => $receiverget->email,
		'receiver_name' => $receiver_name,
		'receiver_email' => $receiverget->email,
		'receiver_mobile' => $receiverget->mobile,
		'status' => 'Processed',
		'payment_type' => 'refund',
		'amount' => $this->input->post('amount'),
		'userid' => $senderget->id,
		'dispute' => '0',
		'date' => time(),
		'note' => 'Payment Refund'
			);
        
		$complete = $this->core_model->refund_money_with_card($storedata);
		if ($complete) {
		$this->session->set_flashdata('payment_refund_success', $this->lang->line('payment_refund_success'));
		redirect('admin/payment/all');	
		}else {
		$this->session->set_flashdata('payment_refund_failed', $this->lang->line('payment_refund_failed'));
		redirect('admin/payment/all');	
		}
		
		}elseif (isset($_POST['cancel'])) {
			
		$senderget = $this->core_model->core_get_user_with_email($this->input->post('sender_email'));
		$receiverget = $this->core_model->core_get_user_with_email($this->input->post('receiver_email'));
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
		
		'status' => 'Cancel',
		'payment_type' => 'Cancel',
		'date' => time(),
		'note' => ''
			);
        
		$complete = $this->core_model->refund_money_with_card($storedata);
		if ($complete) {
		$this->session->set_flashdata('payment_cancel_success', $this->lang->line('payment_cancel_success'));
		redirect('admin/payment/all');	
		}else {
		$this->session->set_flashdata('payment_cancel_failed', $this->lang->line('payment_cancel_failed'));
		redirect('admin/payment/all');	
		}	
		}
		
	}
	
	/* Send receipt validate Form callback validate
	*/
	public function send_payment_email_validate() {
	if (empty(trim($this->input->post('email', TRUE)))) {
		$this->form_validation->set_message('send_payment_email_validate', $this->lang->line('send_payment_email_validate_empty_value'));
		return FALSE;
	} else {
		// validate value Email, Username and Mobile
		$usercheck = $this->core_model->core_get_user_with_email($this->input->post('email', TRUE));
		if ($usercheck == FALSE) {
		$this->form_validation->set_message('send_payment_email_validate', $this->lang->line('send_payment_email_validate_no_email_mobile'));
		return FALSE;
		 // End validate value
		} else {
		$user_check = $this->core_model->core_get_user_with_email($this->input->post('email', TRUE));
		if ($this->input->post('next_email', TRUE) == $this->session->email) {
		$this->form_validation->set_message('send_payment_email_validate', $this->lang->line('send_payment_email_validate_yourself'));
		return FALSE;
		} else {
		$user_check = $this->core_model->core_get_user_with_email($this->input->post('email', TRUE));
		if ($this->session->mobile == $this->input->post('next_email', TRUE)) {
		$this->form_validation->set_message('send_payment_email_validate', $this->lang->line('send_payment_email_validate_yourself'));
		return FALSE;
		}

		}
	}
	}
	}
	
	public function bank_verification() {

        if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
		
		$limit_per_page = 10;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
        $total_records = $this->admin_model->count_all_pending_bank_verification();
     
        
		if ($total_records > 0)
        {
            // get current page records
            $data["list_pending_verification"] = $this->admin_model->get_pending_bank_verification($limit_per_page, $page*$limit_per_page);
                 
            $config['base_url'] = base_url() . 'admin/bank_verification';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 3;
             
            $config['num_links'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
			$this->pagination->initialize($config);
                 
            // pagination links
            $data["pagination"] = $this->pagination->create_links();
        }
     
        $this->form_validation->set_rules('account', 'account', 'required|trim|htmlspecialchars');
		if ($this->form_validation->run() == FALSE) {
		$data['title'] = $this->lang->line('admin_bank_verification_meta_title');
		
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/manage/bank_verification', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');
		}else {
			
			// Approval bank verification
			if(isset($_POST['approval-bank-verification'])) {
			if (!$this->admin_model->update_bank_verification($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('approval_bank_verification_failed', TRUE);
				redirect('admin/bank_verification');

			} else {

				$this->admin_model->update_bank_account($this->input->post(NULL, TRUE));
				$this->session->set_flashdata('approval_bank_verification_success', TRUE);


					redirect('admin/bank_verification');

			}
			}
			
			// Cancel bank verification
			if(isset($_POST['cancel-bank-verification'])) {
			if (!$this->admin_model->cancel_bank_verification($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('cancel_bank_verification_failed', TRUE);
				redirect('admin/bank_verification');

			} else {

				$this->admin_model->delete_bank_account($this->input->post(NULL, TRUE));
				$this->session->set_flashdata('cancel_bank_verification_success', TRUE);


					redirect('admin/bank_verification');

			}
			}
			
			
		}// Validate form
		
		
    }
}
