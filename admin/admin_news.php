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
ini_set("memory_limit", "64M");
set_time_limit(60);

class Foto_upload extends file_upload {
	
	var $x_size;
	var $y_size;
	var $x_max_size = 300;
	var $y_max_size = 200;
	var $x_max_thumb_size = 110;
	var $y_max_thumb_size = 88;
	var $thumb_folder;
	var $foto_folder;
	var $larger_dim;
	var $larger_curr_value;
	var $larger_dim_value;
	var $larger_dim_thumb_value;
	
	var $use_image_magick = false; // switch between true and false
	// I suggest to use ImageMagick on Linux/UNIX systems, it works on windows too, but it's hard to configurate
	// check your existing configuration by your web hosting provider
	
	function process_image($landscape_only = false, $create_thumb = false, $delete_tmp_file = false, $compression = 85) {
		$filename = $this->upload_dir.$this->file_copy;
		$this->check_dir($this->thumb_folder); // run these checks to create not existing directories
		$this->check_dir($this->foto_folder); // the upload dir is created during the file upload (if not already exists)
		$thumb = $this->thumb_folder.$this->file_copy;
		$foto = $this->foto_folder.$this->file_copy;
		if ($landscape_only) {
			$this->get_img_size($filename);
			if ($this->y_size > $this->x_size) {
				$this->img_rotate($filename, $compression);
			}
		}
		$this->check_dimensions($filename); // check which size is longer then the max value
		if ($this->larger_curr_value > $this->larger_dim_value) {
			$this->thumbs($filename, $foto, $this->larger_dim_value, $compression);
		} else {
			copy($filename, $foto);
		}
		if ($create_thumb) {
			if ($this->larger_curr_value > $this->larger_dim_thumb_value) {
				$this->thumbs($filename, $thumb, $this->larger_dim_thumb_value, $compression); // finally resize the image
			} else {
				copy($filename, $thumb);
			}
		}
		if ($delete_tmp_file) $this->del_temp_file($filename); // note if you delete the tmp file the check if a file exists will not work
	}
	function get_img_size($file) {
		$img_size = getimagesize($file);
		$this->x_size = $img_size[0];
		$this->y_size = $img_size[1];
	}
	function check_dimensions($filename) {
		$this->get_img_size($filename);
		$x_check = $this->x_size - $this->x_max_size;
		$y_check = $this->y_size - $this->y_max_size;
		if ($x_check < $y_check) {
			$this->larger_dim = "y";
			$this->larger_curr_value = $this->y_size;
			$this->larger_dim_value = $this->y_max_size;
			$this->larger_dim_thumb_value = $this->y_max_thumb_size;
		} else {
			$this->larger_dim = "x";
			$this->larger_curr_value = $this->x_size;
			$this->larger_dim_value = $this->x_max_size;
			$this->larger_dim_thumb_value = $this->x_max_thumb_size;
		}
	}
	function img_rotate($wr_file, $comp) {
		$new_x = $this->y_size;
		$new_y = $this->x_size;
		if ($this->use_image_magick) {
			exec(sprintf("mogrify -rotate 90 -quality %d %s", $comp, $wr_file));
		} else {
			$src_img = imagecreatefromjpeg($wr_file);
			$rot_img = imagerotate($src_img, 90, 0);
			$new_img = imagecreatetruecolor($new_x, $new_y);
			imageantialias($new_img, TRUE);
			imagecopyresampled($new_img, $rot_img, 0, 0, 0, 0, $new_x, $new_y, $new_x, $new_y);
			imagejpeg($new_img, $this->upload_dir.$this->file_copy, $comp);
		}
	}
	function thumbs($file_name_src, $file_name_dest, $target_size, $quality = 80) {
		//print_r(func_get_args());
		$size = getimagesize($file_name_src);
		if ($this->larger_dim == "x") {
			$w = number_format($target_size, 0, ',', '');
			$h = number_format(($size[1]/$size[0])*$target_size,0,',','');
		} else {
			$h = number_format($target_size, 0, ',', '');
			$w = number_format(($size[0]/$size[1])*$target_size,0,',','');
		}
		if ($this->use_image_magick) {
			exec(sprintf("convert %s -resize %dx%d -quality %d %s", $file_name_src, $w, $h, $quality, $file_name_dest));
		} else {
			$dest = imagecreatetruecolor($w, $h);
			imageantialias($dest, TRUE);
			$src = imagecreatefromjpeg($file_name_src);
			imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $h, $size[0], $size[1]);
			imagejpeg($dest, $file_name_dest, $quality);
		}
	}
}

$max_size = 1024*1024; // the max. size for uploading (~1MB)
define("MAX_SIZE", $max_size);
$foto_upload = new Foto_upload;

$foto_upload->upload_dir = $_SERVER['DOCUMENT_ROOT'].$foldername."/admin/images/"; // "files" is the folder for the uploaded files (you have to create these folder)
$foto_upload->foto_folder = $_SERVER['DOCUMENT_ROOT'].$foldername."/images/news/photo/";
$foto_upload->thumb_folder = $_SERVER['DOCUMENT_ROOT'].$foldername."/images/news/thumb/";
$foto_upload->extensions = array(".jpg"); // specify the allowed extension(s) here
$foto_upload->language = "en";
$foto_upload->x_max_size = 600;
$foto_upload->y_max_size = 480;
$foto_upload->x_max_thumb_size = 150;
$foto_upload->y_max_thumb_size = 100;
$today=date("hms");
if (isset($_POST['Submit']) && $_POST['Submit'] == "Upload") {
	$namafoto=$today.$_FILES['upload']['name'];
	$namafoto=str_replace(" ","_",$namafoto);
	$foto_upload->the_temp_file = $_FILES['upload']['tmp_name'];
	$foto_upload->the_file = $namafoto;
	$foto_upload->http_error = $_FILES['upload']['error'];
	$foto_upload->replace = (isset($_POST['replace'])) ? $_POST['replace'] : "n"; // because only a checked checkboxes is true
	$foto_upload->do_filename_check = "n"; 
	if(!$productname or !$productdesc or strlen($namafoto)<=6){
	echo"<table align=center width=500 style=background-color:gray;><tr style=background-color:lightgreen;font-family:arial;font-size:16px;font-weight:bold;><td>Confirmation</td></tr><tr style=font-family:verdana;color:white;font-weight:bold;><td>Data Not Complete&nbsp;<a href=admin_product.php style=color:blue;>BACK </a></td></tr><table>";
	die();
	}
	if ($foto_upload->upload()) {
	$foto_upload->process_image(false, true, true, 80);
	$foto_upload->message[] = "Processed foto: ".$foto_upload->file_copy."!"; // "file_copy is the name of the foto"
	mysqli_query($mysqli1,"insert into `news` set `judul`='$productname',`isi`='$productdesc',`date` = now(),`read` = '0',`foto`='".$foto_upload->the_file."'");
	echo"<table align=center width=500 style=background-color:gray;><tr style=background-color:lightgreen;font-family:arial;font-size:16px;font-weight:bold;><td>Confirmation</td></tr><tr style=font-family:verdana;color:white;font-weight:bold;><td>Success Inserted News&nbsp;<a href=admin_product.php style=color:blue;>BACK </a></td></tr><table>";
die();
	}
}
$error = $foto_upload->show_error_string();
?>
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_size; ?>">
<?php
echo"<table align=center width=500 style=background-color:gray;>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<tr bgcolor=lightgreen><td colspan=2 style=font-family:verdana;font-size:15px;text-align:center;font-weight:bold;>Add News</td></tr>";
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
echo"<tr><td style=font-family:arial;font-weight:bold;color:white; width=200>Title</td><td width=300><input style=width:300px; type=text name=productname></td></tr>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*echo"<tr><td style=font-family:arial;font-weight:bold;color:white; width=200>Harga</td><td width=300><input type=text name=productevent onKeyUp=\"this.value = Comma(removecomma(this.value));\" style=width:300px; onKeypress=\"if (event.keyCode < 45 || event.keyCode > 57 || event.keyCode == 13) { if (event.keyCode == 13) event.returnValue=true; else event.returnValue = false; }\"></td></tr>";*/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<tr><td style=font-family:arial;font-weight:bold;color:white; width=200>Content</td width=300><td><textarea name=productdesc style=overflow:auto; cols=34 rows=10></textarea></td></tr>";
echo"<tr><td style=font-family:arial;font-weight:bold;color:white; width=200>Picture</td><td width=300>
<input type=\"file\" name=\"upload\" id=\"upload\" size=\"33\">
</td></tr>";
echo"<tr bgcolor=lightgreen><td colspan=2><input type=submit name=Submit id=Submit value=Upload></td></tr>"; 
echo"<tr style=font-family:helvetica;font-size:14px;font-weight:bold;color:white;><td colspan=2>Click <a href=admin_viewnews.php style=color:red;text-decoration:none;font-family:verdana;>here</a> to view news</td></tr>";
echo"</table>	</form>";
echo"</body>";
?>