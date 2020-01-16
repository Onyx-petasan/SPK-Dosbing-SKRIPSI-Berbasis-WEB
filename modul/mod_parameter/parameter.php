<?php
$aksi="modul/mod_parameter/aksi_parameter.php";
switch($_GET[act]){
  // Tampil parameter
  default:
    echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>PARAMETER</h3>
            </div>";
			if ($_SESSION['leveluser']=='admin' ){
			echo"
			<input type=button class='btn btn-primary' value='Tambah' onclick=\"window.location.href='?module=parameter&act=tambahparameter';\">
			<p>";
			}
			echo"
            <!-- /.box-header -->
            <div class='box-body table-responsive no-padding'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>
	<thead>
          <tr><th>No</th><th>Kriteria</th><th>Nama Parameter</th><th>Bobot</th><th>Aksi</th></tr>
		  <tbody>"; 
    $tampil=mysql_query("SELECT * FROM parameter,kriteria WHERE parameter.id_kriteria=kriteria.id_kriteria ORDER BY kriteria.id_kriteria,parameter.id_parameter ASC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama_kriteria]</td>
			 <td>$r[nama_parameter]</td>
			 <td>$r[nilai]</td>
             <td>";
			 if ($_SESSION['leveluser']=='admin' ){
			 echo"
			 <a href=?module=parameter&act=editparameter&id=$r[id_parameter] class='btn btn-primary btn-sm' title='Edit'><i class='fa fa-edit'></i></a>
             <a href=$aksi?module=parameter&act=hapus&id=$r[id_parameter] class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i></a>
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
	
   // Form Tambah parameter  
  case "tambahparameter":
    $edit=mysql_query("SELECT * FROM parameter WHERE id_parameter='$_GET[id]'");
    $r=mysql_fetch_array($edit);

	echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM EDIT PARAMETER</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=parameter&act=input>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputPassword1'>Kriteria</label>
                  <select class='form-control' name='kriteria' required>
					<option value='' selected>- Pilih kriteria -</option>";
				  $tampil=mysql_query("SELECT * FROM kriteria ORDER BY nama_kriteria");				
				  while($w=mysql_fetch_array($tampil)){
						echo "<option value=$w[id_kriteria]>$w[nama_kriteria]</option>";
				  }
				   echo "</select>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>Nama Parameter</label>
                  <input type='text' class='form-control' name='nama_parameter' id='exampleInputEmail1' placeholder='Masukkan Nama parameter' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>Bobot</label>
                  <input type='number' class='form-control' name='nilai' id='exampleInputEmail1' placeholder='Masukkan Bobot' required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class='box-footer'>
                <button type='submit' class='btn btn-primary'>Simpan</button>
				<input type=button class='btn btn-danger' value='Batal' onclick=\"window.location.href='?module=parameter';\">
              </div>
            </form>
         </div>
	 </div>";
    
    break; 
  // Form Edit parameter  
  case "editparameter":
    $edit=mysql_query("SELECT * FROM parameter WHERE id_parameter='$_GET[id]'");
    $r=mysql_fetch_array($edit);

	echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM EDIT PARAMETER</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=parameter&act=update>
            <input type=hidden name=id value='$r[id_parameter]'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputPassword1'>Kriteria</label>
                  <select class='form-control' name='kriteria' required>";
 
				  $tampil=mysql_query("SELECT * FROM kriteria ORDER BY nama_kriteria");
					if ($r[id_kriteria]==0){
						echo "<option value=0 selected>- Pilih Kriteria -</option>";
					}   

				  while($w=mysql_fetch_array($tampil)){
					if ($r[id_kriteria]==$w[id_kriteria]){
						echo "<option value=$w[id_kriteria] selected>$w[nama_kriteria]</option>";
					}
					else{
						echo "<option value=$w[id_kriteria]>$w[nama_kriteria]</option>";
					}
				  }
				   echo "</select>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>Nama parameter</label>
                  <input type='text' class='form-control' name='nama_parameter' id='exampleInputEmail1' placeholder='Masukkan Nama parameter' value='$r[nama_parameter]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>Bobot</label>
                  <input type='number' class='form-control' name='nilai' id='exampleInputEmail1' placeholder='Masukkan Bobot' value='$r[nilai]' required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class='box-footer'>
                <button type='submit' class='btn btn-primary'>Update</button>
				<input type=button class='btn btn-danger' value='Batal' onclick=\"window.location.href='?module=parameter';\">
              </div>
            </form>
         </div>
	 </div>";
    
    break;  
}
?>
