<?php
	require_once'session2.php';
	require_once'../config.php';
	
	$sql_prd="select * from product where status='home' order by prd_name ASC";
	$query_prd=mysql_query($sql_prd);
	$row_prd=mysql_fetch_object($query_prd);
	
	$q="select * from product order by prd_name ASC";
	$w=mysql_query($q);
	$e=mysql_fetch_object($w);
	
	$num=mysql_num_rows($query_prd);
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
{	
	$prd_id = $_POST['prd_name'];
	mysql_query("update product set status='home' where prd_id='$prd_id'");
	header ('location:home.php');
	
}
			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin Panel</title>
<link rel="shortcut icon" href="../images/ico.png" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="jquery/jquery-easing.js"></script>
<script type="text/javascript" src="jquery/jquery.cycle.all.js"></script>
<script type="text/javascript">
								
		$(document).ready(function(){
			
			/*$(".parent").toggle(
					function(){
					$(this).next().slideDown();
				},
					function(){
						$(this).next().slideUp();
				}
			);*/
			
		
		});
		
</script>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
	include('header.php');
?>
<div class="clear"></div>
	<div id="wrapper">
		<div id="nav">
		<?php
			include('nav.php');
		?>
		</div><!--nav-->
		<div id="content" style="letter-spacing:2px;">
        	<span style="font-size:28px; color:#227a59; font-weight:bold; font-style:italic;">STI &nbsp;</span><span style="font-size:18px; color:#3c3c3c;">is  an&nbsp;</span><span style="font-size:20px; color:#3c3c3c; font-style:italic; font-weight:bold;"> environmentally  friendly</span><span style="font-size:18px; color:#3c3c3c; font-style:italic;">&nbsp;company </span><span style="font-size:16px; color:#3c3c3c;">&nbsp;and</span> <span style="font-size:16px; color:#3c3c3c;">operates  within  the</span><span style="font-size:19px; color:#3c3c3c; font-weight:bold;"> laws and regulations</span> <span style="font-size:12px; color:#3c3c3c; font-weight:bold;">of</span> <span style="font-size:18px; color:#3c3c3c; font-weight:bold;">Indonesia</span> 
		  <span style="font-size:17px; color:#3c3c3c;">goverment</span> </span> <span style="font-size:15px; color:#3c3c3c;">in promoting</span> <span style="font-size:18px; color:#2fae3e; font-weight:bold; font-style:italic;">green foresty</span> <span style="font-size:16px; color:#3c3c3c;">and</span><span style="font-size:18px; color:#59bd65; font-style:italic;">&nbsp;does not support</span>
		  <p><span style="font-size:18px; color:#3c3c3c; font-style:italic;">any kind of</span> <span style="font-size:18px; color:#116a1c; font-style:italic; font-weight:bold;">activities of illegal logging.</span></p>

		</div><!--content-->
		<div class="clear"></div>
	</div><!--wrapper-->
<script type="text/javascript">
	function remove_product(title){
		var x = confirm("Are You sure want to remove this Product["+title+"]?");
		if(x){
			location.href = "home_remove.php?id=" + title;
		}else{
			return false;
		}
	}
	function home_edit(title){
			location.href = "home_edit.php?id=" + title;
	}
</script>
</body>
</html>