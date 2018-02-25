         <?php
          
		// Payment status error alert.
      	if ($this->session->payment_refund_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  <i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
      			  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->session->payment_refund_failed.'
      			  </div>';
      	}
		
		// Payment Refund success alert.
		if ($this->session->payment_refund_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<i class="fa fa-check fa-2x" aria-hidden="true"></i>
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->session->payment_refund_success.'
      			  </div>';
      	}
		
		if ($this->session->payment_cancel_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  <i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
      			  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->session->payment_cancel_failed.'
      			  </div>';
      	}
		
		// Payment cancel success alert.
		if ($this->session->payment_cancel_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<i class="fa fa-check fa-2x" aria-hidden="true"></i>
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->session->payment_cancel_success.'
      			  </div>';
      	}
		 ?><div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

		<?php foreach ($transaction as $transaction) { ?>
		<div class="panel panel-default panel-transaction">
			<div class="panel-heading panel-head-transaction" data-toggle="collapse" data-target="#details-<?php echo $transaction->id; ?>">
				<div class="panel-title panel-title-transaction">
					<div class="panel-head-transaction">
					<!-- Date left header -->
			
			<span class="payment-span-space-tabs"><?php echo date("M <b>d</b>", $transaction->date); ?></span>
			
			<!-- Sender and Receiver -->
			<span class="panel-head-name">
			<?php
			if ($transaction->payment_type == 'Deposit') {
			echo $transaction->receiver;
			} elseif ($transaction->payment_type == 'Withdraw') {
			echo $transaction->receiver;
			
			} elseif ($transaction->payment_type == 'Card Verified') {
			echo $transaction->receiver;
			
			} else {
			echo $transaction->sender_name;
			}?>
			</span>
			<!-- Paymentt total amount -->
			<div class="details-right">
			<?php
			
			if ($transaction->payment_type == 'Deposit') {
			if ($transaction->status == 'Cancel') {
			echo '<p class="payment-right-amount-positive-cancel">+'.$this->site_settings->curr_symb.''.$transaction->amount.'<p>';
			} else {
				echo '<p class="payment-right-amount-positive">+'.$this->site_settings->curr_symb.''.$transaction->amount.'<p>';
			}
			} elseif ($transaction->payment_type == 'Withdraw') {
			if ($transaction->status == 'Cancel') {
			echo '<p class="payment-right-amount-positive-cancel">-'.$this->site_settings->curr_symb.''.$transaction->amount.'<p>';
			} else {
				echo '<p class="payment-right-amount-negative">-'.$this->site_settings->curr_symb.''.$transaction->amount.'<p>';
			}
			} elseif ($transaction->payment_type == 'request') {
			if ($transaction->status == 'Cancel') {
			echo '<p class="payment-right-amount-positive-cancel">+'.$this->site_settings->curr_symb.''.$transaction->amount.'<p>';
			} else {
				echo '<p class="payment-right-amount-positive">+'.$this->site_settings->curr_symb.''.$transaction->amount.'<p>';
			}
			} else {
			if ($transaction->status == 'Cancel') {
			echo '<p class="payment-right-amount-positive-cancel">+'.$this->site_settings->curr_symb.''.$transaction->total.'<p>';
			} else {
				echo '<p class="payment-right-amount-positive">+'.$this->site_settings->curr_symb.''.$transaction->total.'<p>';
			}
			}?>
			</div>
			</br>
			<!-- Payment type -->
					<?php
			
			if ($transaction->payment_type == 'Deposit') {
			echo '<p class="payment-space-tabs">Payment '.$transaction->payment_type.'</p>';
			} elseif ($transaction->payment_type == 'Withdraw') {
			echo '<p class="payment-space-tabs">Payment '.$transaction->payment_type.'</p>';
			} elseif ($transaction->payment_type == 'request') {
			echo '<p class="payment-space-tabs">Payment '.$transaction->payment_type.'</p>';
			} elseif ($transaction->payment_type == 'Card Verified') {
			echo '<p class="payment-space-tabs">'.$transaction->payment_type.'</p>';
			} elseif ($transaction->receiver == $this->session->email) {
				if ($transaction->shipping == '1') {
			echo '<p class="payment-space-tabs">Product Paid (Received)</p>';
				} else {
					if ($transaction->payment_type == 'refund') {
						echo '<p class="payment-space-tabs">Payment Back</p>';
				} else {
					echo '<p class="payment-space-tabs">Payment received</p>';
				}
				}
			} else {
			if ($transaction->shipping == '1') {
			echo '<p class="payment-space-tabs">Product Paid</p>';
				} else {
					echo '<p class="payment-space-tabs">Payment '.$transaction->payment_type.' </br>
			
			</p>';
				}
			}?>
			
					</div>
				</div>
			</div><!-- page-title -->
			<div id="details-<?php echo $transaction->id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="transaction-<?php echo $transaction->id; ?>">
				<div class="panel-body">
					 <div class="row">
					 <div class="col-md-6"><strong>
					 <!-- Paid by -->
					 <?php
			if ($transaction->payment_type == 'Deposit') {
					 echo 'Deposit with';
					 } elseif ($transaction->payment_type == 'Withdraw') {
					 echo 'Withdraw with';
					 
					 } elseif ($transaction->payment_type == 'request') {
					 echo 'Requested by';
					 
					 } elseif ($transaction->payment_type == 'Card Verified') {
					 echo 'Paid by';
			
					 } else {
					 echo 'Paid by';
					 }?>
					 </strong>
					 <!-- Payment Method -->
					 <p>
					  <?php
			if ($transaction->payment_type == 'Deposit') {
			echo $transaction->payment_method;
			} elseif ($transaction->payment_type == 'Withdraw') {
			echo $transaction->payment_method;
			
			} elseif ($transaction->payment_type == 'Card Verified') {
			echo $transaction->receiver;
			
			} elseif ($transaction->payment_type == 'request') {
			echo $transaction->sender_name.'</br><a href="mailto:'.$transaction->sender_email.'">'.$transaction->sender_email.'</a>';
			
			} else {
			echo $transaction->sender_name.'</br><a href="mailto:'.$transaction->sender_email.'">'.$transaction->sender_email.'</a>';
			}?>
					  </p>
					  <!-- Item details -->
					 <?php if ($transaction->item_name): ?>
					 </br>
					 <strong>Item details</strong>
					 </br>
					 Item Name: <?php echo $transaction->item_name;?></br>
					 
					 <?php if ($transaction->item_number): ?>
					 Item Number: #<?php echo $transaction->item_number;?><br>
					 <?php endif; ?>
					 </br>
					 <?php endif; ?>
					 
					 <?php if ($transaction->receiver == $this->session->email): ?>
					 <!-- Shipping address -->
					 <?php if ($transaction->shipping == '1'): ?>
					 <strong>Shipping to address</strong>
					 </br>
					 <?php echo $transaction->address1;?></br>
					 
					 <?php if ($transaction->address4): ?>
					 <?php echo $transaction->address2;?>, <?php echo $transaction->address4;?><br>
					 <?php else: ?>
					 
					 <?php echo $transaction->address2;?><br>
					 <?php endif; ?>
					 
					 <?php echo $transaction->address3;?>
					 <?php endif; ?>
					 </br></br>
					 <?php endif; ?>
					 <strong>Transaction ID </strong>
					 <p><?php echo $transaction->txn_id; ?></p>
					 <strong>Payment is </strong>
					 <p><?php echo $transaction->status; ?></p>
					 
					 <!-- Refund -->
					 <?php
			if ($transaction->payment_type == 'refund') { ?>
			
			<!-- refund -->
			<?php }?>
					 
					 </div>
					 <div class="col-md-6 pull-right">
					 <span class="pull-left"><strong>
					 <!-- Header status -->
					 <?php
			if ($transaction->payment_type == 'Deposit') {
			echo 'Deposit By';
			} elseif ($transaction->payment_type == 'Withdraw') {
			echo $transaction->payment_method.' Account';
			
			} elseif ($transaction->payment_type == 'Card Verified') {
			echo '';
			
			} else {
			echo 'Sent to';
			}?>
					 </strong>
					 <!-- Receiver name -->
					 <p><?php
			if ($transaction->payment_type == 'Deposit') {
			echo $transaction->receiver;
			} elseif ($transaction->payment_type == 'Withdraw') {
			echo $transaction->email_add;
			
			} elseif ($transaction->payment_type == 'Card Verified') {
			echo '';
			
			} else {
			echo $transaction->receiver_name;
			}?>
			</p>
			</br></br>
			<!-- Details left fees -->
					 
					 <?php
			if ($transaction->payment_type == 'Deposit') {
			echo '<strong>Details </strong>';
			} elseif ($transaction->payment_type == 'Withdraw') {
			echo '<strong>Details </strong>';
			
			} elseif ($transaction->payment_type == 'Card Verified') {
			echo '';
			
			} else {
			echo '<strong>Details </strong>';
			}?>
					 
					 <p>
					 <?php
			if ($transaction->payment_type == 'Deposit') {
			echo '
			<!-- Payment Sent -->
			<div class="row">
			<div class="col-md-6">Sent to '.$transaction->receiver_name.'</div><div class="col-md-6"><span class="pull-right">'.$this->site_settings->curr_symb.''.$transaction->total.'</span></div>
			
			<!-- Payment Fees -->
			<div class="col-md-6">Fee</div><div class="col-md-6"><span class="pull-right">-'.$this->site_settings->curr_symb.''.$transaction->fees.'</span></div>
			</div>
			<div class="row">
			<!-- Payment Total-->
			<div class="col-md-6"><strong>Total</strong></div><div class="col-md-6"><span class="pull-right"><strong>'.$this->site_settings->curr_symb.''.$transaction->amount.'</strong></span></div>
			</div>
			';
			
			} elseif ($transaction->payment_type == 'Withdraw') {
			echo '
			<!-- Payment Sent -->
			<div class="row">
			<div class="col-md-6"><strong>'.$transaction->status.'</strong> Amount  '.$transaction->receiver_name.'</div><div class="col-md-6"><span class="pull-right">'.$this->site_settings->curr_symb.''.$transaction->total.'</span></div>
			
			<!-- Payment Fees -->
			<div class="col-md-6">Fee</div><div class="col-md-6"><span class="pull-right">-'.$this->site_settings->curr_symb.''.$transaction->fees.'</span></div>
			</div>
			<div class="row">
			<!-- Payment Total-->
			<div class="col-md-6"><strong>Total</strong></div><div class="col-md-6"><span class="pull-right"><strong>'.$this->site_settings->curr_symb.''.$transaction->amount.'</strong></span></div>
			</div>
			';
			
			} elseif ($transaction->payment_type == 'Card Verified') {
			echo '';
			
			} elseif ($transaction->payment_type == 'request') {
			echo 'Requesting for Payment amount <b>'.$this->site_settings->curr_symb.''.$transaction->total.'</b>
			';
			
			} elseif ($transaction->sender) {
			echo '
			<!-- Payment Sent -->
			<div class="row">
			<div class="col-md-6">Sent to '.explode(' ',trim($transaction->receiver_name))[0].'</div><div class="col-md-6"><span class="pull-right">'.$this->site_settings->curr_symb.''.$transaction->total.'</span></div>
			
			<!-- Payment Fees -->
			<div class="col-md-6">Fee</div><div class="col-md-6"><span class="pull-right">-'.$this->site_settings->curr_symb.''.$transaction->fees.'</span></div>
			</div>
			<div class="row">
			<!-- Payment Total-->
			<div class="col-md-6"><strong>Total sent</strong></div><div class="col-md-6"><span class="pull-right"><strong>'.$this->site_settings->curr_symb.''.$transaction->total.'</strong></span></div>
			</div>
			
			</br>
			<i class="fa fa-exclamation-triangle fa-red" aria-hidden="true"></i> 
			<a href="'.base_url('dispute').'">Dispute claim</a>
			';
			}?>
			
			<?php 
			if ($transaction->status == 'Cancel') {
			
			if ($transaction->payment_type == 'Deposit' || $transaction->payment_type == 'request') {
			echo '';
	
			}else {
			echo '
				<form role="form" method="post" action="'.site_url('admin/refund').'">
					 <input type="hidden" name="transaction_id" value="'.$transaction->txn_id.'">
					 <input type="hidden" name="amount" value="'.$transaction->total.'">
					 <input type="hidden" name="receiver_email" value="'.$transaction->receiver_email.'">
					 <input type="hidden" name="sender_email" value="'.$transaction->sender_email.'">
					 <input type="hidden" name="'. $this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'">
					 <button class="panel-refund-button" type="submit" name="refund">Refund</button>
					 </form>
				';	
			}
			}elseif ($transaction->payment_type == 'refund') {
				
			echo '
				<form role="form" method="post" action="'.site_url('admin/refund').'">
					 <input type="hidden" name="transaction_id" value="'.$transaction->txn_id.'">
					 <input type="hidden" name="amount" value="'.$transaction->total.'">
					 <input type="hidden" name="receiver_email" value="'.$transaction->receiver_email.'">
					 <input type="hidden" name="sender_email" value="'.$transaction->sender_email.'">
					 <input type="hidden" name="'. $this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'">
					 <button class="panel-refund-button" type="submit" name="cancel">Cancel Payment</button>
					 </form>
				';	
			}else {
			echo '
				<form role="form" method="post" action="'.site_url('admin/refund').'">
					 <input type="hidden" name="transaction_id" value="'.$transaction->txn_id.'">
					 <input type="hidden" name="amount" value="'.$transaction->total.'">
					 <input type="hidden" name="receiver_email" value="'.$transaction->receiver_email.'">
					 <input type="hidden" name="sender_email" value="'.$transaction->sender_email.'">
					 <input type="hidden" name="'. $this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'">
					 <button class="panel-refund-button" type="submit" name="refund">Refund</button>
					 <button class="panel-refund-button" type="submit" name="cancel">Cancel Payment</button>
					 </form>
				';	
				
			}
				?>
					 </span>
					 <!--
					 <span class="pull-right">
					 <a href="" class="pointeritem"><i class="fa fa-times fa-lg icon-ccc" aria-hidden="true"  role="tab" id="transaction-<?php echo $transaction->id; ?>" data-toggle="collapse" data-parent="#accordion" href="#details-<?php echo $transaction->id; ?>" aria-expanded="true" aria-controls="details-<?php echo $transaction->id; ?>"></i>
					 </a>
					 </span>
					 -->
					 </div>
					 </div>
				</div>
			</div>
		</div>
		<?php 
		}?>
		<ul class="pagination pull-right">
        <!-- Show pagination links -->
        <?php
        foreach ($links as $link) {
        echo "<li>" . $link . "</li>";
        }
         ?>
        </ul>
			
			</div>