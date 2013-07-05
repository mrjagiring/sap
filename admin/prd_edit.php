<?php
	require_once'session2.php';
	require_once'../config.php';
	$sql_prd="select * from product where prd_id='$_GET[id]'";
	$query_prd=mysql_query($sql_prd);
	$row_prd=mysql_fetch_object($query_prd);
	
	$q="select distinct prd_category from product order by prd_category ASC";
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
		
		function new_window(){
		window.open('change_image.php?id=<?php echo $row_prd->prd_id; ?>','image','width=400,height=200,screenX=50,screenY=50,scrollbars=yes,dependent=yes,location=no');
		}
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
        
			
<div id="wp_img"><img src="<?php echo "../uploads/thumbs/$row_prd->prd_img";?>" /></div>
<div class="clear"></div>
<input type="button" value="Change Photo"  id="change_img" onclick="new_window()" />

<form action="prd_edit_exec.php?id=<?php echo $row_prd->prd_id; ?>" method="POST" enctype="multipart/form-data">
<p><label for="prd_category" class="italic">Category :</label><br />
	<select name="prd_category" id="prd_category">
					<option value="">Category</option>
                    <?php
					do{
					echo '<option value="'.$e->prd_category.'"';
					echo ($row_prd->prd_category == $e->prd_category)? ' selected="selected"' : '';
					echo '>'.$e->prd_category.'</option>';
					}
                    while($e=mysql_fetch_object($w));
                    ?>
	</select>
    <input type="button" id="add_cate" value="add category" />
</p>
<p><label for="prd_name" class="italic">Name :</label><br /><input type="text" id="prd_name" name="prd_name" value="<?php echo $row_prd->prd_name; ?>"/></p>
<p><label for="prd_desc" class="italic">Descriptions :</label><br /><textarea id="prd_desc" name="prd_desc"><?php echo $row_prd->prd_full_desc; ?></textarea></p>
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