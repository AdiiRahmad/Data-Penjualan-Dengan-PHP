<?php
session_start();
include "conf/config.php";
include "conf/koneksi.php";
//cek login 
	if(!isset($_SESSION['username'])){
		header("Location:login.php");
	}
include "header.php";
?>
<h2><i class='fa fa-shopping-cart'></i> <span class="text-primary">Selamat Datang</span></h2>
<p>Ini adalah sistem penjualan berbasis web. Silakan gunakan menu di sebelah kiri</p>
<?php
include "footer.php";
?>