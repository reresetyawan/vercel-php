<? /*
<div style="padding: 3px 10px 3px 10px; background:#4b5b6b; position:relative; width:100px; height:18px; margin-left:700px;">
	<a href="http://sia.pasca.wima.ac.id" style="color:#FFFFFF" target="_blank">Login Akademik</a>
</div>
*/ ?>
<?php 
include('config/sysconfig.inc.php');
$sosial_network = '';
$q_identitas = mysql_query("SELECT facebook, twitter, flickr, skype FROM identitas WHERE id_identitas = 1");
$r_identitas = mysql_fetch_array($q_identitas);

if($r_identitas['facebook']<>''){ 
	$sosial_network .= '<li><a target="_blank" href="'.$r_identitas['facebook'].'"><img src="images/facebook.png" alt="facebook" /></a></li>'; }
if($r_identitas['twitter']<>''){ 
	$sosial_network .= '<li><a target="_blank" href="'.$r_identitas['twitter'].'"><img src="images/twitter.png" alt="twitter" /></a></li>'; }
if($r_identitas['flickr']<>''){ 
	$sosial_network .= '<li><a target="_blank" href="'.$r_identitas['flickr'].'"><img src="images/flickr.png" alt="flickr" /></a></li>'; }
if($r_identitas['skype']<>''){ 
	$sosial_network .= '<li><a target="_blank" href="'.$r_identitas['skype'].'"><img src="images/skype.png" alt="skype" /></a></li>'; }
?>
<div style="margin-top:0px;">
	<div id="site_title"><a href="index.php" rel="nofollow">Yayasan Caraka Mulia</a></div>
	<div id="templatemo_search">
	<form action="categories.php" method="get">
		<input type="text" name="keyword" id="keyword" title="keyword" placeholder="Enter a keyword" 
			onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
		<input type="submit" name="Search" value="SEARCH" alt="Search" id="searchbutton" title="Search" class="sub_btn" />
	</form>
	<ul id="social">
		<!--//
        <li><a target="_blank" href="rss.php"><img src="images/rss.png" alt="RSS" /></a></li> 
        //-->
		<?php echo $sosial_network;?>
	</ul>
	</div>
</div>

<div style="margin:0px;">
	<!-- AddThis Button BEGIN -->
	<div class="addthis_toolbox addthis_floating_style addthis_32x32_style" style="left:50px;top:50px;">
	<a class="addthis_button_preferred_1"></a>
	<a class="addthis_button_preferred_2"></a>
	<a class="addthis_button_preferred_3"></a>
	<a class="addthis_button_preferred_4"></a>
	<a class="addthis_button_compact"></a>
	</div>
	<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51bab8e23c0ba858"></script>
	<!-- AddThis Button END -->
</div>