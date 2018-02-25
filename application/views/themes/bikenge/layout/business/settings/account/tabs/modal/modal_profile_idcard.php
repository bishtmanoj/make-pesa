  <!-- Update ID Card -->
  <div class="modal fade" data-keyboard="false" data-backdrop="static" id="profile-idcard" role="dialog">
    <div class="modal-dialog">
    
      <!-- Profile ID content-->
      <div class="modal-content">
        <div class="modal-header">
		<center>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"><?php echo $this->lang->line('settings_account_update_idcard_modal_title_h3'); ?></h3>
        </center>
		</div>
        <div class="modal-body">
		  <!-- Form of photo -->
		  <form role="form" enctype="multipart/form-data" method="post">
		  
		  <div class="form-group">
            <select name="idcard_type" class="form-control">
			<option><?php echo $this->lang->line('settings_account_update_idcard_type_form_number_placeholder'); ?></option>
			<?php echo $this->helper->idcard_type_select_option();?>
			</select>
            </div>
			
		  <div class="form-group">
            <input type="text" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('settings_account_update_idcard_form_number_placeholder'); ?>" name="number" value=""/>
            </div>
			
          <div class="form-group ">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <button type="file" class="modal-update-button-big" name="update-profile-idcard"><?php echo $this->lang->line('settings_account__idcard_form_update_button'); ?></button>
          </div>
        </form>

		  <!-- End Form -->
        </div>
      </div>
      
    </div>
			</div>
			<!-- End Profile ID -->