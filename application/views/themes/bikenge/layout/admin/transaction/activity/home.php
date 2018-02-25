<div class="head-padding-top"></div>
<div class="container-fluid">
<div class="col-sm-13 col-sm-offset-2 col-md-13 col-md-offset-0">
<div class="row">
      <div class="col-sm-4 col-md-4">
		 <?php $this->load->view($this->themename.'/layout/admin/globe/sidebar/nav'); ?>
            </div>
			
			
			<div class="col-sm-8 col-md-8">

	  <!-- Search transaction -->
	  <div class="well-header">
			<!-- Form search -->
			<div class="row">
			<form method="get" class="form-horizontal" role="form">
			<div class="col-xs-12 col-md-12">
			<div class="input-group input-group-lg">
			<input type="text" name="transaction" class="form-control activity-search-input" placeholder="Search activities">
			<span class="input-group-btn">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<button class="btn btn-default activity-search-btn" type="submit">
			<i class="fa fa-search activity-search-icon" aria-hidden="true"></i>
			</button>
			</span>
			</div><!-- /input-group -->
			</div><!-- /.col-lg-6 -->
			</div><!-- /.row -->
			</form>
	  <!-- Form End -->
	  </div>
	  <!-- End search -->
	  <div class="activity-search-box-padding"></div>
          <div class="well">
		  <h5><strong>
		  <?php echo $this->lang->line('admin_payment_page_all_head_h5_completed'); ?>
			<i class="fa fa-clock-o fa-lg pull-right" aria-hidden="true"></i>
			</strong>
			</h5>
			<hr>
			
			<!-- Hidden most out panel -->
	  <?php $this->load->view($this->themename.'/layout/admin/transaction/activity/transaction'); ?>
	  <!-- End -->
	 
			</div>
			</div>
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.container-->