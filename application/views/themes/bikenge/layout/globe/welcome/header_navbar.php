<nav class="navbar navbar-fixed-top" id="nav_header">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <i class="fa fa-bars" aria-hidden="true"> Menu</i>
          </button>
          <a class="navbar-brand" href="<?php echo site_url(); ?>"><?php echo $this->site_settings->site_name; ?></a>
        </div>
		
		
        <div id="navbar" class="collapse navbar-collapse">
		  <!-- Left Nav -->
		<div class="welcome-nav">
		<ul class="nav navbar-nav">
		<?php if (!$this->helper->user_islogin()):?>
		 <li>
        <a href="<?php echo site_url().'page/personal'; ?>"><?php echo $this->lang->line('welcome_home_navbar_center_personal'); ?></a>
        </li>
          <li>
        <a href="<?php echo site_url().'page/business'; ?>"><?php echo $this->lang->line('welcome_home_navbar_center_business'); ?></a>
        </li>
		<?php endif; ?>
       <li>
        <a href="<?php echo site_url().'page/developer'; ?>"><?php echo $this->lang->line('welcome_home_navbar_center_developer'); ?></a>
        </li>
		
		<li>
        <a href="<?php echo site_url().'page/mobile'; ?>"><?php echo $this->lang->line('welcome_home_navbar_center_mobile_money'); ?></a>
        </li>
		</ul>
		</div>
		<?php if (!$this->helper->user_islogin()):?>
		  <!-- Right Nav -->
		  <ul class="nav navbar-nav pull-right">
            <li>
        <a href="<?php echo site_url().'myaccount/signin/'; ?>">
		<?php echo $this->lang->line('welcome_home_navbar_right_my_account'); ?>
		</a>
        </li>
        <li>
        <a href="<?php echo site_url().'signup/'; ?>">
		<?php echo $this->lang->line('welcome_home_navbar_right_create_account'); ?>
		</a>
        </li>
          </ul>
		  <?php else: ?>
		  <ul class="nav navbar-nav pull-right">
		  <li>
		  <a href="<?php echo site_url().'myaccount/'; ?>">
		  <?php echo $this->lang->line('welcome_home_navbar_right_my_account'); ?>
		  </a>
        </li>
        <li>
        <a href="<?php echo site_url().'signup/'; ?>">
		<?php echo $this->lang->line('welcome_home_navbar_right_logout'); ?>
		</a>
        </li>
          </ul>
		  <?php endif; ?>
        </div><!-- /.nav-collapse -->
		
		
      </div><!-- /.container -->
    </nav><!-- /.navbar -->