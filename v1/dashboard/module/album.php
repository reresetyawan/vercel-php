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

	

	$aksi="module/aksi_album.php";

	switch($_GET[act]){

  // Tampil Album

  default:

    echo "<h2>Album Foto</h2>

          <input type=button value='Tambah Album' onclick=\"window.location.href='?module=album&act=tambahalbum';\">

          <table class='list'><thead>

          <tr>

          <th>no</th>

          <th>gambar</th>

          <th width='170'>judul album</th>

          <th class='center'>aksi</th>

          </tr></thead><tbody>"; 

    $tampil=mysql_query("SELECT * FROM album ORDER BY id_album DESC");

    $no=1;

    while ($r=mysql_fetch_array($tampil)){

       echo "<tr><td align=right width='40'>$no &nbsp;</td>

             <td width='120'><img src='../images/album/small_$r[gbr_album]'></td>

             <td>$r[jdl_album]</td>

             <td align=center width='85'>

<a href='?module=album&act=editalbum&id=$r[id_album]'><img src='images/edit.png' border='0' title='edit' /></a> &nbsp; 

<a href='$aksi?module=album&act=hapus&id=$r[id_album]&namafile=$r[gbr_album]'><img src='images/del.png' border='0' title='hapus' /></a></td>

             </td></tr>";

      $no++;

    }

    echo "</tbody></table>";

    echo "<div id=paging>*) Data pada Album tidak bisa dihapus, tapi bisa di non-aktifkan melalui Edit Album.</div><br>";

    break;

  

  // Form Tambah Album

  case "tambahalbum":

    echo "<h2>Tambah Album</h2>

          <form method=POST action='$aksi?module=album&act=input' enctype='multipart/form-data'>

          <table class='list'><tbody>

          <tr><td>Judul Album</td><td> : <input type=text name='jdl_album' size=80></td></tr>

          <tr><td>Gambar</td><td> : <input type=file name='fupload' size=40></td></tr>

          <tr><td colspan=2><input type=submit name=submit value=Simpan>

                            <input type=button value=Batal onclick=self.history.back()></td></tr>

          </tbody></table></form>";

     break;

  

  // Form Edit Album  

  case "editalbum":

    $edit=mysql_query("SELECT * FROM album WHERE id_album='$_GET[id]'");

    $r=mysql_fetch_array($edit);



    echo "<h2>Edit Album</h2>

          <form method=POST enctype='multipart/form-data' action=$aksi?module=album&act=update>

          <input type=hidden name=id value='$r[id_album]'>

          <table class='list'><tbody>

          <tr><td>Judul Album</td><td> : <input type=text name='jdl_album' value='$r[jdl_album]' size=80></td></tr>		  

          <tr><td>Gambar</td><td>    : <img src='../images/album/small_$r[gbr_album]'></td></tr>

          <tr><td>Ganti Gbr</td><td> : <input type=file name='fupload' size=30></td></tr>";

    if ($r[aktif]=='Y'){

      echo "<tr><td>Aktif</td> <td> : <input type=radio name='aktif' value='Y' checked>Y  

                                      <input type=radio name='aktif' value='N'> N</td></tr>";

    }

    else{

      echo "<tr><td>Aktif</td> <td> : <input type=radio name='aktif' value='Y'>Y  

                                      <input type=radio name='aktif' value='N' checked>N</td></tr>";

    }         

    echo "<tr><td colspan=2><input type=submit value=Update>

                            <input type=button value=Batal onclick=self.history.back()></td></tr>

          </tbody></table></form>";

    break;  

}

}

?>

