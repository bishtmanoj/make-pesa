		  <h4><?php echo $this->lang->line('verification_h4_well'); ?></h4>
		  <hr>
		  <?php if ($this->verification_id['status'] == 1):?>
		  <div class="wallet-box">
		  <div class="wallet-box-margin">
		  <h4><i class="fa fa-check fa-lg" aria-hidden="true"></i></h4>
		  <?php echo $this->lang->line('verification_id_card_verified'); ?>
		  </div>
		  </div>
		  <?php else: ?>
		  <!-- ID verification -->
		  <a href="#" data-toggle="modal" data-target="#id">
		  <div class="wallet-box">
		  <div class="wallet-box-margin">
		  <h4><i class="fa fa-address-card fa-lg" aria-hidden="true"></i></h4>
		  <?php echo $this->lang->line('verification_add_id_card'); ?>
		  </div>
		  </div>
		  </a>
		  <?php endif; ?>
		  
		  <!-- Address -->
		  <?php if ($this->verification_address['status'] == 1):?>
		  <div class="wallet-box">
		  <div class="wallet-box-margin">
		  <h4><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i></h4>
		  <?php echo $this->lang->line('verification_address_verified'); ?>
		  </div>
		  </div>
		  <?php else: ?>
		  <!-- Address verification -->
		  <a href="#" data-toggle="modal" data-target="#address">
		  <div class="wallet-box">
		  <div class="wallet-box-margin">
		  <h4><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i></h4>
		  <?php echo $this->lang->line('verification_add_address_location'); ?>
		  </div>
		  </div>
		  </a>
		  <?php endif; ?>