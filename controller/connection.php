<?php 

class Connection{
	
	public function get_connection(){

	    $host = "localhost";
	    $name = "kasir";
	    $user = "root";
	    $pass = "";
	    $connect = new mysqli($host, $user, $pass, $name);
	    return $connect;
 	}	
}

 ?>