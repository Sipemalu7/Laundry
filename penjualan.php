<?php 
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['status'])) {
//variable script code koneksi database dari file koneksi.php
include('koneksi.php');

$status = '';
$tp ='';
$tpm ='';
$iu='';

if (isset($_GET['proses'])){
    if($_GET['proses']=='delete')
    {
        $id = $_GET['id'];
        $sql = "DELETE FROM penjualan WHERE id_penjualan='$id' ";
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
        $sql = "SELECT * FROM penjualan WHERE id_penjualan = '$id'";
        $select = mysqli_query($Koneksi,$sql);
        $data = mysqli_fetch_assoc($select);
        $tp = $data['tgl_pembayaran'];
        $tpm = $data['total_pembayaran'];
        $iu = $data['id_user'];
    }
}
if (isset($_POST['simpan']))
{
    $tp = $_POST['tgl_pembayaran'];
    $tpm = $_POST['total_pembayaran'];
    $iu = $_POST['id_user'];
    //$sql = "INSERT INTO barang (nama_barang,harga_barang,stok_barang,supplier)
    //        VALUES ('$nb','$hb','$sb','$sp')";
    if(isset($_GET['proses'])){
        if ($_GET['proses']=='edit'){
            $id = $_GET['id'];
            $sql = "UPDATE penjualan SET tgl_penjualan = '$tp'
            total_pembayaran = '$tpm',
            id_user = '$iu'
            WHERE id_penjualan = '$id' ";
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
    $sql = "INSERT INTO penjualan VALUES ('','$tp','$tpm','$iu')";
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
            <link rel="stylesheet" href="bootstrap-5.2.0-dist/css/bootstrap.css">
            <?php
                    if($status == 'sukses')
                    {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?php echo $pesan1 ?></strong><?php echo $pesan2 ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                        </div>
                        <script type="text/JavaScript">
                            setTimeout("location.href= 'http://localhost/16_Penjualan_Insaanul/index.php?page=penjualan';", 1500);
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
                            setTimeout("location.href= 'http://localhost/16_Penjualan_Insaanul/index.php?page=penjualan';", 1500);
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
                         DATA PENJUALAN
                    </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-floating mb-3">
                                    <input value ="<?php echo $tp ?>" class="form-control" type="date" name="tgl_pembayaran" id="floatingInput" placeholder="tgl_pembayaran">
                                    <label class="form-label" for="floatingInput">Tanggal Pembayaran</label>
                                </div>   
                            <div class="form-group mb-3">
                               <select class="form-control" name="nama_barang">
                                   <?php
                                    if ($nb == '') 
                                    {
                                   ?>
                                    <option value="">--PILIH BARANG--</option>
                                    <?php
                                    }else{
                                        ?>
                                        <option value="<?php echo $nb ?>">
                                        <?php 
                                        $sql = "SELECT * FROM barang WHERE id_barang= '$id'";
                                        $query = mysqli_query($Koneksi,$sql);
                                        $data = mysqli_fetch_assoc($query);
                                        echo $data['nama_barang'];
                                        ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                              
                               <?php
                               $sql = "SELECT * FROM barang";
                               $query = mysqli_query($Koneksi,$sql);
                               while ($data = mysqli_fetch_assoc($query)){
                               ?>

                                <option value="<?php echo $data['id_barang']?>">
                                <?php echo $data['nama_barang']?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                            </div>
                                <div class="form-floating mb-3">
                                    <input value ="<?php echo $iu ?>" class="form-control" type="number" name="total_pembayaran" id="floatingInput" placeholder="id_user">
                                    <label class="form-label" for="floatingInput">Total Barang</label>
                                </div>             
                                <div class="form-floating mb-3">
                                    <input value ="<?php echo $iu ?>" class="form-control" type="text" name="id_user" id="floatingInput" placeholder="id_user">
                                    <label class="form-label" for="floatingInput">ID User</label>
                                </div>              
                                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                            </form>
                        </div>
                    </div>
                    
                </div><!-- ini tutup div col2 row1-->
                <div class="col-8">
                    <table class="table table text-dark">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Barang</th>
                            <th>total_pembayaran</th>
                            <th>Id User</th>
                            <th>Edit & DELETE</th>
                        </tr>
                        <?php
                        $sql = "SELECT * FROM penjualan";
                        $select =  mysqli_query($Koneksi,$sql);
                        
                        //variable untuk nilai awal nomor urut table
                        $urut=1;

                        // convert hasil query ke variable data array
                        while($data= mysqli_fetch_assoc( $select ))
                        {
                        ?>
                        <tr>
                            <td><?php echo $urut ?></td>
                            <td><?php echo $data['tgl_pembayaran']; ?></td>
                            <td><?php echo $data['nama_barang']; ?></td>
                            <td><?php echo $data['total_pembayaran']; ?></td>
                            <td><?php echo $data['id_user']; ?></td>
                            <td>
                            <a href="?page=penjualan&proses=edit&id=<?php echo $data['id_penjualan'] ?>"><button class="btn btn-warning">edit</button>
                            <a href="?page=penjualan&proses=delete&id=<?php echo $data['id_penjualan'] ?>"><button class="btn btn-danger">delete</button>
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
            
<?php
}else{
    ?>
        <script>
            alert('anda belum login');
            location.href="http://localhost/16_Penjualan_Insaanul/login.php";
        </script>
    <?php

}
?>