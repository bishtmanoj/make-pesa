<!-- Summary one -->
		<!-- Send to -->
		<div class="checkout-pay-summary">
		<!-- Seller name -->
		  <?php if ($this->session->business): ?>
		  <?php if ($user->business_name): ?>
		<!-- Left -->
		<?php echo $user->business_name; ?>
		  <?php else: ?>
		<!-- Left -->
		<?php echo $user->full_name; ?>
		 <?php endif; ?>
		  <?php endif; ?>
		
		
		<!-- Address -->
		<?php if ($user->address1): ?>
		<!-- Left -->
		<p>
		 <?php echo $user->address1.', '.$user->state.', '.$user->city.', '.$user->country.''; ?>
		</p>
		  <?php endif; ?>
		
		</div>
		
		<!-- Summary one -->
		<!-- Pay with -->
		<h5>
		<?php echo $this->lang->line('checkout_pay_head_pay_with'); ?>
		</h5>
		<div class="checkout-pay-summary">
		<i class="fa fa-caret-down" aria-hidden="true"></i>
		
		<!-- Buy balance -->
		<div class="checkout-pay-summary-right pull-right">
		<?php echo ''.$this->helper->currency_symbol_select_option($this->session->curr).''.$this->session->amount.' '.$this->session->curr.''; ?>
		</div>
		</div>
		<!-- End summary -->