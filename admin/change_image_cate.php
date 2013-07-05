<?php
	require_once'session2.php';
	require_once'../config.php';
	$sql_cate="select * from category where cate_id='$_GET[id]'";
	$query_cate=mysql_query($sql_cate);
	$row_cate=mysql_fetch_object($query_cate);
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
			$("#update").attr("disabled", "");
			}
		});
});	
</script>
<title>Image Edit</title>
<link rel="shortcut icon" href="../images/ico.png" />
</head>

<body>
<img src="<?php echo "../uploads/thumbs/$row_cate->cate_img";?>" />
<form action="change_image_cate_exec.php?id=<?php echo $_GET['id'];?>" method="post" enctype="multipart/form-data">
	<input type="file" name="cate_img" id="input_img"/>
    <input type="submit" value="Update" id="update" disabled="disabled" />
    <p>
    <input type="button" name="" value="Close Window" onclick="refresh_parent()" />
    </p>
</form>

</body>
</html>
