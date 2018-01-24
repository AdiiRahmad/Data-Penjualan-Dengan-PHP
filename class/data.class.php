<?php
class Data
{
	public $sql = "";
	public function getBarang($id){
		$this->sql = "SELECT idbarang,namabarang,harga,stok FROM barang WHERE idbarang='$id'";
		$kueri = mysql_query($this->sql);
		$x = array();
		while($data = mysql_fetch_array($kueri)){
			$x = array('idbarang'=>$data['idbarang'],'namabarang'=>$data['namabarang'],'harga'=>$data['harga'],'stok'=>$data['stok']);
		}
		return $x;
	}
}
?>