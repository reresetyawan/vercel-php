<!--//
    	<ul class="menu">
        	<li><a class="home" href="index.php"></a></li>
	        <li class="current"><a href="info.php?page=tentang-kami"><span>Tentang Kami</span></a>            	
	            <div><ul>
                	<li><a href="info.php?page=gallery"><span>Gallery</span></a></li>    	            
                    <li><a href="info.php?page=news" class="parent"><span>Artikel</span></a>
        	            <div><ul>
            	            <li><a href="news_detail.php"><span>Sub Item 1.1</span></a></li>
                	        <li><a href="news_detail.php"><span>Sub Item 1.2</span></a></li>
            	            <li><a href="news_detail.php"><span>Sub Item 1.3</span></a></li>
                	        <li><a href="news_detail.php"><span>Sub Item 1.4</span></a></li>
                    	</ul></div>
	                </li>
    	        </ul></div>
        	</li>
	        <li><a href="info.php?page=kursus"><span>Kursus</span></a></li>
	        <li><a href="info.php?page=fasilitas"><span>Fasilitas</span></a></li>
    	    <li><a href="info.php?page=bahasa-budaya"><span>Bahasa &amp; Budaya</span></a></li>
    	    <li class="last"><a href="contact.php"><span>Hubungi Kami</span></a></li>
	    </ul>
-->
<?php
include('config/sysconfig.inc.php');
function get_menu($data, $parent = 0) {
	static $i = 1;
	$tab = str_repeat("\t\t", $i);
	if (isset($data[$parent])) {
		if($parent==0){
			$html = "\n$tab<ul class=\"menu\">";
		}else{
			$html = "\n$tab<div><ul>";
		}
		$i++;
		foreach ($data[$parent] as $v) {
			$child = get_menu($data, $v->id);
			
			// $html .= "\n\t$tab<li>";
			if( ($parent==0) and ($child<>'') ){
				// $temp = 'class = "parent" ';
				$html .= "\n\t$tab<li class='current'>";
			}else{
				//$temp = '';
				$html .= "\n\t$tab<li>";
			}
			// sub menu
			$temp = '';
			if( $child<>'' ){
				$html .= '<a '.$temp.'href="'.$v->url.'" class="parent"><span>'.$v->title.'</span></a>';
			}else{
				$html .= '<a '.$temp.'href="'.$v->url.'"><span>'.$v->title.'</span></a>';			
			}
			
			//icon_logout
			if ($child) {
				$i--;
				$html .= $child;
				$html .= "\n\t$tab";
			}
			$html .= '</li>';
		}
		$html .= "\n$tab</ul>";
		return $html;
	} else {
		return false;
	}
}

$result = mysql_query("SELECT * FROM menu WHERE active = 1 ORDER BY menu_order");
while ($row = mysql_fetch_object($result)) {
	$data[$row->parent_id][] = $row;
}
$menu = get_menu($data);

echo str_replace("<ul class=\"menu\">","<ul class=\"menu\"><li class='home'><a class='home' href='index.php'></a></li>",$menu);

?>
