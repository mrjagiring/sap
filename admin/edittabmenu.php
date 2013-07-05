<?php
$minUserLevel = 3;
require("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
$menuid=$_GET[menuid];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
  <head>
    <title>Edit Tab Menu</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="../tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "simple"
});
</script>
  </head>
  <body>
  <?php
	if($_POST["submit"]){
		mysqli_query($mysqli1,"update `tabmenu` set `sdesc`='$_POST[sdesc]', `ldesc`='$_POST[ldesc]' where `id`='$_POST[menuid]'");
		?>
		<div style="font-family: arial;"><FONT SIZE="" COLOR="red"><B>Success Edit Menu</B></FONT></div>
		<?php
	}
		
$sdesc=mysqli_result1(mysqli_query($mysqli1,"select `sdesc` from `tabmenu` where `id`='$menuid'"),0);
$ldesc=mysqli_result1(mysqli_query($mysqli1,"select `ldesc` from `tabmenu` where `id`='$menuid'"),0);
$name=mysqli_result1(mysqli_query($mysqli1,"select `name` from `tabmenu` where `id`='$menuid'"),0);
  ?>
	<h3>Edit Menu <FONT COLOR="red"><?php echo $name; ?></FONT></h3>
    <form method="post">
	<div>
		
	</div>
	<input type=hidden name=menuid value=<?php echo $menuid; ?>>
	  <div style="font-family: arial;"><FONT SIZE="" COLOR="blue"><B><I>Short Description</I></B></FONT></div>
	  <textarea name="sdesc" style="overflow:auto;" cols="50" rows="10"><?php echo $sdesc;?></textarea>
	  <!-- <br>
	  <div style="font-family: arial;"><FONT SIZE="" COLOR="blue"><B><I>Long Description</I></B></FONT></div>
	  <textarea name="ldesc" style="overflow:auto;" cols="100" rows="25"><?php echo $ldesc;?></textarea> -->
      <input type="submit" name=submit value="Submit">
    </form>
  </body>
</html>