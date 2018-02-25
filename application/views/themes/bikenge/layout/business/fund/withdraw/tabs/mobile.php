		  <?php if ($this->site_settings->withdraw_method_mpesa == 1): ?>
		  <!-- M-PESA -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/withdraw/mpesa/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4>M-PESA</h4>
		  <p><?php echo $this->lang->line('fund_withdraw_fess_notice'); ?> </br>
		  <?php if (empty($this->site_settings->withdraw_mpesa_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->withdraw_mpesa_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->withdraw_mpesa_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->withdraw_mpesa_flat_fees.''; ?> 
		  <?php endif; ?></p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->withdraw_method_tigopesa == 1): ?>
		  <!-- TIGO-PESA -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/withdraw/tigopesa/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4>TIGO PESA</h4>
		  <p><?php echo $this->lang->line('fund_withdraw_fess_notice'); ?>
		  </br>
		  <?php if (empty($this->site_settings->withdraw_tigopesa_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->withdraw_tigopesa_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->withdraw_tigopesa_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->withdraw_tigopesa_flat_fees.''; ?> 
		  <?php endif; ?></p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->withdraw_method_mtn == 1): ?>
		  <!-- MTN -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/withdraw/mtn/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4>MTN</h4>
		  <p><?php echo $this->lang->line('fund_withdraw_fess_notice'); ?>
		  </br>
		  <?php if (empty($this->site_settings->withdraw_mtn_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->withdraw_mtn_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->withdraw_mtn_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->withdraw_mtn_flat_fees.''; ?> 
		  <?php endif; ?></</p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->withdraw_method_orange == 1): ?>
		  <!-- ORANGE -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/withdraw/orange/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4>ORANGE</h4>
		  <p><?php echo $this->lang->line('fund_withdraw_fess_notice'); ?>
		  </br>
		  <?php if (empty($this->site_settings->withdraw_orange_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->withdraw_orange_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->withdraw_orange_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->withdraw_orange_flat_fees.''; ?> 
		  <?php endif; ?></</p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>