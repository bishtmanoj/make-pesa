		  <?php if ($this->site_settings->withdraw_method_bitcoin == 1): ?>
		  <!-- Bitcoin -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/withdraw/bitcoin/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4><i class="pf pf-btc pf-lg" aria-hidden="true"></i></h4>
		  <p><?php echo $this->lang->line('fund_withdraw_fess_notice'); ?> </br>
		  <?php if (empty($this->site_settings->withdraw_bitcoin_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->withdraw_bitcoin_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->withdraw_bitcoin_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->withdraw_bitcoin_flat_fees.''; ?> 
		  <?php endif; ?></</p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->withdraw_method_paypal == 1): ?>
		  <!-- paypal -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/withdraw/paypal/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4><i class="pf pf-paypal pf-lg" aria-hidden="true"></i></h4>
		  <p><?php echo $this->lang->line('fund_withdraw_fess_notice'); ?></br>
		  <?php if (empty($this->site_settings->withdraw_paypal_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->withdraw_paypal_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->withdraw_paypal_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->withdraw_paypal_flat_fees.''; ?> 
		  <?php endif; ?></</p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->withdraw_method_western == 1): ?>
		  <!-- western union -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/withdraw/western/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4><i class="pf pf-western-union pf-lg" aria-hidden="true"></i></h4>
		  <p><?php echo $this->lang->line('fund_withdraw_fess_notice'); ?></br>
		  <?php if (empty($this->site_settings->withdraw_western_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->withdraw_western_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->withdraw_western_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->withdraw_western_flat_fees.''; ?> 
		  <?php endif; ?></</p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->withdraw_method_moneygram == 1): ?>
		  <!-- MoneyGram -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/withdraw/moneygram/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4>MoneyGram</h4>
		  <p><?php echo $this->lang->line('fund_withdraw_fess_notice'); ?></br>
		  <?php if (empty($this->site_settings->withdraw_moneygram_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->withdraw_moneygram_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->withdraw_moneygram_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->withdraw_moneygram_flat_fees.''; ?> 
		  <?php endif; ?></</p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->withdraw_method_perfectmoney == 1): ?>
		  <!-- PerfectMoney -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/withdraw/perfectmoney/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4>PerfectMoney</h4>
		  <p><?php echo $this->lang->line('fund_withdraw_fess_notice'); ?></br>
		  <?php if (empty($this->site_settings->withdraw_perfectmoney_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->withdraw_perfectmoney_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->withdraw_perfectmoney_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->withdraw_perfectmoney_flat_fees.''; ?> 
		  <?php endif; ?></</p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->withdraw_method_neteller == 1): ?>
		  <!-- PerfectMoney -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/withdraw/neteller/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4>Neteller</h4>
		  <p><?php echo $this->lang->line('fund_withdraw_fess_notice'); ?></br>
		  <?php if (empty($this->site_settings->withdraw_neteller_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->withdraw_neteller_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->withdraw_neteller_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->withdraw_neteller_flat_fees.''; ?> 
		  <?php endif; ?></</p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->withdraw_method_skrill == 1): ?>
		  <!-- Skrill -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/withdraw/skrill/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4><i class="pf pf-skrill pf-lg" aria-hidden="true"></i></h4>
		  <p><?php echo $this->lang->line('fund_withdraw_fess_notice'); ?></br>
		  <?php if (empty($this->site_settings->withdraw_skrill_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->withdraw_skrill_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->withdraw_skrill_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->withdraw_skrill_flat_fees.''; ?> 
		  <?php endif; ?></</p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->withdraw_method_payza == 1): ?>
		  <!-- Payza -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/withdraw/payza/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4>Payza</h4>
		  <p><?php echo $this->lang->line('fund_withdraw_fess_notice'); ?></br>
		  <?php if (empty($this->site_settings->withdraw_payza_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->withdraw_payza_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->withdraw_payza_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->withdraw_payza_flat_fees.''; ?> 
		  <?php endif; ?></</p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->withdraw_method_payu == 1): ?>
		  <!-- Payu -->
		  <div class="fund-payment-method">
		  <a href="<?php echo site_url().'fund/withdraw/payu/'; ?>">
		  <div class="fund-payment-box-margin">
		  <h4><i class="pf pf-payu pf-lg" aria-hidden="true"></i></h4>
		  <p><?php echo $this->lang->line('fund_withdraw_fess_notice'); ?></br>
		  <?php if (empty($this->site_settings->withdraw_payu_flat_fees)): ?>
		  <?php echo ''.$this->site_settings->withdraw_payu_percentage_fees.'%'; ?>
		  <?php else: ?>
		  <?php echo ''.$this->site_settings->withdraw_payu_percentage_fees.'% 
		  + '.$this->site_settings->curr_symb.''.$this->site_settings->withdraw_payu_flat_fees.''; ?> 
		  <?php endif; ?></</p>
		  </div>
		  </a>
		  </div>
		  <?php endif; ?>
		  
		  
		  