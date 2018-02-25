		 <div id="show-item" class="panel-collapse collapse" role="tabpanel">
		 
		  <!-- Seller name -->
		  <?php if ($this->session->business): ?>
		  <?php if ($user->business_name): ?>
		  <div class="checkout-pay-item-summary">
		<!-- Left -->
		<b>Seller Name:</b> <?php echo $user->business_name; ?>
		
		 </div>
		  <?php else: ?>
		 <div class="checkout-pay-item-summary">
		<!-- Left -->
		<b>Seller Name:</b> <?php echo $user->full_name; ?>
		
		 </div>
		 <?php endif; ?>
		  <?php endif; ?>
		 
		 
		 <!-- Seller Phone -->
		  <?php if ($this->session->business): ?>
		  <div class="checkout-pay-item-summary">
		<!-- Left -->
		<b>Seller Phone:</b> <?php echo $user->mobile; ?>
		
		 </div>
		  <?php endif; ?>
		 
		 
		  <!-- Item name -->
		  <?php if ($this->session->item_name): ?>
		 <div class="checkout-pay-item-summary">
		<!-- Left -->
		<b>Item name:</b> <?php echo $this->session->item_name; ?>
		
		 </div>
		  <?php endif; ?>
		 
		 <!-- Item number -->
		 <?php if ($this->session->item_number): ?>
		  <div class="checkout-pay-item-summary">
		<!-- Left -->
		<b>Item Number:</b> #<?php echo $this->session->item_number; ?>
		
		 </div>
		 <?php endif; ?>
		 
		 <!-- Total amount -->
		 <div class="checkout-pay-item-summary">
		<!-- Left -->
		Total amount
		
		<!-- Right -->
		<div class="checkout-pay-item-summary-amount pull-right">
		<?php echo ''.$this->helper->currency_symbol_select_option($this->session->curr).''.$this->session->amount.' '.$this->session->curr.''; ?>
		</div>
		</div>
		 </div>