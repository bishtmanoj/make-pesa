	<div class="welcome-home-account">
	 <h1>
  <?php echo $this->lang->line('welcome_page_developer_selling_cover_account_note_h1');?>
  </h1>
  </div>
  
  <!-- Selling Tools-->
  <div class="well">
  <h5>
  <?php echo $this->lang->line('welcome_page_developer_selling_cover_account_note_h5');?>
  </h5>
  <hr>
  <!-- Demo form -->
  <form action="<?php echo site_url().'checkout/'; ?>" method="post">

  <!-- Identify your business so that you can collect the payments. -->
  <div class="form-group">
  <input type="text" name="business" value="" class="form-control" placeholder="Business email">
  </div>
  <!-- Specify a Buy Now button. -->
  <input type="hidden" name="type" value="buy">

  <!-- Specify details about the item that buyers will purchase. -->
  <div class="form-group">
  <input type="text" name="item_name" value="" class="form-control" placeholder="Item name">
  </div>
  
  <div class="form-group">
  <input type="text" name="item_number" value="" class="form-control" placeholder="Item number">
  </div>
  
  <div class="form-group">
  <input type="text" name="amount" value="" class="form-control" placeholder="Amount">
  </div>
 
 <input type="hidden" name="shipping" value="1" class="form-control">
  
  <div class="form-group">
  <input type="text" name="return" value="" class="form-control"  placeholder="Return URL e.g, http://example.com">
  </div>
  
  <div class="form-group">
  <input type="text" name="cancel_return" value="" class="form-control"  placeholder="Cancel URL e.g, e.g, http://example.com">
  </div>
  
  <input type="hidden" name="currency_code" value="USD">

  <!-- Display the payment button. -->
  <input type="submit" name="submit" class="btn btn-info btn-block" value="BUY NOW!">

</form>
  </div>