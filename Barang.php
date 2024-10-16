<?php 
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['status'])) {
    $id_user = $_SESSION['id_user'];

include('koneksi.php');

$status         ='';
$id_kategori    ='';
$nama_barang    ='';
$harga_barang   ='';
$stok_barang    ='';
$id_supplier    ='';
$id_user        ='';

if (isset($_GET['proses'])){
    if($_GET['proses']=='delete')
    {
        // menggunakan method GET, ambil data barang 'id' di url browser dan simpan pada variable $id
        $id = $_GET['id'];

        //simpan sebuah query delete kedalam variable baru yaitu variable $sql
        $sql = "DELETE FROM barang WHERE id_barang ='$id' ";

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
        $sql = "SELECT * FROM barang WHERE id_barang = '$id'";
        $select = mysqli_query($Koneksi,$sql);
        $data = mysqli_fetch_assoc($select);
        $id_kategori    = $data['id_kategori'];
        $nama_barang    = $data['nama_barang'];
        $harga_barang   = $data['harga_barang'];
        $stok_barang    = $data['stock'];
        $id_supplier    = $data['id_supplier'];
        $id_user        = $data['id_user'];
    }
}
if (isset($_POST['simpan']))
{
    $id_kategori    = $_POST['id_kategori_form'];
    $nama_barang    = $_POST['nama_barang_form'];
    $harga_barang   = $_POST['harga_barang_form'];
    $stok_barang    = $_POST['stock_form'];
    $id_supplier    = $_POST['id_supplier_form'];
    
    $id_user        = $_SESSION['id_user'];
    
    //$sql = "INSERT INTO barang (nama_barang,harga_barang,stok_barang,supplier)
    //        VALUES ('$nb','$hb','$sb','$sp')";
    if(isset($_GET['proses'])){
        if ($_GET['proses']=='edit'){
            $id = $_GET['id'];
            $sql = "UPDATE barang SET id_kategori_form = '$id_kategori',nama_barang_form = '$nama_barang',
            harga_barang_form = '$harga_barang',
            stock_form = '$stok_barang',
            id_supplier_form = '$id_supplier',
            id_user = '$id_user' WHERE id_barang = '$id' ";
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
    $sql = "INSERT INTO barang VALUES ('','$id_kategori','$nama_barang','$harga_barang','$stok_barang','$id_supplier','$id_user')";
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
                            setTimeout("location.href= 'http://localhost/16_Penjualan_Insaanul/index.php?page=barang';", 1500);
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
                            setTimeout("location.href= 'http://localhost/16_Penjualan_Insaanul/index.php?page=barang';", 1500);
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
                         DATA BARANG
                    </div>
                        <div class="card-body">
                            <form action="" method="post">
                            <div class="form-group mb-3">
                               <select class="form-control" name="id_kategori_form">
                               <?php
                                        if ($id_kategori == '')
                                        {
                                            ?>
                                            <option value=""> -- PILIH KATEGORI-- </option>
                                <?php
                                        }else{
                                ?>
                                            <option value="<?php echo $id_kategori  ?>">
                                            <?php  
                                            $sql = "SELECT * FROM kategori WHERE id_kategori = '$id_kategori'";
                                            $query = mysqli_query($Koneksi,$sql);
                                            $data = mysqli_fetch_assoc($query);
                                            echo $data['nama_kategori'];
                                            ?>
                                            </option>

                                <?php
                                        }
                                ?>
                                <?php
                                        $sql = "SELECT * FROM kategori";
                                        $query = mysqli_query($Koneksi,$sql);
                                        while ($data = mysqli_fetch_assoc($query)){
                                ?>

                                        <option value="<?php echo $data ['id_kategori'] ?>">
                                        <?php echo $data['nama_kategori'] ?>
                                        </option>
                                <?php
                                        }
                                ?>
                               </select>
                            </div>                        
                                <div class="form-floating mb-3">
                                    <input value ="<?php echo $nama_barang ?>"  class="form-control" type="text" name="nama_barang_form"  placeholder="nama_barang">
                                    <label class="form-label">Nama Barang</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input value ="<?php echo $harga_barang ?>" class="form-control" type="text" name="harga_barang_form"  placeholder="harga_barang">
                                    <label class="form-label">Harga Barang</label>
                                </div>   
                                <div class="form-floating mb-3">
                                    <input value ="<?php echo $stok_barang ?>" class="form-control" type="text" name="stock_form"  placeholder="stock">
                                    <label class="form-label">Stok Barang</label>
                                </div>    
                                <div class="form-grup mb-3">
                                    <select class="form-control" name="id_supplier_form">
                               <?php
                                        if ($id_kategori == '')
                                        {
                                            ?>
                                            <option value="">-- PILIH SUPPLIER--</option>
                                <?php
                                        }else{
                                ?>
                                            <option value="<?php echo $id_supplier  ?>">
                                <?php  
                                            $sql = "SELECT * FROM supplier WHERE id_supplier = '$id_supplier'";
                                            $query = mysqli_query($Koneksi,$sql);
                                            $data = mysqli_fetch_assoc($query);
                                            echo $data['nama_supplier'];
                                ?>
                                            </option>

                                <?php
                                        }
                                ?>
                                <?php
                                        $sql = "SELECT * FROM supplier";
                                        $query = mysqli_query($Koneksi,$sql);
                                        while ($data = mysqli_fetch_assoc($query)){
                                ?>

                                        <option value="<?php echo $data ['id_supplier'] ?>">
                                        <?php echo $data['nama_supplier'] ?>
                                        </option>
                                <?php
                                        }
                                ?>
                               </select>
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
                            <th>kategori</th>
                            <th>Nama Barang</th>
                            <th>Harga Barang</th>
                            <th>Stok Barang</th>
                            <th>Supplier</th>
                            <th>Edit & DELETE</th>
                        </tr>
                        <?php
                        $sql = "SELECT * FROM barang";
                        $select =  mysqli_query($Koneksi,$sql);
                        
                        //variable untuk nilai awal nomor urut table
                        $urut=1;

                        // convert hasil query ke variable data array
                        while($data= mysqli_fetch_assoc( $select ))
                        {
                        ?>
                        <tr>
                            <td><?php echo $urut ?></td>
                            <td>
                            <?php
                                    $id1 = $data['id_kategori'];
                                    $sql1 = "SELECT * FROM kategori WHERE id_kategori =$id1";
                                    $query1 = mysqli_query($Koneksi,$sql1);
                                    $data1 = mysqli_fetch_assoc($query1);
                                    echo $data1['nama_kategori'];

                                    ?>
                            </td>
                            <td><?php echo $data['nama_barang']; ?></td>
                            <td><?php echo $data['harga_barang']; ?></td>
                            <td><?php echo $data['stock']; ?></td>
                            <td>
                            <?php
                                    $id2 = $data['id_supplier'];
                                    $sql1 = "SELECT * FROM supplier WHERE id_supplier = $id2";
                                    $query1 = mysqli_query($Koneksi,$sql1);
                                    $data1 = mysqli_fetch_assoc($query1);
                                    echo $data1['nama_supplier'];

                                    ?>
                            </td>

                            <td>
                            <a href="?page=barang&proses=edit&id=<?php echo $data['id_barang'] ?>"><button class="btn btn-warning">edit</button>
                            <a href="?page=barang&proses=delete&id=<?php echo $data['id_barang'] ?>"><button class="btn btn-danger">delete</button>
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
                alert('Anda belum login');
                location.href="http://localhost/16_Penjualan_Insaanul/login.php";
        </script>
<?php
        }
?>
