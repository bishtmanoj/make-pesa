     <div class="head-padding-top"></div>
      <div class="container-fluid">
      <div class="row">
      <div class="col-sm-15 col-md-15 col-md-offset-1">
	  
        <div class="col-sm-6 col-md-6">
		<div class="well">
		
		<!-- site logo -->
		<div class="checkout-head-well">
		<!-- site name logo -->
		<a href="" class="checkout-head-well-logo" data-toggle="collapse">
		<?php echo $this->site_settings->site_name; ?>
		</a>
		
		<!-- Buy balance -->
		<div class="checkout-head-pay-balance pull-right">
		<i class="fa fa-circle-o-notch fa-spin fa-lg fa-fw"></i>
		<span class="sr-only">Loading...</span>
		<?php echo $this->lang->line('checkout_pay_complete_done_redirect_i'); ?>
		</div>
		</div>
		
		<?php
          
		// Balance checkout failed alert.
      	if ($this->session->payment_card_status) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->session->payment_card_status.'
      			  </div>';
				  
		}
          ?>
		
		
		
		<!-- Payment done -->
		<div class="checkout-complete-done">
		<i class="fa fa-check fa-2x" aria-hidden="true"></i>
		<h4>
		<?php echo $this->lang->line('checkout_pay_complete'); ?>
		</h4>
		<p>
		<?php echo $this->lang->line('checkout_pay_complete_done_redirect_notice'); ?>
		</p>
		</div>
		</div><!--/span-->
		</div><!-- well -->
		
		<!-- Right side -->
		<div class="col-sm-5 col-md-5 visible-mobile">
		<div class="well">
		<div class="checkout-right-well">
		<i class="fa fa-shopping-bag fa-3x" aria-hidden="true"></i>
		<h4>
		<?php echo $this->lang->line('checkout_pay_right_sedebar_faster_pay'); ?>
		</h4>
		<p>
		<?php echo $this->lang->line('checkout_pay_right_sedebar_stay_pay'); ?>
		</p>
		</div>
		</div><!-- span -->
		</div><!-- well -->
		<!-- End Right -->
		
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.container-->