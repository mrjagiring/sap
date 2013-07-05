<?php
$minUserLevel=10;
include("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
?>
<script src="fc/fc.js"></script>
<?php
$id=$_POST[id];
$MENUmain_menu=mysqli_result1(mysqli_query($mysqli1,"select menu from `main_menu` where `id`='$id'"),0);
echo"<body>";
echo"<table width=300><tr style=background-color:lightblue;font-family:arial;font-size:16px;font-weight:bold;text-align:center;><td colspan=3>Rename Menu</td></tr><tr><td style=font-family:verdana;font-weight:bold;font-size:14px;>Name : </td><td><input style=font-family:helvetica; type=text id=name value='$MENUmain_menu'></td><td><input onclick=savenamemenu('$id'); type=button value=submit style=background-color:black;color:white;font-weight:bold;></td><tr></table>";
echo"</body>";
?>
<table id=tablesavenamemenu style="visibility:hidden;" bgcolor = blue style = "color : white;">
	<tr>
		<td id=tdsavenamemenu>&nbsp;</td>
	</tr>
</table>