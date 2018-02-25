<div class="head-padding-top"></div>
<div class="container-fluid">
<div class="col-sm-13 col-sm-offset-2 col-md-13 col-md-offset-0">
<div class="row">
		
        <div class="col-sm-4 col-md-4">
		 <?php $this->load->view($this->themename.'/layout/admin/globe/sidebar/nav'); ?>
            </div>
			
			
			<div class="col-sm-8 col-md-8">
			<div class="well">
			<h5>
			<?php echo $this->lang->line('admin_edit_user_add_well_h5');?>
			</h5>
			
			 <?php
          if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
		  '.validation_errors().'
                </div>';
                  
        }
		
		// Edit user failed alert.
      	if ($this->session->edit_user_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('edit_user_failed').'
      			  </div>';
      	}

     	// Edit user success alert.
      	if ($this->session->edit_user_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('edit_user_success').'
      			  </div>';
      	}		
          ?>
		  
			<hr>
          <div class="anmationBlock">
		  <form role="form" method="post">
           <div class="form-group">
            <input type="text" class="form-control" name="first_name" placeholder="<?php echo $this->lang->line('admin_edit_user_form_first_name'); ?>" value="<?php echo $this->userlist->first_name; ?>"/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" name="last_name" placeholder="<?php echo $this->lang->line('admin_edit_user_form_last_name'); ?>" value="<?php echo $this->userlist->last_name; ?>"/>
            </div>
			
			<div class="form-group">
            <select name="country" class="form-control">
			<option><?php echo $this->userlist->country; ?></option>
			<?php echo $this->helper->country_select_option();?>
			</select>
			</div>
			
			<div class="form-group">
            <?php echo $this->lang->line('admin_edit_user_form_account_type'); ?> 
			<?php echo $this->helper->account_status_in_admin($this->userlist->account_type); ?>
            </div>
			<?php if ($this->userlist->account_type == '2'): ?>
			<div class="form-group">
            <input type="text" class="form-control" name="business_name" placeholder="<?php echo $this->lang->line('admin_edit_user_form_business_name'); ?> " value="<?php echo $this->userlist->business_name; ?>"/>
            </div>
			<?php endif; ?>
			
			<div class="form-group">
            <select name="idcard_type" class="form-control">
			<option><?php echo $this->userlist->idcard_type; ?></option>
			<?php echo $this->helper->idcard_type_select_option();?>
			</select>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" name="idcard" placeholder="<?php echo $this->lang->line('admin_edit_user_form_idcard'); ?> " value="<?php echo $this->userlist->idcard; ?>"/>
            </div>
			
			<div class="form-group">
			<div class="row">
			<div class="col-xs-6 col-md-6">
			 <input type="text" class="form-control" autocomplete="off" name="address1"  placeholder="<?php echo $this->lang->line('admin_edit_user_form_address1'); ?>" value="<?php echo $this->userlist->address1; ?>"/>
            </div>
		
			<div class="col-xs-6 col-md-6">
			<input type="text" class="form-control" autocomplete="off" name="address2"  placeholder="<?php echo $this->lang->line('admin_edit_user_form_address2'); ?>" value="<?php echo $this->userlist->address2; ?>"/>
            
			</div>
			</div>
			</div>
			
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off" name="city"  placeholder="<?php echo $this->lang->line('admin_edit_user_form_city'); ?>" value="<?php echo $this->userlist->city; ?>"/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off" name="state"  placeholder="<?php echo $this->lang->line('admin_edit_user_form_state'); ?>" value="<?php echo $this->userlist->state; ?>"/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off" name="postal_code"  placeholder="<?php echo $this->lang->line('admin_edit_user_form_postal_code'); ?>" value="<?php echo $this->userlist->postal_code; ?>"/>
            </div>
			
			<div class="form-group">
            <input type="tel" name="mobile" id="mobile" class="form-control" placeholder="<?php echo $this->lang->line('admin_edit_user_form_mobile'); ?>" value="<?php echo $this->userlist->mobile; ?>"/>
            </div>
			
			<div class="form-group">
			<div class="row">
			<div class="col-xs-6 col-md-6">
			<input type="text" class="form-control" name="email" placeholder="<?php echo $this->lang->line('admin_edit_user_form_email'); ?>" value="<?php echo $this->userlist->email; ?>"/>
            
			</div>
		
			<div class="col-xs-6 col-md-6">
			<select name="currency" class="form-control">
			<?php echo $this->helper->currency_word_select_option();?>
			</select>
			</div>
			</div>
			</div>		
           
		   <hr>
		   
		<!-- Password -->
		<div class="form-group">
		<div class="input-group">
		<span class="input-group-addon" id="text-password"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
		<input type="password" class="form-control" autocomplete="off" name="password"  placeholder="<?php echo $this->lang->line('admin_editt_form_update_password'); ?>" value=""/>
        </div>
		</div>
		
		<hr>
		
		   <!-- Account status -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-4 col-md-4">
		<b><?php echo $this->lang->line('admin_setting_form_account_verified');?></b>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-4 col-md-4">
		<label class="checkbox">
		<input type="checkbox" name="verified" value="1" <?php echo (set_checkbox('verified', '1')) ? set_checkbox('verified', '1') : (($this->userlist->verified == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		
		<!-- End Account status -->
		
		<!-- Send money -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-4 col-md-4">
		<b><?php echo $this->lang->line('admin_setting_form_send_money');?></b>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-4 col-md-4">
		<label class="checkbox">
		<input type="checkbox" name="send_money" value="1" <?php echo (set_checkbox('send_money', '1')) ? set_checkbox('send_money', '1') : (($this->userlist->send_money == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		
		<!-- End send money -->
		
		<!-- Request money -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-4 col-md-4">
		<b><?php echo $this->lang->line('admin_setting_form_request_money');?></b>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-4 col-md-4">
		<label class="checkbox">
		<input type="checkbox" name="request_money" value="1" <?php echo (set_checkbox('request_money', '1')) ? set_checkbox('request_money', '1') : (($this->userlist->request_money == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		
		<!-- End Request money -->
		
		<!-- Deposit -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-4 col-md-4">
		<b><?php echo $this->lang->line('admin_setting_form_deposit_fund');?></b>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-4 col-md-4">
		<label class="checkbox">
		<input type="checkbox" name="add_fund" value="1" <?php echo (set_checkbox('add_fund', '1')) ? set_checkbox('add_fund', '1') : (($this->userlist->add_fund == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		
		<!-- End Deposit -->
		
		<!-- Withdraw -->
		<div class="form-group">
		<div class="row">
		<div class="col-xs-4 col-md-4">
		<b><?php echo $this->lang->line('admin_setting_form_withdraw_fund');?></b>
		</div>
		<div class="col-xs-4 col-md-4">
		<i class="fa fa-arrow-right" aria-hidden="true"></i>
		</div>
		
		<div class="col-xs-4 col-md-4">
		<label class="checkbox">
		<input type="checkbox" name="withdraw_fund" value="1" <?php echo (set_checkbox('withdraw_fund', '1')) ? set_checkbox('withdraw_fund', '1') : (($this->userlist->withdraw_fund == '1') ? 'checked' : ''); ?>>
		<span class="checkbox-slider round"></span>
		</label>
		</div>
		</div>
		</div>
		
		<!-- End Withdraw -->
			
			<div class="form-group">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<button class="btn btn-primary btn-block" type="submit" name="edit-user" id="anmationBKPesa_wait">
			<?php echo $this->lang->line('admin_edit_user_form_submit_button');?>
			</button>
			</div>
		  </form>
		  
		  <hr class="love">
		  <!-- Deposit -->
		  <div class="form-group">
		  <button class="fund-payment-button-submit" data-toggle="collapse" data-target="#deposit">
			<?php echo $this->lang->line('admin_editt_form_add_deposit_button');?>
			</button>
			</div>
			
			
			<!-- Deposit collapse-->
			<div id="deposit" class="panel-collapse collapse">
			<!-- Form -->
			<form method="post">
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off" name="name"  placeholder="<?php echo $this->lang->line('admin_editt_form_add_deposit_bank_name'); ?>" value=""/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off" name="amount"  placeholder="<?php echo $this->lang->line('admin_editt_form_add_deposit_amount'); ?>" value=""/>
            </div>
			
			<div class="form-group">
            <input type="date" class="form-control" autocomplete="off" name="date"  placeholder="<?php echo $this->lang->line('admin_editt_form_add_deposit_date'); ?>" value=""/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off" name="txn_id"  placeholder="<?php echo $this->lang->line('admin_editt_form_add_deposit_transaction_id'); ?>" value=""/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off" name="deposit_by"  placeholder="<?php echo $this->lang->line('admin_editt_form_add_deposit_deposit_by'); ?>" value=""/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off" name="deposit_with"  placeholder="<?php echo $this->lang->line('admin_editt_form_add_deposit_deposit_with'); ?>" value=""/>
            </div>
			
			<div class="form-group">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<input type="hidden" name="email" value="<?php echo $this->userlist->email; ?>">
			<button class="btn btn-primary btn-block" type="submit" name="deposit-fund">
			<?php echo $this->lang->line('admin_editt_form_add_deposit_submit_button');?>
			</button>
			</div>
			</form>
			</div>
			
			<hr class="love">
			
			<!-- Withdraw -->
		  <div class="form-group">
		  <button class="fund-payment-button-submit" data-toggle="collapse" data-target="#withdraw">
			<?php echo $this->lang->line('admin_editt_form_add_withdraw_button');?>
			</button>
			</div>
			
			<!-- Withdraw collapse-->
			<div id="withdraw" class="panel-collapse collapse">
			<form method="post">
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off" name="name"  placeholder="<?php echo $this->lang->line('admin_editt_form_add_withdraw_bank_name'); ?>" value=""/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off" name="amount"  placeholder="<?php echo $this->lang->line('admin_editt_form_add_withdraw_amount'); ?>" value=""/>
            </div>
			
			<div class="form-group">
            <input type="date" class="form-control" autocomplete="off" name="date"  placeholder="<?php echo $this->lang->line('admin_editt_form_add_withdraw_date'); ?>" value=""/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off" name="txn_id"  placeholder="<?php echo $this->lang->line('admin_editt_form_add_withdraw_transaction_id'); ?>" value=""/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off" name="withdraw_by"  placeholder="<?php echo $this->lang->line('admin_editt_form_add_withdraw_withdraw_by'); ?>" value=""/>
            </div>
			
			<div class="form-group">
            <input type="text" class="form-control" autocomplete="off" name="withdraw_with"  placeholder="<?php echo $this->lang->line('admin_editt_form_add_withdraw_withdraw_with'); ?>" value=""/>
            </div>
			
			<div class="form-group">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<input type="hidden" name="email" value="<?php echo $this->userlist->email; ?>">
			<button class="btn btn-primary btn-block" type="submit" name="edit-user">
			<?php echo $this->lang->line('admin_editt_form_add_withdraw_submit_button');?>
			</button>
			</div>
			</form>
			
			</div>
			</div>
		  
		  
          </div> <!-- well -->
              </div>
	 
			</div>
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->