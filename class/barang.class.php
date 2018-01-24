<?php
class Barang
{
	public $tabel = "barang";
	public $sql = "";
	public function getAutoNumber(){
		$this->sql = "SELECT * from ".$this->tabel;
		$kueri = mysql_query($this->sql);
		if(mysql_num_rows($kueri)==0){
			$kode = "B001";
		}else{
			$this->sql = "SELECT max(idbarang) as kode FROM ".$this->tabel;
			$kueri = mysql_query($this->sql);
			$data = mysql_fetch_array($kueri);
			$x = $data['kode'];
			$angka = substr($x,1,3);
			$next = $angka + 1;
			if($next<9){
				$kode = "B00".$next;
			}elseif($next<99){
				$kode = "B0".$next;
			}else{
				$kode = "B".$next;
			}
		}
		return $kode;
	}
	
	public function simpan($kode,$nama,$harga,$stok){
		$this->sql = "INSERT INTO ".$this->tabel." values('$kode','$nama','$harga','$stok')";
		$kueri = mysql_query($this->sql);
		if(!$kueri){
			return array('danger',mysql_error());
		}else{
			return array('success',"Data berhasil disimpan");
		}
	}
	
	public function ubah($kode,$nama,$harga,$stok){
		$this->sql = "UPDATE ".$this->tabel." set namabarang='$nama',harga='$harga',stok='$stok' WHERE idbarang='$kode'";
		//die($this->sql);
		$kueri = mysql_query($this->sql);
		if(!$kueri){
			return array('danger',mysql_error());
		}else{
			return array('success',"Data berhasil diubah");
		}
	}
	
	public function hapus($kode){
		$this->sql = "DELETE FROM ".$this->tabel." WHERE idbarang='$kode'";
		$kueri = mysql_query($this->sql);
		if(!$kueri){
			return array('danger',mysql_error());
		}else{
			return array('success',"Data berhasil dihapus");
		}
	}
	
	public function getAllData(){
		$this->sql = "SELECT idbarang,namabarang,harga,stok FROM ".$this->tabel." ORDER BY idbarang asc";
		$kueri = mysql_query($this->sql);
		$x = array();
		while($data = mysql_fetch_array($kueri)){
			$x[] = array('idbarang'=>$data['idbarang'],'namabarang'=>$data['namabarang'],'harga'=>$data['harga'],'stok'=>$data['stok']);
		}
		return $x;
	}
}
?>