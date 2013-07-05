<?php
	require_once'session.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin Login</title>
<script type="text/javascript" src="../jquery/jquery-1.4.2.min.js"></script>

<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="">
	<div id="form_login">
    	<h3 style="text-align:center;">Admin Login</h3>
		<form action="login_exec.php" method="post" id="">
			<table>
				<tr style="background:none;">
					<td>Username</td>
					<td><input type="text" name="user_name" class="td" id="user_name"/></td>
				</tr>
				<tr style="background:none;">
					<td>Password</td>
					<td><input type="password" name="user_pass" class="td" id="user_pass"/></td>
				</tr>
                <tr style="background:none;">
					<td><img src="captcha/captcha.php?.png" alt="CAPTCHA" /></td>
					<td><input type="text" name="captcha" class="td" id="captcha"/></td>
				</tr>
			</table>
		<input type="submit" name="submit" id="submit" value="Submit"/>
		<p style="font-size:13px; font-style:italic; color:#993300;">
			<?php
				if($_GET['ref'] == 'denied'){
					echo "Incorect Password or Username";
				}else if($_GET['ref'] == 'logout'){
					echo "You have been logged out succesfully!!!!<br />";
					echo "back to <a href=\"http://$web\">$web</a>";
				}else if($_GET['ref'] == 'captcha'){
					echo "String not equal...";
				}else{
				
				}
					
			?>
		</p>
		</form>
	</div>
</div>
<script type="text/javascript">
<!--//
(function($){
	autoMargin_v();
	$(window).resize(function(){
		autoMargin_v();
	});
})(jQuery);

function autoMargin_v(){
	var h = $(document).height()/2 - $("#form_login").height()/2 - 80;
	$("#form_login").animate({"marginTop" : h},200);
}
//-->
</script>
</body>
</html>
