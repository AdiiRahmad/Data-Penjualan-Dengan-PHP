<?php
session_start();
include "conf/config.php";
include "conf/koneksi.php";
include "class/laporanjual.class.php";
//cek login 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}
$Lapjual = new Laporanjual();

include "header.php";
?>
<h2><i class='fa fa-home'></i> <span class="text-primary">Laporan Penjualan</span></h2>
<div id='divform'>
  <form class="form-horizontal" role="form" action="" method="post" id='form1' onsubmit="return cekdata()">
  <div class="form-group">
  <div class="form-group" id="selecttgl">
    <label for="nama" class="col-sm-3 control-label">Periode</label>
    <div class="col-sm-3">
      <input type="text" name="tglawal" id="tglawal"  class="form-control" placeholder="Tanggal Awal" > 
    </div>
	<div class="col-sm-3">
		  <input type="text" name="tglakhir" id="tglakhir" class="form-control" placeholder="Tanggal Akhir" >
	</div>
  </div>
   <div class="form-group">
    <label for="nama" class="col-sm-3 control-label"></label>
    <div class="col-sm-5">
     <input type="submit" class="btn btn-primary" value="Cetak" name="cetak" id="cetak"> 
	 <input type="reset" class="btn btn-info" name="tblreset" id="tblreset" value="Reset">
    </div>
  </div>
</div>
<?php
if(isset($_POST['cetak'])){
	$tglawal = $_POST['tglawal'];
	$tglakhir = $_POST['tglakhir'];
	$datalap = $Lapjual->getData($tglawal,$tglakhir);
?>
<div class="row">
  <div class="col-lg-12">
	<div class="box">
	  <header>
		<div class="icons">
		  <i class="fa fa-table"></i>
		</div>
		<h5>Data Laporan Penjualan</h5>
	  </header>
	  <div id="collapse4" class="body">
	  <div class='table-responsive'>
		<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th>Tgl</th>
			  <th>Nama Customer</th>
			  <th>Total</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php 
		  if(isset($datalap)){
		  foreach($datalap as $index=>$value):
		  ?>
			<tr>
			  <td><?php echo $value['tgl'];?></td>
			  <td><?php echo $value['namacust'];?></td>
			  <td align='right'><?php echo $value['total'];?></td>
			</tr>
			<?php
			endforeach;
			}
			?>
		</tbody>
		</table>
		</div>
	  </div>
	</div>
  </div>
</div><!-- /.row -->
<?php } ?>
<link rel="stylesheet" href="<?php echo LIBURL."Zebra_Datepicker/public/css/metallic.css";?>">
<script src="<?php echo LIBURL."Zebra_Datepicker/public/javascript/zebra_datepicker.js";?>"></script>
<script>
$(document).ready(function(){
	$('#tglawal').Zebra_DatePicker({
  inside:false,direction: 0,
  pair: $('#tglakhir')
});

$('#tglakhir').Zebra_DatePicker({
  inside:false,direction: 1
});
});

function cekdata(){
	if($('#tglawal').val()=='' || $('#tglakhir').val()==''){
		alert("Tanggal Awal dan Akhir belum diisi");
		return false;
	}else{
		return true;
	}
}
</script>
  

