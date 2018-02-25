      <div class="visible-top"></div>

      <div class="container-fluid">
      <div class="row">
      <div class="col-sm-15 col-md-15 col-md-offset-0">
      <div class="home-cover-avatar visible">
	  <!-- Left cover -->
	  <div class="image-cover-avatar">
		<div class="col-md-2 visible">
			<?php if (empty($this->user->image)): ?>
			   <img src="<?php echo site_url().'assets/images/login.png'; ?>" class="img-thumbnail img-circle img-responsive" height="113px;" width="113px;">
			   <?php else: ?>
			   <img src="<?php echo site_url().''.$this->user->image; ?>" class="img-thumbnail img-circle img-responsive" height="113px;" width="113px;">
			   <?php endif; ?>
        
			</div>
    <div class="col-md-4 colmd-2-covar-avatar">
	<h4><?php echo $this->lang->line('summary_right_mostout_avatar_hello'); ?> <?php echo $this->user->full_name; ?>!</h4>
	<button class="colmd-2-covar-avatar-button" data-toggle="collapse" data-target="#mostout" aria-expanded="false" aria-controls="mostout">
	<?php echo $this->lang->line('summary_right_mostout_avatar_button'); ?><?php echo $this->site_settings->site_name;?> <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
	</button>
	</div>

		
		<!-- Right cover -->
		<div class="col-md-4 pull-right visible">
		<a href="<?php echo site_url().'myaccount/transfer/send/'; ?>">
		<div class="colmd-2-right-covar-avatar">
		<i class="fa fa-money fa-2x" aria-hidden="true"></i>
		</div> 
		</a>
              <p class="colmd-2-right-covar-avatar-p"><?php echo $this->lang->line('summary_right_mostout_avatar_pay_goods'); ?></p>
			  
			  
			  
		</div>

		</div>
		</div>
		</div>

	  <!-- Hidden most out panel -->
	  <?php $this->load->view($this->themename.'/layout/personal/summary/tabs/mostout'); ?>
	  <!-- End -->
	  <!-- Verification error show -->
	  <div class="container-fluid">
	  <?php
	  if (!$this->verification_id['status'] == 1 || !$this->verification_address['status'] == 1) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	<i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
					'.$this->lang->line('verification_error_complete').'
					<a href="'.site_url('/myaccount/verification').'">'.$this->lang->line('verification_error_complete_link').'</a>
      			  </div>';
      	}
	  ?>
	  
	  <?php if ($list_card) {?>
	  <?php if (!$this->default_card) {
		  echo '
      		<div class="alert alert-info alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	<i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
					'.$this->lang->line('error_no_default_card').'
					<a href="'.site_url('/myaccount/wallet').'"> Active on wallet</a>
      			  </div>';
      	}?>
		<?php }?>
	  </div>

        <div class="col-sm-4 col-md-4">
		<?php $this->load->view($this->themename.'/layout/personal/summary/sidebar'); ?>
		
        </div><!--/span-->

        <div class="col-sm-8 col-md-8">
		<?php
          if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			<i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
                <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                  '.validation_errors().'
                </div>';
                  
        }
          // Paid with balance faild alert.
      	if ($this->session->balance_payment_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  <i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
      			  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('balance_payment_failed').'
      			  </div>';
      	}

		 // Paid with balance success alert.
      	if ($this->session->balance_payment_complete_sent) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<i class="fa fa-check fa-2x" aria-hidden="true"></i>
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('balance_payment_complete_sent').'
      			  </div>';
      	}
		
		// Payment status error alert.
      	if ($this->session->payment_card_status) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  <i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
      			  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->session->payment_card_status.'
      			  </div>';
      	}
		
		 // Paid with card success alert.
      	if ($this->session->payment_send_card_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<i class="fa fa-check fa-2x" aria-hidden="true"></i>
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('fund_deposit_card_ajax_success').'
      			  </div>';
      	}
		
		// Paid with card failed alert.
      	if ($this->session->payment_send_card_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  <i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
      			  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('payment_send_card_failed').'
      			  </div>';
      	}
		
		
		 ?>
		<!-- Pending Transaction -->
		<?php $this->load->view($this->themename.'/layout/personal/tabs/pending'); ?>
		<!-- End Pending Transaction -->
		
		
          <!-- Completed Transaction -->
		<?php $this->load->view($this->themename.'/layout/personal/tabs/completed'); ?>
		<!-- End Completed Transaction -->
		
		
		  </div><!--/span-->
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.container-->