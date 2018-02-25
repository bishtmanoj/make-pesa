	<div class="welcome-home-account">
	 <h1>
  <?php echo $this->lang->line('welcome_page_developer_checkout_cover_account_note_h1');?>
  </h1>
  </div>
  
  <!-- Selling Tools-->
  <div class="well">
  <h5>
  <?php echo $this->lang->line('welcome_page_developer_checkout_cover_account_note_h5');?>
  </h5>
  <hr>
  <!-- Demo form -->
  <xmp>
  <form action="<?php echo site_url().'checkout/'; ?>" method="post">

  <!-- Identify your business so that you can collect the payments. -->
  <input type="hidden" name="business" value="YOUR BUSINESS EMAIL">

  <!-- Specify a Buy Now button. -->
  <input type="hidden" name="type" value="buy">

  <!-- Specify details about the item that buyers will purchase. -->
  <input type="hidden" name="item_name" value="ITEM NAME">
  <input type="hidden" name="item_number" value="ITEM NUMBER">
  <input type="hidden" name="amount" value="AMOUNT">
  <input type="hidden" name="shipping" value="1">
  <input type="hidden" name="return" value="RETURN URL">
  <input type="hidden" name="cancel_return" value="CANCEL URL">
  <input type="hidden" name="currency_code" value="<?php echo $this->site_settings->curr_word;?>">

  <!-- Display the payment button. -->
  <input type="submit" name="submit" value="BUY NOW!">
  </form>
  </xmp>
  
  <!-- Common help -->
  <?php echo $this->lang->line('welcome_page_developer_checkout_cover_account_ul');?>
  </div>