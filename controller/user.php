<?php 

require_once 'connection.php';

class User extends Connection{

	public function __construct(){
		$this->conn = $this->get_connection();
	}

	public function login($nama_user){
		$query = mysqli_query($this->conn,"SELECT * FROM user WHERE nama_user = '$nama_user'");
		$user = mysqli_fetch_array($query);
		$count = $query->num_rows;

		if($count == 1){
		    session_start();
		    $_SESSION['nama_user'] = $user['nama_user'];
		    $_SESSION['level'] = $user['level'];
		    $_SESSION['id'] = $user['id'];
		    $_SESSION['login'] = true;

		    if($user['level'] == 'admin'){
		    	header("Location: view/index/index-admin.php");
		    }else if($user['level'] == 'waiter'){
		    	header("Location: view/index/index-waiter.php");
		    }else if($user['level'] == 'kasir'){
		    	header("Location: view/index/index-kasir.php");
		    }else if($user['level'] == 'owner'){
		    	header("Location: view/index/index-owner.php");
		    }

		}else{
			return false;
		}
	}

	public function redirect($level){
	 	header("location:../index/index-" . "$level" . ".php");
	}

	public function get_user($level){
		$query = mysqli_query($this->conn,"SELECT * FROM user WHERE level = '$level'");
		return $query->fetch_assoc();
	}

	public function check_session(){
		return $_SESSION['login'];
	}

}

 ?>
