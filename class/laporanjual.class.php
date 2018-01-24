<?php
class Laporanjual
{
	public $tabel = "transjual";
	public $tabeldetil = "detiljual";
	public $tabelbarang = "barang";
	public $tabelcust = "customer";
	public $sql = "";
	
	public function getData($tglawal,$tglakhir){
		$this->sql = "SELECT tgl,total,namacust FROM transjual,customer WHERE tgl>='$tglawal' and tgl <='$tglakhir' and transjual.idcust=customer.idcust ORDER BY tgl asc";
		$kueri = mysql_query($this->sql);
		$x = array();
		while($data = mysql_fetch_array($kueri)){
			$x[] = array('tgl'=>$data['tgl'],'total'=>$data['total'],'namacust'=>$data['namacust']);
		}
		return $x;
	}
}
?>