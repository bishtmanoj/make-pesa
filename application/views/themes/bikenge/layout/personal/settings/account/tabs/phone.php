		<div class="well">
		<h4>
		<?php echo $this->lang->line('settings_account_update_phone_well_header_h4'); ?>
		<!--<i class="fa fa-pencil-square-o fa-lg pull-right" aria-hidden="true" data-toggle="modal" data-target="#test"></i>
		-->
		</h4>
		
		<ul class="nav">
		<li>
		<h5>
		<?php echo str_pad(substr($this->user->mobile, 4), strlen($this->user->mobile), '*', STR_PAD_RIGHT);?>
		</h5>
		</li>
		<li>
		<p>
		<?php echo $this->lang->line('settings_account_update_phone_well_p_default'); ?>
		</p>
		</li>
		</ul>
		</div>