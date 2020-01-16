<?php
include "config/koneksi.php";

echo"
<table id='example1' class='table table-bordered table-striped'>  
  <div class='panel-heading'>
	<thead>
          <tr><th>No</th><th>Nama kriteria</th><th>Aksi</th></tr>
		  <tbody>"; 
    $tampil=mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama_kriteria]</td>
             <td><a href=?module=kriteria&act=editkriteria&id=$r[id_kriteria] class='btn btn-primary btn-sm' title='Edit'><i class='fa fa-edit'></i></a>
             </td></tr>";
      $no++;
    }
    echo "</tbody></table>";
		?>