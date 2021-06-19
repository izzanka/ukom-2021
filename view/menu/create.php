<?php
session_start();
include_once '../../controller/user.php';
include_once '../../controller/menu.php';

$user = new User();
$menu = new Menu();

if(!$user->check_session()){
  header("location:../../../index.php");
}

if(isset($_REQUEST['submit'])){
    extract($_REQUEST);
    $menu->store($nama_menu,$harga);
    if($menu){
        header("location: index.php");
    }else{
        echo "Store data menu failed, try again";
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

    <title>Menu</title>
    <style type="text/css">
        body {
            padding-top: 56px;
        }
    </style>
  </head>
  <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand">Menu</a>
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
                        Entry Menu
                    </div>
                    <div class="card-body">
                        <form method="post" action="" onSubmit="return validasi()">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nama Menu </label>
                                <input type="text" class="form-control" name="nama_menu" id="nama_menu">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Harga </label>
                                <input type="number" class="form-control" name="harga" id="harga">
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
      var nama_menu = document.getElementById("nama_menu").value;
      var harga = document.getElementById("harga").value;
      if (nama_menu != "" && harga != "") {
        return true;
      }else{
        alert('Semua input harus di isi!');
        return false;
      }
    }
  </script>
</html>
