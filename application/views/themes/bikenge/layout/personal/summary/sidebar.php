
				<!-- Panel one -->
	<div class="panel panel-default">
		<div class="panel-heading">
		<ul class="nav">
		<li>
		<b><?php echo $this->site_settings->site_name; ?> <?php echo $this->lang->line('summary_sidebar_balance'); ?>
		<a href="<?php echo site_url().'myaccount/activity/'; ?>" class="pull-right">Details <i class="fa fa-angle-right" aria-hidden="true"></i></a></b>
		</li>
		
		</ul>
		</div>
	<div class="panel-body">
            <p class="lead">
			<?php if($this->helper->transaction_balance() == 0.00): ?>
			<p><?php echo $this->lang->line('summary_sidebar_empty_balance'); ?> </p>
			<ul class="nav">
			<li><?php echo $this->helper->dispute_problem(); ?>
			</li>
			<li>
			<b><a href="<?php echo site_url().'myaccount/transfer/request'; ?>" class="request_summary"><?php echo $this->lang->line('summary_sidebar_request_fund'); ?></a>
			<a href="<?php echo site_url().'fund/'; ?>" class="pull-right"><?php echo $this->lang->line('summary_sidebar_add_fund'); ?></a></b>
			</li>
		
		</ul>
			<?php else: ?>
			<?php echo $this->user->curr_symb; ?><?php echo number_format($this->helper->transaction_balance(),2); ?> <?php echo $this->user->curr_word; ?>
			<small><?php echo $this->lang->line('summary_sidebar_available_balance'); ?></small></p>
			
			<ul class="nav">
			<li><?php echo $this->helper->dispute_problem(); ?>
			</li>
			<li>
			<b><a href="<?php echo site_url().'fund/withdraw/'; ?>"><?php echo $this->lang->line('summary_sidebar_withdraw_fund'); ?></a>
			<a href="<?php echo site_url().'fund/'; ?>" class="pull-right"><?php echo $this->lang->line('summary_sidebar_add_fund'); ?></a></b>
			</li>
		
		</ul>
			<?php endif; ?>
			
            </div>
	</div>
	
	<!-- Panel two -->
	<div class="panel panel-default">
		<div class="panel-heading">
		<ul class="nav">
		<li>
		<b><?php echo $this->lang->line('summary_sidebar_bankcard_title'); ?></b>
		</li>
		
		</ul>
		</div>
	<div class="panel-body">
	
	<table class="table">
    <thead>
    </thead>
    <tbody>
	<?php foreach($list_card as $card){?>
	<tr>
	<td>
	<?php echo $this->helper->card_type_icon(''.$card->card_type.'');?>
	<?php 
	echo str_pad(substr($card->number, -4), strlen($card->number), '*', STR_PAD_LEFT);?></td>
	</tr>
  
	<?php }?>
	</table>
	
	<table class="table">
    <thead>
    </thead>
    <tbody>
	<?php foreach($list_bank as $bank){?>
	<tr>
	<td><i class="fa fa-university fa-lg" aria-hidden="true"></i> 
	<?php echo $bank->bankname;?>  
	<?php echo str_pad(substr($bank->acno, -4), strlen($bank->acno), '*', STR_PAD_LEFT);?>
	</td>
	</tr>
  
	<?php }?>
	</table>
	<?php if ($sumcardbank_yesno+$sumbankac_yesno) {?>
			<ul class="nav">
		<li>
		<?php echo $this->lang->line('summary_sidebar_bankcard_update_note'); ?>
		<b><a href="<?php echo site_url().'myaccount/wallet/'; ?>"><?php echo $this->lang->line('summary_sidebar_bankcard_link_wallet'); ?></a></b>
		</li>
	<?php } else {?>
	<p><?php echo $this->lang->line('summary_sidebar_bankcard_notes'); ?></p>
			<ul class="nav">
		<li>
		<b><a class="btn add-bank-card-button" href="<?php echo site_url().'myaccount/wallet/'; ?>"><?php echo $this->lang->line('summary_sidebar_bankcard_link'); ?></a></b>
		</li>
	<?php }?>
            
		
		</ul>
            </div>
	</div>

	<!-- Panel three -->
	<!-- Soon it come 
	<div class="panel panel-default">
		<div class="panel-heading">
		<ul class="nav">
		<li>
		<b>Selling tools</b>
		</li>
		
		</ul>
		</div>
	<div class="panel-body">
			<ul class="nav">
		<li>
		<b>
		<a href="<?php echo site_url().'user/seller/'; ?>">Seller preferences</a></b>
		</li>
		
		</ul>
            </div>
	</div>-->
	<!-- End Panel -->