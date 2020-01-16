<?php
session_start();
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Cetak Laporan Tugas Akhir</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">

<!-- CSS -->
<link href="bootstrap.css" rel="stylesheet">
<style type="text/css" media="print">
body{
	font-size: 12px;
}
@page
{
	size: landscape;
	margin: 2cm;
	font-size: 10px;
}
</style>
</head>

<body onload="print()">

<!-- Part 1: Wrap all page content here -->
<div id="wrap">

<header class="container jumbotron subhead" id="overview">
  <div class="container">
    <div class="row-fluid">
      <div class="span12">
      <center>
        <h3>Universitas Janabadra </h3>
    </center>
      </div>
    </div>
  </div>
</header>
<!-- Begin page content -->
<div class="container bg">
  <div class="row-fluid">
    <div class="span12">
      <div>
<center><h5>Laporan Data Tugas Akhir</h5></center>

  <table class="table">
    <thead>
      <tr>
        <th>No</th><th>Judul</th><th>NIM</th><th>Nama Mahasiswa</th><th>Kompetensi</th><th>Tgl. Input</th><th>Dosen</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $tampil=mysql_query("SELECT * FROM tugasakhir LEFT JOIN parameter ON tugasakhir.id_parameter=parameter.id_parameter ORDER BY id_tugasakhir DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	$id_ta=$r[id_tugasakhir];
	$tampil2 = mysql_query("SELECT * FROM hasil,dosen WHERE hasil.id_dosen=dosen.id_dosen AND hasil.id_tugasakhir='$id_ta' ORDER BY hasil.skor DESC LIMIT 2");													
	$noo=1;
	$tanggal=tgl_indo($r[tgl_input]);
       echo "<tr><td>$no</td>
             <td>$r[judul]</td>
			 <td>$r[nim]</td>
			 <td>$r[nama_mahasiswa]</td>
			 <td>$r[nama_parameter]</td>
			 <td>$tanggal</td>
			 <td>";
			 while ($p=mysql_fetch_array($tampil2)){	
			 echo"
			 $p[nama_dosen] Sebagai Dosen Pembimbing $noo<br>";
			 $noo++;
			 }
			 echo"
			 </td>
			 </tr>";
		  $no++;
    }
	
    ?>
    </tbody>
  </table>
  
      </div>
    </div>
  </div>
  <div id="push"></div>
</div>
</body>
</html>
