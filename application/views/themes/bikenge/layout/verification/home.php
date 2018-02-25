      <div class="head-padding-top"></div>

      <div class="container-fluid">
      <div class="row">
      <div class="col-sm-15 col-md-15 col-md-offset-0">

        <div class="col-sm-4 col-md-4">
		<?php $this->load->view($this->themename.'/layout/verification/sidebar'); ?>
		
        </div><!--/span-->

        <div class="col-sm-8 col-md-8">
          <div class="well">
		<?php
		 // Verification File type failed alert.
      	if ($this->session->verification_error_file_type) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('verification_error_file_type').'
      			  </div>';
      	}
		
		// Verification submit failed alert.
		if ($this->session->verification_submit_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('verification_submit_failed').'
      			  </div>';
      	}

		 // Verification submit success alert.
      	if ($this->session->verification_submit_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('verification_submit_success').'
      			  </div>';
      	}
  	    ?>
		<?php $this->load->view($this->themename.'/layout/verification/tabs/document'); ?>  
		<?php $this->load->view($this->themename.'/layout/verification/tabs/modal_idcard'); ?>
		<?php $this->load->view($this->themename.'/layout/verification/tabs/modal_address'); ?>
	 
		  </div><!--/span-->
        </div><!--/span-->
      </div><!--/row-->
	  </div>

    </div><!--/.container-->