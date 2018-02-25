	 <div class="head-padding-top"></div>
	 <div class="container">
	 <div class="row">
	 <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
	 <div class="transfer-box-select well">
	 <!-- Buyer and seller protection notice -->
	 <div class="transfer-box-lock">
	 <i class="fa fa-shield transfer-box-lock-icon-round fa-2x" aria-hidden="true"></i>
	 <div class="transfer-box-lock-text-top">
	 <?php echo $this->lang->line('transfer_box_lock_text_top_covered');?><a href="#">
	 <?php echo $this->site_settings->site_name; ?> 
	 <?php echo $this->lang->line('transfer_box_lock_text_top_covered_link');?>
	 </a></br>
	 <?php echo $this->lang->line('transfer_box_lock_text_top_covered_down');?>
	 </div>
	 </div>
	 <!-- Pay & Buy button -->
	 <a href="<?php echo site_url().'myaccount/transfer/send'; ?>">
	 <div class="transfer-box-link">
	 <i class="fa fa-money transfer-icon-round fa-lg" aria-hidden="true"></i>
	 <?php echo $this->lang->line('transfer_box_link_pay');?>
	 </div>
	 </a>
	 
	 <div class="transfer-box-space"></div><!--/ For space --/-->
	 
	 <!-- Invoice button -->
	 <!--	
	<a href="#">
	 <div class="transfer-box-link">
	 <i class="fa fa-file-text-o transfer-icon-round fa-lg" aria-hidden="true"></i>
	 <?php echo $this->lang->line('transfer_box_link_invoice');?>
	 </div>
	 </a>
	 -->
      </div>
	  
	  	 
	 <div class="transfer-box-request">
	 <a href="<?php echo site_url().'myaccount/transfer/request'; ?>">
	 <i class="fa fa-user-circle-o transfer-icon-round fa-lg" aria-hidden="true"></i>
	 <?php echo $this->lang->line('transfer_box_request');?>
	 </a>
	 <div class="transfer-box-request-text-notice">
	 <?php echo $this->lang->line('transfer_box_request_notice');?>
	 <a href="#"><?php echo $this->lang->line('transfer_box_request_notice_link');?></a>
	 <?php echo $this->lang->line('transfer_box_request_notice_2');?>
	 </div>
	 </div>
	 
	 <div class="transfer-box-request-space"></div><!--/ For space --/-->
	 
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->
