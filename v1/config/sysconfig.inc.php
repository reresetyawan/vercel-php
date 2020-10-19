<?php 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); // mendisable error
error_reporting(E_ALL ^ E_DEPRECATED);

$server		= "202.46.25.44";// "185.28.21.147";
$username	= "ycm";
$password	= "S3mbarang123";
$database	= "ycm";
/*
$server		= "localhost";
$username	= "fuwu";
$password	= "m4k4n4+1";
$database	= "ycm";
*/
//konekasi database MySQL

$conn = mysql_connect($server, $username, $password) or die ('<div style="padding:8px; border:#CC3333 solid 1px; color:#CC3333">Error Connection.</div>');

mysql_select_db($database)or die ('<div style="padding:8px; border:#CC3333 solid 1px; color:#CC3333">Database not found.</div>');

//include('visitorStatistik.php');

?>

<title>Yayasan Caraka Mulia</title>