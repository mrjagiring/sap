<?php
	require_once'session2.php';
	require_once'../config.php';
	$sql_alb="select * from gallery where gal_alias='$_GET[album]'";
	$query_alb=mysql_query($sql_alb);
	$row_alb=mysql_fetch_object($query_alb);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="../jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
	function refresh_parent(){
		window.opener.location.href = window.opener.location.href;
		self.close();
	}
	
$(document).ready(function(){
		$("#input_img").change(function(){
			if ($(this).val() !== ""){
			$("#add").attr("disabled", "");
			}
		});
});	
</script>
<title>Image Edit</title>
</head>

<body onunload="refresh_parent()">
<?php
	if($_GET[ref] == "added"){
		echo "Your photo have been inserted";
	}else{
?>
<form action="add_alb_img_exec.php?album=<?php echo $_GET['album'];?>" method="post" enctype="multipart/form-data">
	<p><label>Photo :</label><br /><input type="file" name="gal_img" id="input_img"/></p>
    <p><label>Title :</label><br /><input type="text" name="gal_title" id="gal_title"/></p>
    <input type="submit" value="Add" id="add" disabled="disabled" />
</form>
<?php } ?>
<p>
<input type="button" name="" value="Close Window" onclick="refresh_parent()" />
</p>
</body>
</html>
