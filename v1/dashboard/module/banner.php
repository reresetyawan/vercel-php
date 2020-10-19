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



$aksi="module/aksi_banner.php";

switch($_GET[act]){

	// Tampil Banner

	default:

    	echo "<h2>Banner</h2>

          <input type=button value='Tambah Banner' onclick=location.href='?module=banner&act=tambahbanner'>

		  <table class='list'><thead>

          <th>no</th>

          <th>gambar</th>

          <th>judul</th>

          <th>URL</th>

          <th>tgl. posting</th>

          <th>aksi</th>

		  </thead><tbody>";

    $tampil=mysql_query("SELECT * FROM banner ORDER BY id_banner DESC");

    $no=1;

    while ($r=mysql_fetch_array($tampil)){

      $tgl=tgl_indo($r[tgl_posting]);

      echo "<tr><td align=right width='25'>$no &nbsp;</td>

                <td><img src='../images/banner/$r[gambar]'></td>

                <td>$r[judul]</td>

                <td><a href=$r[url] target=_blank>$r[url]</a></td>

                <td class='center'>$tgl</td>

                <td class='center' width='85'><a href=?module=banner&act=editbanner&id=$r[id_banner]><img src='images/edit.png' border='0' title='edit' /></a>

	                  <a href=$aksi?module=banner&act=hapus&id=$r[id_banner]><img src='images/del.png' border='0' title='hapus' /></a>

		        </tr>";

    $no++;

    }

    echo "</tbody></table>";

    break;

  

  case "tambahbanner":

    echo "<h2>Tambah Banner</h2>

          <form method=POST action='$aksi?module=banner&act=input' enctype='multipart/form-data'>

          <table class='list'><tbody>

          <tr><td>Judul</td><td>  : <input type=text name='judul' size=30></td></tr>

          <tr><td>Url</td><td>   : <input type=text name='url' size=50 value='http://'></td></tr>

          <tr><td>Gambar</td><td> : <input type=file name='fupload' size=40></td></tr>

          <tr><td colspan='2'><input type=submit value=Simpan>

                            <input type=button value=Batal onclick=self.history.back()></td></tr>

          </tbody></table></form><br><br><br>";

     break;

    

  case "editbanner":

    $edit = mysql_query("SELECT * FROM banner WHERE id_banner='$_GET[id]'");

    $r    = mysql_fetch_array($edit);



    echo "<h2>Edit Banner</h2>

          <form method=POST enctype='multipart/form-data' action=$aksi?module=banner&act=update>

          <input type=hidden name=id value=$r[id_banner]>

          <table class='list'><tbody>

          <tr><td>Judul</td><td>     : <input type=text name='judul' size=30 value='$r[judul]'></td></tr>

          <tr><td>Url</td><td>      : <input type=text name='url' size=50 value='$r[url]'></td></tr>

          <tr><td>Gambar</td><td>    : <img src='../images/banner/$r[gambar]'></td></tr>

          <tr><td>Ganti Gbr</td><td> : <input type=file name='fupload' size=30> *)</td></tr>

          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>

          <tr><td colspan=2><input type=submit value=Update>

                            <input type=button value=Batal onclick=self.history.back()></td></tr>

          </tbody></table></form>";

    break;  

}

}

?>

