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

if ($module=='hasil' AND $act=='hapus'){
  mysql_query("DELETE FROM hasil WHERE nisn='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
// Input user
elseif ($module=='hasil' AND $act=='input'){
mysql_query("DELETE FROM hasil");
$kuota=$_POST[kuota];
	$tampil = mysql_query("SELECT * FROM siswa ORDER BY skor DESC LIMIT $kuota");
    while ($r=mysql_fetch_array($tampil)){
	$nisn=$r[nisn];
    mysql_query("INSERT INTO hasil(nisn) 
               VALUES('$nisn')");
    }	
  echo "<script>window.alert('Data berhasil disimpan');
        window.location=('../../media.php?module=hasil')</script>";
}

}
?>
