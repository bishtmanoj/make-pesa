		<div class="well">
		<h5>
		<?php echo $this->lang->line('fund_deposit_well_header_h5'); ?>
		</h5>
          <?php

        if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                  '.validation_errors().'
                </div>';
                  
        }

		// Fund card status alert.
      	if ($this->session->payment_card_status) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->session->payment_card_status.'
      			  </div>';
      	}
		
		
  	    ?>
		  <div class="fund-payment-method-well">
		  <?php if ($this->site_settings->deposit_method_card == 1 || $this->site_settings->deposit_method_bank == 1): ?>
		  <h5><i class="fa fa-university" aria-hidden="true"></i>
		  <?php echo $this->lang->line('fund_deposit_head_bank_and_card'); ?>
		  </h5>
		  <!-- Card and Bank -->
		<?php $this->load->view($this->themename.'/layout/business/fund/tabs/deposit/accept/card'); ?>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->deposit_method_mpesa == 1 || $this->site_settings->deposit_method_tigopesa == 1 
		  || $this->site_settings->deposit_method_mtn == 1 || $this->site_settings->deposit_method_orange == 1): ?>
		  <!-- Mobile money -->
		  <h5><i class="fa fa-mobile fa-lg" aria-hidden="true"></i> 
		  <?php echo $this->lang->line('fund_deposit_head_mobile_money'); ?>
		  </h5>
		  <?php $this->load->view($this->themename.'/layout/business/fund/tabs/deposit/accept/mobile'); ?>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->deposit_method_bitcoin == 1 || $this->site_settings->deposit_method_paypal == 1 
		  || $this->site_settings->deposit_method_western == 1): ?>
		  <!-- Other -->
		  <h5><i class="fa fa-caret-down" aria-hidden="true"></i> 
		  <?php echo $this->lang->line('fund_deposit_head_other'); ?>
		  </h5>
		  <?php $this->load->view($this->themename.'/layout/business/fund/tabs/deposit/accept/other'); ?>
		  <?php endif; ?>
		  
		  </div>
		  </div><!--well-->
		  