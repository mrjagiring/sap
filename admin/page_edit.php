<?php
	require_once'session2.php';
	require_once'../config.php';

$content = $_POST['page_content'];

$alias = strtolower($_POST['page_alias']);
if( get_magic_quotes_gpc() ){
		$postedValue = htmlspecialchars( stripslashes( $content ) );
	}else{
		$postedValue = htmlspecialchars( $content );
	}
	

$posted_by = $_SESSION['username'];
$entry_date = date("Y-m-d h:i:s");


$q = "UPDATE page SET page_cont='$postedValue', posted_by='$posted_by',last_update='$entry_date' WHERE page_id='$_GET[id]'";
$result = mysql_query($q);
if($result){
	header('location:page.php?ref=edited');
}else{
	echo mysql_error();
}


?>