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

	include "../../config/fungsi_thumb.php";



	$module=$_GET[module];

	$act=$_GET[act];



	// Update identitas

	if ($module=='identitas' AND $act=='update'){

		$lokasi_file = $_FILES['fupload']['tmp_name'];

		$nama_file   = $_FILES['fupload']['name'];



		// Apabila ada gambar yang diupload

		if (!empty($lokasi_file)){

			UploadFavicon($nama_file);

			mysql_query("UPDATE identitas 

								SET nama_website   = '$_POST[nama_website]',

                                      alamat_website = '$_POST[alamat_website]',

                                      meta_deskripsi = '$_POST[meta_deskripsi]',

                                      meta_keyword   = '$_POST[meta_keyword]',

                                      facebook		 = '$_POST[facebook]',

                                      twitter		 = '$_POST[twitter]',

                                      flickr		 = '$_POST[flickr]',

                                      skype			 = '$_POST[skype]',

                                      content		 = '$_POST[content]',

                                      contact_page	 = '$_POST[contact_page]',

                                      favicon        = '$nama_file' 

                                WHERE id_identitas   = '$_POST[id]'");

		}else{

			mysql_query("UPDATE identitas 

								SET nama_website   = '$_POST[nama_website]',

                                      alamat_website = '$_POST[alamat_website]',

                                      meta_deskripsi = '$_POST[meta_deskripsi]',

                                      meta_keyword   = '$_POST[meta_keyword]',									  

                                      facebook		 = '$_POST[facebook]',

                                      twitter		 = '$_POST[twitter]',

                                      flickr		 = '$_POST[flickr]',

                                      skype			 = '$_POST[skype]',

                                      contact_page	 = '$_POST[contact_page]',

                                      content		 = '$_POST[content]'

                                WHERE id_identitas   = '$_POST[id]'");

		}



		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}

}

?>