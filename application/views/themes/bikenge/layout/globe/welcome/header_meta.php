<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title.(($this->site_settings->site_name) ? ' - '.$this->site_settings->site_name : ''); ?></title>
	<!-- Meta tag -->
	<meta name="description" content="<?php echo $this->site_settings->site_description;?>">
	<meta name="keywords" content="<?php echo $this->site_settings->site_keywords;?>">
	<meta name="author" content="<?php echo $this->site_settings->site_name;?>">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap.min.css'; ?>">
	<!-- Custom style -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/welcome.css'; ?>">
	<!-- Font awesome -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/font-awesome.min.css'; ?>">
	
	<!-- Font payment -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/paymentfont/css/paymentfont.min.css'; ?>">
	
	<!-- Loading anmation -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/anmationBKPesa.css'; ?>">
    
	 <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url().'favicon.ico?v=1'; ?>">

  </head>
  <body>