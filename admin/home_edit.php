<?php
	require_once'session2.php';
	require_once'../config.php';
	$sql_prd="select * from product where prd_id='$_GET[id]'";
	$query_prd=mysql_query($sql_prd);
	$row_prd=mysql_fetch_object($query_prd);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{	
	$targ_w = $targ_h = 186;
	$jpeg_quality = 90;
	
	
	$src = '../uploads/images/'.$row_prd->prd_img;
	list($width, $height) = getimagesize("../uploads/images/$row_prd->prd_img");
	if($width > 400){
		$ratio = $width/400;
		$x = $_POST['x']*$ratio;
		$y = $_POST['y']*$ratio;
		$w = $_POST['w']*$ratio;
		$h = $_POST['h']*$ratio;
	}else{
		$x = $_POST['x'];
		$y = $_POST['y'];
		$w = $_POST['w'];
		$h = $_POST['h'];
	}
	
	$f_arr = pathinfo($src);
	$ext = strtolower($f_arr['extension']);
	
	if($ext == "jpg" || $ext == "jpeg"){
	$img_r = imagecreatefromjpeg($src);
	}else if($ext == "png"){
	imagealphablending($thumb, false);
	$img_r = imagecreatefrompng($src);
	}else if($ext == "gif"){
	$img_r = imagecreatefromgif($src);
	}
	
	$dst_r = imagecreatetruecolor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,$x,$y,
	$targ_w,$targ_h,$w,$h);

	header('Content-type: image/jpeg');
	imagejpeg($dst_r,'../uploads/crop/'.basename($src),$jpeg_quality);
	header ('location:home_edit.php?id='.$row_prd->prd_id);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="jquery/jquery-easing.js"></script>
<script type="text/javascript" src="jquery/jquery.cycle.all.js"></script>
<script src="../jquery/jquery.Jcrop.min.js"></script>
<link rel="stylesheet" href="../css/jquery.Jcrop.css" type="text/css" />

<script type="text/javascript">
		$(document).ready(function(){
			$(".parent").toggle(
					function(){
					$(this).next().slideDown();
				},
					function(){
						$(this).next().slideUp();
				}
			);
		});
		
		
		$(function(){
				$('#cropbox').Jcrop({
					aspectRatio: 1,
					onSelect: updateCoords
				});

			});

			function updateCoords(c)
			{
				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);
			};

			function checkCoords()
			{
				if (parseInt($('#w').val())) return true;
				alert('Please select a crop region then press submit.');
				return false;
			};
		
</script>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
	include('header.php');
?>
<div class="clear"></div>
	<div id="wrapper">
		<div id="nav">
		<?php
			include('nav.php');
		?>
		</div><!--nav-->
		<div id="content">
        <h3><?php echo $row_prd->prd_name; ?></h3>
        <div id="wp_crop">
            <img src="<?php echo "../uploads/images/$row_prd->prd_img";?>" id="cropbox" 
                <?php
                    list($width, $height) = getimagesize("../uploads/images/$row_prd->prd_img");
                    if($width > 400){
                        echo "width=\"400\"";
                    }else{
                    
                    }
                ?>
            /><br />
            <form action="home_edit.php?id=<?php echo $row_prd->prd_id; ?>" method="post" onSubmit="return checkCoords();">
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" />
                        <input type="submit" value="Crop Image" />
                    </form>
        </div><!--wp_crop-->
        <div id="crop_result">
            <img src="<?php echo "../uploads/crop/$row_prd->prd_img";?>" /> 
        </div>
<div class="clear"></div>
<form action="prd_edit_exec.php?id=<?php echo $row_prd->prd_id; ?>" method="POST" enctype="multipart/form-data">
<p><label for="prd_smart_desc" class="italic">Smart Descriptions :</label><br /><textarea id="prd_desc" name="prd_smart_desc"><?php echo $row_prd->prd_smart_desc; ?></textarea></p>
<script type="text/javascript">
	var editor = CKEDITOR.replace( 'prd_desc' );
	CKFinder.SetupCKEditor( editor, 'ckfinder' );
</script>
<input type="submit" value="Save" />

			</form>

		</div><!--content-->
		<div class="clear"></div>
	</div><!--wrapper-->

</body>
</html>