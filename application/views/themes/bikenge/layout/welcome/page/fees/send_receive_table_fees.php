  <?php if ($this->site_settings->user_send_money):?>
  <div class="welcome-home-account">
  <h1>
  <?php echo $this->lang->line('welcome_page_fees_send_receive_cover_account_note_h1');?>
  </h1>
  </div>
  
  <!-- Sending fees-->
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
      
	  <tr>
        <td>
		<?php echo $this->lang->line('welcome_page_fees_table_td_send_payment');?>
		</td>
		<!-- percentege fees -->
        <?php if ($this->site_settings->sendmoney_percentage_fees):?>
		<td><?php echo $this->site_settings->sendmoney_percentage_fees;?>%</td>
		<?php endif;?>
        <!-- plus fees -->
        <?php if ($this->site_settings->sendmoney_flat_fees):?>
		<td><?php echo ''.$this->site_settings->curr_word.' '.$this->site_settings->sendmoney_flat_fees;?>
		</td>
		<?php endif;?>
      </tr>
	  
      <tr>
        <td>
		<?php echo $this->lang->line('welcome_page_fees_table_td_receive_payment');?>
		</td>
        <td>
		<?php echo $this->lang->line('welcome_page_fees_table_td_free');?>
		</td>
        <td>
		<?php echo $this->lang->line('welcome_page_fees_table_td_free');?>
		</td>
      </tr>
      <tr>
        <td>
		<?php echo $this->lang->line('welcome_page_fees_table_td_request_payment');?>
		</td>
        <td>
		<?php echo $this->lang->line('welcome_page_fees_table_td_free');?>
		</td>
        <td>
		<?php echo $this->lang->line('welcome_page_fees_table_td_free');?>
		</td>
      </tr>
    </tbody>
  </table>
  </div>
  <?php endif;?>