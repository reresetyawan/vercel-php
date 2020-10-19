<?php
error_reporting (E_ALL ^ E_NOTICE);

include('config/sysconfig.inc.php');
//--- Indentitas Website ---//
$q_identitas = mysql_query("SELECT * FROM identitas WHERE id_identitas = 1");
$r_identitas = mysql_fetch_array($q_identitas);
$nama_kategori = '';


$kata = trim(isset($_GET['keyword']));
if($kata <> ''){
	//--- HASIL PENCARIAN ---//
	// pisahkan kata perkalimat lalu hitung kata
	$pisah_kata = explode(" ", $kata);
	$jml_kata = (integer)count($pisah_kata);
	$jml_kata = $jml_kata-1;
	// pencarian multiple kata
	$str_cari = "SELECT * FROM berita WHERE ";
	for($i=0; $i<=$jml_kata;$i++){
		$str_cari .= "isi_berita LIKE '%$pisah_kata[$i]%'";
		if( $i<$jml_kata ){
			$str_cari .= " OR ";
		}
	}
	$str_cari .= " ORDER BY id_berita DESC ";

	// halaman
	if(!$_GET['page']){$page = 1;}else{$page = $_GET['page'];}
	$q_detailberita = mysql_query($str_cari);
	$count_berita = mysql_num_rows($q_detailberita);

	// cek valid pencarian
	if($count_berita>0){
		$count_page = ceil($count_berita/10);
		$awal_berita=($page-1)*10;

		$halaman='<li><a href="?keyword='.$_GET['keyword'].'&Search=SEARCH&page=1" target="_parent">Previous</a></li>';
		for($i=1;$i<=$count_page;$i++){
			if($i==$page){$halaman.='<li><a class="current" href="?keyword='.$_GET['keyword'].'&Search=SEARCH&page='.$i.'" target="_parent">'.$i.'</a></li>';
			}else{$halaman.='<li><a href="?keyword='.$_GET['keyword'].'&Search=SEARCH&page='.$i.'" target="_parent">'.$i.'</a></li>';}
		}
		$halaman.='<li><a href="?keyword='.$_GET['keyword'].'&Search=SEARCH&page='.$count_page.'" target="_parent" rel="nofollow">Next</a></li>';

		// detail berita by kategori
		$q_detailberita = mysql_query($str_cari."	LIMIT $awal_berita, 10");
	
		while($r_detailberita = mysql_fetch_array($q_detailberita)){
			$isi_berita = strip_tags($r_detailberita[isi_berita]);
    		$isi = substr($isi_berita,0,100); 
			$isi = substr($isi_berita,0,strrpos($isi," ")); 
			$nama_kategori = $r_detailberita[nama_kategori];
			$detailberita .= '
			<li>
				<div class="comment_box">
					<img src="images/avator.jpg" alt="person 1" class="img_fl img_border" />
					<div class="comment_content">
						<div class="comment_meta"><strong><a href="info.php?page='.$r_detailberita[judul_seo].'">'.$r_detailberita[judul].'</a></strong><br>
						'.$r_detailberita[tanggal].' '.$r_detailberita[jam].' - Posted by '.$r_detailberita[username].'
						</div>
						<p>'.$isi.'... 
						<a href="info.php?page='.$r_detailberita[judul_seo].'" class="comment_meta" style="font-style:italic;color:#FF6600">Selengkapnya</a>'.'</p>
					</div>
					<div class="clear"></div>
				</div>
			</li>';
		}
	
	} //--- cek valid pencarian ---
	//--- HASIL PENCARIAN - END ---//

}else{

// halaman
if(!isset($_GET['page'])){$page = 1;}else{$page = isset($_GET['page']);}
// semua artikel
if($_GET['category']=='all'){$filter_category = "";}else{$filter_category = " WHERE kategori_seo = '$_GET[category]' ";}
$q_detailberita = mysql_query("SELECT * FROM berita b
	LEFT JOIN kategori k ON b.id_kategori = k.id_kategori ".$filter_category);
$count_berita = mysql_num_rows($q_detailberita);

// cek valid kategori
$detailberita = '';
if($count_berita>0){
	$count_page = ceil($count_berita/10);
	$awal_berita=($page-1)*10;

	$halaman='<li><a href="?category='.$_GET['category'].'&page=1" target="_parent">Previous</a></li>';
	for($i=1;$i<=$count_page;$i++){
		if($i==$page){$halaman.='<li><a class="current" href="?category='.$_GET['category'].'&page='.$i.'" target="_parent">'.$i.'</a></li>';
		}else{$halaman.='<li><a href="?category='.$_GET['category'].'&page='.$i.'" target="_parent">'.$i.'</a></li>';}
	}
	$halaman.='<li><a href="?category='.$_GET['category'].'&page='.$count_page.'" target="_parent" rel="nofollow">Next</a></li>';

	// detail berita by kategori
	$q_detailberita = mysql_query("SELECT * FROM berita b
		LEFT JOIN kategori k ON b.id_kategori = k.id_kategori ".$filter_category."
		LIMIT $awal_berita, 10");
	
	while($r_detailberita = mysql_fetch_array($q_detailberita)){
		$isi_berita = strip_tags($r_detailberita['isi_berita']);
    	$isi = substr($isi_berita,0,100); 
		$isi = substr($isi_berita,0,strrpos($isi," ")); 
		$nama_kategori = $r_detailberita['nama_kategori'];
		$detailberita .= '
			<li>
				<div class="comment_box">
					<img src="images/avator.jpg" alt="person 1" class="img_fl img_border" />
					<div class="comment_content">
						<div class="comment_meta"><strong><a href="info.php?page='.$r_detailberita['judul_seo'].'">'.$r_detailberita['judul'].'</a></strong><br>
						'.$r_detailberita['tanggal'].' '.$r_detailberita['jam'].' - Posted by '.$r_detailberita['username'].'
						</div>
						<p>'.$isi.'... 
						<a href="info.php?page='.$r_detailberita['judul_seo'].'" class="comment_meta" style="font-style:italic;color:#FF6600">Selengkapnya</a>'.'</p>
					</div>
					<div class="clear"></div>
				</div>
			</li>';
	}
	
} //--- cek valid kategori ---

}//--- batas categori ---//
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
			if($count_berita>0){ 
				if(!isset($_GET['keyword'])){ ?>
        	<h4><b>Kategori :: </b><span style="font-style:italic;color:#FF6600"><?=$nama_kategori?></span></h4>
            <?php }else{ ?>
        	<h4><b>Pencarian Berita :: </b><span style="font-style:italic;color:#FF6600"><?=$nama_kategori?></span></h4>
            <p><?='Kata Kunci: <em>'.$kata.'</em><br />Hasil Pencarian: <em><b>'.$count_berita.'</b> berita</em>';?></p>
            <?php } ?>
            <hr />
				
			<ol class="comment_list">
				<?=$detailberita?>
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