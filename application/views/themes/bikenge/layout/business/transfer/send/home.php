	 <div class="head-padding-top"></div>
	 <div class="container">
	 <div class="row">
	 <div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
     <div class="send-well">
	 <h4><?php echo $this->lang->line('transfer_send_h4');?></h4>
	 
	 <p> <?php echo $this->lang->line('transfer_send_p');?> 
	 <a href="#"><?php echo $this->lang->line('transfer_send_p_link');?> </a>
	 <?php
          if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
		  '.validation_errors().'
                </div>';
                  
        }
		
		// Receipt failed alert.
      	if ($this->session->receipt_not_get_payment) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('receipt_not_get_payment').'
      			  </div>';
      	}		
          ?>
	 <!-- Form email -->
	 <form method="post" id="nex-payment-send">			
			<div class="form-group">
		<div class="row">
		<div class="col-xs-7 col-md-9">
		<input type="text" name="next_email" class="form-control send-next-input" id="receive_email" value="" placeholder="<?php echo $this->lang->line('transfer_form_email_placeholder');?> ">
		</div>
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		<div class="col-xs-2">
		<button class="send-next-button" type="submit"><?php echo $this->lang->line('transfer_form_next_button');?></button>
		</div>
		</div>
		</div>
			</form>
			
	  <!-- Form End -->
	 </div>
	 <div class="padding-page-bottom"></div>
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->