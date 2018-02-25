<div class="well">
			<div class="well-header">
               <h5 class="text-center"><?php echo $this->lang->line('admin_payment_method_h5_well_deposit');?></h5>
			   
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
		<?php echo $this->lang->line('admin_payment_method_p_note');?>
		</p>
		<hr>
        <div class="anmationBlock">
		<form method="post">
		<!-- METHOD -->
		<div class="form-group">
		<div class="row">
		<b>
		<div class="col-xs-3 col-md-3">
		<?php echo $this->lang->line('admin_payment_method_method');?>
		</div>
		<div class="col-xs-4 col-md-4">
		<?php echo $this->lang->line('admin_payment_method_percentage_fees');?>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<?php echo $this->lang->line('admin_payment_method_flat_fees');?>
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
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="deposit_method_card" value="1" <?php echo (set_checkbox('deposit_method_card', '1')) ? set_checkbox('deposit_method_card', '1') : (($this->site_settings->deposit_method_card == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
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
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="deposit_method_bank" value="1" <?php echo (set_checkbox('deposit_method_bank', '1')) ? set_checkbox('deposit_method_bank', '1') : (($this->site_settings->deposit_method_bank == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		
		<!-- Bank info -->
		<div class="col-xs-6 col-md-6">
		<textarea name="bank_deposit_details" class="form-control" placeholder="<?php echo $this->lang->line('admin_payment_method_deposit_form_bank_info');?>">
		<?php echo $this->site_settings->bank_deposit_details; ?>
		</textarea>
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
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="deposit_method_mpesa" value="1" <?php echo (set_checkbox('deposit_method_mpesa', '1')) ? set_checkbox('deposit_method_mpesa', '1') : (($this->site_settings->deposit_method_mpesa == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		
		<!-- M-PESA paybill no -->
		<div class="col-xs-6 col-md-6">
		<input type="text" name="mpesa_paybill" class="form-control" value="<?php echo $this->site_settings->mpesa_paybill; ?>" placeholder="<?php echo $this->lang->line('admin_payment_method_deposit_form_mpesa_paybill');?>">
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
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="deposit_method_tigopesa" value="1" <?php echo (set_checkbox('deposit_method_tigopesa', '1')) ? set_checkbox('deposit_method_tigopesa', '1') : (($this->site_settings->deposit_method_tigopesa == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		
		<!-- TIG-PESA paybill no -->
		<div class="col-xs-6 col-md-6">
		<input type="text" name="tigopesa_paybill" class="form-control" value="<?php echo $this->site_settings->tigopesa_paybill; ?>" placeholder="<?php echo $this->lang->line('admin_payment_method_deposit_form_tigopesa_paybill');?>">
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
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="deposit_method_mtn" value="1" <?php echo (set_checkbox('deposit_method_mtn', '1')) ? set_checkbox('deposit_method_mtn', '1') : (($this->site_settings->deposit_method_mtn == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		
		<!-- MTN paybill no -->
		<div class="col-xs-6 col-md-6">
		<input type="text" name="mtn_paybill" class="form-control" value="<?php echo $this->site_settings->mtn_paybill; ?>" placeholder="<?php echo $this->lang->line('admin_payment_method_deposit_form_mtn_paybill');?>">
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
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="deposit_method_orange" value="1" <?php echo (set_checkbox('deposit_method_orange', '1')) ? set_checkbox('deposit_method_orange', '1') : (($this->site_settings->deposit_method_orange == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		
		<!-- ORANGE paybill no -->
		<div class="col-xs-6 col-md-6">
		<input type="text" name="orange_paybill" class="form-control" value="<?php echo $this->site_settings->orange_paybill; ?>" placeholder="<?php echo $this->lang->line('admin_payment_method_deposit_form_orange_paybill');?>">
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
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="deposit_method_paypal" value="1" <?php echo (set_checkbox('deposit_method_paypal', '1')) ? set_checkbox('deposit_method_paypal', '1') : (($this->site_settings->deposit_method_paypal == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		
		<!-- Paypal Email -->
		<div class="col-xs-6 col-md-6">
		<input type="text" name="paypal_email" class="form-control" value="<?php echo $this->site_settings->paypal_email; ?>" placeholder="<?php echo $this->lang->line('admin_payment_method_deposit_form_paypal_email');?>">
		</div>
		
		</div>
		</div>
		<!-- End paypal -->
		
		<!-- paypal setting -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-paypal-alt pf-lg" aria-hidden="true"></i> Paypal live
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa fa-cog" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="paypal_url_live" value="1" <?php echo (set_checkbox('paypal_url_live', '1')) ? set_checkbox('paypal_url_live', '1') : (($this->site_settings->paypal_url_live == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		<!-- End paypal setting -->
		
		<!-- Bitcoin -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-btc pf-lg" aria-hidden="true"></i> Bitcoin
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="deposit_method_bitcoin" value="1" <?php echo (set_checkbox('deposit_method_bitcoin', '1')) ? set_checkbox('deposit_method_bitcoin', '1') : (($this->site_settings->deposit_method_bitcoin == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		
		<!-- Bitcoin blockchain setting -->
		<div class="col-xs-6 col-md-6">
		<input type="text" name="blockchain_pub" class="form-control" value="<?php echo $this->site_settings->blockchain_pub; ?>" placeholder="<?php echo $this->lang->line('admin_payment_method_deposit_form_bitcoin_pub');?>">
		</div>
		<div class="col-xs-5 col-md-5">
		<input type="text" name="blockchain_key" class="form-control" value="<?php echo $this->site_settings->blockchain_key; ?>" placeholder="<?php echo $this->lang->line('admin_payment_method_deposit_form_bitcoin_key');?>">
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
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="deposit_method_western" value="1" <?php echo (set_checkbox('deposit_method_western', '1')) ? set_checkbox('deposit_method_western', '1') : (($this->site_settings->deposit_method_western == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		
		<!-- Bank info -->
		<div class="col-xs-6 col-md-6">
		<textarea name="western_info" class="form-control" placeholder="<?php echo $this->lang->line('admin_payment_method_deposit_form_western_info');?>">
		<?php echo $this->site_settings->western_info; ?>
		</textarea>
		</div>
		
		</div>
		</div>
		<!-- End Western Union -->
		
		
		
		<div class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn-primary btn-block" type="submit" id="anmationBKPesa_wait"><?php echo $this->lang->line('admin_deposit_form_submit_button');?></button>
      </div>
	  </form>
	  </div>
	  <!-- Form End -->
	 
			</div>
			