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

if ($module=='dosen' AND $act=='hapus'){
  mysql_query("DELETE FROM dosen WHERE id_dosen='$_GET[id]'");
  mysql_query("DELETE FROM detail_dosen WHERE id_dosen='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
// Input user
elseif ($module=='dosen' AND $act=='input'){
$lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
$kode=$_POST[nip];
$sql = mysql_query("SELECT * FROM dosen WHERE nip='$_POST[nip]'");
$ketemu=mysql_num_rows($sql);
	if ($ketemu > 0){
	echo"
	<p align=center>Maaf! NIP yang Anda masukkan sudah terdaftar, Silahkan ganti yang lain<br />
  	    <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>
			</b></p>";
	}
	else { 
  mysql_query("INSERT INTO dosen(nip,
                                 nama_dosen,
                                 email,
								 no_telp,
								 alamat,
								 jenis_kelamin,
								 nidn,
								 tempat,
								 tgl_lahir,
								 foto) 
	                       VALUES('$_POST[nip]',
                                '$_POST[nama_dosen]',
								'$_POST[email]',
								'$_POST[no_telp]',
								'$_POST[alamat]',
								'$_POST[jenis_kelamin]',
								'$_POST[nidn]',
								'$_POST[tempat]',
								'$_POST[tgl_lahir]',
								'$nama_file_unik')");
	$id_dosen=mysql_insert_id();
mysql_query("INSERT INTO detail_dosen(id_dosen,id_kriteria,id_parameter) 
	                       VALUES('$id_dosen','1','$_POST[pendidikan]')");
mysql_query("INSERT INTO detail_dosen(id_dosen,id_kriteria,id_parameter) 
	                       VALUES('$id_dosen','2','$_POST[fungsional]')");						   
mysql_query("INSERT INTO detail_dosen(id_dosen,id_kriteria,id_parameter) 
	                       VALUES('$id_dosen','3','$_POST[kompetensi]')");
mysql_query("INSERT INTO detail_dosen(id_dosen,id_kriteria,id_parameter) 
	                       VALUES('$id_dosen','4','$_POST[artikel]')");	
 echo "<script>window.alert('Data berhasil disimpan');
        window.location=('../../media.php?module=dosen')</script>";
		}
}

// Update user
elseif ($module=='dosen' AND $act=='update'){
$lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file;
  if (empty($lokasi_file)){
mysql_query("UPDATE dosen SET nama_dosen    = '$_POST[nama_dosen]',
                                  email     = '$_POST[email]',
								  nip       = '$_POST[nip]',
								  nidn       = '$_POST[nidn]',
								  jenis_kelamin  = '$_POST[jenis_kelamin]',
								  tempat       = '$_POST[tempat]',
								  tgl_lahir       = '$_POST[tgl_lahir]',
								  no_telp = '$_POST[no_telp]',
								  alamat  = '$_POST[alamat]'
                           WHERE  id_dosen     = '$_POST[id]'");
	 }
  // Apabila gambar diganti
  else{
  UploadDosen($nama_file_unik);
mysql_query("UPDATE dosen SET nama_dosen    = '$_POST[nama_dosen]',
                                  email     = '$_POST[email]',
								  nip       = '$_POST[nip]',
								  nidn       = '$_POST[nidn]',
								  jenis_kelamin  = '$_POST[jenis_kelamin]',
								  tempat       = '$_POST[tempat]',
								  foto		= '$nama_file_unik',
								  tgl_lahir       = '$_POST[tgl_lahir]',
								  no_telp = '$_POST[no_telp]',
								  alamat  = '$_POST[alamat]'
                           WHERE  id_dosen     = '$_POST[id]'");
}  
mysql_query("UPDATE detail_dosen SET id_parameter   = '$_POST[pendidikan]'
                           WHERE  id_dosen     = '$_POST[id]' AND id_kriteria='1'");
mysql_query("UPDATE detail_dosen SET id_parameter   = '$_POST[fungsional]'
                           WHERE  id_dosen     = '$_POST[id]' AND id_kriteria='2'");
mysql_query("UPDATE detail_dosen SET id_parameter   = '$_POST[kompetensi]'
                           WHERE  id_dosen     = '$_POST[id]' AND id_kriteria='3'");
mysql_query("UPDATE detail_dosen SET id_parameter   = '$_POST[artikel]'
                           WHERE  id_dosen     = '$_POST[id]' AND id_kriteria='4'");						   
$tampil = mysql_query("SELECT * FROM detail_dosen,parameter WHERE detail_dosen.id_parameter=parameter.id_parameter AND detail_dosen.id_dosen='$_POST[id]' ");
    while ($r=mysql_fetch_array($tampil)){
	$nilai=$r[nilai];
	$parameter=$r[id_parameter];
	mysql_query("UPDATE detail_dosen SET value   = '$nilai'
                           WHERE  id_dosen     = '$_POST[id]' AND id_parameter='$parameter'");
	}
  echo "<script>window.alert('Data berhasil diubah');
        window.location=('../../media.php?module=dosen')</script>";
}
// Input pengabdian
elseif ($module=='dosen' AND $act=='inputpengabdian'){
$dosen=$_POST[dosen];
  mysql_query("INSERT INTO pengabdian(id_dosen,judul,tahun,keterangan) VALUES('$_POST[dosen]','$_POST[judul]','$_POST[tahun]','$_POST[keterangan]')");
  header('location:../../media.php?module=dosen&act=detaildosen&id='.$dosen);
}
elseif ($module=='dosen' AND $act=='hapuspengabdian'){
$edit=mysql_query("SELECT * FROM pengabdian WHERE id_pengabdian='$_GET[id2]'");
    $r=mysql_fetch_array($edit);
	$id=$r[id_dosen];
  mysql_query("DELETE FROM pengabdian WHERE id_pengabdian='$_GET[id2]'");
  header('location:../../media.php?module=dosen&act=detaildosen&id='.$id);
}
// Input penelitian
elseif ($module=='dosen' AND $act=='inputpenelitian'){
$dosen=$_POST[dosen];
  mysql_query("INSERT INTO penelitian(id_dosen,judul,tahun,keterangan) VALUES('$_POST[dosen]','$_POST[judul]','$_POST[tahun]','$_POST[keterangan]')");
  header('location:../../media.php?module=dosen&act=detaildosen&id='.$dosen);
}
elseif ($module=='dosen' AND $act=='hapuspenelitian'){
$edit=mysql_query("SELECT * FROM penelitian WHERE id_penelitian='$_GET[id2]'");
    $r=mysql_fetch_array($edit);
	$id=$r[id_dosen];
  mysql_query("DELETE FROM penelitian WHERE id_penelitian='$_GET[id2]'");
  header('location:../../media.php?module=dosen&act=detaildosen&id='.$id);
}
elseif ($module=='dosen' AND $act=='updatepenelitian'){
$dosen=$_POST[dosen];
  mysql_query("UPDATE penelitian SET judul = '$_POST[judul]',tahun = '$_POST[tahun]',keterangan = '$_POST[keterangan]' WHERE id_penelitian = '$_POST[id]'");
  header('location:../../media.php?module=dosen&act=detaildosen&id='.$dosen);
}
elseif ($module=='dosen' AND $act=='updatepengabdian'){
$dosen=$_POST[dosen];
  mysql_query("UPDATE pengabdian SET judul = '$_POST[judul]',tahun = '$_POST[tahun]',keterangan = '$_POST[keterangan]' WHERE id_pengabdian = '$_POST[id]'");
  header('location:../../media.php?module=dosen&act=detaildosen&id='.$dosen);
}
elseif ($module=='dosen' AND $act=='inputpengampu'){
$dosen=$_POST[dosen];
$qry_pengampu=mysql_query("delete from pengampu where id_dosen='$dosen'");
  $matkul=$_POST['matkul'];
		if(!empty($matkul)){
			foreach($matkul as $val){
				$qry_insert=mysql_query("insert into pengampu (id_dosen,id_matkul) values('$dosen','$val')");
			}
		}
  header('location:../../media.php?module=dosen&act=detaildosen&id='.$dosen);
}
}
?>
