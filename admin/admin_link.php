<?php
$minUserLevel=10;
include("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");

if($_POST["submit"]){
	mysqli_query($mysqli1,"insert into `data_partner` (`name`,`url`) values ('".$_POST["name"]."','".$_POST["url"]."')");
	echo"<table align=center width=500 style=background-color:gray;><tr style=background-color:lightgreen;font-family:arial;font-size:16px;font-weight:bold;><td>Confirmation</td></tr><tr style=font-family:verdana;color:white;font-weight:bold;><td>Success Input New Partner&nbsp;<a href=admin_link.php style=color:blue;>BACK </a></td></tr><table>";
	die();
}
if($_GET["delete"]){
	mysqli_query($mysqli1,"delete from `data_partner` where `id`='$_GET[delete]'");
	echo"<table align=center width=500 style=background-color:gray;><tr style=background-color:lightgreen;font-family:arial;font-size:16px;font-weight:bold;><td>Confirmation</td></tr><tr style=font-family:verdana;color:white;font-weight:bold;><td>Success Delete Partner&nbsp;<a href=admin_link.php style=color:blue;>BACK </a></td></tr><table>";
	die();
}
?>
<script src="fc/fc.js"></script>
<script>
function editcategory(id){
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
 <form method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_size; ?>">
<?php
echo"<table align=center width=500 style=background-color:gray;>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<tr bgcolor=lightgreen><td colspan=2 style=font-family:verdana;font-size:15px;text-align:center;font-weight:bold;>Add New Partner</td></tr>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*echo"<tr>
<td style=font-family:arial;font-weight:bold;color:white; width=200>Category</td>
<td width=300><select style=width:300px; id=productcategory name=productcategory onchange=displaysubcategory();><option value='$productcategory'>$productcategory";
$TAKEdata_category=mysqli_query($mysqli1,"select * from `data_category` where `name`!='$productcategory'");
while($ARRAYdata_category=mysqli_fetch_array($TAKEdata_category)){
	echo"<option value='$ARRAYdata_category[name]'>$ARRAYdata_category[name]";
}
echo"</select></td></tr>";*/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<tr><td style=font-family:arial;font-weight:bold;color:white; width=200>Name</td><td width=300><input style=width:300px; type=text name=name></td></tr>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<tr><td style=font-family:arial;font-weight:bold;color:white; width=200>Url</td><td width=300><input style=width:300px; type=text name=url></td></tr>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<tr bgcolor=lightgreen><td colspan=2 align=center><input type=submit name=submit id=Submit value=Submit></td></tr>"; 
echo"</table></form>";

echo"<table align=center width=500 bgcolor=gray><tr align=center bgcolor=lightgreen><td colspan=4 style=font-family:arial;font-size:16px;font-weight:bold;>Edit Link</td></tr>";
echo"<tr align=center style=font-family:verdana;color:white;font-weight:bold;font-size:14px;><td width=50>No</td><td width=150>Name</td><td width=150>Url</td><td width=150>Action</td></tr>";
$TAKEdata_category=mysqli_query($mysqli1,"select * from `data_partner` order by `id` desc");
$no=1;
while($ARRAYdata_category=mysqli_fetch_array($TAKEdata_category)){
	?>
<tr <?php echo"".rowrollover(colgjl($nomor,"#dedede","#ffffff"),"#CCCC99")."";?> align=center style="font-family:Trebuchet MS, Verdana, Helvetica; font-size:12px" >
	<?php
		//$cate = mysqli_result1(mysqli_query($mysqli1,"select `product` from `data_masterproduct` where	`id` = '$ARRAYdata_category[category]'"),0);
	echo"<td>$no</td>
	<td><a id=editname1$no>$ARRAYdata_category[name]</a><input type=text value='$ARRAYdata_category[name]' id=editname2$no style=display:none;></td>
	<td><a id=editpriority1$no>$ARRAYdata_category[url]</a><input type=text value='$ARRAYdata_category[url]' id=editpriority2$no style=display:none;></td>
	<td id=action1$no style=display:block;>
	<a href=admin_link.php?delete=$ARRAYdata_category[0]><IMG SRC=\"images/delete_icon.gif\" WIDTH=\"20\" HEIGHT=\"20\" BORDER=\"0\" ALT=\"delete\"></a>
	</td>
	<td id=action2$no style=display:none;>
	<input type=button value=submit style=background-color:white; onclick=submiteditcategory('$no','$ARRAYdata_category[id]');>
	<input type=button value=cancel style=background-color:white; onclick=canceledit('$no');>
	</td>
	</tr>";
	$no++;
}
echo"</table>";
echo"</body>";
?>