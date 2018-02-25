  <!-- Profile info -->
  <div class="modal fade" data-keyboard="false" data-backdrop="static" id="profile" role="dialog">
    <div class="modal-dialog">
    
      <!-- Profile content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"><?php echo $this->lang->line('settings_account_modal_title_h3'); ?></h3>
        </div>
        <div class="modal-body">
		
		  <!-- Form of profile -->
		  <form role="form" method="post">
		  <div class="form-group">
		<p><b>
		<?php echo $this->lang->line('settings_account_modal_current_name'); ?>
		</b> <?php echo $this->user->full_name;?></p>
		<p><?php echo $this->lang->line('settings_account_modal_legal_name'); ?></p>
		</div>
		  
            <div class="form-group">
            <input type="text" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('settings_account_form_first_name_placeholder'); ?>" name="first_name" value="<?php echo $this->user->first_name;?>"/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('settings_account_form_last_name_placeholder'); ?>" name="last_name" value="<?php echo $this->user->last_name;?>"/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('settings_account_form_business_name_placeholder'); ?>" name="business_name" value="<?php echo $this->user->business_name; ?>"/>
            </div>
			
          
          <div class="form-group ">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <button type="submit" class="modal-update-button-big" name="update-profile-name"><?php echo $this->lang->line('settings_account_form_card_update_button'); ?></button>
          </div>
        </form>

		  <!-- End Form -->
        </div>
      </div>
      
    </div>
			</div>
			<!-- End Profile -->