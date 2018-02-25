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
               <h4 class="text-center"><?php echo $this->lang->line('admin_setting_account_h2_desc');?></h4>
			   
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
        <div class="anmationBlock">
		<form method="post">
		<div class="form-group">
		<input type="text" name="site_name" class="form-control" value="<?php echo $this->site_settings->site_name; ?>" placeholder="<?php echo $this->lang->line('admin_setting_form_placeholder_site_name');?>">
		</div>
	  
	  <div class="form-group">
		<input type="email" name="site_email" class="form-control" value="<?php echo $this->site_settings->site_email; ?>" placeholder="<?php echo $this->lang->line('admin_setting_form_placeholder_site_email');?>">
		</div>
		
		<div class="form-group">
		<input type="text" name="site_description" class="form-control" value="<?php echo $this->site_settings->site_description; ?>" placeholder="<?php echo $this->lang->line('admin_setting_form_placeholder_site_description');?>">
		</div>
		
		<div class="form-group">
		<input type="text" name="site_keywords" class="form-control" value="<?php echo $this->site_settings->site_keywords; ?>" placeholder="<?php echo $this->lang->line('admin_setting_form_placeholder_site_keywords');?>">
		</div>
		
		<div class="form-group">
		<select name="curr_word" class="form-control">
		<option value="<?php echo $this->site_settings->curr_word; ?>"><?php echo $this->site_settings->curr_word; ?><option>
		<?php echo $this->helper->currency_word_select_option();?>
		</select>
		</div>
		
		<div class="form-group">
		<select name="curr_symb" class="form-control">
		<option value="<?php echo $this->site_settings->curr_symb; ?>"><?php echo $this->site_settings->curr_symb; ?><option>
		<?php echo $this->helper->currency_symbol_word_select_option();?>
		</select>
		</div>
		
		<div class="form-group">
		<div class="input-group">
		<span class="input-group-addon" id="text-account"><?php echo $this->site_settings->curr_word; ?></span>
		<input type="text" name="card_add_fee" class="form-control" value="<?php echo $this->site_settings->card_add_fee; ?>" placeholder="<?php echo $this->lang->line('admin_setting_form_placeholder_card_verification_fees');?>">
		</div>
		</div>
		
		<!-- User register -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-4 col-md-4">
		<b><?php echo $this->lang->line('admin_setting_form_registration');?></b>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-4 col-md-4">
		<label class="checkbox">
		<input type="checkbox" name="user_register" value="1" <?php echo (set_checkbox('user_register', '1')) ? set_checkbox('user_register', '1') : (($this->site_settings->user_register == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		
		<!-- End user register -->
		
		<!-- Send money -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-4 col-md-4">
		<b><?php echo $this->lang->line('admin_setting_form_send_money');?></b>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-4 col-md-4">
		<label class="checkbox">
		<input type="checkbox" name="user_send_money" value="1" <?php echo (set_checkbox('user_send_money', '1')) ? set_checkbox('user_send_money', '1') : (($this->site_settings->user_send_money == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		
		<!-- End send money -->
		
		<!-- Request money -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-4 col-md-4">
		<b><?php echo $this->lang->line('admin_setting_form_request_money');?></b>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-4 col-md-4">
		<label class="checkbox">
		<input type="checkbox" name="user_request_money" value="1" <?php echo (set_checkbox('user_request_money', '1')) ? set_checkbox('user_request_money', '1') : (($this->site_settings->user_request_money == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		
		<!-- End Request money -->
		
		<!-- Deposit -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-4 col-md-4">
		<b><?php echo $this->lang->line('admin_setting_form_deposit_fund');?></b>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-4 col-md-4">
		<label class="checkbox">
		<input type="checkbox" name="user_deposit_fund" value="1" <?php echo (set_checkbox('user_deposit_fund', '1')) ? set_checkbox('user_deposit_fund', '1') : (($this->site_settings->user_deposit_fund == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		
		<!-- End Deposit -->
		
		<!-- Withdraw -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-4 col-md-4">
		<b><?php echo $this->lang->line('admin_setting_form_withdraw_fund');?></b>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-4 col-md-4">
		<label class="checkbox">
		<input type="checkbox" name="user_withdraw_fund" value="1" <?php echo (set_checkbox('user_withdraw_fund', '1')) ? set_checkbox('user_withdraw_fund', '1') : (($this->site_settings->user_withdraw_fund == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		
		<!-- End Withdraw -->
		
		
		<!-- Maintanace Mode -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-4 col-md-4">
		<b><?php echo $this->lang->line('admin_setting_form_maintanace_mode');?></b>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-4 col-md-4">
		<label class="checkbox">
		<input type="checkbox" name="site_maintanace" value="1" <?php echo (set_checkbox('site_maintanace', '1')) ? set_checkbox('site_maintanace', '1') : (($this->site_settings->site_maintanace == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		
		<!-- End Maintanace Mode  -->
		
		<div class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn-primary btn-block" type="submit" id="anmationBKPesa_wait"><?php echo $this->lang->line('admin_setting_form_submit_button');?></button>
      </div>
	  </form>
	  </div>
	  <!-- Form End -->
	 
			</div>
			
	 </div>
	 </div>
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->
