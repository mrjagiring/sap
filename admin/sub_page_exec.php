<?php
require_once'session2.php';
require_once'../config.php';
require_once'../fx.php';
if(isset($_GET['sub'])){
	$sub=$_GET['sub'];
	$sql_del="delete from sub_page_cont where sub_id='$sub'";
	$del=mysql_query($sql_del);
	$sql_del2="delete from sub_page where sub_id='$sub'";
	$del2=mysql_query($sql_del2);
	header('location:admin.php?ref=deleted');
}else if(isset($_GET['list'])){
	$list=$_GET['list'];
	$sql_del3="delete from news where news_id='$list'";
	$del3=mysql_query($sql_del3);
	header('location:admin.php?ref=deleted');
}else if(isset($_GET['ren']) && isset($_GET['page'])){
	$ren=no_magic_quotes($_GET['ren']);
	$page=$_GET['page'];
	$s_ren="update sub_page set sub_name='$ren' where sub_id='$page'";
	$q_ren=mysql_query($s_ren);
	header('location:sub.php?sub='.$page);
}else if(isset($_GET['ren_ind']) && isset($_GET['page'])){
	$ren=no_magic_quotes($_GET['ren_ind']);
	$page=$_GET['page'];
	$s_ren="update sub_page set sub_nama='$ren' where sub_id='$page'";
	$q_ren=mysql_query($s_ren);
	header('location:sub.php?sub='.$page);
}else{
	header('location:admin.php');
}
?>