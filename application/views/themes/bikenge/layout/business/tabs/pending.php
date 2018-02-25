		<div class="well">
		<h5><a href="<?php echo site_url().'business/activity/'; ?>" class="well-margin-link-header"><?php echo $this->lang->line('summary_right_pending_h5'); ?>
						<i class="fa fa-angle-right fa-lg pull-right" aria-hidden="true"></i></a></h5>
		
		<?php
         
		// Payment request cancel failed alert.
      	if ($this->session->cancel_requestmoney_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  <i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
      			  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('cancel_requestmoney_failed').'
      			  </div>';
      	}
		
		 // Payment request cancel success alert.
      	if ($this->session->cancel_requestmoney_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<i class="fa fa-check fa-2x" aria-hidden="true"></i>
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('cancel_requestmoney_success').'
      			  </div>';
      	}
		
		 // Payment request success alert.
      	if ($this->session->payment_request_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<i class="fa fa-check fa-2x" aria-hidden="true"></i>
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('payment_request_success').'
      			  </div>';
      	}
		
		 ?>
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

		<?php foreach($list_pending_money as $pending){
			?>
		<div class="panel panel-default panel-transaction">
			<div class="panel-heading panel-head-transaction" data-toggle="collapse" data-target="#details-<?php echo $pending->id; ?>">
				<div class="panel-title panel-title-transaction">
					<div class="panel-head-transaction">
					<!-- Date left header -->
			
			<span class="payment-span-space-tabs"><?php echo date("M <b>d</b>", $pending->date); ?></span>
			
			<!-- Sender and Receiver -->
			<span class="panel-head-name">
			<?php
			if ($pending->payment_type == 'Deposit') {
			echo $pending->receiver;
			} elseif ($pending->payment_type == 'Withdraw') {
			echo $pending->receiver;
			
			}elseif ($pending->payment_type == 'request') {
			if ($pending->sender == $this->session->id) {
			echo $pending->receiver_name;
			
			} elseif ($pending->receiver == $this->session->email) {
			echo $pending->sender_name;
			}
			}?>
			</span>
			<!-- Paymentt total amount -->
						<div class="details-right"><?php
			
			if ($pending->payment_type == 'Deposit') {
			echo '<p class="payment-right-amount-positive">+'.$this->user->curr_symb.''.$pending->total.'</p>';
			} elseif ($pending->payment_type == 'Withdraw') {
			echo '<p class="payment-right-amount-negative">-'.$this->user->curr_symb.''.$pending->total.'</p>';
			} elseif ($pending->payment_type == 'request') {
			if ($pending->status == 'Cancel') {
			echo '<p class="payment-right-amount-positive-cancel">+'.$this->user->curr_symb.''.$pending->total.'<p>';
			} else {
				echo '<p class="payment-right-amount-positive">+'.$this->user->curr_symb.''.$pending->total.'<p>';
			}
			}?>
			</div>
			</br>
			<!-- Payment type -->
					<?php
			
			if ($pending->payment_type == 'Deposit') {
			echo '<p class="payment-space-tabs">'.$pending->payment_type.' - In progress</p>';
			} elseif ($pending->payment_type == 'Withdraw') {
			echo '<p class="payment-space-tabs">'.$pending->payment_type.'</p>';
			} elseif ($pending->payment_type == 'request') {
				if ($pending->sender == $this->session->id) {
			echo '<p class="payment-space-tabs">
			Payment request for '.$this->user->curr_symb.''.$pending->total.' sent
			</br>
			<i class="fa fa-chevron-circle-right fa-gray" aria-hidden="true"></i> 
			<a href="'.site_url().'business/resend_request/?id='.$pending->txn_id.'" onClick="event.stopPropagation();">Send a reminder</a> | 
			<a href="'.site_url().'business/remove_request/?id='.$pending->txn_id.'" onClick="event.stopPropagation();">Cancel</a>
			</p>';
			
			} elseif ($pending->receiver == $this->session->email) {
			echo '
			<p class="payment-space-tabs">Payment request received for '.$this->user->curr_symb.''.$pending->total.'
			</br>
			<i class="fa fa-chevron-circle-right fa-yellow" aria-hidden="true"></i> 
			This request is waiting <a href="'.site_url().'business/accept_requestmoney/?id='.$pending->txn_id.'&amount='.$pending->total.'&email='.$pending->sender_email.'&type=request" onClick="event.stopPropagation();">Send payment</a> | 
			<a href="'.site_url().'business/cancel_requestmoney/?id='.$pending->txn_id.'" onClick="event.stopPropagation();">Cancel</a>
			</p>
			
			';
			}
			
			}?>
			
					</div><!-- head -->
				</div>
			</div><!-- page-title -->
			<div id="details-<?php echo $pending->id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="transaction-<?php echo $pending->id; ?>">
				<div class="panel-body">
					 <div class="row">
					 <div class="col-md-6"><strong>
					 
					 <?php
			if ($pending->payment_type == 'Deposit') {
					 echo 'Deposit with';
					 } elseif ($pending->payment_type == 'Withdraw') {
					 echo 'Withdraw with';
					 
					 } elseif ($pending->payment_type == 'request') {
					 echo 'Requested by';
					
					 }?>
					 </strong>
					 <!-- Payment Method -->
					 <p>
					  <?php
			if ($pending->payment_type == 'Deposit') {
			echo $pending->payment_method;
			} elseif ($pending->payment_type == 'Withdraw') {
			echo $pending->payment_method;
			
			} elseif ($pending->payment_type == 'request') {
			echo $pending->sender_name.'</br><a href="mailto:'.$pending->sender_email.'">'.$pending->sender_email.'</a>';
			}?>
					 </p></br></br>
					 <strong>Transaction ID </strong>
					 <p><?php echo $pending->txn_id; ?></p>
					 
					 <?php if ($pending->payment_type == 'Deposit'){ ?>
					 <p><?php echo $pending->note; ?></p>
					 <?php } ?>
					 <!-- Refund -->
					 <?php
			if ($pending->payment_type == 'request') { ?>
			<?php }?>
					 
					 </div>
					 <div class="col-md-6 pull-right">
					 
					
			<!-- Details left fees -->
			<p>
					 <?php
			if ($pending->payment_type == 'Deposit') {
			echo 'After accept you can receive  <b>'.$this->user->curr_symb.''.$pending->amount.'</b> include our fees.
			';
			}elseif ($pending->payment_type == 'Withdraw') {
			echo 'Amount you receive <b>'.$this->user->curr_symb.''.$pending->amount.'</b> include our fees.
			';
			}elseif ($pending->payment_type == 'request') {
			echo 'Requesting for Payment amount <b>'.$this->user->curr_symb.''.$pending->total.'</b>
			';
			
			}?>
					 </span>
					 </div>
					 </div>
				</div>
			</div>
		</div>
		<?php 
		}?>
<!-- panel-group -->
		<?php if(empty($pending->txn_id)): ?>
			<!-- No Transaction made -->
			<p class="text-center"><?php echo $this->lang->line('summary_right_no_pending_transaction'); ?></p>
			<?php endif; ?>
			</div>
          </div>