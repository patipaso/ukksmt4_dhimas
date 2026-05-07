<?php
session_start();

$_SESSION = []; // mengsongkan session 
session_unset(); // menghapus semua session yang aktif
session_destroy(); // menghapus session

header("location: ../inc/login.php"); // mengarakan ke halaman lgin
exit();
?>