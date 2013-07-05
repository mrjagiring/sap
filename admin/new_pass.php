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
		<div id="content">
        
        <?php
			if(isset($_GET[ref])){
				if($_GET[ref] == "edited"){
					echo "<h3>Reseted Successfully</h3>";
				}elseif($_GET[ref] == "notmatch"){
					echo "<h3>New Pass not equal to Retype</h3>";
				}elseif($_GET[ref] == "wrong"){
					echo "<h3>Wrong Old Pass</h3>";
				}else{

				}
				
			}else{		
		?>
        	<div id="form_login">
            <h3>Reset Password</h3>
        	<form action="new_pass_exec.php" method="post">
            	<table>
                	<tr style="background:none;">
                    	<td>Old Pass :</td>
                        <td><input type="password" name="oldpass" id="oldpass" /></td>
                    </tr>
                    <tr style="background:none;">
                    	<td>New Pass :</td>
                        <td><input type="password" name="newpass" id="newpass" /></td>
                    </tr>
                    <tr style="background:none;">
                    	<td>Re-Type :</td>
                        <td><input type="password" name="retype" id="retype" /></td>
                    </tr>
                </table>
                <input type="submit" name="" value="Save" /></p>
            </form>
            </div>
         <?php
		 	}
		 ?>
		</div><!--content-->
		<div class="clear"></div>
	</div><!--wrapper-->

</body>
</html>