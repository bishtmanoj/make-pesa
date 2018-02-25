  <!-- Update Password -->
  <div class="modal fade" data-keyboard="false" data-backdrop="static" id="security-password" role="dialog">
    <div class="modal-dialog">
    
      <!-- Password content-->
      <div class="modal-content">
        <div class="modal-header">
		<center>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"><?php echo $this->lang->line('settings_security_update_password_modal_title_h3'); ?></h3>
        </center>
		</div>
        <div class="modal-body">
		  <!-- Form of Password -->
		  <form role="form" enctype="multipart/form-data" method="post">
		  
		  <div class="form-group">
		  <p>
		  <?php echo $this->lang->line('settings_security_p_form_confirm_password'); ?>
		  </p>
		  <input type="password" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('settings_security_update_form_current_password_placeholder'); ?>" name="current_password" value=""/>
            </div>
			
			<div class="form-group">
			</div>
			 <p>
			 <?php echo $this->lang->line('settings_security_p_form_new_password'); ?>
			 </p>
			<div class="form-group">
            <input type="password" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('settings_security_update_form_new_password_placeholder'); ?>" name="password" value=""/>
            </div>
			
			<div class="form-group">
            <input type="password" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('settings_security_update_form_confirm_password_placeholder'); ?>" name="confirm_password" value=""/>
            </div>
			
          <div class="form-group ">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <button type="file" class="modal-update-button-big" name="update-security-password"><?php echo $this->lang->line('settings_security_password_form_update_button'); ?></button>
          </div>
        </form>

		  <!-- End Form -->
        </div>
      </div>
      
    </div>
			</div>
			<!-- End Password -->