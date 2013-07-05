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
	$ARRAYread=mysqli_query($mysqli1,"delete from `pesan` where `akses`='".$_GET[delete]."' and `product` = '".$_GET["pro"]."'");
	echo"<table style=width:100%;text-align:center;font-weight:bold;color:red;><tr><td>Success Delete Data</td></tr></table>";
}
$DATA=mysqli_query($mysqli1,"select distinct(`akses`) from `pesan` order by `id` desc");
?>
<fieldset style=font-family:helvetica;font-weight:block;font-size:12px;>
	<legend>Request</legend>
		<table style=width:100%;text-align:center; cellspacing=0>
			<tr style=background-color:#C0C0C0;>
				<td>No.</td><td>Nama</td><td>Email</td><td>No.Tlp</td><td>Nama Perusahaan</td><td>Product</td><td>Quantity</td><td>Action</td>
			</tr>
			<?php
				$no=1;
				while($ARRAY=mysqli_fetch_array($DATA)){
					$DATADUA = mysqli_query($mysqli1,"select distinct(`product`) from `pesan` where `akses` = '".$ARRAY["akses"]."'");
					while($ARRAYDUA=mysqli_fetch_array($DATADUA)){
						$ARRAYTIGA = mysqli_fetch_array(mysqli_query($mysqli1,"select * from `pesan` where `akses` = '$ARRAY[0]' and `product` = '$ARRAYDUA[0]'"));
						$result = mysqli_result1(mysqli_query($mysqli1,"select `name` from `data_product` where `id` = '".$ARRAYDUA["product"]."'"),0);
						$ARRAYTIGAX = mysqli_fetch_array(mysqli_query($mysqli1,"select sum(quantity) as jumlah from `pesan` where `akses` = '$ARRAY[0]' and `product` = '$ARRAYDUA[0]'"));
						echo"<tr><td style=font-size:12px;>$no</td><td>$ARRAYTIGA[fnama] $ARRAYTIGA[lnama]</td><td>$ARRAYTIGA[email]</td><td>$ARRAYTIGA[tlp]</td><td>$ARRAYTIGA[np]</td><td>$result</td><td>$ARRAYTIGAX[jumlah]</td><td><a href=?read=$ARRAY[0]&pro=$ARRAYDUA[0]>detail</a> | <a href=?delete=$ARRAY[0]&pro=$ARRAYDUA[0]>delete</a></td></tr>";
						$no++;
					}
				}
			?>
		</table>
</fieldset>
<br>
<?php

if($_GET[read]){
	$ARRAYread=mysqli_fetch_array(mysqli_query($mysqli1,"select * from `pesan` where `akses`='".$_GET[read]."' and `product` = '".$_GET["pro"]."'"));
	$result = mysqli_result1(mysqli_query($mysqli1,"select `name` from `data_product` where `id` = '".$_GET["pro"]."'"),0);
	$ARRAYTIGAX = mysqli_fetch_array(mysqli_query($mysqli1,"select sum(quantity) as jumlah from `pesan` where `akses` = '$_GET[read]' and `product` = '$_GET[pro]'"));
	echo"<table border=1 style=width:600px;text-align:center;font-family:helvetica;font-size:13px;>
		<tr><td style=width:250px;>Nama</td><td style=width:250px;>$ARRAYread[fnama] $ARRAYread[lnama]</td></tr>
		<tr><td style=width:250px;>Email</td><td style=width:250px;>$ARRAYread[email]</td></tr>
		<tr><td style=width:250px;>No.Tlp</td><td style=width:250px;>$ARRAYread[tlp]</td></tr>
		<tr><td style=width:250px;>Nama perusahaan</td><td style=width:250px;>$ARRAYread[np]</td></tr>
		<tr><td style=width:250px;>Alamat Perusahaan</td><td style=width:250px;>$ARRAYread[alamat]</td></tr>
		<tr><td style=width:250px;>Kota</td><td style=width:250px;>$ARRAYread[kota]</td></tr>
		<tr><td style=width:250px;>Negara</td><td style=width:250px;>$ARRAYread[negara]</td></tr>
		<tr><td style=width:250px;>Description</td><td style=width:250px;>$ARRAYread[desc]</td></tr>
		<tr><td style=width:250px;>Product</td><td style=width:250px;>$result</td></tr>
		<tr><td style=width:250px;>Quantity</td><td style=width:250px;>$ARRAYTIGAX[jumlah]</td></tr>
	</table>";
}
?>