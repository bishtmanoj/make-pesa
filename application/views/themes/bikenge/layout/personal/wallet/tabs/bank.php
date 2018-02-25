		  <!-- Bank section -->
		  <h4><?php echo $this->lang->line('wallet_bank_h4'); ?></h4>
		  <hr>
		  <?php foreach($list_bank as $bank){?>
		  <div class="wallet-box">
		  <div class="col-xs-6 col-md-6">
		<!-- form remove bank -->
		<form role="form" method="post" action="<?php echo site_url('myaccount/wallet/bankremove');?>">
		 <input type="hidden" name="id" value="<?php echo $bank->id;?>">
		  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="wallet-box-button" type="submit" name="remove-bank"><i class="fa fa-trash" aria-hidden="true"></i></button>
		</form>
		</div>
		<!-- End form -->
		  <div class="wallet-box-margin">
		  <h4>
		  <i class="fa fa-university fa-2x" aria-hidden="true"></i>
		  </h4>
		  <?php echo str_pad(substr($bank->acno, -6), strlen($bank->acno), '*', STR_PAD_LEFT);?>
		  </div>
		  </div>
		  <?php }?>
		  
		  
		  
		  
		  <a href="#" data-toggle="modal" data-target="#addbank">
		  <div class="wallet-box">
		  <div class="wallet-box-margin">
		  <h4><i class="fa fa-plus" aria-hidden="true"></i></h4>
		  <?php echo $this->lang->line('wallet_bank_text_account'); ?>
		  </div>
		  </div>
		  </a>
		  
		  
		  