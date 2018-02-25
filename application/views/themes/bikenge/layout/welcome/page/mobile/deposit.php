	<div class="welcome-home-account">
	 <h1>
  <?php echo $this->lang->line('welcome_page_mobile_deposit_cover_account_note_h1');?>
  </h1>
  </div>
  
  <!-- Accept mobile money-->
  		  <div class="mobile-accept-method-well">
		  <?php if ($this->site_settings->deposit_method_mpesa == 1): ?>
		  <!-- M-PESA -->
		  <div class="mobile-accept-method mpesa-accept">
		  <div class="mobile-accept-box-margin">
		  <h4>M-PESA</h4>
		  <i class="fa fa-money" aria-hidden="true"></i>
		  </div>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->deposit_method_tigopesa == 1): ?>
		  <!-- TIGO-PESA -->
		  <div class="mobile-accept-method tigo-accept">
		  <div class="mobile-accept-box-margin">
		  <h4>TIGO PESA</h4>
		  <i class="fa fa-money" aria-hidden="true"></i>
		  </div>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->deposit_method_mtn == 1): ?>
		  <!-- MTN -->
		  <div class="mobile-accept-method mtn-accept">
		  <div class="mobile-accept-box-margin">
		  <h4>MTN MONEY</h4>
		  <i class="fa fa-money" aria-hidden="true"></i>
		  </div>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->deposit_method_orange == 1): ?>
		  <!-- ORANGE -->
		  <div class="mobile-accept-method orange-accept">
		  <div class="mobile-accept-box-margin">
		  <h4>ORANGE</h4>
		  <i class="fa fa-money" aria-hidden="true"></i>
		  </div>
		  </div>
		  <?php endif; ?>
		  </div>