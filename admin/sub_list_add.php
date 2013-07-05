<?php
	require_once'session2.php';
	require_once'../config.php';

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
        
			<form action="sub_list_add_exec.php?sub=<?php echo $_GET['sub'];?>" method="POST" enctype="multipart/form-data">
<p><label for="list_name" class="italic">Name : </label><br /><input type="text" id="list_name" name="list_name" value=""/></p>
<p><label for="list_content" class="italic">Content : </label><br /><textarea id="list_content" name="list_content"></textarea></p>
<script type="text/javascript">
	var editor = CKEDITOR.replace( 'list_content' );
	CKFinder.SetupCKEditor( editor, 'ckfinder' );
</script>

<input type="submit" value="Save" />

			</form>

		</div><!--content-->
		<div class="clear"></div>
	</div><!--wrapper-->

</body>
</html>