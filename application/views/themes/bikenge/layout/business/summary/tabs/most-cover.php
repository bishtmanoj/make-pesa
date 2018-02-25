<div class="home-cover-avatar visible">
	  <!-- Left cover -->
	  <div class="image-cover-avatar">
		<div class="col-md-2 visible">
			<?php if (empty($this->user->image)): ?>
			   <img src="<?php echo site_url().'assets/images/login.png'; ?>" class="img-thumbnail img-circle img-responsive" height="113px;" width="113px;">
			   <?php else: ?>
			   <img src="<?php echo site_url().''.$this->user->image; ?>" class="img-thumbnail img-circle img-responsive" height="113px;" width="113px;">
			   <?php endif; ?>
        
			</div>
    <div class="col-md-4 colmd-2-covar-avatar">
	<h4><?php echo $this->user->business_name; ?> <?php echo $this->helper->account_verified_badge(); ?></h4>
	<?php if ($this->user->verified == 1):?>
	<i class="fa fa-check-circle fa-lg fa-white" aria-hidden="true"></i> Business Account
	<?php else:?>
	Business Account (Not verified)
	<?php endif;?>
	
	<button class="colmd-2-covar-avatar-button" data-toggle="collapse" data-target="#mostout" aria-expanded="false" aria-controls="mostout">
	<?php echo $this->lang->line('summary_right_mostout_avatar_button'); ?><?php echo $this->site_settings->site_name;?> <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
	</button>
	</div>

		
		<!-- Right cover -->
		<div class="col-md-6 pull-right visible">
		<!-- Transaction Report -->
		<div class="most-avatar-icon-inline">
		<a href="<?php echo site_url().'business/activity/'; ?>">
		<div class="most-avatar-icon">
		<i class="fa fa-calculator fa-2x" aria-hidden="true"></i>
		</div> 
		</a>
        <p><?php echo $this->lang->line('summary_right_mostout_avatar_check_report'); ?></p>
		</div>	

		<!-- Invoice -->
		<div class="most-avatar-icon-inline">
		<a href="<?php echo site_url().'business/transfer/send'; ?>">
		<div class="most-avatar-icon">
		<i class="fa fa-money fa-2x" aria-hidden="true"></i>
		</div> 
		</a>
        <p><?php echo $this->lang->line('summary_right_mostout_avatar_money'); ?></p>
		</div>
		
		<!-- Mobile App -->
		<div class="most-avatar-icon-inline">
		<a href="#">
		<div class="most-avatar-icon">
		<i class="fa fa-mobile fa-2x" aria-hidden="true"></i>
		</div> 
		</a>
        <p><?php echo $this->lang->line('summary_right_mostout_avatar_mobile_app'); ?></p>
		</div>

		
			  
			  
		</div>

		</div>
		</div>
		</div>
		
		<!-- Hidden most out panel -->
	  <?php $this->load->view($this->themename.'/layout/business/summary/tabs/mostout'); ?>
	  <!-- End -->