<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Full News, Secured Theme</title>
<meta name="keywords" content="" />
<meta name="description" content="" />

    <!--// menu -->
    <link type="text/css" href="css/menu/menu.css" rel="stylesheet" />
    <script type="text/javascript" src="js/menu/jquery.js"></script>
    <script type="text/javascript" src="js/menu/menu.js"></script>
    <!--// menu - end -->
    
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery-ui.min.js" ></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#featured > ul").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	});
</script>

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/ddsmoothmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "templatemo_menu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}

</script>

<link rel="stylesheet" href="css/slimbox2.css" type="text/css" media="screen" /> 
<script type="text/JavaScript" src="js/slimbox2.js"></script> 


</head>
<body>

<div id="templatemo_wrapper">
	<div id="templatemo_header">
    	<?php include('header.inc.php');?>
    </div> <!-- END of header -->
    
	<div id="menu">
    	<?php include('menu.inc.php');?>
    </div><!--// menu -->

    <div id="templatemo_main">
        <div id="templatemo_content" class="left">
            <div class="post">
                <img src="images/news/01.jpg" alt="image 1" class="img_fl img_border img_border_b" />
                <div>Posted by <a href="#">Walter</a> in <a href="#">Technology</a></div>
                <h2>Lorem Ipsum Dolor Sit Amet Consectetur</h2>
                <p>Validate <a href="http://validator.w3.org/check?uri=referer" rel="nofollow">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer" rel="nofollow">CSS</a>. Morbi venenatis augue sit amet ante facilisis feugiat sed in lectus. Vivamus imperdiet, ante a pretium vehicula, ante enim sodales mi, eu rutrum odio turpis eget arcu. Proin a elit nisl, id aliquam felis. Nunc ultrices iaculis quam, sed commodo erat tempus mollis. Duis ultricies nulla sed dolor egestas id.</p>
                <p align="justify">Etiam nec turpis bibendum massa dapibus dictum. Donec eu odio sapien. Donec tincidunt eleifend mauris, ac volutpat leo tincidunt a. Aenean vel vehicula augue. Vestibulum lectus sem, porttitor non molestie quis, pulvinar nec nulla. Maecenas id orci vitae lectus fermentum posuere. <a href="#">Phasellus</a> lacinia eleifend elit, eu mollis erat consectetur et.</p>
                <p align="justify">Vestibulum at lorem ac lectus rhoncus aliquet eget ac mauris. Proin nec nunc magna, eu blandit massa. Sed elementum nisi ut quam vehicula eu egestas nisi varius. <a href="#">Aenean semper</a> convallis mi eu congue. In vel neque orci. Nunc vitae luctus ligula. Etiam vulputate semper lorem quis gravida. Donec nec aliquam ipsum.</p>
</div>	
            <ol class="comment_list">
            <li>
                <div class="comment_box">
                    <img src="images/avator.jpg" alt="person 1" class="img_fl img_border" />
                    <div class="comment_content">
                        <div class="comment_meta"><strong><a href="#">Belle</a></strong> 20 October 2072 (9:45 pm)</div>
                        <p>Donec odio leo, rhoncus mattis sodales vitae, tempor ac nibh. Donec vel nibh vitae massa semper auctor. Pellentesque fringilla condimentum massa ac fermentum.</p>
                        <a href="#" class="more">Reply</a>
                    </div>
                    <div class="clear"></div>
                </div>
            </li>
            <li>
                <ul>
                    <li class="depth_2">
                        <div class="comment_box">
                            <img src="images/avator.jpg" alt="person 2" class="img_fl img_border" />
                            <div class="comment_content">
                            <div class="comment_meta"><strong><a href="#">George</a></strong> 21 October 2072 (10:22 am)</div>
                            <p>Vestibulum placerat purus vitae risus pretium lobortis in ac lacus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                            <a href="#" class="more">Reply</a>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </li>
                    <ul>
                        <li class="depth_3">
                            <div class="comment_box">
                                <img src="images/avator.jpg" alt="person 3" class="img_fl img_border" />
                                <div class="comment_content">
                                <div class="comment_meta"><strong><a href="#">Anthony</a></strong> 22 October 2072 (11:15 pm)</div>
                                <p>Pellentesque ut diam vehicula, mattis nisi at, convallis neque. Curabitur non faucibus ante.  Vestibulum enim turpis, faucibus sed varius nec, tincidunt a leo. </p>
                                <a href="#" class="more">Reply</a>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </li>
                    </ul>
                </ul>
            </li>
            <li>
                <div class="comment_box">
                    <img src="images/avator.jpg" alt="person 4" class="img_fl img_border" />
                    <div class="comment_content">
                        <div class="comment_meta"><strong><a href="#">Stella</a></strong> 23 October 2072 (12:08 am)</div>
                        <p>Integer ut tortor ut ipsum mattis iaculis vel eget sapien. Donec odio leo, rhoncus mattis sodales vitae, tempor ac nibh. Donec vel nibh vitae massa semper auctor.</p>
                        <a href="#" class="more">Reply</a>
                    </div>
                    <div class="clear"></div>
                </div>
            </li>
            <li>
                <div class="comment_box">
                    <img src="images/avator.jpg" alt="person 5" class="img_fl img_border" />
                    <div class="comment_content">
                        <div class="comment_meta"><strong><a href="#">Ronald</a></strong> 24 October 2072 (8:22 pm)</div>
                        <p>Sed in urna sed dui ultrices vulputate ac ut odio. Donec luctus, odio et vulputate auctor, arcu arcu hendrerit justo, sed lacinia ligula ligula nec nulla.</p>
                        <a href="#" class="more">Reply</a>
                    </div>
                    <div class="clear"></div>
                </div>
            </li>
        </ol>
        
        <div class="clear"></div>
            
            <div class="templatemo_paging">
                <ul>
                    <li><a href="#" target="_parent">Previous</a></li>
                    <li><a href="#" target="_parent">1</a></li>
                    <li><a href="#" target="_parent">2</a></li>
                    <li><a href="#" target="_parent">3</a></li>
                    <li><a href="http://www.templatemo.com/page/4" target="_parent" rel="nofollow">4</a></li>
                    <li><a href="http://www.templatemo.com/page/5" target="_parent" rel="nofollow">5</a></li>
                    <li><a href="http://www.templatemo.com/page/6" target="_parent" rel="nofollow">6</a></li>
                    <li><a href="http://www.templatemo.com/page/7" target="_parent" rel="nofollow">7</a></li>
                    <li><a href="http://www.templatemo.com/page/8" target="_parent" rel="nofollow">8</a></li>
                    <li><a href="http://www.templatemo.com/page/9" target="_parent" rel="nofollow">Next</a></li>
                </ul>
                <div class="clear"></div>
            </div>
            
            <hr />
            
            <div id="comment_form">
            <h3>Leave your comment</h3>
            
            <form action="#" method="post">
                <label>Name (* required )</label>
                <input type="text" name="name" class="input_field" />
                <label>Email  (* required but it will not be published )</label>
                <input type="text" name="name" class="input_field" />
                <label>Comment</label>
                <textarea  name="comment" rows="" cols=""></textarea>
                <input type="submit" name="Submit" value="Submit" class="submit_btn" />
            </form>

        </div>
		</div>
        <div id="templatemo_sidebar" class="right">
       		<div class="sidebar_section">
                <h3>Categories</h3>
                <ul class="nobullet sidebar_link">
                    <li><a href="#">Fusce egestas metus</a></li>
                    <li><a href="#">Eget lementum</a></li>
                    <li><a href="#">Justo lacinia</a></li>
                    <li><a href="#">Aenean tincidunt</a></li>
                    <li><a href="#">Sed ipsum erat</a></li>
                    <li><a href="#">Dignissim non</a></li>
                    <li><a href="#">Proin pretium</a></li>
                </ul>
            </div>
            
           
            <div class="sidebar_section">
                <h3>Recent Comments</h3>
                <ul class="nobullet sidebar_link rc_comment">
                    <li><span>David</span> on <a href="#">Curabitur Mollis Justo</a></li>
                    <li><span>James</span> on <a href="#">Aliquam Nisl Ligula</a></li>
                    <li><span>Admin</span> on <a href="#">Etiam Varius Lorem</a></li>
                    <li><span>Linda</span> on <a href="#">Donec Fringilla Laoreet</a></li>
                </ul>
        	</div>		
        </div>
        <div class="clear"></div>
    </div> <!-- END of templatemo_main -->

	<div id="templatemo_footer">
    	<?php include('footer.inc.php');?>
		<div id="templatemo_copyright_wrapper">
		    <div id="templatemo_copyright">
        		Copyright © 2013 <a href="http://reresetyawan.wordpress.com" rel="nofollow">Ire Solution</a> | Yayasan Caraka Mulia. All rights reserved.
		    </div>
		</div>
    </div> <!-- END of templatemo_footer -->
</div> <!-- END of templatemo_wrapper -->	

</body>
</html>