<?php
require("config.inc.php");
$logout = true;
include($cfgProgDir . "secure.php");

$abc=mysqli_query($mysqli1,"delete from `useronline` where `username`='$login'");
?>
