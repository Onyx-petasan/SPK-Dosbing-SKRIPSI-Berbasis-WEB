<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";
include "../../config/fungsi_thumb.php";
$module=$_GET[module];
$act=$_GET[act];

if ($module=='admin' AND $act=='hapus'){
  mysql_query("DELETE FROM user WHERE id_user='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
// Input user
elseif ($module=='admin' AND $act=='input'){
$lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  $pass=md5($_POST[password]);
$sql = mysql_query("SELECT * FROM user WHERE email='$_POST[email]' OR nip='$_POST[nip]'");
$ketemu=mysql_num_rows($sql);
	if ($ketemu > 0){
	echo"
	<p align=center>Maaf! NIP atau Email yang Anda masukkan sudah terdaftar, Silahkan ganti yang lain<br />
  	    <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>
			</b></p>";
	}
	else {
  mysql_query("INSERT INTO user(password,
                                 nama,
                                 email, 
                                 no_telp,
								 nip,
								 level,
								 foto) 
	                       VALUES('$pass',
                                '$_POST[nama]',
                                '$_POST[email]',
                                '$_POST[no_telp]',
								'$_POST[nip]',
								'$_POST[level]',
								'$nama_file_unik')");
	
  echo "<script>window.alert('Data berhasil disimpan');
        window.location=('../../media.php?module=admin')</script>";
		}
}

// Update user
elseif ($module=='admin' AND $act=='update'){
$lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
   // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE user SET nama   = '$_POST[nama]',
                                  email        = '$_POST[email]',
								  nip          = '$_POST[nip]',
								  level        = '$_POST[level]',								  
                                  no_telp      = '$_POST[no_telp]'  
                           WHERE  id_user     = '$_POST[id]'");
  }
  // Apabila gambar diganti
  else{
  UploadUser($nama_file_unik);
    mysql_query("UPDATE user SET nama    	= '$_POST[nama]',
                                 email      = '$_POST[email]',
								 nip        = '$_POST[nip]',
								 level        = '$_POST[level]',
								 foto		= '$nama_file_unik',
                                 no_telp    = '$_POST[no_telp]'  
                           WHERE id_user    = '$_POST[id]'");
  }
  echo "<script>window.alert('Data berhasil diubah');
        window.location=('../../media.php?module=admin')</script>";
}
elseif ($module=='admin' AND $act=='pass'){
    $pass=md5($_POST[password]);
	mysql_query("UPDATE user SET password        = '$pass'  
                           WHERE  id_user     = '$_POST[id]'");
						   echo "<script>window.alert('Data berhasil diubah');
        window.location=('../../media.php?module=admin')</script>";
}
}
?>
