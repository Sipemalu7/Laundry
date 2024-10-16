<?php

$rahasia = password_hash("rahasia",PASSWORD_BCRYPT);
echo "ini password hasil enkripsi yang di simpan di database : $rahasia <br>";
echo "<br>";
// proses verifikasi hasil enkripsi dengan data login

$pass_login = "rahasia";
echo "ini password yang diketik pada saat login : $pass_login <br>";
$verifi = password_verify($pass_login, $rahasia);
echo $verifi;

// jika hasil nya angka 1, maka password yang di import pada saat login dengan password database(enkripsi)
// password (enkripsi) yang ada di database, cocol

?>