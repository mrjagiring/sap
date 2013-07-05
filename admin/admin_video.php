<?php
$minUserLevel=10;
include("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
?>
<script>
function displaysubcategory(){
	var category=document.getElementById('productcategory').value;
	window.location='admin_product.php?productcategory='+category;
}
</script>
<?php
$productcategory=$_POST[productcategory];
if(!$productcategory){
	$productcategory=$_GET[productcategory];
}
$productsubcategory=$_POST[productsubcategory];
$productname=$_POST[productname];
$productdesc=$_POST[productdesc];
$productdesc=str_replace("\n","<br>",$productdesc);
$productevent=$_POST[productevent];
echo"<body bgcolor=$bodybgcolor>";
include ($_SERVER['DOCUMENT_ROOT'].$foldername."/admin/upload_class/upload_class.php"); 
error_reporting(E_ALL);
set_time_limit(60);
	$my_upload = new file_upload;
	$my_upload->upload_dir = $_SERVER['DOCUMENT_ROOT'].$foldername."/upload/video/"; // "files" is the folder for the uploaded files (you have to create this folder)
	$my_upload->file_folder = $_SERVER['DOCUMENT_ROOT'].$foldername."/upload/video/";
	$my_upload->check_dir($my_upload->file_folder);
	$my_upload->extensions = array(".flv"); // specify the allowed extensions here
	// $my_upload->extensions = "de"; // use this to switch the messages into an other language (translate first!!!)
	$my_upload->max_length_filename = 50; // change this value to fit your field length in your database (standard 100)

	if (isset($_POST['Submit']) && $_POST['Submit'] == "Upload") {
		$today=date("hms");
		$namafoto=$today.STR_REPLACE(".flv","",$_FILES['upload']['name']);
		$namafoto=str_replace(" ","_",$namafoto);

		$my_upload->rename_file = true;
		$my_upload->the_temp_file = $_FILES['upload']['tmp_name'];
		$my_upload->the_file = $_FILES['upload']['name'];
		$my_upload->http_error = $_FILES['upload']['error'];
		$my_upload->replace = (isset($_POST['replace'])) ? $_POST['replace'] : "n"; // because only a checked checkboxes is true
		$my_upload->do_filename_check = (isset($_POST['check'])) ? $_POST['check'] : "n"; // use this boolean to check for a valid filename

		if ($my_upload->upload($namafoto)) { // new name is an additional filename information, use this to rename the uploaded file
			$full_path = $my_upload->upload_dir.$my_upload->file_copy;
			mysqli_query($mysqli1,"insert into `data_video` set `name`='$productname',`desc`='$productdesc',`url`='".$my_upload->file_copy."'");
			echo"<table align=center width=500 style=background-color:gray;><tr style=background-color:lightgreen;font-family:arial;font-size:16px;font-weight:bold;><td>Confirmation</td></tr><tr style=font-family:verdana;color:white;font-weight:bold;><td>Success Inserted New Video&nbsp;<a href=admin_video.php style=color:blue;>BACK </a></td></tr><table>";
			die();
		} else {
			echo "<div align=center><font color=red>Failed Upload</font></div>";
		}

	}
?>
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_size; ?>">
<?php
echo"<table align=center width=500 style=background-color:gray;>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<tr bgcolor=lightgreen><td colspan=2 style=font-family:verdana;font-size:15px;text-align:center;font-weight:bold;>Add New Video</td></tr>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*echo"<tr>
<td style=font-family:arial;font-weight:bold;color:white; width=200>Category</td>
<td width=300><select style=width:300px; id=productcategory name=productcategory onchange=displaysubcategory();><option value='$productcategory'>$productcategory";
$TAKEdata_category=mysqli_query($mysqli1,"select * from `data_category` where `name`!='$productcategory'");
while($ARRAYdata_category=mysqli_fetch_array($TAKEdata_category)){
	echo"<option value='$ARRAYdata_category[name]'>$ARRAYdata_category[name]";
}
echo"</select></td></tr>";*/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<tr><td style=font-family:arial;font-weight:bold;color:white; width=200>Name</td><td width=300><input style=width:300px; type=text name=productname></td></tr>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<tr><td style=font-family:arial;font-weight:bold;color:white; width=200>Description</td width=300><td><textarea name=productdesc style=overflow:auto; cols=34 rows=10></textarea></td></tr>";
echo"<tr><td style=font-family:arial;font-weight:bold;color:white; width=200>Picture</td><td width=300>
<input type=\"file\" name=\"upload\" id=\"upload\" size=\"33\">
</td></tr>";
echo"<tr bgcolor=lightgreen><td colspan=2><input type=submit name=Submit id=Submit value=Upload></td></tr>"; 
echo"<tr style=font-family:helvetica;font-size:14px;font-weight:bold;color:white;><td colspan=2>Click <a href=admin_viewvideo.php style=color:red;text-decoration:none;font-family:verdana;>here</a> to view video</td></tr>";
echo"</table>	</form>";
echo"</body>";
?>