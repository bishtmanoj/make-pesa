<!-- Welcome cover -->
<div class="welcome-cover-no-image">
  <h2>
  <?php echo $this->lang->line('welcome_page_developer_cover_no_image_h2');?>
  </h2>
  <p>
  <?php echo $this->lang->line('welcome_page_developer_cover_no_image_p');?>
  </p>


</div>

  <div class="container">

  <div class="col-md-12  col-md-12">
  <!-- Selling Tools -->
  <?php $this->load->view($this->themename.'/layout/welcome/page/developer/selling'); ?>
  
  <!-- Checkout API -->
  <?php $this->load->view($this->themename.'/layout/welcome/page/developer/checkout'); ?>
  
  </div>
  
  <div class="welcome-home-protection">
  <h4>
  </h4>
  </div>
  </div>
</div>