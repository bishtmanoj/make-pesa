<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class IPN extends CI_Controller {


	 public function __construct() {

        parent::__construct();

        $this->load->model('core_model');
		$this->load->model('checkout_model');

    	// Get core Site settings
		$this->site_settings = $this->core_model->get_bk_core_settings();
		$this->user = $this->core_model->get_bk_core_user();
		$this->load->library('form_validation');

		// Get theme path
		$this->themename = $this->core_model->get_core_bk_theme_name();

		// Language file
		$this->lang->load(array('signup', 'signin', 'fund', 'ipn'));
		
		if ($this->helper->user_islogin()) {
		$this->load->library('paypal_lib');
		}
	 }
	 

	 public function paypal() {
	     
	     //paypal return transaction details array
        $paypalInfo    = $this->input->post();

        $item_number = $paypalInfo['item_number'];
	$txn_id = $paypalInfo['txn_id'];
	$payment_gross = $paypalInfo['mc_gross'];
	$currency_code = $paypalInfo['mc_currency'];
	$payment_status = $paypalInfo['payment_status'];
	$payer_email = $paypalInfo['payer_email'];
	$sender_request_email = $paypalInfo['custom'];
	    
	    $paypalURL = $this->paypal_lib->paypal_url;        
        $result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
        
        //check whether the payment is verified
        if(preg_match("/VERIFIED/i",$result)){
            //insert the transaction data into the database
    
    $senderget = $this->core_model->core_get_user_with_email($sender_request_email);
	$fees = $payment_gross*$this->site_settings->deposit_paypal_percentage_fees/100 + $this->site_settings->deposit_paypal_flat_fees;
	$amount = $payment_gross - $fees;
	
	// Get sender name
		if ($senderget->business_name) {
			$sender_name = $senderget->business_name;
		}else {
			$sender_name =  $senderget->full_name;
		}
		
    $datainsert = array(
		
		'sender' => $item_number,
		'userid' => $item_number,
		'sender_name' => $sender_name,
		'sender_email' => $senderget->email,
		'receiver' => 'Paypal - '.$payer_email.'',
		'txn_id' => $txn_id,
		'dispute' => '0',
		'fees' => number_format($fees, 2),
		'total' => $payment_gross,
		'amount' => number_format($amount, 2, '.', ''),
		'currency_code' => $currency_code,
		'payment_type' => 'Deposit',
		'payment_method' => 'Paypal',
		'status' => 'Processed',
		'date' => time()
			);
	$this->core_model->fund_deposit_with_paypal($datainsert);
        }
	    
	     
	 }
	 
	 
	
  }
  
  
  
