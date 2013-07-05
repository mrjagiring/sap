<?php
$logx=$_GET["logx"];
$waktucookiex=time()+(60*60*24*31*12);
require("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");

if (userlevel($login) >=10) 
	{
		echo "<script> window.location='admin.php';   </script>"; 
	}
else 
	{ 
		echo "<script>  window.location='blocked.php' </script>  ";
	}
?>