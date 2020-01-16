<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];
$tgl_skrg = date("Y-m-d");
// Hapus tugasakhir
if ($module=='tugasakhir' AND $act=='hapus'){
  mysql_query("DELETE FROM tugasakhir WHERE id_tugasakhir='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input tugasakhir
elseif ($module=='tugasakhir' AND $act=='input'){
  mysql_query("INSERT INTO tugasakhir(judul,
									  nim,
									  nama_mahasiswa,
									  id_parameter,
									  tgl_input) 
							VALUES('$_POST[judul]',
									'$_POST[nim]',
									'$_POST[nama_mahasiswa]',
									'$_POST[parameter]',
									'$tgl_skrg')");
  header('location:../../media.php?module='.$module);
}

// Update tugasakhir
elseif ($module=='tugasakhir' AND $act=='update'){
  mysql_query("UPDATE tugasakhir SET judul = '$_POST[judul]',
									 nim = '$_POST[nim]',
									 status = '$_POST[status]',
									 nama_mahasiswa = '$_POST[nama_mahasiswa]',
									 id_parameter = '$_POST[parameter]'
							WHERE id_tugasakhir = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
