<?php
session_start();
include('koneksi.php');
if (isset($_SESSION['status'])){
    
    if ($_SESSION['status'] == 'login'){
        $nama= $_SESSION['nama_user'];
        $level = $_SESSION['level'];
        $sql = "SELECT * FROM level where id_level = $level";
        $query = mysqli_query($Koneksi,$sql);
        $data = mysqli_fetch_assoc($query);
        $nm_level = $data['nama_level'];

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Penjualan</title>
    <link rel="stylesheet" href="bootstrap-5.2.0-dist/css/bootstrap.css">
    
</head>
<body>
    <div class="container mt-1">
        <div class="row">
            <div class="col">
                <img class="img-fluid w-100" src="image/banner2.jpg" alt="">
    <style>
        body {
            background-image: url('image/2.gif');
            width: 100%;
            height: 100%;
            background-size: 100%;
        }
        </style>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <!-- navbar dari bootstrap-->
            <nav class="navbar navbar-expand-lg bg-info p-2 text-white bg-opacity-50 ">
                <div class="container-fluid">
                    <a class="navbar-brand text-dark" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                            <a class="nav-link active text-dark" aria-current="page" href="http://localhost/16_Penjualan_Insaanul">Home</a>
                            </li>
                            <?php
                                if ($nm_level == 'Super Admin'){
                                ?>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Manegement user
                            </a>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?page=level">level user</a></li>
                            <li><a class="dropdown-item" href="?page=user">user</a></li>
                            </ul>
                            </li>
                            <?php
                                }
                                if ($nm_level == 'Super Admin' || $nm_level == 'Manajer') {
                            ?>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Master Data
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="?page=barang">Barang</a></li>
                                <li><a class="dropdown-item" href="?page=supplier">Supplier</a></li>
                                <li><a class="dropdown-item" href="?page=kategori">Kategori</a></li>
                                <li><a class="dropdown-item" href="?page=other">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="?page=other">Lainnya...</a></li>
                            </ul>
                            </li>
                            <?php
                            if ($nm_level == 'Super Admin'|| $nm_level == 'Kasir'){
                            }
                            }
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" arial-expanded="false">
                                Transaksi
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="?page=penjualan">Penjualan</a></li>
                                    <li><a class="dropdown-item" href="#">Pembelian</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Lainnya...</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" arial-expanded="false">
                                Laporan
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Bulanan</a></li>
                                    <li><a class="dropdown-item" href="#">Tahunan</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Lainnya...</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="d-flex">
                            <a href="logout.php">
                            <button class="btn btn-outline-danger" type="submit">Logout</button>
                             </a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- end of navbar bootstrap-->
            </div>
        </div>
        <div class="row mt-1">
            <div class="col">
            <?php
            if (isset($_GET['page']))
            {
                $page = $_GET['page'];
                switch ($page)
                {
                    case 'user':
                        include('user.php');
                        break;
                    case 'barang';  
                        include('barang.php');
                        break;
                    case 'supplier';
                        include('supplier.php');
                        break;
                    case 'kategori';
                        include('kategori.php');
                        break;
                    case 'level';
                        include('level.php');
                        break;
                    case 'penjualan';
                        include('penjualan.php');
                        break;
                    default;    
                        echo "halaman yang tidak tersedia";
                        break;  


                }
            }
            else
            {
                echo "<h1 class='text-center text-dark mt-5'>Selamat Datang ".$_SESSION['nama_user']."</h1>";
            }
            ?>
            </div>
        </div>
        <div class="row">
            <div class="col bg-warning">
            <!--footer website-->
                <div class="fixed-bottom text-center pt-2 pb-2 bg-white"></div>
            <!-- end of footer website-->
            </div>
        </div>
    </div>  
    <script src="bootstrap-5.2.0-dist/js/bootstrap.js"></script>
    <script src="bootstrap-5.2.0-dist/js/bootstrap.bundle.js"></script>     
</body>
</html>
<?php
}

else
{
?>
    <script>
    alert('Nah kan masuk')
    location.href = 'http://localhost/16_Penjualan_Insaanul/login.php';
    </script>
    <?php
}

}
else
{
?>
    <script>
    alert('Ciee gagal masuk')
    location.href = 'http://localhost/16_Penjualan_Insaanul/login.php';
    </script>
    <?php
}

?>