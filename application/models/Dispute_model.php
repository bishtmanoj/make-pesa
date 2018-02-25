<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dispute_model extends CI_Model {
	
	/* Get all sent Payment
	*/
	public function getlistmoney(){
	$where = "payment_type = 'sent' AND status != 'Pending' AND sender = '".$this->session->id."' AND dispute = '0'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('transactions');
	$this->db->limit(10, 0);
	$this->db->order_by("id", 'desc');
	
	$query = $this->db->get();
    return $query->result();
    
	}
	
	public function getlist_dispute_waiting(){
	$where = "payment_type = 'sent' AND status != 'Pending' AND receiver = '".$this->session->email."' AND dispute = '1'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('transactions');
	$this->db->limit(10, 0);
	$this->db->order_by("id", 'desc');
	
	$query = $this->db->get();
    return $query->result();
    
	}
	
	public function getlist_dispute_refunded(){
	$where = "payment_type = 'sent' AND status != 'Pending' AND receiver = '".$this->session->email."' AND dispute = '2'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('transactions');
	$this->db->limit(10, 0);
	$this->db->order_by("id", 'desc');
	
	$query = $this->db->get();
    return $query->result();
    
	}
	
	public function getlist_dispute_cancel(){
	$where = "payment_type = 'sent' AND status != 'Pending' AND receiver = '".$this->session->email."' AND dispute = '3'";
	$this->db->where($where);
    $this->db->select('*');
    $this->db->from('transactions');
	$this->db->limit(10, 0);
	$this->db->order_by("id", 'desc');
	
	$query = $this->db->get();
    return $query->result();
    
	}
	
	/* Claim transaction
	*/
	public function dispute_claim($user_data) {
        $this->db->set('dispute', '1');
		$this->db->where('txn_id', $user_data['dispute_send']);

        $query = $this->db->update('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

	}
	
	/* Accept Dispute
	*/
	public function dispute_accept($user_data) {
        $this->db->set('dispute', '2');
		$this->db->where('txn_id', $user_data['dispute_txn_id']);

        $query = $this->db->update('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

	}
	
	/* Canel Dispute
	*/
	public function dispute_cancel($user_data) {
        $this->db->set('dispute', '3');
		$this->db->where('txn_id', $user_data['dispute_txn_id']);

        $query = $this->db->update('transactions');

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }

	}
	
	/* Dispute waiting count
	*/
	public function dispute_waiting_count()
  {
    
    $this->db->select('COUNT(*) as count');
    $this->db->from('transactions');
    $where = "payment_type = 'sent' AND status != 'Pending' AND receiver = '".$this->session->email."' AND dispute = '1'";
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
    $where = "payment_type = 'sent' AND status != 'Pending' AND receiver = '".$this->session->email."' AND dispute = '2'";
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
    $where = "payment_type = 'sent' AND status != 'Pending' AND receiver = '".$this->session->email."' AND dispute = '3'";
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

}