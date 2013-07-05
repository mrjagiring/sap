<?php
$minUserLevel = 3;
require("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
include("fc/function.php");
echo"<body style=\"font:76% Verdana,Tahoma,Arial,sans-serif;\">";
if($_POST[submit]){
	mysqli_query($mysqli1,"INSERT INTO `menu` (`name`, `root`, `priority`) VALUES ('".$_POST[menuname]."','".$_POST[menuroot]."','".$_POST[menupriority]."')");
	echo"Success Input New Menu";
	die();
}
if($_GET[delete]){
	mysqli_query($mysqli1,"delete from `menu` where `id`='".$_GET[delete]."'");
}
echo"<form method=post><table align=center style=text-align:center;width:500px; border=1><tr style=font-weight:bold;font-size:14px;><td colspan=3>Add Menu</td></tr>";
echo"<tr style=font-weight:bold;font-size:12px;><td style=width:45%;>New Menu</td><td style=width:10%;> : </td><td style=width:45%;><input type=text name=menuname style=width:100%;></td></tr>";
echo"<tr style=font-weight:bold;font-size:12px;><td style=width:45%;>Root</td><td style=width:10%;> : </td><td style=width:45%;><select style=width:100%; name=menuroot><option value=''>-</option>".listroot()."</select></td></tr>";
echo"<tr style=font-weight:bold;font-size:12px;><td style=width:45%;>Priority</td><td style=width:10%;> : </td><td style=width:45%;><select style=width:100%; name=menupriority>".listpriority()."</select></td></tr>";
echo"<tr><td colspan=3><input name=submit type=submit value=submit></td></tr>";
echo"</table></form>";

echo"<table align=center style=text-align:center;width:500px; border=1><tr><td colspan=3>List Menu Root</td></tr>";
echo"<tr style=font-size:14px;font-weight:bold;><td style=width:50%;>Name</td><td style=width:50%;>Action</td></tr>";
$DATA=mysqli_query($mysqli1,"select * from `menu` where `root`='' order by`priority` asc");
while($ARRAY=mysqli_fetch_array($DATA)){
	echo"<tr style=font-size:12px;><td style=width:50%;>$ARRAY[name]</td><td style=width:50%;>[ <a href=editmenu.php?menuid=$ARRAY[id]>Edit</a> ] | [ <a onclick=\"return confirm('Are you sure you want to delete?')\" href=?delete=$ARRAY[id]>Delete</a> ] | [ <a onclick=\"window.open('rename_menu.php?type=1&id=$ARRAY[id]','mywin','left=200,top=200,width=400,height=150,toolbar=0,resizable=0');\"
 style=color:blue;cursor:hand;text-decoration:underline;>Rename</a> ]</td></tr>";
}
echo"</table>";
echo"<br>";
echo"<table align=center style=text-align:center;width:500px; border=1><tr><td colspan=3>List Menu Sub</td></tr>";
echo"<tr style=font-size:14px;font-weight:bold;><td style=width:25%;>Name</td><td style=width:25%;>Root</td><td style=width:50%;>Action</td></tr>";
$DATA=mysqli_query($mysqli1,"select * from `menu` where `root`!='' order by`priority` asc");
while($ARRAY=mysqli_fetch_array($DATA)){
	echo"<tr style=font-size:12px;><td style=width:25%;>$ARRAY[name]</td><td style=width:25%;>$ARRAY[root]</td><td style=width:50%;>[ <a href=editmenu.php?menuid=$ARRAY[id]>Edit</a> ] | [ <a onclick=\"return confirm('Are you sure you want to delete?')\" href=?delete=$ARRAY[id]>Delete</a> ] | [ <a onclick=\"window.open('rename_menu.php?type=1&id=$ARRAY[id]','mywin','left=200,top=200,width=400,height=150,toolbar=0,resizable=0');\"
 style=color:blue;cursor:hand;text-decoration:underline;>Rename</a> ]</td></tr>";
}
echo"</table>";
echo"</body>";
?>