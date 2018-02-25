      <div class="container-fluid">
      <div class="row">
      <div class="col-sm-15 col-md-15 col-md-offset-0">
		<!-- nav -->
		<?php $this->load->view($this->themename.'/layout/business/settings/nav/nav-settings'); ?>
		
		<!-- Validate -->
		<?php

        if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                  '.validation_errors().'
                </div>';
                  
        }
		// Update failed alert.
      	if ($this->session->security_update_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('security_update_failed').'
      			  </div>';
      	}

		 // Update success alert.
      	if ($this->session->security_update_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('security_update_success').'
      			  </div>';
      	}
		
		// Update value failed alert.
      	if ($this->session->security_update_form_empty_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('security_update_form_empty_failed').'
      			  </div>';
      	}
		
		// Update value failed alert.
      	if ($this->session->security_update_validate_form_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->session->security_update_validate_form_failed.'
      			  </div>';
      	}
		
  	    ?>
		
		<!-- End nav -->
        <div class="col-sm-12 col-md-12">
		
		<!-- Security tabs -->
		<div class="well">
		
		<!-- Password -->
		<?php $this->load->view($this->themename.'/layout/business/settings/security/tabs/password'); ?>
		<!-- End password -->
		
		<!-- PIN -->
		<?php $this->load->view($this->themename.'/layout/business/settings/security/tabs/pin'); ?>
		<!-- End PIN -->
		
		</div>
		
		<!-- End security tabs -->
		
		<!-- Modal form -->
		 <?php $this->load->view($this->themename.'/layout/business/settings/security/tabs/modal/modal_security_password'); ?>
		 <?php $this->load->view($this->themename.'/layout/business/settings/security/tabs/modal/modal_security_pin'); ?>
       
	
	
		  </div><!--/span-->
		  </div><!--/span-->
      </div><!--/row-->
    </div><!--/.container-->
	