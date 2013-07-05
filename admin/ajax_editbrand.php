<?php
$minUserLevel=10;
include("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
$id=$_POST[id];
$name=$_POST[name];
$prior=$_POST[prior];
$ARRAYdata_brand=mysqli_fetch_array(mysqli_query($mysqli1,"select * from `data_brand` where `id`='$id'"));
$oldname=$ARRAYdata_brand[name];
mysqli_query($mysqli1,"update `data_product` set `brand`='$name' where `brand`='$oldname'");
mysqli_query($mysqli1,"update `data_brand` set `name`='$name',`priority`='$prior' where `id`='$id'");
?>