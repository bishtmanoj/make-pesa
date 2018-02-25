  <!-- Add Card -->
  <div class="modal fade" id="addcard" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
    
      <!-- Card content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add a Card</h4>
        </div>
        <div class="modal-body">
		
		  <!-- Form of payment -->
		  <div class="anmationBlock">
		<form role="form" id="card-validate" method="post" action="<?php echo site_url('business/wallet/card');?>">
		<div class="form-group">
		<p><?php echo $this->lang->line('wallet_add_card_form_note_side_one'); ?> <strong><?php echo $this->site_settings->curr_word.' '.$this->site_settings->card_add_fee;?></strong> <?php echo $this->lang->line('wallet_add_card_form_note_side_two'); ?></p>
		</div>
		  <div class="form-group">
			<div class="form-group">
            <select name="card_type" class="form-control">
			<option disabled><?php echo $this->lang->line('wallet_add_card_form_card_type_select'); ?></option>
			<?php echo $this->helper->card_type_select_option();?>
			</select>
			<input type="hidden" name="name" value="<?php echo $this->user->full_name;?>">
            </div>
            <div class="form-group">
            <input type="text" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('wallet_add_card_form_card_number_placeholder'); ?>" name="cardnumber" value=""/>
            </div>
			<div class="form-group">
			<div class="row">
			<div class="col-xs-6 col-md-6">
			<select name="expirymonth" class="form-control">
              <option disabled="true"><?php echo $this->lang->line('wallet_add_card_form_card_month_placeholder'); ?></option>
              <option value="01">Jan</option>
              <option value="02">Feb</option>
              <option value="03">Mar</option>
              <option value="04">Apr</option>
              <option value="05">May</option>
              <option value="06">Jun</option>
              <option value="07">Jul</option>
              <option value="08">Aug</option>
              <option value="09">Sep</option>
              <option value="10">Oct</option>
              <option value="11">Nov</option>
              <option value="12">Dec</option>
            </select>
			
			</div>
		
			<div class="col-xs-6 col-md-6">
			<select name="expiryyear" class="form-control">
			<option disabled><?php echo $this->lang->line('wallet_add_card_form_card_year_placeholder'); ?></option>
			<?php
			for($i=date('Y');$i<date('Y')+21;$i++){
			echo '<option value="'.substr($i,2).'">'.$i.'</option>';
			}
			?>
			</select>
			</div>
			</div>
			</div>		
            <div class="form-group">
            <div class="input-group">
            <input type="password" class="form-control" placeholder="<?php echo $this->lang->line('wallet_add_card_form_card_cvc_placeholder'); ?>" name="cvc">
			<span class="input-group-addon" id="cvc"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></span>
              
            </div>
          </div>

          
          <div class="form-group ">
             <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <button type="submit" class="modal-save-button-small" name="wallet-card-add"><?php echo $this->lang->line('wallet_add_card_form_card_submit_button'); ?></button>
          </div>
        </form>
		</div>

		  <!-- End Form -->
        </div>
      </div>
      
    </div>
			</div>
			<!-- End Add card -->