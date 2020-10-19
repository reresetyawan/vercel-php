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

		

	// Hapus berita

	if ($module=='menuutama' AND $act=='hapus'){

		mysql_query("DELETE FROM menu WHERE id ='$_GET[id]'");



		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}

	

	// Input menu

	elseif ($module=='menuutama' AND $act=='input'){

		mysql_query("INSERT INTO menu(title, parent_id, url, active, menu_order) 

			VALUES('$_POST[nama_menu]', '$_POST[parent_id]', '$_POST[link]', '$_POST[aktif]', '$_POST[menu_order]')");

		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}



	// Update menu utama

	elseif ($module=='menuutama' AND $act=='update'){

		$str_update = "UPDATE menu SET title='".$_POST['nama_menu']."', url='".$_POST['link']."', active='".$_POST['aktif']."', 

			parent_id='".$_POST['parent_id']."', menu_order='".$_POST['menu_order']."' WHERE id = '".$_POST['id']."'";

		mysql_query($str_update);



		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}

}

?>