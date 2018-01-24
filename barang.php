<?php
session_start();
include "conf/config.php";
include "conf/koneksi.php";
include "class/barang.class.php";
//jika belum login pindahkan ke halaman login
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}
//buat objek berdasarkan class barang
$Barang = new Barang();
//kalo tombol simpan diklik
if(isset($_POST['tblsimpan'])){
	$id = addslashes(htmlentities($_POST['idbarang']));
	$nama = addslashes(htmlentities($_POST['namabarang']));
	$harga = addslashes(htmlentities($_POST['harga']));
	$stok = addslashes(htmlentities($_POST['stok']));
	$message = $Barang->simpan($id,$nama,$harga,$stok);
}
if(isset($_POST['tblubah'])){
	$id = addslashes(htmlentities($_POST['idbarang']));
	$nama = addslashes(htmlentities($_POST['namabarang']));
	$harga = addslashes(htmlentities($_POST['harga']));
	$stok = addslashes(htmlentities($_POST['stok']));
	$message = $Barang->ubah($id,$nama,$harga,$stok);
}
if(isset($_POST['tblhapus'])){
	$id = addslashes(htmlentities($_POST['idbarang']));
	$message = $Barang->hapus($id);
}
//ambil autonumber
$autonumber = $Barang->getAutoNumber();
$databarang = $Barang->getAllData();
include "header.php";
?>


<h2><i class='fa fa-shopping-cart'></i> <span class="text-primary">Master Barang</span></h2>
<?php
if(isset($message)){
	echo "<p class='informasi text-center bg-".$message[0]."'>".$message[1]."</p>";	
}
?>
<div id='divform'>
  <form class="form-horizontal" role="form" action="" method="post" id='form1' enctype="multipart/form-data">
  <div class="form-group">
    <label for="nama" class="col-sm-3 control-label">Kode Barang</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="idbarang" name="idbarang" maxlength="4" value="<?php echo $autonumber;?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="nama" class="col-sm-3 control-label">Nama Barang</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="namabarang" name="namabarang" placeholder="Nama Barang"  autofocus  maxlength="50">
    </div>
  </div>
  <div class="form-group">
  <label for="alamat" class="col-sm-3 control-label">Harga</label>
   <div class="col-sm-5">
   <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" required>
  </div>
  </div>
  <div class="form-group">
  <label for="alamat" class="col-sm-3 control-label">Stok</label>
   <div class="col-sm-5">
   <input type="number" class="form-control" id="stok" name="stok" placeholder="stok" required>
  </div>
  </div>
  <div class="form-group">
	  <label for="simpan" class="col-sm-3 control-label"></label>
    <div class="col-sm-5">
      <input type="submit" class="btn btn-primary" name="tblsimpan" id="tblsimpan" value="Simpan">
	   <input type="submit" class="btn btn-warning" name="tblubah" id="tblubah" value="Ubah" disabled>
	   <input type="submit" class="btn btn-danger" name="tblhapus" id="tblhapus" value="Hapus" onclick='yakinhapus()' disabled>
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
		<h5>Data Barang</h5>
	  </header>
	  <div id="collapse4" class="body">
	  <div class='table-responsive'>
		<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th>Kode Barang</th>
			  <th>Nama Barang</th>
			  <th>Harga</th>
			  <th>Stok</th>
			  <th width='20%'>Action</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php 
		  if(isset($databarang)){
		  foreach($databarang as $index=>$value):
		  ?>
			<tr>
			  <td id='kode_<?php echo $value['idbarang'];?>'><?php echo $value['idbarang'];?></td>
			  <td id='nama_<?php echo $value['idbarang'];?>'><?php echo $value['namabarang'];?></td>
			  <td  id='harga_<?php echo $value['idbarang'];?>'><?php echo $value['harga'];?></td>
			  <td  id='stok_<?php echo $value['idbarang'];?>'><?php echo $value['stok'];?></td>
			  <td><button class='btn  btn-xs btn-warning' onclick="pilihdata('<?php echo $value['idbarang'];?>')">Pilih</button> 
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
	document.location='barang.php';
}
function pilihdata(idbarang){
	id = $('#kode_'+idbarang).html();
	nm = $('#nama_'+idbarang).html();
	harga = $('#harga_'+idbarang).html();
	stok = $('#stok_'+idbarang).html();
	$('#idbarang').val(id);
	$('#namabarang').val(nm);
	$('#harga').val(harga);
	$('#stok').val(stok);
	$('#tblsimpan').attr('disabled','disabled');
	$('#tblubah,#tblhapus').removeAttr('disabled');	
}
</script>
<?php
include "footer.php";
?>