<?php
	require_once'session2.php';
	require_once'../config.php';
	require_once'../fx.php';
	
	
$cate_name = $_POST[cate_name];
if ($cate_name == "" || $cateimg == "" )
{
	?>
      <script type="text/javascript">
      window.history.back()
      </script>
<?php
} else {
$q="select * from category where cate_name='$cate_name'";
$w=mysql_query($q);
$e=mysql_fetch_object($w);
$num_prd = mysql_num_rows($w);
	
if( get_magic_quotes_gpc() ){
		$postedValue = htmlspecialchars( stripslashes( $desc ) );
	}else{
		$postedValue = htmlspecialchars( $desc );
	}

$f_name = $_FILES['cateimg']['name'];
$f_tmp = $_FILES['cateimg']['tmp_name'];

$dir = '../uploads/images/';
$thumb_dir ='../uploads/thumbs/';

if(!is_dir($dir)){
mkdir($dir, 0777, true);
}
if(!is_dir($thumb_dir)){
mkdir($thumb_dir, 0777, true);
}


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

if($num_prd < 1){
	
	$entry_date = date("Y-m-d h:i:s");
	$q = "INSERT INTO category (cate_img, cate_name, entry_date) VALUES('$photo','$cate_name','$entry_date')";
	$result = mysql_query($q);
	if($result){
		header('location:product.php?ref=added');
	}else{
		echo mysql_error();
	}

}else{
	header('location:prd_add.php?ref=ada');
}
	}
?>