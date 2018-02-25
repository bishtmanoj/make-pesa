<hr>
<div class="container">
<div class="row">
<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
<div class="box-signup-choose">
         <div class="well-header">
               <center>
			   <?php if (empty($userdata->image)): ?>
			   <img src="<?php echo site_url().'assets/images/login.png'; ?>" class="img-thumbnail img-circle img-responsive" height="80px;" width="80px;">
			   <?php else: ?>
			   <img src="<?php echo site_url().$userdata->image; ?>" class="img-thumbnail img-circle img-responsive" height="80px;" width="80px;">
			   <?php endif; ?>
			   </center>
               <h4 class="text-center"><?php echo $this->lang->line('forgot_confirm_form_well_header'); ?><?php echo $userdata->full_name; ?>?</h4><hr>
            </div>
		<!-- Forgot password confirm -->
			<?php
          if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
		  '.validation_errors().'
                </div>';
                  
        }
		
		// Signup failed alert.
      	if ($this->session->forgot_password_code_send_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('forgot_confirm_code_send_failed').'
      			  </div>';
      	}
		
          ?>
		
		<div class="anmationBlock">
		<form method="post" action="<?php echo site_url('myaccount/forgot/resend');?>">
		
		<div class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn-primary btn-block" type="submit" id="anmationBKPesa_wait"><?php echo $this->lang->line('forgot_confirm_form_yes_button'); ?></button>
      </div>
	  </form>
	  <hr class="love">
	  <a class="btn btn-info btn-block" href="<?php echo site_url().'myaccount/forgot'; ?>"><?php echo $this->lang->line('forgot_confirm_form_no_button'); ?></a>
      
	  </div>
	  </div><!-- block-->
	  </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->
