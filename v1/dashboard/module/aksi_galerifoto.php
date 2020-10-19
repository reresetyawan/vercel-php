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



	// Hapus gallery

	if ($module=='galerifoto' AND $act=='hapus'){

		$data=mysql_fetch_array(mysql_query("SELECT gbr_gallery FROM gallery WHERE id_gallery='$_GET[id]'"));

		if ($data['gbr_gallery']!=''){

			mysql_query("DELETE FROM gallery WHERE id_gallery='$_GET[id]'");

			unlink("../../images/gallery/$_GET[namafile]");   

			unlink("../../images/gallery/small_$_GET[namafile]");

		}

		else{

			mysql_query("DELETE FROM gallery WHERE id_gallery='$_GET[id]'");  

		}   



		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}



	// Input gallery

	elseif ($module=='galerifoto' AND $act=='input'){

		$lokasi_file    = $_FILES['fupload']['tmp_name'];

		$tipe_file      = $_FILES['fupload']['type'];

		$nama_file      = $_FILES['fupload']['name'];

		// $acak           = rand(000000,999999);

		// $nama_file_unik = $acak.$nama_file; 

		$nama_file_unik = date('YmdHis').'.jpg';

  

		$gallery_seo      = seo_title($_POST['jdl_gallery']);



		// Apabila ada gambar yang diupload

		if (!empty($lokasi_file)){

			if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){

				echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');

				window.location=('../module.php?module=galerifoto')</script>";

			}

			else{

				UploadGallery($nama_file_unik);

				mysql_query("INSERT INTO gallery(jdl_gallery,

                                    gallery_seo,

                                    id_album,

                                    keterangan,

                                    gbr_gallery) 

                            VALUES('$_POST[jdl_gallery]',

                                   '$gallery_seo',

                                   '$_POST[album]',

                                   '$_POST[keterangan]',

                                   '$nama_file_unik')");



				// header('location:../module.php?module='.$module);

				echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

			}

		}

		else{

			mysql_query("INSERT INTO gallery(jdl_gallery,

                                    gallery_seo,

                                    id_album,

                                    keterangan) 

                            VALUES('$_POST[jdl_gallery]',

                                   '$gallery_seo',

                                   '$_POST[album]',

                                   '$_POST[keterangan]')");



			// header('location:../module.php?module='.$module);

			echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

		}

	}



	// Update gallery

	elseif ($module=='galerifoto' AND $act=='update'){

		$lokasi_file    = $_FILES['fupload']['tmp_name'];

		$tipe_file      = $_FILES['fupload']['type'];

		$nama_file      = $_FILES['fupload']['name'];

		// $acak           = rand(000000,999999);

		// $nama_file_unik = $acak.$nama_file; 

		$nama_file_unik = date('YmdHis').'.jpg';



		$gallery_seo      = seo_title($_POST['jdl_gallery']);



		// Apabila gambar tidak diganti

		if (empty($lokasi_file)){

			mysql_query("UPDATE gallery SET jdl_gallery  = '$_POST[jdl_gallery]',

                                   gallery_seo   = '$gallery_seo', 

                                   id_album = '$_POST[album]',

                                   keterangan  = '$_POST[keterangan]'  

                             WHERE id_gallery   = '$_POST[id]'");



			// header('location:../module.php?module='.$module);

			echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

		}

		else{

			if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){

				echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');

			        window.location=('../module.php?module=galerifoto')</script>";

			}

			else{

				UploadGallery($nama_file_unik);

				mysql_query("UPDATE gallery SET jdl_gallery  = '$_POST[jdl_gallery]',

                                   gallery_seo   = '$gallery_seo', 

                                   id_album = '$_POST[album]',

                                   keterangan  = '$_POST[keterangan]',  

                                   gbr_gallery      = '$nama_file_unik'   

                             WHERE id_gallery   = '$_POST[id]'");



				// header('location:../module.php?module='.$module);

				echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

			}

		}

	}

}

?>