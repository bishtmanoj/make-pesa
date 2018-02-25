<!-- Welcome cover -->
<div class="welcome-cover-image">
  <h2>
  <?php echo $this->lang->line('welcome_home_cover_h2_need');?>
  </h2>
  <p>
  <?php echo $this->lang->line('welcome_home_cover_p_support');?>
  </p>

 
  <a href="<?php echo site_url().'page/fees/'; ?>" class="welcome-button-blue">
  <?php echo $this->lang->line('welcome_home_cover_button_blue_fee');?>
  </a>
  <a href="<?php echo site_url().'myaccount/signin/'; ?>" class="welcome-button-blue-good">
  <?php echo $this->lang->line('welcome_home_cover_button_blue_good_login');?>
  </a>

</div>

  <div class="container">
  <div class="col-md-9 col-sm-offset-3 col-md-9 col-md-offset-2">
  <!-- Accept mobile money -->
  <div class="welcome-home-document-merchant">
  <div class="mobile-accept-method-well">
		  <?php if ($this->site_settings->deposit_method_mpesa == 1): ?>
		  <!-- M-PESA -->
		  <div class="mobile-accept-method mpesa-accept">
		  <div class="mobile-accept-box-margin">
		  <h4>M-PESA</h4>
		  <i class="fa fa-money" aria-hidden="true"></i>
		  </div>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->deposit_method_tigopesa == 1): ?>
		  <!-- TIGO-PESA -->
		  <div class="mobile-accept-method tigo-accept">
		  <div class="mobile-accept-box-margin">
		  <h4>TIGO PESA</h4>
		  <i class="fa fa-money" aria-hidden="true"></i>
		  </div>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->deposit_method_mtn == 1): ?>
		  <!-- MTN -->
		  <div class="mobile-accept-method mtn-accept">
		  <div class="mobile-accept-box-margin">
		  <h4>MTN MONEY</h4>
		  <i class="fa fa-money" aria-hidden="true"></i>
		  </div>
		  </div>
		  <?php endif; ?>
		  
		  <?php if ($this->site_settings->deposit_method_orange == 1): ?>
		  <!-- ORANGE -->
		  <div class="mobile-accept-method orange-accept">
		  <div class="mobile-accept-box-margin">
		  <h4>ORANGE</h4>
		  <i class="fa fa-money" aria-hidden="true"></i>
		  </div>
		  </div>
		  <?php endif; ?>
		  </div>
 
  </div>
  </div>
  </div>
  
  <div class="container">
  <div class="col-md-8 col-sm-offset-3 col-md-9 col-md-offset-2">
  <!-- Download Document-->
  <div class="welcome-home-document-merchant">
  <h1>
  <?php echo $this->lang->line('welcome_home_cover_document_sell');?> 
  <a href="<?php echo site_url().'page/developer/'; ?>">
  <?php echo $this->lang->line('welcome_home_cover_document_sell_link');?>
  </a>
  </h1>
  </div>
  </div>

  <div class="col-md-12  col-md-12">
  <!-- Your account-->
  <div class="welcome-home-account">
  <h1>
  <?php echo $this->lang->line('welcome_home_cover_account_note_h1');?>
  </h1>
  </div>
  
  <!-- Get started -->
  <div class="welcome-home-box-account">
  <h4><?php echo $this->lang->line('welcome_home_box_account_start_h4');?></h4>
  <i class="fa fa-lightbulb-o fa-5x" aria-hidden="true"></i>
  <div class="welcome-home-box-account-overlay">
    <h4><?php echo $this->lang->line('welcome_home_box_account_start_overlay');?></h4>
	<p>
	<?php echo $this->lang->line('welcome_home_box_account_start_overlay_p');?>
	</p>
  </div>
  </div>
  
  <!-- Merchant Tools -->
  <div class="welcome-home-box-account">
  <h4><?php echo $this->lang->line('welcome_home_box_account_merchant_h4');?></h4>
  <i class="fa fa-shopping-bag fa-5x" aria-hidden="true"></i>
  <div class="welcome-home-box-account-overlay">
    <h4><?php echo $this->lang->line('welcome_home_box_account_merchant_overlay');?></h4>
	<p>
	<?php echo $this->lang->line('welcome_home_box_account_merchant_overlay_p');?>
	</p>
  </div>
  </div>
  
  <!-- Purchases Protection -->
  <div class="welcome-home-box-account">
  <h4><?php echo $this->lang->line('welcome_home_box_account_secure_h4');?></h4>
  <i class="fa fa-shield fa-5x" aria-hidden="true"></i>
  <div class="welcome-home-box-account-overlay">
    <h4><?php echo $this->lang->line('welcome_home_box_account_secure_overlay');?></h4>
	<p>
	<?php echo $this->lang->line('welcome_home_box_account_secure_overlay_p');?>
	</p>
  </div>
  </div>
  
  <!-- Send Money -->
  <div class="welcome-home-box-account">
  <a href="">
  <h4><?php echo $this->lang->line('welcome_home_box_account_send_h4');?></h4>
  <i class="fa fa-money fa-5x" aria-hidden="true"></i>
  <div class="welcome-home-box-account-overlay">
    <h4><?php echo $this->lang->line('welcome_home_box_account_send_overlay');?></h4>
	<p>
	<?php echo $this->lang->line('welcome_home_box_account_send_overlay_p');?>
	</p>
  </div>
  </a>
  </div>
  
  <div class="welcome-home-protection">
  <h4>
  *<a href="">
  <?php echo $this->lang->line('welcome_home_box_account_buyer_protect_link');?>
  </a>
  </h4>
  </div>
  </div>
</div>
<script>
		function balance_submit() {
		$("#balance_check").hide();
		
		// Validate inpute
		if ($.trim($('#pin').val()) == '') {
		$("#balance_check").html('PIN field is empty');
		$("#balance_check").show();
        return false;
        }
		{
		//Data store
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('ipn/balance')?>",
            data: {code: $("#pin").val()},
            cache: false,
            success: function(result) {
                $("#balance_check").html(result);
				$("#balance_check").show();
				
            }
        });
		}
		return false;
		}
		</script>
