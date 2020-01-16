<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus kompetensi
if ($module=='kompetensi' AND $act=='hapus'){
  mysql_query("DELETE FROM kompetensi WHERE id_kompetensi='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kompetensi
elseif ($module=='kompetensi' AND $act=='input'){
$kompetensi=$_POST[kompetensi];
$dosen=$_POST[dosen];
$cek=mysql_query("SELECT * FROM kompetensi WHERE id_dosen='$dosen' AND id_parameter='$kompetensi'");
$ketemu=mysql_num_rows($cek);
if ($ketemu > 0){
	echo"
	<p align=center>Maaf! Data Sudah Ada<br />
  	    <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>
			</b></p>";
	}
	else {
  mysql_query("INSERT INTO kompetensi(id_dosen,id_parameter,nilaii) VALUES('$_POST[dosen]','$_POST[kompetensi]','$_POST[nilaii]')");
  header('location:../../media.php?module='.$module);
  }
}

// Update kompetensi
elseif ($module=='kompetensi' AND $act=='update'){

  mysql_query("UPDATE kompetensi SET id_parameter = '$_POST[kompetensi]',
									  nilaii = '$_POST[nilaii]',
									id_dosen = '$_POST[dosen]'
									WHERE id_kompetensi = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  
}
?>
