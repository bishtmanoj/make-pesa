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
		<h4>
		<a href="#show-item" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="show-item">
		<i class="fa fa-shopping-cart" aria-hidden="true"></i>  <?php echo ''.$this->helper->currency_symbol_select_option($this->session->curr).''.$this->session->amount.' '.$this->session->curr.''; ?>
		<i class="fa fa-angle-down" aria-hidden="true" ></i>
		</a>
		</h4>
		</div>
		</div>
		
		 <!-- Show item -->
		<?php $this->load->view($this->themename.'/layout/checkout/pay/item-name'); ?>
		<!-- End item -->
		
		
		<?php
          if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
		  '.validation_errors().'
                </div>';
                  
        }
		
		// Card status alert.
      	if ($this->session->payment_card_status) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->session->payment_card_status.'
      			  </div>';
      	}

      	// Card status alert.
      	if ($this->session->payment_card_send_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('payment_card_send_failed').'
      			  </div>';
      	}			
          ?>
		  
		<h5>
		<?php echo $this->lang->line('checkout_card_head_pay_with_card_guest'); ?>
		</h5>
		<a class="btn btn-info btn-block" href="#card" data-toggle="collapse"><?php echo $this->lang->line('checkout_card_head_international_card_guest'); ?></a>
		<!-- Show cards -->
		<?php $this->load->view($this->themename.'/layout/checkout/card/card'); ?>
		<hr>
		<?php if ($user->business_name): ?>
		<a class="load btn btn-primary btn-block" href="<?php echo site_url('checkout/pay'); ?>"><?php echo $this->lang->line('checkout_card_head_other_method'); ?></a>
		<?php else: ?>
		
		<a class="load btn btn-primary btn-block" href="<?php echo site_url('checkout/signin'); ?>"><?php echo $this->lang->line('checkout_card_head_back_signin'); ?></a>
		<?php endif; ?>
		</div>
		<!-- Cancel Link -->
		<?php if ($this->session->cancel_url): ?>
		<!-- Left -->
		<a class="checkout-return-link" href="<?php echo $this->session->cancel_url; ?>">
		<?php echo $this->lang->line('checkout_sign_form_cancel_and_return'); ?>
		
		<?php if ($user->business_name): ?>
		<?php echo $user->business_name; ?>
		<?php else: ?>
		<?php echo $user->full_name; ?>
		<?php endif; ?>
		</a>
		  <?php else: ?>
		<!-- Left -->
		<a class="checkout-return-link" href="<?php echo site_url(); ?>">
		<?php echo $this->lang->line('checkout_sign_form_cancel_and_return'); ?>
		<?php echo $this->site_settings->site_name; ?>
		</a>
		  <?php endif; ?>
		  
		</div><!-- well -->
		
		<!-- Right side -->
		<div class="col-sm-5 col-md-5 visible-mobile">
		<div class="well">
		<div class="checkout-right-well">
		<i class="fa fa-credit-card-alt fa-2x" aria-hidden="true"></i>
		<h4>
		<?php echo $this->lang->line('checkout_sign_right_sedebar_faster_pay'); ?>
		</h4>
		<p>
		<?php echo $this->lang->line('checkout_sign_right_sedebar_stay_pay'); ?>
		</p>
		</div>
		</div><!-- span -->
		</div><!-- well -->
		<!-- End Right -->
		
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.container-->
	