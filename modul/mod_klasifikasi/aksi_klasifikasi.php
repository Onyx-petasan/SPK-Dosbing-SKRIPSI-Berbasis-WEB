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

if ($module=='siswa' AND $act=='hapus'){
  mysql_query("DELETE FROM siswa WHERE nisn='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
// Input user
elseif ($module=='siswa' AND $act=='input'){
$sql = mysql_query("SELECT * FROM siswa WHERE nisn='$_POST[nisn]'");
$ketemu=mysql_num_rows($sql);
	if ($ketemu > 0){
	echo"
	<p align=center>Maaf! NISN yang Anda masukkan sudah terdaftar, Silahkan ganti yang lain<br />
  	    <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>
			</b></p>";
	}
	else { 
  mysql_query("INSERT INTO siswa(nisn,
                                 nama_siswa,
                                 id_tahun,
								 pekerjaan_ortu,
								 penghasilan_ortu,
								 kondisi_rumah,
								 jml_tanggungan,
								 keadaan_ortu,
								 kendaraan) 
	                       VALUES('$_POST[nisn]',
                                '$_POST[nama_siswa]',
								'$_POST[tahun]',
								'$_POST[pekerjaan_ortu]',
								'$_POST[penghasilan_ortu]',
								'$_POST[kondisi_rumah]',
								'$_POST[jml_tanggungan]',
								'$_POST[keadaan_ortu]',
								'$_POST[kendaraan]')");
   $cek1=mysql_query("SELECT * FROM subkriteria WHERE nama_subkriteria='$_POST[pekerjaan_ortu]'");
    $r1=mysql_fetch_array($cek1);
	$k1=$r1[nilai];
	$cek2=mysql_query("SELECT * FROM subkriteria WHERE nama_subkriteria='$_POST[penghasilan_ortu]'");
    $r2=mysql_fetch_array($cek2);
	$k2=$r2[nilai];
	$cek3=mysql_query("SELECT * FROM subkriteria WHERE nama_subkriteria='$_POST[kondisi_rumah]'");
    $r3=mysql_fetch_array($cek3);
	$k3=$r3[nilai];
	$cek5=mysql_query("SELECT * FROM subkriteria WHERE nama_subkriteria='$_POST[jml_tanggungan]'");
    $r5=mysql_fetch_array($cek5);
	$k5=$r5[nilai];
	$cek6=mysql_query("SELECT * FROM subkriteria WHERE nama_subkriteria='$_POST[keadaan_ortu]'");
    $r6=mysql_fetch_array($cek6);
	$k6=$r6[nilai];
	$cek7=mysql_query("SELECT * FROM subkriteria WHERE nama_subkriteria='$_POST[kendaraan]'");
    $r7=mysql_fetch_array($cek7);
	$k7=$r7[nilai];
	
	mysql_query("INSERT INTO klasifikasi(nisn,
								 n_pekerjaan_ortu,
								 n_penghasilan_ortu,
								 n_kondisi_rumah,
								 n_jml_tanggungan,
								 n_keadaan_ortu,
								 n_kendaraan) 
	                       VALUES('$_POST[nisn]',
								'$k1',
								'$k2',
								'$k3',
								'$k5',
								'$k6',
								'$k7')");
  echo "<script>window.alert('Data berhasil disimpan');
        window.location=('../../media.php?module=siswa')</script>";
		}
}

// Update user
elseif ($module=='siswa' AND $act=='update'){
  
    mysql_query("UPDATE siswa SET nama_siswa   = '$_POST[nama_siswa]',
                                  id_tahun       = '$_POST[tahun]',
								  pekerjaan_ortu = '$_POST[pekerjaan_ortu]',								  
                                  penghasilan_ortu = '$_POST[penghasilan_ortu]',
								  kondisi_rumah   = '$_POST[kondisi_rumah]',
								  jml_tanggungan  = '$_POST[jml_tanggungan]',
								  keadaan_ortu    = '$_POST[keadaan_ortu]',
								  kendaraan      = '$_POST[kendaraan]'  
                           WHERE  nisn     = '$_POST[id]'");
 
  echo "<script>window.alert('Data berhasil diubah');
        window.location=('../../media.php?module=siswa')</script>";
}
}
?>
