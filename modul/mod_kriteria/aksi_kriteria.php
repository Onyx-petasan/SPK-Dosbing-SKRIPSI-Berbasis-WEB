<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus kriteria
if ($module=='kriteria' AND $act=='hapus'){
  mysql_query("DELETE FROM kriteria WHERE id_kriteria='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kriteria
elseif ($module=='kriteria' AND $act=='input'){
  mysql_query("INSERT INTO kriteria(nama_kriteria,bobot,jenis) VALUES('$_POST[nama_kriteria]','$_POST[bobot]','$_POST[jenis]')");
  header('location:../../media.php?module='.$module);
}

// Update kriteria
elseif ($module=='kriteria' AND $act=='update'){
  mysql_query("UPDATE kriteria SET nama_kriteria = '$_POST[nama_kriteria]',bobot = '$_POST[bobot]',jenis = '$_POST[jenis]' WHERE id_kriteria = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
