<?php 

session_start();
include_once 'controller/user.php';
$user = new User();

if(isset($_REQUEST['submit'])){
  extract($_REQUEST);
  $login = $user->login($nama_user);
  if($login){}else{
    echo "Login Failed";
  }
}

 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">

    <title>Login</title>
  </head>
  <body>
    
    <div class="container">
        <div class="row content">
            <div class="col-md-6 mb-3">
                <img src="login.png" alt="" class="img-fluid" alt="image">
            </div>
            <div class="col-md-4">
                <h6 class="login-text mb-3">Login</h6>
                <form action="" method="post" onSubmit="return validasi()">
                    <div class="form-group">
                        <label for="">Nama User :</label>
                        <input type="text" class="form-control" name="nama_user" autofocus id="nama_user">
                    </div>
                    <button class="btn btn-outline-primary" type="submit" name="submit">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </body>
  <script type="text/javascript">
    function validasi() {
      var nama_user = document.getElementById("nama_user").value;
      if (nama_user != "") {
        return true;
      }else{
        alert('Nama harus di isi!');
        return false;
      }
    }
   
  </script>
</html>

