<?php
	require_once'session2.php';
	require_once'../config.php';
	require_once'../fx.php';
$list= $_GET['list'];
$name = $_POST['page_name'];
$content = $_POST['page_content'];
if( get_magic_quotes_gpc() ){
		$postedValue = htmlspecialchars( stripslashes( $content ) );
	}else{
		$postedValue = htmlspecialchars( $content );
	}

$q = "UPDATE news SET news_name='$name', news_content='$postedValue' WHERE news_id='$list'";
$result = mysql_query($q);
if($result){
	header('location:admin.php?ref=edited');
}else{
	echo mysql_error();
}

?>