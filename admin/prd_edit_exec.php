<?php
	require_once'session2.php';
	require_once'../config.php';

if(isset($_POST['prd_smart_desc'])){
	$prd_smart_desc = $_POST['prd_smart_desc'];
		if( get_magic_quotes_gpc() ){
			$postedValue = htmlspecialchars( stripslashes( $prd_smart_desc ) );
		}else{
			$postedValue = htmlspecialchars( $prd_smart_desc );
		}
	
	$q = "UPDATE product SET prd_smart_desc='$prd_smart_desc' WHERE prd_id='$_GET[id]'";
	$result = mysql_query($q);
	if($result){
		header('location:home.php?ref=edited');
	}else{
		echo mysql_error();
	}
	
}else{	

	
	$prd_category = $_POST[prd_category];
	$prd_name = $_POST[prd_name];
	$prd_desc = $_POST[prd_desc];
	
	if( get_magic_quotes_gpc() ){
			$postedValue = htmlspecialchars( stripslashes( $prd_desc ) );
		}else{
			$postedValue = htmlspecialchars( $prd_desc );
		}

	$last_update = date("Y-m-d h:i:s");

		$q = "UPDATE product SET prd_category='$prd_category', prd_name='$prd_name', prd_full_desc='$prd_desc', prd_full_desc='$postedValue', last_update='$last_update' WHERE prd_id='$_GET[id]'";
		$result = mysql_query($q);
			if($result){
				header('location:view_prd.php?ref=edited');
			}else{
				echo mysql_error();
			}


}

?>