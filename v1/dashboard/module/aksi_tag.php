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

	include('../../config/library.inc.php');





	$module=$_GET['module'];

	$act=$_GET['act'];



	// Hapus Tag

	if ($module=='tag' AND $act=='hapus'){

		mysql_query("DELETE FROM tag WHERE id_tag='$_GET[id]'");

		

		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}



	// Input tag

	elseif ($module=='tag' AND $act=='input'){

		$tag_seo = seo_title($_POST['nama_tag']);

		mysql_query("INSERT INTO tag(nama_tag,tag_seo) VALUES('$_POST[nama_tag]','$tag_seo')");

 

		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}



	// Update tag

	elseif ($module=='tag' AND $act=='update'){

		$tag_seo = seo_title($_POST['nama_tag']);

		mysql_query("UPDATE tag SET nama_tag = '$_POST[nama_tag]', tag_seo='$tag_seo' WHERE id_tag = '$_POST[id]'");



		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}

}

?>