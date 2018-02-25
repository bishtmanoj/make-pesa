<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {


	 public function __construct() {

		parent::__construct();

		$this->load->model('core_model');
		
		// Get core Site settings
		$this->site_settings = $this->core_model->get_bk_core_settings();
		
		// Get theme path
		$this->themename = $this->core_model->get_core_bk_theme_name();
		
		// Get core User
		$this->user = $this->core_model->get_bk_core_user();
		
		// Language file
		$this->lang->load(array('errors', 'myaccount'));
	 }
	 
	public function error_404()
	{
		$data['title'] = $this->lang->line('404_error_meta_title');
		$this->load->view($this->themename.'/layout/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/header_navbar');
		$this->load->view($this->themename.'/layout/errors/404_errors', $data);
		$this->load->view($this->themename.'/layout/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/footer_end');
	}
	
	public function account()
	{
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		}else {
		
		if ($this->user->send_money == '0' || $this->user->request_money == 0 || $this->user->add_fund == 0 || $this->user->withdraw_fund == 0) {
		$data['title'] = $this->lang->line('account_error_meta_title');
		$this->load->view($this->themename.'/layout/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/header_navbar');
		$this->load->view($this->themename.'/layout/errors/account', $data);
		$this->load->view($this->themename.'/layout/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/footer_end');
		
		}else {
			redirect('myaccount');
		}
	}
	}
	
	public function maintanance()
	{
		if ($this->site_settings->site_maintanace == 0) {
			redirect('myaccount');
		}
		
		$data['title'] = $this->lang->line('maintanance_error_meta_title');
		$this->load->view($this->themename.'/layout/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/header_navbar');
		$this->load->view($this->themename.'/layout/errors/maintanance', $data);
		$this->load->view($this->themename.'/layout/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/footer_end');
	}
}
