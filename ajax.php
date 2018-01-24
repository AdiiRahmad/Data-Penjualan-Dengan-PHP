<?php
include "conf/config.php";
include "conf/koneksi.php";
include "class/data.class.php";
if(isset($_POST['req'])){
	if($_POST['req']=='brg'){
		$idbrg = $_POST['id'];
		$Data = new Data();
		$dtbrg = $Data->getBarang($idbrg);
		echo json_encode($dtbrg);
		exit;
	}
}
?>