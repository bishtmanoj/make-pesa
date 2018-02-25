<nav class="navbar navbar-fixed-top" id="nav_header">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <i class="fa fa-bars" aria-hidden="true"> Menu</i>
          </button>
          <a class="navbar-brand" href="<?php echo site_url(); ?>"><?php echo $this->site_settings->site_name; ?></a>
        </div>
		
		
        <div id="navbar" class="collapse navbar-collapse">
		<?php if (!$this->helper->user_islogin()):?>
		<!-- Left Nav -->
		<ul class="nav navbar-nav pull-right">
            <li>
        <a href="<?php echo site_url().'myaccount/signin/'; ?>"><?php echo $this->lang->line('welcome_home_navbar_right_my_account'); ?></a>
        </li>
        <li>
        <a href="<?php echo site_url().'signup/'; ?>"><?php echo $this->lang->line('welcome_home_navbar_right_create_account'); ?></a>
        </li>
          </ul>
		  <?php else: ?>
		  <!-- Left Nav -->
		<ul class="nav navbar-nav">
          <li>
        <a href="<?php echo site_url().'myaccount/'; ?>"><?php echo $this->lang->line('navbar_left_summary'); ?></a>
        </li>
        <li>
        <a href="<?php echo site_url().'myaccount/activity/'; ?>"><?php echo $this->lang->line('navbar_left_activity'); ?></a>
        </li>
        <li>
        <a href="<?php echo site_url().'myaccount/transfer/'; ?>"><?php echo $this->lang->line('navbar_left_send'); ?></a>
        </li>
        <li>
        <a href="<?php echo site_url().'myaccount/wallet/'; ?>"><?php echo $this->lang->line('navbar_left_wallet'); ?></a>
        </li>
		<li>
        <a href="<?php echo site_url().'page/voucher/'; ?>"><?php echo $this->lang->line('navbar_left_voucher'); ?></a>
        </li>
		<li>
        <a href="<?php echo site_url().'page/help/'; ?>"><?php echo $this->lang->line('navbar_left_help'); ?></a>
        </li>
          </ul>
		  <!-- Right Nav -->
		  <ul class="nav navbar-nav pull-right">
        <li>
		  <a href="<?php echo site_url().'myaccount/logout'; ?>" class="linkload">LOG OUT</a>
		  
          </li>
          </ul>
		  <?php endif; ?>
        </div><!-- /.nav-collapse -->
		
		
      </div><!-- /.container -->
    </nav><!-- /.navbar -->