<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_dosen/aksi_dosen.php";
switch($_GET[act]){
  // Tampil User
  default:
  echo"
  <div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>DOSEN</h3>
            </div>";
			if ($_SESSION['leveluser']=='admin' ){
			echo"
			<input type=button class='btn btn-primary' value='Tambah' onclick=\"window.location.href='?module=dosen&act=tambahdosen';\">
			<p>";
			}
			echo"
            <!-- /.box-header -->
            <div class='box-body table-responsive no-padding'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>";  
    echo "<thead>
          <tr>
		    <th>No</th>
			<th>NIP</th>
			<th>Nama</th>
			<th>ALamat</th>
			<th>Email</th>
			<th>No. Telp</th>
			<th>Aksi</th>
		  </tr>
		</thead>
	<thead>
	<tbody>"; 
	$tampil = mysql_query("SELECT * FROM dosen ORDER BY nip");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	$tanggal=tgl_indo($r[tanggal_lahir]);
       echo "<tr><td>$no</td>
             <td>$r[nip]</td>
			 <td>$r[nama_dosen]</td>
			 <td>$r[alamat]</td>
			 <td>$r[email]</td>
			 <td>$r[no_telp]</td>
             <td>";
			 if ($_SESSION['leveluser']=='admin' ){
			 echo"
			 <a href=?module=dosen&act=editdosen&id=$r[id_dosen] class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-edit'></i> Edit</a>
			 <a href=?module=dosen&act=detaildosen&id=$r[id_dosen] class='btn btn-success btn-xs' title='Detail'><i class='fa fa-folder'></i> Detail</a>
	         <a href=$aksi?module=dosen&act=hapus&id=$r[id_dosen] class='btn btn-danger btn-xs' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>
			 ";
			 }
			 else {
			 echo"
			 <a href=?module=dosen&act=detaildosen&id=$r[id_dosen] class='btn btn-success btn-xs' title='Detail'><i class='fa fa-folder'></i> Detail</a>
			 ";
			 }
			 echo"</td></tr>";
      $no++;
    }
    echo "</tbody></table></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
    break;
  
  case "tambahdosen":
    
   echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM TAMBAH DOSEN</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action='$aksi?module=dosen&act=input' enctype='multipart/form-data'>
              <div class='box-body'>
                
				<div class='form-group'>
                  <label for='exampleInputPassword1'>NIP</label>
                  <input type='text' name='nip' class='form-control' id='exampleInputPassword1' placeholder='Masukkan NIP' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>NIDN</label>
                  <input type='text' name='nidn' class='form-control' id='exampleInputPassword1' placeholder='Masukkan NIDN' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Nama</label>
                  <input type='text' name='nama_dosen' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama Lengkap' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Email</label>
                  <input type='email' name='email' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Email' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>No. Telp</label>
                  <input type='number' name='no_telp' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nomor Telepon' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Jenis Kelamin</label>
                  <select class='form-control' name='jenis_kelamin' required>
					<option value='' selected>- Pilih Jenis Kelamin -</option>
					<option>Laki-Laki</option>
					<option>Perempuan</option>
				  </select>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Tempat Lahir</label>
                  <input type='text' name='tempat' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Tempat Lahir' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Tgl. Lahir</label>
                  <input type='date' name='tgl_lahir' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Tanggal Lahir' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Alamat</label>
                  <input type='text' name='alamat' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Alamat' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Foto</label>
                  <input type='file' name='fupload' id='exampleInputFile'>
                  <p class='help-block'>Pastikan File yang diupload berekstensi *JPG atau *JPEG.</p>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Jenjang Pendidikan Dosen</label>
                  <select class='form-control' name='pendidikan' required>
					<option value='' selected>- Pilih Jenjang Pendidikan Dosen -</option>";
					$tampil=mysql_query("SELECT * FROM parameter WHERE id_kriteria='1'");
					while($r=mysql_fetch_array($tampil)){
						echo "<option value=$r[id_parameter]>$r[nama_parameter]</option>";
					}
					echo "</select>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Jabatan Fungsional Dosen</label>
                  <select class='form-control' name='fungsional' required>
					<option value='' selected>- Pilih Jabatan Fungsional Dosen -</option>";
					$tampil=mysql_query("SELECT * FROM parameter WHERE id_kriteria='2'");
					while($r=mysql_fetch_array($tampil)){
						echo "<option value=$r[id_parameter]>$r[nama_parameter]</option>";
					}
					echo "</select>
                </div>
				
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Jumlah Artikel Yang Sudah Dipublish</label>
                  <select class='form-control' name='artikel' required>
					<option value='' selected>- Pilih Jumlah Artikel Yang sudah Dipublish -</option>";
					$tampil=mysql_query("SELECT * FROM parameter WHERE id_kriteria='4'");
					while($r=mysql_fetch_array($tampil)){
						echo "<option value=$r[id_parameter]>$r[nama_parameter]</option>";
					}
					echo "</select>
                </div>
				</div>
				
              <!-- /.box-body -->

              <div class='box-footer'>
                <button type='submit' class='btn btn-primary'>Simpan</button>
				<button onclick=self.history.back() class='btn btn-danger'>Batal</button>
              </div>
            </form>
         </div>
	 </div>";
     break;
	 
  case "editdosen":
    $edit=mysql_query("SELECT * FROM dosen WHERE id_dosen='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	$data1=mysql_query("SELECT * FROM dosen,detail_dosen WHERE dosen.id_dosen=detail_dosen.id_dosen AND dosen.id_dosen='$_GET[id]' AND detail_dosen.id_kriteria='1'");
    $k1=mysql_fetch_array($data1);
	$data2=mysql_query("SELECT * FROM dosen,detail_dosen WHERE dosen.id_dosen=detail_dosen.id_dosen AND dosen.id_dosen='$_GET[id]' AND detail_dosen.id_kriteria='2'");
    $k2=mysql_fetch_array($data2);
	$data3=mysql_query("SELECT * FROM dosen,detail_dosen WHERE dosen.id_dosen=detail_dosen.id_dosen AND dosen.id_dosen='$_GET[id]' AND detail_dosen.id_kriteria='3'");
    $k3=mysql_fetch_array($data3);
	$data4=mysql_query("SELECT * FROM dosen,detail_dosen WHERE dosen.id_dosen=detail_dosen.id_dosen AND dosen.id_dosen='$_GET[id]' AND detail_dosen.id_kriteria='4'");
    $k4=mysql_fetch_array($data4);
    echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM EDIT DOSEN</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=dosen&act=update enctype='multipart/form-data'>
			<input type=hidden name=id value='$r[id_dosen]'>
              <div class='box-body'>
                
                <div class='form-group'>
                  <label for='exampleInputPassword1'>NIP</label>
                  <input type='text' name='nip' class='form-control' id='exampleInputPassword1' placeholder='Masukkan NIP' value='$r[nip]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>NIDN</label>
                  <input type='text' name='nidn' class='form-control' id='exampleInputPassword1' placeholder='Masukkan NIDN' value='$r[nidn]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Nama</label>
                  <input type='text' name='nama_dosen' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama Lengkap' value='$r[nama_dosen]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Email</label>
                  <input type='email' name='email' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Email' value='$r[email]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Jenis Kelamin</label>
                  <select class='form-control' name='jenis_kelamin' required>
					<option selected>$r[jenis_kelamin]</option>
					<option>Laki-Laki</option>
					<option>Perempuan</option>
				  </select>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>No. Telp</label>
                  <input type='number' name='no_telp' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nomor Telepon' value='$r[no_telp]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Tempat Lahir</label>
                  <input type='text' name='tempat' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Tempat Lahir' value='$r[tempat]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Tgl. Lahir</label>
                  <input type='date' name='tgl_lahir' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Tanggal Lahir' value='$r[tgl_lahir]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Alamat</label>
                  <input type='text' name='alamat' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Alamat' value='$r[alamat]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Foto</label>
                  <p class='help-block'><img src='foto_dosen/small_$r[foto]'></p>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Ganti Foto</label>
                  <input type='file' name='fupload' id='exampleInputFile'>
                  <p class='help-block'>Pastikan File yang diupload berekstensi *JPG atau *JPEG.</p>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Jenajng Pendidikan Dosen</label>
                  <select class='form-control' name='pendidikan' required>";
				   $tampil=mysql_query("SELECT * FROM parameter WHERE id_kriteria='1'");
					if ($k1[id_parameter]==0){
						echo "<option value=0 selected>- Pilih Jenjang Pendidikan Dosen -</option>";
					}  
				   while($w=mysql_fetch_array($tampil)){
					if ($k1[id_parameter]==$w[id_parameter]){
						echo "<option value=$w[id_parameter] selected>$w[nama_parameter]</option>";
					}
					else{
						echo "<option value=$w[id_parameter]>$w[nama_parameter]</option>";
					}
					}
				   echo "</select>	
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword2'>Jabatan Fungsional Dosen</label>
                  <select class='form-control' name='fungsional' required>";
				   $tampil=mysql_query("SELECT * FROM parameter WHERE id_kriteria='2'");
					if ($k2[id_parameter]==0){
						echo "<option value=0 selected>- Pilih Jabatan Fungsional Dosen -</option>";
					}  
				   while($w=mysql_fetch_array($tampil)){
					if ($k2[id_parameter]==$w[id_parameter]){
						echo "<option value=$w[id_parameter] selected>$w[nama_parameter]</option>";
					}
					else{
						echo "<option value=$w[id_parameter]>$w[nama_parameter]</option>";
					}
					}
				   echo "</select>	
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword3'>Kompetensi Dosen</label>
                  <select class='form-control' name='kompetensi' required>";
				   $tampil=mysql_query("SELECT * FROM parameter WHERE id_kriteria='3'");
					if ($k3[id_parameter]==0){
						echo "<option value=0 selected>- Pilih Kompetensi Dosen -</option>";
					}  
				   while($w=mysql_fetch_array($tampil)){
					if ($k3[id_parameter]==$w[id_parameter]){
						echo "<option value=$w[id_parameter] selected>$w[nama_parameter]</option>";
					}
					else{
						echo "<option value=$w[id_parameter]>$w[nama_parameter]</option>";
					}
					}
				   echo "</select>	
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword4'>Jumlah Artikel Yang Sudah Dipublish</label>
                  <select class='form-control' name='artikel' required>";
				   $tampil=mysql_query("SELECT * FROM parameter WHERE id_kriteria='4'");
					if ($k4[id_parameter]==0){
						echo "<option value=0 selected>- Pilih Jumlah Artikel Yang Sudah Dipublish -</option>";
					}  
				   while($w=mysql_fetch_array($tampil)){
					if ($k4[id_parameter]==$w[id_parameter]){
						echo "<option value=$w[id_parameter] selected>$w[nama_parameter]</option>";
					}
					else{
						echo "<option value=$w[id_parameter]>$w[nama_parameter]</option>";
					}
					}
				   echo "</select>	
                </div>
              </div>
              <!-- /.box-body -->
              <div class='box-footer'>
                <button type='submit' class='btn btn-primary'>Update</button>
				<input type=button class='btn btn-danger' value='Batal' onclick=\"window.location.href='?module=dosen';\">
              </div>
            </form>
         </div>
	 </div>";
       
    break; 

 case "detaildosen":
 
 $cek=mysql_query("SELECT * FROM dosen WHERE id_dosen='$_GET[id]'");
    $c=mysql_fetch_array($cek);
echo"<div class='col-md-12'>
          <div class='box'>
            <div class='box-header with-border'>
              <i class='fa fa-text-width'></i>
              <h3 class='box-title'>Detail Dosen</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
              <dl class='dl-horizontal'>
                <dt>NIP</dt>
                <dd>$c[nip]</dd>
				<dt>NIDN</dt>
                <dd>$c[nidn]</dd>
                <dt>Nama</dt>
                <dd>$c[nama_dosen]</dd>
				 <dt>Jenis Kelamin</dt>
                <dd>$c[jenis_kelamin]</dd>
                <dt>Alamat</dt>
                <dd>$c[alamat]</dd>
				<dt>Email</dt>
                <dd>$c[email]</dd>
                <dt>No. Telp</dt>
                <dd>$c[no_telp] </dd>
				<dt>Tempat/Tgl. Lahir</dt>
                <dd>$c[tempat]/$c[tgl_lahir] </dd>
				<dt>Foto</dt>
                <dd><img src='foto_dosen/medium_$c[foto]'> </dd>
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>"; 
		if ($_SESSION['leveluser']=='admin' ){
echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM TAMBAH PENELITIAN DOSEN</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action='$aksi?module=dosen&act=inputpenelitian'>
			<input type=hidden name=dosen value='$_GET[id]'>
              <div class='box-body'>
                
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Judul penelitian</label>
                  <input type='text' name='judul' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Judul' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Tahun</label>
                  <input type='number' name='tahun' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Tahun' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Keterangan</label>
                  <input type='text' name='keterangan' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Keterangan' required>
                </div>
			
			  </div>
				
              <!-- /.box-body -->

              <div class='box-footer'>
                <button type='submit' class='btn btn-primary'>Simpan</button>
				<button onclick=self.history.back() class='btn btn-danger'>Batal</button>
              </div>
            </form>
         </div>
	 </div>";
	 }
	echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>DATA PENELITIAN </h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body table-responsive no-padding'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>
	<thead>
          <tr><th>No</th><th>Judul</th><th>Tahun</th><th>Keterangan</th><th>Aksi</th></tr>
		  <tbody>"; 
    $tampil=mysql_query("SELECT * FROM penelitian WHERE id_dosen='$_GET[id]' ORDER BY id_penelitian DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	$tanggal=tgl_indo($r[tgl_input]);
       echo "<tr><td>$no</td>
             <td>$r[judul]</td>
			 <td>$r[tahun]</td>
			 <td>$r[keterangan]</td>
			 <td>";
			 if ($_SESSION['leveluser']=='admin' ){
			 echo"
			 <a href=?module=dosen&act=editpenelitian&id2=$r[id_penelitian] class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-edit'></i> Edit</a>
	         <a href=$aksi?module=dosen&act=hapuspenelitian&id2=$r[id_penelitian] class='btn btn-danger btn-xs' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>
			 ";
			 }
			 echo"</td>
             </tr>";
      $no++;
    }
    echo "</tbody></table></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
if ($_SESSION['leveluser']=='admin' ){		
echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM TAMBAH PENGABDIAN DOSEN</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action='$aksi?module=dosen&act=inputpengabdian'>
			<input type=hidden name=dosen value='$_GET[id]'>
              <div class='box-body'>
                
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Judul Pengabdian</label>
                  <input type='text' name='judul' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Judul' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Tahun</label>
                  <input type='number' name='tahun' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Tahun' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Keterangan</label>
                  <input type='text' name='keterangan' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Keterangan' required>
                </div>
			
			  </div>
				
              <!-- /.box-body -->

              <div class='box-footer'>
                <button type='submit' class='btn btn-primary'>Simpan</button>
				<button onclick=self.history.back() class='btn btn-danger'>Batal</button>
              </div>
            </form>
         </div>
	 </div>";
	 }
	echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>DATA PENGABDIAN PADA MASYARAKAT</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body table-responsive no-padding'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>
	<thead>
          <tr><th>No</th><th>Judul</th><th>Tahun</th><th>Keterangan</th><th>Aksi</th></tr>
		  <tbody>"; 
    $tampil=mysql_query("SELECT * FROM pengabdian WHERE id_dosen='$_GET[id]' ORDER BY id_pengabdian DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	$tanggal=tgl_indo($r[tgl_input]);
       echo "<tr><td>$no</td>
             <td>$r[judul]</td>
			 <td>$r[tahun]</td>
			 <td>$r[keterangan]</td>
			 <td>";
			 if ($_SESSION['leveluser']=='admin' ){
			 echo"
			 <a href=?module=dosen&act=editpengabdian&id2=$r[id_penelitian] class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-edit'></i> Edit</a>
	         <a href=$aksi?module=dosen&act=hapuspengabdian&id2=$r[id_pengabdian] class='btn btn-danger btn-xs' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>
			 ";
			 }
			 echo"</td>
             </tr>";
      $no++;
    }
    echo "</tbody></table></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";

	
 echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>DATA TUGAS AKHIR YANG DIBIMBING</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body table-responsive no-padding'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>
	<thead>
          <tr><th>No</th><th>Judul</th><th>NIM</th><th>Nama Mahasiswa</th><th>Kompetensi</th><th>Status</th><th>Tgl. Input</th></tr>
		  <tbody>"; 
    $tampil=mysql_query("SELECT * FROM tugasakhir LEFT JOIN parameter ON tugasakhir.id_parameter=parameter.id_parameter 
														JOIN hasil ON tugasakhir.id_tugasakhir=hasil.id_tugasakhir 
														WHERE hasil.dospem='1'
														AND hasil.id_dosen='$_GET[id]'
														ORDER BY tugasakhir.id_tugasakhir DESC");
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
             </tr>";
      $no++;
    }
    echo "</tbody></table></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
	if ($_SESSION['leveluser']=='admin' ){	
		echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM MATA KULIAH YANG DIAMPU</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action='$aksi?module=dosen&act=inputpengampu'>
			<input type=hidden name=dosen value='$_GET[id]'>
              <div class='box-body'>
                
				<div class='form-group'>
                  <label for='exampleInputPassword1'>MATA KULIAH</label><br>
                  ";
		  $tampil=mysql_query("SELECT * FROM matkul ORDER BY id_matkul");
            while($r=mysql_fetch_array($tampil)){
			echo"<input type='checkbox' name='matkul[]' value=$r[id_matkul]>$r[nama_matkul] &nbsp;";
			}
		  echo"
                </div>
			
			  </div>
				
              <!-- /.box-body -->

              <div class='box-footer'>
                <button type='submit' class='btn btn-primary'>Simpan</button>
				<button onclick=self.history.back() class='btn btn-danger'>Batal</button>
              </div>
            </form>
         </div>
	 </div>";
	 }
		echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>DATA MATA KULIAH YANG DIAMPU</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body table-responsive no-padding'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>
	<thead>
          <tr><th>No</th><th>Nama Mata Kuliah</th></tr>
		  <tbody>"; 
    $tampil=mysql_query("SELECT * FROM pengampu,matkul,dosen WHERE pengampu.id_matkul=matkul.id_matkul
															AND pengampu.id_dosen=dosen.id_dosen
															AND pengampu.id_dosen='$_GET[id]'
															ORDER BY pengampu.id_matkul DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	$tanggal=tgl_indo($r[tgl_input]);
       echo "<tr><td>$no</td>
             <td>$r[nama_matkul]</td>
             </tr>";
      $no++;
    }
    echo "</tbody></table></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
 break;
 // Form Edit Penelitian  
  case "editpenelitian":
    $edit=mysql_query("SELECT * FROM penelitian WHERE id_penelitian='$_GET[id2]'");
    $r=mysql_fetch_array($edit);

	echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM EDIT PENELITIAN</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=dosen&act=updatepenelitian>
            <input type=hidden name=id value='$r[id_penelitian]'>
			<input type=hidden name=dosen value='$r[id_dosen]'>
              <div class='box-body'>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Judul penelitian</label>
                  <input type='text' name='judul' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Judul' value='$r[judul]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Tahun</label>
                  <input type='number' name='tahun' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Tahun' value='$r[tahun]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Keterangan</label>
                  <input type='text' name='keterangan' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Keterangan' value='$r[keterangan]' required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class='box-footer'>
                <button type='submit' class='btn btn-primary'>Update</button>
				<button onclick=self.history.back() class='btn btn-danger'>Batal</button>
              </div>
            </form>
         </div>
	 </div>";
    
    break;
	// Form Edit pengabdian  
  case "editpengabdian":
    $edit=mysql_query("SELECT * FROM pengabdian WHERE id_pengabdian='$_GET[id2]'");
    $r=mysql_fetch_array($edit);

	echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM EDIT PENGABDIAN MASYARAKAT</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=dosen&act=updatepengabdian>
            <input type=hidden name=id value='$r[id_pengabdian]'>
			<input type=hidden name=dosen value='$r[id_dosen]'>
              <div class='box-body'>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Judul pengabdian</label>
                  <input type='text' name='judul' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Judul' value='$r[judul]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Tahun</label>
                  <input type='number' name='tahun' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Tahun' value='$r[tahun]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Keterangan</label>
                  <input type='text' name='keterangan' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Keterangan' value='$r[keterangan]' required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class='box-footer'>
                <button type='submit' class='btn btn-primary'>Update</button>
				<button onclick=self.history.back() class='btn btn-danger'>Batal</button>
              </div>
            </form>
         </div>
	 </div>";
    
    break;
}
}
?>
