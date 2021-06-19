<?php 
date_default_timezone_set('Asia/Jakarta');

require_once 'connection.php';
include_once '../../controller/menu.php';

class Pesanan extends Connection
{
	
	public function __construct()
	{
		$this->conn = $this->get_connection();
	}

	public function index(){
		$query = mysqli_query($this->conn,"SELECT a.*,b.nama_menu,b.harga,c.nama_pelanggan,d.nama_user FROM pesanan as a JOIN menu as b ON a.menu_id = b.id JOIN pelanggan as c ON a.pelanggan_id = c.id JOIN user as d ON a.user_id = d.id ORDER BY a.id");

		while($row = mysqli_fetch_array($query)){
			$hasil[] = $row;
		}
		if($query->num_rows >= 1){
			return $hasil;
		}else{
			return false;
		}
	}

	public function store($menu_id,$pelanggan_id,$jumlah)
	{
		$id = "P" . "-" . date('dmY') . date('his');

		$menu = new Menu();
		$data_menu = $menu->edit($menu_id);
		$total_harga = $data_menu['harga'] * $jumlah;

		session_start();
		$user_id = $_SESSION['id'];

		$query = mysqli_query($this->conn,"INSERT INTO pesanan
		(id,menu_id,pelanggan_id,user_id,total_harga,jumlah) VALUES ('$id','$menu_id','$pelanggan_id','$user_id','$total_harga','$jumlah')");
	}

	public function delete($id){
		$query = mysqli_query($this->conn,"DELETE FROM pesanan WHERE id = '$id'");
	}
}



 ?>