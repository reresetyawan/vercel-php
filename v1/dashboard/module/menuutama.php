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

	

	// menampilkan

	$aksi="module/aksi_menuutama.php";

	switch($_GET[act]){

		// Tampil Menu Utama

		default: echo "

			<h2>Menu Utama</h2>

			<input type=button value='Tambah Menu Utama' 

			onclick=\"window.location.href='?module=menuutama&act=tambahmenuutama';\">

			<table class='list'><thead>

			<tr><th>no</th>

			<th>menu utama</th>

			<th>root menu</th>

			<th>link</th>

			<th>aktif</th>

			<th>aksi</th></tr></thead><tbody>";

			

			$tampil = mysql_query("

				SELECT c.id as id_main, c.parent_id, p.title as nama_parent, c.title as nama_menu, c.url as link, 

					CASE c.active WHEN 1 THEN 'Y' ELSE 'N' END as aktif 

				FROM menu c

				LEFT JOIN menu p ON p.id = c.parent_id");

			$no=1;

			while ($r=mysql_fetch_array($tampil)){

				echo "

				<tr><td align=right width='40'>$no &nbsp;</td>

				<td>$r[nama_menu]</td>

				<td>$r[nama_parent]</td>

				<td>$r[link]</td>

				<td align=center>$r[aktif]</td>

				<td width='85'>

				<a href=?module=menuutama&act=editmenuutama&id=$r[id_main]><img src='images/edit.png' border='0' title='edit' /></a> 

				<a href=$aksi?module=menuutama&act=hapus&id=$r[id_main]><img src='images/del.png' border='0' title='hapus' /></a>

				</td></tr>";

				$no++;

			}

    		echo "</tbody></table>

			<div id=paging>

				*) Data pada Menu tidak bisa dihapus, tapi bisa di non-aktifkan melalui Edit Menu Utama.<br>

                **) Untuk link menu Beranda (Home) harus diubah ketika online menjadi http://NamaDomainAnda.com

          	</div><br>";

			break;

  

		// Form Tambah Menu Utama

		case "tambahmenuutama": echo '

			<h2>Tambah Menu Utama</h2>

			<form method="post" action="'.$aksi.'?module=menuutama&act=input">

			<table class="list"><tbody>

			<tr><td width="70">Nama Menu</td>

				<td> : <input type="text" name="nama_menu" size="40"> 

						<span style="margin-left:32px;">Urutan</span> : <input type="text" name="menu_order" size="2"></td>

				<td>Root Menu</td>

				<td> : <select name="parent_id" >

						<option value=0 style="font-weight:bold">[ Root Menu ]</option>';



			$tampil=mysql_query("SELECT * FROM menu ORDER BY title");

			while($r_tampil=mysql_fetch_array($tampil)){

				if($r_tampil[id]==$r[root]){

					echo "<option value=$r_tampil[id] selected=selected >$r_tampil[title]</option>";

				}else{					

					echo "<option value=$r_tampil[id]>$r_tampil[title]</option>";

				}

			}

			echo '

					</select>

				</td>

			</tr>

			<tr><td>Link</td>

				<td> : <input type="text" name="link" size="60"></td>

				<td>Aktif</td>

				<td> :  <input type="radio" name="aktif" value="1" checked>Y <input type=radio name="aktif" value="0"> N</td>

			</tr>



			<tr><input type="submit" value="Simpan"> <input type="button" value="Batal" onclick="self.history.back()"></td></tr>

			<tbody></table>

			</form>

			<div id="paging">

				*) Apabila Aktif = Y dan Admin Menu = N, maka Menu Utama akan ditampilkan di halaman pengunjung. <br />

			  	**) Apabila Aktif = N dan Admin Menu = Y, maka Menu Utama akan ditampilkan di halaman administrator.

			</div><br>';

			/*

			<tr><td valign="top">Isi Berita</td>

				<td colspan=3><textarea name="isi_berita" id="loko" style="width: 800px; height: 350px;"></textarea></td>

			</tr>

			*/

			break;

  

		// Form Edit Menu Utama // lama

		case "editmenuutama":

			$edit = mysql_query("SELECT id as id_main, parent_id as root, title as nama_menu, content, url as link, 

					CASE active WHEN 1 THEN 'Y' ELSE 'N' END as aktif, menu_order FROM menu  WHERE id='$_GET[id]'");

			$r=mysql_fetch_array($edit);



			echo '

			<h2>Edit Menu Utama</h2>

			<form method="post" action="module/aksi_menuutama.php?module=menuutama&act=update">

			<input type="hidden" name="id" value="'.$r[id_main].'">

			<table class="list"><tbody>

			<tr><td width="70">Nama Menu</td>

				<td> : <input type="text" name="nama_menu" value="'.$r[nama_menu].'" size="40"> 

						<span style="margin-left:32px;">Urutan</span> : <input type="text" name="menu_order" value="'.$r[menu_order].'" size="2"></td>

				<td>Root Menu</td>

				<td> : <select name="parent_id" >

						<option value=0 style="font-weight:bold">[ Root Menu ]</option>';



			$tampil=mysql_query("SELECT * FROM menu ORDER BY title");

			while($r_tampil=mysql_fetch_array($tampil)){

				if($r_tampil[id]==$r[root]){

					echo "<option value=$r_tampil[id] selected=selected >$r_tampil[title]</option>";

				}else{					

					echo "<option value=$r_tampil[id]>$r_tampil[title]</option>";

				}

			}

			echo '

					</select>

				</td>

			</tr>

			<tr><td>Link</td>

				<td> : <input type="text" name="link" value="'.$r[link].'" size="60"></td>

				<td>Aktif</td>

				<td> : ';

	

				// status aktif

				if ($r[aktif]=='Y'){ echo '<input type="radio" name="aktif" value="1" checked>Y <input type=radio name="aktif" value="0"> N';

				}else{ echo '<input type=radio name="aktif" value="1">Y <input type=radio name="aktif" value="0" checked>N'; }



				echo '

				</td>

			</tr>

			<tr><input type="submit" value="Update"> <input type="button" value="Batal" onclick="self.history.back()"></td></tr>

			<tbody></table>

			</form>

			<div id="paging">

				*) Apabila Aktif = Y dan Admin Menu = N, maka Menu Utama akan ditampilkan di halaman pengunjung. <br />

			  	**) Apabila Aktif = N dan Admin Menu = Y, maka Menu Utama akan ditampilkan di halaman administrator.

			</div><br>';

			/*

			<tr><td valign="top">Isi Berita</td>

				<td colspan=3><textarea name="isi_berita" id="loko" style="width: 800px; height: 350px;">'.$r[content].'</textarea></td>

			</tr>

			*/

			break;

	}

}

?>