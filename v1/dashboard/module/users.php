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



$aksi="module/aksi_users.php";	

switch($_GET[act]){

	// Tampil User

	default:

		if ($_SESSION[leveluser]=='admin'){

			$tampil = mysql_query("SELECT * FROM users ORDER BY username");

			echo "

<h2>User</h2>

<input type=button value='Tambah User' onclick=\"window.location.href='?module=users&act=tambahuser';\">";

		}

		else{

			$tampil=mysql_query("SELECT * FROM users WHERE username='$_SESSION[namauser]'");

			echo "<h2>User</h2>";

		}

//------------------------------------------------------------------------// ?>

<table class='list'>

<thead>

<tr>

	<th>no</th>

	<th>username</th>

	<th>nama lengkap</th>

	<th>email</th>

	<th>No.Telp/HP</th>

	<th>Level</th>

	<th>Blokir</th>

	<th>aksi</th>

</tr>

</thead>

<?php //------------------------------------------------------------------------// 

		$no=1;

		while ($r=mysql_fetch_array($tampil)){

			echo "

<tr><td align=right width='40'>$no &nbsp;</td>

	<td>$r[username]</td>

	<td>$r[nama_lengkap]</td>

	<td><a href=mailto:$r[email]>$r[email]</a></td>

	<td>$r[no_telp]</td>

	<td class='center'>$r[level]</td>

	<td class='center'>$r[blokir]</td>

	<td class='center' width='90'>

		<a href=?module=users&act=edituser&id=$r[id_session]><img src='images/edit.png' border='0' title='edit' /></a> &nbsp;

		<a href=?module=users&act=hapususer&id=$r[id_session]><img src='images/del.png' border='0' title='hapus' /></a>

	</td>

</tr>";

			$no++;

		}

		echo "</table>";

			break;

  

	case "tambahuser":

		if ($_SESSION[leveluser]=='admin'){

?>    

<h2>Tambah User</h2>

<form method=POST action='<?=$aksi;?>?module=users&act=input'>

<table class='list'>

<tr><td>Username</td>     <td> : <input type=text name='username'></td></tr>

<tr><td>Password</td>     <td> : <input type=text name='password'></td></tr>

<tr><td>Nama Lengkap</td> <td> : <input type=text name='nama_lengkap' size=30></td></tr>  

<tr><td>E-mail</td>       <td> : <input type=text name='email' size=30></td></tr>

<tr><td>No.Telp/HP</td>   <td> : <input type=text name='no_telp' size=20></td></tr>

<tr><td colspan=2><input type=submit value=Simpan>

	<input type=button value=Batal onclick=self.history.back()></td></tr>

</table></form>

<?php

		}else{

			echo "Anda tidak berhak mengakses halaman ini.";

		}

     	break;

    

	case "edituser":

		$edit=mysql_query("SELECT * FROM users WHERE id_session='$_GET[id]'");

		$r=mysql_fetch_array($edit);



		if ($_SESSION[leveluser]=='admin'){

			echo "

<h2>Edit User</h2>

<form method=POST action=$aksi?module=users&act=update>

	<input type=hidden name=id value='$r[id_session]'>

	<table class='list'>

	<tr><td>Username</td>     <td> : <input type=text name='username' value='$r[username]' disabled> **)</td></tr>

	<tr><td>Password</td>     <td> : <input type=text name='password'> *) </td></tr>

	<tr><td>Nama Lengkap</td> <td> : <input type=text name='nama_lengkap' size=30  value='$r[nama_lengkap]'></td></tr>

	<tr><td>E-mail</td>       <td> : <input type=text name='email' size=30 value='$r[email]'></td></tr>

	<tr><td>No.Telp/HP</td>   <td> : <input type=text name='no_telp' size=30 value='$r[no_telp]'></td></tr>";



			if ($r[blokir]=='N'){ echo "

	<tr><td>Blokir</td>       <td> : <input type=radio name='blokir' value='Y'> Y   

				   					 <input type=radio name='blokir' value='N' checked> N </td></tr>";

			}else{ echo "

	<tr><td>Blokir</td>       <td> : <input type=radio name='blokir' value='Y' checked> Y  

				  					 <input type=radio name='blokir' value='N'> N </td></tr>";

			}

    

			echo "

	<tr><td colspan=2>*) Apabila password tidak diubah, dikosongkan saja.<br />

		        **) Username tidak bisa diubah.</td></tr>

	<tr><td colspan=2><input type=submit value=Update>

		        <input type=button value=Batal onclick=self.history.back()></td></tr>

	</table></form>";     

	    }

    	else{

		    echo "<h2>Edit User</h2>

	<form method=POST action=$aksi?module=users&act=update>

	<input type=hidden name=id value='$r[id_session]'>

	<input type=hidden name=blokir value='$r[blokir]'>

	<table>

	<tr><td>Username</td>     <td> : <input type=text name='username' value='$r[username]' disabled> **)</td></tr>

	<tr><td>Password</td>     <td> : <input type=text name='password'> *) </td></tr>

	<tr><td>Nama Lengkap</td> <td> : <input type=text name='nama_lengkap' size=30  value='$r[nama_lengkap]'></td></tr>

	<tr><td>E-mail</td>       <td> : <input type=text name='email' size=30 value='$r[email]'></td></tr>

	<tr><td>No.Telp/HP</td>   <td> : <input type=text name='no_telp' size=30 value='$r[no_telp]'></td></tr>";    

    		echo "

	<tr><td colspan=2>*) Apabila password tidak diubah, dikosongkan saja.<br />

		        **) Username tidak bisa diubah.</td></tr>

	<tr><td colspan=2><input type=submit value=Update>

		        <input type=button value=Batal onclick=self.history.back()></td></tr>

	</table></form>";     

	    }

    	break;  

		

	case "hapususer":		

		$hapus=mysql_query("DELETE FROM users WHERE id_session='$_GET[id]'");		

		

		$module=$_GET[module];

		// header('location:../module.php?module='.$module);

		echo '<script language="javascript">window.location="module.php?module='.$module.'";</script>';

		break;

}// switch



}

?>