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



	$aksi="module/aksi_homebanner.php";

	switch($_GET[act]){

  // Tampil Banner Berenda

  default:

    echo "<h2>Banner Berenda</h2>

          <input type=button value='Tambah Banner Berenda' onclick=\"window.location.href='?module=homebanner&act=tambahhomebanner';\">

          <table class='list'><thead>

          <th style='border:1px solid #4b5b6b;'>no</th>

          <th style='border:1px solid #4b5b6b;'>gambar foto</th>

          <th style='border:1px solid #4b5b6b;' colspan=2>Keterangan</th>

		  </thead><tbody>";



    $p      = new Paging;

    $batas  = 10;

    $posisi = $p->cariPosisi($batas);



    $tampil = mysql_query("SELECT * FROM homebanner ORDER BY id_homebanner DESC LIMIT $posisi,$batas");

  

    $no = $posisi+1;

    while($r=mysql_fetch_array($tampil)){

      echo "

<tr>

	<td style='border-top:2px solid #777' rowspan=3 width='40' align=right>$no &nbsp;</td>

	<td style='border-top:2px solid #777'  rowspan=3 width='120'><img alt='$r[gbr_homebanner]' src='../images/gallery/small_$r[gbr_homebanner]'></td>

	<td style='border-top:2px solid #777'  width='50'>Judul :</td>

	<td style='border-top:2px solid #777' >$r[jdl_homebanner]</td>

</tr>

<tr>

	<td width='50'>Link :</td>

	<td>http://$r[link_homebanner]</td>

</tr>

<tr>

	<td>Aksi :</td>

	<td><a href=?module=homebanner&act=edithomebanner&id=$r[id_homebanner]><img src='images/edit.png' border='0' title='edit' /></a> &nbsp;

<a href='$aksi?module=homebanner&act=hapus&id=$r[id_homebanner]&namafile=$r[gbr_homebanner]'><img src='images/del.png' border='0' title='hapus' /></a></td>

</tr>

";

      $no++;

    }

    echo "</tbody></table>";



    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM homebanner"));

  

    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);

    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);



    echo "<div class=pagination>$linkHalaman</div><br>";

 

    break;

  

  case "tambahhomebanner":

    echo "<h2>Tambah Banner Berenda</h2>

          <form method=POST action='$aksi?module=homebanner&act=input' enctype='multipart/form-data'>

          <table class='list'><tbody>

          <tr><td>Judul Foto</td>     <td> : <input type=text name='jdl_homebanner' size=60></td></tr>

          <tr><td>Link Foto</td>     <td> : http://<input type=text name='link_homebanner' size=60></td></tr>

          <tr><td>Keterangan</td>  <td> <textarea id='loko' name='keterangan' style='width: 600px; height: 150px;'></textarea></td></tr>

          <tr><td>Gambar</td>      <td> : <input type=file name='fupload' size=40> 

                                          <br>Tipe gambar harus JPG/JPEG</td></tr>

          </td></tr>

          <tr><td colspan=2><input type=submit value=Simpan>

                            <input type=button value=Batal onclick=self.history.back()></td></tr>

          </tbody></table></form>";

     break;

    

  case "edithomebanner":

    $edit = mysql_query("SELECT * FROM homebanner WHERE id_homebanner='$_GET[id]'");

    $r    = mysql_fetch_array($edit);



    echo "<h2>Edit Banner Berenda</h2>

          <form method=POST enctype='multipart/form-data' action=$aksi?module=homebanner&act=update>

          <input type=hidden name=id value=$r[id_homebanner]>

          <table class='list'>

          <tr><td width='70'>Judul Foto</td>     <td> : <input type=text name=\"jdl_homebanner\" size=60 value=\"$r[jdl_homebanner]\"></td></tr>

          <tr><td width='70'>Link Foto</td>     <td> : http://<input type=text name=\"link_homebanner\" size=60 value=\"$r[link_homebanner]\"></td></tr>

          

          <tr><td>Keterangan</td>   <td> <textarea id='loko' name='keterangan' style='width: 600px; height: 150px;'>$r[keterangan]</textarea></td></tr>

          <tr><td>Gambar</td>       <td> :  ";

          if ($r[gbr_homebanner]!=''){

              echo "<img alt='$r[gbr_homebanner]' src='../images/gallery/small_$r[gbr_homebanner]'>";  

          }

    echo "</td></tr>

          <tr><td>Ganti Gbr</td>    <td> : <input type=file name='fupload' size=30> *)</td></tr>

          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>

          <tr><td colspan=2><input type=submit value=Update>

                            <input type=button value=Batal onclick=self.history.back()></td></tr>

         </table></form>";

    break;  

}

}

?>