<?php 

require_once 'connection.php';

class Pelanggan extends Connection{

	public function __construct(){
		$this->conn = $this->get_connection();
	}

	public function index(){
		$query = mysqli_query($this->conn,"SELECT * FROM pelanggan ORDER BY id ASC");
		while($row = mysqli_fetch_array($query)){
			$hasil[] = $row;
		}
		if($query->num_rows >= 1){
			return $hasil;
		}else{
			return false;
		}
	}

	public function store($nama_pelanggan,$jk,$hp,$alamat){
		$query = mysqli_query($this->conn,"INSERT INTO pelanggan(nama_pelanggan,jk,hp,alamat) VALUES ('$nama_pelanggan','$jk','$hp','$alamat')");
	}

	public function edit($id){
		$query = mysqli_query($this->conn,"SELECT * FROM pelanggan WHERE id = $id");
		return $query->fetch_array();
	}

	public function update($id,$nama_pelanggan,$jk,$hp,$alamat){
		$query = mysqli_query($this->conn,"UPDATE pelanggan SET nama_pelanggan = '$nama_pelanggan', jk = '$jk',hp = '$hp',alamat = '$alamat' WHERE id = '$id'");
	}

	public function delete($id){
		$query = mysqli_query($this->conn,"DELETE FROM pelanggan WHERE id = '$id'");
	}
}
 ?>