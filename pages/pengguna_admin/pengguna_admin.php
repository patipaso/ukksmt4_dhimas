<?php
@$pages=$_GET['aksi'];
switch($pages){
case 'tampil':
    include "tampil.php";
    break;
case 'tambah':
    include "tambah.php";
    break;
case 'edit':
    include "edit.php";
    break;
case 'delete':
    include "delete.php";
    break;
case 'proses_tambah':
    include "proses_tambah";
    break;
case 'proses delete':
    include "proses_delete.php";
    break;
case 'laporan':
    include "../laporan/laporan.php";
    break;
case 'view':
    include "view.php";
    break;



default:
    include "tampil.php";
    break;
}
?>