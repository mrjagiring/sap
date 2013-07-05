<?php
	require_once'session2.php';
	require_once'../config.php';
	require_once'../fx.php';
	$name =no_magic_quotes($_POST['list_name']);
	$nama =no_magic_quotes($_POST['list_nama']);

		$x = mysql_query("select * from sub_page where sub_name='$name' or sub_nama='$nama'");
		$num_x=mysql_num_rows($x);
		if($num_x == 0){
			$query = mysql_query("insert into sub_page(sub_name, sub_nama) values('$name', '$nama')");
			header('location:add_sub_page.php?ref=added');
		}else{
			header('location:add_sub_page.php?ref=ada');
		}
?>