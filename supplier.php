<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['status'])) {
    include('koneksi.php');
    $status = '';
    $ns = '';
    $nt = '';

    // struktur kontrol 'if' mengecek keberadaan index 'proses' diURL brower, jika ada maka jalankan program didalamnya
    if (isset($_GET['proses']))
    {
        // struktur kontrol 'if' mengecek isi dari index 'proses'. Jika isinya adalah delete
        if ($_GET['proses']=='delete')
        {
            $id = $_GET['id'];
            $sql = "DELETE FROM supplier where id_supplier='$id'";
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
            $sql = "SELECT * FROM supplier WHERE id_supplier = '$id'";
            $select = mysqli_query($Koneksi,$sql);
            $data = mysqli_fetch_assoc($select);
            $ns = $data['nama_supplier'];
            $nt = $data['no_tlp'];
        }
    }

    if (isset($_POST['simpan']))
    {
        $ns = $_POST['nama_supplier'];
        $nt = $_POST['no_tlp'];;

        if (isset($_GET['proses']))
        {
            if ($_GET['proses']=='edit')
            {
                $id = $_GET['id'];
                $sql = "UPDATE supplier SET nama_supplier='$ns',
                no_tlp='$nt' where id_supplier='$id' ";

                $update = mysqli_query($koneksi,$sql);

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

            $sql = "INSERT INTO supplier VALUES ('','$ns','$nt')";

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
                <?php
                                if ($status == 'sukses')
                                {
                            ?>
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong><?php echo $pesan1 ?></strong><?php echo $pesan2 ?>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                                <script type="text/JavaScript">
                                    setTimeout("location.href = 'http://localhost/16_Penjualan_Insaanul/index.php?page=supplier';", 2000);
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
                                    setTimeout("location.href = 'http://localhost/16_Penjualan_Insaanul/index.php?page=supplier';", 1500);
                                </script>
                            <?php
                                }
                ?>
                <div class="card border-text-bg-dark mb-2">
                    <div class="card-header">
                      supplier
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-floating mb-2">
                                <input value="<?php echo $ns ?>" class="form-control" type="text" name="nama_supplier" id="nama_supplier" placeholder="nama_supplier" required>
                                <label class="form-label" for="nama_supplier">Nama Supplier</label>
                                <div class="invalid-feedback">
                                    Harap Isi Nama Supplier
                                </div>
                            </div>
                            <div class="form-floating mb-2">
                                <input value="<?php echo $nt ?>" class="form-control" type="text" name="no_tlp" id="no_tlp" placeholder="no_tlp" required>
                                <label class="form-label" for="no_tlp">No Telp</label>
                                <div class="invalid-feedback">
                                    Harap Isi No Telp
                                </div>
                            </div>
                            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div> <!-- ini tutup div col2 row1 -->
            <div class="col-8">
                    <div class="card-body">
                        <table class="table table-hover text-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama suplier</th>
                                <th>No Telp</th>
                                <th>Edit & DELETE</th>
                            </tr>
                            <?php
                                $sql = "SELECT * FROM supplier";
                                $select = mysqli_query($Koneksi,$sql);
                               
                                // variable untuk nilai awal nomor urut label
                                $urut = 1;

                                // convert hasil query ke variable data array
                                while($data= mysqli_fetch_assoc($select))
                                {
                            ?>
                            <tr>
                                <td><?php echo $urut ?></td>
                                <td><?php echo $data['nama_supplier'];?></td>
                                <td><?php echo $data['no_tlp'];?></td>
                                <td>
                                    <a href="?page=supplier&proses=edit&id=<?php echo $data['id_supplier']?>"><button class="btn btn-warning">Edit</button></a>
                                    <a href="?page=supplier&proses=delete&id=<?php echo $data['id_supplier']?>"><button class="btn btn-danger">Delete</button></a>
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