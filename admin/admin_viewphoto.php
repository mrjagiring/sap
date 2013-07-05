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
	if(document.getElementById('cek1').checked==true){
		document.getElementById('category').disabled=false;
	}else{
		document.getElementById('category').disabled=true;
	}
	if(document.getElementById('cek3').checked==true){
		document.getElementById('name').disabled=false;
	}else{
		document.getElementById('name').disabled=true;
	}
}
</script>
<?php
$submit=$_POST[submit];
$action=$_GET[action];
$deletepic=$_GET[deletepic];
$delete=$_GET[delete];
if($deletepic){
	$file=mysqli_result1(mysqli_query($mysqli1,"select `url` from `data_product` where `id`='$deletepic'"),0);
	$file1="../images/product/photo/".$file."";
	$file2="../images/product/thumb/".$file."";
	unlink("$file1");
	unlink("$file2");
	mysqli_query($mysqli1,"update `data_product` set `url`='' where `id`='$deletepic'");
	echo"<table align=center width=500 style=background-color:gray;><tr style=background-color:lightgreen;font-family:arial;font-size:16px;font-weight:bold;><td>Confirmation</td></tr><tr style=font-family:verdana;color:white;font-weight:bold;><td>Success Delete Picture&nbsp;<a href=admin_viewphoto.php?action=view style=color:blue;>BACK </a></td></tr><table>";
	die();
}
if($delete){
	mysqli_query($mysqli1,"delete from `data_product` where `id`='$delete'");
	echo"<table align=center width=500 style=background-color:gray;><tr style=background-color:lightgreen;font-family:arial;font-size:16px;font-weight:bold;><td>Confirmation</td></tr><tr style=font-family:verdana;color:white;font-weight:bold;><td>Success Delete Product&nbsp;<a href=admin_viewphoto.php?action=view style=color:blue;>BACK </a></td></tr><table>";
	die();
}
$TAKEdata_product=mysqli_query($mysqli1,"select * from `data_product`");
echo"<body bgcolor=$bodybgcolor>";
echo"<table style=background-color:gray;>";
echo"<tr style=text-align:center;font-family:arial;font-size:15px;background-color:lightgreen;font-weight:bold;><td>
<input type=button value=ViewAll style=background-color:white; onclick=document.location='admin_viewphoto.php?action=view';><input type=button value=Search style=background-color:white; onclick=document.location='admin_viewphoto.php?action=search';>
</td></tr></table>";
////////////////////////MAJOR SCRIPTING////////////////////////////////////////////////////////////////////////////////////////////
if($submit){
	$category=$_POST[category];
	$name=$_POST[name];
	if($category!=""){
		$sqladd .= " AND `category`='$category'";
	}
	if($name!=""){
		$sqladd .=" and `name`='$name'";
	}
echo"<table align=center bgcolor=gray>";
echo"<tr style=background-color:lightgreen;font-family:arial;font-weight:bold;text-align:center;>
	<td>No</td><td>Picture</td><td width=100>Category</td><td width=100>SubCategory</td><td width=100>Name</td><td>Desc</td><td width=100>action</td>
	</tr>";
	$TAKEdata_product=mysqli_query($mysqli1,"select * from `data_product` where `id`!='' $sqladd");
	$no=1;
	while($ARRAYdata_product=mysqli_fetch_array($TAKEdata_product)){
	if($ARRAYdata_product[url]==""){
		$picture="<IMG SRC=\"../images/noimage.jpg\">";
	}else{
		$picture="<a href=\"../images/product/photo/".$ARRAYdata_product[url]."\" rel=\"lightbox\"><IMG border=0 SRC=\"../images/product/thumb/".$ARRAYdata_product[url]."\"></a>";
	}
	echo"<tr ".rowrollover(colgjl($nomor,"#dedede","#ffffff"),"#CCCC99")." style=font-family:helvetica;font-size:12px;text-align:center;>
	<td>$no</td>
	<td>$picture</td>
	<td><input type=hidden id=category value='$ARRAYdata_product[category]'>$ARRAYdata_product[category]</td>
	<td>$ARRAYdata_product[subcategory]</td>
	<td>$ARRAYdata_product[name]</td>
	<td><textarea rows=7 cols=40 readonly>$ARRAYdata_product[desc]</textarea></td>
	<td><IMG SRC=\"images/edit.gif\" WIDTH=\"30\" HEIGHT=\"20\" BORDER=\"0\" ALT=\"edit\" onclick=editproduct('$ARRAYdata_product[id]','category');>
	<a href=admin_viewphoto.php?action=view&delete=$ARRAYdata_product[id]><IMG SRC=\"images/delete_icon.gif\" WIDTH=\"20\" HEIGHT=\"20\" BORDER=\"0\" ALT=\"delete\"></a></td>
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
	<td>No</td><td>Picture</td><td width=100>Category</td><td width=100>SubCategory</td><td width=100>Name</td><td>Desc</td><td width=100>action</td>
	</tr>";
$TAKEdata_product=mysqli_query($mysqli1,"select * from `data_product` order by `category` asc");
$no=1;
while($ARRAYdata_product=mysqli_fetch_array($TAKEdata_product)){
	$desc=str_replace("<br>","\n",$ARRAYdata_product[desc]);
	if($ARRAYdata_product[url]==""){
		$picture="<IMG SRC=\"../images/noimage.jpg\">";
	}else{
		$picture="<a href=\"../images/product/photo/".$ARRAYdata_product[url]."\" rel=\"lightbox\"><IMG border=0 SRC=\"../images/product/thumb/".$ARRAYdata_product[url]."\"></a>";
	}
	echo"<tr ".rowrollover(colgjl($nomor,"#dedede","#ffffff"),"#CCCC99")." style=font-family:helvetica;font-size:12px;text-align:center;>
	<td>$no</td>
	<td>$picture</td>
	<td><input type=hidden id=category value='$ARRAYdata_product[category]'>$ARRAYdata_product[category]</td>
	<td>$ARRAYdata_product[subcategory]</td>
	<td>$ARRAYdata_product[name]</td>
	<td><textarea rows=7 cols=40 readonly>$desc</textarea></td>
	<td><IMG SRC=\"images/edit.gif\" WIDTH=\"30\" HEIGHT=\"20\" BORDER=\"0\" ALT=\"edit\" onclick=editproduct('$ARRAYdata_product[id]','category');>
	<a href=admin_viewphoto.php?action=view&delete=$ARRAYdata_product[id]><IMG SRC=\"images/delete_icon.gif\" WIDTH=\"20\" HEIGHT=\"20\" BORDER=\"0\" ALT=\"delete\"></a></td>
	</tr>";
	$no++;
}
echo"</table>";
}
if($action==search){
$TAKEdata_category=mysqli_query($mysqli1,"select * from `data_category` order by priority");
echo"<table align=center bgcolor=gray width=400><form method=post>";
echo"<tr bgcolor=lightgreen><td style=font-family:arial;font-weight:bold; colspan=2>Search Product</td></tr>";
echo"<tr><td style=font-family:arial;font-weight:bold;color:white;width:100px;><input id=cek1 type=checkbox onclick=\"opensearch();\">Category</td><td style=width:300px;><select name=category id=category style=width:300px; disabled>";
echo"<option>";
while($ARRAYdata_category=mysqli_fetch_array($TAKEdata_category)){
echo"<option value='$ARRAYdata_category[name]'>$ARRAYdata_category[name]";
}
echo"<option value=other>other";
echo"</select></td></tr>";
echo"<tr><td style=font-family:arial;font-weight:bold;color:white;width:100px;><input id=cek3 type=checkbox onclick=opensearch();>Name</td><td style=width:300px;><input style=width:300px; type=text name=name disabled></td></tr>";
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