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



	// Hapus berita

	if ($module=='berita' AND $act=='hapus'){

		$data=mysql_fetch_array(mysql_query("SELECT gambar FROM berita WHERE id_berita='$_GET[id]'"));

		if ($data['gambar']!=''){

			mysql_query("DELETE FROM berita WHERE id_berita='$_GET[id]'");

			unlink("../../../foto_berita/$_GET[namafile]");   

			unlink("../../../foto_berita/small_$_GET[namafile]");   

		}

		else{

			mysql_query("DELETE FROM berita WHERE id_berita='$_GET[id]'");

		}



		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

	}



	// Input berita

	elseif ($module=='berita' AND $act=='input'){

		$lokasi_file    = $_FILES['fupload']['tmp_name'];

		$tipe_file      = $_FILES['fupload']['type'];

		$nama_file      = $_FILES['fupload']['name'];

		$acak           = rand(1,99);

		$nama_file_unik = $acak.$nama_file; 

  

		if (!empty($_POST['tag_seo'])){

			$tag_seo = $_POST['tag_seo'];

			$tag=implode(',',$tag_seo);

		}            

		$judul_seo      = seo_title($_POST['judul']);



		// Apabila ada gambar yang diupload

		if (!empty($lokasi_file)){

			if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){

				echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');

					window.location=('../module.php?module=berita)</script>";

			}

			else{

				UploadImage($nama_file_unik);

				$str_insert = "INSERT INTO berita(judul,

                                    judul_seo,

                                    id_kategori,

                                    headline,

                                    username,

                                    isi_berita,

                                    jam,

                                    tanggal,

                                    hari,

                                    tag, 

                                    gambar) 

                            VALUES('".addslashes($_POST[judul])."',

                                   '$judul_seo',

                                   '$_POST[kategori]',

                                   '$_POST[headline]', 

                                   '$_SESSION[namauser]',

                                   '".addslashes($_POST[isi_berita])."',

                                   '$jam_sekarang',

                                   '$tgl_sekarang',

                                   '$hari_ini',

                                   '$tag',

                                   '$nama_file_unik')";

				mysql_query($str_insert)or die("ERROR ::<br>".$str_insert);

				// header('location:../module.php?module='.$module);

				echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

			}

		}

		else{

			$str_insert = "INSERT INTO berita(judul,

                                    judul_seo, 

                                    id_kategori,

                                    headline,

                                    username,

                                    isi_berita,

                                    jam,

                                    tanggal,

                                    tag, 

                                    hari) 

                            VALUES('".addslashes($_POST[judul])."',

                                   '$judul_seo',

                                   '$_POST[kategori]',

                                   '$_POST[headline]', 

                                   '$_SESSION[namauser]',

                                   '".addslashes($_POST[isi_berita])."',

                                   '$jam_sekarang',

                                   '$tgl_sekarang',

                                   '$tag',

                                   '$hari_ini')";

			mysql_query($str_insert)or die("ERROR ::<br>".$str_insert);



			// header('location:../module.php?module='.$module);

			echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

		}

  

		$jml=count($tag_seo);

		for($i=0;$i<$jml;$i++){

			mysql_query("UPDATE tag SET count=count+1 WHERE tag_seo='$tag_seo[$i]'");

		}

	}



	// Update berita

	elseif ($module=='berita' AND $act=='update'){

		$lokasi_file    = $_FILES['fupload']['tmp_name'];

		$tipe_file      = $_FILES['fupload']['type'];

		$nama_file      = $_FILES['fupload']['name'];

		$acak           = rand(1,99);

		$nama_file_unik = $acak.$nama_file; 



		if (!empty($_POST['tag_seo'])){

			$tag_seo = $_POST['tag_seo'];

			$tag=implode(',',$tag_seo);

		}



		$judul_seo = seo_title($_POST['judul']);



		// Apabila gambar tidak diganti

		if (empty($lokasi_file)){

			mysql_query("UPDATE berita SET judul       = '$_POST[judul]',

                                   judul_seo   = '$judul_seo', 

                                   id_kategori = '$_POST[kategori]',

                                   headline    = '$_POST[headline]',

                                   tag         = '$tag',

                                   isi_berita  = '$_POST[isi_berita]'  

                             WHERE id_berita   = '$_POST[id]'");



			// header('location:../module.php?module='.$module);

			echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

		}

		else{

			if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){

				echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');

					window.location=('../module.php?module=berita')</script>";

			}

			else{

				UploadImage($nama_file_unik);

				mysql_query("UPDATE berita SET judul       = '$_POST[judul]',

                                   judul_seo   = '$judul_seo', 

                                   id_kategori = '$_POST[kategori]',

                                   headline    = '$_POST[headline]',

                                   tag         = '$tag',

                                   isi_berita  = '$_POST[isi_berita]',

                                   gambar      = '$nama_file_unik'   

                             WHERE id_berita   = '$_POST[id]'");



				// header('location:../module.php?module='.$module);

				echo '<script language="javascript">window.location="../module.php?module='.$module.'";</script>';

			}

		}

	}

}

?>