		  <?php if ($this->site_settings->withdraw_method_card == 1): ?>
		  <!-- Card -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/withdraw/card/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4><i class="pf pf-credit-card pf-lg" aria-hidden="true"></i></h4>
		  <p><?php echo $this->lang->line('fund_withdraw_fess_notice'); ?></br>
		  <?php if (empty($this->site_settings->card_withdraw_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->card_withdraw_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->card_withdraw_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->card_withdraw_flat_fees.''; ?> 
		  <?php endif; ?>
		  </p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		 <?php if ($this->site_settings->withdraw_method_bank == 1): ?>
		 <!-- Bank -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/withdraw/bank/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4><i class="pf pf-bank-transfer pf-lg" aria-hidden="true"></i></h4>
		  <p><?php echo $this->lang->line('fund_withdraw_fess_notice'); ?></br> 
		  <?php if (empty($this->site_settings->bank_withdraw_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->bank_withdraw_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->bank_withdraw_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->bank_withdraw_flat_fees.''; ?> 
		  <?php endif; ?>
		  </p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>