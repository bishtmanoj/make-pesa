<hr>
<div class="container">
<div class="row">
<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
<div class="box-signup-choose">
         <div class="well-header">
               <center><img src="<?php echo site_url().'assets/images/login.png'; ?>" class="img-thumbnail img-circle img-responsive" height="80px;" width="80px;"></center>
               <h4 class="text-center"><?php echo $this->lang->line('select_account_h2_desc');?></h4>
			   <hr>
            </div>
	 <!-- Form account select -->

        <div class="anmationBlock">
		<form method="post">
		<div class="form-group">
		<select name="account" class="form-control">
		<option value="1"><?php echo $this->lang->line('select_account_select_personal');?></option>
		<option value="2"><?php echo $this->lang->line('select_account_select_business');?></option>
		</select>
		</div>
		<div class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn-primary btn-block" type="submit" id="anmationBKPesa_wait"><?php echo $this->lang->line('select_account_form_submit');?></button>
      </div>
	  </form>
	 <!-- End Form -->
      </div>
	  </div><!-- block-->
      </div><!-- span-->
	  </div><!-- row-->
	  </div><!-- container-->
