<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout_model extends CI_Model {
	/* Checkout Model */

	// Checkout paid with Balance and no shipping
	public function checkout_paid_item() {

		$senderget = $this->core_model->core_get_user_with_email($this->session->email);
		$receiverget = $this->core_model->core_get_user_with_email($this->session->business);
		$fees = $this->session->amount*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
		$amount = $this->session->amount - $fees;
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
		
        $transaction_id = 'TXT'.rand(1000, 9999).'TZ'.time().'';
		$this->db->set('sender', $this->session->id);
		$this->db->set('sender_name', $sender_name);
		$this->db->set('sender_email', $senderget->email);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', $receiverget->email);
		$this->db->set('receiver_name', $receiver_name);
		$this->db->set('receiver_email', $receiverget->email);
		$this->db->set('receiver_mobile', $receiverget->mobile);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($this->session->amount, 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', $transaction_id);
		$this->db->set('status', 'Processed');
		$this->db->set('payment_type', 'sent');
		$this->db->set('payment_method', 'Balance');
		$this->db->set('protection', '1');
		$this->db->set('dispute', '0');
		$this->db->set('item_name', $this->session->item_name);
		$this->db->set('item_number', $this->session->item_number);
		$this->db->set('currency_code', $this->session->curr);
        $this->db->set('date', time());
		
		$this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	// Checkout paid with Balance and shipping
	public function checkout_paid_item_shipping() {

		$senderget = $this->core_model->core_get_user_with_email($this->session->email);
		$receiverget = $this->core_model->core_get_user_with_email($this->session->business);
		$fees = $this->session->amount*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
		$amount = $this->session->amount - $fees;
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
		
        $transaction_id = 'TXT'.rand(1000, 9999).'TZ'.time().'';
		$this->db->set('sender', $this->session->id);
		$this->db->set('sender_name', $sender_name);
		$this->db->set('sender_email', $senderget->email);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', $receiverget->email);
		$this->db->set('receiver_name', $receiver_name);
		$this->db->set('receiver_email', $receiverget->email);
		$this->db->set('receiver_mobile', $receiverget->mobile);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($this->session->amount, 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', $transaction_id);
		$this->db->set('status', 'Processed');
		$this->db->set('payment_type', 'sent');
		$this->db->set('payment_method', 'Balance');
		$this->db->set('protection', '1');
		$this->db->set('dispute', '0');
		$this->db->set('shipping', '1');
		$this->db->set('item_name', $this->session->item_name);
		$this->db->set('item_number', $this->session->item_number);
		$this->db->set('currency_code', $this->session->curr);
		$this->db->set('address1', $this->user->address1);
		$this->db->set('address2', $this->user->city);
		$this->db->set('address3', $this->user->country);
		$this->db->set('address4', $this->user->postal_code);
        $this->db->set('date', time());
		
		$this->session->transaction_id = $transaction_id;

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	
	/* Card get on sending payment
	******/
	public function checkout_pay_get_card($data_user) {

    	$this->db->select('*');
    	$this->db->from('bankcard');
    	$array = array('id' => $data_user['pay_with']);
    	$this->db->where($array);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	/* Get pay link button info
	*/
	public function checkout_paylink_button_get_info($get_info) {

    	$this->db->select('*');
    	$this->db->from('pay_button');
    	$this->db->where('code', $get_info);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	// Checkout Voucher
	public function checkout_voucher_store($pin) {

		$receiverget = $this->core_model->core_get_user_with_email($this->session->business);
		// Get receive name
		if ($receiverget->business_name) {
			$receiver_name = $receiverget->business_name;
		}else {
			$receiver_name =  $receiverget->full_name;
		}
		
        $this->db->set('sender_name', 'AlatPIN - '.substr_replace($pin, str_repeat('X', 5), 4, 5).'');
		$this->db->set('userid', $_SERVER['REMOTE_ADDR']);
		$this->db->set('receiver', $receiverget->email);
		$this->db->set('receiver_name', $receiver_name);
		$this->db->set('receiver_email', $receiverget->email);
		$this->db->set('receiver_mobile', $receiverget->mobile);
        $this->db->set('amount', number_format($this->session->amount, 2, '.', ''));
		$this->db->set('total', number_format($this->session->amount, 2, '.', ''));
		$this->db->set('fees', '0.00');
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Processed');
		$this->db->set('payment_type', 'sent');
		$this->db->set('dispute', '0');
		$this->db->set('shipping', '0');
		$this->db->set('item_name', $this->session->item_name);
		$this->db->set('item_number', $this->session->item_number);
		$this->db->set('currency_code', $this->session->curr);
		$this->db->set('payment_method', 'AlatPIN');
		$this->db->set('note', 'Paid by AlatPIN');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	// Checkout Voucher Report
	public function checkout_voucher_report($pin, $userid) {

		$this->db->set('date', time());
		$this->db->set('last_used', time());
		$this->db->set('pin', $pin);
		$this->db->set('purchases', $this->session->item_name);
		$this->db->set('amount', number_format($this->session->amount, 2, '.', ''));
		$this->db->set('currency_code', $this->session->curr);
		$this->db->set('merchant', $this->session->business);
		$this->db->set('userid', $userid);
		$this->db->set('status', '1');
		$this->db->set('ip', $_SERVER['REMOTE_ADDR']);
		$this->db->set('device', $_SERVER['HTTP_USER_AGENT']);

        $this->db->insert('voucher_report');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	// Checkout Voucher1 Report
	public function checkout_voucher_report1($pin, $userid, $total_pin1_amount) {

		$this->db->set('date', time());
		$this->db->set('last_used', time());
		$this->db->set('pin', $pin);
		$this->db->set('purchases', $this->session->item_name);
		$this->db->set('amount', number_format($total_pin1_amount, 2, '.', ''));
		$this->db->set('currency_code', $this->session->curr);
		$this->db->set('merchant', $this->session->business);
		$this->db->set('userid', $userid);
		$this->db->set('status', '1');
		$this->db->set('ip', $_SERVER['REMOTE_ADDR']);
		$this->db->set('device', $_SERVER['HTTP_USER_AGENT']);

        $this->db->insert('voucher_report');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	// Checkout Voucher2 Report
	public function checkout_voucher_report2($pin, $userid, $total_pin2_amount) {

		$this->db->set('date', time());
		$this->db->set('last_used', time());
		$this->db->set('pin', $pin);
		$this->db->set('purchases', $this->session->item_name);
		$this->db->set('amount', number_format($total_pin2_amount, 2, '.', ''));
		$this->db->set('currency_code', $this->session->curr);
		$this->db->set('merchant', $this->session->business);
		$this->db->set('userid', $userid);
		$this->db->set('status', '1');
		$this->db->set('ip', $_SERVER['REMOTE_ADDR']);
		$this->db->set('device', $_SERVER['HTTP_USER_AGENT']);

        $this->db->insert('voucher_report');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	// Checkout Voucher amount Update
	public function checkout_voucher_amount_pin_update($pin, $total_pin_amount) {

		$this->db->set('amount', number_format($total_pin_amount, 2, '.', ''));
		$this->db->where('pin', $pin);

        $this->db->update('voucher');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	// Checkout Voucher2 amount Update
	public function checkout_voucher_amount_pin2_update($pin, $total_pin2_amount) {

		$this->db->set('amount', number_format($total_pin2_amount, 2, '.', ''));
		$this->db->where('pin', $pin);

        $this->db->update('voucher');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
}