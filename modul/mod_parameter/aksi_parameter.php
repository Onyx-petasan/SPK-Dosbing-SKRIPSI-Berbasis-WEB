<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus parameter
if ($module=='parameter' AND $act=='hapus'){
  mysql_query("DELETE FROM parameter WHERE id_sukriteriab='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input parameter
elseif ($module=='parameter' AND $act=='input'){
  mysql_query("INSERT INTO parameter(id_kriteria,nama_parameter,nilai) VALUES('$_POST[kriteria]','$_POST[nama_parameter]','$_POST[nilai]')");
  header('location:../../media.php?module='.$module);
}

// Update parameter
elseif ($module=='parameter' AND $act=='update'){
$kriteria=$_POST[kriteria];
$nilai=$_POST[nilai];
$cek=mysql_query("SELECT * FROM parameter WHERE id_kriteria='$kriteria' AND nilai='$nilai' AND id_parameter!='$_POST[id]'");
$ketemu=mysql_num_rows($cek);
if ($ketemu > 0){
	echo"
	<p align=center>Maaf! Bobot Nilai Tidak boleh sama<br />
  	    <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>
			</b></p>";
	}
	else {
  mysql_query("UPDATE parameter SET nama_parameter = '$_POST[nama_parameter]',
									  nilai = '$_POST[nilai]',
									id_kriteria = '$_POST[kriteria]'
									WHERE id_parameter = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
}
?>
