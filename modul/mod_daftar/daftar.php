<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_daftar/aksi_daftar.php";
switch($_GET[act]){
  // Tampil User
  default:
  echo"
  <div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>DAFTAR PEMBIMBING</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body table-responsive no-padding'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>
	<thead>
          <tr><th>No</th><th>Judul</th><th>NIM</th><th>Nama Mahasiswa</th><th>Kompetensi</th><th>Status</th><th>Tgl. Input</th><th>Aksi</th></tr>
		  <tbody>"; 
    $tampil=mysql_query("SELECT * FROM tugasakhir LEFT JOIN parameter ON tugasakhir.id_parameter=parameter.id_parameter ORDER BY id_tugasakhir DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	$tanggal=tgl_indo($r[tgl_input]);
       echo "<tr><td>$no</td>
             <td>$r[judul]</td>
			 <td>$r[nim]</td>
			 <td>$r[nama_mahasiswa]</td>
			 <td>$r[nama_parameter]</td>
			 <td>$r[status]</td>
			 <td>$tanggal</td>
             <td><a href=?module=daftar&act=detail&id=$r[id_tugasakhir] class='btn btn-success btn-xs' title='Detail'><i class='fa fa-folder'></i> Detail</a>
             </td></tr>";
      $no++;
    }
    echo "</tbody></table></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
    break;
  
  case "detail":
    $cek=mysql_query("SELECT * FROM tugasakhir WHERE id_tugasakhir='$_GET[id]'");
    $c=mysql_fetch_array($cek);
	$tanggal=tgl_indo($c[tgl_input]);
	$id_parameter=$c[id_parameter];
$param=mysql_query("SELECT * FROM parameter WHERE id_parameter='$id_parameter'");
    $pa=mysql_fetch_array($param);
   echo"
   <div class='col-md-6'>
          <div class='box'>
            <div class='box-header with-border'>
              <i class='fa fa-text-width'></i>

              <h3 class='box-title'>Detail Tugas Akhir</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
              <dl class='dl-horizontal'>
                <dt>Judul</dt>
                <dd>$c[judul]</dd>
                <dt>NIM</dt>
                <dd>$c[nim]</dd>
                <dt>Nama Mahasiswa</dt>
                <dd>$c[nama_mahasiswa]</dd>
				<dt>Kompetensi</dt>
                <dd>$pa[nama_parameter]</dd>
                <dt>Tgl. Input</dt>
                <dd>$tanggal </dd>
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
	
		
		";
		echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>DAFTAR DOSEN PEMBIMBING</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body table-responsive no-padding'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>
	<thead>
          <tr><th>No</th><th>NIP</th><th>Nama Dosen</th><th>Dosen Pembimbing</th></tr>
		  <tbody>"; 
   $tampil4 = mysql_query("SELECT * FROM hasil,dosen WHERE hasil.id_dosen=dosen.id_dosen AND hasil.id_tugasakhir='$_GET[id]' ORDER BY hasil.skor DESC LIMIT 2");
    $no=1;
    while ($r4=mysql_fetch_array($tampil4)){
       echo "<tr><td>$no</td>
             <td>$r4[nip]</td> 
            <td>$r4[nama_dosen]</td>
			<td>Dosen Pembimbing $no</td>
			 </td></tr>";
      $no++;
    }
    echo "</tbody></table></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
     break;
	 
  
}
}
?>
