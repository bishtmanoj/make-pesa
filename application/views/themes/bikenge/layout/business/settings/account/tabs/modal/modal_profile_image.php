  <!-- Photo upload -->
  <div class="modal fade" data-keyboard="false" data-backdrop="static" id="profile-image" role="dialog">
    <div class="modal-dialog">
    
      <!-- Profile content-->
      <div class="modal-content">
        <div class="modal-header">
		<center>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"><?php echo $this->lang->line('settings_account_upload_modal_title_h3'); ?></h3>
        </center>
		</div>
        <div class="modal-body">
		<!-- Image -->
		<center>
		<img src="<?php echo site_url().'assets/images/upload.png'; ?>" class="settings-account-img">
		</center>
		  <!-- Form of photo -->
		  <form role="form" enctype="multipart/form-data" method="post">
		  <div class="form-group">
		  
		  <div class="settings-account-upload-choose">
                <div class="col-lg-12">
                    <input type="file" id="profile-image" class="form-control settings-account-upload-form-input" name="image">
                    <h4 id="select-file"><span class="settings-account-upload-btn">

					<i class="fa fa-camera" aria-hidden="true"></i>
					<?php echo $this->lang->line('settings_account_upload_modal_form_choose'); ?>
					</span></h4>
                </div>
				
		<p class="text-center">
		<?php echo $this->lang->line('settings_account_upload_modal_form_choose_note'); ?>
		</p>

        </div>
		</div>
          <div class="form-group ">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <button type="file" class="modal-update-button-big" name="update-profile-image"><?php echo $this->lang->line('settings_account_form_upload_button'); ?></button>
          </div>
        </form>

		  <!-- End Form -->
        </div>
      </div>
      
    </div>
			</div>
			<!-- End Photo -->