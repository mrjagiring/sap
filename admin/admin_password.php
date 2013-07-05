<?php
$minUserLevel=10;
include("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
$submit=$_POST[submit];
if($submit){
$ARRAYtgusers=mysqli_fetch_array(mysqli_query($mysqli1,"select * from `tgusers` where `user`='$login'"));
$pass1=$_POST[oldpassword];
$pass2=$_POST[newpassword];
$pass3=$_POST[confirmpassword];
$mdpass1=md5($pass1);
$mdpass2=md5($pass2);
$mdpass3=md5($pass3);
if($ARRAYtgusers[password]!=$mdpass1){
	echo"<table align=center width=500 style=background-color:gray;><tr style=background-color:lightgreen;font-family:arial;font-size:16px;font-weight:bold;><td>Confirmation</td></tr><tr style=font-family:verdana;color:white;font-weight:bold;><td>Failed Change password1&nbsp;<a href=admin_password.php style=color:blue;>BACK </a></td></tr><table>";
	die();
}
if($mdpass2!=$mdpass3){
	echo"<table align=center width=500 style=background-color:gray;><tr style=background-color:lightgreen;font-family:arial;font-size:16px;font-weight:bold;><td>Confirmation</td></tr><tr style=font-family:verdana;color:white;font-weight:bold;><td>Failed Change password2&nbsp;<a href=admin_password.php style=color:blue;>BACK </a></td></tr><table>";
	die();
}
mysqli_query($mysqli1,"update `tgusers` set `password`='$mdpass3' where `user`='$login'");
	echo"<table align=center width=500 style=background-color:gray;><tr style=background-color:lightgreen;font-family:arial;font-size:16px;font-weight:bold;><td>Confirmation</td></tr><tr style=font-family:verdana;color:white;font-weight:bold;><td>Success Change Password<br>please&nbsp;<a href=logoff.php target=_parent style=color:blue;>logout </a></td></tr><table>";
	die();
}
echo"<body bgcolor=$bodybgcolor>";
echo"<table align=center style=background-color:gray;font-family:helvetica;font-weight:bold;color:white;><form method=post><tr><td colspan=2 style=background-color:lightgreen;text-align:center;color:black;font-family:verdana;>Change Password</td></tr><tr><td>Old password</td><td><input type=password name=oldpassword></td><tr></tr><td>New password</td><td><input type=password name=newpassword></td><tr></tr><td>Confirm password</td><td><input type=password name=confirmpassword></td></tr><tr><td colspan=2 style=background-color:lightgreen;text-align:center;font-color:black;font-family:verdana;><input type=submit name=submit value=submit></td></tr></form></table>";
echo"</body>";
?>