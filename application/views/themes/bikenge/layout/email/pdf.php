<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PAYALAT</title>

<style type="text/css">
body {
  font-family: "Source Sans Pro", "Segoe UI", roboto;
  font-weight: 400;
  font-size: 14px;
}
.box-card-well {
	padding: 20px;
}
.box-card {
	color: #000;
	background-image: url('');
	background-color: #B0BFD4;
	width: 100%;
	height: 300px;
	bolder: 2px solid #1e1584;
}
.box-card h2 {
text-align: center;
color: #5877A4;
padding-top: 30px;
}

.pin-number {
font-weight: bold;
font-size: 17px;
}

.box-card-block {
display: block;
}

.box-card-barcode-image {
	text-align: left;
	margin-top: -55px;
}

.box-card-qr-image {
	text-align: right;
	margin-top: -25px;
}

</style>
</head>
<body>

<div class="box-card">
<div class="box-card-well">
<!-- Title -->
<h2>Payalat.com - AlatPIN</h2>

<!-- Details -->
<div align="left" class="pin-number">
  <?php echo $pin;?>
</div>
<!--
<div align="center">
  ALATPIN
</div>-->
<div align="right">
  <h3><?php echo $payment;?></h3>
</div>

<div class="box-card-block">
  <p>Keep safe your PIN, you can scan QR code to get CVV</p>
</div>

<div class="box-card-block">
<div class="box-card-qr-image">
<img src="<?php echo $qr;?>" width="100px" height="100px"/>
</div>
</div>
<div class="box-card-block">
<div class="box-card-barcode-image">
  <img src="<?php echo $barcode;?>"/>
</div>
</div>


</div>
</div>


</body>
</html>