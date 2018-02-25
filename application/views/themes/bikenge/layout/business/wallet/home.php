      <div class="head-padding-top"></div>

      <div class="container-fluid">
      <div class="row">
      <div class="col-sm-15 col-md-15 col-md-offset-0">

        <div class="col-sm-4 col-md-4">
		<?php $this->load->view($this->themename.'/layout/business/wallet/sidebar'); ?>
		
        </div><!--/span-->

        <div class="col-sm-8 col-md-8">
          <div class="well">
		<!-- Wallet form add bank, card and verify card -->
		<?php

        if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                  '.validation_errors().'
                </div>';
                  
        }

		 // Bank Account failed alert.
      	if ($this->session->wallet_add_bank_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('wallet_add_bank_failed').'
      			  </div>';
      	}

		 // Bank Account success alert.
      	if ($this->session->wallet_add_bank_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('wallet_add_bank_success').'
      			  </div>';
      	}
		
		// Verify card code failed alert.
      	if ($this->session->wallet_verify_card_code_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('wallet_verify_card_code_failed').'
      			  </div>';
      	}

		 // Verify card code success alert.
      	if ($this->session->wallet_verify_card_code_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('wallet_verify_card_code_success').'
      			  </div>';
      	}
		
		// Payment status error alert.
      	if ($this->session->payment_card_status) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->session->payment_card_status.'
      			  </div>';
      	}
		
		// Local card add failed alert.
      	if ($this->session->wallet_local_card_add_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('wallet_local_card_add_failed').'
      			  </div>';
      	}

		 // Local card add success alert.
      	if ($this->session->wallet_local_card_add_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('wallet_local_card_add_success').'
      			  </div>';
      	}
		
		// Local bank add success alert.
      	if ($this->session->wallet_add_local_bank_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('wallet_add_local_bank_success').'
      			  </div>';
      	}
		
		// Card add failed alert.
      	if ($this->session->wallet_card_add_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('wallet_card_add_failed').'
      			  </div>';
      	}

		 // Card add success alert.
      	if ($this->session->wallet_card_add_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('wallet_card_add_success').'
      			  </div>';
      	}
		
		// Card default add failed alert.
      	if ($this->session->wallet_add_deafult_card_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('wallet_add_deafult_card_failed').'
      			  </div>';
      	}

		 // Card default add success alert.
      	if ($this->session->wallet_add_deafult_card_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('wallet_add_deafult_card_success').'
      			  </div>';
      	}
		
		// Card remove failed alert.
      	if ($this->session->wallet_remove_card_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('wallet_remove_card_failed').'
      			  </div>';
      	}

		 // Card remove success alert.
      	if ($this->session->wallet_remove_card_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('wallet_remove_card_success').'
      			  </div>';
      	}
		
		// Bank remove failed alert.
      	if ($this->session->wallet_remove_bank_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('wallet_remove_bank_failed').'
      			  </div>';
      	}

		 // Bank remove success alert.
      	if ($this->session->wallet_remove_bank_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('wallet_remove_bank_success').'
      			  </div>';
      	}
		
  	    ?>
		<?php $this->load->view($this->themename.'/layout/business/wallet/tabs/bank'); ?>  
		<?php $this->load->view($this->themename.'/layout/business/wallet/tabs/cards'); ?>
		<?php $this->load->view($this->themename.'/layout/business/wallet/tabs/modal_bank'); ?>
		<?php $this->load->view($this->themename.'/layout/business/wallet/tabs/modal_card'); ?>
	 
		  </div><!--/span-->
        </div><!--/span-->
      </div><!--/row-->
	  </div>

    </div><!--/.container-->