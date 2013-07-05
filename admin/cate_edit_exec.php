<?php
	require_once'session2.php';
	require_once'../config.php';

	$cate_name = $_POST[cate_name];
	
	$last_update = date("Y-m-d h:i:s");

		$q = "UPDATE category SET cate_name='$cate_name' ,last_update='$last_update' WHERE cate_id='$_GET[id]'";
		$result = mysql_query($q);
			if($result){
				header('location:product.php?ref=edited');
			}else{
				echo mysql_error();
			}


?>