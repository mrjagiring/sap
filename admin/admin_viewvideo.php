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
	$file=mysqli_result1(mysqli_query($mysqli1,"select `url` from `data_video` where `id`='$deletepic'"),0);
	$file1="../upload/video/".$file."";
	unlink("$file1");
	mysqli_query($mysqli1,"update `data_video` set `url`='' where `id`='$deletepic'");
	echo"<table align=center width=500 style=background-color:gray;><tr style=background-color:lightgreen;font-family:arial;font-size:16px;font-weight:bold;><td>Confirmation</td></tr><tr style=font-family:verdana;color:white;font-weight:bold;><td>Success Delete Video&nbsp;<a href=admin_viewvideo.php?action=view style=color:blue;>BACK </a></td></tr><table>";
	die();
}
if($delete){
	mysqli_query($mysqli1,"delete from `data_video` where `id`='$delete'");
	$file1="../upload/video/".$file."";
	unlink("$file1");
	echo"<table align=center width=500 style=background-color:gray;><tr style=background-color:lightgreen;font-family:arial;font-size:16px;font-weight:bold;><td>Confirmation</td></tr><tr style=font-family:verdana;color:white;font-weight:bold;><td>Success Delete Video&nbsp;<a href=admin_viewvideo.php?action=view style=color:blue;>BACK </a></td></tr><table>";
	die();
}
$TAKEdata_video=mysqli_query($mysqli1,"select * from `data_video`");
echo"<body bgcolor=$bodybgcolor>";
echo"<table style=background-color:gray;>";
echo"<tr style=text-align:center;font-family:arial;font-size:15px;background-color:lightgreen;font-weight:bold;><td>
<input type=button value=ViewAll style=background-color:white; onclick=document.location='admin_viewvideo.php?action=view';><input type=button value=Search style=background-color:white; onclick=document.location='admin_viewvideo.php?action=search';>
</td></tr></table>";
////////////////////////MAJOR SCRIPTING////////////////////////////////////////////////////////////////////////////////////////////
if($submit){
	$category=$_POST[category];
	$brand=$_POST[brand];
	$name=$_POST[nama];
	if($name!=""){
		$sqladd .=" and `name`like'$name%'";
	}
echo"<table align=center bgcolor=gray>";
echo"<tr style=background-color:lightgreen;font-family:arial;font-weight:bold;text-align:center;>
	<td>No</td><td>video</td><td width=100>Name</td><td>Desc</td><td width=100>action</td>
	</tr>";
	$TAKEdata_video=mysqli_query($mysqli1,"select * from `data_video` where `id`!='' $sqladd");
	$no=1;
	while($ARRAYdata_video=mysqli_fetch_array($TAKEdata_video)){
		$desc=str_replace("<br>","\n",$ARRAYdata_video[desc]);
		echo"<tr ".rowrollover(colgjl($nomor,"#dedede","#ffffff"),"#CCCC99")." style=font-family:helvetica;font-size:12px;text-align:center;>
		<td>$no</td>";
		?>
		<td>
		<script type="text/javascript" src="swfobject.js"></script>
				<object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="300" height="250" wmode=opaque>
					<param name="movie" value="player-viral.swf" />
					<param name="allowfullscreen" value="true" />
					<param name="allowscriptaccess" value="always" />
					<param name="flashvars" value="file=../upload/video/<?php echo $ARRAYdata_video["url"]; ?>" />
					<object type="application/x-shockwave-flash" data="player-viral.swf" width="300" height="250" wmode=opaque>
						<param name="movie" value="player-viral.swf" />
						<param name="allowfullscreen" value="true" />

						<param name="allowscriptaccess" value="always" />
						<param name="flashvars" value="''" />
						<p><a href="http://get.adobe.com/flashplayer">Get Flash</a> to see this player.</p>
					</object>
				</object>

		</td>
		<?php
		echo "<td>$ARRAYdata_video[name]</td>
		<td>$desc</td>
		<td>
		<a href=admin_viewvideo.php?action=view&delete=$ARRAYdata_video[id]><IMG SRC=\"images/delete_icon.gif\" WIDTH=\"20\" HEIGHT=\"20\" BORDER=\"0\" ALT=\"delete\"></a></td>
		</tr>";
		$no++;
	}
echo"</table>";
?>
<table id=tableeditproduct style="display:none;" bgcolor = <?php echo"$colorg1";?> style = "color : white;">
<tr>
	<td id=tdeditproduct>&nbsp;</td>
</tr>
</table>
<?php
die();
}
if($action==view){
echo"<table align=center bgcolor=gray>";
echo"<tr style=background-color:lightgreen;font-family:arial;font-weight:bold;text-align:center;>
	<td>No</td><td>video</td><td width=100>Name</td><td>Desc</td><td width=100>action</td>
	</tr>";
$TAKEdata_video=mysqli_query($mysqli1,"select * from `data_video` order by `id` asc");
$no=1;
while($ARRAYdata_video=mysqli_fetch_array($TAKEdata_video)){
	$desc=str_replace("<br>","\n",$ARRAYdata_video[desc]);
	echo"<tr ".rowrollover(colgjl($nomor,"#dedede","#ffffff"),"#CCCC99")." style=font-family:helvetica;font-size:12px;text-align:center;>
	<td>$no</td>";
	?>
	<td>
	<script type="text/javascript" src="swfobject.js"></script>
				<object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="300" height="250" wmode=opaque>
					<param name="movie" value="player-viral.swf" />
					<param name="allowfullscreen" value="true" />
					<param name="allowscriptaccess" value="always" />
					<param name="flashvars" value="file=../upload/video/<?php echo $ARRAYdata_video["url"]; ?>" />
					<object type="application/x-shockwave-flash" data="player-viral.swf" width="300" height="250" wmode=opaque>
						<param name="movie" value="player-viral.swf" />
						<param name="allowfullscreen" value="true" />

						<param name="allowscriptaccess" value="always" />
						<param name="flashvars" value="''" />
						<p><a href="http://get.adobe.com/flashplayer">Get Flash</a> to see this player.</p>
					</object>
				</object>

	</td>
	<?php
	echo "<td>$ARRAYdata_video[name]</td>
	<td>$desc</td>
	<td>
	<a href=admin_viewvideo.php?action=view&delete=$ARRAYdata_video[id]><IMG SRC=\"images/delete_icon.gif\" WIDTH=\"20\" HEIGHT=\"20\" BORDER=\"0\" ALT=\"delete\"></a></td>
	</tr>";
	$no++;
}
echo"</table>";
}
if($action==search){
echo"<table align=center bgcolor=gray width=400><form method=post>";
echo"<tr bgcolor=lightgreen><td style=font-family:arial;font-weight:bold; colspan=2>Search Video</td></tr>";
echo"<tr><td style=font-family:arial;font-weight:bold;color:white;width:100px;><input id=cek3 type=checkbox onclick=opensearch();>Name</td><td style=width:300px;><input style=width:300px; type=text name=nama disabled id=nama></td></tr>";
echo"<tr><td colspan=2 align=center><input type=submit name=submit value=Search style=background-color:lightgreen;width:400px;></td></tr>";
echo"</form></table>";
}
////////////////////////MAJOR SCRIPTING END////////////////////////////////////////////////////////////////////////////////////////////
echo"</body>";
?>
<table id=tableeditproduct style="display:none;" bgcolor = <?php echo"$colorg1";?> style = "color : white;">
<tr>
	<td id=tdeditproduct>&nbsp;</td>
</tr>
</table>