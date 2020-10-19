<?php
define('DBVISITORSTATISTIK_HOST', '202.46.25.16');
define('DBVISITORSTATISTIK_USERNAME', 'visitor');
define('DBVISITORSTATISTIK_PASSWORD', 'visitor');

define('DBVISITORSTATISTIK_NAME', 'statisticvisitor');
define('DBVISITORSTATISTIK_TABEL', 'visitor_carakamulia');
define('SERVER_VISIT', 'akademik2.wima.ac.id');

//-------------------------------------------------------------------------//
mysql_connect(DBVISITORSTATISTIK_HOST, DBVISITORSTATISTIK_USERNAME, DBVISITORSTATISTIK_PASSWORD)or die('Error Connection');
mysql_select_db(DBVISITORSTATISTIK_NAME);

$ip = $_SERVER['REMOTE_ADDR']; # take user IP
$date = date('Ymd'); # take now date
$time = time(); # take time

# check by IP
if($ip != ''){
	$statistic = mysql_query("SELECT * FROM ".DBVISITORSTATISTIK_TABEL." WHERE ip = '$ip' AND visit_date = '$date' AND server = '".SERVER_VISIT."'");

	if(mysql_num_rows($statistic) == 0){
		mysql_query("INSERT INTO ".DBVISITORSTATISTIK_TABEL." (ip, visit_date, hits, online, server) VALUES ('$ip', '$date', '1', '$time', '".SERVER_VISIT."')");
	}else{
		mysql_query("UPDATE ".DBVISITORSTATISTIK_TABEL." SET hits = hits+1, online = '$time' WHERE visit_date = '$date' AND ip = '$ip' AND server = '".SERVER_VISIT."'");
	}
}
?>