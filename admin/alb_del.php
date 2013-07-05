<?php
require_once'session2.php';
require_once'../config.php';
require_once'../fx.php';

$alb = $_GET['album'];
$alias = no_space($_GET['album']);



if(isset($alb)){
	$x=mysql_fetch_object(mysql_query("select * from gallery_img where gal_alias='$alias'"));
	do{
		unlink("../uploads/images/".$x->img);
		unlink("../uploads/thumbs/".$x->img);
		$b=mysql_query("delete from gallery_img where img='".$x->img."'");
	}while($x=mysql_fetch_object(mysql_query("select * from gallery_img where gal_alias='$alias'")));

	$a=mysql_query("delete from gallery where gal_alias='$alias'");

	header ('location:gallery.php?ref=deleted');
}else{
	echo mysql_error();
}

?>