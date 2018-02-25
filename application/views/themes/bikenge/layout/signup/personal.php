<hr>
<div class="container">
<div class="row">
<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
<div class="box-signup-choose">
         <div class="well-header">
               <center><img src="<?php echo site_url().'assets/images/login.png'; ?>" class="img-thumbnail img-circle img-responsive" height="80px;" width="80px;"></center>
               <h4 class="text-center"><?php echo $this->lang->line('signup_personal_account_h2_desc');?></h4>
			   <hr>
            </div>
<!-- Form personal signup-->
<?php
if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
		  '.validation_errors().'
                </div>';
                  
        }
		
		// Personal Account signup failed alert.
      	if ($this->session->personal_account_signup_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('signup_personal_form_signup_failed').'
      			  </div>';
      	}
		
?>
        <div class="anmationBlock">
		<form method="post">
		<div class="form-group">
		<select name="country" class="form-control">
			<option><?php echo $this->lang->line('signup_personal_form_placeholder_country');?></option>
			<?php echo $this->helper->country_select_option();?>
		</select>
		</div>
	  
	  <div class="form-group">
		<input type="email" name="email" class="form-control" value="" placeholder="<?php echo $this->lang->line('signup_personal_form_placeholder_email');?>">
		</div>
		
		<div class="form-group">
		<input type="text" name="first_name" class="form-control" value="" placeholder="<?php echo $this->lang->line('signup_personal_form_placeholder_first_name');?>">
		</div>
		
		<div class="form-group">
		<input type="text" name="last_name" class="form-control" value="" placeholder="<?php echo $this->lang->line('signup_personal_form_placeholder_last_name');?>">
		</div>
		
		
		<div class="form-group">
		<input type="tel" name="mobile" id="mobile" class="form-control" value="" placeholder="<?php echo $this->lang->line('signup_personal_form_placeholder_mobile');?>">
		</div>
		
		<div class="form-group">
		<input type="password" name="password" class="form-control" value="" placeholder="<?php echo $this->lang->line('signup_personal_form_placeholder_password');?>">
		</div>
		
		<div class="form-group">
		<input type="password" name="confim_password" class="form-control" value="" placeholder="<?php echo $this->lang->line('signup_personal_form_placeholder_confim_password');?>">
		</div>
		
		<div class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn-primary btn-block" type="submit" id="anmationBKPesa_wait"><?php echo $this->lang->line('signup_personal_form_submit_button');?></button>
      </div>
	  </form>
	  <!-- Form End -->
	 
      </div>
	  </div><!-- block-->
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->
