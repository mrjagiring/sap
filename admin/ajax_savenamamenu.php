<?php
$minUserLevel=10;
include("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
?>
<script src="fc/fc.js"></script>
<?php
$id=$_POST[id];
$name=$_POST[name];
mysqli_query($mysqli1,"update `main_menu` set `menu`='$name' where `id`='$id'");
?>