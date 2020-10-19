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



	// Hapus gallery

	if ($module=='album' AND $act=='hapus'){

		$data=mysql_fetch_array(mysql_query("SELECT gbr_album FROM album WHERE id_album='$_GET[id]'"));

		if ($data['gbr_album']!=''){

			mysql_query("DELETE FROM album WHERE id_album='$_GET[id]'");

			unlink("../../images/album/$_GET[namafile]");   

			unlink("../../images/album/small_$_GET[namafile]");

		}

		else{

			mysql_query("DELETE FROM album WHERE id_album='$_GET[id]'");  

		}   



		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}



	// Input album

	//else

	if ($module=='album' AND $act=='input'){

		$lokasi_file = $_FILES['fupload']['tmp_name'];

		$nama_file   = $_FILES['fupload']['name'];

		$tipe_file   = $_FILES['fupload']['type'];

		// $acak           = rand(000000,999999);

		// $nama_file_unik = $acak.$nama_file; 

		$nama_file_unik = 'album_'.date('YmdHis').'.jpg';

		$jdl_album = addslashes($_POST[jdl_album]);

		$album_seo = seo_title($_POST['jdl_album']);



		// Apabila ada gambar yang diupload

		if (!empty($lokasi_file)){

			if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){

				echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');

					window.location=('../module.php?module=album')</script>";

			}

			else{

				

				UploadAlbum($nama_file_unik);

				$str = "INSERT INTO album(jdl_album, album_seo, gbr_album) 

                            VALUES('$jdl_album', '$album_seo', '$nama_file_unik')";

				mysql_query($str);

				header('location:../module.php?module='.$module);

			}

		}

		else{

			mysql_query("INSERT INTO album(jdl_album,

                                    album_seo) 

                            VALUES('$jdl_album',

                                   '$album_seo')");

			header('location:../module.php?module='.$module);

		}

	}



	// Update album

	elseif ($module=='album' AND $act=='update'){

		$lokasi_file = $_FILES['fupload']['tmp_name'];

		$nama_file   = $_FILES['fupload']['name'];

		$tipe_file   = $_FILES['fupload']['type'];

		// $acak           = rand(000000,999999);

		// $nama_file_unik = $acak.$nama_file; 

		$nama_file_unik = 'album_'.date('YmdHis').'.jpg';

		$jdl_album = addslashes($_POST[jdl_album]);

		$album_seo = seo_title($_POST['jdl_album']);



		// Apabila gambar tidak diganti

		if (empty($lokasi_file)){

			mysql_query("UPDATE album SET jdl_album     = '$jdl_album',								  

                                  album_seo     = '$album_seo', 

                                  aktif='$_POST[aktif]' 

                             WHERE id_album = '$_POST[id]'");

			header('location:../module.php?module='.$module);

		}

		else{

			if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){

				echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');

					window.location=('../module.php?module=album')</script>";

			}

			else{

				UploadAlbum($nama_file_unik);

				mysql_query("UPDATE album SET jdl_album  = '$jdl_album',								  

                                   album_seo = '$album_seo',

                                   gbr_album    = '$nama_file_unik', 

                                   aktif='$_POST[aktif]'    

                             WHERE id_album = '$_POST[id]'");

				header('location:../module.php?module='.$module);

			}

		}

	}

}

?>