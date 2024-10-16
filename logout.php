<?php
session_start();
session_destroy();
?>
<script>
    alert('Anda berhasil Logout!!!!!');
    location.href = "http://localhost/16_Penjualan_Insaanul/login.php";
</script>