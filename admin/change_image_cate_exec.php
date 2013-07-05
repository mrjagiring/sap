<?php
	require_once'session2.php';
	require_once'../config.php';
	
	$sql_cate="select * from category where cate_id='$_GET[id]'";
	$query_cate=mysql_query($sql_cate);
	$row_cate=mysql_fetch_object($query_cate);
	
	$del_img="../uploads/images/".$row_cate->cate_img;
	$del_tbimg="../uploads/thumbs/".$row_cate->cate_img;
	if(is_file($del_img)){
	unlink($del_img);
	unlink($del_tbimg);
	}

if($_FILES['cate_img'] !== ""){
	$f_name = $_FILES['cate_img']['name'];
	$f_tmp = $_FILES['cate_img']['tmp_name'];
	
	$dir = '../uploads/images/';
	$thumb_dir ='../uploads/thumbs/';
	
	$path = $dir . $f_name;
	if(is_uploaded_file($f_tmp)){
		if(is_file($path)){
		$path = $dir . time(). '-' .$f_name;
		}

	move_uploaded_file($f_tmp, $path);

	list($w, $h) = getimagesize($path);
	$f_arr = pathinfo($path);
	$ext = strtolower($f_arr['extension']);
	
	$w_scale = 150;
	$h_scale = 150;
	
		if($w > $h){
			$h_scale = ($h*$w_scale)/$w;
		}else{
			$w_scale = ($w*$h_scale)/$h;	
		}
		
	$thumb = imagecreatetruecolor($w_scale, $h_scale);
	
		if($ext == "jpg" || $ext == "jpeg"){
		$source = imagecreatefromjpeg($path);
		}else if($ext == "png"){
		imagealphablending($thumb, false);
		$source = imagecreatefrompng($path);
		}else if($ext == "gif"){
		$source = imagecreatefromgif($path);
		}
	
	imagecopyresized($thumb, $source, 0, 0, 0, 0, $w_scale, $h_scale, $w, $h);
	
		if($ext == "jpg" || $ext == "jpeg"){
		imagejpeg($thumb, $thumb_dir.basename($path));
		}else if($ext == "png"){
		imagepng($thumb, $thumb_dir.basename($path));
		}else if($ext == "gif"){
		imagegif($thumb, $thumb_dir.basename($path));
		}
	
	$photo=basename($path);
	imagedestroy($thumb);
	imagedestroy($source);
	
	
	}else{
	
	}
	
	$up_date = date("Y-m-d h:i:s");
	$q = "UPDATE category SET cate_img='$photo', last_update='$up_date' WHERE cate_id='$_GET[id]'";
	$result = mysql_query($q);

	if($result){
		header('location:change_image_cate.php?id='.$_GET['id']);
	}else{
		echo mysql_error();
	}
}
?>