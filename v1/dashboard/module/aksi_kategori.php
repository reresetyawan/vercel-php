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



	$module=$_GET[module];

	$act=$_GET[act];



	// Hapus agenda

	if ($module=='kategori' AND $act=='hapus'){

		mysql_query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");

		//header('location:../../media.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}



	// Input kategori

	if ($module=='kategori' AND $act=='input'){

		$kategori_seo = seo_title($_POST['nama_kategori']);

		mysql_query("INSERT INTO kategori(nama_kategori,kategori_seo) VALUES('$_POST[nama_kategori]','$kategori_seo')");



		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}



	// Update kategori

	elseif ($module=='kategori' AND $act=='update'){

		$kategori_seo = seo_title($_POST['nama_kategori']);

		mysql_query("UPDATE kategori SET nama_kategori='$_POST[nama_kategori]', kategori_seo='$kategori_seo', aktif='$_POST[aktif]' 

			WHERE id_kategori = '$_POST[id]'");



		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}

}

?>

