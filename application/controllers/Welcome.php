<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


     public function __construct() {

        parent::__construct();

        $this->load->model('core_model');

    	// Get core Site settings
		$this->site_settings = $this->core_model->get_bk_core_settings();

		// Get theme path
		$this->themename = $this->core_model->get_core_bk_theme_name();

		// Language file
		$this->lang->load(array('welcome', 'signin'));
		
		// Form validation
		$this->load->library('form_validation');
	 }

	public function index()
	{
		if ($this->helper->user_islogin()) {
			redirect('myaccount');
		}

		$data['title'] = $this->lang->line('welcome_meta_title');
		$this->load->view($this->themename.'/layout/globe/welcome/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/welcome/header_navbar');
		$this->load->view($this->themename.'/layout/welcome/home', $data);
		$this->load->view($this->themename.'/layout/globe/welcome/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/welcome/footer_end');
	}
	
	public function page($method = '') {
		if (empty($method)) {
			redirect('myaccount');
		}
		
		if ($method == 'personal') {
		
		$data['title'] = $this->lang->line('welcome_page_personal_meta_title');
		$this->load->view($this->themename.'/layout/globe/welcome/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/welcome/header_navbar');
		$this->load->view($this->themename.'/layout/welcome/page/personal', $data);
		$this->load->view($this->themename.'/layout/globe/welcome/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/welcome/footer_end');
		
		}elseif ($method == 'business') {
		$data['title'] = $this->lang->line('welcome_page_business_meta_title');
		$this->load->view($this->themename.'/layout/globe/welcome/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/welcome/header_navbar');
		$this->load->view($this->themename.'/layout/welcome/page/business', $data);
		$this->load->view($this->themename.'/layout/globe/welcome/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/welcome/footer_end');
		
		}elseif ($method == 'help') {
		
		/* Form validate */
			$this->form_validation->set_rules('name', $this->lang->line('welcome_page_help_cover_image_form_modal_email_name'), 'required|htmlspecialchars');
			$this->form_validation->set_rules('subject', $this->lang->line('welcome_page_help_cover_image_form_modal_email_subject'), 'required|htmlspecialchars');
			$this->form_validation->set_rules('email', $this->lang->line('welcome_page_help_cover_image_form_modal_email_email'), 'required|htmlspecialchars');
			$this->form_validation->set_rules('number', $this->lang->line('welcome_page_help_cover_image_form_modal_email_number'), 'required|numeric');
			$this->form_validation->set_rules('messages', $this->lang->line('welcome_page_help_cover_image_form_modal_email_messages'), 'required|htmlspecialchars');
			
			if ($this->form_validation->run() == FALSE) {
		$data['title'] = $this->lang->line('welcome_page_help_meta_title');
		$this->load->view($this->themename.'/layout/globe/welcome/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/welcome/header_navbar');
		$this->load->view($this->themename.'/layout/welcome/page/help', $data);
		$this->load->view($this->themename.'/layout/globe/welcome/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/welcome/footer_end');
		
			}else {
				$this->email->from($this->input->post('email', TRUE), $this->site_settings->site_name);
				$this->email->to($this->site_settings->site_email);
				$this->email->subject(''.$this->input->post('subject', TRUE).' '.$this->site_settings->site_name.'');
				$this->email->message($this->load->view($this->themename.'/layout/email/support-email', $data, TRUE));
				$this->email->send();
				$this->session->set_flashdata('send_email_success', TRUE);
				redirect('page/help');
			}
			
		}elseif ($method == 'fees') {
		
		/* Form validate */
			$this->form_validation->set_rules('name', $this->lang->line('welcome_page_help_cover_image_form_modal_email_name'), 'required|htmlspecialchars');
			$this->form_validation->set_rules('subject', $this->lang->line('welcome_page_help_cover_image_form_modal_email_subject'), 'required|htmlspecialchars');
			$this->form_validation->set_rules('email', $this->lang->line('welcome_page_help_cover_image_form_modal_email_email'), 'required|htmlspecialchars');
			$this->form_validation->set_rules('number', $this->lang->line('welcome_page_help_cover_image_form_modal_email_number'), 'required|numeric');
			$this->form_validation->set_rules('messages', $this->lang->line('welcome_page_help_cover_image_form_modal_email_messages'), 'required|htmlspecialchars');
			
			if ($this->form_validation->run() == FALSE) {
		$data['title'] = $this->lang->line('welcome_page_fees_meta_title');
		$this->load->view($this->themename.'/layout/globe/welcome/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/welcome/header_navbar');
		$this->load->view($this->themename.'/layout/welcome/page/fees', $data);
		$this->load->view($this->themename.'/layout/globe/welcome/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/welcome/footer_end');
		
			}else {
				$this->email->from($this->input->post('email', TRUE), $this->site_settings->site_name);
				$this->email->to($this->site_settings->site_email);
				$this->email->subject(''.$this->input->post('subject', TRUE).' '.$this->site_settings->site_name.'');
				$this->email->message($this->load->view($this->themename.'/layout/email/support-email', $data, TRUE));
				$this->email->send();
				$this->session->set_flashdata('send_email_success', TRUE);
				redirect('page/help');
				
		}
		
		}elseif ($method == 'developer') {
		
		$data['title'] = $this->lang->line('welcome_page_developer_meta_title');
		$this->load->view($this->themename.'/layout/globe/welcome/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/welcome/header_navbar');
		$this->load->view($this->themename.'/layout/welcome/page/developer', $data);
		$this->load->view($this->themename.'/layout/globe/welcome/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/welcome/footer_end');
		
		}elseif ($method == 'mobile') {
		
		$data['title'] = $this->lang->line('welcome_page_mobile_meta_title');
		$this->load->view($this->themename.'/layout/globe/welcome/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/welcome/header_navbar');
		$this->load->view($this->themename.'/layout/welcome/page/mobile', $data);
		$this->load->view($this->themename.'/layout/globe/welcome/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/welcome/footer_end');
		
			//elseif
		}
	}
	
}
