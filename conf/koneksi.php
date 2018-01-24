<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_jualan";

$x = mysql_connect($host,$user,$pass);
if($x){
	$c = mysql_select_db($db);
	if(!$c) die(mysql_error());
}else{
	die(mysql_error());
}

?>