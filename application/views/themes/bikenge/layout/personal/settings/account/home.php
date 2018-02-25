      <div class="container-fluid">
      <div class="row">
      <div class="col-sm-15 col-md-15 col-md-offset-0">
		<!-- nav -->
		<?php $this->load->view($this->themename.'/layout/personal/settings/nav/nav-settings'); ?>
		
		<!-- Validate -->
		<?php

        if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                  '.validation_errors().'
                </div>';
                  
        }
		// Update failed alert.
      	if ($this->session->account_update_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('account_update_failed').'
      			  </div>';
      	}

		 // Update success alert.
      	if ($this->session->account_update_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('account_update_success').'
      			  </div>';
      	}
		
		// Update value failed alert.
      	if ($this->session->account_update_form_empty_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('account_update_form_empty_failed').'
      			  </div>';
      	}
		
		// Update value failed alert.
      	if ($this->session->account_update_validate_form_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->session->account_update_validate_form_failed.'
      			  </div>';
      	}
		
  	    ?>
		
		<!-- End nav -->
		<!-- Tabs left -->
        <div class="col-sm-6 col-md-6">
		<!-- Profile info -->
		<?php $this->load->view($this->themename.'/layout/personal/settings/account/tabs/profile_info'); ?>
		<!-- End profile info -->
		
		<!-- Account options -->
		<?php $this->load->view($this->themename.'/layout/personal/settings/account/tabs/account_options'); ?>
		<!-- End account options -->
		
        </div><!--/span-->

        <div class="col-sm-6 col-md-6">
		<!-- Tabs right -->
		
		<?php if ($this->user->address1) {?>
		<!-- Address -->
		<?php $this->load->view($this->themename.'/layout/personal/settings/account/tabs/address'); ?>
		<!-- End address -->
		<?php }?>
		
		<!-- Email -->
		<?php $this->load->view($this->themename.'/layout/personal/settings/account/tabs/email'); ?>
		<!-- End email -->
		
		<!-- phone -->
		<?php $this->load->view($this->themename.'/layout/personal/settings/account/tabs/phone'); ?>
		<!-- End phone -->
		
		<!-- End tabs right -->
		
		<!-- Modal form -->
	<?php $this->load->view($this->themename.'/layout/personal/settings/account/tabs/modal/modal_profile'); ?>
	<?php $this->load->view($this->themename.'/layout/personal/settings/account/tabs/modal/modal_profile_image'); ?>
	<?php $this->load->view($this->themename.'/layout/personal/settings/account/tabs/modal/modal_profile_idcard'); ?>
	<?php $this->load->view($this->themename.'/layout/personal/settings/account/tabs/modal/modal_profile_address'); ?>
	
		  </div><!--/span-->
        </div><!--/span-->
      </div><!--/row-->
    </div><!--/.container-->
	