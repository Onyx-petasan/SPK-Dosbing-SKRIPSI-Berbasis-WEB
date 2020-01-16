<?php
$aksi="modul/mod_tugasakhir/aksi_tugasakhir.php";
switch($_GET[act]){
  // Tampil tugasakhir
  default:
    echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>TUGAS AKHIR</h3>
            </div>
			<input type=button class='btn btn-primary' value='Tambah' onclick=\"window.location.href='?module=tugasakhir&act=tambahtugasakhir';\">
			<p>
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
             <td><a href=?module=tugasakhir&act=edittugasakhir&id=$r[id_tugasakhir] class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-edit'></i> Edit</a>
			 <a href=?module=analisa&id=$r[id_tugasakhir] class='btn btn-success btn-xs' title='Perhitungan'><i class='fa fa-folder'></i> Hitung</a>
             <a href=$aksi?module=tugasakhir&act=hapus&id=$r[id_tugasakhir] class='btn btn-danger btn-xs' title='Hapus' onClick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini ?')\"><i class='fa fa-trash'></i> Hapus</a>
			 </td></tr>";
      $no++;
    }
    echo "</tbody></table></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
    break;
  
  // Form Tambah tugasakhir
  case "tambahtugasakhir":
    
	echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Form Tambah Tugas Akhir</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action='$aksi?module=tugasakhir&act=input'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Judul</label>
                  <input type='text' class='form-control' name='judul' id='exampleInputEmail1' placeholder='Masukkan Judul Tugas Akhir' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>NIM</label>
                  <input type='number' class='form-control' name='nim' id='exampleInputEmail1' placeholder='Masukkan NIM' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>Nama Mahasiswa</label>
                  <input type='text' class='form-control' name='nama_mahasiswa' id='exampleInputEmail1' placeholder='Masukkan Nama Mahasiswa' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>Kompetensi</label>
                  <select class='form-control col-md-7 col-xs-12' name='parameter' required>
							<option value='' selected>- Pilih Kompetensi -</option>";
								$tampil=mysql_query("SELECT * FROM parameter WHERE id_kriteria='3'");
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
  
  // Form Edit tugasakhir  
  case "edittugasakhir":
    $edit=mysql_query("SELECT * FROM tugasakhir WHERE id_tugasakhir='$_GET[id]'");
    $r=mysql_fetch_array($edit);

	echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>FORM EDIT tugasakhir</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method=POST action=$aksi?module=tugasakhir&act=update>
            <input type=hidden name=id value='$r[id_tugasakhir]'>
              <div class='box-body'>
                <div class='form-group'>
                  <label for='exampleInputEmail1'>Judul</label>
                  <input type='text' class='form-control' name='judul' id='exampleInputEmail1' placeholder='Masukkan Judul Tugas Akhir' value='$r[judul]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>NIM</label>
                  <input type='number' class='form-control' name='nim' id='exampleInputEmail1' placeholder='Masukkan NIM' value='$r[nim]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>Nama Mahasiswa</label>
                  <input type='text' class='form-control' name='nama_mahasiswa' id='exampleInputEmail1' placeholder='Masukkan Nama Mahasiswa' value='$r[nama_mahasiswa]' required>
                </div>
				<div class='form-group'>
                  <label for='exampleInputEmail1'>Kompetensi</label>
                  <select class='form-control col-md-7 col-xs-12' name='parameter' required>";
							$tampil=mysql_query("SELECT * FROM parameter WHERE id_kriteria='3'");
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
                  <label for='exampleInputEmail1'>Status</label>
                  <select class='form-control col-md-7 col-xs-12' name='status' required>
							<option selected>$r[status]</option>
							<option>Aktif</option>
							<option>Lulus</option>
							<option>Gagal</option>
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
