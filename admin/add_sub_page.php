<?php
	require_once'session2.php';
	require_once'../config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="../jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
	function refresh_parent(){
		window.opener.location.href = "admin.php";
		self.close();
	}
	
$(document).ready(function(){
		$("#list_name").change(function(){
			if ($(this).val() !== ""){
			$("#add").attr("disabled", "");
			}
		});
});	
</script>
<title>Image Edit</title>
</head>

<body>
<?php
	if($_GET['ref'] == "added"){
		echo "Successfully Update / Berhasil Ditambah";
	}else if($_GET['ref'] == "ada"){
		echo "Already Exist / Nama Telah ada, Pilih Nama Lain..";
	}else{
	
	}
?>
<form action="add_sub_page_exec.php" method="post" enctype="multipart/form-data">
    <p>Name :<br /><input type="text" value="" name="list_name" id="list_name" /></p>
    <p>Nama :<br /><input type="text" value="" name="list_nama" id="list_nama" /></p>
    <input type="submit" value="Add/Tambah" id="add" disabled="disabled" />
</form>

    <p>
    <input type="button" name="" value="Close Window" onclick="refresh_parent()" />
    </p>
</body>
</html>
