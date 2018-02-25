<div class="head-padding-top"></div>
<div class="container">
<div class="row">
<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
         <div class="well-header">
               <center><img src="<?php echo site_url().$this->userlist->image; ?>" class="img-thumbnail img-circle img-responsive" height="80px;" width="80px;"></center>
               <h4 class="text-center"><?php echo $this->lang->line('admin_profile_h2_desc');?></h4>
			   <hr>
            </div>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="business_info">
        <form method="post">
		<div class="form-group">
		<div class="row">
		<div class="col-xs-6 col-md-6">
		<label for="Account status"> <?php echo $this->lang->line('admin_profile_info_status');?>
		</div>
		
		<div class="col-xs-6 col-md-6">
		<?php echo $this->helper->account_status_in_admin($this->userlist->account_type); ?>
		</div>
		</div>
		</div>
		
				
		<div class="form-group">
		<div class="row">
		<div class="col-xs-6 col-md-6">
		<label for="Full name"> <?php echo $this->lang->line('admin_profile_info_full_name');?>
		</div>
		
		<div class="col-xs-6 col-md-6">
		<?php echo $this->userlist->full_name;?>
		</div>
		</div>
		</div>
		
		<div class="form-group">
		<div class="row">
		<div class="col-xs-6 col-md-6">
		<label for="Email"> <?php echo $this->lang->line('admin_profile_info_email');?>
		</div>
		
		<div class="col-xs-6 col-md-6">
		<?php echo $this->userlist->email;?>
		</div>
		</div>
		</div>
		
		<div class="form-group">
		<div class="row">
		<div class="col-xs-6 col-md-6">
		<label for="Mobile"> <?php echo $this->lang->line('admin_profile_info_mobile');?>
		</div>
		
		<div class="col-xs-6 col-md-6">
		<?php echo $this->userlist->mobile;?>
		</div>
		</div>
		</div>
		
		<div class="form-group">
		<div class="row">
		<div class="col-xs-6 col-md-6">
		<label for="Country"> <?php echo $this->lang->line('admin_profile_info_country');?>
		</div>
		
		<div class="col-xs-6 col-md-6">
		<?php echo $this->userlist->country;?>
		</div>
		</div>
		</div>
		
	  </form>
	  <!-- Form End -->
	  <a class="btn btn-primary btn-block" href="<?php echo site_url().'admin/manage'; ?>"><?php echo $this->lang->line('admin_profile_back_button'); ?></a>
      </div>
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->
