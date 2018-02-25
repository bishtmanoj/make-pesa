		<div class="row visible">
		<div id="mostout" class="home-most-out-hidden panel-collapse collapse">
		<div class="col-md-8 col-sm-offset-3 col-md-9 col-md-offset-2">
				<span class="home-most-out-hidden-down-close-x pull-right visible" data-toggle="collapse" data-target="#mostout" aria-expanded="false" aria-controls="mostout">
				X
				</span>
				<div class="home-most-out-hidden-down">
				
				<h1><?php echo $this->lang->line('summary_right_mostout_hidden_down_h1'); ?><?php echo $this->site_settings->site_name;?></h1>
				<!-- Inline display -->
				<div class="home-most-out-hidden-inline">
				<div class="col-md-3">
		<div class="home-most-out-hidden-round-icon">
		<i class="fa fa-check fa-2x" aria-hidden="true"></i>
		</div> 
              <p class="home-most-out-hidden-p">
			  <?php echo $this->lang->line('summary_right_mostout_hidden_p_account'); ?>
			  </p>
		</div>
		
		<div class="col-md-3">
		
		<div class="home-most-out-hidden-round-icon">
		<i class="fa fa-check fa-2x" aria-hidden="true"></i>
		</div> 
              <p class="home-most-out-hidden-p">
			  <?php echo $this->lang->line('summary_right_mostout_hidden_p_email'); ?>
			  </p>
		</div>
		
		<div class="col-md-3">
		<?php if (empty($list_card)): ?>
		<a href="<?php echo site_url().'business/wallet/'; ?>">
		<div class="home-most-out-hidden-round-icon-error">
		<i class="fa fa-credit-card fa-2x" aria-hidden="true"></i>
		</div> 
              <p class="home-most-out-hidden-p-error">
			  <?php echo $this->lang->line('summary_right_mostout_hidden_p_card'); ?>
			  </p>
			  </a>
		<?php else: ?>
		<div class="home-most-out-hidden-round-icon">
		<i class="fa fa-credit-card fa-2x" aria-hidden="true"></i>
		</div> 
              <p class="home-most-out-hidden-p">
			  <?php echo $this->lang->line('summary_right_mostout_hidden_p_card_linked'); ?>
			  </p>
		<?php endif; ?>

		</div>
		<!-- End -->
		
			</div>
			</div>
			
			</div>
			</div>
			</div>