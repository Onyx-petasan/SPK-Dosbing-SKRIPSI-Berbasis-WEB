<?php
$aksi="modul/mod_kriteria/aksi_kriteria.php";
switch($_GET[act]){
  // Tampil kriteria
  default:
    echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>KERITERIA</h3>
            </div>";
			if ($_SESSION['leveluser']=='admin' ){
			echo"
			<input type=button class='btn btn-primary' value='Tambah' onclick=\"window.location.href='?module=kriteria&act=tambahkriteria';\">
			<p>";
			}
			echo"
            <!-- /.box-header -->
            <div class='box-body table-responsive no-padding'>
              <table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>
	<thead>
          <tr><th>No</th><th>Nama kriteria</th><th>Jenis Kriteria</th><th>Bobot</th><th>Aksi</th></tr>
		  <tbody>"; 
    $tampil=mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama_kriteria]</td>
			 <td>$r[jenis]</td>
			 <td>$r[bobot]</td>
             <td>";
			 if ($_SESSION['leveluser']=='admin' ){
			 echo"
			 <a href=?module=kriteria&act=editkriteria&id=$r[id_kriteria] class='btn btn-primary btn-sm' title='Edit'><i class='fa fa-edit'></i></a>
             <a href=$aksi?module=kriteria&act=hapus&id=$r[id_kriteria] class='btn btn-danger btn-sm' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i></a>
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
  
  // Form Tambah kriteria
  case "tambahkriteria":
    
	echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Form Tambah kriteria</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action='$aksi?module=kriteria&act=input'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Nama kriteria</label>
                  <input type='text' class='form-control' name='nama_kriteria' id='exampleInputEmail1' placeholder='Masukkan Nama kriteria' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>Bobot</label>
                  <input type='number' class='form-control' name='bobot' id='exampleInputEmail1' placeholder='Masukkan Bobot kriteria' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Jenis Kriteria</label>
                  <select class='form-control' name='jenis' required>
							<option value='' selected>- Pilih Jenis Kriteria -</option>
							<option>Benefit</option>
							<option>Cost</option>
				  </select>
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
  
  // Form Edit kriteria  
  case "editkriteria":
    $edit=mysql_query("SELECT * FROM kriteria WHERE id_kriteria='$_GET[id]'");
    $r=mysql_fetch_array($edit);

	echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM EDIT KRITERIA</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=kriteria&act=update>
            <input type=hidden name=id value='$r[id_kriteria]'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Nama kriteria</label>
                  <input type='text' class='form-control' name='nama_kriteria' id='exampleInputEmail1' placeholder='Masukkan Nama kriteria' value='$r[nama_kriteria]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>Bobot</label>
                  <input type='number' class='form-control' name='bobot' id='exampleInputEmail1' placeholder='Masukkan Bobot kriteria' value='$r[bobot]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputPassword1'>Jenis Kriteria</label>
                  <select class='form-control' name='jenis' required>
							<option selected>$r[jenis]</option>
							<option>Benefit</option>
							<option>Cost</option>
				  </select>
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
