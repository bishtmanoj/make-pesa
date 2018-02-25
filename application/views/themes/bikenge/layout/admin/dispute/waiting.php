      <div class="head-padding-top"></div>

      <div class="container-fluid">
      <div class="row">
      <div class="col-sm-15 col-md-15 col-md-offset-0">
        <div class="col-sm-4 col-md-4">
		<?php $this->load->view($this->themename.'/layout/admin/globe/sidebar/nav'); ?>
		
        </div><!--/span-->

        <div class="col-sm-8 col-md-8">
		<!-- Dispute center -->
		<div class="well">
		<div class="dispute-well">
		<h5>
		<?php echo $this->lang->line('dispute_center_well_header_h5'); ?>
		</h5>
         
		<div class="row">
		<div class="col-xs-4 col-md-4">
		Dispute waiting
		<h3>
		<a href="<?php echo site_url().'dispute_admin'; ?>">
		<?php echo $this->helper->dispute_status(1); ?>
		</a>
		</h3>
		</div>
		<div class="col-xs-4 col-md-4">
		Dispute Refunded
		<h3>
		<a href="<?php echo site_url().'dispute_admin/type/refund'; ?>">
		<?php echo $this->helper->dispute_status(2); ?>
		</a>
		</h3>
		</div>
		
		<div class="col-xs-4 col-md-4">
		Dispute Canceling
		<h3>
		<a href="<?php echo site_url().'dispute_admin/type/cancel'; ?>">
		<?php echo $this->helper->dispute_status(3); ?>
		</a>
		</h3>
		</div>
		</div>
		</div>
		
		<hr>
		 <?php
        if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
		  '.validation_errors().'
                </div>';
                  
        }
		
		
		// Dispute card failed alert.
      	if ($this->session->payment_card_status) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->session->payment_card_status.'
      			  </div>';
      	}
		
		// Dispute refund failed alert.
      	if ($this->session->dispute_refund_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('dispute_refund_failed').'
      			  </div>';
      	}
		
		// Dispute refund success alert.
      	if ($this->session->dispute_refund_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('dispute_refund_success').'
      			  </div>';
      	}
		
      	?>
		<div class="table-responsive">
		<table class="table table-hover">
    <thead>
      <tr>
        <th>
		Select
		</th>
        <th>
		Date
		</th>
        <th>
		Receiver
		</th>
		<th>
		Sent
		</th>
		<th>
		Transaction ID
		</th>
		<th>
		Action
		</th>
      </tr>
    </thead>
    <tbody>
		<?php foreach($list_dispute_money as $dispute){?>
		<form method="post">
		<tr>
		<td>
		<input type="radio" name="dispute_txn_id" value="<?php echo $dispute->txn_id;?>" id="dispute-<?php echo $dispute->txn_id;?>" required>
		<input type="hidden" name="amount" value="<?php echo $dispute->total;?>" id="amount-<?php echo $dispute->amount;?>">
		<input type="hidden" name="receiver" value="<?php echo $dispute->sender_email;?>" id="receiver-<?php echo $dispute->sender_email;?>">
		</td>
		<td>
		<?php echo date("M d Y", $dispute->date); ?>
		</td>
		
		<td>
		<?php echo $dispute->receiver_name; ?>
		</td>
		<td>
		<?php echo '<p class="payment-right-amount-negative">-'.$this->user->curr_symb.''.$dispute->total.'<p>'; ?>
		</td>
		
		<td>
		<?php echo $dispute->txn_id; ?>
		</td>
		
		<td>
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		<button type="submit" class="dispute-button-claim" name="accept-dispute"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
		<button type="submit" class="dispute-button-claim" name="cancel-dispute"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
		</td>
		</tr>
		</form>
		<?php }?>
		
		</tbody>
  </table>
  </div>
		<!-- End Dispute center -->
		  </div><!--well-->
		  
		<!-- End Dispute transaction -->
		
		
		  </div><!--/span-->
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.container-->