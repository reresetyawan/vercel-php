<ol class="comment_list">
	<li>
		<div class="comment_box">
<?php //======================================================
//include('config/sysconfig.inc.php');

$q_identitas = mysql_query("SELECT contact_page FROM identitas WHERE id_identitas = 1");
$r_identitas = mysql_fetch_array($q_identitas);

echo $r_identitas['contact_page'];
/*---
<img src="images/avator.jpg" alt="person 1" class="img_fl img_border" />
<div class="comment_content">
	<div class="comment_meta"><strong><a href="#">Belle</a></strong> 20 October 2072 (9:45 pm)</div>
	<p>Donec odio leo, rhoncus mattis sodales vitae, tempor ac nibh. 
    Donec vel nibh vitae massa semper auctor.
    Pellentesque fringilla condimentum massa ac fermentum.</p>
</div>
---*/
//====================================================== ?>
			<div class="clear"></div>
		</div>
	</li>
</ol>        
<div class="clear"></div>
