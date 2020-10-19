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



$aksi="module/aksi_identitas.php";

switch($_GET['act']){
	// Tampil identitas
	default:
		$sql  = mysql_query("SELECT * FROM identitas LIMIT 1");
		$r    = mysql_fetch_array($sql);

?>

<h2>Profil Website</h2>

<form method="post" enctype="multipart/form-data" action=<?php echo "$aksi?module=identitas&act=update";?>>

	<input type=hidden name=id value="<?php echo $r['id_identitas']?>" />

<table class="list" border="1"><tbody>

<tr>

	<td>Nama Website</td>

    <td colspan="3"> : <input type=text name="nama_website" value="<?php echo $r['nama_website']?>" size=75></td>

</tr>

<tr>

	<td>Alamat Website</td>

    <td colspan="3"> : <input type=text name="alamat_website" value="<?php echo $r['alamat_website']?>" size=75></td>

</tr>

<tr>

	<td>Meta Deskripsi</td>

    <td colspan="3"> : <textarea name="meta_deskripsi" style="width: 500px; height: 50px;"><?php echo $r['meta_deskripsi']?></textarea></td>

</tr>

<tr>

	<td>Meta Keyword</td>

    <td colspan="3"> : <textarea name="meta_keyword" style="width: 500px; height: 50px;"><?php echo $r['meta_keyword']?></textarea></td>

</tr>

<tr>

	<td>Gambar Favicon</td>

    <td colspan="3"> : <img src=../$r[favicon]></td>

</tr>

<tr>

	<td>Ganti Favicon</td>

    <td colspan="3"> : <input type=file size=20 name=fupload> &nbsp;  NB: nama file gambar favicon harus favicon.ico</td>

</tr>

<!--// Sosial Network -->

<tr>

	<td>Facebook</td>

    <td> : <input type=text name="facebook" value="<?php echo $r['facebook']?>" size=40>

	<label class="sosial-network">Contoh: <span>https://www.facebook.com/marksmitt</label>

	</td>

	<td>Twitter</td>

    <td> : <input type=text name="twitter" value="<?php echo $r['twitter']?>" size=40>

	<label class="sosial-network">Contoh: <span>https://twitter.com/reresetyawan</span></label>

	</td>

</tr>

<tr>

	<td>Flickr</td>

    <td> : <input type=text name="flickr" value="<?php echo $r['flickr']?>" size=40>

	<label class="sosial-network"><span></label>

	</td>

	<td>Skype</td>

    <td> : <input type=text name="skype" value="<?php echo $r['skype']?>" size=40>

	<label class="sosial-network">Contoh: <span>rere_setyawan</span></label>

	</td>

</tr>

<!--// Sosial Network - End //-->

<tr><td>Home Page</td>

	<td colspan="3"><textarea id='loko' name='content' style='width: 800px; height: 350px;'><?php echo $r['content']?></textarea></td>

</tr>

<tr><td>Contact Page</td>

	<td colspan="3"><textarea name='contact_page' style='width: 800px; height: 350px;'><?php echo $r['contact_page']?></textarea></td>

</tr>

<tr>

	<td colspan=4><input type=submit value=Update>	<input type=button value=Batal onclick=self.history.back()></td>

</tr>

<tbody></table>

</form>

<?php

    break;  

}

}

?>