<?php
	require_once'session2.php';
	require_once'../config.php';
	
$gal_title = $_POST['gal_title'];

if($_FILES['gal_img'] !== ""){
	$f_name = $_FILES['gal_img']['name'];
	$f_tmp = $_FILES['gal_img']['tmp_name'];
	
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
	

	$q = "INSERT INTO gallery_img(gal_alias,img,title) VALUES('$_GET[album]','$photo','$gal_title')";
	$result = mysql_query($q);

	if($result){
		header('location:add_alb_img.php?ref=added');
	}else{
		echo mysql_error();
	}
}
?>