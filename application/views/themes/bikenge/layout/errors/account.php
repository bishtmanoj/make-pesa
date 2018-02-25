<div class="head-padding-top"></div>

      <div class="container-fluid">
      <div class="row">
      <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="well">
         <div class="well-header">
               <center>
			   <i class="fa fa-exclamation-triangle fa-3x" aria-hidden="true"></i>
			   </center>
               <h4 class="text-center"><?php echo $this->lang->line('account_error_h2_desc');?></h4>
			   <hr>
			   <?php if ($this->user->send_money == 0): ?>
			   <h4><i class="fa fa-times-circle-o" aria-hidden="true"></i>
			   <?php echo $this->lang->line('account_error_h2_send_money');?>
			   </h4>
			   <?php endif; ?>
			   <?php if ($this->user->request_money == 0): ?>
			   <h4><i class="fa fa-times-circle-o" aria-hidden="true"></i>
			   <?php echo $this->lang->line('account_error_h2_request_money');?>
			   </h4>
			   <?php endif; ?>
			   <?php if ($this->user->add_fund == 0): ?>
			   <h4><i class="fa fa-times-circle-o" aria-hidden="true"></i>
			   <?php echo $this->lang->line('account_error_h2_deposit_fund');?>
			   </h4>
			   <?php endif; ?>
			   <?php if ($this->user->withdraw_fund == 0): ?>
			   <h4><i class="fa fa-times-circle-o" aria-hidden="true"></i>
			   <?php echo $this->lang->line('account_error_h2_withdraw_fund');?>
			   </h4>
			   <?php endif; ?>
            </div>
	  </div>
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->
