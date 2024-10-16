<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['status'])) {
 

    include('koneksi.php');
    $status = '';
    $nu = '';
    $lv = '';
    $un = '';
    $pw = '';

    // struktur kontrol 'if' mengecek keberadaan index 'proses' diURL brower, jika ada maka jalankan program didalamnya
    if (isset($_GET['proses'])) 
    {
        // struktur kontrol 'if' mengecek isi dari index 'proses'. Jika isinya adalah delete
        if ($_GET['proses']=='delete') 
        {
            $id = $_GET['id'];
            $sql = "DELETE FROM user where id='$id'";
            $delete = mysqli_query($Koneksi,$sql);
            
            if (!$delete)
            {
                $status = 'delete';
                $pesan1 = 'Data Gagal di DELETE';
                $pesan2 = 'Coba cek lagi, mungkin ada kode program yang salah!!!';                      
            }
            else
            {
                $status = 'sukses';
                $pesan1 = 'Data Berhasil di DELETE';
                $pesan2 = ' Anda Berhasil menghapus DataBase';
            }
        }
        if ($_GET['proses']=='edit') 
        {
            $id = $_GET['id'];
            $sql = "SELECT * FROM user WHERE id_user = '$id'";
            $select = mysqli_query($Koneksi,$sql);
            $data = mysqli_fetch_assoc($select);
            $nu = $data['nama_user'];
            $lv = $data['level'];
            $un = $data['username'];
             // $pw = $data['password'];
        }
    }

    if (isset($_POST['simpan']))
    {
        $nu = $_POST['nama_user_form'];
        $lv = $_POST['level_form'];
        $un = $_POST['username_form'];
        $pw = $_POST['password_form'];
        $rahasia = password_hash($pw,PASSWORD_BCRYPT);

        if (isset($_GET['proses'])) 
        {
            if ($_GET['proses']=='edit') 
            {
                $id = $_GET['id'];
                $sql = "UPDATE user SET nama_user='$nu',
                level='$lv', username='$un', password='$pw'
                where id ='$id' ";

                $update = mysqli_query($Koneksi,$sql);

                if (!$update)
                {
                    $status = 'edit';
                    $pesan1 = 'Data gagal Di Edit';
                    $pesan2 = 'Coba cek lagi, mungkin ada kode program yang salah!!!';
                }
                else
                {
                    $status = 'sukses';
                    $pesan1 = 'Data Berhasil di Edit';
                    $pesan2 = ' Anda Berhasil mengedit DataBase';
                }
            }
        }
        else
        {

            $sql = "INSERT INTO user VALUES ('','$nu','$lv','$un','$rahasia')";

            $insert = mysqli_query($Koneksi,$sql);

            if (!$insert) 
            {
            $status = 'gagal';
            $pesan1 = 'Data Gagal di DELETE';
            $pesan2 = 'Coba cek lagi, mungkin ada kode program yang salah!!!';
            }
            else
            {
            $status = 'sukses';
            $pesan1 = 'Data Berhasil di Simpan';
            $pesan2 = ' Anda berhasil menyimpan Data';
            }
        }
    }
?>


        <div class="row">
            <div class="col-4">
            <link rel="stylesheet" href="bootstrap-5.2.0-dist/css/bootstrap.css">
                <?php 
                                if ($status == 'sukses')
                                {
                            ?>
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong><?php echo $pesan1 ?></strong><?php echo $pesan2 ?>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                                <script type="text/JavaScript">
                                    setTimeout("location.href = 'http://localhost/16_Insaanul_Penjualan/index.php?page=user';", 2000);
                                </script>
                            <?php
                                }
                                if ($status == 'gagal'){
                            ?>
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong><?php echo $pesan1 ?></strong><?php echo $pesan2 ?>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                                <script type="text/JavaScript">
                                    setTimeout("location.href = 'http://localhost/16_Insaanul_Penjualan/index.php?page=user';", 1500);
                                </script>
                            <?php
                                }
                ?>
                <div class="card border-text-bg-dark mb-2">
                    <div class="card-header">
                        <center>Data User</center>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="g-2">
                            <div class="form-floating mb-2">
                                <input value="<?php echo $nu ?>" class="form-control" type="text" name="nama_user_form" id="floating input" placeholder="nama_user" required>
                                <label class="form-label" for="nama_barang">nama user</label>
                                <div class="invalid-feedback">
                                    Harap Isi Nama User
                                </div>
                                <br>
                            </div>
                            <div class="form-group mb-2">
                               <select class="form-control" name="level_form">
                               <?php
                                        if ($lv == '')
                                        {
                                            ?>
                                            <option value=""> -- PILIH LEVEL-- </option>
                                            <?php
                                        }else{
                                            ?>
                                            <option value="<?php echo $lv  ?>">
                                            <?php  
                                            $sql = "SELECT * FROM level WHERE id_level = '$lv'";
                                            $query = mysqli_query($Koneksi,$sql);
                                            $data = mysqli_fetch_assoc($query);
                                            echo $data['nama_level'];
                                            ?>
                                            </option>

                                            <?php
                                        }
                                        ?>
                                        <?php
                                        $sql = "SELECT * FROM level";
                                        $query = mysqli_query($Koneksi,$sql);
                                        while ($data = mysqli_fetch_assoc($query)){
                                        ?>

                                        <option value="<?php echo $data ['id_level'] ?>">
                                        <?php echo $data['nama_level'] ?>
                                        </option>
                                        <?php
                                        }
                                        ?>
                               </select>
                            </div>
                                <br>
                            
                            <div class="form-floating mb-2">
                                <input value="<?php echo $un ?>" class="form-control" type="text" name="username_form" id="ussername" placeholder="username" required>
                                <label class="form-label" for="username">Username</label>
                                <div class="invalid-feedback">
                                    Harap Isi Username
                                </div>
                                <br>
                            </div>
                            <div class="form-floating mb-2">
                                <input value="<?php echo $pw ?>" class="form-control" type="password" name="password_form" id="supplier" placeholder="password" required>
                                <label class="form-label" for="supplier">Password</label>
                                <div class="invalid-feedback">
                                    Harap Isi Nama Password
                                </div>
                                <br>
                            </div>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div> <!-- ini tutup div col2 row1 -->
            <div class="col-8">
                    <div class="card-body">
                        <table class="table table-hover text-dark">
                            <tr>
                                <th>id</th>
                                <th>nama user</th>
                                <th>level</th>
                                <th>username</th>
                                <th>password</th>
                            </tr>
                            <?php
                                $sql = "SELECT * FROM user";
                                $select = mysqli_query($Koneksi,$sql);
                                
                                // variable untuk nilai awal nomor urut label
                                $urut = 1;

                                // convert hasil query ke variable data array
                                while($data= mysqli_fetch_assoc($select))
                                {
                            ?>
                            <tr>
                                <td><?php echo $urut ?></td>
                                <td><?php echo $data['nama_user'];?></td>
                                <td>
                                    <?php
                                    $id1 = $data['level'];
                                    $sql1 = "SELECT * FROM level WHERE id_level =$id1";
                                    $query1 = mysqli_query($Koneksi,$sql1);
                                    $data1 = mysqli_fetch_assoc($query1);
                                    echo $data1['nama_level'];

                                    ?>
                                </td>
                                <td><?php echo $data['username']; ?></td>
                                <td>**********</td>
                                <td>
                                    <a href="?page=user&proses=edit&id=<?php echo $data['id_user']?>"><button class="btn btn-secondary">Edit</button></a>
                                    <a href="?page=user&proses=delete&id=<?php echo $data['id_user']?>"><button class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                            <?php
                            
                            // increment variable $urut, sehingga nilainya bertambah 1
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