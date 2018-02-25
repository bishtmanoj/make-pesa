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
		
		// Signin failed alert.
      	if ($this->session->checkout_signin_delete_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('checkout_account_inactive_account').'
      			  </div>';
      	}

		// Checkout No balance alert.
      	if ($this->session->checkout_pay_no_balance) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('checkout_pay_no_balance').'
      			  </div>';
      	}
		
		// Balance checkout failed alert.
      	if ($this->session->checkout_pay_balance_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('checkout_pay_balance_failed').'
      			  </div>';
				  
		}
      	
		// Balance checkout failed alert.
      	if ($this->session->payment_card_status) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->session->payment_card_status.'
      			  </div>';
				  
		}
          ?>
		
		
		<h5>
		<?php echo $this->lang->line('checkout_pay_head_send_to'); ?>
		</h5>
		<!-- Receiver summary -->
		<?php $this->load->view($this->themename.'/layout/checkout/pay/details'); ?>
		<!-- form -->
		 <form method="post" id="checkout-pay">
		 <!-- Pay with Balance -->
		 <div class="fund-payment-block">
		 <div class="fund-payment-select">
		  <div class="fund-payment-select-primary">
            <input type="radio" name="pay_with" id="balance" value="balance" required>
            <label for="balance">
		 <?php echo $this->lang->line('checkout_pay_form_balance_select_drop'); ?>
		  <h4>
		  <?php echo $this->user->curr_symb; ?><?php echo number_format($this->helper->transaction_balance(),2); ?> <?php echo $this->user->curr_word; ?>
		  </h4>
		  </label>
		  </div>
		  </div>
		  </div>
		  

		 <?php if ($this->site_settings->stripe_accept){ ?>		 
		 <!-- Pay with Card -->
		  <div class="fund-payment-block" role="tab" data-toggle="collapse" data-parent="#accordion" href="#show-cards" aria-expanded="true" aria-controls="show-cards">
		 <div class="fund-payment-select">
		  <div class="fund-payment-select-primary">
		 <?php echo $this->lang->line('checkout_pay_form_card_select_drop'); ?>
		  </div>
		  </div>
		  </div>
		  <?php }?>
		  
		<?php if ($this->site_settings->stripe_accept){ ?>
		<!-- Show cards -->
		<?php $this->load->view($this->themename.'/layout/checkout/pay/card'); ?>
		<?php }?>
		
		<div class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn-primary btn-block" type="submit" name="checkout-pay"><?php echo $this->lang->line('checkout_pay_form_submit_button');?></button>
      </div>
	  </form>
		<!-- End Signin -->
		
		</div><!--/span-->
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