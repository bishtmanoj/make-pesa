
	 <!-- Cards section -->
		  <h4><?php echo $this->lang->line('wallet_card_h4'); ?></h4>
		  <hr>
		  <?php foreach($list_card as $card){?>
		  <?php if(!$card->verified == 1): ?>
		   <!-- Not verify card-->
		  <div class="wallet-box-card">
		  <div class="wallet-box-margin">
		  <form role="form" method="post" action="<?php echo site_url('myaccount/wallet/card');?>">
		  <p><?php echo str_pad(substr($card->number, -4), strlen($card->number), 'X', STR_PAD_LEFT);?></p>
		 <div class="col-lg-2">
		  <div class="input-group">
		  <input type="text" class="form-control" name="code" value="" placeholder="####">
		  <input type="hidden" name="id" value="<?php echo $card->id;?>">
		  <span class="input-group-btn">
		  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn btn-primary active" type="submit" name="verify-card"><?php echo $this->lang->line('wallet_card_text_button_verify'); ?></button>
		 </span>
		 </div>
		 </div>
		  </form>
		  </div>
		  </div>
		  <?php else: ?>
		 
		  <!-- verify card-->
		  <div class="wallet-box-card">
		 <?php if(!$card->default_card == 1): ?>
		 <div class="col-xs-6 col-md-6">
		 <!-- form default card -->
		 <form role="form" method="post" action="<?php echo site_url('myaccount/wallet/carddefault');?>">
		 <input type="hidden" name="id" value="<?php echo $card->id;?>">
		  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="wallet-box-button" type="submit" name="default-card"><i class="fa fa-check" aria-hidden="true"></i></button>
		</form>
		</div>
		
		<div class="col-xs-6 col-md-6">
		<!-- form remove card -->
		<form role="form" method="post" action="<?php echo site_url('myaccount/wallet/cardremove');?>">
		 <input type="hidden" name="id" value="<?php echo $card->id;?>">
		  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="wallet-box-button" type="submit" name="remove-card"><i class="fa fa-trash" aria-hidden="true"></i></button>
		</form>
		</div>
		<!-- End form -->
		<?php endif; ?>
		  <div class="wallet-box-margin">
		  <h4><?php echo $this->helper->card_type_icon(''.$card->card_type.'');?></h4>
		  <p><?php echo str_pad(substr($card->number, -4), strlen($card->number), 'X', STR_PAD_LEFT);?></p>
		  </div>
		  </div>
		  <?php endif; ?>
		  <?php }?>
		  
		  
		  <a href="#" data-toggle="modal" data-target="#addcard">
		  <div class="wallet-box">
		  <div class="wallet-box-margin">
		  <h4><i class="fa fa-plus" aria-hidden="true"></i></h4>
		  <?php echo $this->lang->line('wallet_card_text_account'); ?>
		  </div>
		  </div>
		  </a>
		  
		  
		  