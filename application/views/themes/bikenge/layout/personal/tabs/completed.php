		<div class="well">
		  
		<h5><a href="<?php echo site_url().'myaccount/activity/'; ?>" class="well-margin-link-header"><?php echo $this->lang->line('summary_right_transaction_h5'); ?>
		<i class="fa fa-angle-right fa-lg pull-right" aria-hidden="true"></i></a></h5>
		
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

		<?php foreach($list_money as $money){
			?>
		<div class="panel panel-default panel-transaction">
			<div class="panel-heading panel-head-transaction" data-toggle="collapse" data-target="#details-<?php echo $money->id; ?>">
				<div class="panel-title panel-title-transaction">
					<div class="panel-head-transaction">
					<!-- Date left header -->
			
			<span class="payment-span-space-tabs"><?php echo date("M <b>d</b>", $money->date); ?></span>
			
			<!-- Sender and Receiver -->
			<span class="panel-head-name">
			<?php
			if ($money->payment_type == 'Deposit') {
			echo $money->receiver;
			} elseif ($money->payment_type == 'Withdraw') {
			echo $money->receiver;
			
			} elseif ($money->payment_type == 'Card Verified') {
			echo $money->receiver;
			
			} elseif ($money->sender == $this->session->id) {
			echo $money->receiver_name;
			
			} elseif ($money->receiver == $this->session->email) {
			echo $money->sender_name;
			}?>
			</span>
			<!-- Paymentt total amount -->
						<div class="details-right"><?php
			
			if ($money->payment_type == 'Deposit') {
			if ($money->status == 'Cancel') {
			echo '<p class="payment-right-amount-positive-cancel">+'.$this->user->curr_symb.''.$money->amount.'<p>';
			} else {
				echo '<p class="payment-right-amount-positive">+'.$this->user->curr_symb.''.$money->amount.'<p>';
			}
			} elseif ($money->payment_type == 'Withdraw') {
			if ($money->status == 'Cancel') {
			echo '<p class="payment-right-amount-positive-cancel">-'.$this->user->curr_symb.''.$money->amount.'<p>';
			} else {
				echo '<p class="payment-right-amount-negative">-'.$this->user->curr_symb.''.$money->amount.'<p>';
			}
			} elseif ($money->payment_type == 'request') {
			if ($money->status == 'Cancel') {
			echo '<p class="payment-right-amount-positive-cancel">+'.$this->user->curr_symb.''.$money->amount.'<p>';
			} else {
				echo '<p class="payment-right-amount-positive">+'.$this->user->curr_symb.''.$money->amount.'<p>';
			}
			} elseif ($money->receiver == $this->session->email) {
			if ($money->status == 'Cancel') {
			echo '<p class="payment-right-amount-positive-cancel">+'.$this->user->curr_symb.''.$money->total.'<p>';
			} else {
				echo '<p class="payment-right-amount-positive">+'.$this->user->curr_symb.''.$money->total.'<p>';
			}
			} elseif ($money->sender == $this->session->id) {
			if ($money->status == 'Cancel') {
			echo '<p class="payment-right-amount-positive-cancel">+'.$this->user->curr_symb.''.$money->total.'<p>';
			} else {
				echo '<p class="payment-right-amount-negative">-'.$this->user->curr_symb.''.$money->total.'<p>';
			}
			}?>
			</div>
			</br>
			<!-- Payment type -->
					<?php
			
			if ($money->payment_type == 'Deposit') {
			echo '<p class="payment-space-tabs">Payment '.$money->payment_type.'</p>';
			} elseif ($money->payment_type == 'Withdraw') {
			echo '<p class="payment-space-tabs">Payment '.$money->payment_type.'</p>';
			} elseif ($money->payment_type == 'request') {
			echo '<p class="payment-space-tabs">Payment '.$money->payment_type.'</p>';
			} elseif ($money->payment_type == 'Card Verified') {
			echo '<p class="payment-space-tabs">'.$money->payment_type.'</p>';
			} elseif ($money->receiver == $this->session->email) {
				if ($money->shipping == '1') {
			echo '<p class="payment-space-tabs">Product Paid (Received)</p>';
				} else {
					if ($money->payment_type == 'refund') {
						echo '<p class="payment-space-tabs">Payment Back</p>';
				} else {
					echo '<p class="payment-space-tabs">Payment received</p>';
				}
				}
			} elseif ($money->sender == $this->session->id) {
			if ($money->shipping == '1') {
			echo '<p class="payment-space-tabs">Product Paid</p>';
				} else {
					echo '<p class="payment-space-tabs">Payment '.$money->payment_type.' </br>
			
			<i class="fa fa-chevron-circle-right fa-gray" aria-hidden="true"></i> 
			<a href="'.site_url().'myaccount/transfer/repeat/?email='.$money->receiver_email.'&amount='.$money->total.'" onClick="event.stopPropagation();">Repeat transaction </a>
			
			</p>';
				}
			}?>
			
					</div>
				</div>
			</div><!-- page-title -->
			<div id="details-<?php echo $money->id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="transaction-<?php echo $money->id; ?>">
				<div class="panel-body">
					 <div class="row">
					 <div class="col-md-6"><strong>
					 <!-- Paid by -->
					 <?php
			if ($money->payment_type == 'Deposit') {
					 echo 'Deposit with';
					 } elseif ($money->payment_type == 'Withdraw') {
					 echo 'Withdraw with';
					 
					 } elseif ($money->payment_type == 'request') {
					 echo 'Requested by';
					 
					 } elseif ($money->payment_type == 'Card Verified') {
					 echo 'Paid by';
			
					 } elseif ($money->sender == $this->session->id) {
					 echo 'Paid with';
			
					 } elseif ($money->receiver == $this->session->email) {
					 echo 'Paid by';
					 }?>
					 </strong>
					 <!-- Payment Method -->
					 <p>
					  <?php
			if ($money->payment_type == 'Deposit') {
			echo $money->payment_method;
			} elseif ($money->payment_type == 'Withdraw') {
			echo $money->payment_method;
			
			} elseif ($money->payment_type == 'Card Verified') {
			echo $money->receiver;
			
			} elseif ($money->payment_type == 'request') {
			echo $money->sender_name.'</br><a href="mailto:'.$money->sender_email.'">'.$money->sender_email.'</a>';
			
			} elseif ($money->sender == $this->session->id) {
			echo $this->site_settings->site_name.' '.$money->payment_method.'';
			} elseif ($money->receiver == $this->session->email) {
			echo $money->sender_name.'</br><a href="mailto:'.$money->sender_email.'">'.$money->sender_email.'</a>';
			}?>
					 </p>
					  <!-- Item details -->
					 <?php if ($money->item_name): ?>
					 </br>
					 <strong>Item details</strong>
					 </br>
					 Item Name: <?php echo $money->item_name;?></br>
					 
					 <?php if ($money->item_number): ?>
					 Item Number: #<?php echo $money->item_number;?><br>
					 <?php endif; ?>
					 </br>
					 <?php endif; ?>
					 
					 <?php if ($money->receiver == $this->session->email): ?>
					 <!-- Shipping address -->
					 <?php if ($money->shipping == '1'): ?>
					 <strong>Shipping to address</strong>
					 </br>
					 <?php echo $money->address1;?></br>
					 
					 <?php if ($money->address4): ?>
					 <?php echo $money->address2;?>, <?php echo $money->address4;?><br>
					 <?php else: ?>
					 
					 <?php echo $money->address2;?><br>
					 <?php endif; ?>
					 
					 <?php echo $money->address3;?>
					 <?php endif; ?>
					 </br></br>
					 <?php endif; ?>
					 <strong>Transaction ID </strong>
					 <p><?php echo $money->txn_id; ?></p>
					 
					 <strong>Payment is </strong>
					 <p><?php echo $money->status; ?></p>
					 
					 <?php if ($money->payment_type == 'Deposit'){ ?>
					 <p><?php echo $money->note; ?></p>
					 <?php } ?>
					 <!-- Refund -->
					 <?php
			if ($money->payment_type == 'refund') { ?>
			<?php } elseif ($money->payment_type == 'request') { ?>
			
			
			<?php } elseif ($money->receiver == $this->session->email) { ?>
			<!-- refund -->
			<?php }?>
					 
					 
			<?php
			if ($money->payment_type == 'sent') {
					if ($money->sender == $this->session->id) {
					echo '
					 </br></br>
					 <strong>Need help? </strong>
					 <p>If you have an inssue with this transaction please contact us, we can help you before 7 days.
					 </br>
					 <a href="'.base_url('/page/help').'"><strong>Problem solving center </strong></a>
					 </p>';
					 
					}elseif ($money->receiver == $this->session->email) {
						echo '';
					}
			}?>
					 
					 </div>
					 <div class="col-md-6 pull-right">
					 <span class="pull-left"><strong>
					 <!-- Header status -->
					 <?php
			if ($money->payment_type == 'Deposit') {
			echo 'Deposit By';
			} elseif ($money->payment_type == 'Withdraw') {
			echo $money->payment_method.' Account';
			
			} elseif ($money->payment_type == 'Card Verified') {
			echo '';
			
			} elseif ($money->sender == $this->session->id) {
			echo 'Sent to';
			
			} elseif ($money->receiver == $this->session->email) {
			echo 'Note from '.$money->sender_name.'';
			}?>
					 </strong>
					 <!-- Receiver name -->
					 <p><?php
			if ($money->payment_type == 'Deposit') {
			echo $money->receiver;
			} elseif ($money->payment_type == 'Withdraw') {
			echo $money->email_add;
			
			} elseif ($money->payment_type == 'Card Verified') {
			echo '';
			
			} elseif ($money->sender == $this->session->id) {
			echo $money->receiver_name;
			
			} elseif ($money->receiver == $this->session->email) {
			echo (!empty($money->note)) ? $money->note : '—';
			}?>
			</p>
			</br></br>
			<!-- Details left fees -->
					 
					 <?php
			if ($money->payment_type == 'Deposit') {
			echo '<strong>Details </strong>';
			} elseif ($money->payment_type == 'Withdraw') {
			echo '<strong>Details </strong>';
			
			} elseif ($money->payment_type == 'Card Verified') {
			echo '';
			
			} elseif ($money->sender == $this->session->id) {
			echo '<strong>Details </strong>';
			
			} elseif ($money->receiver == $this->session->email) {
			echo '<strong>Details </strong>';
			}?>
					 
					 <p>
					 <?php
			if ($money->payment_type == 'Deposit') {
			echo '
			<!-- Payment Sent -->
			<div class="row">
			<div class="col-md-6">Sent to '.$money->receiver_name.'</div><div class="col-md-6"><span class="pull-right">'.$this->user->curr_symb.''.$money->total.'</span></div>
			
			<!-- Payment Fees -->
			<div class="col-md-6">Fee</div><div class="col-md-6"><span class="pull-right">-'.$this->user->curr_symb.''.$money->fees.'</span></div>
			</div>
			<div class="row">
			<!-- Payment Total-->
			<div class="col-md-6"><strong>Total</strong></div><div class="col-md-6"><span class="pull-right"><strong>'.$this->user->curr_symb.''.$money->amount.'</strong></span></div>
			</div>
			';
			
			} elseif ($money->payment_type == 'Withdraw') {
			echo '
			<!-- Payment Sent -->
			<div class="row">
			<div class="col-md-6"><strong>'.$money->status.'</strong> Amount  '.$money->receiver_name.'</div><div class="col-md-6"><span class="pull-right">'.$this->user->curr_symb.''.$money->total.'</span></div>
			
			<!-- Payment Fees -->
			<div class="col-md-6">Fee</div><div class="col-md-6"><span class="pull-right">-'.$this->user->curr_symb.''.$money->fees.'</span></div>
			</div>
			<div class="row">
			<!-- Payment Total-->
			<div class="col-md-6"><strong>Total</strong></div><div class="col-md-6"><span class="pull-right"><strong>'.$this->user->curr_symb.''.$money->amount.'</strong></span></div>
			</div>
			';
			
			} elseif ($money->payment_type == 'Card Verified') {
			echo '';
			
			} elseif ($money->payment_type == 'request') {
			echo 'Requesting for Payment amount <b>'.$this->user->curr_symb.''.$money->total.'</b>
			';
			
			} elseif ($money->sender == $this->session->id) {
			echo '
			<!-- Payment Sent -->
			<div class="row">
			<div class="col-md-6">Sent to '.explode(' ',trim($money->receiver_name))[0].'</div><div class="col-md-6"><span class="pull-right">'.$this->user->curr_symb.''.$money->total.'</span></div>
			
			<!-- Payment Fees -->
			<div class="col-md-6">Fee</div><div class="col-md-6"><span class="pull-right">-'.$this->user->curr_symb.''.$money->fees.'</span></div>
			</div>
			<div class="row">
			<!-- Payment Total-->
			<div class="col-md-6"><strong>Total sent</strong></div><div class="col-md-6"><span class="pull-right"><strong>'.$this->user->curr_symb.''.$money->total.'</strong></span></div>
			</div>
			
			</br>
			<i class="fa fa-exclamation-triangle fa-red" aria-hidden="true"></i> 
			<a href="'.base_url('dispute').'">Dispute claim</a>
			';
			
			} elseif ($money->receiver == $this->session->email) {
			
			if (empty($money->sender)) {
				$refund_button = '';
			}else {
				if ($money->payment_type == 'refund') {
						$refund_button = '';
				} else {
					$refund_button = '
				<form role="form" method="post" action="'.site_url('myaccount/refund').'">
					 <input type="hidden" name="transaction_id" value="'.$money->txn_id.'">
					 <input type="hidden" name="amount" value="'.$money->total.'">
					 <input type="hidden" name="receiver" value="'.$money->sender_email.'">
					 <input type="hidden" name="'. $this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'">
					 <button class="panel-refund-button" type="submit" name="refund-send">Refund</button>
					 </form>
				';
				}
				
			}
			echo '
			<!-- Payment Sent -->
			<div class="row">
			<div class="col-md-6">Sent by '.explode(' ',trim($money->receiver_name))[0].'</div><div class="col-md-6"><span class="pull-right">'.$this->user->curr_symb.''.$money->total.'</span></div>
			
			</div>
			<!-- Total -->
			<div class="row">
			<!-- Payment Total-->
			<div class="col-md-6"><strong>Total</strong></div><div class="col-md-6"><span class="pull-right"><strong>'.$this->user->curr_symb.''.$money->total.'</strong></span></div>
			</div>
			<!-- refund -->
			 '.$refund_button.'
			';
			}?>
					 </span>
					 <!--
					 <span class="pull-right">
					 <a href="" class="pointeritem"><i class="fa fa-times fa-lg icon-ccc" aria-hidden="true"  role="tab" id="transaction-<?php echo $money->id; ?>" data-toggle="collapse" data-parent="#accordion" href="#details-<?php echo $money->id; ?>" aria-expanded="true" aria-controls="details-<?php echo $money->id; ?>"></i>
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
<!-- panel-group -->
			<?php if(empty($money->txn_id)): ?>
			<!-- No Transaction made -->
			<p class="text-center"><?php echo $this->lang->line('summary_right_no_transaction'); ?></p>
			<?php else: ?>
			<div class="transaction-down-link text-center">
			<a href="<?php echo site_url().'myaccount/activity/'; ?>"><?php echo $this->lang->line('summary_right_view_all_transaction'); ?></a>
			<?php endif; ?>
			</div>
          </div>