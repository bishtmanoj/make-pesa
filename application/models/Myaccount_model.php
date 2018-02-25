<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myaccount_model extends CI_Model {


    
    /******************
     *
	 * My Account model.
	 *
	 ******************/

    public function bk_get_money_balance()
  {
    $array = array('receiver' => $this->session->email, 'status' => 'Processed', 'payment_type' => 'sent');
    $this->db->where($array);
    $this->db->select_sum('total');
    $query = $this->db->get('transactions');
 
   $balance = $query->row_array();
   $total_balance = $balance['total'];
   $balance = round($total_balance,2);
   return $balance;
  }
  
  public function bk_get_dispute_balance()
  {
    $array = array('receiver' => $this->session->email, 'dispute' => '1', 'payment_type' => 'sent');
    $this->db->where($array);
    $this->db->select_sum('total');
    $query = $this->db->get('transactions');
 
   $balance = $query->row_array();
   $total_balance = $balance['total'];
   $balance = round($total_balance,2);
   return $balance;
  }
  
  public function bk_get_refund_balance()
  {
    $array = array('receiver' => $this->session->email, 'status' => 'Processed', 'payment_type' => 'refund', 'payment_method' => 'Card');
    $this->db->where($array);
    $this->db->select_sum('total');
    $query = $this->db->get('transactions');
 
   $balance = $query->row_array();
   $total_balance = $balance['total'];
   $balance = round($total_balance,2);
   return $balance;
  }
  
  public function bk_get_sender_balance()
  {
    $array = array('sender' => $this->session->id, 'status' => 'Processed', 'payment_type' => 'sent', 'payment_method !=' => 'Card');
	$where = array('userid' => $this->session->id);
    $this->db->where($array);
    $this->db->select_sum('total');
	$this->db->select_sum('fees');
    $query = $this->db->get('transactions');
 
   $balance = $query->row_array();
   $total_balance = $balance['total'];
   $balance = $total_balance + $balance['fees'];
   return $balance;
  }
  
  public function bk_get_fund_balance()
  {
    $array = array('sender' => $this->session->id, 'status' => 'Processed', 'payment_type' => 'Deposit');
	$where = array('userid' => $this->session->id);
    $this->db->where($array);
    $this->db->select_sum('amount');
    $query = $this->db->get('transactions');
 
   $balance = $query->row_array();
   $balance = round($balance['amount'],2);
   return $balance;
  }

  public function bk_get_withdraw_balance()
  {
    $array = array('sender' => $this->session->id, 'payment_type' => 'Withdraw');
	$where = array('userid' => $this->session->id);
    $this->db->where($array);
    $this->db->select_sum('amount');
    $query = $this->db->get('transactions');
 
   $balance = $query->row_array();
   $balance = round($balance['amount'],2);
   return $balance;
  }
  
   public function bk_get_withdraw_balance_cancel()
  {
    $array = array('sender' => $this->session->id, 'status' => 'Cancel', 'payment_type' => 'Withdraw');
	$where = array('userid' => $this->session->id);
    $this->db->where($array);
    $this->db->select_sum('amount');
    $query = $this->db->get('transactions');
 
   $balance = $query->row_array();
   $balance = round($balance['amount'],2);
   return $balance;
  }
  
  public function bk_get_pending_balance()
  {
    $where = array('payment_type' => 'Pending');
	$where = "receiver='".$this->session->email."' OR sender='".$this->session->id."'";
    $this->db->where($where);
    $this->db->select_sum('total');
    $query = $this->db->get('transactions');
 
   $balance = $query->row_array();
   $balance = round($balance['total'],2);
   return $balance;
  }
  
   public function getlistmoney(){
	$where = "payment_type != 'request' AND status != 'Pending' AND sender = '".$this->session->id."' OR receiver = '".$this->session->email."'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('transactions');
	$this->db->limit(10, 0);
	$this->db->order_by("id", "desc");
	
	$query = $this->db->get();
    return $query->result();
    
	}
	
	public function get_pending_listmoney(){
	
	$where = "status = 'Pending' AND sender = '".$this->session->id."' OR receiver = '".$this->session->email."' AND status = 'Pending'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('transactions');
	$this->db->limit(10, 0);
	$this->db->order_by("id", "desc");
	
	$query = $this->db->get();
    return $query->result();
	}
	
	public function bk_getlist_pending_withdraw(){
	
	
	$where = array('status' => 'Pending', 'payment_type' => 'Withdraw');
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('transactions');
	$this->db->limit(5, $start);
	$this->db->order_by("id", "desc");
    $query = $this->db->get();
    return $query->result();
    }
	
	public function bk_getlist_pending_deposit(){
	
	
	$where = array('status' => 'Pending', 'payment_type' => 'Deposit');
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('transactions');
	$this->db->limit(5, $start);
	$this->db->order_by("id", "desc");
    $query = $this->db->get();
    return $query->result();
    }
	
	public function bk_get_transaction(){
	
	$where = "receiver='".$this->session->email."' OR sender='".$this->session->id."'";
	$where = array('userid' => $this->session->id);
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('transactions');
	$this->db->limit(10, $start);
    $query = $this->db->get();
    return $query->result();
    }


	
	
	public function bk_get_transaction_id($id) {

    	$this->db->select('*');
    	$this->db->from('transactions');
    	$this->db->where('id', $id);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	public function bk_get_requestsender_email($post_user) {

    	$this->db->select('*');
    	$this->db->from('users');
    	$this->db->where('id', $post_user);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	public function wallet_card_add($data2){
		$this->db->set('userid', $this->session->id);
		$this->db->set('status', 1);
		$this->db->set('card_type', $this->input->post('card_type'));
        $this->db->set('name', $this->input->post('name'));
		$this->db->set('number', $this->input->post('cardnumber'));
		$this->db->set('month', $this->input->post('expirymonth'));
		$this->db->set('code', rand(1000, 9999));
		$this->db->set('exp_year', $this->input->post('expiryyear'));
        $this->db->set('cvc', $this->input->post('cvc'));

        $this->db->insert('bankcard');
        $this->db->insert('transactions', $data2);

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	
		
	public function bk_paypal_fund($paypalInfo) {

		$fees = $paypalInfo["amt"]*$this->site_settings->fund_paypal_fees/100;
		$amount = $paypalInfo["amt"] - $fees;
		$senderget = $this->users_model->get_user_by_id_or_username($this->session->id);
	    $paypalInfo = $this->input->get();
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('sender_name', $senderget->full_name);
		$this->db->set('receiver', 'Paypal - '.$this->session->username.'');
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($paypalInfo["amt"], 2));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', $paypalInfo["tx"]);
		$this->db->set('status', 'Processed');
		$this->db->set('payment_type', 'Deposit');
		$this->db->set('payment_method', 'Paypal');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_bank_withdraw($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_bank_fees/100;
		$amount = $user_data['amount'] - $fees;
		$senderget = $this->users_model->get_user_by_id_or_username($this->session->id);
	    $bankdata = $this->myaccount_model->bk_get_bankac_post($this->input->post('bank', TRUE));
		$BankInfo = 'Account Name: '.$bankdata->acname.' </br> 
		 Account Number: '.$bankdata->acno.' </br>
		 Bank Name: '.$bankdata->bankname.' </br>
		 SWIFT Code: '.$bankdata->swift.' </br>
		 Branch Name: '.$bankdata->branchname.' </br>
		 City: '.$bankdata->city.' </br>
		 Country: '.$bankdata->country.'';
	
	    $this->db->set('sender', $this->session->id);
		$this->db->set('sender_name', $senderget->full_name);
		$this->db->set('sender_email', $senderget->email);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'Bank - '.$bankdata->acno.'');
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('note', $BankInfo);
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'Bank');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_card_withdraw($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_card_fees/100;
		$amount = $user_data['amount'] - $fees;
	    $carddata = $this->bk_get_bankcard_post($this->input->post('card', TRUE));
		$CardInfo = 'Card Name: '.$carddata->name.' </br> 
		 Card Number: '.$carddata->number.' </br>
		 Month: '.$carddata->month.' </br>
		 Exp Year: '.$carddata->exp_year.' </br>
		 Secury Code(cvc): '.$carddata->cvc.'';
	
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'Card - '.str_pad(substr($carddata->number, -4), strlen($carddata->number), '*', STR_PAD_LEFT).'');
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('note', $CardInfo);
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'Card');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_withdraw_paypal($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_paypal_fees/100;
		$amount = $user_data['amount'] - $fees;
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'Paypal - '.$user_data['paypal_email'].'');
		$this->db->set('email_add', $user_data['paypal_email']);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'Paypal');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_withdraw_payza($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_payza_fees/100;
		$amount = $user_data['amount'] - $fees;
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'Payza - '.$user_data['payza_email'].'');
		$this->db->set('email_add', $user_data['payza_email']);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'Payza');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_withdraw_skrill($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_skrill_fees/100;
		$amount = $user_data['amount'] - $fees;
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'Skrill - '.$user_data['skrill_email'].'');
		$this->db->set('email_add', $user_data['skrill_email']);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'Skrill');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_withdraw_mpesa($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_mpesa_fees/100;
		$amount = $user_data['amount'] - $fees;
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'M-PESA : +'.$user_data['mpesa_number'].'');
		$this->db->set('email_add', $user_data['mpesa_number']);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'M-PESA');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_withdraw_tigopesa($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_tigopesa_fees/100;
		$amount = $user_data['amount'] - $fees;
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'TIGO-PESA : +'.$user_data['tigopesa_number'].'');
		$this->db->set('email_add', $user_data['tigopesa_number']);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'TIGO-PESA');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_withdraw_airtelmoney($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_airtelmoney_fees/100;
		$amount = $user_data['amount'] - $fees;
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'AIRTEL MONEY : +'.$user_data['airtelmoney_number'].'');
		$this->db->set('email_add', $user_data['airtelmoney_number']);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'AIRTEL MONEY');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_withdraw_mtn($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_mtn_fees/100;
		$amount = $user_data['amount'] - $fees;
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'MTN MONEY : +'.$user_data['mtn_number'].'');
		$this->db->set('email_add', $user_data['mtn_number']);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'MTN MONEY');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_add_card($user_data) {

        $this->db->set('userid', $this->session->id);
		$this->db->set('status', 1);
        $this->db->set('name', $user_data['cardname']);
		$this->db->set('number', $user_data['cardnumber']);
		$this->db->set('month', $user_data['exp_month']);
		$this->db->set('exp_year', $user_data['exp_year']);
        $this->db->set('cvc', $user_data['cvc']);

        $this->db->insert('bankcard');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_add_bank($user_data) {

        $this->db->set('userid', $this->session->id);
		$this->db->set('status', 1);
        $this->db->set('acname', $user_data['acname']);
		$this->db->set('acno', $user_data['acno']);
		$this->db->set('swift', $user_data['swift']);
		$this->db->set('bankname', $user_data['bankname']);
		$this->db->set('branchname', $user_data['branchname']);
		$this->db->set('country', $user_data['country']);
		$this->db->set('city', $user_data['city']);

        $this->db->insert('bankaccount');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_add_local_bank($user_data) {

        $support_bank = $this->core_model->core_get_bank_support_info();
		$this->db->set('userid', $this->session->id);
		$this->db->set('status', 2);
		$this->db->set('acno', $user_data['acno']);
		$this->db->set('bankname', $user_data['bankname']);
		$this->db->set('local_code', '0'.$support_bank->data_code);
		$this->db->set('local', '1');
		$this->db->set('local_birthday', $user_data['birthday']);
		$this->db->set('country', 'ng');
		$this->db->set('bvn', $user_data['bvn']);
		$this->db->set('date', time());

        $this->db->insert('bankaccount');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_add_local_bank_verification($user_data) {

        $this->db->set('date', time());
		$this->db->set('status', 2);
		$this->db->set('user_name', $this->session->full_name);
		$this->db->set('user_email', $this->session->email);
		$this->db->set('user_mobile', $this->session->mobile);
		$this->db->set('bank', $user_data['bankname']);
		$this->db->set('account', $user_data['acno']);
		$this->db->set('bvn', $user_data['bvn']);

        $this->db->insert('bank_verification');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_add_local_card($user_data) {

        $this->db->set('userid', $this->session->id);
		$this->db->set('status', 1);
		$this->db->set('verified', 1);
		$this->db->set('card_type', $this->input->post('card_type'));
        $this->db->set('name', 'ng');
		$this->db->set('number', $user_data['cardnumber']);
		$this->db->set('month', $user_data['expirymonth']);
		$this->db->set('exp_year', $user_data['expiryyear']);
        $this->db->set('cvc', $user_data['cvc']);
		$this->db->set('local', '1');
		$this->db->set('country', 'ng');

        $this->db->insert('bankcard');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_remove_default_card($user_data) {

        $this->db->set('default_card', '');
		$this->db->where('userid', $this->session->id);

        $this->db->update('bankcard');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_update_default_card($user_data) {

        $this->db->set('default_card', '1');
		$this->db->where('id', $user_data['id']);

        $this->db->update('bankcard');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_remove_card($user_data) {

        $this->db->where('id', $user_data['id']);

        $this->db->delete('bankcard');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_remove_bank($user_data) {

        $this->db->where('id', $user_data['id']);

        $this->db->delete('bankaccount');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function bk_getlistcard(){
	
	$where = "userid='".$this->session->id."' AND status='1'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('bankcard');
	$this->db->order_by("id", "desc");
    $query = $this->db->get();
    return $query->result();
    }
	
	public function bk_getlistbank(){
	
	$where = "userid='".$this->session->id."' AND status='1'";
	$this->db->where($where);
    $this->db->select('*');
	$this->db->order_by("id", "desc");
    $this->db->from('bankaccount');
    $query = $this->db->get();
    return $query->result();
    }
	
	public function bk_get_pending_listbank(){
	
	$where = "userid='".$this->session->id."' AND status='2'";
	$this->db->where($where);
    $this->db->select('*');
	$this->db->order_by("id", "desc");
    $this->db->from('bankaccount');
    $query = $this->db->get();
    return $query->result();
    }
	
	public function bk_nigeria_getlistbank(){
	
	$where = "userid='".$this->session->id."' AND status='1'";
	$this->db->where($where);
	
	$array = array('userid' => $this->session->id, 'status' => '1', 'local' => '1');
	$this->db->where($array);
    $this->db->select('*');
	$this->db->order_by("id", "desc");
    $this->db->from('bankaccount');
    $query = $this->db->get();
    return $query->result();
    }

	 public function bk_get_account_bank_sum()
  {
    
    $this->db->select('COUNT(*) as count');
    $this->db->from('bankaccount');
    $where = "userid='".$this->session->id."' AND status='1'";
    $this->db->where($where);
    $query = $this->db->get();
    if ($query->num_rows() > 0 )
    {
    $row = $query->row();
    return $row->count;
    }
    return 0;
  }
  
  public function bk_get_card_bank_sum()
  {
    
    $this->db->select('COUNT(*) as count');
    $this->db->from('bankcard');
    $where = "userid='".$this->session->id."' AND status='1'";
    $this->db->where($where);
    $query = $this->db->get();
    if ($query->num_rows() > 0 )
    {
    $row = $query->row();
    return $row->count;
    }
    return 0;
  }
  
   public function bk_get_bankac_post($post_bank) {

    	$this->db->select('*');
    	$this->db->from('bankaccount');
    	$this->db->where('id', $post_bank);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	public function bk_get_bankcard_post($post_bank) {

    	$this->db->select('*');
    	$this->db->from('bankcard');
    	$this->db->where('id', $post_bank);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}
		
    }

	public function bk_profile_image($filename)
    {
        
		$this->db->set('image', $filename);
        $this->db->where('id', $this->session->id);

        $query = $this->db->update('users');

        if ($this->db->affected_rows() == 1 || $this->db->affected_rows() == 0) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
}