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
               <h4 class="text-center">
			   <i class="fa fa-bell-o" aria-hidden="true"></i>
			   <?php echo $this->lang->line('admin_notification_account_h2_desc');?></h4>
			   <hr>
			<!-- Form personal signup-->
        <?php
        if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
		  '.validation_errors().'
                </div>';
                  
        }
		
		// Admin settings failed alert.
      	if ($this->session->admin_setting_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('admin_setting_failed').'
      			  </div>';
      	}
		
		// Admin settings success alert.
      	if ($this->session->admin_setting_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('admin_setting_success').'
      			  </div>';
      	}
		
      	?>
		
		
        <form method="post">
		<div class="form-group">
		<!-- Infobip -->
		<h5><?php echo $this->lang->line('admin_notification_form_sms_provider_label');?> 
		(<a href="https://infobip.com" target="_blank">Infobip</a>)</h5>
		</div>
		
		<div class="form-group">
		<input type="text" name="infobip_auth" class="form-control" value="<?php echo $this->site_settings->infobip_auth; ?>" placeholder="<?php echo $this->lang->line('admin_notification_form_placeholder_infobip_auth');?>">
		</div>
		
		<div class="form-group">
		<input type="text" name="infobip_brand_name" class="form-control" value="<?php echo $this->site_settings->infobip_brand_name; ?>" placeholder="<?php echo $this->lang->line('admin_notification_form_placeholder_infobip_brand_name');?>">
		</div>
		
		<hr>
		
		<!-- Twilio -->
		<h5><?php echo $this->lang->line('admin_notification_form_sms_provider_label');?> 
		(<a href="https://twilio.com/console" target="_blank">Twilio</a>)</h5>
		</div>
		
		<div class="form-group">
		<input type="text" name="twilio_number" class="form-control" value="<?php echo $this->site_settings->twilio_number; ?>" placeholder="<?php echo $this->lang->line('admin_notification_form_placeholder_twilio_number');?>">
		</div>
	  
	  <div class="form-group">
		<input type="text" name="twilio_sid" class="form-control" value="<?php echo $this->site_settings->twilio_sid; ?>" placeholder="<?php echo $this->lang->line('admin_notification_form_placeholder_twilio_sid');?>">
		</div>
		
		<div class="form-group">
		<input type="text" name="twilio_token" class="form-control" value="<?php echo $this->site_settings->twilio_token; ?>" placeholder="<?php echo $this->lang->line('admin_notification_form_placeholder_twilio_token');?>">
		</div>
		
		<div class="form-group">
		<input type="email" name="email_notification_email" class="form-control" value="<?php echo $this->site_settings->email_notification_email; ?>" placeholder="<?php echo $this->lang->line('admin_notification_form_placeholder_email_address');?>">
		</div>
		
		<hr>
		
		<!-- Notification Enable/Disable -->
		<!-- SMS -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-4 col-md-4">
		<b><?php echo $this->lang->line('admin_notification_form_sms');?></b>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-4 col-md-4">
		<label class="checkbox">
		<input type="checkbox" name="sms_notification" value="1" <?php echo (set_checkbox('sms_notification', '1')) ? set_checkbox('sms_notification', '1') : (($this->site_settings->sms_notification == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		<!-- End SMS -->
		
		<!-- Email -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-4 col-md-4">
		<b><?php echo $this->lang->line('admin_notification_form_email');?></b>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-4 col-md-4">
		<label class="checkbox">
		<input type="checkbox" name="email_notification" value="1" <?php echo (set_checkbox('email_notification', '1')) ? set_checkbox('email_notification', '1') : (($this->site_settings->email_notification == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		
		<!-- End Email -->
		
		<hr>
		
		<!-- Infobip -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-4 col-md-4">
		<b><?php echo $this->lang->line('admin_notification_form_infobip');?></b>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-4 col-md-4">
		<label class="checkbox">
		<input type="checkbox" name="sms_infobip" value="1" <?php echo (set_checkbox('sms_infobip', '1')) ? set_checkbox('sms_infobip', '1') : (($this->site_settings->sms_infobip == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		<!-- End Infobip -->
		
		<!-- Twilio -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-4 col-md-4">
		<b><?php echo $this->lang->line('admin_notification_form_twilio');?></b>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-4 col-md-4">
		<label class="checkbox">
		<input type="checkbox" name="sms_twilio" value="1" <?php echo (set_checkbox('sms_twilio', '1')) ? set_checkbox('sms_twilio', '1') : (($this->site_settings->sms_twilio == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		<!-- End Twilio -->
		
		
		<div class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn-primary btn-block" type="submit"><?php echo $this->lang->line('admin_setting_form_submit_button');?></button>
      </div>
	  </form>
	  <!-- Form End -->
	 
			</div>
			
	 </div>
	 </div>
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->
