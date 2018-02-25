	<?php if ($this->site_settings->user_withdraw_fund):?>
	<div class="welcome-home-account">
	 <h1>
  <?php echo $this->lang->line('welcome_page_fees_withdraw_cover_account_note_h1');?>
  </h1>
  </div>
  
  <!-- withdraw fees-->
  <div class="well">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>
		<?php echo $this->lang->line('welcome_page_fees_table_th_type');?>
		</th>
        <th>
		<?php echo $this->lang->line('welcome_page_fees_table_th_percentage');?>
		</th>
        <th>
		<?php echo $this->lang->line('welcome_page_fees_table_th_plus');?>
		</th>
      </tr>
    </thead>
    <tbody>
       <!-- Card -->
	 <?php if ($this->site_settings->withdraw_method_card):?>
	 <tr>
        <td>
		<?php echo $this->lang->line('welcome_page_fees_table_withdraw_td_card');?>
		</td>
		<!-- percentege fees -->
        <?php if ($this->site_settings->card_withdraw_percentage_fees):?>
		<td><?php echo $this->site_settings->card_withdraw_percentage_fees;?>%</td>
		<?php endif;?>
        <!-- plus fees -->
        <?php if ($this->site_settings->card_withdraw_flat_fees):?>
		<td><?php echo ''.$this->site_settings->curr_word.' '.$this->site_settings->card_withdraw_flat_fees;?>
		</td>
		<?php endif;?>
      </tr>
	  <?php endif;?>
	  
	  <!-- Bank -->
	  <?php if ($this->site_settings->withdraw_method_bank):?>
	  <tr>
        <td>
		<?php echo $this->lang->line('welcome_page_fees_table_withdraw_td_bank');?>
		</td>
		<!-- percentege fees -->
        <?php if ($this->site_settings->bank_withdraw_percentage_fees):?>
		<td><?php echo $this->site_settings->bank_withdraw_percentage_fees;?>%</td>
		<?php endif;?>
        <!-- plus fees -->
        <?php if ($this->site_settings->bank_withdraw_flat_fees):?>
		<td><?php echo ''.$this->site_settings->curr_word.' '.$this->site_settings->bank_withdraw_flat_fees;?>
		</td>
		<?php endif;?>
      </tr>
	  <?php endif;?>
	  
	  <!-- M-PESA -->
	  <?php if ($this->site_settings->withdraw_method_mpesa):?>
	  <tr>
        <td>
		<?php echo $this->lang->line('welcome_page_fees_table_withdraw_td_mpesa');?>
		</td>
		<!-- percentege fees -->
        <?php if ($this->site_settings->withdraw_mpesa_percentage_fees):?>
		<td><?php echo $this->site_settings->withdraw_mpesa_percentage_fees;?>%</td>
		<?php endif;?>
        <!-- plus fees -->
        <?php if ($this->site_settings->withdraw_mpesa_flat_fees):?>
		<td><?php echo ''.$this->site_settings->curr_word.' '.$this->site_settings->withdraw_mpesa_flat_fees;?>
		</td>
		<?php endif;?>
      </tr>
	  <?php endif;?>
	  
	  <!-- TIGO-PESA -->
	  <?php if ($this->site_settings->withdraw_method_tigopesa):?>
	  <tr>
        <td>
		<?php echo $this->lang->line('welcome_page_fees_table_withdraw_td_tigopesa');?>
		</td>
		<!-- percentege fees -->
        <?php if ($this->site_settings->withdraw_tigopesa_percentage_fees):?>
		<td><?php echo $this->site_settings->withdraw_tigopesa_percentage_fees;?>%</td>
		<?php endif;?>
        <!-- plus fees -->
        <?php if ($this->site_settings->withdraw_tigopesa_flat_fees):?>
		<td><?php echo ''.$this->site_settings->curr_word.' '.$this->site_settings->withdraw_tigopesa_flat_fees;?>
		</td>
		<?php endif;?>
      </tr>
	  <?php endif;?>
	  
	  <!-- MTN -->
	  <?php if ($this->site_settings->withdraw_method_mtn):?>
	  <tr>
        <td>
		<?php echo $this->lang->line('welcome_page_fees_table_withdraw_td_mtn');?>
		</td>
		<!-- percentege fees -->
        <?php if ($this->site_settings->withdraw_mtn_percentage_fees):?>
		<td><?php echo $this->site_settings->withdraw_mtn_percentage_fees;?>%</td>
		<?php endif;?>
        <!-- plus fees -->
        <?php if ($this->site_settings->withdraw_mtn_flat_fees):?>
		<td><?php echo ''.$this->site_settings->curr_word.' '.$this->site_settings->withdraw_mtn_flat_fees;?>
		</td>
		<?php endif;?>
      </tr>
	  <?php endif;?>
	  
	  <!-- ORANGE -->
	  <?php if ($this->site_settings->withdraw_method_orange):?>
	  <tr>
        <td>
		<?php echo $this->lang->line('welcome_page_fees_table_withdraw_td_orange');?>
		</td>
		<!-- percentege fees -->
        <?php if ($this->site_settings->withdraw_orange_percentage_fees):?>
		<td><?php echo $this->site_settings->withdraw_orange_percentage_fees;?>%</td>
		<?php endif;?>
        <!-- plus fees -->
        <?php if ($this->site_settings->withdraw_orange_flat_fees):?>
		<td><?php echo ''.$this->site_settings->curr_word.' '.$this->site_settings->withdraw_orange_flat_fees;?>
		</td>
		<?php endif;?>
      </tr>
	  <?php endif;?>
	  
	  <!-- BITCOIN -->
	  <?php if ($this->site_settings->withdraw_method_bitcoin):?>
	  <tr>
        <td>
		<?php echo $this->lang->line('welcome_page_fees_table_withdraw_td_bitcoin');?>
		</td>
		<!-- percentege fees -->
        <?php if ($this->site_settings->withdraw_bitcoin_percentage_fees):?>
		<td><?php echo $this->site_settings->withdraw_bitcoin_percentage_fees;?>%</td>
		<?php endif;?>
        <!-- plus fees -->
        <?php if ($this->site_settings->withdraw_bitcoin_flat_fees):?>
		<td><?php echo ''.$this->site_settings->curr_word.' '.$this->site_settings->withdraw_bitcoin_flat_fees;?>
		</td>
		<?php endif;?>
      </tr>
	  <?php endif;?>
	  
	  <!-- PAYPAL -->
	  <?php if ($this->site_settings->withdraw_method_paypal):?>
	  <tr>
        <td>
		<?php echo $this->lang->line('welcome_page_fees_table_withdraw_td_paypal');?>
		</td>
		<!-- percentege fees -->
        <?php if ($this->site_settings->withdraw_paypal_percentage_fees):?>
		<td><?php echo $this->site_settings->withdraw_paypal_percentage_fees;?>%</td>
		<?php endif;?>
        <!-- plus fees -->
        <?php if ($this->site_settings->withdraw_paypal_flat_fees):?>
		<td><?php echo ''.$this->site_settings->curr_word.' '.$this->site_settings->withdraw_paypal_flat_fees;?>
		</td>
		<?php endif;?>
      </tr>
	  <?php endif;?>
	  
	  <!-- WESTERN UNION -->
	  <?php if ($this->site_settings->withdraw_method_western):?>
	  <tr>
        <td>
		<?php echo $this->lang->line('welcome_page_fees_table_withdraw_td_western');?>
		</td>
		<!-- percentege fees -->
        <?php if ($this->site_settings->withdraw_western_percentage_fees):?>
		<td><?php echo $this->site_settings->withdraw_western_percentage_fees;?>%</td>
		<?php endif;?>
        <!-- plus fees -->
        <?php if ($this->site_settings->withdraw_western_flat_fees):?>
		<td><?php echo ''.$this->site_settings->curr_word.' '.$this->site_settings->withdraw_western_flat_fees;?>
		</td>
		<?php endif;?>
      </tr>
	  <?php endif;?>
    </tbody>
  </table>
  </div>
  <?php endif;?>