<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); 
include('config/sysconfig.inc.php');

// download
$temp_page = '';
$q_page=mysql_query("SELECT title, url FROM menu WHERE parent_id = 0 AND active = 1 ORDER BY menu_order ");
while($r_page = mysql_fetch_array($q_page)){ 
	$temp_page .= "
    	<li><a href='$r_page[url]'>$r_page[title]</a></li>";
}
// download
$temp_download = '';
$q_download=mysql_query("SELECT nama_file, judul FROM download ORDER BY id_download DESC LIMIT 5");
while($r_download = mysql_fetch_array($q_download)){ 
	$temp_download .= "
    	<li>&bull; <a href='downloads.php?file=$r_download[nama_file]'>$r_download[judul]</a></li>";
}
?>
		<div class="col_4">
        	<h4>Halaman</h4>
            <ul class="nobullet bottom_list"><?=$temp_page;?></ul>
        </div>
        
        <!--/
        <div class="col_4">
        	<h4>Partners</h4>
            <ul class="nobullet bottom_list">
                <li><a href="#">Morbi eget lacus sem</a></li>
                <li><a href="#">Vivamus dolor dolor</a></li>
                <li><a href="#">Nunc auctor viverra</a></li>
                <li><a href="#">Phasellus eget blandit</a></li>
                <li><a href="#">Sed id tincidunt ipsum</a></li>
            </ul>
        </div>
        /-->
        <div class="col_4">
        	<h4>Download</h4>
            <ul class="nobullet bottom_list">
            <?=$temp_download;?>
	    	<li><a href='downloads.php'><em style="font-style:italic;color:#FF6600">Lihat Semua</em></a></li>
            </ul>
        </div>
        
        <div class="col_4">
        	<h4>&nbsp;</h4>
        </div>
        
        <div class="col_4 no_margin_right">
        <?php //include('visitorstatistik.php');?>
        <div class="clear"></div>
        </div>
        
        
        
		<div id="templatemo_copyright_wrapper">
		    <div id="templatemo_copyright">
        		Copyright &copy; 2013 <a href="http://reresetyawan.wordpress.com" rel="nofollow">Ire Solution</a> | Carakamulia. All rights reserved.
		    </div>
		</div>