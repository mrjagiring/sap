<?php
	require_once'session2.php';
	require_once'../config.php';
	$q="select distinct cate_name from category order by cate_id DESC";
	$w=mysql_query($q);
	$e=mysql_fetch_object($w);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin Panel</title>
<link rel="shortcut icon" href="../images/ico.png" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="jquery/jquery-easing.js"></script>
<script type="text/javascript" src="jquery/jquery.cycle.all.js"></script>
<script type="text/javascript">
								
		$(document).ready(function(){
			
			/*$(".parent").toggle(
					function(){
					$(this).next().slideDown();
				},
					function(){
						$(this).next().slideUp();
				}
			);*/
			
			$('#add_cate').click(function(){
			var x = prompt("Please input new category : ");
			//alert(x);
			if(x){
				$('#prd_category').append('<option value="' + x + '">' + x + '</option>');
				$('#prd_category option:last-child').attr('selected', 'selected');
			}else{
				return false;
			}
			});
		
		});
		
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
        
<form action="cate_add_exec.php" method="POST" enctype="multipart/form-data">
<p><label for="cate_img" class="italic">Photo : </label><br /><input type="file" name="cateimg" id="cateimg" /></p>
<p><label for="cate_name" class="italic">Name :</label><br /><input type="text" id="cate_name" name="cate_name" value=""/></p>
<input type="submit" onclick="notEmpty(document.getElementById('cate_name'), 'Isi Nama Category')" value="Save"/>
<script type='text/javascript'>
function notEmpty(elem, helperMsg){
	if(elem.value.length == 0){
		alert(helperMsg);
		elem.focus();
		return false; 
	} else return true;
}
</script>
</form>


		</div><!--content-->
		<div class="clear"></div>
	</div><!--wrapper-->

</body>
</html>