<?php
	require_once'session2.php';
	require_once'../config.php';

$sql_prd="select * from product WHERE prd_id='$_GET[id]'";
$query_prd=mysql_query($sql_prd);
$row_prd=mysql_fetch_object($query_prd);

$q = "UPDATE product SET status='' WHERE prd_id='$_GET[id]'";
$result = mysql_query($q);

$del_cropimg="../uploads/crop/".$row_prd->prd_img;
	unlink($del_cropimg);
	
if($result){
	header('location:home.php?ref=removed');
}else{
	echo mysql_error();
}


?>