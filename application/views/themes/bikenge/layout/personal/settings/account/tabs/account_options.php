		<div class="well">
		<h4>
		<?php echo $this->lang->line('settings_account__options_well_h4'); ?>
		</h4>
		
		<ul class="nav settings-account-nav">
		<li>
		<?php echo $this->lang->line('settings_account__options_ul_li_nationality'); ?>
		<p class="settings-account-nav-p-padding"><?php echo $this->user->country; ?></p></li>
		<li>
		<?php echo $this->lang->line('settings_account__options_ul_li_merchant_id'); ?>
		<p><?php echo $this->user->merchant_id; ?></p></li>
		<li>
		<?php echo $this->lang->line('settings_account__options_ul_li_national_id'); ?>
		<p class="settings-account-nav-p-padding"><?php echo $this->user->idcard; ?></p>
		<i class="fa fa-pencil-square-o fa-lg settings-account-nav-edit" aria-hidden="true" data-toggle="modal" data-target="#profile-idcard"></i>
		</li>
		</ul>
		</div>