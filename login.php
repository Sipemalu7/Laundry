<?php
session_start();
include('koneksi.php');
if (isset($_POST['login_form']))
{
    $usern = $_POST['Username_Form'];
    $passw = $_POST['Password_Form'];
    $sql = "SELECT * FROM user WHERE Username = '$usern'";
    $select = mysqli_query($Koneksi,$sql);
    $data = mysqli_fetch_assoc($select);
    $cek = mysqli_num_rows($select);
    if ($cek > 0){
        if (password_verify($passw,$data['password'])) {
            $_SESSION['status'] = 'login';
            $_SESSION['level'] = $data ['level'];
            $_SESSION['nama_user'] = $data ['nama_user'];
            $_SESSION['id_user']= $data ['id_user'];
            
            ?> 
            <script>
            alert ('Anda Berhasil login');
            location.href = 'http://localhost/16_Penjualan_Insaanul/index.php';
            </script>
        <?php
    }
    else
    {
       ?>
        <script>
        alert('Username dan Password Salah');
        location.href = 'http://localhost/16_Penjualan_Insaanul/login.php'  ;
        </script>
        <?php 
       
           }
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap-5.2.0-dist/css/bootstrap.css">
    <style>
        body {
            background-image: url('image/a.gif');
            width: 100%;
            height: 100%;
            background-size: 100%;
        }
        </style>
</head>
<body>
    <div class="container container-fluid">
        <div class="row">
        <div class="col-8"></div>
        <div class="col-3 bg-light bg-opacity-50 pt-5 vh-100" >
            <center><h1>Admin login</h1></center>
            <form action="" method="POST" class="mt-5">
                <div class="form-group mb-2">
                    <input type="text" class="form-control" name="Username_Form" id="floatingInput" placeholder="Username">
                </div>
                <div class="form-group mb-2">
                    <input type="password" class="form-control" name="Password_Form" id="floatingInput" placeholder="Password">
                </div>
                <div class="form-group mb-2">
                <button class="btn btn-outline-light" type="submit" name="login_form">Login</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</body>
</html>