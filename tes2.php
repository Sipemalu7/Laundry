<?php
if ($lv == '')
{
    ?>
    <option value=""> -- pilih level-- </option>
    <?php
}else{
    ?>
    <option value="<?php echo $lv  ?>">
    <?php  
    $sql = "SELECT * FROM level WHERE id_level = '$lv'";
    $query = mysqli_query($Koneksi,$mysql);
    $data = mysqli_fetch_assoc($query);
    echo $data['nama_level'];
    ?>
    </option>

    <?php
}
?>