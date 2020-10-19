<?php error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); 
include('config/sysconfig.inc.php');
//--- Indentitas Website ---//
$q_identitas = mysql_query("SELECT * FROM identitas WHERE id_identitas = 1");
$r_identitas = mysql_fetch_array($q_identitas);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Hubungi Kami</title>
    <link rel="icon" href="favicon.png" type="image/png" sizes="16x16"> 
	<meta name="keywords" content="<?=$r_identitas[meta_keyword]?>" />
	<meta name="description" content="<?=$r_identitas[meta_deskripsi]?>" />

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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50623546-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>

<div id="templatemo_wrapper">
	<div id="templatemo_header">
    	<?php include('header.inc.php');?>
    </div> <!-- END of header -->
    
	<div id="menu">
    	<?php include('menu.inc.php');?>
    </div><!--// menu -->
    
    <!--div style="width:980px; height:320px; background:#CCC"></div-->

<iframe width="980" height="320" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=%3BCbF3WFzP215ZFc3fkP8dFkG4Bg&q=-7.282739335776026,112.7385824918747&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=50.777825,93.076172&amp;ie=UTF8&amp;t=m&amp;z=14&amp;iwloc=A&amp;ll=-7.282739,112.738582&amp;output=embed"></iframe><br />
<small style="position:absolute; padding-left:10px;"><a target="_blank" href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=%3BCbF3WFzP215ZFc3fkP8dFkG4Bg&q=-7.282739335776026,112.7385824918747&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=50.777825,93.076172&amp;ie=UTF8&amp;t=m&amp;z=14&amp;iwloc=A&amp;ll=-7.282739,112.738582" style="color:#0000FF;text-align:left">View Larger Map</a></small>

<https://maps.google.com/maps?f=d&source=s_d&saddr=Yayasan+Caraka+Mulia+%40-7.282704,112.738654&daddr=&geocode=FfDfkP8dXkG4Bg&sll=-7.282704,112.738654&sspn=0.001958,0.00284&vpsrc=6&t=h&hl=en&mra=ls&ie=UTF8&ll=-7.282636,112.738644&spn=0.001958,0.00284&z=19&iwloc=ddw0>
    <div id="templatemo_main">
			<h2>Contact Us</h2>
            <div id="contact_form" class="col_2">
                <h3>Send us a message...</h3>
                <form method="post" name="contact" action="#">
                    <div class="col_4">
                        <label for="author">Name:</label>
                        <input name="author" type="text" class="required input_field" id="author" maxlength="30" />
                    </div>
                    <div class="col_4 no_margin_right">
                        <label for="subject">Email:</label>
                        <input name="email" type="text" class="validate-email required input_field" id="email" maxlength="30" />
                    </div>
                    <div class="clear h10"></div>
                    <div class="col_4 left">
                        <label for="author">Phone:</label>
                        <input name="author" type="text" class="required input_field" id="author" maxlength="20" />
                    </div>
                    <div class="col_4 no_margin_right">
                        <label for="subject">Subject:</label>
                        <input name="subject" type="text" class="validate-email required input_field" id="subject" maxlength="40" />
                    </div>
                    <div class="clear"></div>
                    <label for="text">Message:</label> <textarea id="text" name="text" rows="0" cols="0" class="required"></textarea>
                    <input type="submit" name="Submit" value="Submit" class="submit_btn left" />
                    <input type="reset" name="Reset" value="Reset" class="submit_btn right" />
                </form>
            </div> 
            <div class="col_2 no_margin_right">
                <div class="col_4">
<?php //======================================================
$q_identitas = mysql_query("SELECT contact_page FROM identitas WHERE id_identitas = 1");
$r_identitas = mysql_fetch_array($q_identitas);

echo str_replace('src="../images/image/', 'src="images/image/', $r_identitas['contact_page']);
//====================================================== ?>
<? /*
                    <h3>Office One</h3>
                    330-660 Nullam lacus diam,<br />
                  	Pulvinar sit amet, 13560<br />
                	Lorem ipsum<br /><br />
                    
                    Tel: 090-020-9922<br />
                    Fax: 090-020-2299<br /><br />
                    
                    Validate <a href="http://validator.w3.org/check?uri=referer" rel="nofollow">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer" rel="nofollow">CSS</a></div>
                <div class="col_4 no_margin_right">
                    <h3>Office Two</h3>
                  	440-550 Donec vitae dui,<br />
                  	Duis gravida,  12840<br />
                	Pellentesque<br /><br />
                    
                    Tel: 080-010-1188<br />
                    Fax: 080-010-8811 

*/ ?>
                </div>
            </div>
        <div class="clear"></div>
    </div> <!-- END of templatemo_main -->

	<div id="templatemo_footer">
    	<?php include('footer.inc.php');?>
    </div> <!-- END of templatemo_footer -->
</div> <!-- END of templatemo_wrapper -->	

</body>
</html>