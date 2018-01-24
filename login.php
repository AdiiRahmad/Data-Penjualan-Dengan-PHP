<?php
session_start();
include "conf/config.php";
include "conf/koneksi.php";
//jika tombol login diklik
if(isset($_POST['Login'])){
	$user = addslashes($_POST['username']);
	$pass = addslashes($_POST['password']);
	$sql = "SELECT * from login where user='$user' and pass=md5('$pass')";
	$kueri = mysql_query($sql);
	if(mysql_num_rows($kueri)>0){
		$_SESSION['username'] = $user;
		header("Location:index.php");
	}else{
		$error = "Username atau password salah";
	}
}//end tombol login diklik
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Login System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" href="<?php echo CSSURL."/bootstrap.min.css";?>">
	<link rel="stylesheet" href="<?php echo CSSURL."/main.css";?>">
  </head>
  <body class="login">
    <div class="container">
      <div class="text-center">
       <h1 class="text-primary">Please Login </h1>
      </div>
      <div class="tab-content">
        <div id="login" class="tab-pane active">
		<div class="text-center"><?php if(isset($error)) echo "<div class='label label-danger'>$error</div>";?></div>
          <form action="" autocomplete="on" method='post' class="form-signin">
           <!-- <p class="text-muted text-center">
              Enter your username and password
            </p>-->
            <input type="text" id="username" name="username"  placeholder="Username" class="form-control" required autofocus>
            <input type="password" id="password" name="password"  placeholder="Password" class="form-control" required>
			<input type="submit" name="Login" id="Login" class="btn btn-lg btn-warning btn-block" value='Login'>
          </form>
        </div>
      </div>
    </div><!-- /container -->
    <script src="<?php echo CSSURL."jquery.min.js";?>"></script>
	<script src="<?php echo CSSURL."bootstrap.js";?>"></script>
    </body>
</html>
