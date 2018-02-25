<div class="well">
			<div class="well-header">
               <h5 class="text-center"><?php echo $this->lang->line('admin_payment_fees_h5_well_deposit');?></h5>
			   
		<!-- Form personal signup-->
        <?php
        if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
		  '.validation_errors().'
                </div>';
                  
        }
		
		// Admin change failed alert.
      	if ($this->session->admin_setting_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('admin_setting_failed').'
      			  </div>';
      	}
		
		// Admin change success alert.
      	if ($this->session->admin_setting_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('admin_setting_success').'
      			  </div>';
      	}
		
      	?>
		<p>
		<?php echo $this->lang->line('admin_payment_fees_p_note');?>
		</p>
		<hr>
        <div class="anmationBlock">
		<form method="post">
		<!-- METHOD -->
		<div class="form-group">
		<div class="row">
		<b>
		<div class="col-xs-3 col-md-3">
		<?php echo $this->lang->line('admin_payment_fees_deposit_method');?>
		</div>
		<div class="col-xs-4 col-md-4">
		<?php echo $this->lang->line('admin_payment_fees_percentage_fees');?>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<?php echo $this->lang->line('admin_payment_fees_flat_fees');?>
		</div>
		
		</b>
		</div>
		</div>
		<!-- End METHOD -->
		
		<!-- CARD -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-mastercard-alt pf-lg" aria-hidden="true"></i> CARD
		</div>
		<div class="col-xs-4 col-md-4">
		<input type="text" name="card_deposit_percentage_fees" class="form-control" value="<?php echo $this->site_settings->card_deposit_percentage_fees; ?>" placeholder="Fees eg. 10 not 10%">
		</div>
		
		<div class="col-xs-5 col-md-5">
		<input type="text" name="card_deposit_flat_fees" class="form-control" value="<?php echo $this->site_settings->card_deposit_flat_fees; ?>" placeholder="Flat fee eg. 0.30">
		</div>
		</div>
		</div>
		<!-- End CARD -->
		
		<!-- BANK -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-bank-transfer pf-lg" aria-hidden="true"></i> BANK
		</div>
		<div class="col-xs-4 col-md-4">
		<input type="text" name="bank_deposit_percentage_fees" class="form-control" value="<?php echo $this->site_settings->bank_deposit_percentage_fees; ?>" placeholder="Fees eg. 10 not 10%">
		</div>
		
		<div class="col-xs-5 col-md-5">
		<input type="text" name="bank_deposit_flat_fees" class="form-control" value="<?php echo $this->site_settings->bank_deposit_flat_fees; ?>" placeholder="Flat fee eg. 0.30">
		</div>
		</div>
		</div>
		<!-- End BANK -->
		
		<!-- M-PESA -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-cash pf-lg" aria-hidden="true"></i> M-PESA
		</div>
		<div class="col-xs-4 col-md-4">
		<input type="text" name="deposit_mpesa_percentage_fees" class="form-control" value="<?php echo $this->site_settings->deposit_mpesa_percentage_fees; ?>" placeholder="Fees eg. 10 not 10%">
		</div>
		
		<div class="col-xs-5 col-md-5">
		<input type="text" name="deposit_mpesa_flat_fees" class="form-control" value="<?php echo $this->site_settings->deposit_mpesa_flat_fees; ?>" placeholder="Flat fee eg. 0.30">
		</div>
		</div>
		</div>
		<!-- End M-PESA -->
		
		<!-- TIGO-PESA -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-cash pf-lg" aria-hidden="true"></i> TIGO-PESA
		</div>
		<div class="col-xs-4 col-md-4">
		<input type="text" name="deposit_tigopesa_percentage_fees" class="form-control" value="<?php echo $this->site_settings->deposit_tigopesa_percentage_fees; ?>" placeholder="Fees eg. 10 not 10%">
		</div>
		
		<div class="col-xs-5 col-md-5">
		<input type="text" name="deposit_tigopesa_flat_fees" class="form-control" value="<?php echo $this->site_settings->deposit_tigopesa_flat_fees; ?>" placeholder="Flat fee eg. 0.30">
		</div>
		</div>
		</div>
		<!-- End TIGO-PESA -->
		
		<!-- MTN -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-cash pf-lg" aria-hidden="true"></i> MTN
		</div>
		<div class="col-xs-4 col-md-4">
		<input type="text" name="deposit_mtn_percentage_fees" class="form-control" value="<?php echo $this->site_settings->deposit_mtn_percentage_fees; ?>" placeholder="Fees eg. 10 not 10%">
		</div>
		
		<div class="col-xs-5 col-md-5">
		<input type="text" name="deposit_mtn_flat_fees" class="form-control" value="<?php echo $this->site_settings->deposit_mtn_flat_fees; ?>" placeholder="Flat fee eg. 0.30">
		</div>
		</div>
		</div>
		<!-- End MTN -->
		
		<!-- ORANGE -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-cash pf-lg" aria-hidden="true"></i> ORANGE
		</div>
		<div class="col-xs-4 col-md-4">
		<input type="text" name="deposit_orange_percentage_fees" class="form-control" value="<?php echo $this->site_settings->deposit_orange_percentage_fees; ?>" placeholder="Fees eg. 10 not 10%">
		</div>
		
		<div class="col-xs-5 col-md-5">
		<input type="text" name="deposit_orange_flat_fees" class="form-control" value="<?php echo $this->site_settings->deposit_orange_flat_fees; ?>" placeholder="Flat fee eg. 0.30">
		</div>
		</div>
		</div>
		<!-- End ORANGE -->
		
		<!-- paypal -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-paypal-alt pf-lg" aria-hidden="true"></i> Paypal
		</div>
		<div class="col-xs-4 col-md-4">
		<input type="text" name="deposit_paypal_percentage_fees" class="form-control" value="<?php echo $this->site_settings->deposit_paypal_percentage_fees; ?>" placeholder="Fees eg. 10 not 10%">
		</div>
		
		<div class="col-xs-5 col-md-5">
		<input type="text" name="deposit_paypal_flat_fees" class="form-control" value="<?php echo $this->site_settings->deposit_paypal_flat_fees; ?>" placeholder="Flat fee eg. 0.30">
		</div>
		</div>
		</div>
		<!-- End paypal -->
		
		<!-- Bitcoin -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-btc pf-lg" aria-hidden="true"></i> Bitcoin
		</div>
		<div class="col-xs-4 col-md-4">
		<input type="text" name="deposit_bitcoin_percentage_fees" class="form-control" value="<?php echo $this->site_settings->deposit_bitcoin_percentage_fees; ?>" placeholder="Fees eg. 10 not 10%">
		</div>
		
		<div class="col-xs-5 col-md-5">
		<input type="text" name="deposit_bitcoin_flat_fees" class="form-control" value="<?php echo $this->site_settings->deposit_bitcoin_flat_fees; ?>" placeholder="Flat fee eg. 0.30">
		</div>
		</div>
		</div>
		<!-- End Bitcoin -->
		
		<!-- Western Union -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-western-union-alt pf-2x" aria-hidden="true"></i>
		</div>
		<div class="col-xs-4 col-md-4">
		<input type="text" name="deposit_western_percentage_fees" class="form-control" value="<?php echo $this->site_settings->deposit_western_percentage_fees; ?>" placeholder="Fees eg. 10 not 10%">
		</div>
		
		<div class="col-xs-5 col-md-5">
		<input type="text" name="deposit_western_flat_fees" class="form-control" value="<?php echo $this->site_settings->deposit_western_flat_fees; ?>" placeholder="Flat fee eg. 0.30">
		</div>
		</div>
		</div>
		<!-- End Western Union -->
		
		<!-- PAYSTACK -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-mastercard-alt pf-lg" aria-hidden="true"></i> PAYSTACK
		</div>
		<div class="col-xs-4 col-md-4">
		<input type="text" name="deposit_paystack_percentage_fees" class="form-control" value="<?php echo $this->site_settings->deposit_paystack_percentage_fees; ?>" placeholder="Fees eg. 10 not 10%">
		</div>
		
		<div class="col-xs-5 col-md-5">
		<input type="text" name="deposit_paystack_flat_fees" class="form-control" value="<?php echo $this->site_settings->deposit_paystack_flat_fees; ?>" placeholder="Flat fee eg. 0.30">
		</div>
		</div>
		</div>
		<!-- End PAYSTACK -->
		
		
		<div class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn-primary btn-block" type="submit" id="anmationBKPesa_wait"><?php echo $this->lang->line('admin_deposit_form_submit_button');?></button>
      </div>
	  </form>
	  </div>
	  <!-- Form End -->
	 
			</div>
			