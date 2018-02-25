	<!-- Panel -->
	<div class="panel panel-default">
		<div class="panel-heading">
		<ul class="nav">
		<li>
		<b><?php echo $this->site_settings->site_name; ?> <?php echo $this->lang->line('summary_sidebar_balance'); ?>
		<a href="<?php echo site_url().'myaccount/activity/'; ?>" class="pull-right"><?php echo $this->lang->line('summary_sidebar_details'); ?>
		<i class="fa fa-angle-right" aria-hidden="true"></i></a></b>
		</li>
		
		</ul>
		</div>
	<div class="panel-body">
            <p class="lead">
			<?php if($this->helper->transaction_balance() == 0.00): ?>
			<p><?php echo $this->lang->line('summary_sidebar_empty_balance'); ?> </p>
			<ul class="nav">
			<li>
			<b><a href="<?php echo site_url().'myaccount/transfer/request/'; ?>" class="request_summary"><?php echo $this->lang->line('summary_sidebar_request_fund'); ?></a>
			<a href="<?php echo site_url().'fund/'; ?>" class="pull-right"><?php echo $this->lang->line('summary_sidebar_add_fund'); ?></a></b>
			</li>
		
		</ul>
			<?php else: ?>
			<?php echo $this->user->curr_symb; ?><?php echo number_format($this->helper->transaction_balance(),2); ?> <?php echo $this->user->curr_word; ?>
			<small><?php echo $this->lang->line('summary_sidebar_available_balance'); ?></small></p>
			
			<ul class="nav">
			<li>
			<b><a href="<?php echo site_url().'fund/withdraw/'; ?>"><?php echo $this->lang->line('summary_sidebar_withdraw_fund'); ?></a>
			<a href="<?php echo site_url().'fund/'; ?>" class="pull-right"><?php echo $this->lang->line('summary_sidebar_add_fund'); ?></a></b>
			</li>
		
		</ul>
			<?php endif; ?>
			
            </div>
	</div>
	<!-- End Panel -->