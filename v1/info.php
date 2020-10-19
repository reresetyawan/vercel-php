<?php
include('config/sysconfig.inc.php');
include('config/library.inc.php');
//--- Indentitas Website ---
$q_identitas = mysql_query("SELECT * FROM identitas WHERE id_identitas = 1");
$r_identitas = mysql_fetch_array($q_identitas);

//--- Hits ---//
mysql_query("UPDATE berita SET dibaca=dibaca+1 WHERE judul_seo = '$_GET[page]' ");
//--- Content ---//
$q_info = mysql_query("SELECT * FROM berita b left join kategori k on b.id_kategori = k.id_kategori WHERE judul_seo = '$_GET[page]' ");
$cek_page = mysql_num_rows($q_info);
// cek valid data
if($cek_page>0){ $r_info = mysql_fetch_array($q_info); }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?=$r_info[nama_kategori].' :: '.$r_info[judul]?></title>
    <link rel="icon" href="favicon.png" type="image/png" sizes="16x16"> 
	<meta name="keywords" content="<?=$r_identitas[meta_keyword]?>" />
	<meta name="description" content="<?=$r_identitas[meta_deskripsi]?>" />

    <!--// menu -->
    <link type="text/css" href="css/menu/menu.css" rel="stylesheet" />
    <script type="text/javascript" src="js/menu/jquery.js"></script>
    <script type="text/javascript" src="js/menu/menu.js"></script>
    <!--// menu - end -->
    
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="style.css" />
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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50623546-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>

<div id="templatemo_wrapper">
	<div id="templatemo_header">
    	<?php include('header.inc.php');?>
    </div> <!-- END of header -->
    
	<div id="menu">
    	<?php include('menu.inc.php');?>
    </div><!--// menu -->

	<div id="templatemo_main">
		<div id="templatemo_content" class="left">
        	<?php if($cek_page>0){ ?>
        	<h3><b><?=$r_info['judul']?></b><?php /*<span style="font-style:italic;color:#FF6600"><?=$r_info['nama_kategori']?></span>*/ ?></h3>
			<div>
            	<!--Diposting oleh : <a style="font-style:italic;color:#FF6600" href="#"><?=$r_info['username']?></a>,
				<span class="comment_meta"><?=tgl_indo($r_info['tanggal']).' - '.$r_info['jam']?></span> &nbsp; //-->Dibaca : <span class="comment_meta"><?=$r_info['dibaca']?> kali</span><br>
                Kategori : <a style="font-style:italic;color:#FF6600" href="categories.php?category=<?=$r_info['kategori_seo']?>"><?=$r_info['nama_kategori']?></a>
            </div>
            <hr />
            <br />
			<!--// content -->
			<div class="post">
				<!--// <img src="images/news/01.jpg" alt="image 1" class="img_fl img_border img_border_b" /> //-->
                <?=str_replace('src="../images/image/', 'src="images/image/', $r_info['isi_berita']);?>
			</div>	            
        	<?php }else{ // jika halaman tidak ditemukan ?>
            <h3><b>Halaman Tidak Ditemukan.</b></h3>
            <br />
            <br />
        	<?php } ?>
            <hr />
            <?php include('contact.inc.php');?>
            
            
            
		</div>
        <div id="templatemo_sidebar" class="right">
        	<?php include('right.inc.php');?>
        </div>
        <div class="clear"></div>
    </div> <!-- END of templatemo_main -->

	<div id="templatemo_footer">
    	<?php include('footer.inc.php');?>
    </div> <!-- END of templatemo_footer -->
</div> <!-- END of templatemo_wrapper -->	

</body>
</html>