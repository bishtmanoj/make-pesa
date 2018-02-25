<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include("./vendor/autoload.php");
class Dispute_admin extends CI_Controller {


	 public function __construct() {

		parent::__construct();

		$this->load->model('core_model');
		$this->load->model('admin_model');
		$this->load->model('myaccount_model');
		$this->load->model('dispute_model');
		
		// Get core Site settings
		$this->site_settings = $this->core_model->get_bk_core_settings();
		
		// Get core User
		$this->user = $this->core_model->get_bk_core_user();
		$this->load->library('form_validation');
		
		// Get theme path
		$this->themename = $this->core_model->get_core_bk_theme_name();
		
		// Get core Count
		$this->user_total_count = $this->admin_model->get_bk_user_count();
		$this->pending_deposit_total_count = $this->admin_model->admin_pending_deposit_count();
		$this->pending_withdrawal_total_count = $this->admin_model->admin_pending_withdrawal_count();
		$this->pending_verification_total_count = $this->admin_model->admin_pending_verification_count();
		
		// Language file
		$this->lang->load(array('dispute', 'myaccount', 'admin'));
		
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
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
		
		$this->form_validation->set_rules('dispute_txn_id', 'Transaction ID', 'htmlspecialchars|required');
		
		if ($this->form_validation->run() == FALSE) {
		$data['list_dispute_money'] = $this->admin_model->getlist_dispute_waiting();
		$data['title'] = $this->lang->line('dispute_meta_title');
		$this->load->view($this->themename.'/layout/admin/globe/header_meta', $data);
		$this->load->view($this->themename.'/layout/admin/globe/header_navbar');
		$this->load->view($this->themename.'/layout/admin/dispute/home', $data);
		$this->load->view($this->themename.'/layout/admin/globe/footer_navbar');
		$this->load->view($this->themename.'/layout/admin/globe/footer_end');
		 
		 }else {
				if (isset($_POST['accept-dispute'])) {
				 
				 if (!$this->dispute_model->dispute_refund($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('dispute_refund_failed', TRUE);
					redirect('dispute_admin');

				} else {
					// Email notification
						$this->session->set_flashdata('dispute_refund_success', TRUE);
						redirect('dispute_admin');
					
				}
				
			 }else if (isset($_POST['cancel-dispute'])) {
				 
				 if (!$this->dispute_model->dispute_cancel($this->input->post(NULL, TRUE))) {

			        $this->session->set_flashdata('dispute_claim_failed', TRUE);
					redirect('dispute_admin');

				} else {
					
						$this->session->set_flashdata('dispute_claim_success', TRUE);
						redirect('dispute_admin');
					
					
				}
				 
             }
		 }
	}
	
	public function type($method = '') {
		
		if (empty($method)) {
			redirect('dispute');
		}
		
		if ($method == 'refund') {
			
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
		
		$data['list_dispute_money'] = $this->admin_model->admin_get_dispute_refund_listmoney();
		$data['title'] = $this->lang->line('dispute_meta_title');
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/admin/dispute/refunded', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		 
		 
			
		}elseif ($method == 'cancel') {
			
		if (!$this->helper->user_islogin()) {
			redirect('myaccount/signin');
		} elseif ($this->helper->ac_is_business()) {
			redirect('myaccount');
		} elseif ($this->helper->ac_is_personal()) {
			redirect('myaccount');
		}
		
		$data['list_dispute_money'] = $this->admin_model->admin_get_dispute_cancel_listmoney();
		$data['title'] = $this->lang->line('dispute_meta_title');
		$this->load->view($this->themename.'/layout/globe/personal/header_meta', $data);
		$this->load->view($this->themename.'/layout/globe/personal/header_navbar');
		$this->load->view($this->themename.'/layout/admin/dispute/cancel', $data);
		$this->load->view($this->themename.'/layout/globe/personal/footer_navbar');
		$this->load->view($this->themename.'/layout/globe/personal/footer_end');
		 	
		}//isset//isset
		
	}
	
	
	/* Stripe card processing */
	public function stripe_card_check($data){
	if (isset($_POST['accept-dispute'])){
			
			$complete = "";
		$note = "";
		$cardget = $this->core_model->get_bk_core_get_card_default();
		try{
		$fees = $this->input->post('amount')*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
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
			$mycard = array('number' => $data['number'],
							'name' => $data['name'],
							'exp_month' => $data['exp_month'],
							'exp_year' => $data['exp_year'],
							'cvc' => $data['cvc'],);
			$charge = \Stripe\Charge::create(array('card'=>$mycard,
													'amount'=>$data['amount'],
													'description' => $data['description'],
		
											'currency'=>$this->site_settings->curr_word));
											
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
		'payment_method' => 'Card',
		'dispute' => '2',
		'userid' => $this->session->id,
		'txn_id' => $charge->id,
		'date' => time(),
		'note' => 'Payment Refund'
			);
            $complete = $this->dispute_model->dispute_refund_with_card($storedata);
            if ($complete) {
				// Email to Receiver email
						$data['user'] = $this->core_model->core_get_user_with_email($this->input->post('receiver', TRUE));
						$data['amount'] = $this->input->post('amount', TRUE);
						$user_check = $this->core_model->core_get_user_with_email($this->input->post('receiver', TRUE));
						$this->email->from($this->site_settings->site_email, $this->site_settings->site_name);
						$this->email->to($this->session->email);
						$this->email->subject(''.$this->lang->line('Payment_made_subject').' '.$this->site_settings->site_name.'');
						$this->email->message($this->load->view($this->themename.'/layout/email/payment-sent', $data, TRUE));

						$this->email->send();
				$this->session->set_flashdata('dispute_claim_success', TRUE);
				redirect('dispute_admin/type/wait');
            } else {
				$this->session->set_flashdata('dispute_claim_failed', TRUE);
				redirect('dispute_admin/type/wait');
            }		
		}catch (Exception $e){
			$note = $e->getMessage();
		}	
		return $note;
		
		}
		
		// End
	}
	
}
