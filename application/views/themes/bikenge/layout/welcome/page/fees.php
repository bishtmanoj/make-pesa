<!-- Welcome cover -->
<div class="welcome-cover-no-image">
  <h2>
  <?php echo $this->lang->line('welcome_page_fees_cover_no_image_h2');?>
  </h2>
  <p>
  <?php echo $this->lang->line('welcome_page_fees_cover_no_image_p');?>
  </p>


</div>

  <div class="container">

  <div class="col-md-12  col-md-12">
  <!-- Pricing fees -->
  <!-- Send, receive table -->
  <?php $this->load->view($this->themename.'/layout/welcome/page/fees/send_receive_table_fees'); ?>
  
  <!--Deposit table -->
  <?php $this->load->view($this->themename.'/layout/welcome/page/fees/deposit_table_fees'); ?>
  
  <!--Withdraw table -->
  <?php $this->load->view($this->themename.'/layout/welcome/page/fees/withdraw_table_fees'); ?>
  
  </div>
  
  <div class="welcome-home-protection">
  <h4>
  </h4>
  </div>
  </div>
</div>