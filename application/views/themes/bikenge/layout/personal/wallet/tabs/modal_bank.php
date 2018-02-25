 <!-- Add Bank -->
  <div class="modal face modal-fullscreen  footer-to-bottom" id="addbank" role="dialog">
    <div class="modal-dialog">
    
      <!-- Bank content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add your <?php echo $this->user->country;?> bank account</h4>
        </div>
        <div class="modal-body">
		  
		  <!-- Form of payment -->
		  <form role="form" method="post" action="<?php echo site_url('myaccount/wallet/bank');?>">
		  
		  <div class="form-group">
		<p><?php echo $this->lang->line('wallet_add_bank_form_note'); ?></p>
		</div>
		
		  <div class="form-group">
			<div class="row">
			<div class="col-xs-6 col-md-6">
			<input type="text" class="form-control" name="acname" placeholder="<?php echo $this->lang->line('wallet_add_bank_form_placeholder_account_name'); ?>" value="">
			</div>
		
			<div class="col-xs-6 col-md-6">
			<input type="text" class="form-control" name="acno" placeholder="<?php echo $this->lang->line('wallet_add_bank_form_placeholder_account_number'); ?>" value="">
			</div>
			</div>
			</div>	
		  <div class="form-group">
            <input type="text" class="form-control" name="swift" placeholder="<?php echo $this->lang->line('wallet_add_bank_form_placeholder_swift'); ?>" value="">
          </div>
		  
		  <div class="form-group">
		  <div class="row">
			<div class="col-xs-6 col-md-6">
			<input type="text" class="form-control" name="bankname" placeholder="<?php echo $this->lang->line('wallet_add_bank_form_placeholder_bank_name'); ?>" value="">
			</div>
		
			<div class="col-xs-6 col-md-6">
			<input type="text" class="form-control" name="branchname" placeholder="<?php echo $this->lang->line('wallet_add_bank_form_placeholder_bank_branch'); ?>" value="">
			</div>
			</div>
			</div>	
          <div class="form-group">
            <input type="text" class="form-control" name="" value="<?php echo $this->user->country;?>" disabled>
			<input type="hidden" class="form-control" name="country" value="<?php echo $this->user->country;?>">
          </div>
		  <div class="form-group">
            <input type="text" class="form-control" id="city" name="city" placeholder="<?php echo $this->lang->line('wallet_add_bank_form_placeholder_bank_city'); ?>" value="">
          </div>
		  
          <div class="form-group ">
		   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
           <button type="submit" class="modal-save-button-big"><?php echo $this->lang->line('wallet_add_bank_form_submit_button'); ?></button>
          </div>
        </form>

		  <!-- End Form -->
        </div>
      </div>
      
    </div>
			</div>
			<!-- End Add Bank -->