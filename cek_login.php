<?php
include "config/koneksi.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$email = $_POST['email'];
$pass     = md5($_POST['password']);

// pastikan username dan password adalah berupa huruf atau angka.

$login=mysql_query("SELECT * FROM user WHERE email='$email' AND password='$pass'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  $_SESSION[namauser]     = $r[email];
  $_SESSION[user_id]     = $r[id_user];
  $_SESSION[namalengkap]  = $r[nama];
  $_SESSION[passuser]     = $r[password];
  $_SESSION[leveluser]    = $r[level];
  header('location:media.php?module=home');
}
else{

  echo "<link href=../config/adminstyle.css rel=stylesheet type=text/css>";
  echo "<center>LOGIN GAGAL! <br> 
        Username atau Password Anda tidak benar.<br>
        Atau account Anda sedang diblokir.<br>";
  echo "<a href=index.php><b>ULANGI LAGI</b></a></center>";

}

?>
