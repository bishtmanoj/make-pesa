<div class="head-padding-top"></div>
	 <div class="container">
	 <div class="row">
	 <div class="col-sm-13 col-sm-offset-2 col-md-13 col-md-offset-0">
	 <div class="row">

        <div class="col-sm-4 col-md-4">
		 <?php $this->load->view($this->themename.'/layout/admin/globe/sidebar/nav'); ?>
            </div>
			
			
	<div class="col-sm-8 col-md-8">
	<div class="well">
	<div class="text-center">
	<i class="fa fa-shield fa-2x" aria-hidden="true"></i>
	</div>
			<div class="well-header">
               <h5 class="text-center"><?php echo $this->lang->line('admin_settings_secure_method_h5_well');?></h5>
			   
			<!-- Form personal signup-->
        <?php
        if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
		  '.validation_errors().'
                </div>';
                  
        }
		
		// Admin change failed alert.
      	if ($this->session->admin_setting_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('admin_setting_failed').'
      			  </div>';
      	}
		
		// Admin change success alert.
      	if ($this->session->admin_setting_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('admin_setting_success').'
      			  </div>';
      	}
		
      	?>
		<p>
		<?php echo $this->lang->line('admin_settings_secure_method_p_note');?>
		</p>
		<hr>
        <div class="anmationBlock">
		<form method="post">
		<!-- METHOD -->
		<div class="form-group">
		<div class="row">
		<b>
		<div class="col-xs-3 col-md-3">
		<?php echo $this->lang->line('admin_payment_method_method');?>
		</div>
		<div class="col-xs-4 col-md-4">
		</div>
		
		<div class="col-xs-5 col-md-5">
		<?php echo $this->lang->line('admin_payment_method_flat_fees');?>
		</div>
		
		</b>
		</div>
		</div>
		<!-- End METHOD -->
		
		<!-- CARD -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-3 col-md-3">
		<i class="fa fa-sign-in fa-lg" aria-hidden="true"></i> SIGNIN
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-5 col-md-5">
		<label class="checkbox">
		<input type="checkbox" name="two_factor_login" value="1" <?php echo (set_checkbox('two_factor_login', '1')) ? set_checkbox('two_factor_login', '1') : (($this->site_settings->two_factor_login == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		
		</div>
		</div>
		
		<!-- End CARD -->
		
		
		
		<div class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn-primary btn-block" type="submit" id="anmationBKPesa_wait"><?php echo $this->lang->line('admin_settings_secure_form_submit_button');?></button>
      </div>
	  </form>
	  </div>
	  <!-- Form End -->
	 
			</div>
			</div><!-- span-->
	 
	 </div><!-- span-->
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->