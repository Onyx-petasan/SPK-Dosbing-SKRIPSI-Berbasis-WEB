<?php
if ($_SESSION['leveluser']=='admin' ){
echo"<li>
          <a href='media.php?module=home'>
            <i class='fa fa-th'></i> <span>Home</span>
            
          </a>
        </li> 
		<li>
          <a href='media.php?module=admin'>
            <i class='fa fa-user'></i> <span>Admin</span>
          </a>
        </li> 		
		    <li><a href='media.php?module=kriteria'><i class='fa fa-circle-o'></i> Kriteria</a></li>
			<li><a href='media.php?module=parameter'><i class='fa fa-circle-o'></i> Parameter</a></li>
			<li><a href='media.php?module=kompetensi'><i class='fa fa-circle-o'></i> Kompetensi</a></li>
		    <li><a href='media.php?module=matkul'><i class='fa fa-circle-o'></i> Mata Kuliah</a></li>
			<li><a href='media.php?module=dosen'><i class='fa fa-circle-o'></i> Dosen</a></li>
			<li><a href='media.php?module=tugasakhir'><i class='fa fa-circle-o'></i> Hasil Hitungan</a></li>
			<li><a href='media.php?module=daftar'><i class='fa fa-circle-o'></i> Daftar Pembimbing</a></li>
		<li>
          <a href='media.php?module=laporan'>
            <i class='fa fa-book'></i> <span>Laporan</span>
          </a>
        </li>
		
        ";
}
else {
echo"<li>
          <a href='media.php?module=home'>
            <i class='fa fa-th'></i> <span>Home</span>
            
          </a>
        </li> 
		<li>
          <a href='media.php?module=admin'>
            <i class='fa fa-user'></i> <span>Admin</span>
          </a>
        </li> 		
		    <li><a href='media.php?module=dosen'><i class='fa fa-circle-o'></i> Dosen</a></li>
			<li><a href='media.php?module=daftar'><i class='fa fa-circle-o'></i> Hasil Hitungan</a></li>
			
			<li><a href='media.php?module=kriteria'><i class='fa fa-circle-o'></i> Kriteria</a></li>
			<li><a href='media.php?module=parameter'><i class='fa fa-circle-o'></i> Parameter</a></li>
		<li>
          <a href='media.php?module=laporan'>
            <i class='fa fa-book'></i> <span>Laporan</span>
          </a>
        </li>
		
        ";
}

?>