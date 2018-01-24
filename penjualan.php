<?php
session_start();
include "conf/config.php";
include "conf/koneksi.php";
include "class/penjualan.class.php";
//cek login 
if(!isset($_SESSION['username'])){
	header("Location:login.php");
}
$Penjualan = new Penjualan();
$listbarang = $Penjualan->getAllBarang();
$listdatacust = $Penjualan->getAllCust();
if(isset($_POST['tblsimpan'])){
	$tgl = $_POST['tgljual'];
	$kdbrg = $_POST['kdbrg'];
	$qty = $_POST['qtyx'];
	$idcust = $_POST['idcust'];
	$harga = $_POST['harga'];
	$message = $Penjualan->simpan($tgl,$idcust,$kdbrg,$qty,$harga);
}
include "header.php";
?>
<h2><i class='fa fa-dollar'></i> <span class="text-primary">Penjualan</span></h2>
<?php
if(isset($message)){
	echo "<p class='informasi text-center bg-".$message[0]."'>".$message[1]."</p>";	
}
?>
<div id='divform'>
  <form class="form-horizontal" role="form" action="" method="post" id='form1' onsubmit="return cekdata()">
  <div class="form-group">
    <label for="nama" class="col-sm-3 control-label">Tanggal</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="tgljual" name="tgljual" placeholder="Tanggal Penjualan" required autofocus >
    </div>
  </div>
  <div class="form-group">
    <label for="nama" class="col-sm-3 control-label">Customer</label>
    <div class="col-sm-5">
      <select name='idcust' id='idcust' class='form-control' required>
	  <option value=''></option>
	  <?php foreach($listdatacust as $cust):?>
	  <option value='<?php echo $cust['idcust']?>'><?php echo $cust['namacust'];?></option>
	  <?php endforeach;?>
	  </select>
    </div>
  </div>
  <hr>
  <div class='row text-left'>
  <div class='col-sm-12'>
  <button type="button" class='btn btn-primary' onclick='popbarang()'>Pilih Barang</button>
  </div>
  </div>
  <a name='linkdata'></a>
  <table class='table' id='tabeldata'>
  <thead>
  <tr>
  <th>Kode</th>
  <th>Nama Produk</th>
  <th>Qty</th>
  <th>Price (Rp)</th>
  <th>Total (Rp)</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody></tbody>
  <tfoot>
  <tr>
  <td>&nbsp;</td>
  <td>Total</td>
  <td id='totalqty'></td>
  <td>&nbsp;</td>
  <td id='grandtotal'></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
  </tfoot>
  </table>
  <input type='hidden' id='hidqty' value='0'> <input type='hidden' id='hidgrandtotal' value='0'>
  </div>
  <div class="form-group">
	  <label for="simpan" class="col-sm-3 control-label"></label>
    <div class="col-sm-5">
	  <input type="submit" class="btn btn-primary btn-sm" name="tblsimpan" id="tblsimpan" value="Simpan">
	  <input type="button" class="btn btn-info btn-sm" name="tblreset" id="tblreset" value="Reset" onclick='backbutton()'>
    </div>
  </div>
</form>
</div>
<!-- pop barang-->
<div class="modal fade" id="divpopbarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog wide-modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Pilih Data Barang</h4>
      </div>
      <div class="modal-body">
		<table class="table table-bordered table-condensed table-hover table-striped" id='tabelpopbarang'>
		<thead>
		<tr>
		<th>Kode</th>
		<th>Nama Barang</th>
		<th>Harga</th>
		<th>Stok</th>
		<th></th>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach($listbarang as $databarang):
		?>
		<tr>
		<td><?php echo $databarang['idbarang'];?></td>
		<td><?php echo $databarang['namabarang'];?></td>
		<td class='text-right'><?php echo $databarang['harga'];?></td>
		<td align='right'><input type='number' width='3' id='qty_<?php echo $databarang['idbarang']?>' max='<?php echo $databarang['stok'];?>' min='0'></td>
		<td><input type='button' class='btn btn-primary btn-xs' value='Pilih' onclick="inputbarang('<?php echo $databarang['idbarang']?>','<?php echo $databarang['stok']?>')"></td>
		</tr>
		<?php
		endforeach;
		?>
		</tbody>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="<?php echo LIBURL."DATATABLES/media/css/jquery.dataTables.css";?>">
<script src="<?php echo LIBURL."DATATABLES/media/js/jquery.dataTables.min.js";?>"></script>
<link rel="stylesheet" href="<?php echo LIBURL."Zebra_Datepicker/public/css/metallic.css";?>">
<script src="<?php echo LIBURL."Zebra_Datepicker/public/javascript/zebra_datepicker.js";?>"></script>
<script src="<?php echo LIBURL."jQuery-Mask-Plugin/jquery.mask.min.js";?>"></script>
<script src="<?php echo JSURL."str_replace.js";?>"></script>
<script src="<?php echo JSURL."mylib.js";?>"></script>
<script>
$(document).ready(function(){
	$('#tgljual').Zebra_DatePicker({inside:false});
	$('#qty').mask('999');	
});

function backbutton(){
	document.location='penjualan.php';
}
function inputbarang(kode,maks){
	qty = $('#qty_'+kode).val();
	qtymaks = maks;
	if($.isNumeric(qty)){
		if(parseInt(qty)<=parseInt(qtymaks)){
		$.post('ajax.php',{req:'brg',id:kode},function(data){
			harga = str_replace ('.', '',data.harga);
			kdbrg = data.idbarang;
			qty2 = parseInt(qty);
			totalharga = harga * qty2; 
			hidqty = parseInt($('#hidqty').val()) + qty2;
			hidgrandtotal = parseInt($('#hidgrandtotal').val()) + totalharga;
			$('#hidgrandtotal').val(hidgrandtotal);
			$('#hidqty').val(hidqty);
			if($("#listbrg_"+kdbrg).length > 0) {
			//if exists remove first
			$("#listbrg_"+kdbrg).remove();
			}
			row = '<tr id="listbrg_'+kdbrg+'" class="datalistbarang">';
			row += '<td>'+data.idbarang+'<input type="hidden" name="kdbrg[]" value="'+kdbrg+'" readonly></td>';
			row += '<td>'+data.namabarang+'</td>';
			row += '<td><input type="text" size="4" name="qtyx[]" class="qty" id="qty_'+kdbrg+'" value="'+qty2+'" class="maskangka text-right"></td>';
			row += '<td><input type="text" width="10" class="harga" name="harga[]" id="harga_'+kdbrg+'" value="'+harga+'" class="maskangka text-right"></td>';
			row += '<td class=text-right><span id="spantotalblj_'+kdbrg+'" class="totalblj">'+NilaiRupiah(totalharga)+'</span></td>';
			row += '<td><a href="#linkdata" onclick=hapuslist("'+kdbrg+'")><i class="glyphicon glyphicon-trash"></i></a>&nbsp;<a href="#linkdata" onclick=savelist("'+kdbrg+'")><i class="glyphicon glyphicon-floppy-disk"></i></a></td>';
			row += '</tr>';
		//alert(row);
			$('#tabeldata tbody').append(row);
			$('#harga_'+kdbrg).mask('000.000.000.000.000', {reverse: true});
				hitungulang();
		},'json');
	}else{
		alert('Qty yang Anda input melebihi qty di  : '+maks);
		$('#qty').val('').focus();
	}
	}else{
		alert('Qty harus berupa angka');
		$('#qty').val('').focus();
	}

} 
function popbarang(){
	$('#divpopbarang').modal('show');
}
function hapuslist(id){
	if(confirm('Apakah anda yakin akan menghapus data?')){
		idrow = "listbrg_"+id;
		$('#'+idrow).hide().remove();
		hitungulang();
	}
}
function savelist(id){
	idrow = "listbrg_"+id;
	harga = str_replace ('.', '',$('#harga_'+id).val());
	qty2 = parseInt($('#qty_'+id).val());
	totalharga = harga * qty2;
	$('#spantotalblj_'+id).html(NilaiRupiah(totalharga));
	hitungulang();
}
function cekdata(){
	//cek ada barang gak?
	if($('.datalistbarang').length>0){
		return true;
	}else if($('#tgljual').val()==''){
		alert('Tanggal Jual belum diisi');
		return false;
	}else{
		alert('Data barang masih kosong. Silakan diisi terlebih dahulu');
		return false;
	}
}
function hitungulang(){
	totalqty = 0;
	totalblj = 0;
	$('.qty').each(function(){
		if($.isNumeric(this.value)){
			totalqty = totalqty + parseInt(this.value);
		 }
	});
	$('#totalqty').html(totalqty);	
	$('.totalblj').each(function(){
	a = $(this).text();
	po = str_replace ('.', '',a);
		if($.isNumeric(po)){
			totalblj = totalblj + parseInt(po);
		 }
	});
	$('#grandtotal').html(NilaiRupiah(totalblj));
}
</script>
<?php
include "footer.php";
?>