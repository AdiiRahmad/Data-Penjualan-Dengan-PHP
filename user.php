<?php
session_start();
include "conf/config.php";
include "conf/koneksi.php";
include "class/user.class.php";
//jika belum login pindahkan ke halaman login
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}
//buat objek berdasarkan class 
$User = new User();
//kalo tombol simpan diklik
if(isset($_POST['tblsimpan'])){
	$user = addslashes(htmlentities($_POST['user']));
	$pass = addslashes(htmlentities($_POST['pass']));
	$message = $User->simpan($user,$pass);
}
if(isset($_POST['tblubah'])){
	$user = addslashes(htmlentities($_POST['user']));
	$pass = addslashes(htmlentities($_POST['pass']));
	$message = $User->ubah($user,$pass);
}
if(isset($_POST['tblhapus'])){
	$user = addslashes(htmlentities($_POST['user']));
	$message = $User->hapus($user);
}
$datauser = $User->getAllData();
include "header.php";
?>


<h2><i class='fa fa-user'></i> <span class="text-primary">Master User</span></h2>
<?php
if(isset($message)){
	echo "<p class='informasi text-center bg-".$message[0]."'>".$message[1]."</p>";	
}
?>
<div id='divform'>
  <form class="form-horizontal" role="form" action="" method="post" id='form1' enctype="multipart/form-data">
  <div class="form-group">
    <label for="nama" class="col-sm-3 control-label">Username</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="user" name="user" maxlength="50" autofocus>
    </div>
  </div>
  <div class="form-group">
    <label for="nama" class="col-sm-3 control-label">Password</label>
    <div class="col-sm-5">
      <input type="password" class="form-control" id="pass" name="pass" maxlength="50">
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
		<h5>Data User</h5>
	  </header>
	  <div id="collapse4" class="body">
	  <div class='table-responsive'>
		<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th>Usernam</th>
			  <th>Password</th>
			  <th width='10%'>Action</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php 
		  if(isset($datauser)){
		  foreach($datauser as $index=>$value):
		  ?>
			<tr>
			  <td id='user_<?php echo $value['user'];?>'><?php echo $value['user'];?></td>
			  <td id='nama_<?php echo $value['user'];?>'><?php echo $value['pass'];?></td>
			  <td><button class='btn  btn-xs btn-warning' onclick="pilihdata('<?php echo $value['user'];?>')">Pilih</button> 
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
	document.location='user.php';
}
function pilihdata(user){
	id = $('#user_'+user).html();
	$('#user').val(id).attr('readonly','readonly');
	$('#pass').val('*******');
	$('#tblsimpan').attr('disabled','disabled');
	$('#tblubah,#tblhapus').removeAttr('disabled');	
}
</script>
<?php
include "footer.php";
?>