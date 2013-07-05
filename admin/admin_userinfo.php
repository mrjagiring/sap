<?php
$minUserLevel = 10;
require("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
$submit=$_POST[submit];
if($submit){
	$info=$_POST[info];
	$info=str_replace("\n","<br>",$info);
	mysqli_query($mysqli1,"update `configuration` set `user_info`='$info'");
	echo"<fieldset style=font-family:helvetica;font-size:12px;font-weight:bold;><legend>Confirmation</legend><table><tr><td>Success Update Data</td></tr></table></fieldset>";
	die();
}
$ARRAYconfiguration=mysqli_fetch_array(mysqli_query($mysqli1,"select * from `configuration`"));
$desc=$ARRAYconfiguration[0];
$desc=str_replace("<br>","\n",$desc);
?>
<fieldset style=font-family:helvetica;font-weight:block;font-size:12px;>
	<legend>User Information</legend>
		<table>
			<tr>
				<td>
					<form method=post>
					<textarea name=info rows=5 style=overflow:auto;width:400px;><?php echo"$desc"; ?></textarea>
					<input type=submit style=float:right; value=submit name=submit style=background-color:white;>
					</form>
				</td>
			</tr>
		</table>
</fieldset>