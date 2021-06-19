<?php
session_start();
include_once '../../controller/pelanggan.php';
include_once '../../controller/user.php';

$pelanggan = new Pelanggan();
$user = new User();

if(!$user->check_session()){
  header("location:../../index.php");
}

$id = $_GET['id'];
if(! is_null($id)){
    $data_pelanggan = $pelanggan->edit($id);
}else{
    echo "id tidak ditemukan";
}

if(isset($_REQUEST['submit'])){
    extract($_REQUEST);
    $pelanggan->update($id,$nama_pelanggan,$jk,$hp,$alamat);
    if($pelanggan){
        header("location:index.php");
    }else{
        echo "update data pelanggan error";
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

    <title>Pelanggan</title>
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
                <a class="navbar-brand">Pelanggan</a>
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
                        Edit Pelanggan
                    </div>
                    <div class="card-body">
                        <form method="post" action="" onSubmit="return validasi()">
                            <input type="hidden" name="id" value="<?php echo $data_pelanggan['id']; ?>">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nama Pelanggan </label>
                                <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" value="<?php echo $data_pelanggan['nama_pelanggan']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputPassword4">Jenis Kelamin</label>
                                <select class="form-control" id="jk" name="jk">
                                    <option value="0">Pria</option>
                                    <option value="1">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputEmail4">Nomor HP</label>
                            <input type="number" class="form-control" name="hp" id="hp" value="<?php echo $data_pelanggan['hp']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputEmail4">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $data_pelanggan['alamat']; ?>">
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
