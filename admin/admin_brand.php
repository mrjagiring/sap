<?php
$minUserLevel=10;
include("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
?>
<script src="fc/fc.js"></script>
<script>
function editbrand(id){
	document.getElementById('editname1'+id).style.display='none';
	document.getElementById('editpriority1'+id).style.display='none';
	document.getElementById('editname2'+id).style.display='block';
	document.getElementById('editpriority2'+id).style.display='block';
	document.getElementById('action1'+id).style.display='none';
	document.getElementById('action2'+id).style.display='block';
}
function canceledit(id){
	document.getElementById('editname1'+id).style.display='block';
	document.getElementById('editpriority1'+id).style.display='block';
	document.getElementById('editname2'+id).style.display='none';
	document.getElementById('editpriority2'+id).style.display='none';
	document.getElementById('action1'+id).style.display='block';
	document.getElementById('action2'+id).style.display='none';
}
</script>
<?php
$submit=$_POST[submit];
$delete=$_GET[delete];
if($submit){
	$brandname=$_POST[brandname];
	$brandpriority=$_POST[brandpriority];
	mysqli_query($mysqli1,"insert into `data_brand` set `name`='$brandname',`priority`='$brandpriority'");
	echo"<table align=center width=500 style=background-color:gray;><tr style=background-color:lightgreen;font-family:arial;font-size:16px;font-weight:bold;><td>Confirmation</td></tr><tr style=font-family:verdana;color:white;font-weight:bold;><td>Success Insert New Brand&nbsp;<a href=admin_brand.php style=color:blue;>BACK </a></td></tr><table>";
	die();
}
if($delete){
	$ARRAYdata_brand=mysqli_fetch_array(mysqli_query($mysqli1,"select `name` from `data_brand` where `id`='$delete'"));
	$TAKEdata_product=mysqli_query($mysqli1,"select * from `data_product` where `brand`='$ARRAYdata_brand[0]'");
	while($ARRAYdata_product=mysqli_fetch_array($TAKEdata_product)){
	$file1="../images/product/photo/".$ARRAYdata_product[url]."";
	$file2="../images/product/thumb/".$ARRAYdata_product[url]."";
	unlink("$file1");
	unlink("$file2");
	}
	mysqli_query($mysqli1,"delete from `data_product` where `brand`='$ARRAYdata_brand[0]'");
	mysqli_query($mysqli1,"delete from `data_brand` where `id`='$delete'");
	echo"<table align=center width=500 style=background-color:gray;><tr style=background-color:lightgreen;font-family:arial;font-size:16px;font-weight:bold;><td>Confirmation</td></tr><tr style=font-family:verdana;color:white;font-weight:bold;><td>Success Delete Brand&nbsp;<a href=admin_brand.php style=color:blue;>BACK </a></td></tr><table>";
	die();
}
echo"<body bgcolor=$bodybgcolor>";
echo"<form method=post><table align=center width=500 bgcolor=gray><tr bgcolor=lightgreen><td colspan=2 style=font-family:arial;font-size:16px;font-weight:bold;text-align:center;>Add Brand</td></tr>";
echo"<tr style=font-family:verdana;font-size:14px;font-weight:bold;><td width=250 style=color:white;>Name</td><td width=250><input type=text name=brandname></td></tr><tr style=font-family:verdana;font-size:14px;font-weight:bold;><td width=250 style=color:white;>Priority</td><td width=250><select name=brandpriority>";
for($i=1;$i<=9;$i++){
	echo"<option value=$i>$i";
}
echo"</select></font></td></tr>";
echo"<tr align=center bgcolor=lightgreen><td colspan=2><input type=submit name=submit value=ADD style=background-color:white;font-family:arial;font-weight:bold;></td></tr></form></table>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<table align=center width=500><tr align=center><td style=color:blue;font-family:helvetica;font-weight:bold;>Registered Brand</td></tr></table>";
echo"<table align=center width=500 bgcolor=gray><tr align=center bgcolor=lightgreen><td colspan=4 style=font-family:arial;font-size:16px;font-weight:bold;>Edit Brand</td></tr>";
echo"<tr align=center style=font-family:verdana;color:white;font-weight:bold;font-size:14px;><td width=50>No</td><td width=150>Brand</td><td width=150>Priority</td><td width=150>Action</td></tr>";
$TAKEdata_brand=mysqli_query($mysqli1,"select * from `data_brand` order by `priority` asc");
$no=1;
while($ARRAYdata_brand=mysqli_fetch_array($TAKEdata_brand)){
	?>
<tr <?php echo"".rowrollover(colgjl($nomor,"#dedede","#ffffff"),"#CCCC99")."";?> align=center style="font-family:Trebuchet MS, Verdana, Helvetica; font-size:12px" >
	<?php
	echo"<td>$no</td>
	<td><a id=editname1$no>$ARRAYdata_brand[name]</a><input type=text value='$ARRAYdata_brand[name]' id=editname2$no style=display:none;></td>
	<td><a id=editpriority1$no>$ARRAYdata_brand[priority]</a><select id=editpriority2$no style=display:none;><option value=$ARRAYdata_brand[priority]>$ARRAYdata_brand[priority]";
	for($i=1;$i<10;$i++){
	echo"<option value=$i>$i";
	}
	echo"</select></td>
	<td id=action1$no style=display:block;>
	<IMG onclick=editbrand('$no'); SRC=\"images/edit.gif\" WIDTH=\"30\" HEIGHT=\"20\" BORDER=\"0\" ALT=\"edit\">&nbsp;&nbsp;
	<a href=admin_brand.php?delete=$ARRAYdata_brand[0]><IMG SRC=\"images/delete_icon.gif\" WIDTH=\"20\" HEIGHT=\"20\" BORDER=\"0\" ALT=\"delete\"></a>
	</td>
	<td id=action2$no style=display:none;>
	<input type=button value=submit style=background-color:white; onclick=submiteditbrand('$no','$ARRAYdata_brand[id]');>
	<input type=button value=cancel style=background-color:white; onclick=canceledit('$no');>
	</td>
	</tr>";
	$no++;
}
echo"</table>";
echo"</body>";
?>
<table id=tablesubmiteditbrand style="visibility:hidden;" bgcolor = blue style = "color:white;">
	<tr>
		<td id=tdsubmiteditbrand>&nbsp;</td>
	</tr>
</table>