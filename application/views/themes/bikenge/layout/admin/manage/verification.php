<div class="head-padding-top"></div>
<div class="container">
<div class="row">
<div class="col-sm-13 col-sm-offset-2 col-md-13 col-md-offset-0">
<div class="row">
		
        <div class="col-sm-4 col-md-4">
		 <?php $this->load->view($this->themename.'/layout/admin/globe/sidebar/nav'); ?>
            </div>
			
			
			<div class="col-sm-8 col-md-8">
			<div class="well">
			<h5>
			<?php echo $this->lang->line('admin_verification_h5_well');?>
			<i class="fa fa-chevron-down" aria-hidden="true"></i>
			</h5>
			<hr>
			<div class="well-header">
             <?php

		// Verification failed alert.
      	if ($this->session->verification_approval_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('verification_approval_failed').'
      			  </div>';
      	}
		// Verification account failed alert.
      	if ($this->session->verification_account_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('verification_account_failed').'
      			  </div>';
      	}
      	// Verification success alert
      	if ($this->session->verification_approval_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('verification_approval_success').'
      			  </div>';
      	}
		
		// Verification cancel failed alert.
      	if ($this->session->verification_cancel_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('verification_cancel_failed').'
      			  </div>';
      	}
      	// Verification cancel alert
      	if ($this->session->verification_cancel_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('verification_cancel_success').'
      			  </div>';
      	}
		
      	?>
	  </div>
	  
	  <div class="table-responsive">
	  <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th>#</th>
                    <th><?php echo $this->lang->line('admin_search_table_th_name');?></th>
                    <th><?php echo $this->lang->line('admin_search_table_th_email');?></th>
					<th><?php echo $this->lang->line('admin_search_table_th_document_type');?></th>
					<th><?php echo $this->lang->line('admin_search_table_th_account');?></th>
					<th><?php echo $this->lang->line('admin_search_table_th_action');?></th>
                    </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < count($userlist); ++$i) { ?>
                <tr>
                    <td><?php echo ($page+$i+1); ?></td>
                    <td><?php echo $userlist[$i]->name; ?></td>
                    <td><?php echo $userlist[$i]->email; ?></td>
					<td><?php echo $userlist[$i]->card_type; ?></td>
					<td><?php echo $userlist[$i]->account_type; ?></td>
					<td>
					<form method="post">
					<?php if ($userlist[$i]->file) {?>
					<a href="<?php echo base_url(). "/".$userlist[$i]->file.""; ?>"><i class="fa fa-cloud-download" aria-hidden="true"></i></a>
					<?php }?>
					<a href="<?php echo base_url(). "/admin/edit?id=".$userlist[$i]->userid.""; ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
					<input type="hidden" name="id" value="<?php echo $userlist[$i]->id;?>">
					<input type="hidden" name="card" value="<?php echo $userlist[$i]->card;?>">
					<input type="hidden" name="userid" value="<?php echo $userlist[$i]->userid;?>">
					<input type="hidden" name="email" value="<?php echo $userlist[$i]->email;?>">
					<input type="hidden" name="mobile" value="<?php echo $userlist[$i]->mobile;?>">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					<button type="submit" class="btn-link" name="verification-cancel"><i class="fa fa-times" aria-hidden="true"></i></button>
					<button type="submit" class="btn-link" name="verification-approval"><i class="fa fa-check" aria-hidden="true"></i></button>
					</form>
					</td>
					
                </tr>
                <?php } ?>
                </tbody>
            </table>
			</div>
            <?php echo $pagination; ?>
    </div>
	 
			</div>
			
	 </div>
	 </div>
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->
