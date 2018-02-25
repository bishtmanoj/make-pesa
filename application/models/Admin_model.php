<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	/* Admin Model */

	public function personal_add($personal_data) {
	
	$this->db->set('email', strtolower($personal_data['email']));
		$this->db->set('first_name', $personal_data['first_name']);
		$this->db->set('last_name', $personal_data['last_name']);
		$this->db->set('full_name', ''.$personal_data['first_name'].' '.$personal_data['last_name'].'');
		$this->db->set('mobile', $personal_data['mobile']);
		$this->db->set('curr_symb', $this->site_settings->curr_symb);
		$this->db->set('curr_word', $this->site_settings->curr_word);
		$this->db->set('country', $personal_data['country']);
        $this->db->set('password', password_hash($personal_data['password'], PASSWORD_DEFAULT));
		$this->db->set('pin', rand(1000, 9999));
		$this->db->set('merchant_id', 'NG'.rand(1000, 9999).''.time().'');
		$this->db->set('image', '/assets/images/login.png');
		$this->db->set('account_type', '1');
		$this->db->set('send_money', '1');
		$this->db->set('request_money', '1');
		$this->db->set('add_fund', '1');
		$this->db->set('withdraw_fund', '1');
		$this->db->set('status', '1');
        $this->db->set('register_time', time());

        $this->db->insert('users');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	/* Business Account data form store
	*/
	public function business_add($business_data) {
	
		$this->db->set('email', strtolower($business_data['email']));
		$this->db->set('first_name', $business_data['first_name']);
		$this->db->set('last_name', $business_data['last_name']);
		$this->db->set('full_name', ''.$business_data['first_name'].' '.$business_data['last_name'].'');
		$this->db->set('business_name', $business_data['business_name']);
		$this->db->set('address1', $business_data['address1']);
		$this->db->set('address2', $business_data['address2']);
		$this->db->set('mobile', $business_data['mobile']);
		$this->db->set('curr_symb', $this->site_settings->curr_symb);
		$this->db->set('curr_word', $this->site_settings->curr_word);
		$this->db->set('country', $business_data['country']);
		$this->db->set('city', $business_data['city']);
		$this->db->set('state', $business_data['state']);
		$this->db->set('postal_code', $business_data['postal_code']);
        $this->db->set('password', password_hash($business_data['password'], PASSWORD_DEFAULT));
		$this->db->set('pin', rand(1000, 9999));
		$this->db->set('merchant_id', 'NG'.rand(1000, 9999).''.time().'');
		$this->db->set('image', '/assets/images/login.png');
		$this->db->set('account_type', '2');
		$this->db->set('send_money', '1');
		$this->db->set('request_money', '1');
		$this->db->set('add_fund', '1');
		$this->db->set('withdraw_fund', '1');
		$this->db->set('status', '1');
        $this->db->set('register_time', time());

        $this->db->insert('users');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	/* Get user info with email
	*/
	public function core_get_user_with_email($get_email) {

    	$this->db->select('*');
    	$this->db->from('users');
    	$this->db->where('email', $get_email);
		$this->db->or_where('mobile', $get_email);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	/* Get user info with pin
	*/
	public function core_get_user_with_pin($get_pin) {

    	$this->db->select('*');
    	$this->db->from('users');
    	$this->db->where('pin', $get_pin);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	/* Get User details */
	public function get_bk_core_user() {

    	$this->db->select('*');
    	$this->db->from('users');
    	$this->db->where('email', $this->session->email);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	/* Profile image upload store */
	public function bk_core_profile_image($filename)
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
	
	public function admin_settings($site_update_post_array) {

        $number_of_update = count($site_update_post_array);
        $get_counter = 0;

        foreach ($site_update_post_array as $change_key => $change_value) {

            $this->db->set('setting_value', $change_value);
            $this->db->where('setting_key', $change_key);
            $this->db->update('settings');

            $get_counter++;

        }

        if ($number_of_update == $get_counter) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	
	/* Manage Search user
	********/
	
	public function get_user_search($limit, $start, $st = NULL)
    {
        $this->db->select('*');
    	$this->db->like('full_name',$st);
    	$this->db->from('users');
		$this->db->order_by("id", "desc");
		$this->db->limit($limit, $start);
		

    	$query = $this->db->get();
        return $query->result();
    }
    
    public function get_user_count_search($st = NULL)
    {
        $this->db->select('*');
    	$this->db->like('full_name',$st);
    	$this->db->from('users');
		

    	$query = $this->db->get();
        return $query->num_rows();
    }
	
	/* Manage Transaction
	********/
	
	public function get_all_transaction_search($limit, $start, $st = NULL)
    {
        $this->db->select('*');
    	$this->db->like('txn_id',$st);
    	$this->db->from('transactions');
		$this->db->order_by("id", "desc");
		$this->db->limit($limit, $start);
		

    	$query = $this->db->get();
        return $query->result();
    }
	
	public function get_count_transaction_search($st = NULL)
    {
        $this->db->select('*');
    	$this->db->like('txn_id',$st);
    	$this->db->from('transactions');
		

    	$query = $this->db->get();
        return $query->num_rows();
    }
	
	/* Get User list details */
	public function get_bk_admin_user_list($data) {

    	$this->db->select('*');
    	$this->db->from('users');
    	$this->db->where('id', $data);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	/* User delete */
	public function delete_user($data)
    {
        
        $this->db->where('id', $data);

        $query = $this->db->delete('users');

        if ($this->db->affected_rows() == 1 || $this->db->affected_rows() == 0) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* Get User total */
	public function get_bk_user_count() {
		$this->db->select('COUNT(id) as count');
		$this->db->from('users');
		$query = $this->db->get();
		if ($query->num_rows() > 0 )
    	{
    	$row = $query->row();
    	return $row->count;
    	}
    	return 0;
    }
	
	
	/* Get Pending Deposit */
	public function admin_pending_deposit_count() {
		$this->db->select('COUNT(id) as count');
		$where = array('status' => 'Pending', 'payment_type' => 'Deposit');
    	$this->db->where($where);
		$this->db->from('transactions');
		$query = $this->db->get();
		if ($query->num_rows() > 0 )
    	{
    	$row = $query->row();
    	return $row->count;
    	}
    	return 0;
    }
	
	public function admin_pending_deposit($limit, $start)
    {
        $this->db->select('*');
		$where = array('status' => 'Pending', 'payment_type' => 'Deposit');
    	$this->db->where($where);
    	$this->db->from('transactions');
		$this->db->order_by("id", "desc");
		$this->db->limit($limit, $start);
		

    	$query = $this->db->get();
        return $query->result();
    }
	
	public function admin_count_pending_deposit()
    {
        $this->db->select('*');
    	$where = array('status' => 'Pending', 'payment_type' => 'Deposit');
    	$this->db->where($where);
    	$this->db->from('transactions');
		

    	$query = $this->db->get();
        return $query->num_rows();
    }
	
	public function admin_count_pending_withdrawal()
    {
        $this->db->select('*');
    	$where = array('status' => 'Pending', 'payment_type' => 'Deposit');
    	$this->db->where($where);
    	$this->db->from('transactions');
		

    	$query = $this->db->get();
        return $query->num_rows();
    }
	
	public function admin_pending_deposit_accept($user_data)
    {
        
		$this->db->set('status', 'Processed');
        $this->db->where('txn_id', $user_data['transaction_id']);

        $query = $this->db->update('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function admin_pending_withdrawal_accept($user_data)
    {
        
		$this->db->set('status', 'Processed');
        $this->db->where('txn_id', $user_data['transaction_id']);

        $query = $this->db->update('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function admin_cancel_deposit_accept($user_data)
    {
        
		$this->db->set('status', 'Cancel');
        $this->db->where('txn_id', $user_data['transaction_id']);

        $query = $this->db->update('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	public function admin_cancel_withdrawal_accept($user_data)
    {
        
		$this->db->set('status', 'Cancel');
        $this->db->where('txn_id', $user_data['transaction_id']);

        $query = $this->db->update('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* Get Pending Withdrawal */
	public function admin_pending_withdrawal_count() {
		$this->db->select('COUNT(id) as count');
		$where = array('status' => 'Pending', 'payment_type' => 'Withdraw');
    	$this->db->where($where);
		$this->db->from('transactions');
		$query = $this->db->get();
		if ($query->num_rows() > 0 )
    	{
    	$row = $query->row();
    	return $row->count;
    	}
    	return 0;
    }
	
	public function admin_pending_withdrawal($limit, $start)
    {
        $this->db->select('*');
		$where = array('status' => 'Pending', 'payment_type' => 'Withdraw');
    	$this->db->where($where);
    	$this->db->from('transactions');
		$this->db->order_by("id", "desc");
		$this->db->limit($limit, $start);
		

    	$query = $this->db->get();
        return $query->result();
    }
	
	/* Get Pending Verification count */
	public function admin_pending_verification_count() {
		$this->db->select('COUNT(id) as count');
		$where = array('status' => '2');
    	$this->db->where($where);
		$this->db->from('verification');
		$query = $this->db->get();
		if ($query->num_rows() > 0 )
    	{
    	$row = $query->row();
    	return $row->count;
    	}
    	return 0;
    }
	
	/* Get Pending Verification
	********/
	
	public function get_verification_search($limit, $start, $st = NULL)
    {
        $this->db->select('*');
    	$this->db->like('name',$st);
		$this->db->where('status','2');
    	$this->db->from('verification');
		$this->db->order_by("id", "desc");
		$this->db->limit($limit, $start);
		

    	$query = $this->db->get();
        return $query->result();
    }
	
	/* Verification ID Update
	*/
	public function verification_update($user_data) {
        $this->db->set('status', '1');
		$this->db->where('id', $user_data['id']);

        $query = $this->db->update('verification');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

	}
	
	/* Verification verify account
	*/
	public function verification_verify_account($user_data) {
	
		$this->db->set('send_money', '1');
		$this->db->set('request_money', '1');
		$this->db->set('add_fund', '1');
		$this->db->set('withdraw_fund', '1');
		$this->db->set('verified', '1');
		$this->db->where('id', $user_data['userid']);

        $this->db->update('users');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	/* Verification ID Cancel
	*/
	public function verification_cancel($user_data) {
        $this->db->set('status', '3');
		$this->db->where('id', $user_data['id']);

        $query = $this->db->update('verification');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

	}
	
	/* Get active voucher count */
	public function admin_active_voucher_count() {
		$this->db->select('COUNT(id) as count');
		$where = array('status' => '1');
    	$this->db->where($where);
		$this->db->from('voucher');
		$query = $this->db->get();
		if ($query->num_rows() > 0 )
    	{
    	$row = $query->row();
    	return $row->count;
    	}
    	return 0;
    }
	
	// Payment add
	public function add_payment_send($user_data) {

		$senderget = $this->core_model->core_get_user_with_email($this->session->email);
		$receiverget = $this->core_model->core_get_user_with_email($user_data['email']);
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
		
        $this->db->set('sender', $this->session->id);
		$this->db->set('sender_name', $sender_name);
		$this->db->set('sender_email', $senderget->email);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', $receiverget->email);
		$this->db->set('receiver_name', $receiver_name);
		$this->db->set('receiver_email', $receiverget->email);
		$this->db->set('receiver_mobile', $receiverget->mobile);
        $this->db->set('amount', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', '0.00');
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Processed');
		$this->db->set('payment_type', 'sent');
		$this->db->set('payment_method', 'Balance');
		$this->db->set('note', $user_data['note']);
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	// Payment deposit
	public function add_payment_deposit($user_data) {

		$receiverget = $this->core_model->core_get_user_with_email($user_data['email']);
		// Get receive name
		if ($receiverget->business_name) {
			$receiver_name = $receiverget->business_name;
		}else {
			$receiver_name =  $receiverget->full_name;
		}
		
		
        $this->db->set('sender', $receiverget->id);
		$this->db->set('sender_name', $receiver_name);
		$this->db->set('sender_email', $receiverget->email);
		$this->db->set('userid', $receiverget->id);
		$this->db->set('receiver', 'ADMIN - '.$receiver_name.'');
        $this->db->set('amount', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', '0.00');
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', $user_data['status_type']);
		$this->db->set('payment_type', 'Deposit');
		$this->db->set('payment_method', 'Card');
		$this->db->set('note', $user_data['note']);
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* User Update
	*/
	public function edit_user_update($user_data) {
		$this->db->set('first_name', $user_data['first_name']);
		$this->db->set('last_name', $user_data['last_name']);
		$this->db->set('full_name', $user_data['first_name'].' '.$user_data['last_name']);
		$this->db->set('email', $user_data['email']);
		$this->db->set('mobile', $user_data['mobile']);
		$this->db->set('country', $user_data['country']);
		
		if ($this->input->post('password')) {
		$this->db->set('password', password_hash($user_data['password'], PASSWORD_DEFAULT));
		}
		if ($this->input->post('business_name')) {
		$this->db->set('business_name', $user_data['business_name']);
		}
		$this->db->set('idcard', $user_data['idcard']);
		$this->db->set('idcard_type', $user_data['idcard_type']);
		$this->db->set('address1', $user_data['address1']);
		$this->db->set('address2', $user_data['address2']);
		$this->db->set('city', $user_data['city']);
		$this->db->set('state', $user_data['state']);
		$this->db->set('postal_code', $user_data['postal_code']);
		$this->db->set('curr_word', $user_data['currency']);
		$this->db->set('curr_symb', $this->helper->currency_symbol_select_option($user_data['currency']));
        $this->db->set('send_money', $user_data['send_money']);
		$this->db->set('request_money', $user_data['request_money']);
		$this->db->set('add_fund', $user_data['add_fund']);
		$this->db->set('withdraw_fund', $user_data['withdraw_fund']);
		$this->db->set('verified', $user_data['verified']);
		$this->db->where('email', $user_data['email']);

        $query = $this->db->update('users');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

	}
	
	/* Transaction
	********/
	
	public function get_core_transaction($limit, $start, $st = NULL)
    {
        $this->db->select('*');
    	$this->db->like('id',$st);
		$this->db->or_like('sender',$st);
		$this->db->or_like('sender_name',$st);
		$this->db->or_like('sender_email',$st);
		$this->db->or_like('txn_id',$st);
		$this->db->like('date BETWEEN "'. date('m-d-Y', strtotime($this->input->post('start'))). '" and "'. date('m-d-Y', strtotime($this->input->post('end'))).'"');
    	$this->db->from('transactions');
		$this->db->order_by("id", "desc");
		$this->db->limit($limit, $start);
		

    	$query = $this->db->get();
        return $query->result();
    }
    
    public function get_transaction_count_search($st = NULL)
    {
        $this->db->select('*');
    	$this->db->like('id',$st);
		$this->db->or_like('sender',$st);
		$this->db->or_like('sender_name',$st);
		$this->db->or_like('sender_email',$st);
		$this->db->or_like('txn_id',$st);
		$this->db->like('date BETWEEN "'. date('m-d-Y', strtotime($this->input->post('start'))). '" and "'. date('m-d-Y', strtotime($this->input->post('end'))).'"');
    	
    	$this->db->from('transactions');
		

    	$query = $this->db->get();
        return $query->num_rows();
    }
	
	// Payment deposit edit user
	public function edit_user_payment_deposit($user_data) {

		$receiverget = $this->core_model->core_get_user_with_email($user_data['email']);
		// Get receive name
		if ($receiverget->business_name) {
			$receiver_name = $receiverget->business_name;
		}else {
			$receiver_name =  $receiverget->full_name;
		}
		
		//Transaction validate input
		if ($user_data['txn_id']) {
			
			$transaction_input = $user_data['txn_id'];
		}else {
			
			$transaction_input = 'TXT'.rand(1000, 9999).'TZ'.time().'';
		}
		
		//Dare validate input
		if ($user_data['date']) {
			
			$date_input = strtotime(str_replace('/', '-', $user_data['date']));
		}else {
			
			$date_input = time();
		}
		
        $this->db->set('sender', $receiverget->id);
		$this->db->set('sender_name', $receiver_name);
		$this->db->set('sender_email', $receiverget->email);
		$this->db->set('userid', $receiverget->id);
		$this->db->set('receiver', $user_data['deposit_by']);
        $this->db->set('amount', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', '0.00');
		$this->db->set('txn_id', $transaction_input);
		$this->db->set('status', 'Processed');
		$this->db->set('payment_type', 'Deposit');
		$this->db->set('payment_method', $user_data['deposit_with']);
        $this->db->set('date', $date_input);

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	// Payment withdraw edit user
	public function edit_user_payment_withdraw($user_data) {

		$receiverget = $this->core_model->core_get_user_with_email($user_data['email']);
		// Get receive name
		if ($receiverget->business_name) {
			$receiver_name = $receiverget->business_name;
		}else {
			$receiver_name =  $receiverget->full_name;
		}
		
		//Transaction validate input
		if ($user_data['txn_id']) {
			
			$transaction_input = $user_data['txn_id'];
		}else {
			
			$transaction_input = 'TXT'.rand(1000, 9999).'TZ'.time().'';
		}
		
		//Dare validate input
		if ($user_data['date']) {
			
			$date_input = strtotime(str_replace('/', '-', $user_data['date']));
		}else {
			
			$date_input = time();
		}
		
        $this->db->set('sender', $receiverget->id);
		$this->db->set('sender_name', $receiver_name);
		$this->db->set('sender_email', $receiverget->email);
		$this->db->set('userid', $receiverget->id);
		$this->db->set('email_add', $user_data['name']);
		$this->db->set('receiver', $user_data['withdraw_by']);
        $this->db->set('amount', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', '0.00');
		$this->db->set('txn_id', $transaction_input);
		$this->db->set('status', 'Processed');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', $user_data['withdraw_with']);
        $this->db->set('date', $date_input);

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	
	public function admin_get_dispute_pending_listmoney(){
	
	$where = "payment_type = 'sent' AND status != 'Pending' AND dispute = '0'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('transactions');
	$this->db->limit(10, 0);
	$this->db->order_by("id", 'desc');
	
	$query = $this->db->get();
    return $query->result();
    
	}
	
	public function admin_get_dispute_refund_listmoney(){
	
	$where = "payment_type = 'refund' AND status != 'Pending' AND dispute = '2'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('transactions');
	$this->db->limit(10, 0);
	$this->db->order_by("id", 'desc');
	
	$query = $this->db->get();
    return $query->result();
    
	}
	
	public function admin_get_dispute_cancel_listmoney(){
	
	$where = "payment_type = 'sent' AND status != 'Pending' AND dispute = '3'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('transactions');
	$this->db->limit(10, 0);
	$this->db->order_by("id", 'desc');
	
	$query = $this->db->get();
    return $query->result();
    
	}
	
	/* Dispute waiting count
	*/
	public function dispute_waiting_count()
  {
    
    $this->db->select('COUNT(*) as count');
    $this->db->from('transactions');
    $where = "payment_type = 'sent' AND status != 'Pending' AND dispute = '1'";
	$this->db->where($where);
    $query = $this->db->get();
    if ($query->num_rows() > 0 )
    {
    $row = $query->row();
    return $row->count;
    }
    return 0;
  }
  
  /* Dispute Refunded count
	*/
	public function dispute_refunded_count()
  {
    $this->db->select('COUNT(*) as count');
    $this->db->from('transactions');
    $where = "payment_type = 'refund' AND status != 'Pending' AND dispute = '2'";
	$this->db->where($where);
    $query = $this->db->get();
    if ($query->num_rows() > 0 )
    {
    $row = $query->row();
    return $row->count;
    }
    return 0;
  }
  
  /* Dispute Cancel count
	*/
	public function dispute_cancel_count()
  {
    $this->db->select('COUNT(*) as count');
    $this->db->from('transactions');
    $where = "payment_type = 'sent' AND status != 'Pending' AND dispute = '3'";
	$this->db->where($where);
    $query = $this->db->get();
    if ($query->num_rows() > 0 )
    {
    $row = $query->row();
    return $row->count;
    }
    return 0;
  }
	
	
	/*******
	Dispute Refund */
	public function dispute_refund($user_data) {

		$senderget = $this->core_model->core_get_user_with_email($this->session->email);
		$receiverget = $this->core_model->core_get_user_with_email($user_data['receiver']);
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
		
		$this->db->set('sender', $this->session->id);
		$this->db->set('sender_name', $sender_name);
		$this->db->set('sender_email', $senderget->email);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', $receiverget->email);
		$this->db->set('receiver_name', $receiver_name);
		$this->db->set('receiver_email', $receiverget->email);
		$this->db->set('receiver_mobile', $receiverget->mobile);
		$this->db->set('status', 'Processed');
		$this->db->set('payment_type', 'refund');
		$this->db->set('payment_method', 'Balance');
		$this->db->set('note', 'Payment Refund');
		$this->db->set('dispute', '2');
        $this->db->set('date', time());
		$this->db->where('txn_id', $user_data['dispute_txn_id']);

        $this->db->update('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* Dispute refund with Card
	***********/
	public function dispute_refund_with_card($refundid){
        
		$this->db->where('txn_id', $this->input->post('dispute_txn_id', TRUE));
		$this->db->update('transactions', $refundid);

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	public function getlist_dispute_waiting(){
	$where = "payment_type = 'sent' AND status != 'Pending' AND dispute = '1'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('transactions');
	$this->db->limit(10, 0);
	$this->db->order_by("id", 'desc');
	
	$query = $this->db->get();
    return $query->result();
    
	}
	
	public function get_price_active($limit, $start) 
    {
    $where = "status='1'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('voucher_value');
	$this->db->order_by("id", "desc");
	$this->db->limit($limit, $start);
 
    $query = $this->db->get();
    return $query->result();
    }
	
	public function count_all_price_active()
    {
    $where = "status='1'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('voucher_value');
		

    	$query = $this->db->get();
        return $query->num_rows();
    }
	
	public function voucher_price_store($voucher) {
	
		$this->db->set('date', time());
		$this->db->set('amount', number_format($voucher['amount'], 2, '.', ''));
		$this->db->set('currency', $voucher['currency']);
		$this->db->set('status', '1');
		

        $this->db->insert('voucher_value');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	public function voucher_price_update($voucher) {
	
		$this->db->set('date', time());
		$this->db->set('amount', number_format($voucher['amount'], 2, '.', ''));
		$this->db->set('currency', $voucher['currency']);
		$this->db->where('id', $voucher['id']);
		

        $this->db->update('voucher_value');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	
	public function voucher_price_delete($voucher) {
	
		$this->db->where('id', $voucher['id']);
		

        $this->db->delete('voucher_value');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	public function get_voucher_active($limit, $start) 
    {
    $where = "status='1' AND amount !='0.00'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('voucher');
	$this->db->order_by("id", "desc");
	$this->db->limit($limit, $start);
 
    $query = $this->db->get();
    return $query->result();
    }
	
	public function count_all_voucher_active()
    {
    $where = "status='1' AND amount !='0.00'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('voucher');
		

    	$query = $this->db->get();
        return $query->num_rows();
    }
	
	
	
	public function get_voucher_expired($limit, $start) 
    {
    $where = "amount='0.00'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('voucher');
	$this->db->order_by("id", "desc");
	$this->db->limit($limit, $start);
 
    $query = $this->db->get();
    return $query->result();
    }
	
	public function count_all_voucher_expired()
    {
    $where = "amount='0.00'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('voucher');
		

    	$query = $this->db->get();
        return $query->num_rows();
    }
	
	public function get_voucher_report($limit, $start) 
    {
    $where = "status='1'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('voucher_report');
	$this->db->order_by("id", "desc");
	$this->db->limit($limit, $start);
 
    $query = $this->db->get();
    return $query->result();
    }
	
	public function count_all_voucher_report()
    {
    $where = "status='1'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('voucher_report');
		

    	$query = $this->db->get();
        return $query->num_rows();
    }
	public function voucher_deactive($active) {
	
		$this->db->set('amount', '0.00');
		$this->db->set('status', '2');
		$this->db->where('id', $active['id']);
		

        $this->db->update('voucher');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	public function voucher_update($voucher) {
	
		$this->db->set('amount', number_format($voucher['amount'], 2, '.', ''));
		$this->db->set('mobile', $voucher['mobile']);
		$this->db->set('pin', $voucher['pin']);
		$this->db->set('cvc', $voucher['cvc']);
		$this->db->where('id', $voucher['id']);
		

        $this->db->update('voucher');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	public function voucher_expired_update($voucher) {
	
		$this->db->set('amount', number_format($voucher['amount'], 2, '.', ''));
		$this->db->set('mobile', $voucher['mobile']);
		$this->db->set('pin', $voucher['pin']);
		$this->db->set('cvc', $voucher['cvc']);
		if (number_format($this->input->post('amount'), 2, '.', '') == '0.00') {
		$this->db->set('status', '2');	
		}else {
			$this->db->set('status', '1');
		}
		$this->db->where('id', $voucher['id']);
		

        $this->db->update('voucher');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	public function voucher_delete($active) {
	
		$this->db->where('id', $active['id']);
		

        $this->db->delete('voucher');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	public function voucher_report_delete($active) {
	
		$this->db->where('id', $active['id']);
		

        $this->db->delete('voucher_report');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	public function save_voucher($voucher) {
	
		$this->db->set('date', time());
		$this->db->set('currency_code', $voucher['currency_code']);
		$this->db->set('amount', number_format($voucher['amount'], 2, '.', ''));
		$this->db->set('total', number_format($voucher['amount'], 2, '.', ''));
		$this->db->set('mobile', $voucher['mobile']);
		$this->db->set('pin', $voucher['code']);
		$this->db->set('cvc', rand(100, 856));
		$this->db->set('userid', $this->session->id);
		$this->db->set('country', $this->session->country);
		$this->db->set('status', '1');
		

        $this->db->insert('voucher');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	public function get_pending_bank_verification($limit, $start) 
    {
    $where = "status='2'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('bank_verification');
	$this->db->order_by("id", "desc");
	$this->db->limit($limit, $start);
 
    $query = $this->db->get();
    return $query->result();
    }
	
	public function count_all_pending_bank_verification()
    {
    $where = "status='2'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('bank_verification');
		

    	$query = $this->db->get();
        return $query->num_rows();
    }
	
	public function update_bank_verification($bank) {
	
		$this->db->set('status', '1');
		$this->db->where('account', $bank['account']);
		

        $this->db->update('bank_verification');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	public function cancel_bank_verification($bank) {
	
		$this->db->where('account', $bank['account']);
		

        $this->db->delete('bank_verification');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	public function update_bank_account($bank) {
	
		$this->db->set('status', '1');
		$this->db->where('acno', $bank['account']);
		

        $this->db->update('bankaccount');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	public function delete_bank_account($bank) {
	
		$this->db->where('acno', $bank['account']);
		

        $this->db->delete('bankaccount');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
}