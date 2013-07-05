<?php
	require_once'session2.php';
	require_once'../config.php';

$sql_cate="select * from category WHERE cate_id='$_GET[id]'";
$query_cate=mysql_query($sql_cate);
$row_cate=mysql_fetch_object($query_cate);

$q = "DELETE FROM category WHERE cate_id='$_GET[id]'";
$result = mysql_query($q);

$del_img="../uploads/images/".$row_cate->cate_img;
$del_tbimg="../uploads/thumbs/".$row_cate->cate_img;
$del_cropimg="../uploads/crop/".$row_cate->cate_img;
	unlink($del_img);
	unlink($del_tbimg);
	unlink($del_cropimg);
	
if($result){
	header('location:product.php?ref=deleted');
}else{
	echo mysql_error();
}


?>