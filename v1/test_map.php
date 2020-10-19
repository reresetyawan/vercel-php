<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="http://maps.google.com/maps?file=api&v=2&sensor=true&key=kode-api" type="text/javascript"></script>
</head>

<body>
<div id="map" style="width: 400px; height: 300px"></div>
<script type="text/javascript">
//<![CDATA[
var map = new GMap(document.getElementById("map"));
map.centerAndZoom(new GPoint(107.14433670043945,-6.820761763751254), 7);
map.setUIToDefault();
//]]>
</script>
</body>
</html> 