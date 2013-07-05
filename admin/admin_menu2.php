<?php
$minUserLevel = 3;
require("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
include("fc/function.php");
echo"<body style=\"font:76% Verdana,Tahoma,Arial,sans-serif;\">";
if($_POST[submit]){
	mysqli_query($mysqli1,"INSERT INTO `menu2` (`name`, `root`, `priority`) VALUES ('".$_POST[menuname]."','Product','".$_POST[menupriority]."')");
	echo"Success Input New Menu";
	die();
}
echo"<table align=center style=text-align:center;width:700px; border=1><tr><td colspan=3>List Menu English</td></tr>";
echo"<tr style=font-size:14px;font-weight:bold;><td style=width:50%;>Name</td><td style=width:50%;>Action</td></tr>";
$DATA=mysqli_query($mysqli1,"select * from `menu` where `root`='' order by`priority` asc");
while($ARRAY=mysqli_fetch_array($DATA)){
	echo"<tr style=font-size:12px;><td style=width:50%;>$ARRAY[name]</td><td style=width:50%;>[ <a href=editmenu2.php?menuid=$ARRAY[id]>Edit</a> ]</td></tr>";
}
echo"</table>";
echo"</body>";


?>