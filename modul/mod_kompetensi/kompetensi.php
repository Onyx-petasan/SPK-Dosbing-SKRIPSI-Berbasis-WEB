<?php
$aksi="modul/mod_kompetensi/aksi_kompetensi.php";
switch($_GET[act]){
  // Tampil kompetensi
  default:
    echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>KOMPETENSI DOSEN</h3>
            </div>
			<input type=button class='btn btn-primary' value='Tambah' onclick=\"window.location.href='?module=kompetensi&act=tambahkompetensi';\">
			<p>
            <!-- /.box-header -->
            <div class='box-body table-responsive no-padding'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>
	<thead>
          <tr><th>No</th><th>Dosen</th><th>Nama Kompetensi</th><th>Bobot</th><th>Aksi</th></tr>
		  <tbody>"; 
    $tampil=mysql_query("SELECT * FROM kompetensi,dosen,parameter WHERE kompetensi.id_dosen=dosen.id_dosen 
																  AND kompetensi.id_parameter=parameter.id_parameter	
																		ORDER BY kompetensi.id_dosen ASC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama_dosen]</td>
			 <td>$r[nama_parameter]</td>
			 <td>$r[nilaii]</td>
             <td><a href=?module=kompetensi&act=editkompetensi&id=$r[id_kompetensi] class='btn btn-primary btn-sm' title='Edit'><i class='fa fa-edit'></i></a>
             <a href=$aksi?module=kompetensi&act=hapus&id=$r[id_kompetensi] class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i></a>
			 </td></tr>";
      $no++;
    }
    echo "</tbody></table></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
    break;
	
   // Form Tambah kompetensi  
  case "tambahkompetensi":   

	echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM TAMBAH KOMPETENSI</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=kompetensi&act=input>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputPassword1'>Dosen</label>
                  <select class='form-control' name='dosen' required>
					<option value='' selected>- Pilih dosen -</option>";
				  $tampil=mysql_query("SELECT * FROM dosen ORDER BY nama_dosen");				
				  while($w=mysql_fetch_array($tampil)){
						echo "<option value=$w[id_dosen]>$w[nama_dosen]</option>";
				  }
				   echo "</select>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Kompetensi</label>
                  <select class='form-control' name='kompetensi' required>
					<option value='' selected>- Pilih parameter -</option>";
				  $tampil=mysql_query("SELECT * FROM parameter WHERE id_kriteria='3' ORDER BY nama_parameter");				
				  while($w=mysql_fetch_array($tampil)){
						echo "<option value=$w[id_parameter]>$w[nama_parameter]</option>";
				  }
				   echo "</select>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>Bobot</label>
                  <input type='number' class='form-control' name='nilaii' id='exampleInputEmail1' placeholder='Masukkan Bobot' required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class='box-footer'>
                <button type='submit' class='btn btn-primary'>Update</button>
				<input type=button class='btn btn-danger' value='Batal' onclick=\"window.location.href='?module=kompetensi';\">
              </div>
            </form>
         </div>
	 </div>";
    
    break; 
  // Form Edit kompetensi  
  case "editkompetensi":
    $edit=mysql_query("SELECT * FROM kompetensi WHERE id_kompetensi='$_GET[id]'");
    $r=mysql_fetch_array($edit);

	echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM EDIT kompetensi</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=kompetensi&act=update>
            <input type=hidden name=id value='$r[id_kompetensi]'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputPassword1'>Dosen</label>
                  <select class='form-control' name='dosen' required>";
 
				  $tampil=mysql_query("SELECT * FROM dosen ORDER BY nama_dosen");
					if ($r[id_dosen]==0){
						echo "<option value=0 selected>- Pilih dosen -</option>";
					}   

				  while($w=mysql_fetch_array($tampil)){
					if ($r[id_dosen]==$w[id_dosen]){
						echo "<option value=$w[id_dosen] selected>$w[nama_dosen]</option>";
					}
					else{
						echo "<option value=$w[id_dosen]>$w[nama_dosen]</option>";
					}
				  }
				   echo "</select>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Kompetensi</label>
                  <select class='form-control' name='kompetensi' required>";
 
				  $tampil=mysql_query("SELECT * FROM parameter WHERE id_kriteria='3' ORDER BY nama_parameter");
					if ($r[id_parameter]==0){
						echo "<option value=0 selected>- Pilih Kompetensi -</option>";
					}   

				  while($w=mysql_fetch_array($tampil)){
					if ($r[id_parameter]==$w[id_parameter]){
						echo "<option value=$w[id_parameter] selected>$w[nama_parameter]</option>";
					}
					else{
						echo "<option value=$w[id_parameter]>$w[nama_parameter]</option>";
					}
				  }
				   echo "</select>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>Bobot</label>
                  <input type='number' class='form-control' name='nilaii' id='exampleInputEmail1' placeholder='Masukkan Bobot' value='$r[nilaii]' required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class='box-footer'>
                <button type='submit' class='btn btn-primary'>Update</button>
				<input type=button class='btn btn-danger' value='Batal' onclick=\"window.location.href='?module=kompetensi';\">
              </div>
            </form>
         </div>
	 </div>";
    
    break;  
}
?>
