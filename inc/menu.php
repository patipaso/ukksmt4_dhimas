<?php
$pages=$_GET['pages'];

switch($pages){
case 'dashboard':
    include "../pages/master/dashboard.php";
    break;
case 'login':
    include "../pages/master/login.php";
    break;
case 'register':
    include "../pages/master/register.php";
    break;
case 'tabel':
    include "../pages/master/table.php";
    break;
case 'form':
    include "../pages/master/form.php";
    break;
case 'invoice':
    include "../pages/master/invoice.php";
    break;
case 'pengguna_admin':
    include "../pages/pengguna_admin/pengguna_admin.php";
    break;
case 'pengulangan':
    include "../pages/pengulangan/";
    break;



default:
    include "../inc/dashboard.php";
    break;
}
?>