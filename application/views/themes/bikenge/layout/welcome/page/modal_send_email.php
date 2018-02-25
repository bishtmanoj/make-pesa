  <!-- Send email-->
  <div class="modal fade" id="send-email" role="dialog">
    <div class="modal-dialog">
    
      <!-- Card content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
		  <?php echo $this->lang->line('welcome_page_help_cover_image_form_modal_email_title');?>
		  </h4>
        </div>
        <div class="modal-body">
		
		  <!-- Form email -->
		  <form role="form" method="post">
		  
		  <div class="form-group">
            <input type="text" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('welcome_page_help_cover_image_form_modal_email_name');?>" name="name" value=""/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('welcome_page_help_cover_image_form_modal_email_subject');?>" name="subject" value=""/>
            </div>
			
			<div class="form-group">
			<div class="row">
			<div class="col-xs-6 col-md-6">
			<input type="email" class="form-control" placeholder="<?php echo $this->lang->line('welcome_page_help_cover_image_form_modal_email_email');?>" name="email" value="">
			</div>
		
			<div class="col-xs-6 col-md-6">
			<input type="text" class="form-control" placeholder="<?php echo $this->lang->line('welcome_page_help_cover_image_form_modal_email_number');?>" name="number" value="">
			</div>
			</div>
			</div>		
            <div class="form-group">
            <textarea name="messages" placeholder="<?php echo $this->lang->line('welcome_page_help_cover_image_form_modal_email_messages');?>" class="form-control"></textarea>
			</div>
          </div>

          
          <div class="form-group">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <button type="submit" class="modal-send-button-big" name="send-email">
			<?php echo $this->lang->line('welcome_page_help_cover_image_form_modal_email_submit_email');?>
			</button>
          </div>
        </form>

		  <!-- End Form -->
        </div>
      </div>
      
    </div>
			</div>
			<!-- End Send email -->