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

	include('../../config/fungsi_thumb.php');

	include('../../config/library.inc.php');



	$module=$_GET['module'];

	$act=$_GET['act'];



	// Hapus homebanner

	if ($module=='homebanner' AND $act=='hapus'){

		$data=mysql_fetch_array(mysql_query("SELECT gbr_homebanner FROM homebanner WHERE id_homebanner='$_GET[id]'"));

		if ($data['gbr_homebanner']!=''){

			mysql_query("DELETE FROM homebanner WHERE id_homebanner='$_GET[id]'");

			unlink("../../images/gallery/$_GET[namafile]");   

			unlink("../../images/gallery/small_$_GET[namafile]");

		}

		else{

			mysql_query("DELETE FROM homebanner WHERE id_homebanner='$_GET[id]'");  

		}   



		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}



	// Input homebanner

	elseif ($module=='homebanner' AND $act=='input'){

		$lokasi_file    = $_FILES['fupload']['tmp_name'];

		$tipe_file      = $_FILES['fupload']['type'];

		$nama_file      = $_FILES['fupload']['name'];

		// $acak           = rand(000000,999999);

		// $nama_file_unik = $acak.$nama_file; 

		$nama_file_unik = date('YmdHis').'.jpg';

  

		$homebanner_seo      = seo_title($_POST['jdl_homebanner']);



		// Apabila ada gambar yang diupload

		if (!empty($lokasi_file)){

			if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){

				echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');

				window.location=('../module.php?module=homebanner')</script>";

			}

			else{

				UploadGallery($nama_file_unik);

				mysql_query("INSERT INTO homebanner(jdl_homebanner,link_homebanner,

                                    keterangan, gbr_homebanner) 

                            VALUES('$_POST[jdl_homebanner]','$_POST[link_homebanner]',

                                   '$_POST[keterangan]','$nama_file_unik')");



				// header('location:../module.php?module='.$module);

				echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

			}

		}

		else{

			mysql_query("INSERT INTO homebanner(jdl_homebanner,link_homebanner, keterangan) 

                            VALUES('$_POST[jdl_homebanner]','$_POST[link_homebanner]','$_POST[keterangan]')");



			// header('location:../module.php?module='.$module);

			echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

		}

	}



	// Update homebanner

	elseif ($module=='homebanner' AND $act=='update'){

		$lokasi_file    = $_FILES['fupload']['tmp_name'];

		$tipe_file      = $_FILES['fupload']['type'];

		$nama_file      = $_FILES['fupload']['name'];

		// $acak           = rand(000000,999999);

		// $nama_file_unik = $acak.$nama_file; 

		$nama_file_unik = date('YmdHis').'.jpg';



		$homebanner_seo      = seo_title($_POST['jdl_homebanner']);



		// Apabila gambar tidak diganti

		if (empty($lokasi_file)){

			mysql_query("UPDATE homebanner SET jdl_homebanner  = '$_POST[jdl_homebanner]', link_homebanner  = '$_POST[link_homebanner]',keterangan  = '$_POST[keterangan]'  

                             WHERE id_homebanner   = '$_POST[id]'");



			// header('location:../module.php?module='.$module);

			echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

		}

		else{

			if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){

				echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');

			        window.location=('../module.php?module=homebanner')</script>";

			}

			else{

				UploadGallery($nama_file_unik);

				mysql_query("UPDATE homebanner SET jdl_homebanner  = '$_POST[jdl_homebanner]', link_homebanner  = '$_POST[link_homebanner]',

                                   keterangan  = '$_POST[keterangan]',  

                                   gbr_homebanner      = '$nama_file_unik'   

                             WHERE id_homebanner   = '$_POST[id]'");



				// header('location:../module.php?module='.$module);

				echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

			}

		}

	}

}

?>