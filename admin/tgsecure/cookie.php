<?php 
global $mysqli1;
$lastuser = $_COOKIE["lastuser"];
$ipaddr = $_SERVER['REMOTE_ADDR'];
if (strtolower($_SESSION['CAPTCHAString']) != $captcha) {
	


	$message = "WARNING! Validation Key Wrong<script>var timeID = setTimeout(\"top.location = './';\", 5000)</script>";
			session_unset();
			session_destroy();
			include($cfgProgDir . "/interface.php");
			exit;

}


	      if (($entered_login) && ($entered_password)) {
        
		mysqli_query($mysqli1,"INSERT INTO `onlinelog` SET `user`='$login', `date`=now(''), `ipaddr`='$ipaddr', `iphost`='$ipaddr', `site`='$domainname', `lastuser`='$lastuser' ");

mysqli_query($mysqli1,"INSERT INTO `useronline` (`username`, `login`,`ip`,`sess`) VALUES ('$login',now(''),'$ipaddr','".session_id()."')");
	      }
	      $sql_secure = mysqli_query($mysqli1,"SELECT * FROM `useronline` WHERE `username`='$login' order by `login` asc");


if ((!@mysqli_num_rows($sql_secure)) and (!$entered_login)) {
//This is disable the TIMEOUT SESSION
		   mysqli_query($mysqli1,"INSERT INTO `useronline` (`username`, `login`,`ip`,`sess`) VALUES ('$login',now(''),'".$ipaddr."','".session_id()."')");
}
if (@mysqli_num_rows($sql_secure) > 1) {
for ($i=0;$i<@mysqli_num_rows($sql_secure);$i++) {
$sql_data_s = @mysqli_fetch_array($sql_secure);
if (($i+1) == @mysqli_num_rows($sql_secure)) continue;
else mysqli_query($mysqli1,"DELETE FROM `useronline` where `id`='".$sql_data_s["id"]."'");
}
}
$pgp = mysqli_query($mysqli1,"SELECT * FROM `useronline` where `username`='$login' and `sess`='".session_id()."'");
//echo"masuk verify useronline<br>";
	       if (!@mysqli_num_rows($pgp)) {
		   $message = "WARNING! There are some user: \"$login\" online now<script>var timeID = setTimeout(\"top.location = './';\", 5000)</script>";
		   session_unset();
		   session_destroy();
		   include($cfgProgDir . "interface.php");
		   exit;
	       }
//echo"keluar verify useronline<br>";

?>