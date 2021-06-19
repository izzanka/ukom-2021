<?php
session_start();
include_once '../../controller/user.php';
include_once '../../controller/pelanggan.php';

$user = new User();
$pelanggan = new Pelanggan();
$index_pelanggan = $pelanggan->index();

if(!$user->check_session()){
  header("location:../index.php");
}

if(isset($_GET['id'])){
  extract($_GET);
  $pelanggan->delete($id);
  if ($pelanggan) {
    header("location:index.php");
  }else{
    echo "data gagal dihapus";
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

    <title>Pelanggan Index</title>
    <style type="text/css">
        body {
            padding-top: 56px;
        }
    </style>
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
          <a class="navbar-brand">Pelanggan Index</a>
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
        <div class="col-md-12">
          <div class="card mt-5">
            <div class="card-header">
              Data Pelanggan
              <a class="btn btn-sm btn-outline-success float-right" href="create.php">Tambah Pelanggan</a>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-sm">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Jenis Kelamin</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if(is_array($index_pelanggan)){
                    foreach($index_pelanggan as $row){
                          echo "
                          <tr>
                            <td>$no</td>
                            <td>$row[nama_pelanggan]</td>
                            <td>$row[jk]</td>
                            <td>$row[hp]</td>
                            <td>$row[alamat]</td>
                            <td>
                              <a href='../pelanggan/edit.php?id=$row[id]'>Edit</a> |
                              <a href='index.php?id=$row[id]'>Delete</a>
                            </td>
                          </tr>
                          ";
                    $no++;
                    }
                  }else{
                    echo "<td colspan='6'>Data Kosong</td>";
                  }

                    ?>
        
                </tbody>
              </table>
            </div>
          </div>
        </div>

        
      </div>
    
    

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script type="text/javascript" src="../../jquery.js"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
