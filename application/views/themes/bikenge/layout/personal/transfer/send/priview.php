	 <div class="head-padding-top"></div>
	 <div class="container">
	 <div class="row">
	 <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
     
	 <div class="send-payment-well">
	 
	 <?php
          if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
		  '.validation_errors().'
                </div>';
                  
        }
		 ?>
		 
		 <div class="send-payment-image-round">
			   <?php if (empty($recepient->image)): ?>
			   <img src="<?php echo site_url().'assets/images/login.png'; ?>" class="img-thumbnail img-circle img-responsive" height="80px;" width="80px;">
			   <?php else: ?>
			   <img src="<?php echo site_url().''.$recepient->image; ?>" class="img-thumbnail img-circle img-responsive" height="80px;" width="80px;">
			   <?php endif; ?>
			   
			   <p><?php echo $this->lang->line('transfer_send_form_sennding_to');?> <?php echo $recepient->email; ?></p>
            </div>
		<!-- Start form -->
		<div class="anmationBlock">
		 <form method="post">
			<div class="form-group">
		<div class="row">
		<div class="col-xs-6 col-md-6">
		<label for="Send amount"><?php echo $this->lang->line('transfer_send_form_your_sennding');?> </label>
		<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
		<input type="text" name="amount" id="sender_amount" class="form-control sendMoney" value="" placeholder="<?php echo $this->user->curr_symb.'0.00';?>">
		
		<select class="form-control">
		<option><?php echo $this->user->curr_word;?></option>
		</select>
		</div>
		</div>
		<input type="hidden" name="next_email" value="<?php echo $this->session->payer_id; ?>">
		<div class="col-xs-6 col-md-6">
		<label for="Receiver amount"><?php echo $this->lang->line('transfer_send_form_recepient_receive');?></label>
		<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-exchange fa-lg" aria-hidden="true"></i></span>
		<input type="text" id="receiver_amount" class="form-control sendMoney" placeholder="<?php echo $this->user->curr_symb.'0.00';?>" 
		data-a-sign="<?php echo $this->user->curr_symb;?>" data-a-dec="," data-a-sep="." disabled>
		
		<select class="form-control"  disabled>
		<option><?php echo $this->user->curr_word;?></option>
		</select>
		</div>
		</div>
		</div>
		</div>
		
	 </div><!-- block-->
	  <!-- Form End -->
	  <!-- Currency conversion -->
	  <div class="send-payment-currency">
			  
			   <h5><?php echo $this->lang->line('transfer_send_form_exchange_rate_note');?></h5>
			   <p><?php echo $this->lang->line('transfer_send_form_exchange_rate_down');?></p>
            </div>
			<hr>
			<div class="form-group">
		<textarea name="note" placeholder="<?php echo $this->lang->line('transfer_send_form_placeholder_textarea');?>" class="form-control"></textarea>
		</div>
			<hr>
	 </div>
	 
	 <!-- Paid choose -->
	 <div class="send-payment-well">
	 <div class="send-payment-well-card">
	 <i class="fa fa-money fa-2x" aria-hidden="true"></i>
	 <i class="fa fa-cc-visa fa-2x" aria-hidden="true"></i>
	 <i class="fa fa-cc-mastercard fa-2x" aria-hidden="true"></i>
	 <i class="fa fa-cc-discover fa-2x" aria-hidden="true"></i>
	 <i class="fa fa-cc-amex fa-2x" aria-hidden="true"></i>
	 </div>
	 <p><?php echo $this->lang->line('transfer_send_form_transfer_process');?></p>
	 </div>
	 <!-- End paid choose -->
	 
	 <!-- Send payment button -->
	 <div class="send-payment-end-button">
	 <p><?php echo $this->lang->line('transfer_send_form_for_more_info');?> 
	 <a href=""><?php echo $this->lang->line('transfer_send_form_for_more_info_link');?></a>
	 </p>
	 
	 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	 <button type="submit" name="payment-send" id="anmationBKPesa_wait" class="send-payment-button">
	 <?php echo $this->lang->line('transfer_send_form_button_send');?>
	 </button>
	 
	 <div class="cancel-payment-button">
	 <a href="<?php echo site_url().'myaccount/transfer/send/cancel'; ?>" class="cancel-payment-button">
	 <?php echo $this->lang->line('transfer_send_form_button_cancel');?>
	 </a>
	 </div>
	 </div>
	 <!-- End button -->
	 </form>
	 <div class="padding-page-bottom"></div>
	 </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->