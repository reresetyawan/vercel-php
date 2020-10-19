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

	include('../../config/fungsi_thumb.php');



	$module=$_GET['module'];

	$act=$_GET['act'];



	// Hapus banner

	if ($module=='banner' AND $act=='hapus'){

		$data=mysql_fetch_array(mysql_query("SELECT gambar FROM banner WHERE id_banner='$_GET[id]'"));

		if ($data['gambar']!=''){

			mysql_query("DELETE FROM banner WHERE id_banner='$_GET[id]'");



			unlink("../../images/banner/$data[gambar]");   

		}

		else{

			mysql_query("DELETE FROM banner WHERE id_banner='$_GET[id]'");

		}

		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}



	// Input banner

	elseif ($module=='banner' AND $act=='input'){

		$lokasi_file = $_FILES['fupload']['tmp_name'];

		$tipe_file   = $_FILES['fupload']['type'];

		$nama_file   = $_FILES['fupload']['name'];

		$nama_file = date('YmdHis').'_'.$nama_file;



		// Apabila ada gambar yang diupload

		if (!empty($lokasi_file)){

    		if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){ 

					echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');

						window.location=('../module.php?module=banner')</script>";

			}

			else{

				UploadBanner($nama_file);

				mysql_query("INSERT INTO banner(judul, url, tgl_posting, gambar) 

                            VALUES('$_POST[judul]', '$_POST[url]', '$tgl_sekarang', '$nama_file')");

		

				// header('location:../module.php?module='.$module);

				echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

			}

		}

		else{

			mysql_query("INSERT INTO banner(judul,

                                    tgl_posting,

                                    url) 

                            VALUES('$_POST[judul]',

                                   '$tgl_sekarang',

                                   '$_POST[url]')");

		

			// header('location:../module.php?module='.$module);

			echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

		}

	}



	// Update banner

	elseif ($module=='banner' AND $act=='update'){

		$lokasi_file = $_FILES['fupload']['tmp_name'];

		$tipe_file   = $_FILES['fupload']['type'];

		$nama_file   = $_FILES['fupload']['name'];

		$nama_file = date('YmdHis').'_'.$nama_file;



		// Apabila gambar tidak diganti

		if (empty($lokasi_file)){

    		mysql_query("UPDATE banner SET judul     = '$_POST[judul]',

                                   url       = '$_POST[url]'

                             WHERE id_banner = '$_POST[id]'");



			// header('location:../module.php?module='.$module);

			echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

		}

		else{

    		if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){

				echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');

						  window.location=('../module.php?module=banner')</script>";

			}

			else{

				UploadBanner($nama_file);

				mysql_query("UPDATE banner SET judul     = '$_POST[judul]',

                                   url       = '$_POST[url]',

                                   gambar    = '$nama_file'   

                             WHERE id_banner = '$_POST[id]'");

							 

				// header('location:../module.php?module='.$module);

				echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

			}

		}

	}



}

?>

