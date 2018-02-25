<!-- Welcome cover -->
<div class="welcome-cover-image">
  <h2>
  <?php echo $this->lang->line('welcome_page_help_cover_image_h2');?>
  </h2>
  <?php

        if (validation_errors()) {

          echo '<div class="alert alert-info alert-dismissible" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                  '.validation_errors().'
                </div>';
                  
        }
		
		 // Send email success alert.
      	if ($this->session->send_email_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('send_email_success').'
      			  </div>';
      	}
		
  	    ?>
  <p>
  <?php echo $this->lang->line('welcome_page_help_cover_image_p');?>
  </p>

  <a href="#" class="welcome-button-blue">
  <i class="fa fa-mobile fa-lg" aria-hidden="true"></i> 
  <?php echo $this->lang->line('welcome_page_help_cover_image_button_call');?>
  </a>
  <a href="#" class="welcome-button-blue-good" data-toggle="modal" data-target="#send-email">
  <i class="fa fa-envelope-o" aria-hidden="true"></i> 
  <?php echo $this->lang->line('welcome_page_help_cover_image_button_send_email');?>
  </a>

</div>

  <div class="container">

  <div class="col-md-12  col-md-12">
  <!-- Social network -->
  <div class="welcome-home-account">
  <h1>
  <?php echo $this->lang->line('welcome_page_help_cover_account_note_h1');?>
  </h1>
  </div>
  
  <!-- Facebook -->
  <div class="welcome-home-box-account">
  <h4><?php echo $this->lang->line('welcome_page_help_box_account_facebook_h4');?></h4>
  <i class="fa fa-facebook-official fa-5x" aria-hidden="true"></i>
  <div class="welcome-home-box-account-overlay">
    <h4><?php echo $this->lang->line('welcome_page_help_box_account_facebook_overlay');?></h4>
	<p>
	<?php echo $this->lang->line('welcome_page_help_box_account_facebook_overlay_p');?>
	</p>
  </div>
  </div>
  
  <!-- Twitter -->
  <div class="welcome-home-box-account">
  <h4><?php echo $this->lang->line('welcome_page_help_box_account_twitter_h4');?></h4>
  <i class="fa fa-twitter fa-5x" aria-hidden="true"></i>
  <div class="welcome-home-box-account-overlay">
    <h4><?php echo $this->lang->line('welcome_page_help_box_account_twitter_overlay');?></h4>
	<p>
	<?php echo $this->lang->line('welcome_page_help_box_account_twitter_overlay_p');?>
	</p>
  </div>
  </div>
  
  <!-- Whatsapp -->
  <div class="welcome-home-box-account">
  <h4><?php echo $this->lang->line('welcome_page_help_box_account_whatsapp_h4');?></h4>
  <i class="fa fa-whatsapp fa-5x" aria-hidden="true"></i>
  <div class="welcome-home-box-account-overlay">
    <h4><?php echo $this->lang->line('welcome_page_help_box_account_whatsapp_overlay');?></h4>
	<p>
	<?php echo $this->lang->line('welcome_page_help_box_account_whatsapp_overlay_p');?>
	</p>
  </div>
  </div>
  
  <!-- Skype -->
  <div class="welcome-home-box-account">
  <h4><?php echo $this->lang->line('welcome_page_help_box_account_skype_h4');?></h4>
  <i class="fa fa-skype fa-5x" aria-hidden="true"></i>
  <div class="welcome-home-box-account-overlay">
    <h4><?php echo $this->lang->line('welcome_page_help_box_account_skype_overlay');?></h4>
	<p>
	<?php echo $this->lang->line('welcome_page_help_box_account_skype_overlay_p');?>
	</p>
  </div>
  </div>
  
  <div class="welcome-home-protection">
  <h4>
  </h4>
  </div>
  </div>
</div>

<?php $this->load->view($this->themename.'/layout/welcome/page/modal_send_email'); ?>