<?php
$minUserLevel=10;
include("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
$id=$_POST[id];
$name=$_POST[name];
$ARRAYdata_category=mysqli_fetch_array(mysqli_query($mysqli1,"select * from `data_category` where `id`='$id'"));
$oldname=$ARRAYdata_category[name];
mysqli_query($mysqli1,"update `data_product` set `category`='$name' where `category`='$oldname'");
mysqli_query($mysqli1,"update `data_category` set `name`='$name' where `id`='$id'");
?>