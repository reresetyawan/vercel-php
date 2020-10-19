<?php 
session_start();
// Report simple running errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors',0);


include('config/sysconfig.inc.php');
//--- Indentitas Website ---//
$q_identitas = mysql_query("SELECT * FROM identitas WHERE id_identitas = 1");
$r_identitas = mysql_fetch_array($q_identitas);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?=$r_identitas['nama_website'];?></title>
    <link rel="icon" href="favicon.png" type="image/png" sizes="16x16"> 
	<meta name="keywords" content="<?=$r_identitas['meta_keyword'];?>" />
	<meta name="description" content="<?=$r_identitas['meta_deskripsi'];?>" />

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

        
    <div id="featured">
		<ul class="ui-tabs-nav">
<?php
// berita
$count = 0; $temp_homebanner='';
$q_homebanner = mysql_query("SELECT jdl_homebanner, gbr_homebanner, keterangan, link_homebanner FROM homebanner ORDER BY id_homebanner DESC LIMIT 4");
while($r_homebanner = mysql_fetch_array($q_homebanner)){
	$count++;
	$isi_homebanner = strip_tags($r_homebanner['keterangan']);

	echo '<li class="ui-tabs-nav-item ui-tabs-selected" id="nav-fragment-1">
            	<a href="#fragment-'.$count.'"><img src="images/gallery/small_'.$r_homebanner['gbr_homebanner'].'" alt=""  width="80" height="50" />
                	<span>'.$r_homebanner['jdl_homebanner'].'</span></a></li>';
	$temp_homebanner .= '
	    <div id="fragment-'.$count.'" class="ui-tabs-panel ui-tabs-hide" style="">
			<img src="images/gallery/'.$r_homebanner['gbr_homebanner'].'" alt=""  width="660" height="280" />
			<!--//
			 <div class="info" >
				<h2><a href="'.$r_homebanner['link_homebanner'].'" >'.$r_homebanner['jdl_homebanner'].'</a></h2>
				<p><a href="'.$r_homebanner['link_homebanner'].'" >read more</a></p>
			 </div>
			//-->
	    </div>';
}
?>
		</ul>
		<?=$temp_homebanner;?>
	    <!-- First Content --
	    <div id="fragment-1" class="ui-tabs-panel" style="">
	        <a href="categories.php?category=informasi" title="Informasi tentang kursus" >
			<img src="images/featured_list/image1.jpg" alt="Informasi tentang kursus" />
			</a>
            <!--//
			 <div class="info" >
				<h2><a href="#" >Lorem ipsum dolor sit amet</a></h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tincidunt condimentum lacus. Pellentesque ut diam....<a href="#" >read more</a></p>
			 </div>
             //--
	    </div>-->

	    <!-- Second Content --
	    <div id="fragment-2" class="ui-tabs-panel ui-tabs-hide" style="">
			<img src="images/featured_list/image2.jpg" alt="" />
			 <div class="info" >
				<h2><a href="#" >Konser Harpa REMY VAN KESTEREN dan Soprano BERNADETA ASTARI</a></h2>
				<p><a href="#" >read more</a></p>
			 </div>
	    </div>

	    <!-- Third Content --
	    <div id="fragment-3" class="ui-tabs-panel ui-tabs-hide" style="">
	        <a href="categories.php?category=informasi" title="Informasi tentang kursus" >
			<img src="images/featured_list/image1.jpg" alt="Informasi tentang kursus" />
			</a>
            <!--//
			 <div class="info" >
				<h2><a href="#" >Lorem ipsum dolor sit amet</a></h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tincidunt condimentum lacus. Pellentesque ut diam....<a href="#" >read more</a></p>
			 </div>
             //--
	    </div>

	    <!-- Fourth Content --
	    <div id="fragment-4" class="ui-tabs-panel ui-tabs-hide" style="">
			<img src="images/featured_list/image2.jpg" alt="" />
			 <div class="info" >
				<h2><a href="#" >Konser Harpa REMY VAN KESTEREN dan Soprano BERNADETA ASTARI</a></h2>
				<p><a href="#" >read more</a></p>
	         </div>
	    </div>
        //-->
	</div>
    
<!--// -->
<!--<script src="js/lightbox/jquery-1.4.min.js" type="text/javascript"></script>-->
<link rel="stylesheet" href="js/lightbox/themes/default/jquery.lightbox.css" type="text/css" />
<script src="js/lightbox/jquery.lightbox.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.lightbox').lightbox();		    
});
</script>
<!--// -->

	<div id="templatemo_main">
    	<?php include('homepage.inc.php');?>
    </div>

	<div id="templatemo_footer">
    	<?php include('footer.inc.php');?>
    </div> <!-- END of templatemo_footer -->
</div> <!-- END of templatemo_wrapper -->	

</body>
</html>