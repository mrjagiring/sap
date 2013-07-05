<?php
$foldername="klinikpb";
$webname="www.klinikpb.com";
$DatabaseName = "klinikpb";
$DbHostName = "localhost";
$DbUserName = "root";
$DbPassWord = "";

setcookie("foldnam", "$foldername", time()+31536000);

$mysqli1 = mysqli_connect("$DbHostName", "$DbUserName", "$DbPassWord", "$DatabaseName");
if(!$mysqli1){
echo "<center><table border=1 bgcolor=#FFFF00><tr><td><CENTER><B>Information</B></CENTER></td></tr><tr><td>Error Connected to server ( 1 )...<br><br>(<I>Sorry for inconvinience case</I>)</td></tr></table></center>";
die();
}
?>