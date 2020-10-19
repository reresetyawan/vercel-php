<?php
include('config/sysconfig.inc.php');

error_reporting(E_ERROR | E_WARNING | E_PARSE);
$q_identitas = mysql_query("SELECT * FROM identitas WHERE id_identitas = 1");
$r_identitas = mysql_fetch_array($q_identitas);
$page = '';
// halaman
if(!$_GET['page']){$page = 1;}else{$page = $_GET['page'];}
// berita
$count = 0; 
$q_berita = mysql_query("SELECT * FROM berita ORDER BY id_berita DESC");
$count_berita = mysql_num_rows($q_berita);

if($count_berita > 0){
	$count_page = ceil($count_berita/4);
	$awal_berita=($page-1)*4;

	$halaman='<li><a href="?page='.($page-1).'" target="_parent">Prev</a></li>';
	for($i=1;$i<=$count_page;$i++){
		if($i==$page){$halaman.='<li><a class="current" href="?page='.$i.'" target="_parent">'.$i.'</a></li>';
		}else{$halaman.='<li><a href="?page='.$i.'" target="_parent">'.$i.'</a></li>';}
	}
	$halaman.='<li><a href="?page='.($page+1).'" target="_parent" rel="nofollow">Next</a></li>';
	// $halaman.='<li><a href="?page='.$count_page.'" target="_parent" rel="nofollow">Last</a></li>';
	
	$temp_berita = '';
	$q_berita = mysql_query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT ".$awal_berita.", 4");
	while($r_berita = mysql_fetch_array($q_berita)){	
		$isi_berita = strip_tags($r_berita['isi_berita']);
		$isi = substr($isi_berita,0,100); 
		$isi = substr($isi_berita,0,strrpos($isi," ")); 
		$temp_berita .= '
			<div class="news_list" style="border-bottom:dashed #ddd 1px;">
    	        <a href="info.php?page='.$r_berita['judul_seo'].'">'.$r_berita['judul'].'</a>
        	    <p>
				<!--//<font style="font-size:10px"><em>'.$r_berita['tanggal'].' '.$r_berita['jam'].' - Posted by '.$r_berita['username'].' - 
				Dibaca <b>'.$r_berita['dibaca'].'</b> kali</em></font><br>//-->
				'.$isi.'...
				<a href="info.php?page='.$r_berita['judul_seo'].'" class="comment_meta" style="font-style:italic;color:#FF6600">Selengkapnya</a></p>
    	    	<div class="clear"></div>
			</div>';
	}
}
/*
while($r_berita = mysql_fetch_array($q_berita)){
	$count++;
	$isi_berita = strip_tags($r_berita['isi_berita']);
	$isi = substr($isi_berita,0,100); 
	$isi = substr($isi_berita,0,strrpos($isi," ")); 
	if( $count > 4){
		$temp_beritasebelumnya .= '
		<li><a href="info.php?page='.$r_berita['judul_seo'].'">'.$r_berita['judul'].'</a></li>';
	}else{		
		$temp_berita .= '
			<div class="news_list" style="border-bottom:dashed #ddd 1px;">
    	        <a href="info.php?page='.$r_berita['judul_seo'].'">'.$r_berita['judul'].'</a>
        	    <p><font style="font-size:10px"><em>'.$r_berita[tanggal].' '.$r_berita[jam].' - Posted by '.$r_berita[username].' - Dibaca <b>'.$r_berita[dibaca].'</b> kali</em></font><br>
				'.$isi.'...
				<a href="info.php?page='.$r_berita[judul_seo].'" class="comment_meta" style="font-style:italic;color:#FF6600">Selengkapnya</a></p>
    	    	<div class="clear"></div>
			</div>';
	}
}
*/

// banner
$temp_banner = '';
$banner=mysql_query("SELECT * FROM banner ORDER BY id_banner DESC LIMIT 3");
while($b=mysql_fetch_array($banner)){ $temp_banner .= "
	<p align=center><a href=$b[url] target='_blank' title='$b[judul]'><img src='images/banner/$b[gambar]' style=\"width:150px; height:45px;\" border='0'></a></p>";
}

$hitung_kategoriartikel = 0;
// kategori
$temp_kategori = '';
$q_kategori = mysql_query("SELECT k.id_kategori, nama_kategori, kategori_seo, count(b.id_kategori) as jml FROM kategori k
	LEFT JOIN berita b ON b.id_kategori = k.id_kategori
	GROUP BY id_kategori ORDER BY nama_kategori");
while($r_kategori = mysql_fetch_array($q_kategori)){
	$hitung_kategoriartikel += ($r_kategori['jml']);
	$temp_kategori .= '
		<li><a href="categories.php?category='.$r_kategori['kategori_seo'].'">'.$r_kategori['nama_kategori'].' ('.$r_kategori['jml'].')</a></li>';
}

// agenda
$temp_agenda = '';
$q_agenda = mysql_query("SELECT * FROM agenda WHERE tgl_selesai > '".date('Y-m-d')."' ORDER BY id_agenda DESC LIMIT 4");
while($r_agenda = mysql_fetch_array($q_agenda)){
	$temp_agenda .= '
		<li><em style="font-size:11px">'.$r_agenda['tgl_mulai'].'</em>
        	<p style="padding-left:20px; margin-bottom:0;"><a href="agenda.php?id='.$r_agenda['id_agenda'].'&agenda='.$r_agenda['tema_seo'].'">'.$r_agenda['tema'].'</a></em></p>
		</li>';
}

// gallery
$temp_gallery = '';
$q_gallery = mysql_query("SELECT * FROM gallery ORDER BY id_gallery DESC LIMIT 6");
while($r_gallery = mysql_fetch_array($q_gallery)){
	$temp_gallery .= '
		<li><a href="images/gallery/'.$r_gallery['gbr_gallery'].'" class="lightbox" rel="lightbox['.$r_gallery['id_album'].']">
			<img src="images/gallery/small_'.$r_gallery['gbr_gallery'].'" alt="" class="img_border img_border_b" /></a></li>';
}

?>
<!--// homepage - content //-->
<?=str_replace('src="../images/image/', 'src="images/image/', $r_identitas['content']);?>
<!--// homepage - content //-->
    	<div class="content_wrapper">
            
            <div class="col_2">
                <h4>Artikel &amp; Berita ::</h4>
                <hr /><?=$temp_berita;?>
                <div class="clear"></div>
                <!--//                
                <h5>Berita Sebelumnya ::</h5><hr />
                <ul class="nobullet sidebar_link"><? //=$temp_beritasebelumnya;?></ul>
                <div class="clear"><br /></div>
                //-->
				<div class="templatemo_paging">
					<ul>
						<?=$halaman;?>
					</ul>
					<div class="clear"></div>
				</div>
			</div>
            
            <div class="col_4">
                <h4>Agenda ::</h4><hr />
                <ul class="nobullet sidebar_link"><?=$temp_agenda;?></ul>
                <div class="clear"><br /></div>
                <a style="font-style:italic;color:#FF6600" href="agenda.php?agenda=all">Sebelumnya...</a>
			</div>
            
            <div class="col_4 no_margin_right">
                <h4>Kategori ::</h4><hr />
                <ul class="nobullet sidebar_link">
					<li><a href="categories.php?category=all">Semua (<?=$hitung_kategoriartikel;?>)</a></li>
				<?=$temp_kategori;?></ul>
                <div class="clear"><br /><br /></div>
                <h4>Banner ::</h4><hr />
                <?=$temp_banner;?>

			</div>
        </div>
        <div class="clear"></div>
    	<div class="content_wrapper">
            <div class="col_1">
                <h3>Galeri Foto :: <span><a href="photo-album.php" title="Lihat Album" style="font-size:12px; font-style:italic; color:#FF6600;">Lihat Album</a></span></h3>
                <hr />
                <ul class="nobullet latest_work_home">
                	<?=$temp_gallery;?>
                    <!--//
                	 <li><a href="images/gallery/01_l.jpg" class='lightbox' rel="lightbox[portfolio]">
                     	<img src="images/gallery/01.jpg" alt="" class="img_border img_border_b" /></a></li>
                     <li><a href="images/gallery/02_l.jpg" class='lightbox' rel="lightbox[portfolio]">
                     	<img src="images/gallery/02.jpg" alt="" class="img_border img_border_b" /></a></li>
                     <li><a href="images/gallery/03_l.jpg" rel="lightbox[portfolio]">
                     	<img src="images/gallery/03.jpg" alt="" class="img_border img_border_b" /></a></li>
                     <li><a href="images/gallery/04_l.jpg" rel="lightbox[portfolio]">
                     	<img src="images/gallery/04.jpg" alt="" class="img_border img_border_b" /></a></li>
                     //-->
				</ul>
                <div class="clear"></div>
            </div>
            <!--//
            <div class="col_2 no_margin_right">
                <h4>Recent Clients</h4>
                <hr />
                <div class="news_list">
                    <img src="images/templatemo_image_01.jpg" alt="Client 1"  class="img_fl img_border img_border_s" />
                    <a href="#">Cras mi lectus tempus vitae</a>
                    <p>Ut vitae luctus mi. Donec ligula dolor, lobortis ac porttitor sed, aliquam non orci. </p>
                  	<div class="clear"></div>
                </div>           
                <div class="news_list">
                    <img src="images/templatemo_image_02.jpg" alt="Client 2" class="img_fl img_border img_border_s" />
                    <a href="#">Cras dignissim volutpat sem id</a>
                    <p>Donec vitae augue ut sem cursus aliquet rhoncus vel quam.</p>
                  <div class="clear"></div>
                </div>   
                 <div class="news_list">
                    <img src="images/templatemo_image_03.jpg" alt="Client 3" class="img_fl img_border img_border_s" />
                    <a href="#">Sed euismod dolor eu</a>
                    <p>Aliquam erat volutpat. Vestibulum urna libero, fringilla eu faucibus nec, fringilla eget elit.</p>
                    <div class="clear"></div>
                </div>             
                <div class="clear"></div>
                <a href="#" class="more">More</a>
            </div>
            //-->
		</div>