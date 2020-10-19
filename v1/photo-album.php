<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gallery, Secured Theme</title>
<meta name="keywords" content="" />
<meta name="description" content="" />

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

<!--// -->

<script src="js/lightbox/jquery-1.4.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="js/lightbox/themes/default/jquery.lightbox.css" type="text/css" />
<script src="js/lightbox/jquery.lightbox.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.lightbox').lightbox();		    
});
</script>

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
    	<h2>Album Foto</h2>
        <p>Semua Foto ini merupakan Dokumentasi Pribadi dari Pascasarjana Universitas Katolik Widya Mandala Surabaya.</p><br />
<?php
include('config/sysconfig.inc.php');
// album
$count = 0; $temp_album = '';
// $q_album = mysql_query("SELECT * FROM album WHERE aktif = 'Y' ORDER BY jdl_album");
$q_album = mysql_query("SELECT *, count(id_gallery) as jumlah FROM gallery g
	LEFT JOIN album a ON g.id_album = a.id_album
	WHERE aktif = 'Y'
	GROUP BY g.id_album
	ORDER BY jdl_album");

while($r_album = mysql_fetch_array($q_album)){
	$count++;
	if($count%4==0){ $style_right = ' class="no_margin_right"'; }else{ $style_right = ''; }
	$temp_album .= "
	<li".$style_right." style='text-align:center'><a href='gallery.php?id=".$r_album['id_album']."&album=".$r_album['album_seo']."' title='".$r_album['jdl_album']."'>
		<img src='images/album/small_".$r_album['gbr_album']."' alt='' class='img_border img_border_b' style=\"height:90px; max-width:180px;\" />
		<label>".$r_album['jdl_album']."<br>(".$r_album['jumlah']." foto)</label></a>
	</li>";
}
?>
		<ul id="gallery" class="nobullet">
        <?=$temp_album;?>
        </ul>
        
        <hr />
        <div class="clear"></div>
        <!--// PAGING //-->
    </div> <!-- END of templatemo_main -->

	<div id="templatemo_footer">
    	<?php include('footer.inc.php');?>
    </div> <!-- END of templatemo_footer -->
</div> <!-- END of templatemo_wrapper -->	

</body>
</html>