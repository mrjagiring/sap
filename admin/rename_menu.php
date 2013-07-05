<?php
$minUserLevel = 3;
require("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
include("fc/function.php");
if($_GET[type]=="1"){
	$menusql="menu";
	$menu="Menu";
}else{
	$menusql="menu_special";
	$menu="Menu Product";
}
$name=mysqli_result1(mysqli_query($mysqli1,"select `name` from $menusql where `id`='".$_GET[id]."'"),0);
if($_POST[submit]){
	if($_POST[rename]==""){
		echo"<body style=\"font:76% Verdana,Tahoma,Arial,sans-serif;text-align:center;\"><table style=width:100%;><tr><td colspan=3 style=text-align:center;font-weight:bold;background-color:orange;>Rename is Blank</td></tr></table></body>";
	}
	$cekroot=mysqli_num_rows(mysqli_query($mysqli1,"select * from $menusql where `root`='$name'"));
	if($cekroot>0){
		mysqli_query($mysqli1,"update `menu` set `root`='".$_POST[rename]."' where `root`='$name'");
	}
	mysqli_query($mysqli1,"update `menu` set `name`='".$_POST[rename]."' where `id`='".$_GET[id]."'");
	echo"<body style=\"font:76% Verdana,Tahoma,Arial,sans-serif;text-align:center;\"><table style=width:100%;><tr><td colspan=3 style=text-align:center;font-weight:bold;background-color:orange;>Success Rename $menu</td></tr></table></body>";
	die();
}
echo"";
echo"<body style=\"font:76% Verdana,Tahoma,Arial,sans-serif;text-align:center;\">";
echo"<table style=width:100%;><form method=post>";
echo"<tr><td colspan=3 style=text-align:center;font-weight:bold;background-color:orange;>Rename $menu</td></tr>";
echo"<tr><td style=width:45%;text-align:center;>$name</td><td style=width:10%;> to </td><td style=width:45%;><input type=text name=rename></td></tr>";
echo"<tr><td colspan=3 style=background-color:orange;><input type=submit name=submit value=submit style=width:100%;></td></tr>";
echo"</form></table>";
echo"</body>";
?>