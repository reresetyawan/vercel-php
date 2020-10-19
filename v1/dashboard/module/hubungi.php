<?php 
session_start();
// Report simple running errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors',0);

include('../config/sysconfig.inc.php');



if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){

	echo "<link href='style.css' rel='stylesheet' type='text/css'><center>Untuk mengakses modul, Anda harus login <br>";

	echo "<a href=../../index.php><b>LOGIN</b></a></center>";

}else{



$aksi="module/aksi_hubungi.php";	

switch($_GET[act]){

	// Tampil Hubungi Kami

	default: echo "

			<h2>Hubungi Kami</h2>

			<div id=paging>

			*) Untuk menjawab/membalas email, klik langsung pada alamat emailnya yang ada di kolom EMAIL.

			</div>

			<table class='list'><thead>

			<tr><th>no</th>

			<th>nama</th>

			<th>email</th>

			<th>subjek</th>

			<th>tanggal</th>

			<th>aksi</th></tr></thead><tbody>";



		$p      = new Paging;

		$batas  = 10;

		$posisi = $p->cariPosisi($batas);



		$tampil=mysql_query("SELECT * FROM hubungi ORDER BY id_hubungi DESC LIMIT $posisi, $batas");



		$no = $posisi+1;

		while ($r=mysql_fetch_array($tampil)){

			$tgl=tgl_indo($r[tanggal]);

			echo "<tr><td align=right width='40'>$no &nbsp;</td>

                <td>$r[nama]</td>

                <td><a href=?module=hubungi&act=balasemail&id=$r[id_hubungi]>$r[email]</a></td>

                <td>$r[subjek]</td>

                <td>$tgl</a></td>

                <td width='50'><a href=$aksi?module=hubungi&act=hapus&id=$r[id_hubungi]><img src='images/del.png' border='0' title='hapus' /></a>

                </td></tr>";

			$no++;

		}

		echo "</tbody></table>";

		$jmldata=mysql_num_rows(mysql_query("SELECT * FROM hubungi"));

		$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);

		$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);



		echo "<div class=pagination>Hal: $linkHalaman</div><br>";

		break;



	case "balasemail":

		$tampil = mysql_query("SELECT * FROM hubungi WHERE id_hubungi='$_GET[id]'");

		$r = mysql_fetch_array($tampil);



		echo "<h2>Reply Email</h2>

          <form method=POST action='?module=hubungi&act=kirimemail'>

          <table class='list'><tbody>

          <tr><td class='left'>Kepada</td><td class='left'> : <input type=text name='email' size=30 value='$r[email]'></td></tr>

          <tr><td class='left'>Subjek</td><td class='left'> : <input type=text name='subjek' size=50 value='Re: $r[subjek]'></td></tr>

          <tr><td class='left'>Pesan</td><td class='left'> <textarea name='pesan' id='loko' style='width: 600px; height: 180px;'><br><br><br><br>     

  ---------------------------------------------------------------------------------------------------------------------

  $r[pesan]</textarea></td></tr>

          <tr><td class='left' colspan=2><input type=submit value=Kirim>

                            <input type=button value=Batal onclick=self.history.back()></td></tr>

          </tbody></table></form>";

		break;

    

	case "kirimemail":

		mail($_POST[email],$_POST[subjek],$_POST[pesan],"From: carakamulia@yahoo.co.id");

		echo "<h2>Status Email</h2>

          <p>Email telah sukses terkirim ke tujuan</p>

          <p>[ <a href=javascript:history.go(-2)>Kembali</a> ]</p>";	 		  

	break;  

}// switch



}

?>

