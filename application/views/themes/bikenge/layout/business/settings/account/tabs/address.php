		<div class="well">
		<h4>
		<?php echo $this->lang->line('settings_account_update_address_well_header_h4'); ?>
		</h4>
		
		<ul class="nav">
		<li>
		<h5>
		<?php echo $this->user->address1; ?>,
		<?php if ($this->user->address2) {?>
		<?php echo $this->user->address2; ?>
		<?php }?>
		</h5>
		</li>
		<li>
		<h5>
		<?php echo $this->user->city; ?>, <?php echo $this->user->state; ?>
		</h5>
		</li>
		<li>
		<h5><?php echo $this->user->postal_code; ?></h5>
		</li>
		<li>
		<p>
		<?php echo $this->lang->line('settings_account_update_address_well_p_default'); ?>
		</p>
		</li>
		<li>
		<a href="#" class="settings-account-address" aria-hidden="true" data-toggle="modal" data-target="#profile-address">
		<?php echo $this->lang->line('settings_account_update_address_well_edit_link'); ?>
		</a>
		</li>
		</ul>
		</div>