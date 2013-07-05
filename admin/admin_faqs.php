<?php
$minUserLevel = 10;
require("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
if($_POST[submit]){
	mysqli_query($mysqli1,"update `sbox` set `ans`='".$_POST[ans]."' where `id`='".$_POST[id]."'");
	echo"<table style=width:100%;text-align:center;font-weight:bold;color:red;><tr><td>Success Update Data</td></tr></table>";
}
if($_GET[delete]){
	$ARRAYread=mysqli_query($mysqli1,"delete from `sbox`where `id`='".$_GET[delete]."'");
	echo"<table style=width:100%;text-align:center;font-weight:bold;color:red;><tr><td>Success Delete Data</td></tr></table>";
}
if($_GET[read]){
	$ARRAYread=mysqli_fetch_array(mysqli_query($mysqli1,"select * from `sbox`where `id`='".$_GET[read]."'"));
	echo"<table border=1 style=width:600px;text-align:center;font-family:helvetica;font-size:13px;><form method=post>
		<input type=hidden name=id value=$_GET[read]>
		<tr><td style=width:250px;>Name</td><td style=width:250px;>$ARRAYread[name]</td></tr>
		<tr><td style=width:250px;>Email</td><td style=width:250px;>$ARRAYread[email]</td></tr>
		<tr><td style=width:250px;>Address</td><td style=width:250px;>$ARRAYread[address]</td></tr>
		<tr><td style=width:250px;>About</td><td style=width:250px;>$ARRAYread[about]</td></tr>
		<tr><td style=width:250px;>Description</td><td style=width:250px;>$ARRAYread[desc]</td></tr>
		<tr><td style=width:250px;>Answer</td><td style=width:250px;><textarea name=ans style=width:100%;>$ARRAYread[ans]</textarea></td></tr>
		<tr><td colspan=2><input type=submit name=submit value=submit style=background-color:white;></td></tr>
	</form></table>";
}
$DATA=mysqli_query($mysqli1,"select * from `sbox` order by `date` desc");
?>
<fieldset style=font-family:helvetica;font-weight:block;font-size:12px;>
	<legend>Admin FAQs</legend>
		<table style=width:100%;text-align:center; cellspacing=0>
			<tr style=background-color:#C0C0C0;>
				<td>No.</td><td>Name</td><td>Email</td><td>Address</td><td>Phone</td><td>Message</td><td>Action</td>
			</tr>
			<?php
				$no=1;
				while($ARRAY=mysqli_fetch_array($DATA)){
					echo"<tr><td style=font-size:12px;>$no</td><td>$ARRAY[name]</td><td>$ARRAY[email]</td><td>$ARRAY[address]</td><td>$ARRAY[phone]</td><td>$ARRAY[desc]</td><td><a href=?delete=$ARRAY[0]>delete</a></td></tr>";
					$no++;
				}
			?>
		</table>
</fieldset>