<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_admin/aksi_admin.php";
switch($_GET[act]){
  // Tampil User
  default:
  echo"
  <div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>ADMIN</h3>
            </div>";
			if ($_SESSION['leveluser']=='admin' ){
			echo"
			<input type=button class='btn btn-primary' value='Tambah' onclick=\"window.location.href='?module=admin&act=tambahadmin';\">
							<p>";
			}
			echo"
            <!-- /.box-header -->
            <div class='box-body table-responsive no-padding'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>";  
    echo "<thead>
          <tr><th>no</th><th>NIP</th><th>Nama</th><th>Email</th><th>No.Telp</th><th>Level</th><th>Aksi</th></tr></thead>
	<thead>
	<tbody>";
	if ($_SESSION['leveluser']=='admin' ){	
	$tampil = mysql_query("SELECT * FROM user ORDER BY id_user");
	}
	else {
	$tampil = mysql_query("SELECT * FROM user WHERE id_user='$_SESSION[user_id]' ORDER BY id_user");
	}
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nip]</td>
			 <td>$r[nama]</td>
		         <td>$r[email]</td>
		         <td>$r[no_telp]</td>
				 <td>$r[level]</td>
             <td><a href=?module=admin&act=editadmin&id=$r[id_user] class='btn btn-primary btn-sm' title='Edit'><i class='fa fa-edit'></i></a>
	               <a href=?module=admin&act=editpassword&id=$r[id_user] class='btn btn-info btn-sm' title='Ganti Password'><i class='fa fa-key'></i></a>
				   <a href=$aksi?module=admin&act=hapus&id=$r[id_user] class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i></a>
			 </td></tr>";
      $no++;
    }
    echo "</tbody></table></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
    break;
  
  case "tambahadmin":
    
   echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM TAMBAH ADMIN</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action='$aksi?module=admin&act=input' enctype='multipart/form-data'>
              <div class='box-body'>
                
                <div class='form-group'>
                  <label for='exampleInputPassword1'>Password</label>
                  <input type='password' name='password' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Password' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>NIP</label>
                  <input type='text' name='nip' class='form-control' id='exampleInputPassword1' placeholder='Masukkan NIP' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Nama</label>
                  <input type='text' name='nama' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama Lengkap' required>
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
                  <label for='exampleInputPassword1'>Level</label>
                  <select class='form-control' name='level' required>
					<option value='' selected>- Pilih Level User -</option>
					<option>admin</option>
					<option>petugas</option>
				  </select>
                </div>
                <div class='form-group'>
                  <label for='exampleInputPassword1'>Foto</label>
                  <input type='file' name='fupload' id='exampleInputFile'>
                  <p class='help-block'>Pastikan File yang diupload berekstensi *JPG atau *JPEG.</p>
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
    
  case "editadmin":
    $edit=mysql_query("SELECT * FROM user WHERE id_user='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM EDIT ADMIN</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=admin&act=update enctype='multipart/form-data'>
          <input type=hidden name=id value='$r[id_user]'>
              <div class='box-body'>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>NIP</label>
                  <input type='text' name='nip' class='form-control' id='exampleInputPassword1' placeholder='Masukkan NIP' value='$r[nip]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Nama</label>
                  <input type='text' name='nama' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nama Lengkap' value='$r[nama]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Email</label>
                  <input type='email' name='email' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Email' value='$r[email]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>No. Telp</label>
                  <input type='number' name='no_telp' class='form-control' id='exampleInputPassword1' placeholder='Masukkan Nomor Telepon' value='$r[no_telp]' required>
                </div>";
				if ($_SESSION['leveluser']=='admin' ){
				echo"
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Level</label>
                  <select class='form-control' name='level' required>
					<option selected>$r[level]</option>
					<option>admin</option>
					<option>petugas</option>
				  </select>
                </div>";
				}
				else {
				echo"<input type=hidden name=level value='$r[level]'>";
				}
				echo"
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Foto</label>
                  <p class='help-block'><img src='foto_user/small_$r[foto]'></p>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Ganti Foto</label>
                  <input type='file' name='fupload' id='exampleInputFile'>
                  <p class='help-block'>Pastikan File yang diupload berekstensi *JPG atau *JPEG.</p>
                </div>";
				
				echo"
				
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
case "editpassword":
    $edit=mysql_query("SELECT * FROM user WHERE id_user='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM GANTI PASSWORD</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=admin&act=pass>
          <input type=hidden name=id value='$r[id_user]'>
              <div class='box-body'>
                
                <div class='form-group'>
                  <label for='exampleInputPassword1'>Password</label>
                  <input type='password' name='password' class='form-control' id='exampleInputPassword1' placeholder='Ganti Password' required>
                </div>
				";
				
				echo"
				
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
