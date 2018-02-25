  <!-- Update Password -->
  <div class="modal fade" data-keyboard="false" data-backdrop="static" id="security-pin" role="dialog">
    <div class="modal-dialog">
    
      <!-- Password content-->
      <div class="modal-content">
        <div class="modal-header">
		<center>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"><?php echo $this->lang->line('settings_security_update_in_modal_title_h3'); ?></h3>
        </center>
		</div>
        <div class="modal-body">
		  <!-- Form of Password -->
		  <form role="form" enctype="multipart/form-data" method="post">
		  
		  <div class="form-group">
		  <input type="password" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('settings_security_update_form_pin_placeholder'); ?>" name="pin" value=""/>
            </div>
			
			<div class="form-group">
            <input type="password" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('settings_security_update_form_confirm_pin_placeholder'); ?>" name="confirm_pin" value=""/>
            </div>
			
          <div class="form-group ">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <button type="file" class="modal-update-button-big" name="update-security-pin"><?php echo $this->lang->line('settings_security_pin_form_update_button'); ?></button>
          </div>
        </form>

		  <!-- End Form -->
        </div>
      </div>
      
    </div>
			</div>
			<!-- End Password -->