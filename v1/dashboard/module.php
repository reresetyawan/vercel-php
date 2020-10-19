<?php
session_start();
error_reporting(0);
include "timeout.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<!--// tiny_mce -->
  <script src="../tiny_mce/tiny_mce.js" type="text/javascript"></script>
  <script src="../tiny_mce/tiny_rere.js" type="text/javascript"></script>
	<!--// administrator -->
	<link rel="stylesheet" type="text/css" href="admin.style.css" />
    <!--// menu -->
    <link type="text/css" href="../css/menu/menu.css" rel="stylesheet" />
    <script type="text/javascript" src="../js/menu/jquery.js"></script>
    <script type="text/javascript" src="../js/menu/menu.js"></script>
    
<link href="../templatemo_style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery-ui.min.js" ></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#featured > ul").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	});
</script>

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/ddsmoothmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "templatemo_menu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}

</script>

<link rel="stylesheet" href="css/slimbox2.css" type="text/css" media="screen" /> 
<script type="text/JavaScript" src="js/slimbox2.js"></script> 


</head>
<body onload="document.getElementById('username').focus();">

<div id="templatemo_wrapper">
	<div id="templatemo_header">
    	<div id="site_title"><a href="index.php" rel="nofollow">Yayasan Caraka Mulia</a></div>
    </div> <!-- END of header -->
    
	<div id="menu">
    	<?php include('menu.inc.php');?>
    </div><!--// menu -->

    <div id="templatemo_main">
<?php if ($_SESSION['leveluser']=='admin'){ ?>
<style>
div.icon-menu {
	text-align:center;margin:5px;margin-bottom:15px;padding:10px;padding-right:0px;width:75px;height:75px;float:left;
}
</style>
		<table class='list'>
        <tr>
        	<td>
            <div >
            	<div class="icon-menu">
                	<a href=module.php?module=users><img src=images/user.jpg border=none><br /><b>Manajemen User</b></a>
                </div>
            	<div class="icon-menu">
	                <a href=module.php?module=berita><img src=images/berita.png border=none><br /><b>Berita</b></a>
                </div>
            	<div class="icon-menu">
                	<a href=module.php?module=agenda><img src=images/agenda.png border=none><br /><b>Agenda</b></a>
                </div>
            	<div class="icon-menu">
	                <a href=module.php?module=download><img src=images/download.png border=none><br /><b>Download</b></a>
                </div>
            	<div class="icon-menu">
                	<a href=module.php?module=banner><img src=images/banner.png border=none><br /><b>Banner</b></a>
                </div>
            	<div class="icon-menu">
                	<a href=module.php?module=galerifoto><img src=images/galeri.png border=none><br /><b>Galeri Foto</b></a>
                </div>
            	<div class="icon-menu">
                	<a href=module.php?module=hubungi><img src=images/hubungi.png border=none><br /><b>Hubungi Kami</b></a>
                </div>
            </div>
            </td>
        </tr>
		</table>
        <br />
<?php 
}elseif ($_SESSION['leveluser']=='admin'){ 

}

require_once('../config/library.inc.php');
require_once('module/class_paging.php');


/** login - jika belom login **/
if (!isset($_SESSION['leveluser'])){
	include "module/login.php";
}
		
/** identitas **/
if ($_GET['module']=='identitas'){
  // if ($_SESSION['leveluser']=='admin'){
    include "module/identitas.php";
  //}
}
/** menuutama **/
elseif ($_GET['module']=='menuutama'){
  // if ($_SESSION['leveluser']=='admin'){
    include "module/menuutama.php";
  //}
}
/** users **/
elseif ($_GET['module']=='users'){
  // if ($_SESSION['leveluser']=='admin'){
    include "module/users.php";
  //}
}
/** halamanstatis **/
elseif ($_GET['module']=='halamanstatis'){
  // if ($_SESSION['leveluser']=='admin'){
    include "module/halamanstatis.php";
  //}
}
/** agenda **/
elseif ($_GET['module']=='agenda'){
  // if ($_SESSION['leveluser']=='admin'){
    include "module/agenda.php";
  //}
}
/** berita **/
elseif ($_GET['module']=='berita'){
  // if ($_SESSION['leveluser']=='admin'){
    include "module/berita.php";
  //}
}
/** kategori **/
elseif ($_GET['module']=='kategori'){
  // if ($_SESSION['leveluser']=='admin'){
    include "module/kategori.php";
  //}
}
/** tag **/
elseif ($_GET['module']=='tag'){
  // if ($_SESSION['leveluser']=='admin'){
    include "module/tag.php";
  //}
}
/** homebanner **/
elseif ($_GET['module']=='homebanner'){
  // if ($_SESSION['leveluser']=='admin'){
    include "module/homebanner.php";
  //}
}
/** banner **/
elseif ($_GET['module']=='banner'){
  // if ($_SESSION['leveluser']=='admin'){
    include "module/banner.php";
  //}
}
/** download **/
elseif ($_GET['module']=='download'){
  // if ($_SESSION['leveluser']=='admin'){
    include "module/download.php";
  //}
}
/** album **/
elseif ($_GET['module']=='album'){
  // if ($_SESSION['leveluser']=='admin'){
    include "module/album.php";
  //}
}
/** galerifoto **/
elseif ($_GET['module']=='galerifoto'){
  // if ($_SESSION['leveluser']=='admin'){
    include "module/galerifoto.php";
  //}
}
/** hubungi **/
elseif ($_GET['module']=='hubungi'){
  // if ($_SESSION['leveluser']=='admin'){
    include "module/hubungi.php";
  //}
}
		?>
        <div class="clear"></div>
    </div> <!-- END of templatemo_main -->

	<div id="templatemo_footer">
		<div id="templatemo_copyright_wrapper">
		    <div id="templatemo_copyright">
        		Copyright © 2013 <a href="http://reresetyawan.wordpress.com" rel="nofollow">Ire Solution</a> | Yayasan Caraka Mulia. All rights reserved.
		    </div>
		</div>
    </div> <!-- END of templatemo_footer -->
</div> <!-- END of templatemo_wrapper -->	

</body>
</html>