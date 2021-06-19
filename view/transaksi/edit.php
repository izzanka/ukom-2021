<?php
session_start();
include_once '../../controller/transaksi.php';
include_once '../../controller/user.php';

$transaksi = new Transaksi();
$user = new User();

if(!$user->check_session()){
  header("location:../../index.php");
}

$id = $_GET['id'];
if(! is_null($id)){
    $data_transaksi = $transaksi->edit($id);
}else{
    echo "id tidak ditemukan";
}

if(isset($_REQUEST['submit'])){
    extract($_REQUEST);
    $transaksi->update($pesanan_id);
    if($transaksi){
        header("location:index.php");
    }else{
        echo "update data transaksi error";
    }
}

if(isset($_REQUEST['bayar'])){
    extract($_REQUEST);
    $data_kembalian = $transaksi->bayar($pesanan_id,$total_harga,$jumlah_bayar,);
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

    <title>Transaksi</title>
    <style type="text/css">
        body {
            padding-top: 56px;
        }
    </style>
  </head>
  <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand">Transaksi</a>
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
                        Edit Transaksi
                    </div>
                    <div class="card-body">
                        <form method="post" action="" onSubmit="return validasi()">
                            <input type="hidden" name="pesanan_id" value="<?php echo $data_transaksi['id']; ?>">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="inputEmail4">Nama Pelanggan </label>
                                <input type="text" class="form-control" value="<?php echo $data_transaksi['nama_pelanggan']; ?>" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">Nama Menu </label>
                                <input type="text" class="form-control" value="<?php echo $data_transaksi['nama_menu']; ?>" readonly>
                            </div>
                             <div class="form-group col-md-3">
                                <label for="inputEmail4">Harga</label>
                                <input type="number" class="form-control" value="<?php echo $data_transaksi['harga']; ?>" readonly>
                            </div>
                              <div class="form-group col-md-1">
                                <label for="inputEmail4">Jumlah</label>
                                <input type="number" class="form-control" value="<?php echo $data_transaksi['jumlah']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                             <div class="form-group col-md-2">
                                <label for="inputEmail4">Status</label>
                                <input type="text" class="form-control" value="<?php echo $data_transaksi['status']; ?>" readonly>
                            </div>
                             <div class="form-group col-md-5">
                                <label for="inputEmail4">Total Harga</label>
                                <input type="number" class="form-control" value="<?php echo $data_transaksi['total_harga']; ?>" readonly name="total_harga">
                            </div>
                              <div class="form-group col-md-4">
                                <label for="inputEmail4">Jumlah Bayar</label>
                                <input type="number" class="form-control" name="jumlah_bayar" id="jumlah_bayar">
                            </div>
                            <div class="form-group col-md-1">
                                <label for="inputEmail4">Bayar</label>
                                <button type="submit" name="bayar" class="form-control btn btn-primary">Bayar</button>
                            </div>
                        </div>
                         <div class="form-row">
                             <div class="form-group col-md-2">
                                <label for="inputEmail4">Kembalian</label>
                                <input type="text" class="form-control" value="<?php 
                                error_reporting(0); echo $data_kembalian ?>" readonly>
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
      var nama_pelanggan = document.getElementById("nama_pelanggan").value;
      var jk = document.getElementById("jk").value;
      var hp = document.getElementById("hp").value;
      var alamat = document.getElementById("alamat").value;
      if (nama_pelanggan != "" && jk != "" && hp != "" && alamat !="") {
        return true;
      }else{
        alert('Semua input harus di isi!');
        return false;
      }
    }
  </script>
</html>
