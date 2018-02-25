<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/twilio-php-master/Twilio/autoload.php');
class User extends CI_Controller {


     public function __construct() {

        parent::__construct();

        $this->load->model('core_model');

    	// Get core Site settings
		$this->site_settings = $this->core_model->get_bk_core_settings();
		$this->load->library('form_validation');

		// Get theme path
		$this->themename = $this->core_model->get_core_bk_theme_name();

		// Language file
		$this->lang->load(array('signup', 'signin'));
	 }

	public function index()
	{
		if ($this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} else {
			redirect('myaccount');
		}

		$data['title'] = $this->lang->line('signin_meta_title');
		$this->load->view($this->themename.'/layout/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/header_navbar');
		$this->load->view($this->themename.'/layout/signin/signin', $data);
		$this->load->view($this->themename.'/layout/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/footer_end');
	}

	public function selectaccount() {
		if ($this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->input->post('account', TRUE) == 1) {
			redirect('signup/personal');
		} elseif ($this->input->post('account', TRUE) == 2) {
			redirect('signup/business/start');
		}
		
		if ($this->site_settings->user_register == 0) {
			redirect('myaccount/signin');
		}

		$data['title'] = $this->lang->line('select_account_meta_title');
		$this->load->view($this->themename.'/layout/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/header_navbar');
		$this->load->view($this->themename.'/layout/account-choose', $data);
		$this->load->view($this->themename.'/layout/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/footer_end');
	}

	public function personal() {
		if ($this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->site_settings->user_register == 0) {
			redirect('myaccount/signin');
		}
		
		/* Form validate */
		$this->form_validation->set_rules('country', $this->lang->line('signup_personal_form_validate_country'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('email', $this->lang->line('signup_personal_form_validate_email'), 'trim|htmlspecialchars|max_length[250]|required|valid_email|is_unique[users.email]', array('is_unique' => $this->lang->line('signup_personal_form_validate_email_unique')));
		$this->form_validation->set_rules('first_name', $this->lang->line('signup_personal_form_validate_first_name'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('last_name', $this->lang->line('signup_personal_form_validate_last_name'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('mobile', $this->lang->line('signup_personal_form_validate_mobile'), 'numeric|trim|htmlspecialchars|max_length[30]|required|is_unique[users.mobile]', array('is_unique' => $this->lang->line('signup_personal_form_validate_mobile_unique')));
		$this->form_validation->set_rules('password', $this->lang->line('signup_personal_form_validate_password'), array('trim', 'htmlspecialchars', 'min_length[6]', 'regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/]', 'required'), array('regex_match' => $this->lang->line('signup_personal_form_password_strong')));
		$this->form_validation->set_rules('confim_password', $this->lang->line('signup_personal_form_validate_confim_password'), 'required|matches[password]|trim|htmlspecialchars');
		 if ($this->form_validation->run() == FALSE)
                {
        $data['title'] = $this->lang->line('signup_personal_meta_title');
		$this->load->view($this->themename.'/layout/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/header_navbar');
		$this->load->view($this->themename.'/layout/signup/personal', $data);
		$this->load->view($this->themename.'/layout/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/footer_end');
                }
                else
                {
				if (!$this->core_model->personal_signup($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('personal_account_signup_failed', TRUE);
					redirect('signup/personal');

				} else {
                    
					// User sessions store
					$newuser = $this->core_model->core_get_user_with_email($this->input->post('email', TRUE));
					$this->session->id = $newuser->id;
					$this->session->country = $newuser->country;
					$this->session->email = $newuser->email;
					$this->session->full_name = $newuser->full_name;
					$this->session->mobile = $newuser->mobile;
					$this->session->account_type = $newuser->account_type;

					// Personal Register email

                    if ($this->site_settings->email_notification) {
					$data['email'] = $newuser->email;
					$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
    				$this->email->to($newuser->email);
    				$this->email->subject('Welcome to '.$this->site_settings->site_name.'');
    				$this->email->message($this->load->view($this->themename.'/layout/email/signup-personal', $data, TRUE));

    				$this->email->send();
					}
					
					// SMS Notification
						if ($this->site_settings->sms_notification) {
							//Infobip
							if ($this->site_settings->sms_infobip) {
							$to_number = $newuser->mobile;
							$sms_body = $newuser->full_name.''.$this->lang->line('signup_personal_form_signup_success').'';
							$this->helper->infobip_sms($to_number, $sms_body);
							}//End infobip
							
							// Twilio
							if ($this->site_settings->sms_twilio) {
						$sid = $this->site_settings->twilio_sid; // Your Account SID from www.twilio.com/console
						$token = $this->site_settings->twilio_token; // Your Auth Token from www.twilio.com/console

						$client = new Twilio\Rest\Client($sid, $token);
						$message = $client->messages->create(
						$newuser->mobile, // Text this number
						array(
						'from' => $this->site_settings->twilio_number, // From a valid Twilio number
						'body' => $newuser->full_name.''.$this->lang->line('signup_personal_form_signup_success').''
						)
						);
							}// End twilio
							}
						
						
					$this->session->set_flashdata('signup_personal_account_success', TRUE);
						redirect('myaccount');


				}

                }

		/* End form */
	}

	public function business($page_type) {

		if ($this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->site_settings->user_register == 0) {
			redirect('myaccount/signin');
		}
		
		if (empty($page_type)) {
			redirect('signup');

		} elseif ($page_type == 'start') {

		
		/* Form validate */
		$this->form_validation->set_rules('email', $this->lang->line('signup_business_account_form_validate_email'), 'trim|htmlspecialchars|max_length[250]|required|valid_email|is_unique[users.email]', array('is_unique' => $this->lang->line('signup_business_account_form_validate_email_unique')));

		 if ($this->form_validation->run() == FALSE)
                {
		$data['title'] = $this->lang->line('signup_business_start_title');
		$this->load->view($this->themename.'/layout/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/header_navbar');
		$this->load->view($this->themename.'/layout/signup/business/start', $data);
		$this->load->view($this->themename.'/layout/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/footer_end');

				} else  {
						$this->session->start_email = $this->input->post('email', TRUE);
						redirect('signup/business/create');
				}
		} elseif ($page_type == 'create') {

		
			/* Form validate */
		$this->form_validation->set_rules('email', $this->lang->line('signup_business_account_create_form_validate_email'), 'trim|htmlspecialchars|max_length[250]|required|valid_email|is_unique[users.email]', array('is_unique' => $this->lang->line('signup_business_account_create_form_validate_email_unique')));
		$this->form_validation->set_rules('country', $this->lang->line('signup_business_account_create_form_validate_country'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('city', $this->lang->line('signup_business_account_create_form_validate_city'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('state', $this->lang->line('signup_business_account_create_form_validate_state'), 'trim|htmlspecialchars');
		$this->form_validation->set_rules('postal_code', $this->lang->line('signup_business_account_create_form_validate_postal_code'), 'trim|htmlspecialchars');
		$this->form_validation->set_rules('first_name', $this->lang->line('signup_business_form_validate_first_name'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('last_name', $this->lang->line('signup_business_form_validate_last_name'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('business_name', $this->lang->line('signup_business_account_create_form_validate_business_name'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('address1', $this->lang->line('signup_business_account_create_form_validate_address1'), 'required|trim|htmlspecialchars');
		$this->form_validation->set_rules('address2', $this->lang->line('signup_business_account_create_form_validate_address2'), 'trim|htmlspecialchars');
		$this->form_validation->set_rules('mobile', $this->lang->line('signup_business_account_create_form_validate_mobile'), 'numeric|trim|htmlspecialchars|max_length[30]|required|is_unique[users.mobile]', array('is_unique' => $this->lang->line('signup_business_account_create_form_validate_mobile_unique')));
		$this->form_validation->set_rules('password', $this->lang->line('signup_business_account_create_form_validate_password'), array('trim', 'htmlspecialchars', 'min_length[6]', 'regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/]', 'required'), array('regex_match' => $this->lang->line('signup_business_account_create_form_password_strong')));
		$this->form_validation->set_rules('confim_password', $this->lang->line('signup_business_account_create_form_validate_confim_password'), 'required|matches[password]|trim|htmlspecialchars');

		 if ($this->form_validation->run() == FALSE)
                {
		$data['title'] = $this->lang->line('signup_business_create_title');
		$this->load->view($this->themename.'/layout/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/header_navbar');
		$this->load->view($this->themename.'/layout/signup/business/create', $data);
		$this->load->view($this->themename.'/layout/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/footer_end');

				} else  {

					if (!$this->core_model->business_signup($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('signup_business_account_failed', TRUE);
					redirect('signup/personal');

				} else {
					// User sessions store
					$new_business_user = $this->core_model->core_get_user_with_email($this->input->post('email', TRUE));
					$this->session->id = $new_business_user->id;
					$this->session->country = $new_business_user->country;
					$this->session->email = $new_business_user->email;
					$this->session->full_name = $new_business_user->full_name;
					$this->session->mobile = $new_business_user->mobile;
					$this->session->account_type = $new_business_user->account_type;

					// Business Register email

                    $data['business'] = $new_business_user->business_name;
					$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
    				$this->email->to($new_business_user->email);
    				$this->email->subject('Welcome to '.$this->site_settings->site_name.'');
    				$this->email->message($this->load->view($this->themename.'/layout/email/signup-business', $data, TRUE));

    				$this->email->send();
					
					// SMS Notification
						if ($this->site_settings->sms_notification) {
							//Infobip
							if ($this->site_settings->sms_infobip) {
							$to_number = $new_business_user->mobile;
							$sms_body = $new_business_user->full_name.''.$this->lang->line('signup_personal_form_signup_success').'';
							$this->helper->infobip_sms($to_number, $sms_body);
							}//End infobip
							
							// Twilio
							if ($this->site_settings->sms_twilio) {
						$sid = $this->site_settings->twilio_sid; // Your Account SID from www.twilio.com/console
						$token = $this->site_settings->twilio_token; // Your Auth Token from www.twilio.com/console

						$client = new Twilio\Rest\Client($sid, $token);
						$message = $client->messages->create(
						$new_business_user->mobile, // Text this number
						array(
						'from' => $this->site_settings->twilio_number, // From a valid Twilio number
						'body' => $new_business_user->full_name.''.$this->lang->line('signup_personal_form_signup_success').''
						)
						);
							}// End twilio
							}
						
					$this->session->set_flashdata('signup_business_account_success', TRUE);
						redirect('business');


				}

				}
		}

	}


	public function signin() {
		if ($this->helper->user_islogin()) {
			redirect('myaccount');
		}
		/* Form validate */
		$this->form_validation->set_rules('email_username_mobile', $this->lang->line('signup_personal_form_validate_email'), 'trim|htmlspecialchars|callback_signin_form_check_validate');
		$this->form_validation->set_rules('password', $this->lang->line('signup_personal_form_validate_email'), 'trim|htmlspecialchars');

		 if ($this->form_validation->run() == FALSE)
                {
        $data['title'] = $this->lang->line('signin_meta_title');
		$this->load->view($this->themename.'/layout/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/signin/signin', $data);
		$this->load->view($this->themename.'/layout/globe/footer_end');
                }
                else
                {
					$userlogin = $this->core_model->core_get_user_with_email($this->input->post('email_username_mobile', TRUE));
				if ($userlogin->status == 0) {

			        $this->session->set_flashdata('signin_account_delete_failed', TRUE);
					redirect('myaccount/signin');

				} else {
					// User sessions store
					$usersession = $this->core_model->core_get_user_with_email($this->input->post('email_username_mobile', TRUE));
					$this->session->id = $usersession->id;
					$this->session->country = $usersession->country;
					$this->session->email = $usersession->email;
					$this->session->full_name = $usersession->full_name;
					$this->session->mobile = $usersession->mobile;
					$this->session->account_type = $usersession->account_type;

						$this->session->set_flashdata('personal_account_signup_success', TRUE);
						redirect('myaccount');


				}

                }

		/* End form */
	}

	
	public function signin_ipn() {
		if ($this->helper->user_islogin()) {
			redirect('myaccount');
		}
		/* Form validate */
		$this->form_validation->set_rules('email_username_mobile', $this->lang->line('signup_personal_form_validate_email'), 'trim|htmlspecialchars|callback_signin_form_check_validate');
		$this->form_validation->set_rules('password', $this->lang->line('signup_personal_form_validate_email'), 'trim|htmlspecialchars');

		 if ($this->form_validation->run() == FALSE)
                {
        echo validation_errors();
                }
                else
                {
					$userlogin = $this->core_model->core_get_user_with_email($this->input->post('email_username_mobile', TRUE));
				if ($userlogin->status == 0) {

			        echo $this->lang->line('signin_account_inactive_account');

				} else {
					$this->core_model->two_fator_login_code_update();
					
					$usersession = $this->core_model->core_get_user_with_email($this->input->post('email_username_mobile', TRUE));
					$this->session->email_store = $usersession->email;
					// Two-factor authentication
					if ($this->site_settings->two_factor_login == 1) {
						// SMS Notification
					if ($this->site_settings->sms_notification) {
							$get_code_sent = $this->core_model->core_get_user_with_email($this->input->post('email_username_mobile', TRUE));
							//Infobip
							if ($this->site_settings->sms_infobip) {
							$to_number = $get_code_sent->mobile;
							$sms_body = $this->lang->line('signin_form_submit_sms_code_sent_subject').' '.$get_code_sent->code.'';
							$this->helper->infobip_sms($to_number, $sms_body);
							}//End infobip
							
							// Twilio
							if ($this->site_settings->sms_twilio) {
							$sid = $this->site_settings->twilio_sid; // Your Account SID from www.twilio.com/console
							$token = $this->site_settings->twilio_token; // Your Auth Token from www.twilio.com/console

							$client = new Twilio\Rest\Client($sid, $token);
							$message = $client->messages->create(
							  $get_code_sent->mobile, // Text this number
							  array(
							    'from' => $this->site_settings->twilio_number, // From a valid Twilio number
							    'body' => $this->lang->line('signin_form_submit_sms_code_sent_subject').' '.$get_code_sent->code.''
							  )
							);
							}// End twilio
							}
					echo 'sms';
					
					}else {
						
					// User sessions store
					$usersession = $this->core_model->core_get_user_with_email($this->input->post('email_username_mobile', TRUE));
					$this->session->id = $usersession->id;
					$this->session->country = $usersession->country;
					$this->session->email = $usersession->email;
					$this->session->full_name = $usersession->full_name;
					$this->session->mobile = $usersession->mobile;
					$this->session->account_type = $usersession->account_type;

					echo 'success';	
					}


				}

                }

		/* End form */
	}
	
	public function submit_signin_sms() {
		if ($this->helper->user_islogin()) {
			redirect('myaccount');
		}
		
		$this->form_validation->set_rules('pin', 'Code', 'trim|htmlspecialchars|max_length[6]|callback_signin_two_factor_code_validate');
		 if ($this->form_validation->run() == FALSE)
                {
		echo validation_errors();
                }else {
				
				// User sessions store
				$usersession = $this->core_model->core_get_user_with_email($this->session->email_store);
				$this->session->id = $usersession->id;
				$this->session->country = $usersession->country;
				$this->session->email = $usersession->email;
				$this->session->full_name = $usersession->full_name;
				$this->session->mobile = $usersession->mobile;
				$this->session->account_type = $usersession->account_type;
                echo 'success';		
				}
	}
	
	/* Signin sms code callback validate
	*/
	public function signin_two_factor_code_validate() {
	$usercheck = $this->core_model->core_get_user_with_code_or_pin_validate($this->input->post('pin', TRUE));
		if (empty(trim($this->input->post('pin', TRUE)))) {
			$this->form_validation->set_message('signin_two_factor_code_validate', $this->lang->line('signin_form_submit_sms_code_not_correct'));
		return FALSE;
		} elseif ($usercheck == FALSE) {
		$this->form_validation->set_message('signin_two_factor_code_validate', $this->lang->line('signin_form_submit_sms_code_not_available'));
		return FALSE;
		}
	}
	

	/* Signin Form callback validate
	*/
	public function signin_form_check_validate() {
	if (empty(trim($this->input->post('email_username_mobile', TRUE))) || empty(trim($this->input->post('password', TRUE)))) {
		$this->form_validation->set_message('signin_form_check_validate', $this->lang->line('signin_form_validate_empty_value'));
		return FALSE;
	} else {
		// validate value Email, Username and Mobile
		$usercheck = $this->core_model->core_get_user_with_email($this->input->post('email_username_mobile', TRUE));
		if ($usercheck == FALSE) {
		$this->form_validation->set_message('signin_form_check_validate', $this->lang->line('signin_form_validate_no_username_email_mobile'));
		return FALSE;
		 // End validate value
		} else {
		$user_check = $this->core_model->core_get_user_with_email($this->input->post('email_username_mobile', TRUE));
		if (!password_verify(trim($this->input->post('password', TRUE)), $user_check->password)) {
		$this->form_validation->set_message('signin_form_check_validate', $this->lang->line('signin_form_validate_no_password_pin'));
		return FALSE;
		}

		}
	}
	}

	public function forgot($page_type) {
		if ($this->helper->user_islogin()) {
			redirect('myaccount');

		} elseif ($page_type == 'look') {
			/* Form validate */
		$this->form_validation->set_rules('email_mobile', $this->lang->line('forgot_form_validate_email_mobile'), 'trim|htmlspecialchars|max_length[250]|callback_forgot_email_phone_validate');

		 if ($this->form_validation->run() == FALSE)
                {
		$data['title'] = $this->lang->line('forgot_meta_title');
		$this->load->view($this->themename.'/layout/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/header_navbar');
		$this->load->view($this->themename.'/layout/signin/forgot/look', $data);
		$this->load->view($this->themename.'/layout/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/footer_end');

				} else  {
						$this->session->email_mobile = $this->input->post('email_mobile', TRUE);
						redirect('myaccount/forgot/comfirm');
				}
		} elseif ($page_type == 'comfirm') {

			if ($this->session->email_mobile) {
		$data['userdata'] = $this->core_model->core_get_user_with_email($this->session->email_mobile);
		$data['title'] = $this->lang->line('forgot_confirm_meta_title');
		$this->load->view($this->themename.'/layout/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/header_navbar');
		$this->load->view($this->themename.'/layout/signin/forgot/comfirm', $data);
		$this->load->view($this->themename.'/layout/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/footer_end');

			} else {
				redirect('myaccount/forgot');
			}

		} elseif ($page_type == 'resend') {
			if ($this->session->email_mobile) {
				if (!$this->core_model->forgot_password_code_send()) {

			        $this->session->set_flashdata('forgot_password_code_send_failed', TRUE);
					redirect('myaccount/forgot/comfirm');

				} else {
					// Email Reset password code

                    if ($this->site_settings->email_notification) {
					$data['reset'] = $this->core_model->core_get_user_with_email($this->session->email_mobile);
					$this->email->from($this->site_settings->email_notification_email, $this->site_settings->site_name);
    				$this->email->to($this->session->email);
    				$this->email->subject(''.$this->lang->line('reset_code_email_subject').' '.$this->site_settings->site_name.'');
    				$this->email->message($this->load->view($this->themename.'/layout/email/reset-pin', $data, TRUE));

    				$this->email->send();
					}
					
					// SMS Notification
					if ($this->site_settings->sms_notification) {
							$get_code_sent = $this->core_model->core_get_user_with_email($this->session->email_mobile);
							//Infobip
							if ($this->site_settings->sms_infobip) {
							$to_number = $get_code_sent->mobile;
							$sms_body = $this->lang->line('reset_code_sms_subject').' '.$get_code_sent->code.'';
							$this->helper->infobip_sms($to_number, $sms_body);
							}//End infobip
							
							// Twilio
							if ($this->site_settings->sms_twilio) {
							$sid = $this->site_settings->twilio_sid; // Your Account SID from www.twilio.com/console
							$token = $this->site_settings->twilio_token; // Your Auth Token from www.twilio.com/console

							$client = new Twilio\Rest\Client($sid, $token);
							$message = $client->messages->create(
							  $get_code_sent->mobile, // Text this number
							  array(
							    'from' => $this->site_settings->twilio_number, // From a valid Twilio number
							    'body' => $this->lang->line('reset_code_sms_subject').' '.$get_code_sent->code.''
							  )
							);
							}// End twilio
							}
					$this->session->set_flashdata('forgot_password_code_send_success', TRUE);
						redirect('myaccount/forgot/change');


				}
			} else {
				redirect('myaccount/forgot');
			}
		} elseif ($page_type == 'change') {
			if ($this->session->email_mobile) {
			$this->form_validation->set_rules('pin', $this->lang->line('forgot_form_validate_email_mobile'), 'trim|htmlspecialchars|max_length[6]|callback_forgot_code_validate');

		 if ($this->form_validation->run() == FALSE)
                {

		$data['userdata'] = $this->core_model->core_get_user_with_email($this->session->email_mobile);
		$data['title'] = $this->lang->line('forgot_change_meta_title');
		$this->load->view($this->themename.'/layout/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/header_navbar');
		$this->load->view($this->themename.'/layout/signin/forgot/change', $data);
		$this->load->view($this->themename.'/layout/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/footer_end');


				} else {
				$this->session->code_sent = 'codesent';
				redirect('myaccount/forgot/newpassword');
			}
			} else {

				if ($this->session->code_sent) {
				redirect('myaccount/newpassword');
				} else {
					redirect('myaccount/forgot');
				}
			}
		} elseif ($page_type == 'newpassword') {

			if ($this->session->code_sent) {
		$this->form_validation->set_rules('password', $this->lang->line('forgot_reset_form_validate_password'), array('trim', 'htmlspecialchars', 'min_length[6]', 'regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/]', 'required'), array('regex_match' => $this->lang->line('forgot_reset_form_password_strong')));
		$this->form_validation->set_rules('confirm_password', $this->lang->line('forgot_reset_form_validate_confirm_password'), 'required|matches[password]|trim|htmlspecialchars');

		 if ($this->form_validation->run() == FALSE)
                {

		$data['userdata'] = $this->core_model->core_get_user_with_email($this->session->email_mobile);
		$data['title'] = $this->lang->line('forgot_new_password_meta_title');
		$this->load->view($this->themename.'/layout/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/header_navbar');
		$this->load->view($this->themename.'/layout/signin/forgot/newpassword', $data);
		$this->load->view($this->themename.'/layout/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/footer_end');


				} else {
				if (!$this->core_model->forgot_password_change($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('forgot_password_reset_failed', TRUE);
					redirect('myaccount/forgot/comfirm');

				} else {
					// User sessions store
					$usersession = $this->core_model->core_get_user_with_email($this->session->email_mobile);
					$this->session->id = $usersession->id;
					$this->session->country = $usersession->country;
					$this->session->email = $usersession->email;
					$this->session->full_name = $usersession->full_name;
					$this->session->mobile = $usersession->mobile;
					$this->session->account_type = $usersession->account_type;

					redirect('myaccount');

				}
			}
			} else {
				redirect('myaccount/forgot');
			}
		}
	}

	/* Forgot password callback validate
	*/
	public function forgot_email_phone_validate() {
	$usercheck = $this->core_model->core_get_user_with_email($this->input->post('email_mobile', TRUE));
		if ($usercheck == FALSE) {
		$this->form_validation->set_message('forgot_email_phone_validate', $this->lang->line('forgot_form_validate_no_email_mobile'));
		return FALSE;
		}
	}

	/* Forgot password rest code callback validate
	*/
	public function forgot_code_validate() {
	$usercheck = $this->core_model->core_user_forgot_code_validate($this->input->post('pin', TRUE));
		if (empty(trim($this->input->post('pin', TRUE)))) {
			$this->form_validation->set_message('forgot_code_validate', $this->lang->line('forgot_change_form_code_validate_empty'));
		return FALSE;
		} elseif ($usercheck == FALSE) {
		$this->form_validation->set_message('forgot_code_validate', $this->lang->line('forgot_change_form_code_validate'));
		return FALSE;
		}
	}

	public function logout() {
		if ($this->helper->user_islogin()) {
		$this->helper->logout();
		$this->session->set_flashdata('logout_account_success', TRUE);
		redirect('/');
		} else {
			redirect('/');
		}

	}



}
