<?php
session_start();
include "conf/config.php";
include "conf/koneksi.php";
include "class/customer.class.php";
//jika belum login pindahkan ke halaman login
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}
//buat objek berdasarkan class
$Customer = new Customer();
//kalo tombol simpan diklik
if(isset($_POST['tblsimpan'])){
	$id = addslashes(htmlentities($_POST['idcust']));
	$nama = addslashes(htmlentities($_POST['namacust']));
	$alamat = addslashes(htmlentities($_POST['alamat']));
	$telp = addslashes(htmlentities($_POST['telp']));
	$message = $Customer->simpan($id,$nama,$alamat,$telp);
}
if(isset($_POST['tblubah'])){
	$id = addslashes(htmlentities($_POST['idcust']));
	$nama = addslashes(htmlentities($_POST['namacust']));
	$alamat = addslashes(htmlentities($_POST['alamat']));
	$telp = addslashes(htmlentities($_POST['telp']));
	$message = $Customer->ubah($id,$nama,$alamat,$telp);
}
if(isset($_POST['tblhapus'])){
	$id = addslashes(htmlentities($_POST['idcust']));
	$message = $Customer->hapus($id);
}
//ambil autonumber
$autonumber = $Customer->getAutoNumber();
$datacust = $Customer->getAllData();
include "header.php";
?>


<h2><i class='fa fa-user'></i> <span class="text-primary">Master Customer</span></h2>
<?php
if(isset($message)){
	echo "<p class='informasi text-center bg-".$message[0]."'>".$message[1]."</p>";	
}
?>
<div id='divform'>
  <form class="form-horizontal" role="form" action="" method="post" id='form1' enctype="multipart/form-data">
  <div class="form-group">
    <label for="nama" class="col-sm-3 control-label">Kode Customer</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="idcust" name="idcust" maxlength="4" value="<?php echo $autonumber;?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="nama" class="col-sm-3 control-label">Nama Customer</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="namacust" name="namacust" placeholder="Nama Customer" required  autofocus  maxlength="50">
    </div>
  </div>
  <div class="form-group">
  <label for="alamat" class="col-sm-3 control-label">Alamat</label>
   <div class="col-sm-5">
   <input type="text" class="form-control" id="alamat" name="alamat" placeholder="alamat" required>
  </div>
  </div>
  <div class="form-group">
  <label for="telp" class="col-sm-3 control-label">Telp</label>
   <div class="col-sm-5">
   <input type="text" class="form-control" id="telp" name="telp" placeholder="telp" required>
  </div>
  </div>
  <div class="form-group">
	  <label for="simpan" class="col-sm-3 control-label"></label>
    <div class="col-sm-5">
      <input type="submit" class="btn btn-primary" name="tblsimpan" id="tblsimpan" value="Simpan">
	   <input type="submit" class="btn btn-warning" name="tblubah" id="tblubah" value="Ubah" disabled>
	   <input type="submit" class="btn btn-danger" name="tblhapus" id="tblhapus" value="Hapus" disabled>
	  <input type="button" class="btn btn-info" name="tblreset" id="tblreset" value="Reset" onclick='backbutton()'>
    </div>
  </div>
</form>
</div>

<div class="row">
  <div class="col-lg-12">
	<div class="box">
	  <header>
		<div class="icons">
		  <i class="fa fa-table"></i>
		</div>
		<h5>Data Customer</h5>
	  </header>
	  <div id="collapse4" class="body">
	  <div class='table-responsive'>
		<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th>Kode Customer</th>
			  <th>Nama Customer</th>
			  <th>alamat</th>
			  <th>telp</th>
			  <th width='20%'>Action</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php 
		  if(isset($datacust)){
		  foreach($datacust as $index=>$value):
		  ?>
			<tr>
			  <td id='kode_<?php echo $value['idcust'];?>'><?php echo $value['idcust'];?></td>
			  <td id='nama_<?php echo $value['idcust'];?>'><?php echo $value['namacust'];?></td>
			  <td  id='alamat_<?php echo $value['idcust'];?>'><?php echo $value['alamat'];?></td>
			  <td  id='telp_<?php echo $value['idcust'];?>'><?php echo $value['telp'];?></td>
			  <td><button class='btn  btn-xs btn-warning' onclick="pilihdata('<?php echo $value['idcust'];?>')">Pilih</button> 
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
<link rel="stylesheet" href="<?php echo LIBURL."DATATABLES/media/css/jquery.dataTables.css";?>">
<script src="<?php echo LIBURL."DATATABLES/media/js/jquery.dataTables.min.js";?>"></script>
<script type="text/javascript">
$(document).ready(function(){
		$('#dataTable').dataTable({
        "sPaginationType": "full_numbers"
    });
});
function backbutton(){
	document.location='customer.php';
}
function pilihdata(idcust){
	id = $('#kode_'+idcust).html();
	nm = $('#nama_'+idcust).html();
	alamat = $('#alamat_'+idcust).html();
	telp = $('#telp_'+idcust).html();
	$('#idcust').val(id);
	$('#namacust').val(nm);
	$('#alamat').val(alamat);
	$('#telp').val(telp);
	$('#tblsimpan').attr('disabled','disabled');
	$('#tblubah,#tblhapus').removeAttr('disabled');	
}
</script>
<?php
include "footer.php";
?>