<?php
include("../config.php");
require_once'session2.php';

$oldpass = $_POST['oldpass'];
$newpass = $_POST['newpass'];
$retype = $_POST['retype'];
$md5old = md5($oldpass);
$md5new = md5($newpass);

$sql= "select * from user where user_name='$_SESSION[username]'";
$result=mysql_query($sql);
$view=mysql_fetch_object($result);

if($md5old == $view->user_pass){
	if($newpass == $retype){
		$sql= "update user set user_pass='$md5new' where user_id='$view->user_id'";
		$result=mysql_query($sql);
		header('location:new_pass.php?ref=edited');
	}else{
		header('location:new_pass.php?ref=notmatch');
	}
}else{
	header('location:new_pass.php?ref=wrong');
}

?>