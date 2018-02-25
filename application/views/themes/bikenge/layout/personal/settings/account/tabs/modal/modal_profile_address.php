  <!-- Update Address -->
  <div class="modal fade" data-keyboard="false" data-backdrop="static" id="profile-address" role="dialog">
    <div class="modal-dialog">
    
      <!-- Profile Address content-->
      <div class="modal-content">
        <div class="modal-header">
		<center>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"><?php echo $this->lang->line('settings_account_update_address_modal_title_h3'); ?></h3>
        </center>
		</div>
        <div class="modal-body">
		  <!-- Form of address -->
		  <form role="form" enctype="multipart/form-data" method="post">
		  
            <div class="form-group">
            <input type="text" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('settings_account_update_address_form_address1_placeholder'); ?>" name="address1" value="<?php echo $this->user->address1; ?>"/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('settings_account_update_address_form_address2_placeholder'); ?>" name="address2" value="<?php echo $this->user->address2; ?>"/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('settings_account_update_address_form_city_placeholder'); ?>" name="city" value="<?php echo $this->user->city; ?>"/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('settings_account_update_address_form_state_placeholder'); ?>" name="state" value="<?php echo $this->user->state; ?>"/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('settings_account_update_address_form_postal_code_placeholder'); ?>" name="postal_code" value="<?php echo $this->user->postal_code; ?>"/>
            </div>
			
          <div class="form-group ">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <button type="file" class="modal-update-button-big" name="update-profile-address"><?php echo $this->lang->line('settings_account_address_form_update_button'); ?></button>
          </div>
        </form>

		  <!-- End Form -->
        </div>
      </div>
      
    </div>
			</div>
			<!-- End Profile Address -->