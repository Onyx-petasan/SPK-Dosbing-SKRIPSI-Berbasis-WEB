<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];
// Hapus matkul
if ($module=='matkul' AND $act=='hapus'){
  mysql_query("DELETE FROM matkul WHERE id_matkul='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
// Input matkul
elseif ($module=='matkul' AND $act=='input'){
  mysql_query("INSERT INTO matkul(nama_matkul) VALUES('$_POST[nama_matkul]')");
  header('location:../../media.php?module='.$module);
}

// Update matkul
elseif ($module=='matkul' AND $act=='update'){
  mysql_query("UPDATE matkul SET nama_matkul='$_POST[nama_matkul]' 
               WHERE id_matkul = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
