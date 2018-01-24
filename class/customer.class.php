<?php
class Customer
{
	public $tabel = "customer";
	public $sql = "";
	public function getAutoNumber(){
		$this->sql = "SELECT * from ".$this->tabel;
		$kueri = mysql_query($this->sql);
		if(mysql_num_rows($kueri)==0){
			$kode = "C001";
		}else{
			$this->sql = "SELECT max(idcust) as kode FROM ".$this->tabel;
			$kueri = mysql_query($this->sql);
			$data = mysql_fetch_array($kueri);
			$x = $data['kode'];
			$angka = substr($x,1,3);
			$next = $angka + 1;
			if($next<10){
				$kode = "C00".$next;
			}elseif($next<100){
				$kode = "C0".$next;
			}else{
				$kode = "C".$next;
			}
		}
		return $kode;
	}
	
	public function simpan($kode,$nama,$alamat,$telp){
		$this->sql = "INSERT INTO ".$this->tabel." values('$kode','$nama','$alamat','$telp')";
		$kueri = mysql_query($this->sql);
		if(!$kueri){
			return array('danger',mysql_error());
		}else{
			return array('success',"Data berhasil disimpan");
		}
	}
	
	public function ubah($kode,$nama,$alamat,$telp){
		$this->sql = "UPDATE ".$this->tabel." set namacust='$nama',alamat='$alamat',telp='$telp' WHERE idcust='$kode'";
		//die($this->sql);
		$kueri = mysql_query($this->sql);
		if(!$kueri){
			return array('danger',mysql_error());
		}else{
			return array('success',"Data berhasil diubah");
		}
	}
	
	public function hapus($kode){
		$this->sql = "DELETE FROM ".$this->tabel." WHERE idcust='$kode'";
		$kueri = mysql_query($this->sql);
		if(!$kueri){
			return array('danger',mysql_error());
		}else{
			return array('success',"Data berhasil dihapus");
		}
	}
	
	public function getAllData(){
		$this->sql = "SELECT idcust,namacust,alamat,telp FROM ".$this->tabel." ORDER BY idcust asc";
		$kueri = mysql_query($this->sql);
		$x = array();
		while($data = mysql_fetch_array($kueri)){
			$x[] = array('idcust'=>$data['idcust'],'namacust'=>$data['namacust'],'alamat'=>$data['alamat'],'telp'=>$data['telp']);
		}
		return $x;
	}
}
?>