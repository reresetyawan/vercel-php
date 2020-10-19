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



	$aksi="module/aksi_kategori.php";

	switch($_GET[act]){

  // Tampil Kategori

  default:

    echo "<h2>Kategori</h2>

          <input type=button value='Tambah Kategori' onclick=\"window.location.href='?module=kategori&act=tambahkategori';\">

          <table class='list'><thead>

          <tr><th>no</th>

          <th>nama kategori</th>

          <th>status</th>

          <th>aksi</th></tr></thead>"; 

    $tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori DESC");

    $no=1;

    while ($r=mysql_fetch_array($tampil)){

       echo "<tbody><tr><td align=right width='40'>$no &nbsp;</td>

             <td>$r[nama_kategori]</td>

             <td>$r[aktif]</td>

             <td class='center' width='85'><a href=?module=kategori&act=editkategori&id=$r[id_kategori]><img src='images/edit.png' border='0' title='edit' /></a>

				 <a href=$aksi?module=kategori&act=hapus&id=$r[id_kategori]><img src='images/del.png' border='0' title='hapus' /></a>

             </td></tr>";

      $no++;

    }

    echo "<tbody></table>";

    echo "<div id=paging>*) Data pada Kategori tidak bisa dihapus, tapi bisa di non-aktifkan melalui Edit Kategori.</div><br>";

    break;

  

  // Form Tambah Kategori

  case "tambahkategori":

    echo "<h2>Tambah Kategori</h2>

          <form method=POST action='$aksi?module=kategori&act=input'>

          <table class='list'>

          <tr><td>Nama Kategori</td><td> : <input type=text name='nama_kategori'></td></tr>

          <tr><td colspan=2><input type=submit name=submit value=Simpan>

                            <input type=button value=Batal onclick=self.history.back()></td></tr>

          </table></form>";

     break;

  

  // Form Edit Kategori  

  case "editkategori":

    $edit=mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");

    $r=mysql_fetch_array($edit);



    echo "<h2>Edit Kategori</h2>

          <form method=POST action=$aksi?module=kategori&act=update>

          <input type=hidden name=id value='$r[id_kategori]'>

          <table class='list'>

          <tr><td>Nama Kategori</td><td> : <input type=text name='nama_kategori' value='$r[nama_kategori]'></td></tr>";

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

          </table></form>";

    break;  

}

}

?>