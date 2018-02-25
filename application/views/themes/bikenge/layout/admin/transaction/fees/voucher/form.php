<div class="well">
			<div class="well-header">
               <h5 class="text-center"><?php echo $this->lang->line('admin_payment_discount_h5_well_voucher');?></h5>
			   
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
		<i class="fa fa-diamond" aria-hidden="true"></i> VOUCHER
		</div>
		<div class="col-xs-4 col-md-4">
		<input type="text" name="discount_percentage_fees" class="form-control" value="<?php echo $this->site_settings->discount_percentage_fees; ?>" placeholder="Fees eg. 10 not 10%">
		</div>
		
		<div class="col-xs-5 col-md-5">
		<input type="text" name="discount_flat_fees" class="form-control" value="<?php echo $this->site_settings->discount_flat_fees; ?>" placeholder="Flat fee eg. 0.30">
		</div>
		</div>
		</div>
		<!-- End CARD -->
		
		<div class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn-primary btn-block" type="submit" id="anmationBKPesa_wait"><?php echo $this->lang->line('admin_deposit_form_submit_button');?></button>
      </div>
	  </form>
	  </div>
	  <!-- Form End -->
	 
			</div>
			