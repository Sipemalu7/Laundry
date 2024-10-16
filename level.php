<?php 
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['status'])) {
//variable script code koneksi database dari file koneksi.php
include('koneksi.php');

$status = '';
$nama_level ='';

if (isset($_GET['proses'])){
    if($_GET['proses']=='delete')
    {
        // menggunakan method GET, ambil data barang 'id' di url browser dan simpan pada variable $id
        $id = $_GET['id'];

        //simpan sebuah query delete kedalam variable baru yaitu variable $sql
        $sql = "DELETE FROM level WHERE id_level='$id' ";

        //jalankan perintah eksekusi query menggunakan mysqli_query dan simpan pada variable $id 

        $delete = mysqli_query($Koneksi,$sql);
        if ($delete)
        {
            $status = 'delete';
            $pesan1 = 'Data Gagal di DELETE';
            $pesan2 = 'Cek lagi, mungkin ada kode program yang salah!';
        }
        else
        {   
            $status = 'sukses';
            $pesan1 = 'Data Berhasil di DELETE';
            $pesan2 = 'Mudah-mudahan datanya terhapus di DATABASE!';
        }
    }
    if($_GET['proses']=='edit')
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM level WHERE id_level = '$id'";
        $select = mysqli_query($Koneksi,$sql);
        $data = mysqli_fetch_assoc($select);
        $nama_level = $data['nama_level'];
    }
}
if (isset($_POST['simpan']))
{
    $nama_level = $_POST['nama_level'];

    if(isset($_GET['proses'])){
        if ($_GET['proses']=='edit'){
            $id = $_GET['id'];
            $sql = "UPDATE level SET nama_level = '$nama_level'
            WHERE id_level = '$id' ";
            $update = mysqli_query($Koneksi,$sql);
            if(!$update){
                $status = 'gagal';
                $pesan1 = 'Data Gagal di UPDATE';
                $pesan2 = 'Cek Lagi program anda';
            }
            else{
                $status = 'sukses';
                $pesan1 = 'Data Berhasil di UPDATE';
                $pesan2 = 'Alhamdulillah berhasil di update';
            }
        }

    }
    else
    {
    $sql = "INSERT INTO level VALUES ('','$nama_level')";
    $insert = mysqli_query($Koneksi,$sql);
    if (!$insert)
    {
        $status = 'gagal';
        $pesan1 = 'Data Gagal di simpan';
        $pesan2 = 'Cek lagi, mungkin ada kesalahan';
    }
    else
    {
        $status = 'sukses';
        $pesan1 = 'Data Berhasil di simpan';
        $pesan2 = 'Mudah-mudahan datanya tersimpan';
    }
}
}
?>

        <!-- start baris 1-->           
        <div class="row">
            <div class="col-4"><!--start kolom2-->
            <?php
                    if($status == 'sukses')
                    {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?php echo $pesan1 ?></strong><?php echo $pesan2 ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                        </div>
                        <script type="text/JavaScript">
                            setTimeout("location.href= 'http://localhost/16_Penjualan_Insaanul/index.php?page=level';", 1500);
                        </script>
                    <?php
                    }
                    if ($status == 'gagal')
                    {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $pesan1 ?></strong><?php echo $pesan2 ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <script type="text/JavaScript">
                            setTimeout("location.href= 'http://localhost/16_Penjualan_Insaanul/index.php?page=level';", 1500);
                        </script>
                    <?php
                        }
                    ?>
            </div><!-- end of kolom 2-->
        </div>
        <!-- end of baris 1-->
        <!-- start baris 2-->
        <div class="row">
            <div class="col-4">        
                <div class="card mt-2">
                    <div class="card-header">
                         From Input level
                    </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-floating mb-2">
                                    <input value ="<?php echo $nama_level ?>"  class="form-control" type="text" name="nama_level" id="nama_level" placeholder="nama_level">
                                    <label class="form-label">Nama level</label>
                                </div>
                                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                            </form>
                        </div>
                    </div>
                    
                </div><!-- ini tutup div col2 row1-->
                <div class="col-8">
                        <table class="table table-hover text-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama level</th>
                            <th>Edit & Delete</th>
                        </tr>
                        <?php
                        $sql = "SELECT * FROM level";
                        $select =  mysqli_query($Koneksi,$sql);
                        
                        //variable untuk nilai awal nomor urut table
                        $urut=1;

                        // convert hasil query ke variable data array
                        while($data= mysqli_fetch_assoc( $select ))
                        {
                        ?>
                        <tr>
                            <td><?php echo $urut ?></td>
                            <td><?php echo $data['nama_level']; ?></td>
                            <td>
                            <a href="?page=level&proses=edit&id=<?php echo $data['id_level'] ?>"><button class="btn btn-warning">edit</button>
                            <a href="?page=level&proses=delete&id=<?php echo $data['id_level'] ?>"><button class="btn btn-danger">delete</button>
                            </td>
                        </tr>
                        <?php

                        //increment variable $urut, sehingga nilainya bertambah 1 setiap kali looping
                        $urut++;
                        }
                        ?>                   
                    </table>
                </div>
            </div>
         </div>
        </div>
           
<?php
    }else{

    
?>
        <script>
        alert('Anda belum login');
        location.href="http://localhost/16_Penjualan_Insaanul/login.php";
        </script>
<?php
        }
?>
