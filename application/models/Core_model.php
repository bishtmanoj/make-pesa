<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Core_model extends CI_Model {
	/* Core Model */
	public function get_bk_core_settings() {

    	$this->db->select('setting_key, setting_value');
    	$this->db->from('settings');

    	$query = $this->db->get();

        if ($query) {

            $core_settings = $query->result();

            foreach ($core_settings as $setting) {
            	$site_settings[$setting->setting_key] = $setting->setting_value;
            }

            return (object) $site_settings;

        } else {
            return FALSE;
        }

    }
	
	/* Get theme name
	*/
	public function get_core_bk_theme_name() {
		$themename = $this->config->item('themes_path').'/'.$this->site_settings->theme_name;
		return $themename;
	}
	
	/* Personal Account data form store
	*/
	public function personal_signup($personal_data) {
	
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
	public function business_signup($business_data) {
	
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
	
	/* Get Merchant with email or Merchant ID
	*/
	public function core_get_merchant_with_email_or_id($post_data) {

    	$this->db->select('*');
    	$this->db->from('users');
		$this->db->where('email', $post_data);
		$this->db->or_where('merchant_id', $post_data);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row_array();
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
	
	/* Get user info with pin
	*/
	public function core_user_forgot_code_validate($get_pin) {

    	$this->db->select('*');
    	$this->db->from('users');
    	$this->db->where('code', $get_pin);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	/* Get user info with pin
	*/
	public function core_get_user_with_code_or_pin_validate($get_pin) {

    	$this->db->select('*');
    	$this->db->from('users');
    	$this->db->where('code', $get_pin);
		$this->db->or_where('pin', $get_pin);

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
	
	/* Get Recepient details */
	public function get_bk_core_recepient_details() {

    	$this->db->select('*');
    	$this->db->from('users');
    	$this->db->where('email', $this->session->payer_id);
		$this->db->or_where('mobile', $this->session->payer_id);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	
	
	/* Password update
	*/
	public function security_password_update($password_data) {
        $this->db->set('password', password_hash($password_data['password'], PASSWORD_DEFAULT));
		$this->db->where('id', $this->session->id);

        $query = $this->db->update('users');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

	}
	
	/* PIN update
	*/
	public function security_pin_update($pin_data) {
        $this->db->set('pin', $pin_data['pin']);
		$this->db->where('id', $this->session->id);

        $query = $this->db->update('users');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

	}
	
	/* Forgot password code update
	*/
	public function login_two_factor() {
        $this->db->set('code', rand(1000, 9999));
		$this->db->where('email', $this->input->post('email_username_mobile', TRUE));
		$this->db->or_where('mobile', $this->input->post('email_username_mobile', TRUE));

        $query = $this->db->update('users');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

	}
	
	/* Two-factor sms code update
	*/
	public function two_fator_login_code_update() {
        $this->db->set('code', rand(1000, 9999));
		$this->db->where('email', $this->input->post('email_username_mobile', TRUE));
		$this->db->or_where('mobile', $this->input->post('email_username_mobile', TRUE));

        $query = $this->db->update('users');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

	}
	
	/* Forgot password code update
	*/
	public function forgot_password_code_send() {
        $this->db->set('code', rand(1000, 9999));
		$this->db->where('email', $this->session->email_mobile);
		$this->db->or_where('mobile', $this->session->email_mobile);

        $query = $this->db->update('users');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

	}
	
	
	/* Forgot Password update
	*/
	public function forgot_password_change($password_data) {
        $this->db->set('password', password_hash($password_data['password'], PASSWORD_DEFAULT));
		$this->db->set('code', '');
		$this->db->where('email', $this->session->email_mobile);
		$this->db->or_where('mobile', $this->session->email_mobile);

        $query = $this->db->update('users');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

	}
	
	/* Get Verifiy card code
	*/
	public function core_get_card_verify_code($get_code) {

    	$this->db->select('*');
    	$this->db->from('bankcard');
    	$this->db->where('code', $get_code);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	/* Verifiy card code update
	*/
	public function verify_card_code_update($card_data) {
        $this->db->set('code', '');
		$this->db->set('verified', '1');
		$this->db->where('id', $card_data['id']);

        $query = $this->db->update('bankcard');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

	}
	
	/* Get card details
	*/
	public function core_get_card_details($get_number) {

    	$this->db->select('*');
    	$this->db->from('bankcard');
    	$this->db->where('number', $get_number);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	/* Get bank support details
	*/
	public function core_get_bank_support_info() {

    	$this->db->select('*');
    	$this->db->from('bank_support');
    	$this->db->where('data_name', $this->input->post('bankname'));

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	/* Get card type */
	public function core_get_card_type(){
	
	$this->db->select('*');
    $this->db->from('cardaccept');
	$this->db->where('status', '1');
    $query = $this->db->get();
    return $query->result();
    }
	
	/* Get local card type */
	public function core_get_local_card_type(){
	
	$this->db->select('*');
    $this->db->from('local_cardaccept');
	$this->db->where('status', '1');
    $query = $this->db->get();
    return $query->result();
    }
	
	/* Get Country country */
	public function core_get_country_data(){
	
	$this->db->select('*');
    $this->db->from('country_list');
    $query = $this->db->get();
    return $query->result();
    }
	
	/* Get idcard type */
	public function core_get_idcard_type(){
	
	$this->db->select('status, name, code');
    $this->db->from('idcard_accept');
	$this->db->where('status', '1');
    $query = $this->db->get();
    return $query->result();
    }
	
	/* Get currency */
	public function core_get_currency(){
	
	$this->db->select('status, symbol, name');
    $this->db->from('currency_word');
	$this->db->where('status', '1');
    $query = $this->db->get();
    return $query->result();
    }
	
	/* Get currency symbol */
	public function core_get_currency_symbol($word){
	
	$this->db->select('status, symbol');
    $this->db->from('currency_word');
	$this->db->where('name', $word);
    $query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row_array();
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
		$this->db->like('txn_id',$st);
		$where = "payment_type != 'request' AND sender = '".$this->session->id."' OR receiver = '".$this->session->email."'";
		$this->db->where($where);
		$this->db->from('transactions');
		$this->db->order_by("id", "desc");
		$this->db->limit($limit, $start);
		

    	$query = $this->db->get();
        return $query->result();
    }
    
    public function get_transaction_count_search($st = NULL)
    {
        $this->db->select('*');
    	$this->db->like('txn_id',$st);
		$where = "payment_type != 'request' AND sender = '".$this->session->id."' OR receiver = '".$this->session->email."'";
		$this->db->where($where);
		
    	$this->db->from('transactions');
		

    	$query = $this->db->get();
        return $query->num_rows();
    }
	
	/* Card get on sending payment
	******/
	public function get_bk_core_get_card_default() {

    	$this->db->select('*');
    	$this->db->from('bankcard');
    	$array = array('userid' => $this->session->id, 'verified' => '1', 'default_card' => '1');
    	$this->db->where($array);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	/* Get local card
	******/
	public function get_bk_core_get_local_card() {

    	$this->db->select('*');
    	$this->db->from('bankcard');
    	$this->db->where('id', $this->input->post('card'));

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	/* Get local bank
	******/
	public function get_bk_core_get_local_bank() {

    	$this->db->select('*');
    	$this->db->from('bankaccount');
    	$this->db->where('id', $this->input->post('bank'));

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	/* Get local bank wallet
	******/
	public function get_bk_core_get_local_bank_data($bank_no) {

    	$this->db->select('*');
    	$this->db->from('bankaccount');
    	$this->db->where('acno', $bank_no);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	/* Card get details
	******/
	public function get_bk_core_get_card_details($user_data) {

    	$this->db->select('*');
    	$this->db->from('bankcard');
    	$this->db->where('id', $user_data['id']);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row();
    	} else {
    		return FALSE;
    	}

    }
	
	// Sendning Payment with Balance
	public function send_money($user_data) {

		$senderget = $this->core_model->core_get_user_with_email($this->session->email);
		$receiverget = $this->core_model->core_get_user_with_email($user_data['next_email']);
		$fees = $user_data['amount']*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
		$amount = $user_data['amount'] - $fees;
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
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Processed');
		$this->db->set('payment_type', 'sent');
		$this->db->set('dispute', '0');
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
	
	
	// Sending Money with card
	public function card_send_money($data2){
        $this->db->insert('transactions', $data2);

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	 /* Request payment
	 ********/
	 public function request_money($user_data) {

       	$senderget = $this->core_model->core_get_user_with_email($this->session->email);
		$receiverget = $this->core_model->core_get_user_with_email($user_data['receipt']);
		$fees = $user_data['amount']*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
		$amount = $user_data['amount'] - $fees;
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
		$this->db->set('userid', $this->session->id);
		$this->db->set('sender_name', $sender_name);
		$this->db->set('sender_email', $senderget->email);
		$this->db->set('receiver', $receiverget->email);
		$this->db->set('receiver_name', $receiver_name);
		$this->db->set('receiver_email', $receiverget->email);
		$this->db->set('receiver_mobile', $receiverget->mobile);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'request');
		$this->db->set('note', $user_data['note']);
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	// Update request payment
	public function accept_request() {
		$this->id = $this->input->get('id', TRUE);
		$this->amount = $this->input->get('amount', TRUE);
		
		$senderget = $this->core_model->core_get_user_with_email($this->session->email);
		$receiverget = $this->core_model->core_get_user_with_email($this->input->get('email', TRUE));
		$fees = $this->amount*$this->site_settings->sendmoney_percentage_fees/100 + $this->site_settings->sendmoney_flat_fees;
		$amount = $this->amount - $fees;
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
		
		$this->db->set('status', 'Processed');
		$this->db->set('payment_type', 'sent');
		$this->db->set('sender', $this->session->id);
		$this->db->set('sender_name', $sender_name);
		$this->db->set('sender_email', $senderget->email);
		$this->db->set('receiver', $receiverget->email);
		$this->db->set('receiver_name', $receiver_name);
		$this->db->set('receiver_mobile', $receiverget->mobile);
		$this->db->set('payment_method', 'Balance');
		$this->db->set('note', '');
		$this->db->set('userid', $this->session->id);
		$this->db->where('txn_id', $this->id);
		$this->db->update('transactions');
		
		if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	// Accept request payment with card
	public function card_request_accept_money($data2){
        
		$this->db->where('txn_id', $this->input->get('id', TRUE));
		$this->db->update('transactions', $data2);

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	// Cancel pending payment request
	public function cancel_request() {
		$this->id = $this->input->get('id', TRUE);
		$this->db->set('status', 'Cancel');
		$this->db->where('txn_id', $this->id);
		$this->db->update('transactions');
		
		if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	// Remove cancel payment request
	public function delete_request() {
		$this->id = $this->input->get('id', TRUE);
		$this->db->where('txn_id', $this->id);
		$this->db->delete('transactions');
		
		if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	// Resend pending payment request
	public function resend_request() {
		$this->db->set('status', 'Pending');
		$this->db->where('txn_id', $this->input->get('id', TRUE));
		$this->db->update('transactions');
		
		if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	/* Payment refund with Balance
	***********/
	public function refund_money($user_data) {

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
		$this->db->set('amount', $user_data['amount']);
		$this->db->set('note', 'Payment Refund');
        $this->db->set('date', time());
		$this->db->where('txn_id', $user_data['transaction_id']);

        $this->db->update('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* Payment refund with Card
	***********/
	public function refund_money_with_card($refundid){
        
		$this->db->where('txn_id', $this->input->post('transaction_id', TRUE));
		$this->db->update('transactions', $refundid);

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	
	/* Profile name update
	***********/
	public function profile_name_update($user_data) {

		$this->db->set('first_name', $user_data['first_name']);
		$this->db->set('last_name', $user_data['last_name']);
		$this->db->set('full_name', $user_data['first_name'].' '.$user_data['last_name']);
		$this->db->set('business_name', $user_data['business_name']);
		$this->db->where('id', $this->session->id);

        $this->db->update('users');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* Profile image upload store
	***********/
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
	
	/* Profile ID card update
	***********/
	public function profile_idcard_update($user_data) {

		$this->db->set('idcard_type', $user_data['idcard_type']);
		$this->db->set('idcard', $user_data['number']);
		$this->db->where('id', $this->session->id);

        $this->db->update('users');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* Profile address update
	***********/
	public function profile_address_update($user_data) {

		$this->db->set('address1', $user_data['address1']);
		$this->db->set('address2', $user_data['address2']);
		$this->db->set('city', $user_data['city']);
		$this->db->set('state', $user_data['state']);
		$this->db->set('postal_code', $user_data['postal_code']);
		$this->db->where('id', $this->session->id);

        $this->db->update('users');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* Get active card 
	*****************/
	public function core_get_active_card(){
	
	$array = array('userid' => $this->session->id, 'verified' => '1', 'status' => '1', 'local !='  => '1');
    $this->db->where($array);
    $this->db->select('*');
    $this->db->from('bankcard');
	$this->db->order_by("id", "desc");
    $query = $this->db->get();
    return $query->result();
    }
	
	/* Get Local active card 
	*****************/
	public function core_get_local_active_card(){
	
	$array = array('userid' => $this->session->id, 'verified' => '1', 'status' => '1', 'local' => '1');
    $this->db->where($array);
    $this->db->select('*');
    $this->db->from('bankcard');
	$this->db->order_by("id", "desc");
    $query = $this->db->get();
    return $query->result();
    }
	
	/* Get active info card 
	*****************/
	public function core_check_card_info($card_data){
	
	$this->db->select('*');
    $this->db->from('bankcard');
    $this->db->where('id', $card_data);

    $query = $this->db->get();

    if ($query->num_rows() == 1) {
    	return $query->row();
    } else {
    	return FALSE;
    	}
    }
	
	/* Get active bank 
	*****************/
	public function core_check_bank_info($bank_data){
	
	$this->db->select('*');
    $this->db->from('bankaccount');
    $this->db->where('id', $bank_data);

    $query = $this->db->get();

    if ($query->num_rows() == 1) {
    	return $query->row();
    } else {
    	return FALSE;
    	}
    }
	
	// Deposit Fund with card
	public function fund_deposit_with_card($data2){
        $this->db->insert('transactions', $data2);

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	// Update local transactio
	public function fund_deposit_update_local_transaction($data2){
		$this->db->set('status', 'Processed');
		$this->db->where('txn_id', $data2);
        $this->db->update('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	// Cancel local transactio
	public function fund_deposit_cancel_local_transaction($data2){
		$this->db->set('status', 'Cancel');
		$this->db->where('txn_id', $data2);
        $this->db->update('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	// Deposit Fund with bank
	public function fund_deposit_with_bank($user_data) {

	    $senderget = $this->core_model->core_get_user_with_email($this->session->email);
	    $fees = $user_data['amount']*$this->site_settings->bank_deposit_percentage_fees/100 + $this->site_settings->bank_deposit_flat_fees;
		$amount = $user_data['amount'] - $fees;
		
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
		$this->db->set('receiver', 'Bank - '.$sender_name.'');
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Deposit');
		$this->db->set('payment_method', 'Bank');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	// Deposit Fund with Western Union
	public function fund_deposit_with_western($user_data) {

	    $senderget = $this->core_model->core_get_user_with_email($this->session->email);
	    $fees = $user_data['amount']*$this->site_settings->deposit_western_percentage_fees/100 + $this->site_settings->deposit_western_flat_fees;
		$amount = $user_data['amount'] - $fees;
		
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
		$this->db->set('receiver', 'WESTERN UNION - '.$sender_name.'');
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Deposit');
		$this->db->set('payment_method', 'WESTERN UNION');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	
	// Deposit Fund with M-PESA
	public function fund_deposit_with_mpesa($user_data) {

	    $senderget = $this->core_model->core_get_user_with_email($this->session->email);
	    $fees = $user_data['amount']*$this->site_settings->deposit_mpesa_percentage_fees/100 + $this->site_settings->deposit_mpesa_flat_fees;
		$amount = $user_data['amount'] - $fees;
		
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
		$this->db->set('receiver', 'M-PESA - '.$sender_name.'');
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Deposit');
		$this->db->set('payment_method', 'M-PESA');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	// Deposit Fund with TIGO-PESA
	public function fund_deposit_with_tigopesa($user_data) {

	    $senderget = $this->core_model->core_get_user_with_email($this->session->email);
	    $fees = $user_data['amount']*$this->site_settings->deposit_tigopesa_percentage_fees/100 + $this->site_settings->deposit_tigopesa_flat_fees;
		$amount = $user_data['amount'] - $fees;
		
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
		$this->db->set('receiver', 'TIGO-PESA - '.$sender_name.'');
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Deposit');
		$this->db->set('payment_method', 'TIGO-PESA');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	// Deposit Fund with MTN
	public function fund_deposit_with_mtn($user_data) {

	    $senderget = $this->core_model->core_get_user_with_email($this->session->email);
	    $fees = $user_data['amount']*$this->site_settings->deposit_mtn_percentage_fees/100 + $this->site_settings->deposit_mtn_flat_fees;
		$amount = $user_data['amount'] - $fees;
		
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
		$this->db->set('receiver', 'MTN - '.$sender_name.'');
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Deposit');
		$this->db->set('payment_method', 'MTN');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	// Deposit Fund with ORANGE
	public function fund_deposit_with_orange($user_data) {

	    $senderget = $this->core_model->core_get_user_with_email($this->session->email);
	    $fees = $user_data['amount']*$this->site_settings->deposit_orange_percentage_fees/100 + $this->site_settings->deposit_orange_flat_fees;
		$amount = $user_data['amount'] - $fees;
		
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
		$this->db->set('receiver', 'ORANGE - '.$sender_name.'');
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Deposit');
		$this->db->set('payment_method', 'ORANGE');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	// Deposit Fund with Paypal
	public function fund_deposit_with_paypal($data){
        $this->db->insert('transactions', $data);

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	/* CARD Withdraw
	****/
	public function fund_withdraw_with_card($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_card_percentage_fees/100 + $this->site_settings->withdraw_card_flat_fees;
		$amount = $user_data['amount'] - $fees;
	    $carddata = $this->core_model->core_check_card_info($this->input->post('card', TRUE));
		$CardInfo = 'Card Name: '.$carddata->name.' </br> 
		 Card Number: '.$carddata->number.' </br>
		 Month: '.$carddata->month.' </br>
		 Exp Year: '.$carddata->exp_year.'';
	
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('email_add', $CardInfo);
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
	
	/* BANK Withdraw
	****/
	public function fund_withdraw_with_bank($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_bank_percentage_fees/100 + $this->site_settings->withdraw_bank_flat_fees;
		$amount = $user_data['amount'] - $fees;
	    $bankdata = $this->core_model->core_check_bank_info($this->input->post('bank', TRUE));
		$BankInfo = 'Account Name: '.$bankdata->acname.' </br> 
		 Account Number: '.$bankdata->acno.' </br>
		 Bank Name: '.$bankdata->bankname.' </br>
		 SWIFT Code: '.$bankdata->swift.' </br>
		 Branch Name: '.$bankdata->branchname.' </br>
		 City: '.$bankdata->city.' </br>
		 Country: '.$bankdata->country.'';
	
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('email_add', $BankInfo);
		$this->db->set('receiver', 'BANK - '.$bankdata->acno.'');
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
	
	/* M-PESA Withdraw
	****/
	public function fund_withdraw_with_mpesa($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_mpesa_percentage_fees/100 + $this->site_settings->withdraw_mpesa_flat_fees;
		$amount = $user_data['amount'] - $fees;
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'M-PESA : '.$user_data['mobile'].'');
		$this->db->set('email_add', $user_data['mobile']);
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
	
	/* TIGO-PESA Withdraw
	****/
	public function fund_withdraw_with_tigopesa($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_tigopesa_percentage_fees/100 + $this->site_settings->withdraw_tigopesa_flat_fees;
		$amount = $user_data['amount'] - $fees;
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'TIGO-PESA : '.$user_data['mobile'].'');
		$this->db->set('email_add', $user_data['mobile']);
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
	
	/* MTN Withdraw
	****/
	public function fund_withdraw_with_mtn($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_mtn_percentage_fees/100 + $this->site_settings->mtn_tigopesa_flat_fees;
		$amount = $user_data['amount'] - $fees;
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'MTN : '.$user_data['mobile'].'');
		$this->db->set('email_add', $user_data['mobile']);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'MTN');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* ORANGE Withdraw
	****/
	public function fund_withdraw_with_orange($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_orange_percentage_fees/100 + $this->site_settings->withdraw_orange_flat_fees;
		$amount = $user_data['amount'] - $fees;
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'ORANGE : '.$user_data['mobile'].'');
		$this->db->set('email_add', $user_data['mobile']);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'ORANGE');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	
	/* Bitcoin Withdraw
	****/
	public function fund_withdraw_with_bitcoin($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_bitcoin_percentage_fees/100 + $this->site_settings->withdraw_bitcoin_flat_fees;
		$amount = $user_data['amount'] - $fees;
		
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'Bitcoin - '.$user_data['address'].'');
		$this->db->set('email_add', $user_data['address']);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'Bitcoin');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* Paypal Withdraw
	****/
	public function fund_withdraw_with_paypal($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_paypal_percentage_fees/100 + $this->site_settings->withdraw_paypal_flat_fees;
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
	
	
	/* WESTERN UNION Withdraw
	****/
	public function fund_withdraw_with_western($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_western_percentage_fees/100 + $this->site_settings->withdraw_western_flat_fees;
		$amount = $user_data['amount'] - $fees;
	    $WesternInfo = 'Name: '.$user_data['name'].' </br> 
		 City: '.$user_data['city'].' </br>
		 Country: '.$user_data['country'].' </br>
		 Phone: '.$user_data['phone'].'';
	
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('email_add', $WesternInfo);
		$this->db->set('receiver', 'WESTERN UNION - '.$user_data['name'].'');
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('note', $WesternInfo);
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'WESTERN UNION');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* MoneyGram Withdraw
	****/
	public function fund_withdraw_with_moneygram($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_moneygram_percentage_fees/100 + $this->site_settings->withdraw_moneygram_flat_fees;
		$amount = $user_data['amount'] - $fees;
	    $MoneyGramInfo = 'Name: '.$user_data['name'].' </br> 
		 City: '.$user_data['city'].' </br>
		 Country: '.$user_data['country'].' </br>
		 Phone: '.$user_data['phone'].'';
	
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('email_add', $MoneyGramInfo);
		$this->db->set('receiver', 'MoneyGram - '.$user_data['name'].'');
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('note', $MoneyGramInfo);
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'MoneyGram');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* PerfectMoney Withdraw
	****/
	public function fund_withdraw_with_perfectmoney($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_perfectmoney_percentage_fees/100 + $this->site_settings->withdraw_perfectmoney_flat_fees;
		$amount = $user_data['amount'] - $fees;
		
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'PerfectMoney - '.$user_data['perfectmoney_address'].'');
		$this->db->set('email_add', $user_data['perfectmoney_address']);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'PerfectMoney');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* Neteller Withdraw
	****/
	public function fund_withdraw_with_neteller($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_neteller_percentage_fees/100 + $this->site_settings->withdraw_neteller_flat_fees;
		$amount = $user_data['amount'] - $fees;
		
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'NETELLER - '.$user_data['neteller_email'].'');
		$this->db->set('email_add', $user_data['neteller_email']);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'NETELLER');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* Skrill Withdraw
	****/
	public function fund_withdraw_with_skrill($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_skrill_percentage_fees/100 + $this->site_settings->withdraw_skrill_flat_fees;
		$amount = $user_data['amount'] - $fees;
		
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'SKRILL - '.$user_data['skrill_email'].'');
		$this->db->set('email_add', $user_data['skrill_email']);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'SKRILL');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* Payza Withdraw
	****/
	public function fund_withdraw_with_payza($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_payza_percentage_fees/100 + $this->site_settings->withdraw_payza_flat_fees;
		$amount = $user_data['amount'] - $fees;
		
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'PAYZA - '.$user_data['payza_email'].'');
		$this->db->set('email_add', $user_data['payza_email']);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'PAYZA');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* Payu Withdraw
	****/
	public function fund_withdraw_with_payu($user_data) {

		$fees = $user_data['amount']*$this->site_settings->withdraw_payu_percentage_fees/100 + $this->site_settings->withdraw_payu_flat_fees;
		$amount = $user_data['amount'] - $fees;
		
	    $this->db->set('sender', $this->session->id);
		$this->db->set('userid', $this->session->id);
		$this->db->set('receiver', 'PAYU - '.$user_data['payu_address'].'');
		$this->db->set('email_add', $user_data['payu_address']);
        $this->db->set('amount', number_format($amount, 2, '.', ''));
		$this->db->set('total', number_format($user_data['amount'], 2, '.', ''));
		$this->db->set('fees', number_format($fees, 2));
		$this->db->set('txn_id', 'TXT'.rand(1000, 9999).'TZ'.time().'');
		$this->db->set('status', 'Pending');
		$this->db->set('payment_type', 'Withdraw');
		$this->db->set('payment_method', 'PAYU');
        $this->db->set('date', time());

        $this->db->insert('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* Verification ID form submit
	***********/
	public function bk_core_verification_id_store($filename)
    {
        
		$this->db->set('userid', $this->session->id);
		$this->db->set('name', $this->session->full_name);
		$this->db->set('status', '2');
		$this->db->set('card_type', $this->input->post('idcard_type'));
		$this->db->set('card', '1');
		$this->db->set('file', $filename);
		$this->db->set('date', time());
		$this->db->set('country', $this->session->country);
		$this->db->set('mobile', $this->session->mobile);
		$this->db->set('account_type', $this->helper->account_status());
		$this->db->set('email', $this->session->email);

        $query = $this->db->insert('verification');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* Verification Address form submit
	***********/
	public function bk_core_verification_address_store($filename)
    {
        
		$this->db->set('userid', $this->session->id);
		$this->db->set('name', $this->session->full_name);
		$this->db->set('status', '2');
		$this->db->set('card_type', 'Address');
		$this->db->set('card', '2');
		$this->db->set('file', $filename);
		$this->db->set('date', time());
		$this->db->set('country', $this->session->country);
		$this->db->set('mobile', $this->session->mobile);
		$this->db->set('account_type', $this->helper->account_status());
		$this->db->set('email', $this->session->email);

        $query = $this->db->insert('verification');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* Verification BVN form submit
	***********/
	public function bk_core_verification_bvn_store($user_data)
    {
        
		$this->db->set('userid', $this->session->id);
		$this->db->set('name', $this->user->full_name);
		$this->db->set('status', '2');
		$this->db->set('card_type', 'BVN');
		$this->db->set('card', '3');
		$this->db->set('bvn', $user_data['bvn']);
		$this->db->set('date', time());
		$this->db->set('country', $this->user->country);
		$this->db->set('mobile', $this->user->mobile);
		$this->db->set('account_type', $this->helper->account_status());
		$this->db->set('email', $this->user->email);

        $query = $this->db->insert('verification');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }
	
	/* Verification get ID
	***************/
	public function get_verification_id() {

    	$this->db->select('*');
    	$this->db->from('verification');
    	$array = array('userid' => $this->session->id, 'card' => '1');
    	$this->db->where($array);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row_array();
    	} else {
    		return FALSE;
    	}

    }
	
	/* Verification get Address
	***************/
	public function get_verification_address() {

    	$this->db->select('*');
    	$this->db->from('verification');
    	$array = array('userid' => $this->session->id, 'card' => '2');
    	$this->db->where($array);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row_array();
    	} else {
    		return FALSE;
    	}

    }
	
	
	/* Get transaction
	***************/
	public function get_transaction_txn($txn) {

    	$this->db->select('*');
    	$this->db->from('transactions');
    	$array = array('txn_id' => $txn, 'status !=' => 'Cancel');
    	$this->db->where($array);

    	$query = $this->db->get();

    	if ($query->num_rows() == 1) {
    		return $query->row_array();
    	} else {
    		return FALSE;
    	}

    }
	
	
}