<?php
require_once'session2.php';
require_once'../config.php';
require_once'../fx.php';

$alb = $_GET['album'];
$alias = no_space($_GET['album']);

if(isset($alb)){
mysql_query("insert into gallery(gal_album, gal_alias) values('$alb', '$alias')");
header ('location:gallery.php?ref=added');
}else{
	echo mysql_error();
}

?>