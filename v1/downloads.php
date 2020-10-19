<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); 
include('config/sysconfig.inc.php');

$direktori = "files/"; // folder tempat penyimpanan file yang boleh didownload
$filename = isset($_GET['file']);

if($filename<>''){
//----
if(file_exists($direktori.$filename)){
	$file_extension = strtolower(substr(strrchr($filename,"."),1));

	switch($file_extension){
		case "pdf": $ctype="application/pdf"; break;
		case "exe": $ctype="application/octet-stream"; break;
		case "zip": $ctype="application/zip"; break;
		case "rar": $ctype="application/rar"; break;
		case "doc": $ctype="application/msword"; break;
		case "xls": $ctype="application/vnd.ms-excel"; break;
		case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
		case "gif": $ctype="image/gif"; break;
		case "png": $ctype="image/png"; break;
		case "jpeg":
		case "jpg": $ctype="image/jpg"; break;
		default: $ctype="application/proses";
	}

	if ($file_extension=='php'){ echo "
		<h1>Access forbidden!</h1>
		<p>Maaf, file yang Anda download sudah tidak tersedia atau filenya (direktorinya) telah diproteksi.</p>";
		exit;
	}
	else{
		mysql_query("update download set hits=hits+1 where nama_file='$filename'");

		header("Content-Type: octet/stream");
		header("Pragma: private"); 
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false); 
		header("Content-Type: $ctype");
		header("Content-Disposition: attachment; filename=\"".basename($filename)."\";" );
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".filesize($direktori.$filename));
		readfile("$direktori$filename");
		exit(); 
		echo '<script language="javascript">window.location="downloads.php#";</script>';  
	}
}else{ echo "
		<h1>Access forbidden!</h1>
		<p>Maaf, file yang Anda download sudah tidak tersedia atau filenya (direktorinya) telah diproteksi.</p>";
		exit;
}

}//----

//--- Indentitas Website ---//
$q_identitas = mysql_query("SELECT * FROM identitas WHERE id_identitas = 1");
$r_identitas = mysql_fetch_array($q_identitas);



// halaman
if(!isset($_GET['page'])){$page = 1;}else{$page = isset($_GET['page']);}
// semua download
$q_detaildownload = mysql_query("SELECT * FROM download ");
$count_download = mysql_num_rows($q_detaildownload);

// cek valid kategori
if($count_download>0){
	$count_page = ceil($count_download/10);
	$awal_download=($page-1)*10;

	$halaman='<li><a href="downloads.php?file='.isset($_GET['id']).'&page=1" target="_parent">Previous</a></li>';
	for($i=1;$i<=$count_page;$i++){
		if($i==$page){$halaman.='<li><a class="current" href="?category='.isset($_GET['category']).'&page='.$i.'" target="_parent">'.$i.'</a></li>';
		}else{$halaman.='<li><a href="?category='.$_GET['category'].'&page='.$i.'" target="_parent">'.$i.'</a></li>';}
	}
	$halaman.='<li><a href="?category='.isset($_GET['category']).'&page='.$count_page.'" target="_parent" rel="nofollow">Next</a></li>';

	// detail download by kategori
	$q_detaildownload = mysql_query("SELECT nama_file, judul, hits FROM download b LIMIT $awal_download, 10");
	$detaildownload = '';
	$nama_kategori = '';
	while($r_detaildownload = mysql_fetch_array($q_detaildownload)){
		// $isi_download = strip_tags($r_detaildownload['isi_download']);
		$isi_download = strip_tags($r_detaildownload['nama_file']);
    	$isi = substr($isi_download,0,100); 
		$isi = substr($isi_download,0,strrpos($isi," ")); 
		// $nama_kategori = $r_detaildownload['nama_kategori'];
		$detaildownload .= '
			<li><div style="padding:5px;border-bottom:1px dashed #ccc;">
				<a href="downloads.php?file='.$r_detaildownload['nama_file'].'"><strong>'.$r_detaildownload['judul'].'</strong> ('.$r_detaildownload['hits'].')</a>
				</div>
			</li>';
	}
	
} //--- cek valid kategori ---

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?='Kategori :: '.$nama_kategori;?></title>
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
        	<?php 
			if($count_download>0){ ?>
        	<h4><b>Download :: </b><span style="font-style:italic;color:#FF6600"><?=$nama_kategori?></span></h4>
            <hr />
				
			<ol class="comment_list">
				<?=$detaildownload?>
        	</ol>        
    	    <div class="clear"></div>
            
			<div class="templatemo_paging">
				<ul>
					<?=$halaman?>
				</ul>
				<div class="clear"></div>
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