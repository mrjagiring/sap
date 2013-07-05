<?php
$minUserLevel = 3;
require("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
$menuid=$_GET[menuid];
$desc=mysqli_result1(mysqli_query($mysqli1,"select `desc` from `menu_special` where `id`='$menuid'"),0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
//set this to point to the file fckeditor.php
include("FCKeditor/fckeditor.php") ;
?>
<html>
  <head>
    <title>Edit Menu</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
    <form action="savedataspecial.php" method="post">
	<input type=hidden name=menuid value=<?php echo $menuid; ?>>
<?php
$content = htmlspecialchars_decode($desc);
$oFCKeditor = new FCKeditor('FCKeditor1') ; //set this to point to your main fckeditor folder
$oFCKeditor->BasePath = 'FCKeditor/'; //set this to point to your main fckeditor folder
$oFCKeditor->Value = $content; 
$oFCKeditor->Width    = '750'; //You can change the width of the editor to whatever you want here
$oFCKeditor->Height   = '490'; //You can change the height of the editor to whatever you want here
$oFCKeditor->Create() ;
?>
      <br>
      <input type="submit" value="Submit">
    </form>
  </body>
</html>