<?php 
date_default_timezone_set('Asia/Jakarta');
require_once 'connection.php';

class Transaksi extends Connection{

	public function __construct(){
		$this->conn = $this->get_connection();
	}

	public function index(){
		$query = mysqli_query($this->conn,"SELECT a.*,b.nama_menu,b.harga,c.nama_pelanggan,d.nama_user FROM pesanan as a JOIN menu as b ON a.menu_id = b.id JOIN pelanggan as c ON a.pelanggan_id = c.id JOIN user as d ON a.user_id = d.id WHERE status = 'belum dibayar' ORDER BY a.id ");

		while($row = mysqli_fetch_array($query)){
			$hasil[] = $row;
		}
		if($query->num_rows >= 1){
			return $hasil;
		}else{
			return false;
		}
	}

	public function edit($id){
		$query = mysqli_query($this->conn,"SELECT a.*,b.nama_menu,b.harga,c.nama_pelanggan,d.nama_user FROM pesanan as a JOIN menu as b ON a.menu_id = b.id JOIN pelanggan as c ON a.pelanggan_id = c.id JOIN user as d ON a.user_id = d.id WHERE a.id = '$id'");
		return $query->fetch_array();
	}

	public function bayar($pesanan_id,$total_harga,$jumlah_bayar){
		$kembalian = $jumlah_bayar - $total_harga;
		$query = mysqli_query($this->conn,"INSERT INTO transaksi(pesanan_id,total,bayar) VALUES ('$pesanan_id','$total_harga','$jumlah_bayar')");
		return $kembalian;
	}

	public function update($pesanan_id){
		$query = mysqli_query($this->conn,"UPDATE pesanan SET status = 'sudah bayar' WHERE id = '$pesanan_id'");
	}

}



 ?>