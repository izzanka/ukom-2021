<?php 

require_once 'connection.php';

class Menu extends Connection{

	public function __construct(){
		$this->conn = $this->get_connection();
	}

	public function index(){
		$query = mysqli_query($this->conn,"SELECT * FROM menu ORDER BY id ASC");
		while($row = mysqli_fetch_array($query)){
			$hasil[] = $row;
		}
		if($query->num_rows >= 1){
			return $hasil;
		}else{
			return false;
		}
	}

	public function store($nama_menu,$harga){
		$query = mysqli_query($this->conn,"INSERT INTO menu(nama_menu,harga) VALUES ('$nama_menu','$harga')");
	}

	public function edit($id){
		$query = mysqli_query($this->conn,"SELECT * FROM menu WHERE id = '$id'");
		return $query->fetch_array();
	}

	public function update($id,$nama_menu,$harga){
		$query = mysqli_query($this->conn,"UPDATE menu SET nama_menu = '$nama_menu',harga = '$harga' WHERE id = '$id'");
	}

	public function delete($id){
		$query = mysqli_query($this->conn,"DELETE FROM menu WHERE id = '$id' ");
	}

}






 ?>