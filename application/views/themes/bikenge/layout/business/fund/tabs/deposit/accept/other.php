		  <?php if ($this->site_settings->deposit_method_bitcoin == 1): ?>
		  <!-- Bitcoin -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/add/bitcoin/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4><i class="pf pf-btc pf-lg" aria-hidden="true"></i></h4>
		  <p><?php echo $this->lang->line('fund_deposit_fess_notice'); ?> </br>
		  <?php if (empty($this->site_settings->deposit_bitcoin_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->deposit_bitcoin_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->deposit_bitcoin_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->deposit_bitcoin_flat_fees.''; ?> 
		  <?php endif; ?></</p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->deposit_method_paypal == 1): ?>
		  <!-- paypal -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/add/paypal/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4><i class="pf pf-paypal pf-lg" aria-hidden="true"></i></h4>
		  <p><?php echo $this->lang->line('fund_deposit_fess_notice'); ?></br>
		  <?php if (empty($this->site_settings->deposit_paypal_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->deposit_paypal_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->deposit_paypal_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->deposit_paypal_flat_fees.''; ?> 
		  <?php endif; ?></</p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->deposit_method_western == 1): ?>
		  <!-- western union -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/add/western/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4><i class="pf pf-western-union pf-lg" aria-hidden="true"></i></h4>
		  <p><?php echo $this->lang->line('fund_deposit_fess_notice'); ?></br>
		  <?php if (empty($this->site_settings->deposit_western_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->deposit_western_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->deposit_western_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->deposit_western_flat_fees.''; ?> 
		  <?php endif; ?></</p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  
		  
		  
		  