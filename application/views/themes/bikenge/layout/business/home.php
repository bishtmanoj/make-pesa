      <div class="visible-top"></div>

      <div class="container-fluid">
      <div class="row">
      <div class="col-sm-15 col-md-15 col-md-offset-0">
      

	  <!-- Most out panel -->
	  <?php $this->load->view($this->themename.'/layout/business/summary/tabs/most-cover'); ?>
	  <!-- End -->
	  
	  
	  <div class="container-fluid">
	  <!-- Verification error show -->
	  <?php
	  if (!$this->verification_id['status'] == 1 || !$this->verification_address['status'] == 1 || !$this->verification_bvn['status'] == 1) {
      		echo '<div class="alert alert-warning alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	<i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
					'.$this->lang->line('verification_error_complete').'
					<a href="'.site_url('/business/verification').'">'.$this->lang->line('verification_error_complete_link').'</a>
      			  </div>';
      	}
	  ?>
	  
	  <?php if ($list_card) {?>
	  <?php if (!$this->default_card) {
		  echo '
      		<div class="alert alert-info alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	<i class="fa fa-credit-card-alt fa-2x fa-spin" aria-hidden="true"></i>
					'.$this->lang->line('error_no_default_card').'
					<a href="'.site_url('/business/wallet').'"> Active on wallet</a>
      			  </div>';
      	}?>
		<?php }?>
	  </div>

        <div class="col-sm-4 col-md-4">
		<?php $this->load->view($this->themename.'/layout/business/summary/sidebar'); ?>
		
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
      				  '.$this->lang->line('payment_send_card_success').'
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
		<?php $this->load->view($this->themename.'/layout/business/tabs/pending'); ?>
		<!-- End Pending Transaction -->
		
		
          <!-- Completed Transaction -->
		<?php $this->load->view($this->themename.'/layout/business/tabs/completed'); ?>
		<!-- End Completed Transaction -->
		
		
		  </div><!--/span-->
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.container-->