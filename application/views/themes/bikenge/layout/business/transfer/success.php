	 <div class="head-padding-top"></div>
	 <div class="container">
	 <div class="row">
	 <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
     
	 <div class="request-payment-well">
	 
	 
		 <div class="request-payment-image-round">
			 <i class="fa fa-check-circle-o fa-green fa-5x" aria-hidden="true"></i>
			   
			   <p>
			   <!-- Payment details -->
			   <?php if ($this->session->type_sent == 'request'):?>
			   <?php echo $this->session->requested_info;?>
			   <?php elseif ($this->session->type_sent == 'sent'):?>
			   <?php echo $this->session->sent_info;?>
			   <?php endif;?>
			   </p>
            </div>
			 </div>
			<!-- Start form -->
			
			<div class="well">
			<div class="anmationBlock">
			<form method="post">
	 <!-- Button form -->
	 <div class="transfer-payment-return-center">
	 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
	 
	<?php if ($this->session->type_sent == 'request'):?>
	<!-- Button for request -->
	<button type="submit" name="payment-another" id="anmationBKPesa_wait" class="transfer-payment-another-button">
	 <?php echo $this->lang->line('transfer_success_another_request');?>
	 </button>
	 
	 <div class="form-group">
	 <button type="submit" name="payment-go-back" class="btn-link transfer-payment-return-button">
	 <?php echo $this->lang->line('transfer_success_go_back');?>
	 </button>
	 </div>
	 
	<?php elseif ($this->session->type_sent == 'sent'):?>
	<!-- Button for sent -->
	<button type="submit" name="payment-another" id="anmationBKPesa_wait" class="transfer-payment-another-button">
	 <?php echo $this->lang->line('transfer_success_another_transfer');?>
	 </button>
	 
	 <div class="form-group">
	 <button type="submit" name="payment-go-back" class="btn-link transfer-payment-return-button">
	 <?php echo $this->lang->line('transfer_success_go_back');?>
	 </button>
	 </div>
	<?php endif;?>
	 
	 </div><!-- block-->
	 </div>
	 <!-- End button -->
	 </form>
	 </div><!-- well -->
	 <div class="padding-page-bottom"></div>
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->