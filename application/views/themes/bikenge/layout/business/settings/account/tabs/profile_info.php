<div class="well settings-account-well">
		<h4>
		<?php echo $this->lang->line('settings_account_profile_well_h4'); ?>
		</h4>
		
		<!-- Left -->
		<div class="col-sm-3 col-md-4">
		<!-- Image -->
		<?php if (empty($this->user->image)): ?>
			   <img src="<?php echo site_url().'assets/images/login.png'; ?>" class="settings-account-img">
			   <?php else: ?>
			   <img src="<?php echo site_url().''.$this->user->image; ?>" class="settings-account-img">
			   <?php endif; ?>
		<!-- Upload profile image -->
		<a href="#" data-toggle="modal" data-target="#profile-image">
		<?php echo $this->lang->line('settings_account_profile_upload_link'); ?>
		</a>
		</div>
		<!-- Right -->
		<div class="col-sm-5 col-md-7">
		<h4><?php echo $this->user->business_name; ?>
		<?php echo $this->helper->account_verified_badge(); ?>
		</h4>
		<div class="">
		<?php echo $this->lang->line('settings_account_profile_joined'); ?> 
		<?php echo date("Y", $this->user->register_time); ?>
		<a href="#" class="pull-right"  data-toggle="modal" data-target="#profile">Edit
		</a>
		</div>
		<div class="settings-account-joined"></div>
		</div>
		
		</div>