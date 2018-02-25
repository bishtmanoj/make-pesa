<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

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
			
			} elseif ($transaction->sender == $this->session->id) {
			echo $transaction->receiver_name;
			
			} elseif ($transaction->receiver == $this->session->email) {
			echo $transaction->sender_name;
			}?>
			</span>
			<!-- Paymentt total amount -->
			<div class="details-right">
			<?php
			
			if ($transaction->payment_type == 'Deposit') {
			if ($transaction->status == 'Cancel') {
			echo '<p class="payment-right-amount-positive-cancel">+'.$this->user->curr_symb.''.$transaction->amount.'<p>';
			} else {
				echo '<p class="payment-right-amount-positive">+'.$this->user->curr_symb.''.$transaction->amount.'<p>';
			}
			} elseif ($transaction->payment_type == 'Withdraw') {
			if ($transaction->status == 'Cancel') {
			echo '<p class="payment-right-amount-positive-cancel">-'.$this->user->curr_symb.''.$transaction->amount.'<p>';
			} else {
				echo '<p class="payment-right-amount-negative">-'.$this->user->curr_symb.''.$transaction->amount.'<p>';
			}
			} elseif ($transaction->payment_type == 'request') {
			if ($transaction->status == 'Cancel') {
			echo '<p class="payment-right-amount-positive-cancel">+'.$this->user->curr_symb.''.$transaction->amount.'<p>';
			} else {
				echo '<p class="payment-right-amount-positive">+'.$this->user->curr_symb.''.$transaction->amount.'<p>';
			}
			} elseif ($transaction->receiver == $this->session->email) {
			if ($transaction->status == 'Cancel') {
			echo '<p class="payment-right-amount-positive-cancel">+'.$this->user->curr_symb.''.$transaction->total.'<p>';
			} else {
				echo '<p class="payment-right-amount-positive">+'.$this->user->curr_symb.''.$transaction->total.'<p>';
			}
			} elseif ($transaction->sender == $this->session->id) {
			if ($transaction->status == 'Cancel') {
			echo '<p class="payment-right-amount-positive-cancel">+'.$this->user->curr_symb.''.$transaction->total.'<p>';
			} else {
				echo '<p class="payment-right-amount-negative">-'.$this->user->curr_symb.''.$transaction->total.'<p>';
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
			} elseif ($transaction->sender == $this->session->id) {
			if ($transaction->shipping == '1') {
			echo '<p class="payment-space-tabs">Product Paid</p>';
				} else {
					echo '<p class="payment-space-tabs">Payment '.$transaction->payment_type.' </br>
			
			<i class="fa fa-chevron-circle-right fa-gray" aria-hidden="true"></i> 
			<a href="'.site_url().'myaccount/transfer/repeat/?email='.$transaction->receiver_email.'&amount='.$transaction->total.'" onClick="event.stopPropagation();">Repeat transaction </a>
			
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
			
					 } elseif ($transaction->sender == $this->session->id) {
					 echo 'Paid with';
			
					 } elseif ($transaction->receiver == $this->session->email) {
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
			
			} elseif ($transaction->sender == $this->session->id) {
			echo $this->site_settings->site_name.' '.$transaction->payment_method.'';
			} elseif ($transaction->receiver == $this->session->email) {
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
			<?php } elseif ($transaction->payment_type == 'request') { ?>
			
			
			<?php } elseif ($transaction->receiver == $this->session->email) { ?>
			<!-- refund -->
			<?php }?>
					 
					 
			<?php
			if ($transaction->payment_type == 'sent') {
					if ($transaction->sender == $this->session->id) {
					echo '
					 </br></br>
					 <strong>Need help? </strong>
					 <p>If you have an inssue with this transaction please contact us, we can help you before 7 days.
					 </br>
					 <a href="'.base_url('/page/help').'"><strong>Problem solving center </strong></a>
					 </p>';
					 
					}elseif ($transaction->receiver == $this->session->email) {
						echo '';
					}
			}?>
					 
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
			
			} elseif ($transaction->sender == $this->session->id) {
			echo 'Sent to';
			
			} elseif ($transaction->receiver == $this->session->email) {
			echo 'Note from '.$transaction->sender_name.'';
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
			
			} elseif ($transaction->sender == $this->session->id) {
			echo $transaction->receiver_name;
			
			} elseif ($transaction->receiver == $this->session->email) {
			echo (!empty($transaction->note)) ? $transaction->note : '—';
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
			
			} elseif ($transaction->sender == $this->session->id) {
			echo '<strong>Details </strong>';
			
			} elseif ($transaction->receiver == $this->session->email) {
			echo '<strong>Details </strong>';
			}?>
					 
					 <p>
					 <?php
			if ($transaction->payment_type == 'Deposit') {
			echo '
			<!-- Payment Sent -->
			<div class="row">
			<div class="col-md-6">Sent to '.$transaction->receiver_name.'</div><div class="col-md-6"><span class="pull-right">'.$this->user->curr_symb.''.$transaction->total.'</span></div>
			
			<!-- Payment Fees -->
			<div class="col-md-6">Fee</div><div class="col-md-6"><span class="pull-right">-'.$this->user->curr_symb.''.$transaction->fees.'</span></div>
			</div>
			<div class="row">
			<!-- Payment Total-->
			<div class="col-md-6"><strong>Total</strong></div><div class="col-md-6"><span class="pull-right"><strong>'.$this->user->curr_symb.''.$transaction->amount.'</strong></span></div>
			</div>
			';
			
			} elseif ($transaction->payment_type == 'Withdraw') {
			echo '
			<!-- Payment Sent -->
			<div class="row">
			<div class="col-md-6"><strong>'.$transaction->status.'</strong> Amount  '.$transaction->receiver_name.'</div><div class="col-md-6"><span class="pull-right">'.$this->user->curr_symb.''.$transaction->total.'</span></div>
			
			<!-- Payment Fees -->
			<div class="col-md-6">Fee</div><div class="col-md-6"><span class="pull-right">-'.$this->user->curr_symb.''.$transaction->fees.'</span></div>
			</div>
			<div class="row">
			<!-- Payment Total-->
			<div class="col-md-6"><strong>Total</strong></div><div class="col-md-6"><span class="pull-right"><strong>'.$this->user->curr_symb.''.$transaction->amount.'</strong></span></div>
			</div>
			';
			
			} elseif ($transaction->payment_type == 'Card Verified') {
			echo '';
			
			} elseif ($transaction->payment_type == 'request') {
			echo 'Requesting for Payment amount <b>'.$this->user->curr_symb.''.$transaction->total.'</b>
			';
			
			} elseif ($transaction->sender == $this->session->id) {
			echo '
			<!-- Payment Sent -->
			<div class="row">
			<div class="col-md-6">Sent to '.explode(' ',trim($transaction->receiver_name))[0].'</div><div class="col-md-6"><span class="pull-right">'.$this->user->curr_symb.''.$transaction->total.'</span></div>
			
			<!-- Payment Fees -->
			<div class="col-md-6">Fee</div><div class="col-md-6"><span class="pull-right">-'.$this->user->curr_symb.''.$transaction->fees.'</span></div>
			</div>
			<div class="row">
			<!-- Payment Total-->
			<div class="col-md-6"><strong>Total sent</strong></div><div class="col-md-6"><span class="pull-right"><strong>'.$this->user->curr_symb.''.$transaction->total.'</strong></span></div>
			</div>
			
			</br>
			<i class="fa fa-exclamation-triangle fa-red" aria-hidden="true"></i> 
			<a href="'.base_url('dispute').'">Dispute claim</a>
			';
			
			} elseif ($transaction->receiver == $this->session->email) {
			
			if (empty($transaction->sender)) {
				$refund_button = '';
			}else {
				if ($transaction->payment_type == 'refund') {
						$refund_button = '';
				} else {
					$refund_button = '
				<form role="form" method="post" action="'.site_url('myaccount/refund').'">
					 <input type="hidden" name="transaction_id" value="'.$transaction->txn_id.'">
					 <input type="hidden" name="amount" value="'.$transaction->total.'">
					 <input type="hidden" name="receiver" value="'.$transaction->sender_email.'">
					 <input type="hidden" name="'. $this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'">
					 <button class="panel-refund-button" type="submit" name="refund-send">Refund</button>
					 </form>
				';
				}
				
			}
			echo '
			<!-- Payment Sent -->
			<div class="row">
			<div class="col-md-6">Sent by '.explode(' ',trim($transaction->receiver_name))[0].'</div><div class="col-md-6"><span class="pull-right">'.$this->user->curr_symb.''.$transaction->total.'</span></div>
			
			</div>
			<!-- Total -->
			<div class="row">
			<!-- Payment Total-->
			<div class="col-md-6"><strong>Total</strong></div><div class="col-md-6"><span class="pull-right"><strong>'.$this->user->curr_symb.''.$transaction->total.'</strong></span></div>
			</div>
			<!-- refund -->
			 '.$refund_button.'
			';
			}?>
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