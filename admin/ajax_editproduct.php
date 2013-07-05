<?php
$minUserLevel=10;
include("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
$id=$_POST[id];
echo"<input type=hidden id=id value=$id>";
$TAKEdata_category=mysqli_query($mysqli1,"select * from `data_category` order by priority");
$TAKEdata_brand=mysqli_query($mysqli1,"select * from `data_brand` order by priority");
$ARRAYdata_product=mysqli_fetch_array(mysqli_query($mysqli1,"select * from `data_product` where `id`='$id'"));
echo"<body bgcolor=lightblue>";
echo"<table bgcolor=gray width=400>";
echo"<tr bgcolor=lightgreen align=center style=font-family:arial;font-weight:bold;><td colspan=2>Edit Product</td></tr>";
echo"<tr style=font-family:helvetica;font-weight:bold;color:white;><td width=100>Category</td><td><select id=productcategory style=width:300;>
<option value=\"".$ARRAYdata_product[category]."\">".$ARRAYdata_product[category]."";
while($ARRAYdata_category=mysqli_fetch_array($TAKEdata_category)){
echo"<option value=\"".$ARRAYdata_category[name]."\">".$ARRAYdata_category[name]."";
}
echo"</select></td></tr>";
/*echo"<tr style=font-family:helvetica;font-weight:bold;color:white;><td width=100>Brand</td><td><select id=productbrand style=width:300;>
<option value=\"".$ARRAYdata_product[brand]."\">".$ARRAYdata_product[brand]."";
while($ARRAYdata_brand=mysqli_fetch_array($TAKEdata_brand)){
$desc=str_replace("<br>","\n",$ARRAYdata_product[desc]);
echo"<option value=\"".$ARRAYdata_brand[name]."\">".$ARRAYdata_brand[name]."";
}
echo"<option value=other>other";
echo"</select></td></tr>";*/

	if($ARRAYdata_product["brand"] == 0) {
		$bran = "selected";
		$branx = "";
	}
	else {
		$branx = "selected";
		$bran = "";
	}
	if($ARRAYdata_product["show"] == 0) {
		$sh = "selected";
		$shx = "";
	}
	else {
		$shx = "selected";
		$sh = "";
	}
echo"<tr style=font-family:helvetica;font-weight:bold;color:white;><td width=100>Name</td><td><input type=text style=width:300px; value='$ARRAYdata_product[name]' id=productname></td></tr>";
echo"<tr style=font-family:helvetica;font-weight:bold;color:white;><td width=100>Desc</td><td><textarea cols=35 rows=10 id=productdesc>$desc</textarea></td></tr>";
echo"<tr style=font-family:helvetica;font-weight:bold;color:white;><td width=100>Event</td><td><select name=productevent><option value=0 $bran>Our Products<option value=1 $branx>Our Activities</select></td></tr>";
echo"<tr style=font-family:helvetica;font-weight:bold;color:white;><td width=100>Show</td><td><select name=productshow><option value=1 $shx>Yes<option value=0 $sh>No</select></td></tr>";
	if($ARRAYdata_product[url]==""){
		$picture="<IMG SRC=\"../images/noimage.jpg\" align=left>";
	}else{
		$picture="<IMG SRC=\"../images/product/thumb/".$ARRAYdata_product[url]."\" align=left>";
	}
echo"<tr style=font-family:helvetica;font-weight:bold;color:white;><td width=100>Picture</td>
<td>$picture<input type=button value=change style=background-color:white;width:100px; onclick=\"window.open('admin_changeproductpicture.php?id=$id','mywin','left=200,top=200,width=600,height=100,toolbar=1,resizable=0');\"><br><input type=button value=delete style=background-color:white;width:100px; onclick=document.location='admin_viewproduct.php?deletepic=$ARRAYdata_product[id]';></td></tr>";
echo"<tr bgcolor=lightgreen align=right><td colspan=2>
<input type=button value=save name=Submit style=background-color:white; onclick=saveeditproduct();>
<input type=button value=cancel style=background-color:white; onclick=tutupeditproduct();></td></tr>";
echo"</table>";
echo"</body>";
?>
<table id=tablesaveeditproduct style="display:none;" bgcolor = <?php echo"$colorg1";?> style = "color : white;">
<tr>
	<td id=tdsaveeditproduct>&nbsp;</td>
</tr>
</table>