<?php
class User
{
	public $tabel = "login";
	public $sql = "";
	
	public function simpan($user,$pass){
		$this->sql = "INSERT INTO ".$this->tabel." values('$user',md5('$pass'))";
		$kueri = mysql_query($this->sql);
		if(!$kueri){
			return array('danger',mysql_error());
		}else{
			return array('success',"Data berhasil disimpan");
		}
	}
	
	public function ubah($user,$pass){
		$this->sql = "UPDATE ".$this->tabel." set pass=md5('$pass') WHERE user='$user'";
		//die($this->sql);
		$kueri = mysql_query($this->sql);
		if(!$kueri){
			return array('danger',mysql_error());
		}else{
			return array('success',"Data berhasil diubah");
		}
	}
	
	public function hapus($user){
		$this->sql = "DELETE FROM ".$this->tabel." WHERE user='$user'";
		$kueri = mysql_query($this->sql);
		if(!$kueri){
			return array('danger',mysql_error());
		}else{
			return array('success',"Data berhasil dihapus");
		}
	}
	
	public function getAllData(){
		$this->sql = "SELECT user FROM ".$this->tabel." ORDER BY user asc";
		$kueri = mysql_query($this->sql);
		$x = array();
		while($data = mysql_fetch_array($kueri)){
			$x[] = array('user'=>$data['user'],'pass'=>'*******');
		}
		return $x;
	}
}
?>