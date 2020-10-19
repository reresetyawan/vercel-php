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



	$aksi="module/aksi_tag.php";

	switch($_GET[act]){

  // Tampil Tag

  default:

    echo "<h2>Kategori</h2>

          <input type=button value='Tambah Tag' onclick=\"window.location.href='?module=tag&act=tambahtag';\">

          <table class='list'><thead>

          <tr><th>no</th><th>nama tag</th><th class='center'>aksi</th></tr></thead>"; 

    $tampil=mysql_query("SELECT * FROM tag ORDER BY id_tag DESC");

    $no=1;

    while ($r=mysql_fetch_array($tampil)){

       echo "<tbody><tr><td align=right width='40'>$no &nbsp;</td>

             <td>$r[nama_tag]</td>

             <td class='center' width='85'><a href=?module=tag&act=edittag&id=$r[id_tag]><img src='images/edit.png' border='0' title='edit' /></a>

	               <a href=$aksi?module=tag&act=hapus&id=$r[id_tag]><img src='images/del.png' border='0' title='hapus' /></a>

             </td></tr>";

      $no++;

    }

    echo "</tbody></table>";

    break;

  

  // Form Tambah Tag

  case "tambahtag":

    echo "<h2>Tambah Tag</h2>

          <form method=POST action='$aksi?module=tag&act=input'>

          <table class='list'><tbody>

          <tr><td>Nama Tag</td><td> : <input type=text name='nama_tag'></td></tr>

          <tr><td colspan=2><input type=submit name=submit value=Simpan>

                            <input type=button value=Batal onclick=self.history.back()></td></tr>

          </tbody></table></form>";

     break;

  

  // Form Edit Kategori  

  case "edittag":

    $edit=mysql_query("SELECT * FROM tag WHERE id_tag='$_GET[id]'");

    $r=mysql_fetch_array($edit);



    echo "<h2>Edit Tag</h2>

          <form method=POST action=$aksi?module=tag&act=update>

          <input type=hidden name=id value='$r[id_tag]'>

          <table>

          <tr><td>Nama Tag</td><td> : <input type=text name='nama_tag' value='$r[nama_tag]'></td></tr>

          <tr><td colspan=2><input type=submit value=Update>

                            <input type=button value=Batal onclick=self.history.back()></td></tr>

          </table></form>";

    break;  

}

}

?>

