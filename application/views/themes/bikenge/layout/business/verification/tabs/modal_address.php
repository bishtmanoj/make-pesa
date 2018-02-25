  <!-- Address upload -->
  <div class="modal fade" id="address" role="dialog">
    <div class="modal-dialog">
    
      <!-- Address content -->
      <div class="modal-content">
        <div class="modal-header">
		<center>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $this->lang->line('verification_address_upload_modal_title_h4'); ?></h4>
        </center>
		</div>
        <div class="modal-body">
		<!-- File -->
		<center>
		<img src="<?php echo site_url().'assets/images/upload.png'; ?>" class="settings-account-img">
		</center>
		  <!-- Form of File -->
		  <form role="form" enctype="multipart/form-data" method="post">
		  <div class="form-group">
		  
		  <div class="settings-account-upload-choose">
                <div class="col-lg-12">
                    <input type="file" id="address-file" class="form-control settings-account-upload-form-input" name="file">
                    <h4 id="select-address-file"><span class="settings-account-upload-btn">

					<i class="fa fa-paperclip" aria-hidden="true"></i>
					<?php echo $this->lang->line('verification_id_upload_form_placeholder_choose_file'); ?>
					</span></h4>
                </div>
				</div>
				
			
		<p class="text-center">
		<?php echo $this->lang->line('verification_address_upload_form_placeholder_note'); ?>
		</p>
		</div>
          <div class="form-group ">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <button type="submit" class="modal-update-button-big" name="verification-address"><?php echo $this->lang->line('verification_id_upload_form_submit_button'); ?></button>
          </div>
        </form>

		  <!-- End Form -->
        </div>
      </div>
      
    </div>
			</div>
			<!-- End Address-->