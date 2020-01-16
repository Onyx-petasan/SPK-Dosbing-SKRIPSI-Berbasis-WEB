<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_klasifikasi/aksi_klasifikasi.php";
switch($_GET[act]){
  // Tampil User
  default:
  
  echo"
  <div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>KLASIFIKASI DOSEN</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body table-responsive no-padding'>
              <table class='table table-bordered table-striped'>  
  <div class='panel-heading'>";  
    echo "<thead>
          <tr>
		    <th>No</th>
			<th>NIP</th>
			<th>Nama</th>
			<th>Kriteria</th>
			<th>Parameter</th>
			<th>Nilai</th>
		  </tr>
		</thead>
	<thead>
	<tbody>"; 
	$tampil = mysql_query("SELECT * FROM detail_dosen,dosen,kriteria,parameter WHERE detail_dosen.id_dosen=dosen.id_dosen 
																	AND detail_dosen.id_kriteria=kriteria.id_kriteria
																	AND detail_dosen.id_parameter=parameter.id_parameter
																	ORDER BY dosen.nama_dosen ASC, kriteria.id_kriteria ASC");
	$dsn="";
	$ds="";
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>";
	   if ($dsn != $r['nip']) {
            echo $no;
         } else {
            $no--;
         }
		 echo"</td>
             <td>";
			 if ($dsn != $r['nip']) {
				echo $r['nip'];
				}
				$dsn = $r['nip'];
			echo"</td>
			<td>";
			 if ($ds != $r['nama_dosen']) {
				echo $r['nama_dosen'];
				}
				$ds = $r['nama_dosen'];
			echo"</td>
			 <td>$r[nama_kriteria]</td>
			 <td>$r[nama_parameter]</td>
			 <td>$r[nilai]</td>
			 </tr>";
      $no++;
	  
    }
    echo "
	
	</tbody>
	<thead>";
	
	echo"
		</thead>
	</table>
	<input type=button class='btn btn-primary' value='Lakukan Perhitungan' onclick=\"window.location.href='media.php?module=analisa';\">
			<p>
	</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
	
    break;
  
  
}
}
?>
