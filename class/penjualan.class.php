<?php
class Penjualan
{
	public $tabel = "transjual";
	public $tabeldetil = "detiljual";
	public $tabelbarang = "barang";
	public $tabelcust = "customer";
	public $sql = "";
	
	public function simpan($tgl,$idcust,$kdbrg,$qty,$harga){
//	print_r($qty);
	//cari idjual terakhir + 1;
		$this->sql = "SELECT * from ".$this->tabel;
		$kueri = mysql_query($this->sql);
		if(mysql_num_rows($kueri)==0){
			$kodejual = "1";
		}else{
			$this->sql = "SELECT max(idjual) as kode FROM ".$this->tabel;
			$kueri = mysql_query($this->sql);
			$data = mysql_fetch_array($kueri);
			$x = $data['kode'];
			$kodejual = $x + 1;
		}
		$total = 0;
		//hitung totalnya berapa?
		foreach($kdbrg as $index=>$value){
			$idbarang = $value;
			$qtyx = str_replace('.','',$qty[$index]);
			$hargax= str_replace('.','',$harga[$index]);
			$this->sql = "INSERT INTO ".$this->tabeldetil."(idjual,idbarang,qty,hargajual) values('".$kodejual."','".$idbarang."','".$qtyx."','".$hargax."')";
			mysql_query($this->sql);
			$total = $total + ($qtyx*$hargax);
		}
//simpan ke transjual
		$this->sql = "insert into ".$this->tabel."(idjual,idcust,tgl,total) values('".$kodejual."','".$idcust."','".$tgl."','".$total."') ";
		$kueri = mysql_query($this->sql);
		if(!$kueri){
			return array('danger',mysql_error());
		}else{
			return array('success',"Data berhasil disimpan");
		}
	}
	public function getAllBarang(){
		$this->sql = "SELECT idbarang,namabarang,harga,stok FROM ".$this->tabelbarang." ORDER BY idbarang asc";
		$kueri = mysql_query($this->sql);
		$x = array();
		while($data = mysql_fetch_array($kueri)){
			$x[] = array('idbarang'=>$data['idbarang'],'namabarang'=>$data['namabarang'],'harga'=>$data['harga'],'stok'=>$data['stok']);
		}
		return $x;
	}
	public function getAllCust(){
		$this->sql = "SELECT idcust,namacust FROM ".$this->tabelcust." ORDER BY namacust asc";
		$kueri = mysql_query($this->sql);
		$x = array();
		while($data = mysql_fetch_array($kueri)){
			$x[] = array('idcust'=>$data['idcust'],'namacust'=>$data['namacust']);
		}
		return $x;
	}
}
?>