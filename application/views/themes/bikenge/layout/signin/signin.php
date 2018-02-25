<hr>
<div class="container">
<div class="row">
<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
<div class="box-signin-choose">
         <div class="well-header" id="hide-logo">
               <center>
			   <a href="<?php echo site_url(); ?>">
			   <img src="<?php echo site_url().'assets/images/login.png'; ?>" class="img-thumbnail img-circle img-responsive" height="80px;" width="80px;"></center>
               </a>
			   <h4 class="text-center"><?php echo $this->lang->line('signin_form_well_header'); ?></h4><hr>
            </div>
	 <!-- Form Login-->
		<div class="anmationBlock">
          <div id="respond_alert" class="alert alert-danger alert-dismis" style="display: none;"></div>
		<!-- Loading -->
		<div class="form-group">
          <div id="loading-submit" class="text-center" style="display: none;">
			<i class="fa fa-spinner fa-pulse fa-4x fa-fw fa-blue"></i>
			<span class="sr-only">Please wait...</span>
			</div>
          </div>
		<form id="login-form" method="post">
		<div class="form-group">
		<div class="input-group">
		<span class="input-group-addon" id="text-account"><i class="fa fa-mobile fa-lg" aria-hidden="true"></i></span>
		<input type="text" name="email_username_mobile" class="form-control" value="" placeholder="<?php echo $this->lang->line('signin_form_placeholder_email');?>" aria-describedby="text-account">
		</div>
		</div>
		
		<div class="form-group">
		<div class="input-group">
		<span class="input-group-addon" id="text-password"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
		<input type="password" name="password" class="form-control" value="" placeholder="<?php echo $this->lang->line('signin_form_placeholder_password');?>" aria-describedby="text-password">
		</div>
		</div>
		
		<div class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn-primary btn-block" type="button" onclick="submit_login()" id="hide-submit"><?php echo $this->lang->line('signin_form_submit_button');?></button>
      </div>
	  
	  </form>
	  
	  
		<!-- Success respond -->
		<div id="success-login" style="display: none;">
		<center>
		<i class="fa fa-circle-o-notch fa-spin fa-5x fa-fw fa-blue"></i>
			<span class="sr-only">Please wait...</span>
		<p><?php echo $this->lang->line('signin_form_success_login_redirect'); ?></p>
		</center>
		</div>
	  <!-- Form End -->
	  
	  <!-- Two-factor respond -->
		<form method="post" id="sms-confirm" style="display: none;">
		<div class="form-group">
		<?php echo $this->lang->line('signin_form_sms_sent'); ?>
		</div>
		
		<div class="form-group">
		<div class="input-group">
		<span class="input-group-addon" id="text-password"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
		<input type="text" name="pin" id="pin" class="form-control" value="" placeholder="X-X-X-X">
		</div>
		</div>
		
		<div class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn-primary btn-block" type="button" onclick="submit_sms()" id="hide-submit"><?php echo $this->lang->line('signin_form_submit_button_sms');?></button>
      </div>
	  
	  </form>
	  
	  <div id="success-hide">
	  <a class="resetps" href="<?php echo site_url().'myaccount/forgot'; ?>"><?php echo $this->lang->line('signin_form_forgot_password_link'); ?></a>
	  <!-- Registration link -->
	  <?php if ($this->site_settings->user_register == 1): ?>
	  <hr class="love">
	 <a class="btn btn-info btn-block" href="<?php echo site_url().'signup'; ?>"><?php echo $this->lang->line('signin_form_signup_button'); ?></a>
      <?php endif; ?>
	  </div>
	  </div>
	  
	  
	  <script>
		function submit_login() {
		$("#respond_alert").hide();
		$("#hide-submit").hide();
		$("#login-form").hide();
		$("#loading-submit").show();
		{
		//Data store
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('user/signin_ipn')?>",
            data: $("#login-form").serialize(),
            cache: false,
            success: function(result) {
				
				if (result == 'success') {
				$("#success-login").show();
				$("#success-hide").hide();
				$("#respond_alert").hide();
				$("#hide-logo").hide();
				$("#login-form").hide();
				$("#loading-submit").hide();
				
				setTimeout("window.location='<?php echo site_url();?>'",5000);
				
				}else if (result == 'sms') {
				$("#sms-confirm").show();
				$("#respond_alert").hide();
				$("#login-form").hide();	
				$("#loading-submit").hide();
					
				}else {
				$("#respond_alert").html(result);
				$("#respond_alert").show();
				$("#hide-submit").show();
				$("#login-form").show();
				$("#loading-submit").hide();
				
				}
			}
        });
		}
		return false;
		}
		</script>
		
		<script>
		function submit_sms() {
		$("#respond_alert").hide();
		$("#hide-submit").hide();
		$("#login-form").hide();
		$("#sms-confirm").hide();
		$("#loading-submit").show();
		{
		//Data store
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('user/submit_signin_sms')?>",
            data: $("#sms-confirm").serialize(),
            cache: false,
            success: function(result) {
				
				if (result == 'success') {
				$("#success-login").show();
				$("#success-hide").hide();
				$("#hide-logo").hide();
				$("#sms-confirm").hide();
				$("#respond_alert").hide();
				$("#login-form").hide();
				$("#loading-submit").hide();
				
				setTimeout("window.location='<?php echo site_url();?>'",5000);
				
				}else {
				$("#respond_alert").html(result);
				$("#respond_alert").show();
				$("#sms-confirm").show();
				$("#login-form").hide();	
				$("#loading-submit").hide();
				
				}
			}
        });
		}
		return false;
		}
		</script>
		<!-- End Form -->
		
	  </div><!-- block-->
	  </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->

