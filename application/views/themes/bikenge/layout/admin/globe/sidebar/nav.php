   <div class="well">
	<center>
    <img src="<?php echo site_url().'assets/images/login.png'; ?>" class="img-thumbnail img-circle img-responsive" height="80px;" width="80px;">
	</center>
    <h4 class="text-center"><?php echo $this->lang->line('admin_sidebar_h2_desc');?> (V1.3)</h4>
			      
	</div>
			<!-- List Group menu -->   
		 <div class="list-group">
        <span href="#" class="list-group-item active">
            <?php echo $this->lang->line('admin_sidebar_list_group_manage_notice');?>
        </span>
        <a href="#setting" class="list-group-item" data-toggle="collapse">
            <i class="fa fa-cogs"></i> <?php echo $this->lang->line('admin_sidebar_list_group_setting');?>
        </a>
		
		<!-- Setting link collapse -->
		<div id="setting" class="panel-collapse collapse">
		<a href="<?php echo site_url().'admin/setting'; ?>" class="list-group-item">
            <i class="fa fa-chevron-right"></i> <?php echo $this->lang->line('admin_sidebar_list_group_collapse_setting_general');?>
        </a>
		<a href="<?php echo site_url().'admin/setting/notification'; ?>" class="list-group-item">
            <i class="fa fa-bell"></i> <?php echo $this->lang->line('admin_sidebar_list_group_setting_notification');?>
        </a>
		<a href="<?php echo site_url().'admin/setting/payment'; ?>" class="list-group-item">
            <i class="fa fa-credit-card-alt"></i> <?php echo $this->lang->line('admin_sidebar_list_group_setting_payment');?>
        </a>
		<a href="<?php echo site_url().'admin/setting/secure'; ?>" class="list-group-item">
            <i class="fa fa-shield"></i> <?php echo $this->lang->line('admin_sidebar_list_group_setting_secure');?>
        </a>
		</div>
		<!-- End Setting collapse -->
		
        <a href="#user" class="list-group-item" data-toggle="collapse">
            <i class="fa fa-user-circle-o"></i> <?php echo $this->lang->line('admin_sidebar_list_group_manage');?> <span class="badge"><?php echo $this->user_total_count; ?></span>
        </a>
        
		<!-- User link collapse -->
		<div id="user" class="panel-collapse collapse">
		<a href="<?php echo site_url().'admin/manage'; ?>" class="list-group-item">
            <i class="fa fa-chevron-right"></i> <?php echo $this->lang->line('admin_sidebar_list_group_collapse_all_user');?>
        </a>
		
		<a href="<?php echo site_url().'admin/adduser/select'; ?>" class="list-group-item">
            <i class="fa fa-chevron-right"></i> <?php echo $this->lang->line('admin_sidebar_list_group_collapse_add');?>
        </a>
		</div>
		<!-- End User collapse -->
		
		<a href="#payment" class="list-group-item" data-toggle="collapse">
            <i class="fa fa-bar-chart"></i> <?php echo $this->lang->line('admin_sidebar_list_group_manage_transaction');?>
        </a>
		<!-- Payment link collapse -->
		<div id="payment" class="panel-collapse collapse">
		<a href="<?php echo site_url().'admin/payment/all'; ?>" class="list-group-item">
            <i class="fa fa-chevron-right"></i> <?php echo $this->lang->line('admin_sidebar_list_group_manage_transaction_collapse_all');?>
		</a>
		
		<a href="<?php echo site_url().'admin/payment/add'; ?>" class="list-group-item">
            <i class="fa fa-chevron-right"></i> <?php echo $this->lang->line('admin_sidebar_list_group_manage_transaction_collapse_add');?>
		</a>
		</div>
		<!-- End Payment collapse -->
		
		<a href="#fees" class="list-group-item" data-toggle="collapse">
            <i class="fa fa-bar-chart"></i> <?php echo $this->lang->line('admin_sidebar_list_group_manage_fees');?>
        </a>
		<!-- Fees link collapse -->
		<div id="fees" class="panel-collapse collapse">
		<a href="<?php echo site_url().'admin/fees/deposit'; ?>" class="list-group-item">
            <i class="fa fa-chevron-right"></i> <?php echo $this->lang->line('admin_sidebar_list_group_collapse_deposit');?>
		</a>
		
		<a href="<?php echo site_url().'admin/fees/withdraw'; ?>" class="list-group-item">
            <i class="fa fa-chevron-right"></i> <?php echo $this->lang->line('admin_sidebar_list_group_collapse_withdraw');?>
		</a>
		
		</div>
		<!-- End Fees collapse -->
		
		<a href="#method" class="list-group-item" data-toggle="collapse">
            <i class="fa fa-bar-chart"></i> <?php echo $this->lang->line('admin_sidebar_list_group_Payment_method');?>
        </a>
		
		<!-- Method link collapse -->
		<div id="method" class="panel-collapse collapse">
		<a href="<?php echo site_url().'admin/method/deposit'; ?>" class="list-group-item">
            <i class="fa fa-chevron-right"></i> <?php echo $this->lang->line('admin_sidebar_list_group_method_collapse_deposit');?>
		</a>
		
		<a href="<?php echo site_url().'admin/method/withdraw'; ?>" class="list-group-item">
            <i class="fa fa-chevron-right"></i> <?php echo $this->lang->line('admin_sidebar_list_group_method_collapse_withdraw');?>
		</a>
		</div>
		<!-- End Method collapse -->
		
		<a href="<?php echo site_url().'admin/pending/deposit'; ?>" class="list-group-item">
            <i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('admin_sidebar_list_group_pending_deposit');?>
			<span class="badge"><?php echo $this->pending_deposit_total_count; ?></span>
        </a>
		
		<a href="<?php echo site_url().'admin/pending/withdraw'; ?>" class="list-group-item">
            <i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('admin_sidebar_list_group_pending_withdraw');?>
			<span class="badge"><?php echo $this->pending_withdrawal_total_count; ?></span>
        </a>
		
		<a href="<?php echo site_url().'admin/verification'; ?>" class="list-group-item">
            <i class="fa fa-id-card-o"></i> <?php echo $this->lang->line('admin_sidebar_list_group_pending_verification');?>
			<span class="badge"><?php echo $this->pending_verification_total_count; ?></span>
        </a>
		
		
		<a href="<?php echo site_url().'dispute_admin'; ?>" class="list-group-item">
            <i class="fa fa-exclamation-circle"></i> <?php echo $this->lang->line('admin_sidebar_list_group_dispute');?>
            <span class="badge"><?php echo $this->helper->dispute_status(1); ?></span>
		</a>
    </div> 
	
			   