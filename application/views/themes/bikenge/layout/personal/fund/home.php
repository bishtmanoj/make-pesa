      <div class="visible-top"></div>

      <div class="container-fluid">
      <div class="row">
      <div class="col-sm-15 col-md-15 col-md-offset-0">
      <div class="home-cover-avatar visible">
	  <!-- Left cover -->
	  <div class="image-cover-avatar">
		<div class="col-md-2 visible">
			<?php if (empty($this->user->image)): ?>
			   <img src="<?php echo site_url().'assets/images/login.png'; ?>" class="img-thumbnail img-circle img-responsive" height="113px;" width="113px;">
			   <?php else: ?>
			   <img src="<?php echo site_url().''.$this->user->image; ?>" class="img-thumbnail img-circle img-responsive" height="113px;" width="113px;">
			   <?php endif; ?>
        
			</div>
    <div class="col-md-4 colmd-2-covar-avatar">
	<h4><?php echo $this->lang->line('summary_right_mostout_avatar_hello'); ?> <?php echo $this->user->full_name; ?>!</h4>
	<button class="colmd-2-covar-avatar-button" data-toggle="collapse" data-target="#mostout" aria-expanded="false" aria-controls="mostout">
	<?php echo $this->lang->line('summary_right_mostout_avatar_button'); ?><?php echo $this->site_settings->site_name;?> <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
	</button>
	</div>

		
		<!-- Right cover -->
		<div class="col-md-4 pull-right visible">
		<a href="<?php echo site_url().'myaccount/transfer/send/'; ?>">
		<div class="colmd-2-right-covar-avatar">
		<i class="fa fa-money fa-2x" aria-hidden="true"></i>
		</div> 
		</a>
              <p class="colmd-2-right-covar-avatar-p"><?php echo $this->lang->line('summary_right_mostout_avatar_pay_goods'); ?></p>
			  
			  
			  
		</div>

		</div>
		</div>
		</div>

	  <!-- Hidden most out panel -->
	  <?php $this->load->view($this->themename.'/layout/personal/summary/tabs/mostout'); ?>
	  <!-- End -->

        <div class="col-sm-4 col-md-4">
		<?php $this->load->view($this->themename.'/layout/personal/summary/sidebar'); ?>
		
        </div><!--/span-->

        <div class="col-sm-8 col-md-8">
		<!-- Deposit transaction -->
		<?php $this->load->view($this->themename.'/layout/personal/fund/tabs/deposit/home'); ?>
		<!-- End Deposit transaction -->
		
		
		  </div><!--/span-->
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.container-->