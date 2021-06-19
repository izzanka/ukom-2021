<?php
session_start();
include_once '../../controller/user.php';
include_once '../../controller/pelanggan.php';
include_once '../../controller/menu.php';
include_once '../../controller/pesanan.php';

$user = new User();
$pelanggan = new Pelanggan();
$menu = new Menu();
$pesanan = new Pesanan();
$index_pelanggan = $pelanggan->index();
$index_menu = $menu->index();
$index_pesanan = $pesanan->index();

if(!$user->check_session()){
  header("location:../index.php");
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

    <title>Laporan Index</title>
    <style type="text/css">
        body {
            padding-top: 56px;
        }
    </style>
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
          <a class="navbar-brand">Laporan Index</a>
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
              Data Pesanan
            </div>
            <div class="card-body">
              <table class="table table-bordered table-sm">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Harga Menu</th>
                    <th>Nama User</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Waktu</th>
   
                  </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if(is_array($index_pesanan)){
                      foreach($index_pesanan as $row){
                        echo "
                        <tr>
                          <td>$no</td>
                          <td>$row[nama_menu]</td>
                          <td>Rp. " . number_format($row['harga']) . "</td>
                          <td>$row[nama_user]</td>
                          <td>$row[jumlah]</td>
                          <td>Rp. " . number_format($row['total_harga']) . "</td>
                          <td>$row[status]</td>
                          <td>$row[waktu]</td>
                        </tr>
                            ";
                        $no++;
                        }
                    }
                  else{
                    echo "<td colspan='9'>Data kosong</td>";
                  }
                    ?>
        
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
         <div class="col-md-12">
          <div class="card mt-5">
            <div class="card-header">
              Data Menu
            </div>
            <div class="card-body">
              <table class="table table-bordered table-sm">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Harga Menu</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if(is_array($index_menu)){
                      foreach($index_menu as $row){
                          echo "
                          <tr>
                            <td>$no</td>
                            <td>$row[nama_menu]</td>
                            <td>Rp. " . number_format($row['harga']) . "</td>
                          </tr>
                          ";
                      $no++;
                      }
                    }else{
                      echo "<td colspan='4'>Data kosong</td>";
                    }
                    ?>
        
                </tbody>
              </table>
            </div>
          </div>
        </div>

         <div class="col-md-12">
          <div class="card mt-5 mb-5">
            <div class="card-header">
              Data Pelanggan
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
                  </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if(is_array($index_pelanggan)){
                    foreach($index_pelanggan as $row){
                        if($row['jk'] == 0){
                          $jk = "pria";
                          echo "
                          <tr>
                            <td>$no</td>
                            <td>$row[nama_pelanggan]</td>
                            <td>$jk</td>
                            <td>$row[hp]</td>
                            <td>$row[alamat]</td>
                          </tr>
                          ";
                        }else if($row['jk'] == 1){
                          $jk = "perempuan";
                          echo "
                          <tr>
                            <td>$no</td>
                            <td>$row[nama_pelanggan]</td>
                            <td>$jk</td>
                            <td>$row[hp]</td>
                            <td>$row[alamat]</td>
                          </tr>
                          ";
                        }
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
