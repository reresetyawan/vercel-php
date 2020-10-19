<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); 
include('config/sysconfig.inc.php');
//--- Indentitas Website ---//
$q_identitas = mysql_query("SELECT * FROM identitas WHERE id_identitas = 1");
$r_identitas = mysql_fetch_array($q_identitas);
$nama_agenda = '';


// halaman
if(!isset($_GET['page'])){$page = 1;}else{$page = isset($_GET['page']);}
// semua artikel
if($_GET['agenda']=='all'){$filter_agenda = "";}else{$filter_agenda = " WHERE id_agenda = '$_GET[id]' ";}
$q_detailagenda = mysql_query("SELECT * FROM agenda ".$filter_agenda);
$count_agenda = mysql_num_rows($q_detailagenda);

// cek valid agenda
$detailagenda = '';
if($count_agenda>0){
	$count_page = ceil($count_agenda/10);
	$awal_agenda=($page-1)*10;
	if($page>1){ $prev = $page-1; }else{ $prev = 1; }

	$halaman='<li><a href="?agenda='.$_GET['agenda'].'&page='.$prev.'" target="_parent">Previous</a></li>';
	for($i=1;$i<=$count_page;$i++){
		if($i==$page){$halaman.='<li><a class="current" href="?agenda='.$_GET['agenda'].'&page='.$i.'" target="_parent">'.$i.'</a></li>';
		}else{$halaman.='<li><a href="?agenda='.$_GET['agenda'].'&page='.$i.'" target="_parent">'.$i.'</a></li>';}
	}
	$halaman.='<li><a href="?agenda='.$_GET['agenda'].'&page='.$count_page.'" target="_parent" rel="nofollow">Next</a></li>';

	// detail agenda by agenda
	$q_detailagenda = mysql_query("SELECT id_agenda, isi_agenda, tema, tempat, pengirim, jam, tgl_mulai, tgl_selesai FROM agenda ".$filter_agenda." ORDER BY tgl_mulai DESC
		LIMIT $awal_agenda, 10");

	while($r_detailagenda = mysql_fetch_array($q_detailagenda)){
		$isi_agenda = strip_tags($r_detailagenda['isi_agenda']);
    	$isi = substr($isi_agenda,0,100); 
		$isi = substr($isi_agenda,0,strrpos($isi," ")); 
		$nama_agenda = $r_detailagenda['tema'];
		if($_GET['agenda']<>'all'){$keterangan = '<tr><td valign="top">Keterangan</td><td valign="top">:</td>
			<td valign="top" style="padding-left:10px;">'.$r_detailagenda['isi_agenda'].'</td></tr>';}
		$detailagenda .= '
			<li>
				<div class="comment_box">
					<div class="comment_content">
						<div class="comment_meta">
							<strong><a href="agenda.php?id='.$r_detailagenda['id_agenda'].'&agenda='.$r_detailagenda['tema'].'">'.$r_detailagenda['tema'].'</a></strong>
						</div>
					</div>
<table cellpadding="1px" cellspacing="0" style="width:100%;padding-left:10px;padding-bottom:10px;" border=0>
<tr><td width="80">Tanggal</td><td width="1">:</td><td style="padding-left:10px;">'.$r_detailagenda['tgl_mulai'].' s/d '.$r_detailagenda['tgl_selesai'].'</td></tr>
<tr><td>Pukul</td><td>:</td><td style="padding-left:10px;">'.$r_detailagenda['jam'].'</td></tr>
<tr><td>Tempat</td><td>:</td><td style="padding-left:10px;">'.$r_detailagenda['tempat'].'</td></tr>
<tr><td>Pengirim</td><td>:</td><td style="padding-left:10px;">'.$r_detailagenda['pengirim'].'</td></tr>
'.$keterangan.'
</table>
					<div class="clear"></div>
				</div>
			</li>';
	}
	
} //--- cek valid agenda ---//
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?='Agenda :: '.$nama_agenda;?></title>
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
			if($count_agenda>0){ ?>
        	<h4><b>Agenda :: </b><span style="font-style:italic;color:#FF6600"><?php if($_GET['agenda']<>'all'){ echo $nama_agenda;}?></span></h4>
            <hr />
				
			<ol class="comment_list">
                <?=str_replace('src="../images/image/', 'src="images/image/', $detailagenda);?>
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