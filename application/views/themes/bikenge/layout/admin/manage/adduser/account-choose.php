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
               <h4 class="text-center"><?php echo $this->lang->line('admin_adduser_account_h2_desc');?></h4>
			   
			<!-- Form Select adduser -->
        <form method="post">
		<div class="form-group">
		<select name="account" class="form-control">
		<option value="1"><?php echo $this->lang->line('admin_adduser_select_personal');?></option>
		<option value="2"><?php echo $this->lang->line('admin_adduser_select_business');?></option>
		</select>
		</div>
		
		<div class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn-primary btn-block" type="submit"><?php echo $this->lang->line('admin_adduser_form_submit_button');?></button>
      </div>
	  </form>
	  <!-- Form End -->
	 
			</div>
			
	 </div>
	 </div>
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->
