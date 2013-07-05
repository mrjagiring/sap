<?php
	require_once'session2.php';
	require_once'../config.php';
				
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
			
/*			$(".parent").toggle(
					function(){
					$(this).next().slideDown();
				},
					function(){
						$(this).next().slideUp();
				}
			);*/
			
/*			$('#page_name').change(function(){
			str = $("#page_name").val();
      		reg = /(\s?\W?[\s\W])/g;
			$('#page_alias').attr('value', str.replace(reg,""));
			});*/
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
        <?php
		if(!isset($_GET[id])){
				$sql_view="select * from page order by page_id";
				$query_view=mysql_query($sql_view);
				$row_view=mysql_fetch_object($query_view);
		?>
        	<table width="81%" border="0" cellspacing="2" cellpadding="5">
				  <thead>
					<th>Web Name</th>
					<th>Name</th>
					<th>Posted By</th>
					<th>Entry Date</th>
					<th>Last Update</th>
					<th>Action</th>
				  </thead>
				<?php
				do{
				
				if($row_view->page_status == "page"){
					$a = "page.php?id=".$row_view->page_id;
				}elseif($row_view->page_status == "unique"){
					$a = $row_view->page_name.".php";
				}
				?>
					<tr>
                        <td><?php echo $row_view->page_name; ?> / <?php echo $row_view->page_webname; ?></td>
                        <td><?php echo $row_view->page_name; ?></td>
                        <td><?php echo $row_view->posted_by; ?></td>
                        <td><?php echo $row_view->entry_date; ?></td>
                        <td><?php echo $row_view->last_update; ?></td>
                        <td><a href="<?php echo $a;?>">Edit</a></td> 
					</tr>
				<?php 
				}
					while($row_view=mysql_fetch_object($query_view));
				?>
				</table>
<?php
		}else{
			$sql_view="select * from page where page_id='$_GET[id]'";
			$query_view=mysql_query($sql_view);
			$row_view=mysql_fetch_assoc($query_view);
		?>	
			<form action="page_edit.php?id=<?php echo $row_view['page_id']; ?>" method="post">
<p><label for="page_name" class="italic">Page Name :</label><br /><?php echo $row_view['page_name']; ?> / <?php echo $row_view['page_webname']; ?></p>
<p><label for="page_content" class="italic">Content :</label><br /><textarea id="page_content" name="page_content"><?php echo $row_view['page_cont']; ?></textarea></p>
<script type="text/javascript">
	var editor = CKEDITOR.replace( 'page_content' );
	CKFinder.SetupCKEditor( editor, 'ckfinder' );
</script>

<input type="submit" value="Save" />

</form>
<?php } ?>

		</div><!--content-->
		<div class="clear"></div>
	</div><!--wrapper-->

</body>
</html>