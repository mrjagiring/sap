<?php
$minUserLevel=10;
include("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
$id=$_POST[id];
$productcategory=$_POST[productcategory];
$productbrand=$_POST[productbrand];
$productname=$_POST[productname];
$productdesc=$_POST[productdesc];
$productshow=$_POST[productshow];
$productdesc=str_replace("\n","<br>",$productdesc);
$productevent=$_POST[productevent];
mysqli_query($mysqli1,"update `data_product` set `category`='$productcategory',`brand`='$productbrand',`name`='$productname',`brand`='$productevent',`event`='-',`show`='$productshow',`desc`='$productdesc' where `id`='$id'");
?>