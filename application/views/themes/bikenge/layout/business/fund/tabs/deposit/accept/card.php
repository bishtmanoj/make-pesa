		  <?php if ($this->site_settings->deposit_method_card == 1): ?>
		  <!-- Card -->
		  <div class="payment-icon-method int-bank-accept">
		  <a href="<?php echo site_url().'fund/add/card/'; ?>">
		  <div class="payment-icon-box-margin">
		  <h4>Credit & Debit Card</h4>
		  <p><?php echo $this->lang->line('fund_deposit_fess_notice'); ?></br>
		  <?php if (empty($this->site_settings->card_deposit_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->card_deposit_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->card_deposit_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->card_deposit_flat_fees.''; ?> 
		  <?php endif; ?>
		  </p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->deposit_method_bank == 1): ?>
		  <!-- Bank -->
		  <div class="payment-icon-method int-bank-accept">
		  <a href="<?php echo site_url().'fund/add/bank/'; ?>">
		  <div class="payment-icon-box-margin">
		  <h4>Bank Transfer</h4>
		  <p><?php echo $this->lang->line('fund_deposit_fess_notice'); ?></br> 
		  <?php if (empty($this->site_settings->bank_deposit_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->bank_deposit_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->bank_deposit_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->bank_deposit_flat_fees.''; ?> 
		  <?php endif; ?>
		  </p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  