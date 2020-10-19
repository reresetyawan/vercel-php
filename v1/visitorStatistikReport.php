<?php
define('DBVISITORSTATISTIK_HOST', '202.46.25.16');
define('DBVISITORSTATISTIK_USERNAME', 'visitor');
define('DBVISITORSTATISTIK_PASSWORD', 'visitor');

//
define('DBVISITORSTATISTIK_NAME', 'statisticvisitor');
define('DBVISITORSTATISTIK_TABEL', 'visitor_carakamulia');


//-------------------------------------------------------------------------//
mysql_connect(DBVISITORSTATISTIK_HOST, DBVISITORSTATISTIK_USERNAME, DBVISITORSTATISTIK_PASSWORD)or die('Error Connection');
mysql_select_db(DBVISITORSTATISTIK_NAME);

$ip = $_SERVER['REMOTE_ADDR']; # take user IP
$date = date('Ymd'); # take now date
$time = time(); # take time

# check by IP
if($ip != ''){
	$statistic = mysql_query("SELECT * FROM ".DBVISITORSTATISTIK_TABEL." WHERE ip = '$ip' AND visit_date = '$date' ");

	$visitor_today =  mysql_num_rows(mysql_query("SELECT * FROM ".DBVISITORSTATISTIK_TABEL." WHERE visit_date = '$date' GROUP BY ip"));
	$total_visitor =  mysql_result(mysql_query("SELECT COUNT(hits) FROM ".DBVISITORSTATISTIK_TABEL.""), 0);

	//$hits =  mysql_result(mysql_query("SELECT SUM(hits) FROM ".DBVISITORSTATISTIK_TABEL." WHERE visit_date = '$date' GROUP BY visit_date"), 0);
	//$total_hits =  mysql_result(mysql_query("SELECT SUM(hits) FROM ".DBVISITORSTATISTIK_TABEL.""), 0);

	$counter_images =  mysql_result(mysql_query("SELECT SUM(hits) FROM ".DBVISITORSTATISTIK_TABEL.""), 0);
	
	# Who's Online
	$limit_time = time() - 300;
	$who_online = mysql_num_rows(mysql_query("SELECT * FROM ".DBVISITORSTATISTIK_TABEL." WHERE online > '$limit_time'"));
}
?>
<style type="text/css">		
	/*
	Pretty Table Styling
	CSS Tricks also has a nice writeup: http://css-tricks.com/feature-table-design/
	*/
	
	table.visitor_statistic {
		overflow:hidden;
		border:1px solid #d3d3d3;
		background:#fefefe;
		color: #555;
		width:200px;
		/*--- margin:5% auto 0; ---*/
		margin:-20px;		
		-moz-border-radius:5px; /* FF1+ */
		-webkit-border-radius:5px; /* Saf3-4 */
		border-radius:5px;
		-moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
		-webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
	}
	
	table.visitor_statistic th, table.visitor_statistic td {padding:4px; text-align:center; }
	
	table.visitor_statistic th {padding-top:4px; text-shadow: 1px 1px 1px #fff; background:#e8eaeb;}
	
	table.visitor_statistic td {border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0;}
	
	table.visitor_statistic tr.odd-row td {background:#f6f6f6;}
	
	table.visitor_statistic td.first, table.visitor_statistic th.first {text-align:left}
	
	table.visitor_statistic td.last {border-right:none;}
	
	/*
	Background gradients are completely unnessary but a neat effect.
	*/
	
	table.visitor_statistic td {
		background: -moz-linear-gradient(100% 25% 90deg, #fefefe, #f9f9f9);
		background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f9f9f9), to(#fefefe));
	}
	
	table.visitor_statistic tr.odd-row td {
		background: -moz-linear-gradient(100% 25% 90deg, #f6f6f6, #f1f1f1);
		background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f1f1f1), to(#f6f6f6));
	}
	
	table.visitor_statistic th {
		background: -moz-linear-gradient(100% 20% 90deg, #e8eaeb, #ededed);
		background: -webkit-gradient(linear, 0% 0%, 0% 20%, from(#ededed), to(#e8eaeb));
	}
	
	/*
	I know this is annoying, but we need dditional styling so webkit will recognize rounded corners on background elements.
	Nice write up of this issue: http://www.onenaught.com/posts/266/css-inner-elements-breaking-border-radius
	
	And, since we've applied the background colors to td/th element because of IE, Gecko browsers also need it.
	*/
	
	table.visitor_statistic tr:first-child th.first {
		-moz-border-radius-topleft:5px;
		-webkit-border-top-left-radius:5px; /* Saf3-4 */
	}
	
	table.visitor_statistic tr:first-child th.last {
		-moz-border-radius-topright:5px;
		-webkit-border-top-right-radius:5px; /* Saf3-4 */
	}
	
	table.visitor_statistic tr:last-child td.first {
		-moz-border-radius-bottomleft:5px;
		-webkit-border-bottom-left-radius:5px; /* Saf3-4 */
	}
	
	table.visitor_statistic tr:last-child td.last {
		-moz-border-radius-bottomright:5px;
		-webkit-border-bottom-right-radius:5px; /* Saf3-4 */
	}

</style>

<!--// START - Statistik Visitor //-->
<table cellspacing="0" class="visitor_statistic">
<tr><th colspan="2">Visitor Statistik</th></tr>
<tr>
	<td>Visits Today</td>
	<td width='60'><?=$visitor_today;?></td>
</tr>
<tr>
	<td>Total Visits</td>
	<td><?=$total_visitor;?></td>
</tr>
<tr>
    <td>Total Hits</td>
	<td><span><?=$counter_images;?></span></td>
</tr>
<tr><td colspan=2 align="center">We have <?=$who_online;?> guests online.</td></tr>
</table>
<!--// END - Statistik Visitor //-->