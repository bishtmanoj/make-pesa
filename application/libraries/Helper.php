<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helper {
// Core helper class

	protected $CI;

	public function __construct() {

		
		$this->CI =& get_instance();

	}

	public function user_islogin() {
		if (empty($this->CI->session->email)) {
			return 0;
		} else {
			return 1;
		}
	}
	
	public function ac_is_personal() {
		if (empty($this->CI->session->account_type == 1)) {
			return 0;
		} else {
			return 1;
		}
	}
	
	public function ac_is_business() {
		if (empty($this->CI->session->account_type == 2)) {
			return 0;
		} else {
			return 1;
		}
	}
	
	public function ac_is_admin() {
		if (empty($this->CI->session->account_type == 0)) {
			return 0;
		} else {
			return 1;
		}
	}
	
	public function account_status() {
		if ($this->CI->session->account_type == 1) {
			return 'Personal';
		} elseif ($this->CI->session->account_type == 2) {
			return 'Business';
		}
	}
	
	public function account_status_in_admin($data) {
		if ($data == 1) {
			return 'Personal';
		} elseif ($data == 2) {
			return 'Business';
		} elseif ($data == 0) {
			return 'Admin';
		}
		
	}
	
	public function card_type_select_option() {
		$card_accept = $this->CI->core_model->core_get_card_type();
		foreach($card_accept as $card){
			echo '<option value="'.$card->code.'">'.$card->name.'</option>';
		}
		return FALSE;
	}
	
	public function local_card_type_select_option() {
		$card_accept = $this->CI->core_model->core_get_local_card_type();
		foreach($card_accept as $card){
			echo '<option value="'.$card->code.'">'.$card->name.'</option>';
		}
		return FALSE;
	}
	
	public function country_select_option() {
		$country_data = $this->CI->core_model->core_get_country_data();
		foreach($country_data as $country){
			echo '<option value="'.$country->countryName.'">'.$country->countryName.'</option>';
		}
		return FALSE;
	}
	
	public function idcard_type_select_option() {
		$idcard_accept = $this->CI->core_model->core_get_idcard_type();
		foreach($idcard_accept as $idcard){
			echo '<option value="'.$idcard->name.'">'.$idcard->name.'</option>';
		}
		return FALSE;
	}
	
	public function currency_word_select_option() {
		$currency_accept = $this->CI->core_model->core_get_currency();
		foreach($currency_accept as $currency){
			echo '<option value="'.$currency->name.'">'.$currency->name.'</option>';
		}
		return FALSE;
	}
	
	public function currency_symbol_word_select_option() {
		$currency_accept = $this->CI->core_model->core_get_currency();
		foreach($currency_accept as $currency){
			echo '<option value="'.$currency->symbol.'">'.$currency->symbol.'</option>';
		}
		return FALSE;
	}
	
	public function currency_symbol_select_option($word) {
		$currency_symbol = $this->CI->core_model->core_get_currency_symbol($word);
		
		if ($currency_symbol['symbol']) {
		return $currency_symbol['symbol'];
		}else {
		return '';	
		}
	}
	
	public function local_bank_select_option() {
		$bank_support = $this->CI->core_model->core_get_local_bank_support();
		foreach($bank_support as $bank){
			echo '<option value="'.$bank->data_name.'">'.$bank->data_name.'</option>';
		}
		return FALSE;
	}
	
	
	public function card_type_icon($data) {
		if ($data == 1) {
			return '<i class="fa fa-cc-visa fa-lg" aria-hidden="true"></i>';
		} elseif ($data == 2) {
			return '<i class="fa fa-cc-mastercard fa-lg" aria-hidden="true"></i>';
		} elseif ($data == 3) {
			return '<i class="fa fa-cc-discover fa-lg" aria-hidden="true"></i>';
			
		} elseif ($data == 4) {
			return '<i class="fa fa-cc-amex fa-lg" aria-hidden="true"></i>';
		}
		
	}
	
	public function card_type_name($data) {
		if ($data == 1) {
			return 'VISA';
		} elseif ($data == 2) {
			return 'MASTER CARD';
		} elseif ($data == 3) {
			return 'DISCOVER';
			
		} elseif ($data == 4) {
			return 'AMEX';
		}
		
	}
	
	public function account_verified_badge() {
		if ($this->CI->user->verified == 0) {
			return '';
		} elseif ($this->CI->user->verified == 1) {
			return '<i class="fa fa-check-circle fa-verified" aria-hidden="true"></i>';
		}
		
	}
	
	public function dispute_status($data) {
		if ($this->CI->user->account_type == 0) {
		$wait = $this->CI->admin_model->dispute_waiting_count();
		$refunded = $this->CI->admin_model->dispute_refunded_count();
		$cancel = $this->CI->admin_model->dispute_cancel_count();
	}else {
		$wait = $this->CI->dispute_model->dispute_waiting_count();
		$refunded = $this->CI->dispute_model->dispute_refunded_count();
		$cancel = $this->CI->dispute_model->dispute_cancel_count();
	}
	
		if ($data == 1) {
			return $wait;
		} elseif ($data == 2) {
			return $refunded;
		} elseif ($data == 3) {
			return $cancel;
		}
		
	}
	
	public function logout() {
		$this->CI->session->unset_userdata(array('id', 'country', 'email', 'full_name', 'mobile', 'account_type', 'start_email', 'type', 'email_mobile', 'code_sent', 'payer_id', 'return_url', 'item_name', 'item_number', 'amount', 'curr', 'done', 'transaction_id', 'type_sent', 'requested_info', 'payer_id', 'business', 'otp_code', 'reference', 'email_store'));
	}
	
	public function checkout_remove_business_session() {
		$this->CI->session->unset_userdata(array('business', 'shipping', 'cancel_url'));
	}
	
	
	/**
	* Get Transaction Balance
	*/
	public function transaction_balance() {

		$receiver = $this->CI->myaccount_model->bk_get_money_balance();
		$dispute = $this->CI->myaccount_model->bk_get_dispute_balance();
		$refund = $this->CI->myaccount_model->bk_get_refund_balance();
		$sender = $this->CI->myaccount_model->bk_get_sender_balance();
		$fund = $this->CI->myaccount_model->bk_get_fund_balance();
		$withdraw = $this->CI->myaccount_model->bk_get_withdraw_balance();
		$withdraw_cancel = $this->CI->myaccount_model->bk_get_withdraw_balance_cancel();
		$balance = $receiver + $refund + $fund + $withdraw_cancel - $sender - $withdraw - $dispute;
		return number_format($balance, 2, '.', '');
	}
	
		/**
	* Get Dispute Transaction Balance
	*/
	public function dispute_transaction_balance() {

		$receiver = $this->CI->myaccount_model->bk_get_money_balance();
		$refund = $this->CI->myaccount_model->bk_get_refund_balance();
		$sender = $this->CI->myaccount_model->bk_get_sender_balance();
		$fund = $this->CI->myaccount_model->bk_get_fund_balance();
		$withdraw = $this->CI->myaccount_model->bk_get_withdraw_balance();
		$withdraw_cancel = $this->CI->myaccount_model->bk_get_withdraw_balance_cancel();
		$balance = $receiver + $refund + $fund + $withdraw_cancel - $sender - $withdraw;
		return number_format($balance, 2, '.', '');
	}
	
	public function dispute_problem() {

		$dispute = $this->CI->myaccount_model->bk_get_dispute_balance();
		if ($dispute == 0) {
			$problem_error = '';
		}else {
			
			$problem_error = '<div class="dispute-sidebar">
			<h4>
			'.$this->CI->lang->line('summary_sidebar_dispute_claim').'
			'.$this->CI->user->curr_word.' '.number_format($dispute, 2, '.', '').'
			</h4>
			<p><a href="'.site_url().'dispute/type/wait'.'">'.$this->CI->lang->line('summary_sidebar_dispute_resolve').' </a></p>
			</div>';
		}
		return $problem_error;
	}
	
	
	public function infobip_sms($to_number, $sms) {

		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://api.infobip.com/sms/1/text/single",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "{ \"from\":\"".$this->CI->site_settings->infobip_brand_name."\", \"to\":\"".$to_number."\", \"text\":\"".$sms."\" }",
		  CURLOPT_HTTPHEADER => array(
		    "accept: application/json",
		    "authorization: Basic ".$this->CI->site_settings->infobip_auth."",
		    "content-type: application/json"
		  ),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  //echo "cURL Error #:" . $err;
		} else {
		  //echo $response;
		}
	}
	
	public function admin_user_registration_count($data) {
		if ($data == 1) {
			$this->CI->db->select('COUNT(*) as count');
			$this->CI->db->where('FROM_UNIXTIME(register_time, "%Y-%c") =', date('Y-n', time()));
			$this->CI->db->where('FROM_UNIXTIME(register_time, "%e") =', date('j', time()));
			$this->CI->db->from('users');
			$query = $this->CI->db->get();
			$row = $query->row();
			return $row->count;
		} elseif ($data == 2) {
			$this->CI->db->select('COUNT(*) as count');
			$this->CI->db->where('FROM_UNIXTIME(register_time, "%Y-%c") =', date('Y-n', time()));
			$this->CI->db->where('FROM_UNIXTIME(register_time, "%e") =', date('j', strtotime('-1 days')));
			$this->CI->db->from('users');
			$query = $this->CI->db->get();
			$row = $query->row();
			return $row->count;
		} elseif ($data == 30) {
			$this->CI->db->select('COUNT(*) as count');
			$this->CI->db->where('FROM_UNIXTIME(register_time, "%Y-%m-%d") BETWEEN "'.date('Y-m-d', strtotime('-29 days')).'" AND "'.date('Y-m-d', strtotime('-1 days')).'"');
			$this->CI->db->from('users');
			$query = $this->CI->db->get();
			$row = $query->row();
			return $row->count;
			
		} elseif ($data == 't') {
			$this->CI->db->select('COUNT(*) as count');
			$this->CI->db->from('users');
			$query = $this->CI->db->get();
			$row = $query->row();
			return $row->count;
		}
		
	}
	
	public function admin_home_statistics_bar($data) {
		if ($data == 1) {
			$this->CI->db->select_sum('fees');
			$where = array('status' => 'Processed');
			$this->CI->db->where($where);
			$this->CI->db->from('transactions');
			$query = $this->CI->db->get();
			$row = $query->row_array();
			$balance = $this->CI->site_settings->curr_word.' '.number_format($row['fees'], 2, '.', '').'';
			return $balance;
		} elseif ($data == 2) {
			$this->CI->db->select_sum('total');
			$where = array('status' => 'Processed');
			$this->CI->db->where($where);
			$this->CI->db->from('transactions');
			$query = $this->CI->db->get();
			$row = $query->row_array();
			$balance = $this->CI->site_settings->curr_word.' '.number_format($row['total'], 2, '.', '').'';
			return $balance;
		}
		
	}
} 