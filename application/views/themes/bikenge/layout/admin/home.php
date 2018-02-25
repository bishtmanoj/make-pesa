<div class="head-padding-top"></div>
<div class="container">
<div class="row">
<div class="col-sm-13 col-sm-offset-2 col-md-13 col-md-offset-0">
<div class="row">

        <div class="col-sm-4 col-md-4">
		 <?php $this->load->view($this->themename.'/layout/admin/globe/sidebar/nav'); ?>
            </div>
			
			
			<div class="col-sm-8 col-md-8">
			
        <!-- Today Register Statistics -->
		<div class="statistic-box">
		<div class="statistic-box-margin">
		<h4><?php echo $this->helper->admin_user_registration_count(1);?></h4>
		<p><?php echo $this->lang->line('admin_home_stastics_user_registration_today');?>
		  </br>
		<?php echo $this->lang->line('admin_home_stastics_user_registration');?></p>
		</div>
		</div>
		
		<!-- Yesterday Register Statistics -->
		<div class="statistic-box">
		<div class="statistic-box-margin">
		<h4><?php echo $this->helper->admin_user_registration_count(2);?></h4>
		<p><?php echo $this->lang->line('admin_home_stastics_user_registration_yesterday');?>
		  </br>
		<?php echo $this->lang->line('admin_home_stastics_user_registration');?></p>
		</div>
		</div>
		
		<!-- Month Register Statistics -->
		<div class="statistic-box">
		<div class="statistic-box-margin">
		<h4><?php echo $this->helper->admin_user_registration_count(30);?></h4>
		<p><?php echo $this->lang->line('admin_home_stastics_user_registration_month');?>
		  </br>
		<?php echo $this->lang->line('admin_home_stastics_user_registration');?></p>
		</div>
		</div>
		
		<!-- Total Register Statistics -->
		<div class="statistic-box">
		<div class="statistic-box-margin">
		<h4><?php echo $this->helper->admin_user_registration_count('t');?></h4>
		<p><?php echo $this->lang->line('admin_home_stastics_user_registration_total');?>
		  </br>
		<?php echo $this->lang->line('admin_home_stastics_user_registration');?></p>
		</div>
		</div>
		
		<!-- Statistics bar -->
		<!-- Profit -->
		<div class="col-sm-6 col-md-6">
		<div class="statistic-bar-box">
		<div class="statistic-bar-box-earn">
		<?php echo $this->lang->line('admin_home_stastics_bar_profit');?>
		</div>
		<h4><i class="fa fa-money fa-lg" aria-hidden="true"></i></h4>
		</div>
		<div class="statistic-bar-box-earn-down">
		<?php echo $this->helper->admin_home_statistics_bar(1);?>
		</div>
		</div>
		
		<!-- Total Transaction -->
		<div class="col-sm-6 col-md-6">
		<div class="statistic-bar-box">
		<div class="statistic-bar-box-earn">
		<?php echo $this->lang->line('admin_home_stastics_bar_total_transaction');?>
		</div>
		<h4><i class="fa fa-line-chart fa-lg" aria-hidden="true"></i></h4>
		</div>
		<div class="statistic-bar-box-earn-down">
		<?php echo $this->helper->admin_home_statistics_bar(2);?>
		</div>
		</div>
		
		<!-- End Statistics -->
			
	 </div>
	 </div>
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->
