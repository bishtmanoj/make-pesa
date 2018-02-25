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
			<?php echo $this->lang->line('admin_payment_page_add_well_h5');?>
			</h5>
			
			 <?php
          if (validation_errors()) {

          echo '<div class="alert alert-danger alert-dismissible" role="alert">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
		  '.validation_errors().'
                </div>';
                  
        }
		
		// Payment failed alert.
      	if ($this->session->payment_add_failed) {
      		echo '<div class="alert alert-danger alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('payment_add_failed').'
      			  </div>';
      	}

     	// payment success alert.
      	if ($this->session->payment_add_success) {
      		echo '<div class="alert alert-success alert-dismissible" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
      			  	'.$this->lang->line('payment_add_success').'
      			  </div>';
      	}		
          ?>
		  
			<hr>
          <form role="form" method="post">
           <div class="form-group">
            <input type="text" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('admin_payment_page_add_form_amount');?>" name="amount" value=""/>
            </div>
			
			<div class="form-group">
            <input type="email" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('admin_payment_page_add_form_email');?>" name="email" value=""/>
            </div>
			
			<div class="form-group">
			<div class="row">
			<div class="col-xs-6 col-md-6">
			<select name="payment_type" class="form-control">
			<option value="Deposit">Deposit</option>
			<option value="sent">Send</option>
			</select>
			</div>
		
			<div class="col-xs-6 col-md-6">
			<select name="status_type" class="form-control">
			<option value="Processed">Processed</option>
			<option value="Pending">Pending</option>
			</select>
			</div>
			</div>
			</div>		
            <div class="form-group">
            <textarea name="note" placeholder="<?php echo $this->lang->line('admin_payment_page_add_form_note');?>" class="form-control"></textarea>
			</div>
			
			<div class="form-group">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<button class="btn btn-primary btn-block" type="submit" name="add-payment">
			<?php echo $this->lang->line('admin_payment_page_add_form_submit_button');?>
			</button>
			</div>
          </div>
		  
		  
			</form>
              </div>
	 
			</div>
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->