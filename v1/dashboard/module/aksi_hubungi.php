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



	// Hapus hubungi

	if ($module=='hubungi' AND $act=='hapus'){

		mysql_query("DELETE FROM hubungi WHERE id_hubungi='$_GET[id]'");

		header('location:../module.php?module='.$module);

	}

}

?>

