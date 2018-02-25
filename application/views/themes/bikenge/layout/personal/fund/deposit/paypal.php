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
		<div class="well">
		<h5>
		<?php echo $this->lang->line('fund_deposit_paypal_well_header_h5'); ?>
		</h5>
		
		<?php

        if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                  '.validation_errors().'
                </div>';
                  
        }

		// Fund add cancel alert.
      	if ($this->session->fund_other_deposit_cancel) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('fund_other_deposit_cancel').'
      			  </div>';
      	}

		 // Fund add success alert.
      	if ($this->session->fund_other_deposit_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
      			  	<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      				  '.$this->lang->line('fund_other_deposit_success').'
      			  </div>';
      	}
		
  	    ?>
		
		<!-- Form Mobile -->
		<div class="fund-payment-card">
		 <!-- Form of payment -->
		  <form action="<?php echo $paypal_url_live; ?>" method="post">
		  <label><?php echo $this->lang->line('fund_add_amount_form_label_need'); ?></label>
		<div class="form-group">
		<div class="input-group">
		<span class="input-group-addon" id="text-amount"><?php echo $this->user->curr_word; ?></span>
		<input type="text" name="amount" class="form-control" value="" placeholder="amount">
		</div>
		
		</div>
		
		<div class="fund-payment-padding">
		<div class="fund-paymet-mobile">
		  <div class="form-group">
		  </div>
		  <h3>
		  <i class="pf pf-paypal pf-lg" aria-hidden="true"></i>
		  </h3>
		  <p></p>
		  </div>
		  </div>
          
          <div class="form-group">
		  <!-- Identify your business so that you can collect the payments. -->
        <input type="hidden" name="business" value="<?php echo $this->site_settings->paypal_email; ?>">
        
        <!-- Specify a Buy Now button. -->
        <input type="hidden" name="cmd" value="_xclick">
        
        <!-- Specify details about the item that buyers will purchase. -->
        <input type="hidden" name="item_name" value="Fund deposit - <?php echo $this->session->email; ?>">
        <input type="hidden" name="item_number" value="<?php echo $this->session->id; ?>">
		<input type="hidden" name="custom" value="<?php echo $this->session->email; ?>">
        <input type="hidden" name="currency_code" value="<?php echo $this->user->curr_word; ?>">
        
        <!-- Specify URLs -->
        <input type='hidden' name='cancel_return' value='<?php echo $paypal_url_cancel; ?>'>
		<input type='hidden' name='return' value='<?php echo $paypal_url_return; ?>'>
		<input type='hidden' name='notify_url' value='<?php echo $paypal_url_ipn; ?>'>

          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <button type="submit" class="fund-payment-button-submit" name="fund-add-bank">
			<?php echo $this->lang->line('fund_add_mobile_form_submit_button'); ?>
			</button>
          </div>
        </form>

		  <!-- End Form -->
		
		</div>
		<!-- End form -->
		</div>
		  </div><!--/span-->
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.container-->