<?php 
session_start();
// Report simple running errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors',0);

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){

	echo "<link href='style.css' rel='stylesheet' type='text/css'><center>Untuk mengakses modul, Anda harus login <br>";

	//echo "<a href=../../index.php><b>LOGIN</b></a></center>";

}else{

	include('../../config/sysconfig.inc.php');



	$module=$_GET[module];

	$act=$_GET[act];



	// Input user

	if ($module=='users' AND $act=='input'){

		$pass=md5($_POST[password]);

		mysql_query("INSERT INTO users(username,

                                 password,

                                 nama_lengkap,

                                 email, 

                                 no_telp,

                                 id_session) 

	                       VALUES('$_POST[username]',

                                '$pass',

                                '$_POST[nama_lengkap]',

                                '$_POST[email]',

                                '$_POST[no_telp]',

                                '$pass')");

								

		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}



	// Update user

	elseif ($module=='users' AND $act=='update'){

		if (empty($_POST[password])) {

    		mysql_query("UPDATE users SET nama_lengkap   = '$_POST[nama_lengkap]',

                                  email          = '$_POST[email]',

                                  blokir         = '$_POST[blokir]',  

                                  no_telp        = '$_POST[no_telp]'  

                           WHERE  id_session     = '$_POST[id]'");

		}

		// Apabila password diubah

		else{

			$pass=md5($_POST[password]);

			mysql_query("UPDATE users SET password        = '$pass',

                                 nama_lengkap    = '$_POST[nama_lengkap]',

                                 email           = '$_POST[email]',  

                                 blokir          = '$_POST[blokir]',  

                                 no_telp         = '$_POST[no_telp]'  

                           WHERE id_session      = '$_POST[id]'");

		}

		

		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}

}

?>