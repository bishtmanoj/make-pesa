<div class="head-padding-top"></div>
<div class="container">
<div class="row">
<div class="col-sm-13 col-sm-offset-2 col-md-13 col-md-offset-0">
<div class="row">
		
        <div class="col-sm-4 col-md-4">
		 <?php $this->load->view($this->themename.'/layout/admin/globe/sidebar/nav'); ?>
            </div>
			
			
			<div class="col-sm-8 col-md-8">
			<div class="well">
			<div class="well-header">
			<!-- Form user transaction -->
          <form method="post" action="<?php echo base_url("admin/transaction"); ?>" class="form-horizontal" id="serach_user" name="serach_user" role="form">
            <div class="form-group">
                <div class="col-md-6">
                    <input class="form-control" id="transaction" name="transaction" placeholder="<?php echo $this->lang->line('admin_search_form_user_name_placeholder');?>" type="text" value="" />
                </div>
                <div class="col-md-6">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input id="btn_search" name="btn_search" type="submit" class="btn btn-primary" value="<?php echo $this->lang->line('admin_search_form_button_search_name_placeholder');?>" />
                    <a href="<?php echo base_url(). "/admin/transaction"; ?>" class="btn btn-info"><?php echo $this->lang->line('admin_search_form_button_searchall_placeholder');?></a>
                </div>
            </div>
			</form>
	  <!-- Form End -->
	  </div>
		
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

		<?php for ($i = 0; $i < count($userlist); ++$i) { ?>
		<div class="panel panel-default panel-transaction">
			<div class="panel-heading panel-head-transaction" role="tab" id="transaction-<?php echo $userlist[$i]->id; ?>" data-toggle="collapse" data-parent="#accordion" href="#details-<?php echo $userlist[$i]->id; ?>" aria-expanded="true" aria-controls="details-<?php echo $userlist[$i]->id; ?>">
				<div class="panel-title panel-title-transaction">
					<div class="panel-head-transaction">
					<!-- Date left header -->
			
			<span class="payment-span-space-tabs"><?php echo date("M <b>d</b>", $userlist[$i]->date); ?></span>
			
			<!-- Sender and Receiver -->
			<span class="panel-head-name">
			<?php
			if ($userlist[$i]->payment_type == 'Deposit') {
			echo $userlist[$i]->receiver;
			} elseif ($userlist[$i]->payment_type == 'Withdraw') {
			echo $userlist[$i]->receiver;
			
			} elseif ($userlist[$i]->payment_type == 'Card Verified') {
			echo $userlist[$i]->receiver;
			
			} elseif ($userlist[$i]->sender_name) {
				if (empty($userlist[$i]->sender)) {
					echo ''.$userlist[$i]->sender_name.' (Guest User)';
			}else {
			echo $userlist[$i]->sender_name;
			}
			}?>
			</span>
			<!-- Paymentt total amount -->
						<div class="details-right"><?php
			
			if ($userlist[$i]->payment_type == 'Deposit') {
			echo '<p class="payment-right-amount-positive">+'.$this->site_settings->curr_symb.''.$userlist[$i]->amount.'</p>';
			} elseif ($userlist[$i]->payment_type == 'Withdraw') {
			echo '<p class="payment-right-amount-negative">-'.$this->site_settings->curr_symb.''.$userlist[$i]->amount.'</p>';
			} elseif ($userlist[$i]->payment_type == 'request') {
			echo '<p class="payment-right-amount-positive">+'.$this->site_settings->curr_symb.''.$userlist[$i]->total.'<p>';
			} elseif ($userlist[$i]->sender_name) {
			echo '<p class="payment-right-amount-negative">-$'.$userlist[$i]->total.'</p>';
			}?>
			</div>
			</br>
			<!-- Payment type -->
					<?php
			
			if ($userlist[$i]->payment_type == 'Deposit') {
			echo '<p class="payment-space-tabs">Payment '.$userlist[$i]->payment_type.'</p>';
			} elseif ($userlist[$i]->payment_type == 'Withdraw') {
			echo '<p class="payment-space-tabs">Payment '.$userlist[$i]->payment_type.'</p>';
			} elseif ($userlist[$i]->payment_type == 'request') {
			echo '<p class="payment-space-tabs">Payment '.$userlist[$i]->payment_type.'</p>';
			} elseif ($userlist[$i]->payment_type == 'Card Verified') {
			echo '<p class="payment-space-tabs">'.$userlist[$i]->payment_type.'</p>';
			
			} elseif ($userlist[$i]->sender_name) {
			if ($userlist[$i]->shipping == '1') {
			echo '<p class="payment-space-tabs">Product Paid</p>';
				} else {
					echo '<p class="payment-space-tabs">Payment '.$userlist[$i]->payment_type.' </br>';
				}
			}?>
			
					</div>
				</div>
			</div><!-- page-title -->
			<div id="details-<?php echo $userlist[$i]->id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="transaction-<?php echo $userlist[$i]->id; ?>">
				<div class="panel-body">
					 <div class="row">
					 <div class="col-md-6"><strong>
					 <!-- Paid by -->
					 <?php
			if ($userlist[$i]->payment_type == 'Deposit') {
					 echo 'Deposit with';
					 } elseif ($userlist[$i]->payment_type == 'Withdraw') {
					 echo 'Withdraw with';
					 
					 } elseif ($userlist[$i]->payment_type == 'request') {
					 echo 'Requested by';
					 
					 } elseif ($userlist[$i]->payment_type == 'Card Verified') {
					 echo 'Paid by';
			
					 } elseif ($userlist[$i]->sender_name) {
					 echo 'Paid with';
					 }?>
					 </strong>
					 <!-- Payment Method -->
					 <p>
					  <?php
			if ($userlist[$i]->payment_type == 'Deposit') {
			echo $userlist[$i]->payment_method;
			} elseif ($userlist[$i]->payment_type == 'Withdraw') {
			echo $userlist[$i]->payment_method;
			
			} elseif ($userlist[$i]->payment_type == 'Card Verified') {
			echo $userlist[$i]->receiver;
			
			} elseif ($userlist[$i]->payment_type == 'request') {
			echo $userlist[$i]->sender_name.'</br><a href="mailto:'.$userlist[$i]->sender_email.'">'.$userlist[$i]->sender_email.'</a>';
			
			} elseif ($userlist[$i]->sender_name) {
			echo $this->site_settings->site_name.' '.$userlist[$i]->payment_method.'';
			}?>
					 </p>
					  <!-- Item details -->
					 <?php if ($userlist[$i]->item_name): ?>
					 </br>
					 <strong>Item details</strong>
					 </br>
					 Item Name: <?php echo $userlist[$i]->item_name;?></br>
					 
					 <?php if ($userlist[$i]->item_number): ?>
					 Item Number: #<?php echo $userlist[$i]->item_number;?><br>
					 <?php endif; ?>
					 </br>
					 <?php endif; ?>
					 
					 <?php if ($userlist[$i]->receiver): ?>
					 <!-- Shipping address -->
					 <?php if ($userlist[$i]->shipping == '1'): ?>
					 <strong>Shipping to address</strong>
					 </br>
					 <?php echo $userlist[$i]->address1;?></br>
					 
					 <?php if ($userlist[$i]->address4): ?>
					 <?php echo $userlist[$i]->address2;?>, <?php echo $userlist[$i]->address4;?><br>
					 <?php else: ?>
					 
					 <?php echo $userlist[$i]->address2;?><br>
					 <?php endif; ?>
					 
					 <?php echo $userlist[$i]->address3;?>
					 <?php endif; ?>
					 </br></br>
					 <?php endif; ?>
					 <strong>Transaction ID </strong>
					 <p><?php echo $userlist[$i]->txn_id; ?></p>
					 </div>
					 <div class="col-md-6 pull-right">
					 <span class="pull-left"><strong>
					 <!-- Header status -->
					 <?php
			if ($userlist[$i]->payment_type == 'Deposit') {
			echo 'Deposit By';
			} elseif ($userlist[$i]->payment_type == 'Withdraw') {
			echo $userlist[$i]->payment_method.' Account';
			
			} elseif ($userlist[$i]->payment_type == 'Card Verified') {
			echo '';
			
			} elseif ($userlist[$i]->sender_name) {
			echo 'Sent to';
			}?>
					 </strong>
					 <!-- Receiver name -->
					 <p><?php
			if ($userlist[$i]->payment_type == 'Deposit') {
			echo $userlist[$i]->receiver;
			} elseif ($userlist[$i]->payment_type == 'Withdraw') {
			echo $userlist[$i]->email_add;
			
			} elseif ($userlist[$i]->payment_type == 'Card Verified') {
			echo '';
			
			} elseif ($userlist[$i]->sender_name) {
			echo $userlist[$i]->receiver_name;
			}?>
			</p>
			</br></br>
			<!-- Details left fees -->
					 
					 <?php
			if ($userlist[$i]->payment_type == 'Deposit') {
			echo '<strong>Details </strong>';
			} elseif ($userlist[$i]->payment_type == 'Withdraw') {
			echo '<strong>Details </strong>';
			
			} elseif ($userlist[$i]->payment_type == 'Card Verified') {
			echo '';
			
			} elseif ($userlist[$i]->sender_name) {
			echo '<strong>Details </strong>';
			}?>
					 
					 <p>
					 <?php
			if ($userlist[$i]->payment_type == 'Deposit') {
			echo '
			<!-- Payment Sent -->
			<div class="row">
			<div class="col-md-6">Sent to '.$userlist[$i]->receiver_name.'</div><div class="col-md-6"><span class="pull-right">'.$this->site_settings->curr_symb.''.$userlist[$i]->total.'</span></div>
			
			<!-- Payment Fees -->
			<div class="col-md-6">Fee</div><div class="col-md-6"><span class="pull-right">-'.$this->site_settings->curr_symb.''.$userlist[$i]->fees.'</span></div>
			</div>
			<div class="row">
			<!-- Payment Total-->
			<div class="col-md-6"><strong>Total</strong></div><div class="col-md-6"><span class="pull-right"><strong>'.$this->site_settings->curr_symb.''.$userlist[$i]->amount.'</strong></span></div>
			</div>
			';
			
			} elseif ($userlist[$i]->payment_type == 'Withdraw') {
			echo '
			<!-- Payment Sent -->
			<div class="row">
			<div class="col-md-6"><strong>'.$userlist[$i]->status.'</strong> Amount  '.$userlist[$i]->receiver_name.'</div><div class="col-md-6"><span class="pull-right">'.$this->site_settings->curr_symb.''.$userlist[$i]->total.'</span></div>
			
			<!-- Payment Fees -->
			<div class="col-md-6">Fee</div><div class="col-md-6"><span class="pull-right">-'.$this->site_settings->curr_symb.''.$userlist[$i]->fees.'</span></div>
			</div>
			<div class="row">
			<!-- Payment Total-->
			<div class="col-md-6"><strong>Total</strong></div><div class="col-md-6"><span class="pull-right"><strong>'.$this->site_settings->curr_symb.''.$userlist[$i]->amount.'</strong></span></div>
			</div>
			';
			
			} elseif ($userlist[$i]->payment_type == 'Card Verified') {
			echo '';
			
			} elseif ($userlist[$i]->payment_type == 'request') {
			echo 'Requesting for Payment amount <b>'.$this->site_settings->curr_symb.''.$userlist[$i]->total.'</b>
			';
			
			} elseif ($userlist[$i]->sender_name) {
			echo '
			<!-- Payment Sent -->
			<div class="row">
			<div class="col-md-6">Sent to '.explode(' ',trim($userlist[$i]->receiver_name))[0].'</div><div class="col-md-6"><span class="pull-right">'.$this->site_settings->curr_symb.''.$userlist[$i]->total.'</span></div>
			
			<!-- Payment Fees -->
			<div class="col-md-6">Fee</div><div class="col-md-6"><span class="pull-right">-'.$this->site_settings->curr_symb.''.$userlist[$i]->fees.'</span></div>
			</div>
			<div class="row">
			<!-- Payment Total-->
			<div class="col-md-6"><strong>Total sent</strong></div><div class="col-md-6"><span class="pull-right"><strong>'.$this->site_settings->curr_symb.''.$userlist[$i]->total.'</strong></span></div>
			</div>
			<!-- refund -->
			 <form role="form" method="post" action="'.site_url('admin/refund').'">
					 <input type="hidden" name="transaction_id" value="'.$userlist[$i]->txn_id.'">
					 <input type="hidden" name="amount" value="'.$userlist[$i]->total.'">
					 <input type="hidden" name="receiver" value="'.$userlist[$i]->sender_email.'">
					 <input type="hidden" name="'. $this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'">
					 <button class="panel-refund-button" type="submit" name="refund-send">Refund</button>
					 </form>
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
		<?php echo $pagination; ?>
              </div>
	 
			</div>
			
	 </div>
	 </div>
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->