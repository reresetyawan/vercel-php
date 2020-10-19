<?php
$ip = $_SERVER['REMOTE_ADDR']; # take user IP
if( substr($ip, 0, 8)=='192.168.'){
	echo 'keluar sana...';

}
echo substr($ip, 0, 8);
echo '<br/>'.$ip;
?>

<form action="http://www.google.com" id="cse-search-box" target="_blank">
  <div id="searchContainer">
    <input type="hidden" name="cx" value="partner-pub-7723832957026361:1381342179" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="text" name="q" size="55" />
    <input type="submit" name="sa" value="Search" />
  </div>
</form>

<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=in"></script>
