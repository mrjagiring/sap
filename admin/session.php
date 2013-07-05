<?php
	session_start();
	include("../config.php");
	$q=mysql_query("select * from user where user_name='admin'");
	$r=mysql_fetch_object($q);
	if(isset($_SESSION['logged_in'])){
		if($_SESSION['pass'] == $r->user_pass){
			header('location:admin.php');
		}
	}else{
	
	}
?>