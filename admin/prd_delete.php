<?php
	require_once'session2.php';
	require_once'../config.php';

$sql_prd="select * from product WHERE prd_id='$_GET[id]'";
$query_prd=mysql_query($sql_prd);
$row_prd=mysql_fetch_object($query_prd);

$q = "DELETE FROM product WHERE prd_id='$_GET[id]'";
$result = mysql_query($q);

$del_img="../uploads/images/".$row_prd->prd_img;
$del_tbimg="../uploads/thumbs/".$row_prd->prd_img;
$del_cropimg="../uploads/crop/".$row_prd->prd_img;
	unlink($del_img);
	unlink($del_tbimg);
	unlink($del_cropimg);
	
if($result){
	header('location:view_prd.php?ref=deleted');
}else{
	echo mysql_error();
}


?>