<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
		  
   echo "<div class='col-xs-12'>
        <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>LAPORAN DATA TUGAS AKHIR</h3>
            </div>
			
            <!-- /.box-header -->
            <form id='form1' method=POST action='modul/mod_laporan/cetakhasil.php' target='_blank'>
              <div class='box-body'>
                
              <div class='box-footer'>
                <button type='submit' class='btn btn-primary'>Proses</button>
              </div></div>
			  </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>";

	


?>
