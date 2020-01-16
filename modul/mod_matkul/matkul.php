<?php
$aksi="modul/mod_matkul/aksi_matkul.php";
switch($_GET[act]){
  // Tampil matkul
  default:
    echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>MATA KULIAH</h3>
            </div>
			<input type=button class='btn btn-primary' value='Tambah' onclick=\"window.location.href='?module=matkul&act=tambahmatkul';\">
							<p>
            <!-- /.box-header -->
            <div class='box-body'>
			<div class='box-body table-responsive no-padding'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>
	<thead>
          <tr><th>No</th><th>Nama Mata Kuliah</th><th>Aksi</th></tr>
		  <tbody>"; 
    $tampil=mysql_query("SELECT * FROM matkul ORDER BY id_matkul DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama_matkul]</td>
             <td><a href=?module=matkul&act=editmatkul&id=$r[id_matkul] class='btn btn-primary btn-sm' title='Edit'><i class='fa fa-edit'></i></a>
	               <a href=$aksi?module=matkul&act=hapus&id=$r[id_matkul] class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i></a>
             </td></tr>";
      $no++;
    }
    echo "</tbody></table></div>
	       </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
    break;
  
  // Form Tambah matkul
  case "tambahmatkul":
    
	echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM TAMBAH MATA KULIAH</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action='$aksi?module=matkul&act=input'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Nama Matkul</label>
                  <input type='text' class='form-control' name='nama_matkul' id='exampleInputEmail1' placeholder='Masukkan Nama matkul' required>
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
  
  // Form Edit matkul  
  case "editmatkul":
    $edit=mysql_query("SELECT * FROM matkul WHERE id_matkul='$_GET[id]'");
    $r=mysql_fetch_array($edit);

	echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM EDIT MATA KULIAH</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=matkul&act=update>
            <input type=hidden name=id value='$r[id_matkul]'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Nama Matkul</label>
                  <input type='text' class='form-control' name='nama_matkul' id='exampleInputEmail1' placeholder='Masukkan Nama matkul' value='$r[nama_matkul]' required>
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
?>
