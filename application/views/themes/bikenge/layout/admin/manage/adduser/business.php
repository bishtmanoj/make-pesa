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
			<div class="well-header">
               <h4 class="text-center"><?php echo $this->lang->line('admin_adduser_business_h2_desc');?></h4>
			   
		<?php
          if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
		  '.validation_errors().'
                </div>';
                  
        }
		
		// Admin User account business add failed alert.
      	if ($this->session->business_add_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('business_add_failed').'
      			  </div>';
      	}
		
		// Admin User account business add success alert.
      	if ($this->session->business_add_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('business_add_success').'
      			  </div>';
      	}
		
          ?>
		  
       	<div class="anmationBlock">
		<form method="post">
		<div class="form-group">
		<input type="email" name="email" class="form-control" value="<?php echo $this->session->start_email; ?>" placeholder="<?php echo $this->lang->line('admin_adduser_business_form_placeholder_email');?>">
		</div>
		
		<div class="form-group">
		<div class="row">
		<div class="col-xs-6 col-md-6">
		<input type="password" name="password" class="form-control" value="" placeholder="<?php echo $this->lang->line('admin_adduser_business_form_placeholder_password');?>">
		</div>
		
		<div class="col-xs-6 col-md-6">
		<input type="password" name="confim_password" class="form-control" value="" placeholder="<?php echo $this->lang->line('admin_adduser_business_form_placeholder_confim_password');?>">
		</div>
		</div>
		</div>
		
		<div class="form-group">
		<input type="text" name="first_name" class="form-control" value="" placeholder="<?php echo $this->lang->line('admin_adduser_business_form_placeholder_first_name');?>">
		</div>
		
		<div class="form-group">
		<input type="text" name="last_name" class="form-control" value="" placeholder="<?php echo $this->lang->line('admin_adduser_business_form_placeholder_last_name');?>">
		</div>
		
		<div class="form-group">
		<input type="text" name="business_name" class="form-control" value="" placeholder="<?php echo $this->lang->line('admin_adduser_business_form_placeholder_business_name');?>">
		</div>
		
		<div class="form-group">
		<input type="tel" name="mobile" id="mobile" class="form-control" value="" placeholder="<?php echo $this->lang->line('admin_adduser_business_form_placeholder_mobile');?>">
		</div>
		
		<div class="form-group">
		<input type="text" name="address1" class="form-control" value="" placeholder="<?php echo $this->lang->line('admin_adduser_business_form_placeholder_address1');?>">
		</div>
		
		<div class="form-group">
		<input type="text" name="address2" class="form-control" value="" placeholder="<?php echo $this->lang->line('admin_adduser_business_form_placeholder_address2');?>">
		</div>
		
		<div class="form-group">
		<select name="country" class="form-control">
			<option><?php echo $this->lang->line('admin_adduser_personal_form_placeholder_country');?></option>
			<?php echo $this->helper->country_select_option();?>
		</select>
		</div>
		
		<div class="form-group">
		<input type="text" name="city" class="form-control" value="" placeholder="<?php echo $this->lang->line('admin_adduser_business_form_placeholder_city');?>">
		</div>
		
		<div class="form-group">
		<input type="text" name="state" class="form-control" value="" placeholder="<?php echo $this->lang->line('admin_adduser_business_form_placeholder_state');?>">
		</div>
		
		<div class="form-group">
		<input type="text" name="postal_code" class="form-control" value="" placeholder="<?php echo $this->lang->line('admin_adduser_business_form_placeholder_postal_code');?>">
		</div>
		
		
	  
		<div class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn-primary btn-block" type="submit" id="anmationBKPesa_wait"><?php echo $this->lang->line('admin_adduser_business_form_submit_button');?></button>
      </div>
	  
	  </form>
	  <!-- Form End -->
	 </div>
	</div>
			
	 </div>
	 </div>
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->
