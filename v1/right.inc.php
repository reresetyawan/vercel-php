<?php 
include('config/sysconfig.inc.php');
error_reporting(E_ALL ^ E_DEPRECATED);
$hitung = 0;
$kategori = '';
$agenda = '';
// kategori
$q_kategori = mysql_query("SELECT k.id_kategori, nama_kategori, kategori_seo, count(b.id_kategori) as jml FROM kategori k
	LEFT JOIN berita b ON b.id_kategori = k.id_kategori
	GROUP BY id_kategori ORDER BY nama_kategori");
while($r_kategori = mysql_fetch_array($q_kategori)){
	$hitung += ($r_kategori['jml']);
	$kategori .= '
		<li><a href="categories.php?category='.$r_kategori['kategori_seo'].'">'.$r_kategori['nama_kategori'].' ('.$r_kategori['jml'].')</a></li>';
}
// agenda
$q_agenda = mysql_query("SELECT id_agenda, tema, tema_seo, tema_seo, tgl_mulai FROM agenda ORDER BY tgl_mulai DESC");

while($r_agenda = mysql_fetch_array($q_agenda)){
	$agenda .= '
		<li><em style="font-size:9px">'.$r_agenda['tgl_mulai'].'</em><br>
			<a href="agenda.php?id='.$r_agenda['id_agenda'].'&agenda='.$r_agenda['tema_seo'].'">'.$r_agenda['tema'].'</a></li>';
}
?>
<div class="sidebar_section">
	<h3>Kategori ::</h3>
	<ul class="nobullet sidebar_link">
    	<li><a href="categories.php?category=all">Lihat Semua (<?=$hitung;?>)</a></li>
		<?=$kategori?>
	</ul>
</div>
      
<div class="sidebar_section">
	<h3>Agenda ::</h3>
	<ul class="nobullet sidebar_link">
    	<li><a href="agenda.php?agenda=all">Lihat Semua</a></li>
		<?=$agenda?>
	</ul>
</div>

<div class="sidebar_section">
	<h3>Banner ::</h3>
	<div style="height:1px;border-bottom:2px solid #ddd;margin-bottom:15px;"></div>
<?php //--------------------------------------//
// Tampilkan banner
$banner=mysql_query("SELECT * FROM banner ORDER BY id_banner DESC LIMIT 3");
while($b=mysql_fetch_array($banner)){ echo "
	<p align=center><a href=$b[url] target='_blank' title='$b[judul]'><img src='images/banner/$b[gambar]' border='0'></a></p>";
}
 //--------------------------------------//
?>
</div>

<!--//           
<div class="sidebar_section">
	<h3>Recent Comments</h3>
	<ul class="nobullet sidebar_link rc_comment">
		<li><span>David</span> on <a href="#">Curabitur Mollis Justo</a></li>
		<li><span>James</span> on <a href="#">Aliquam Nisl Ligula</a></li>
		<li><span>Admin</span> on <a href="#">Etiam Varius Lorem</a></li>
		<li><span>Linda</span> on <a href="#">Donec Fringilla Laoreet</a></li>
	</ul>
</div>
//-->