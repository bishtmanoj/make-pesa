<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	
    <script src="<?php echo base_url().'assets/js/jquery.min.js'; ?>"></script>
	<script src="<?php echo base_url().'assets/js/function.js'; ?>"></script>
	<script src="<?php echo base_url().'assets/js/autoNumeric.js'; ?>"></script>
	<script src="<?php echo base_url().'assets/js/currency.js'; ?>"></script>
	<script src="<?php echo base_url().'assets/js/anmationBKPesa.js'; ?>"></script>
   <script src="<?php echo base_url().'assets/js/bootstrap.min.js'; ?>"></script>
   <script src="<?php echo base_url().'assets/other/phone/js/phone_number.js'; ?>"></script>
   
   <script type="text/javascript">
  $("#mobile").intlTelInput({
      //allowDropdown: false,
      autoHideDialCode: false,
      //autoPlaceholder: "yes",
     //dropdownContainer: "body",
     //excludeCountries: ["us"],
     formatOnDisplay: false,
      geoIpLookup: function(callback) {
     $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
    var countryCode = (resp && resp.country) ? resp.country : "";
      callback(countryCode);
      });
     },
     initialCountry: "auto",
      nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
     separateDialCode: false,
      utilsScript: "<?php echo base_url().'assets/other/phone/js/phone_function.js'; ?>"
    });
  </script>
   <script type="text/javascript">
   jQuery(function($) {

	var current_effect = $('#anmationBKPesa_wait_effect').val();

	$('#anmationBKPesa_wait').click(function(){
		run_anmationBKPesa($('.anmationBlock > form'), 1, current_effect);
	});
	$('#anmationBKPesa_wait_effect').change(function(){
		current_effect = $(this).val();
		run_anmationBKPesa($('.anmationBlock > form'), 1, current_effect);
	});
	
	$('#anmationBKPesa_wait_effect').click(function(){
		current_effect = $(this).val();
	});
	
	function run_anmationBKPesa(el, num, effect){
		text = 'Please wait...';
		fontSize = '';
		switch (num) {
			case 1:
			maxSize = '';
			textPos = 'vertical';
			break;
		}
		console.log(effect)
		el.anmationBKPesa({
			effect: effect,
			text: text,
			bg: 'rgba(255,255,255,0.7)',
			color: '#0070BA',
			maxSize: maxSize,
			source: 'img.svg',
			textPos: textPos,
			fontSize: fontSize,
			onClose: function() {}
		});
	}
	

	var current_body_effect = $('#anmationBKPesa_wait_body_effect').val();
	
	$('#anmationBKPesa_wait_body').click(function(){
		run_anmationBKPesa_body(current_body_effect);
	});
	
	$('#anmationBKPesa_wait_body_effect').change(function(){
		current_body_effect = $(this).val();
		run_anmationBKPesa_body(current_body_effect);
	});
	
	
});
</script>
	</body>
</html>