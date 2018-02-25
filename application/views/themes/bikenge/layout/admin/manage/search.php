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
			<div class="well-header">
             <?php

		// User delete failed alert.
      	if ($this->session->admin_delete_user_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('admin_delete_user_failed').'
      			  </div>';
      	}
      	// User delete success alert
      	if ($this->session->admin_delete_user_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('admin_delete_user_success').'
      			  </div>';
      	}
		
      	?>  
			<!-- Form user manage -->
          <form method="post" action="<?php echo base_url("admin/search"); ?>" class="form-horizontal" id="serach_user" name="serach_user" role="form">
            <div class="form-group">
                <div class="col-md-6">
                    <input class="form-control" id="user_name" name="user_name" placeholder="<?php echo $this->lang->line('admin_search_form_user_name_placeholder');?>" type="text" value="" />
                </div>
                <div class="col-md-6">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <input id="btn_search" name="btn_search" type="submit" class="btn btn-primary" value="<?php echo $this->lang->line('admin_search_form_button_search_name_placeholder');?>" />
                    <a href="<?php echo base_url(). "/admin/manage"; ?>" class="btn btn-info"><?php echo $this->lang->line('admin_search_form_button_searchall_placeholder');?></a>
                </div>
            </div>
			</form>
	  <!-- Form End -->
	  </div>
	  <div class="table-responsive">
	  <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th>#</th>
                    <th><?php echo $this->lang->line('admin_search_table_th_name');?></th>
                    <th><?php echo $this->lang->line('admin_search_table_th_email');?></th>
                    <th><?php echo $this->lang->line('admin_search_table_th_country');?></th>
					<th><?php echo $this->lang->line('admin_search_table_th_account_type');?></th>
					<th><?php echo $this->lang->line('admin_search_table_th_action');?></th>
                    </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < count($userlist); ++$i) { ?>
                <tr>
                    <td><?php echo ($page+$i+1); ?></td>
                    <td><?php echo $userlist[$i]->full_name; ?></td>
                    <td><?php echo $userlist[$i]->email; ?></td>
                    <td><?php echo $userlist[$i]->country; ?></td>
					<td><?php echo $this->helper->account_status_in_admin($userlist[$i]->account_type); ?></td>
					<td>
					<a href="<?php echo base_url(). "/admin/edit?id=".$userlist[$i]->id.""; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
					<a href="<?php echo base_url(). "/admin/profile?id=".$userlist[$i]->id.""; ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
					<?php if (!$userlist[$i]->account_type == 0) :?>
					<a href="<?php echo base_url(). "/admin/profile/delete?id=".$userlist[$i]->id.""; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
					<?php endif; ?>
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
