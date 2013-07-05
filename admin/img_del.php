<?php
require_once'session2.php';
require_once'../config.php';
require_once'../fx.php';

$id = $_GET['id'];

if(isset($id)){
	$x=mysql_fetch_object(mysql_query("select * from gallery_img where id='$id'"));
		unlink("../uploads/images/".$x->img);
		unlink("../uploads/thumbs/".$x->img);
	$b=mysql_query("delete from gallery_img where id='$id'");

	header ('location:gallery.php?album='.$x->gal_alias);
}else{
	echo mysql_error();
}

?>