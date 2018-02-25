		  <div id="card" class="panel-collapse collapse">
		  <div class="anmationBlock">
		  <!-- Form of payment -->
		  </br>
		  <form method="post">
            <div class="form-group">
            <input type="text" class="form-control" autocomplete="off"  placeholder="<?php echo $this->lang->line('checkout_card_form_card_number'); ?>" name="cardnumber" value=""/>
            </div>
			<div class="form-group">
			<div class="row">
			<div class="col-xs-6 col-md-6">
			<select name="expirymonth" class="form-control">
              <option disabled="true"><?php echo $this->lang->line('checkout_card_form_card_month'); ?></option>
              <option value="1">Jan</option>
              <option value="2">Feb</option>
              <option value="3">Mar</option>
              <option value="4">Apr</option>
              <option value="5">May</option>
              <option value="6">Jun</option>
              <option value="7">Jul</option>
              <option value="8">Aug</option>
              <option value="9">Sep</option>
              <option value="10">Oct</option>
              <option value="11">Nov</option>
              <option value="12">Dec</option>
            </select>
			</div>
		
			<div class="col-xs-6 col-md-6">
			<select name="expiryyear" class="form-control">
			<option disabled><?php echo $this->lang->line('checkout_card_form_card_year'); ?></option>
			<?php
			for($i=date('Y');$i<date('Y')+21;$i++){
			echo "<option value='".$i."'>".substr($i,2)."</option>";
			}
			?>
			</select>
			</div>
			</div>
			</div>		
            <div class="form-group">
            <div class="input-group">
            <input type="password" class="form-control" placeholder="<?php echo $this->lang->line('checkout_card_form_card_cvc'); ?>" name="cvc">
			<span class="input-group-addon" id="cvc"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></span>
              
            </div>
          </div>
		<hr class="love">
		<!-- User details -->
		<div class="form-group">
		<input type="email" name="email" class="form-control" value="" placeholder="<?php echo $this->lang->line('checkout_card_form_email'); ?>">
		</div>
		
		<div class="form-group">
		<div class="row">
		<div class="col-xs-6 col-md-6">
		<input type="text" name="first_name" class="form-control" value="" placeholder="<?php echo $this->lang->line('checkout_card_form_first_name'); ?>">
		</div>
		
		<div class="col-xs-6 col-md-6">
		<input type="text" name="last_name" class="form-control" value="" placeholder="<?php echo $this->lang->line('checkout_card_form_last_name'); ?>">
		</div>
		</div>
		</div>
		
		<div class="form-group">
		<input type="tel" name="mobile" id="mobile" class="form-control" value="" placeholder="<?php echo $this->lang->line('checkout_card_form_mobile'); ?>">
		</div>
		<div class="form-group">
		<input type="text" name="country" class="form-control" value="" placeholder="<?php echo $this->lang->line('checkout_card_form_country'); ?>">
		</div>
		
		<div class="form-group">
		<input type="text" name="city" class="form-control" value="" placeholder="<?php echo $this->lang->line('checkout_card_form_city'); ?>">
		</div>
		
		<div class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button class="btn btn-primary btn-block" type="submit" name="checkout-guest-card" id="anmationBKPesa_wait"><?php echo $this->lang->line('checkout_card_form_submit_button');?></button>
      </div>
	  </div>
	  </form>
	<!-- End card -->
	</div>