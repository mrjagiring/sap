<?php
	require_once'session2.php';
	require_once'../config.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin Panel</title>
<link rel="shortcut icon" href="../images/ico.png" />
<script type="text/javascript" src="jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="jquery/jquery-easing.js"></script>
<script type="text/javascript" src="jquery/jquery.cycle.all.js"></script>
<script type="text/javascript">
								
/*		$(document).ready(function(){
			
			$(".parent").toggle(
					function(){
					$(this).next().slideUp();
				},
					function(){
					$(this).next().slideDown();
				}
			);
			
		
		});*/
		
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
		<div id="content">
        <?php
		if(isset($_GET['ref'])){
			if($_GET['ref'] == "added" || $_GET['ref'] == "edited"){
				echo "Your Page Have been Updated";
			}else if($_GET['ref'] == "deleted"){
				echo "Your Page Have been Deleted";
			}
		}else{
		?>
        	<div id="wp_home">
                <h1>Selamat Datang di Admin Panel</h3>
                <h3><a href="http://<?php echo $web;?>/" target="_blank" >http://<?php echo $web;?></a></h1>
                <p><img src="../images/logo.jpg" alt="" /></p>
            </div>
        <?php
		}
		?>
		</div><!--content-->
		<div class="clear"></div>
	</div><!--wrapper-->

</body>
</html>