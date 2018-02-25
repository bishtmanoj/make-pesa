<nav class="navbar navbar-fixed-top" id="nav_header">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <i class="fa fa-bars" aria-hidden="true"> <?php echo $this->lang->line('navbar_toggle_menu'); ?></i>
          </button>
          <a class="navbar-brand" href="<?php echo site_url(); ?>"><?php echo $this->site_settings->site_name; ?></a>
        </div>
		
		
        <div id="navbar" class="collapse navbar-collapse">
		<?php if ($this->helper->user_islogin()):?>
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
        <a href="<?php echo site_url().'page/help/'; ?>"><?php echo $this->lang->line('navbar_left_help'); ?></a>
        </li>
          </ul>
		  <!-- Right Nav -->
		  
		 
		  
		  <ul class="nav navbar-nav pull-right">
		  
        <li>
		  <a href="<?php echo site_url().'myaccount/logout'; ?>">LOG OUT</a>
		  
          </li>
          </ul>
		  <!-- Right for icon -->
		   <ul class="nav navbar-nav pull-right">
		  <li>
		  <a href="<?php echo site_url().'myaccount/settings/'; ?>" class="pull-left navbar-nav-settings">
		  <i class="fa fa-cog fa-lg" aria-hidden="true"></i>
		  </a>
		  </li>
          </ul>
		  <?php endif; ?>
        </div><!-- /.nav-collapse -->
		
		
      </div><!-- /.container -->
    </nav><!-- /.navbar -->