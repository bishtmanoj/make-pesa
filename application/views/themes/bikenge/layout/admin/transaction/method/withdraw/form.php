<div class="well">
			<div class="well-header">
               <h5 class="text-center"><?php echo $this->lang->line('admin_payment_method_h5_well_withdraw');?></h5>
			   
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
		<input type="checkbox" name="withdraw_method_card" value="1" <?php echo (set_checkbox('withdraw_method_card', '1')) ? set_checkbox('withdraw_method_card', '1') : (($this->site_settings->withdraw_method_card == '1') ? 'checked' : ''); ?>>
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
		<input type="checkbox" name="withdraw_method_bank" value="1" <?php echo (set_checkbox('withdraw_method_bank', '1')) ? set_checkbox('withdraw_method_bank', '1') : (($this->site_settings->withdraw_method_bank == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
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
		<input type="checkbox" name="withdraw_method_mpesa" value="1" <?php echo (set_checkbox('withdraw_method_mpesa', '1')) ? set_checkbox('withdraw_method_mpesa', '1') : (($this->site_settings->withdraw_method_mpesa == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
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
		<input type="checkbox" name="withdraw_method_tigopesa" value="1" <?php echo (set_checkbox('withdraw_method_tigopesa', '1')) ? set_checkbox('withdraw_method_tigopesa', '1') : (($this->site_settings->withdraw_method_tigopesa == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
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
		<input type="checkbox" name="withdraw_method_mtn" value="1" <?php echo (set_checkbox('withdraw_method_mtn', '1')) ? set_checkbox('withdraw_method_mtn', '1') : (($this->site_settings->withdraw_method_mtn == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
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
		<input type="checkbox" name="withdraw_method_orange" value="1" <?php echo (set_checkbox('withdraw_method_orange', '1')) ? set_checkbox('withdraw_method_orange', '1') : (($this->site_settings->withdraw_method_orange == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
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
		<input type="checkbox" name="withdraw_method_paypal" value="1" <?php echo (set_checkbox('withdraw_method_paypal', '1')) ? set_checkbox('withdraw_method_paypal', '1') : (($this->site_settings->withdraw_method_paypal == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
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
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="withdraw_method_bitcoin" value="1" <?php echo (set_checkbox('withdraw_method_bitcoin', '1')) ? set_checkbox('withdraw_method_bitcoin', '1') : (($this->site_settings->withdraw_method_bitcoin == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
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
		<input type="checkbox" name="withdraw_method_western" value="1" <?php echo (set_checkbox('withdraw_method_western', '1')) ? set_checkbox('withdraw_method_western', '1') : (($this->site_settings->withdraw_method_western == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		<!-- End Western Union -->
		
		<!-- MoneyGram -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-cash pf-lg" aria-hidden="true"></i> MoneyGram
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="withdraw_method_moneygram" value="1" <?php echo (set_checkbox('withdraw_method_moneygram', '1')) ? set_checkbox('withdraw_method_moneygram', '1') : (($this->site_settings->withdraw_method_moneygram == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		<!-- End MoneyGram -->
		
		<!-- PerfectMoney -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-cash pf-lg" aria-hidden="true"></i> PerfectMoney
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="withdraw_method_perfectmoney" value="1" <?php echo (set_checkbox('withdraw_method_perfectmoney', '1')) ? set_checkbox('withdraw_method_perfectmoney', '1') : (($this->site_settings->withdraw_method_perfectmoney == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		<!-- End PerfectMoney -->
		
		<!-- Neteller -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-cash pf-lg" aria-hidden="true"></i> Neteller
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="withdraw_method_neteller" value="1" <?php echo (set_checkbox('withdraw_method_neteller', '1')) ? set_checkbox('withdraw_method_neteller', '1') : (($this->site_settings->withdraw_method_neteller == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		<!-- End Neteller -->
		
		<!-- Skrill -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-skrill pf-lg" aria-hidden="true"></i>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="withdraw_method_skrill" value="1" <?php echo (set_checkbox('withdraw_method_skrill', '1')) ? set_checkbox('withdraw_method_skrill', '1') : (($this->site_settings->withdraw_method_skrill == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		<!-- End Skrill -->
		
		<!-- Payza -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-cash pf-lg" aria-hidden="true"></i> Payza
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="withdraw_method_payza" value="1" <?php echo (set_checkbox('withdraw_method_payza', '1')) ? set_checkbox('withdraw_method_payza', '1') : (($this->site_settings->withdraw_method_payza == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		<!-- End Payza -->
		
		<!-- Payu -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="pf pf-payu pf-lg" aria-hidden="true"></i>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="withdraw_method_payu" value="1" <?php echo (set_checkbox('withdraw_method_payu', '1')) ? set_checkbox('withdraw_method_payu', '1') : (($this->site_settings->withdraw_method_payu == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		<!-- End Payu -->
		
		<div class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn-primary btn-block" type="submit" id="anmationBKPesa_wait"><?php echo $this->lang->line('admin_withdraw_form_submit_button');?></button>
      </div>
	  </form>
	  </div>
	  <!-- Form End -->
	 
			</div>
			