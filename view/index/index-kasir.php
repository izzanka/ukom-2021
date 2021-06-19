<?php
session_start();
include_once '../../controller/user.php';

$user = new User();

if(!$user->check_session()){
  header("location:../../index.php");
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

    <title>Kasir</title>
    <style type="text/css">
        body {
            padding-top: 56px;
        }
    </style>
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
          <a class="navbar-brand">Kasir</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="../transaksi/index.php">Transaksi</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../laporan/index.php">Laporan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../../logout.php">Logout</a>
                </li>
              </ul>
            </div>
        </div>
      </nav>

      
    
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script type="text/javascript" src="../../jquery.js"></script>
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
