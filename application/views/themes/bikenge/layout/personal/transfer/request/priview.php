	 <div class="head-padding-top"></div>
	 <div class="container">
	 <div class="row">
	 <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
     
	 <div class="request-payment-well">
	 
	 
		 <div class="request-payment-image-round">
			 <img src="<?php echo site_url().'assets/images/login.png'; ?>" class="img-thumbnail img-circle img-responsive" height="80px;" width="80px;">
			   
			   
			   <p><?php echo $this->lang->line('transfer_request_notice');?> </p>
            </div>
			<!-- Validate form -->
			<?php
          if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
		  '.validation_errors().'
                </div>';
                  
        }
		
		// Payment request failed alert.
      	if ($this->session->payment_request_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('payment_request_failed').'
      			  </div>';
      	}
		 ?>
		 <!-- End Validate -->
		 
		<!-- Start form -->
		<div class="anmationBlock">
		<form method="post">
		<div class="form-group">
		<div class="row">
		<div class="col-xs-6 col-md-6">
		<label for="Send amount"><?php echo $this->lang->line('transfer_request_payment_form_send_amount');?> </label>
		<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-money fa-lg" aria-hidden="true"></i></span>
		<input type="text" name="amount" id="receiver_amount" class="form-control sendMoney" value="" placeholder="<?php echo $this->user->curr_symb.'0.00';?>">
		
		<select class="form-control">
		<option><?php echo $this->user->curr_word;?></option>
		</select>
		</div>
		</div>
		<div class="col-xs-6 col-md-6">
		<label for="Receiver amount"><?php echo $this->lang->line('transfer_request_payment_form_receiver_request');?></label>
		<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></span>
		<input type="text" name="receipt" class="form-control" placeholder="<?php echo $this->lang->line('transfer_request_payment_form_placeholder_receiver_request');?>">
		
		<select class="form-control"  disabled>
		<option><?php echo $this->user->curr_word;?></option>
		</select>
		</div>
		</div>
		</div>
		</div>
		
	  <!-- Form End -->
	  
	 </div><!-- block-->
	  <!-- Currency conversion -->
			<hr>
			<div class="form-group">
		<textarea name="note" placeholder="<?php echo $this->lang->line('transfer_request_payment_form_placeholder_add_note');?>" class="form-control"></textarea>
		</div>
			<hr>
	 </div>
	 
	 
	 <!-- Request payment button -->
	 <div class="request-payment-end-button">
	 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	 <button type="submit" name="payment-request" id="anmationBKPesa_wait" class="request-payment-button">
	 <?php echo $this->lang->line('transfer_request_payment_form_button_request');?>
	 </button>
	 
	 <div class="cancel-payment-button">
	 <a href="<?php echo site_url().'myaccount/transfer/send/cancel'; ?>" class="cancel-payment-button">
	 <?php echo $this->lang->line('transfer_request_payment_form_button_request_cancel');?>
	 </a>
	 </div>
	 </div>
	 <!-- End button -->
	 </form>
	 
	 <div class="padding-page-bottom"></div>
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->