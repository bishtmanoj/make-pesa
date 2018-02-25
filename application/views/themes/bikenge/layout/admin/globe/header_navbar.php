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
		  <?php else: ?>
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