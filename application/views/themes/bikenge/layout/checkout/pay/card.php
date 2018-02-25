		 <div id="show-cards" class="panel-collapse collapse" role="tabpanel">
		 <?php foreach($list_card as $card){?>
		 <div class="fund-payment-block">
		 <div class="fund-payment-select">
		  <div class="fund-payment-select-primary">
            <input type="radio" name="pay_with" id="card-<?php echo $card->id;?>" value="<?php echo $card->id;?>">
            <label for="card-<?php echo $card->id;?>">
		  <?php echo $this->helper->card_type_icon(''.$card->card_type.'');?>		
		  <p>
		  <?php echo substr_replace($card->number, str_repeat('X', 5), 4, 5);?>
		  <p>
		  </label>
		  </div>
		  </div>
		  </div>
		  <?php }?>
		  <?php if(empty($card->id)): ?>
			<!-- No Cards -->
			<p class="text-center">
			<?php echo $this->lang->line('checkout_pay_no_card'); ?>
			</p>
			
			<div class="form-group">
			<a class="btn btn-info btn-block" href="<?php echo site_url().'checkout/card'; ?>">
			<?php echo $this->lang->line('checkout_pay_no_card_pay_card'); ?>
			</a>
			</div>
			<?php endif; ?>
		  </div>