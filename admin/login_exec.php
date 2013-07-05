<?php
require_once'session.php';
include("../config.php");
require_once'../fx.php';
$user=no_magic_quotes($_POST['user_name']);
$pass=no_magic_quotes($_POST['user_pass']);

if ($_SESSION['CAPTCHAString'] == $_POST['captcha'])
{
		
	$md5pass=md5($pass);
	
	$user=stripslashes($user);
	$user=mysql_real_escape_string($user);
	
	$pass=stripslashes($pass);
	$pass=mysql_real_escape_string($pass);
	
	$sql= "select * from user where user_name='$user' and user_pass='$md5pass'";
	
	$result=mysql_query($sql);
	$row=mysql_num_rows($result);
	
	if($row>0){
	
		$r = mysql_fetch_object($result);
		$_SESSION['logged_in'] = true;
		$_SESSION['pass'] = $md5pass;
		$_SESSION['username'] = $user;
		$_SESSION['usergroup'] = $r->user_group;
		
		header('location:admin.php');
	}else{
		header("location:index.php?ref=denied");	
	}
}else{
	header("location:index.php?ref=captcha");
}

?>