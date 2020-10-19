<?php 
session_start();
include('../config/sysconfig.inc.php');
function anti_injection($data){
	$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	return $filter;
}

$username = anti_injection($_POST['username']);
$pass     = anti_injection(md5($_POST['password']));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
	// echo "Sekarang loginnya tidak bisa di injeksi lho.";
	header('location:module.php');
}else{
	$login = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$pass' AND blokir='N'");
	$ketemu = mysql_num_rows($login);
	$r = mysql_fetch_array($login);

	// Apabila username dan password ditemukan
	if ($ketemu > 0){
		include "timeout.php";

		$_SESSION['KCFINDER']				= array();
		$_SESSION['KCFINDER']['disabled']	= false;
		$_SESSION['KCFINDER']['uploadURL']	= "../images";
		$_SESSION['KCFINDER']['uploadDir']	= "";

		$_SESSION[namauser] 	= $r[username];
		$_SESSION[namalengkap]	= $r[nama_lengkap];
		$_SESSION[passuser]		= $r[password];
		$_SESSION[leveluser]	= $r[level];
  
		// session timeout
		$_SESSION[login] = 1;
		timer();

		$sid_lama = session_id();	
		//session_regenerate_id();
		$sid_baru = session_id();

		mysql_query("UPDATE users SET id_session='$sid_baru' WHERE username='$username'");
		// header('location:module.php?module=home');
		echo '<script language="javascript">window.location="module.php?module=home";</script>';
	
	}else{
		include "error-login.php";
	}
}
?>
