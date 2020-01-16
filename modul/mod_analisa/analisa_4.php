<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

?>
  
 <?php
 $cek=mysql_query("SELECT * FROM tugasakhir WHERE id_tugasakhir='$_GET[id]'");
    $c=mysql_fetch_array($cek);
	$tanggal=tgl_indo($c[tgl_input]);
	$id_parameter=$c[id_parameter];
$param=mysql_query("SELECT * FROM parameter WHERE id_parameter='$id_parameter'");
    $pa=mysql_fetch_array($param);
$cek2= mysql_query("SELECT * FROM kompetensi WHERE id_parameter='$id_parameter'");
    while ($c2=mysql_fetch_array($cek2)){
$value=$c2[nilaii];	
$dosen=$c2[id_dosen];	
  mysql_query("UPDATE detail_dosen SET id_parameter   = '$id_parameter',
										value          = '$value'  
                           WHERE  id_dosen     = '$dosen' AND id_kriteria='3'");
						   }
 ?>
 <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>

              <h3 class="box-title">Detail Tugas Akhir</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
			  <?php
			  echo"
                <dt>Judul</dt>
                <dd>$c[judul]</dd>
                <dt>NIM</dt>
                <dd>$c[nim]</dd>
                <dt>Nama Mahasiswa</dt>
                <dd>$c[nama_mahasiswa]</dd>
				<dt>Kompetensi</dt>
                <dd>$pa[nama_parameter]</dd>
                <dt>Tgl. Input</dt>
                <dd>$tanggal </dd>";
				?>
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
  <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">KLASIFIKASI DOSEN</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped">  
  <div class="panel-heading">  
    <thead>
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
	<tbody>
	<?php
	$tampil = mysql_query("SELECT * FROM detail_dosen,dosen,kriteria,parameter WHERE detail_dosen.id_dosen=dosen.id_dosen 
																	AND detail_dosen.id_kriteria=kriteria.id_kriteria
																	AND detail_dosen.id_parameter=parameter.id_parameter
																	AND dosen.jumlah < 5
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
			 <td>$r[nilai]</td>";
      $no++;
    }
    echo "
	
	</tbody>
	<thead>";
	?>
	<?php
#Cari nilai maximal

$carimax1 = mysql_query("SELECT max(parameter.nilai) as max1
								FROM detail_dosen,parameter WHERE detail_dosen.id_parameter=parameter.id_parameter AND parameter.id_kriteria='1'");
$max1 = mysql_fetch_array($carimax1);
$carimax2 = mysql_query("SELECT max(parameter.nilai) as max2
								FROM detail_dosen,parameter WHERE detail_dosen.id_parameter=parameter.id_parameter AND parameter.id_kriteria='2'");
$max2 = mysql_fetch_array($carimax2);
$carimax3 = mysql_query("SELECT max(kompetensi.nilaii) as max3
								FROM kompetensi,dosen WHERE kompetensi.id_dosen=dosen.id_dosen AND kompetensi.id_parameter='$id_parameter'");
$max3 = mysql_fetch_array($carimax3);
$carimax4 = mysql_query("SELECT max(parameter.nilai) as max4
								FROM detail_dosen,parameter WHERE detail_dosen.id_parameter=parameter.id_parameter AND parameter.id_kriteria='4'");
$max4 = mysql_fetch_array($carimax4);

?>
	<?php
	$cek1=mysql_query("SELECT * FROM kriteria WHERE id_kriteria='1'");
    $r1=mysql_fetch_array($cek1);
	$bobot1=$r1[bobot];
	$cek2=mysql_query("SELECT * FROM kriteria WHERE id_kriteria='2'");
    $r2=mysql_fetch_array($cek2);
	$bobot2=$r2[bobot];
	$cek3=mysql_query("SELECT * FROM kriteria WHERE id_kriteria='3'");
    $r3=mysql_fetch_array($cek3);
	$bobot3=$r3[bobot];
	$cek4=mysql_query("SELECT * FROM kriteria WHERE id_kriteria='4'");
    $r4=mysql_fetch_array($cek4);
	$bobot4=$r4[bobot];
	
	echo"
          <tr>
		    
			<th>Bobot</th>
			<th>$bobot1 ($r1[nama_kriteria])</th>
			<th>$bobot2 ($r2[nama_kriteria])</th>
			<th>$bobot3 ($r3[nama_kriteria])</th>
			<th>$bobot4 ($r4[nama_kriteria])</th>
		  </tr>
		   <tr>
			<th>Sifat</th>
			<th>MAX</th>
			<th>MAX</th>
			<th>MAX</th>
			<th>MAX</th>
		  </tr>
		   <tr>
		    <th></th>
			<th>$max1[max1]</th>
			<th>$max2[max2]</th>
			<th>$max3[max3]</th>
			<th>$max4[max4]</th>
		  </tr>";
	echo"
		</thead>
	</table></div>
            <!-- /.box-body -->";
	?>
	
<h4 class="box-title">NORMALISASI</h4>
	<div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-striped">  
  <div class="panel-heading">  
    <thead>
          <tr>
		    <th>No</th>
			<th>NIP</th>
			<th>Nama</th>
			<th>Pendidikan</th>
			<th>Jabatan Fungsional</th>
			<th>Kompetensi</th>
			<th>Jumlah Artikel</th>
		  </tr>
		</thead>
	<thead>
	<tbody>
	<?php
	$data = mysql_query("SELECT 
          a.id_dosen, d.nama_dosen,d.nip,
          
            IF( 
              a.id_kriteria=1, 
              IF( a.id_kriteria=1, 
                a.value/".$max1[max1].",0) 
              ,0) AS C1, 
          SUM( 
            IF( 
              a.id_kriteria=2, 
              IF( a.id_kriteria=2, 
                a.value/".$max2[max2].",0) 
               ,0) 
             ) AS C2, 
          SUM( 
            IF( 
              a.id_kriteria=3, 
              IF( a.id_kriteria=3, 
                a.value/".$max3[max3].",0) 
               ,0) 
             ) AS C3, 
          SUM( 
            IF( 
              a.id_kriteria=4, 
              IF(a.id_kriteria=4,  
                a.value/".$max4[max4].",0) 
               ,0) 
             ) AS C4			 
        FROM 
          detail_dosen a 
          LEFT JOIN kriteria b USING(id_kriteria) 
		   JOIN parameter c USING(id_parameter)
           JOIN dosen d USING(id_dosen)
		   WHERE d.jumlah < 5
        GROUP BY a.id_dosen 
        ORDER BY a.id_dosen");
    $no=1;
	$R=array(); 
    while ($p=mysql_fetch_array($data)){
	$nisn=$p[id_dosen];
	$R[$nisn]=array($p[C1],$p[C2],$p[C3],$p[C4]);
	?>
          <tr><td><?php echo "$no" ;?></td>
             <td><?php echo "$p[nip]";?></td>
			 <td><?php echo "$p[nama_dosen]";?></td>
			 <td><?php echo round($p['C1'],3);?></td>
			 <td><?php echo round($p['C2'],3);?></td>
			 <td><?php echo round($p['C3'],3);?></td>
			 <td><?php echo round($p['C4'],3);?></td>
		 </tr>
	<?php	
      $no++;
    }
    ?>
	
	</tbody>
	
	</table></div>
	
	<?php
  $tampil=mysql_query("SELECT bobot FROM kriteria ORDER BY id_kriteria"); 
  $i=0; 
  $W=array();
  while ($r=mysql_fetch_array($tampil)){ 
    $W[]=$r[bobot]; 
   
  } 
	?>        
	<?php
  mysql_query("DELETE FROM hasil WHERE id_tugasakhir='$_GET[id]'");
  $P=array(); 
  $m=count($W); 
  $no=0; 
  foreach($R as $i=>$r){ 
    for($j=0;$j<$m;$j++){ 
      $P[$i]=(isset($P[$i])?$P[$i]:0)+$r[$j]*$W[$j]; 
	  				   
    } 
	mysql_query("INSERT INTO hasil(id_dosen,
                                 id_tugasakhir,
                                 skor) 
	                       VALUES('{$i}',
                                '$_GET[id]',
                                '{$P[$i]}')");
		  
  }  
	?>
          
	<br>
	<h4 class="box-title">HASIl PERHITUNGAN</h4>
	<div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-striped">  
  <div class="panel-heading">  
    <thead>
          <tr>
		    <th>No</th>
			<th>NIP</th>
			<th>Nama Dosen</th>
			<th>Skor</th>
		  </tr>
		</thead>
	<thead>
	<tbody>
	<?php
	$tampil4 = mysql_query("SELECT * FROM hasil,dosen WHERE hasil.id_dosen=dosen.id_dosen AND hasil.id_tugasakhir='$_GET[id]' ORDER BY hasil.skor DESC");
    $no=1;
    while ($r4=mysql_fetch_array($tampil4)){
	
    echo "<tr class='center'> 
            <td>$no</td> 
            <td>$r4[nip]</td> 
            <td>$r4[nama_dosen]</td>
			<td>$r4[skor]</td>			
          </tr>"; 
		  $no++;
		  
  }  
	?>
          	
	</tbody>	
	</table></div>
	
	<br>
	<h4 class="box-title">REKOMENDASI DOSEN PEMBIMBING</h4>
	<div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-striped">  
  <div class="panel-heading">  
    <thead>
          <tr>
		    <th>Dosen Pembimbing</th>
			<th>NIP</th>
			<th>Nama</th>
			<th>Skor</th>
		  </tr>
		</thead>
	<thead>
	<tbody>
	<?php
	$tampil4 = mysql_query("SELECT * FROM hasil,dosen WHERE hasil.id_dosen=dosen.id_dosen AND hasil.id_tugasakhir='$_GET[id]' ORDER BY hasil.skor DESC LIMIT 2");
    $no=1;
    while ($r4=mysql_fetch_array($tampil4)){
	$iddosen=$r4[id_dosen];
    echo "<tr class='center'> 
            <td>Dosen Pembimbing $no</td> 
            <td>$r4[nip]</td> 
            <td>$r4[nama_dosen]</td>
			<td>$r4[skor]</td>			
          </tr>"; 
		  $no++;
		mysql_query("UPDATE hasil SET dospem = '1' WHERE id_dosen = '$iddosen' AND id_tugasakhir='$_GET[id]'");
	} 
	$tampil6 = mysql_query("SELECT COUNT(hasil.id_dosen) AS jml,hasil.id_dosen FROM hasil,tugasakhir WHERE hasil.id_tugasakhir=tugasakhir.id_tugasakhir
																				AND tugasakhir.status='Aktif'
																				AND hasil.dospem='1' GROUP BY id_dosen");
    while ($r6=mysql_fetch_array($tampil6)){
	$idd=$r6[id_dosen];
	$jml6=$r6[jml];
	mysql_query("UPDATE dosen SET jumlah = '$jml6' WHERE id_dosen = '$idd'");
	}
	?>
          	
	</tbody>
	
	</table></div>
	</div>
	
          
          <!-- /.box -->
        </div>
   
  
<?php  
}

?>
