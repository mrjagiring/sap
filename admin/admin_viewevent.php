<?php
$minUserLevel=10;
include("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
?>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<script src="fc/fc.js"></script>
<script>
function opensearch(){
	if(document.getElementById('cek3').checked==true){
		document.getElementById('nama').disabled = false;
	}else{
		document.getElementById('nama').disabled = true;
	}
}
</script>
<?php
$submit=$_POST[submit];
$action=$_GET[action];
$deletepic=$_GET[deletepic];
$delete=$_GET[delete];
if($deletepic){
	$file=mysqli_result1(mysqli_query($mysqli1,"select `url` from `event` where `id`='$deletepic'"),0);
	$file1="../images/product/photo/".$file."";
	$file2="../images/product/thumb/".$file."";
	unlink("$file1");
	unlink("$file2");
	mysqli_query($mysqli1,"update `event` set `url`='' where `id`='$deletepic'");
	echo"<table align=center width=500 style=background-color:gray;><tr style=background-color:lightgreen;font-family:arial;font-size:16px;font-weight:bold;><td>Confirmation</td></tr><tr style=font-family:verdana;color:white;font-weight:bold;><td>Success Delete Picture&nbsp;<a href=admin_viewevent.php?action=view style=color:blue;>BACK </a></td></tr><table>";
	die();
}
if($delete){
	$file=mysqli_result1(mysqli_query($mysqli1,"select `url` from `event` where `id`='$delete'"),0);
	$file1="../images/product/photo/".$file."";
	$file2="../images/product/thumb/".$file."";
	unlink("$file1");
	unlink("$file2");
	mysqli_query($mysqli1,"delete from `event` where `id`='$delete'");
	echo"<table align=center width=500 style=background-color:gray;><tr style=background-color:lightgreen;font-family:arial;font-size:16px;font-weight:bold;><td>Confirmation</td></tr><tr style=font-family:verdana;color:white;font-weight:bold;><td>Success Delete Product&nbsp;<a href=admin_viewevent.php?action=view style=color:blue;>BACK </a></td></tr><table>";
	die();
}

echo"<table align=center bgcolor=gray>";
echo"<tr style=background-color:lightgreen;font-family:arial;font-weight:bold;text-align:center;>
	<td>No</td><td>Picture</td><td width=100>Title</td><td>Content</td><td width=100>action</td>
	</tr>";
$TAKEdata_product=mysqli_query($mysqli1,"select * from `event` order by `id` asc");
$no=1;
while($ARRAYdata_product=mysqli_fetch_array($TAKEdata_product)){
	$desc=htmlspecialchars_decode(str_replace("<br>","\n",$ARRAYdata_product[desc]));
	if($ARRAYdata_product[photourl]==""){
		$picture="<IMG SRC=\"../images/noimage.jpg\">";
	}else{
		$picture="<a href=\"../images/event/photo/".$ARRAYdata_product[photourl]."\" rel=\"lightbox\"><IMG border=0 SRC=\"../images/event/thumb/".$ARRAYdata_product[photourl]."\"></a>";
	}
	echo"<tr ".rowrollover(colgjl($nomor,"#dedede","#ffffff"),"#CCCC99")." style=font-family:helvetica;font-size:12px;text-align:center;>
	<td>$no</td>
	<td>$picture</td>
	<td>$ARRAYdata_product[title]</td>
	<td align=left>$desc</td>
	<td><a href=admin_viewevent.php?delete=$ARRAYdata_product[id]><IMG SRC=\"images/delete_icon.gif\" WIDTH=\"20\" HEIGHT=\"20\" BORDER=\"0\" ALT=\"delete\"></a></td>
	</tr>";
	$no++;
}
echo"</table>";
////////////////////////MAJOR SCRIPTING END////////////////////////////////////////////////////////////////////////////////////////////
echo"</body>";
?>
<table id=tableeditproduct style="display:none;" bgcolor = <?php echo"$colorg1";?> style = "color : white;">
<tr>
	<td id=tdeditproduct>&nbsp;</td>
</tr>
</table>