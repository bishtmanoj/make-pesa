      <div class="head-padding-top"></div>

      <div class="container-fluid">
      <div class="row">
      <div class="col-md-12">

	  <!-- Search transaction -->
	  <div class="well-header">
			<!-- Form search -->
			<div class="row">
			<form method="GET" class="form-horizontal">
			<div class="col-xs-2 col-md-3 visible">
			<div class="input-group input-group-lg">
		<span class="input-group-addon activity-date-start-addon" id="start"><i class="fa fa-calendar" aria-hidden="true"></i></span>
		<input type="date" class="form-control activity-date-start-search-input" name="start" value="<?php
                                   if (!empty($this->input->get('start', TRUE))) {
                                       echo $this->input->get('start', TRUE);
                                   }
                                   ?>">
		</div>
			</div>
		
		<div class="col-xs-2 col-md-3 visible">
		<div class="input-group input-group-lg activity-inputend-icon">
		
		<input type="date" class="form-control activity-date-end-search-input" name="end" value="<?php
                                   if (!empty($this->input->get('end', TRUE))) {
                                       echo $this->input->get('end', TRUE);
                                   }
                                   ?>">
		<span class="input-group-addon activity-date-end-addon" id="end"><i class="fa fa-calendar" aria-hidden="true"></i></span>
		</div>
		</div>
			<div class="col-xs-6 col-md-6">
			<div class="input-group input-group-lg">
			<input type="text" name="transaction" class="form-control activity-search-input" placeholder="<?php echo $this->lang->line('activity_form_serach_bar_placeholder'); ?>" value="<?php
                                   if (!empty($this->input->get('transaction', TRUE))) {
                                       echo $this->input->get('transaction', TRUE);
                                   }
                                   ?>">
			<span class="input-group-btn">
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
		  <?php echo $this->lang->line('activity_head_h5_completed'); ?>
			<i class="fa fa-clock-o fa-lg pull-right" aria-hidden="true"></i>
			</strong>
			</h5>
			<hr>
			
			<!-- Hidden most out panel -->
	  <?php $this->load->view($this->themename.'/layout/personal/activity/transaction'); ?>
	  <!-- End -->
	 
			</div>
			</div>
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.container-->