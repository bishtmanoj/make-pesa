<!-- Welcome cover -->
<div class="welcome-cover-no-image">
  <h2>
  <?php echo $this->lang->line('welcome_page_mobile_cover_no_image_h2');?>
  </h2>
  <p>
  <?php echo $this->lang->line('welcome_page_mobile_cover_no_image_p');?>
  </p>


</div>

  <div class="container">

  <div class="col-md-12  col-md-12">
  <!-- Deposit Payment -->
  <?php $this->load->view($this->themename.'/layout/welcome/page/mobile/deposit'); ?>
  
  <!-- Withdraw Payment -->
  <?php $this->load->view($this->themename.'/layout/welcome/page/mobile/withdraw'); ?>
  
  </div>
  
  </div>
  </div>
</div>