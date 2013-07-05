<?php
require_once'session2.php';
require_once'../config.php';
require_once'../fx.php';
$sub = $_GET['sub'];
$list_name=no_magic_quotes($_POST['list_name']);

$content = $_POST['list_content'];
if( get_magic_quotes_gpc() ){
		$postedValue = htmlspecialchars( stripslashes( $content ) );
	}else{
		$postedValue = htmlspecialchars( $content );
	}


$check=mysql_query("select * from news where news_name='$list_name'");
$num_check=mysql_num_rows($check);

if($num_check !== 1){
	$ins=mysql_query("insert into news(news_content, news_name) values('$postedValue', '$list_name')");
	header('location:sub.php?sub='.$sub.'&ref=added');
}else{
	echo "Sub Page ".$list_name." Already Set";
}

?>