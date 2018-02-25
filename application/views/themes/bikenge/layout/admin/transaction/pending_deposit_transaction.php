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
			<h6>
			<?php echo $this->lang->line('pending_deposit_well_h6');?>
			<i class="fa fa-circle-o-notch fa-spin fa-lg fa-fw pull-right"></i>
			<span class="sr-only">Loading...</span>
			</h6>
	  </div>
	  
	  <?php
        if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
		  '.validation_errors().'
                </div>';
                  
        }
		
		// Pending Deposit failed alert.
      	if ($this->session->pending_accept_deposit_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('pending_accept_deposit_failed').'
      			  </div>';
      	}
		
		// Pending Deposit success alert.
      	if ($this->session->pending_accept_deposit_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('pending_accept_deposit_success').'
      			  </div>';
      	}
		
		// Cancel failed alert.
      	if ($this->session->pending_cancel_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('pending_cancel_failed').'
      			  </div>';
      	}
		
		// Cancel success alert.
      	if ($this->session->pending_cancel_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('pending_cancel_success').'
      			  </div>';
      	}
      	?>
		
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

		<?php for ($i = 0; $i < count($pending); ++$i) { ?>
		<div class="panel panel-default panel-transaction">
			<div class="panel-heading panel-head-transaction" role="tab" id="transaction-<?php echo $pending[$i]->id; ?>" data-toggle="collapse" data-parent="#accordion" href="#details-<?php echo $pending[$i]->id; ?>" aria-expanded="true" aria-controls="details-<?php echo $pending[$i]->id; ?>">
				<div class="panel-title panel-title-transaction">
					<div class="panel-head-transaction">
					<!-- Date left header -->
			
			<span class="payment-span-space-tabs"><?php echo date("M <b>d</b>", $pending[$i]->date); ?></span>
			
			<!-- Sender and Receiver -->
			<span class="panel-head-name">
			<?php
			if ($pending[$i]->payment_type == 'Deposit') {
			echo $pending[$i]->receiver;
			}?>
			</span>
			<!-- Paymentt total amount -->
						<div class="details-right"><?php
			
			if ($pending[$i]->payment_type == 'Deposit') {
			echo '<p class="payment-right-amount-positive">+'.$this->site_settings->curr_symb.''.$pending[$i]->amount.'</p>';
			
			}?>
			</div>
			</br>
			<!-- Payment type -->
					<?php
			
			if ($pending[$i]->payment_type == 'Deposit') {
			echo '<p class="payment-space-tabs">Payment '.$pending[$i]->payment_type.'</p>';
			}?>
			
					</div>
				</div>
			</div><!-- page-title -->
			<div id="details-<?php echo $pending[$i]->id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="transaction-<?php echo $pending[$i]->id; ?>">
				<div class="panel-body">
					 <div class="row">
					 <div class="col-md-6"><strong>
					 <!-- Paid by -->
					 <?php
			if ($pending[$i]->payment_type == 'Deposit') {
					 echo 'Deposit with';
					 }?>
					 </strong>
					 <!-- Payment Method -->
					 <p>
					  <?php
			if ($pending[$i]->payment_type == 'Deposit') {
			echo $pending[$i]->payment_method;
			
			}?>
					 </p>
					 <strong>Transaction ID </strong>
					 <p><?php echo $pending[$i]->txn_id; ?></p>
					 </div>
					 <div class="col-md-6 pull-right">
					 <span class="pull-left"><strong>
					 <!-- Header status -->
					 <?php
			if ($pending[$i]->payment_type == 'Deposit') {
			echo 'Deposit By';
			}?>
					 </strong>
					 <!-- Receiver name -->
					 <p><?php
			if ($pending[$i]->payment_type == 'Deposit') {
			echo $pending[$i]->receiver;
			}?>
			</p>
			</br></br>
			<!-- Details left fees -->
					 
					 <?php
			if ($pending[$i]->payment_type == 'Deposit') {
			echo '<strong>Details </strong>';
			}?>
					 
					 <p>
					 <?php
			if ($pending[$i]->payment_type == 'Deposit') {
			echo '
			<!-- Payment Sent -->
			<div class="row">
			<div class="col-md-6">Deposit</div><div class="col-md-6"><span class="pull-right">'.$this->site_settings->curr_symb.''.$pending[$i]->total.'</span></div>
			
			<!-- Payment Fees -->
			<div class="col-md-6">Fee</div><div class="col-md-6"><span class="pull-right">-'.$this->site_settings->curr_symb.''.$pending[$i]->fees.'</span></div>
			</div>
			<div class="row">
			<!-- Payment Total-->
			<div class="col-md-6"><strong>Total</strong></div><div class="col-md-6"><span class="pull-right"><strong>'.$this->site_settings->curr_symb.''.$pending[$i]->amount.'</strong></span></div>
			</div>
					 <!-- Accept form -->
					 <form role="form" method="post" action="'.site_url('admin/pending/deposit').'">
					 <input type="hidden" name="transaction_id" value="'.$pending[$i]->txn_id.'">
					 <input type="hidden" name="'. $this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'">
					 <button class="panel-accept-button" type="submit" name="accept-deposit">Accept Request</button>
					 </form>
					 
					 <!-- Cancel form -->
					 <form role="form" method="post" action="'.site_url('admin/pending/deposit').'">
					 <input type="hidden" name="transaction_id" value="'.$pending[$i]->txn_id.'">
					 <input type="hidden" name="'. $this->security->get_csrf_token_name().'" value="'.$this->security->get_csrf_hash().'">
					 <button class="panel-refund-button" type="submit" name="cancel-deposit">Cancel Request</button>
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
	 </div>
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->