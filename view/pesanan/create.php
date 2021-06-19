<?php
session_start();
include_once '../../controller/menu.php';
include_once '../../controller/user.php';
include_once '../../controller/pesanan.php';
include_once '../../controller/pelanggan.php';

$user = new User();
$pesanan = new Pesanan();
$menu = new Menu();
$pelanggan = new Pelanggan();

if(!$user->check_session()){
  header("location:../../index.php");
}

$menu = $menu->index();
$pelanggan = $pelanggan->index();
$user = $user->get_user($_SESSION['level']);

if(isset($_REQUEST['submit'])){
    extract($_REQUEST);
    $pesanan->store($menu_id,$pelanggan_id,$jumlah);
    if($pesanan){
        header("location: index.php");
    }else{
        echo "Store data pesanan failed, try again";
    }
}

if(isset($_GET['level'])){
  $user->redirect($_GET['level']);
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css">

    <title>Pesanan</title>
    <style type="text/css">
        body {
            padding-top: 56px;
        }
        .form-pelanggan{
            margin: 5%;
            padding: 4rem 1rem 4rem 1rem;
        }
    </style>
  </head>
  <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand">Pesanan</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="index.php?level=<?php echo $_SESSION['level'] ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../logout.php">Logout</a>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        Entry Pesanan
                    </div>
                    <div class="card-body">
                        <form method="post" action="" onSubmit="return validasi()">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Menu </label>
                                 <select class="form-control" id="menu_id" name="menu_id">
                                    <option value="">--- pilih menu ---</option>
                                    <?php 
                                        foreach($menu as $row){
                                            echo "
                                            <option value='$row[id]'>$row[nama_menu] | Rp. " . number_format($row[harga]) . "</option>
                                            ";
                                        }
                                     ?>
                                   
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputPassword4">Pelanggan</label>
                               <select class="form-control" id="pelanggan_id" name="pelanggan_id">
                                    <option value="">--- pilih pelanggan ---</option>
                                    <?php 
                                    foreach($pelanggan as $row){
                                        echo "
                                         <option value='$row[id]'>$row[nama_pelanggan]</option>
                                        ";
                                    }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputEmail4">User</label>
                            <?php
                                echo "
                                    <input type='text' class='form-control' value='$user[nama_user]'readonly>
                                ";
                             ?>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputEmail4">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" id="jumlah">
                            </div>
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:void(0)" class="btn btn-secondary" onclick="goBack()">Cancel</a>
                                <button type="submit" class="btn btn-primary" name="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script type="text/javascript" src="../../jquery.js"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
  <script type="text/javascript">
    function goBack(){
        window.history.back();
    }
      function validasi() {
      var menu_id = document.getElementById("menu_id").value;
      var pelanggan_id = document.getElementById("pelanggan_id").value;
      var jumlah = document.getElementById("jumlah").value;
      if (menu_id != "" && pelanggan_id != "" && jumlah != "") {
        return true;
      }else{
        alert('Semua input harus di isi!');
        return false;
      }
    }
  </script>
</html>
