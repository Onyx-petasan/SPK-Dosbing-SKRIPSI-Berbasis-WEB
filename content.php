<?php
	include "config/koneksi.php";
   include "config/library.php";
   include "config/fungsi_indotgl.php";
   include "config/fungsi_combobox.php";
   include "config/class_paging.php";
// Bagian Home
if ($_GET['module']=='home'){
$tgl_skrg = date("Y-m-d");
$cek=mysql_query("SELECT * FROM user");
$ketemu=mysql_num_rows($cek);
$cek2=mysql_query("SELECT * FROM tugasakhir");
$ketemu2=mysql_num_rows($cek2);
  
 if ($_SESSION['leveluser']=='admin' ){
 
 echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>Selamat Datang</h3>
			  <br>
			  <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di Halaman Administrator.<br> 
          Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola website. </p>
		  
		  <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>
            
        </div>
            <!-- /.box-header -->
            <div class='box-body'>
            
<div class='col-lg-3 col-xs-6'>
          <!-- small box -->
          <div class='small-box bg-aqua'>
            <div class='inner'>
              <h3>$ketemu</h3>

              <p>User Admin</p>
            </div>
            <div class='icon'>
              <i class='fa fa-user'></i>
            </div>
            <a href='media.php?module=admin' class='small-box-footer'>Detail <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        <!-- ./col -->
		
        <div class='col-lg-3 col-xs-6'>
          <!-- small box -->
          <div class='small-box bg-green'>
            <div class='inner'>
              <h3>$ketemu2</h3>

              <p>Tugas Akhir</p>
            </div>
            <div class='icon'>
              <i class='fa fa-users'></i>
            </div>
            <a href='media.php?module=tugasakhir' class='small-box-footer'>Detail <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        <!-- ./col -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
 
 
 
 
  

          
  }
  else {
  echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>Dashboard</h3>
			  ";
            echo"</div>
            <!-- /.box-header -->
            <div class='box-body'>
            
		<div class='col-md-3 col-sm-6 col-xs-12'>
          <div class='info-box'>
            <span class='info-box-icon bg-aqua'><i class='fa fa-user'></i></span>

            <div class='info-box-content'>
              <span class='info-box-text'>Data User</span>
              <span class='info-box-number'>$ketemu</span>
			  <a href='media.php?module=admin' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		<div class='col-md-3 col-sm-6 col-xs-12'>
          <div class='info-box'>
            <span class='info-box-icon bg-green'><i class='fa fa-users'></i></span>

            <div class='info-box-content'>
              <span class='info-box-text'>Data Tugas Akhir</span>
              <span class='info-box-number'>$ketemu2</span>
			  <a href='media.php?module=tugasakhir' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";
	$user=mysql_query("SELECT * FROM user WHERE id_user='$_SESSION[user_id]'");
    $k=mysql_fetch_array($user);
		echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class='box-body'>
                
				<img src='gambar.jpg' width=500px height=250px>
				
              </div>
              <!-- /.box-body -->

              
         </div>
	 </div>";
	 
	 echo"
   	<div class='col-md-6'>  
		 <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Selamat Datang</h3>
            </div>
            <!-- /.box-header -->
              <div class='box-body'>
			  <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di Halaman Administrator.<br> 
          Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola website. </p>
		  
		  <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
				echo"
              </div>
              <!-- /.box-body -->
         </div>
	 </div>";		     
  }
  }

// Bagian kriteria
elseif ($_GET['module']=='kriteria'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
    include "modul/mod_kriteria/kriteria.php";
  }
}
elseif ($_GET['module']=='analisa'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
    include "modul/mod_analisa/analisa.php";
  }
}
// Bagian kompetensi
elseif ($_GET['module']=='kompetensi'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
    include "modul/mod_kompetensi/kompetensi.php";
  }
}
// Bagian kompetensi
elseif ($_GET['module']=='matkul'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_matkul/matkul.php";
  }
}
// Bagian admin
elseif ($_GET['module']=='admin'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
    include "modul/mod_admin/admin.php";
  }
}
elseif ($_GET['module']=='dosen'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
    include "modul/mod_dosen/dosen.php";
  }
}
elseif ($_GET['module']=='hasil'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_hasil/hasil.php";
  }
}
elseif ($_GET['module']=='tugasakhir'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
    include "modul/mod_tugasakhir/tugasakhir.php";
  }
}
// Bagian parameter
elseif ($_GET['module']=='parameter'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
    include "modul/mod_parameter/parameter.php";
  }
}

// Bagian hasil
elseif ($_GET['module']=='hasil'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_hasil/hasil.php";
  }
}
// Bagian hasil
elseif ($_GET['module']=='daftar'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
    include "modul/mod_daftar/daftar.php";
  }
}

// Bagian laporan
elseif ($_GET['module']=='laporan'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='petugas'){
    include "modul/mod_laporan/laporan.php";
  }
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
