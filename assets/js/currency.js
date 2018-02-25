jQuery(function($) {
     /* Send Money */
    $('.sendMoney').autoNumeric('init');
    $('#sender_amount').bind('blur focusout keypress keyup', function () {
        var sendMoney = $('#sender_amount').autoNumeric('get');
        $('#receiver_amount').autoNumeric('set', sendMoney);
    });
  
  /* Payment all format */
    $('.amount1').autoNumeric('init');
    $('#amount1').bind('blur focusout keypress keyup', function () {
        var amount1 = $('#amount1').autoNumeric('get');
        $('#amount2').autoNumeric('set', amount1);
		$('#amount3').autoNumeric('set', amount1);
		$('#amount4').autoNumeric('set', amount1);
    });    
  });
  