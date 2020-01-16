<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_hasil/aksi_hasil.php";
switch($_GET[act]){
  // Tampil User
  default:
  echo"
  <div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>HASIL PERHITUNGAN SELEKSI SISWA</h3>
            </div>
            <div class='box-body table-responsive no-padding'>
			<form method=POST action='$aksi?module=hasil&act=input'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>";  
    echo "<thead>
          <tr>
		    <th>No</th>
			<th>NISN</th>
			<th>Nama</th>
			<th>Tahun Angkatan</th>
			<th>Tgl. Lahir</th>
			<th>Ayah</th>
			<th>Ibu</th>
			<th>Alamat</th>
			<th>Pekerjaan Ortu</th>
			<th>Penghasilan Ortu</th>
			<th>Jml Tanggungan</th>
			<th>Skor</th>
		  </tr>
		</thead>
	<thead>
	<tbody>";
	
	$tampil = mysql_query("SELECT * FROM siswa,tahun WHERE siswa.id_tahun=tahun.id_tahun ORDER BY siswa.skor DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	$tanggal=tgl_indo($r[tanggal_lahir]);
       echo "<tr><td>$no</td>
             <td>$r[nisn]</td>
			 <td>$r[nama_siswa]</td>
			 <td>$r[nama_tahun]</td>
			 <td>$tanggal</td>
			 <td>$r[nama_ayah]</td>
			 <td>$r[nama_ibu]</td>
			 <td>$r[alamat]</td>
			 <td>$r[pekerjaan_ortu]</td>
			 <td>$r[penghasilan]</td>
			 <td>$r[tanggungan]</td>
             <td>$r[skor] </td></tr>";
      $no++;
    }
    echo "</tbody></table>
	<div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Jumlah Kuota Penerima Beasiswa</label>
                  <input type='number' class='form-control' name='kuota' id='exampleInputEmail1' placeholder='Masukkan Jumlah Kuota Penerima Beasiswa' required>
                </div>
              </div>
	<button type='submit' class='btn btn-primary'>Simpan</button>
	</form></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
    break;
  
  
}
}
?>
