<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Sistem Penjualan Berbasis Web</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
<link rel="stylesheet" href="<?php echo CSSURL."bootstrap.min.css";?>">
<link rel="stylesheet" href="<?php echo CSSURL."main.css";?>">
<link rel="stylesheet" href="<?php echo CSSURL."theme.css";?>">
<link rel="stylesheet" href="<?php echo CSSURL."Font-Awesome/css/font-awesome.min.css";?>">	
<script src="<?php echo JSURL."modernizr-build.min.js";?>"></script>
<script src="<?php echo JSURL."jquery.min.js";?>"></script>
</head>
<body>
<div id="wrap">
      <div id="top">
        <!-- .navbar -->
        <nav class="navbar navbar-inverse navbar-static-top">
          <!-- Brand and toggle get grouped for better mobile display -->
          <header class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span> 
              <span class="icon-bar"></span> 
              <span class="icon-bar"></span> 
              <span class="icon-bar"></span> 
            </button>
            <a href="<?php echo APPURL;?>" class="navbar-brand"></a> 
          </header>
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <!-- .nav -->
            <ul class="nav navbar-nav">
              <li> <a href="index.php">Sistem Penjualan Berbasis Web <span class='text-warning'>[Anda login sebagai <?php echo $_SESSION['username'];?>]</span></a>  </li>
            </ul><!-- /.nav -->
          </div>
        </nav><!-- /.navbar -->

      </div><!-- /#top -->
<?php include "menu.php"; ?>

	  <div id="content">
	<div class="outer" class="hidden-print">
	  <div class="inner"  class="hidden-print">
	  <div class="col-lg-12"  class="hidden-print">