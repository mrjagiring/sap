<?php
$minUserLevel = 10;
require("config.inc.php");
include($cfgProgDir . "secure.php");
include("fc/tglibrary.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<HEAD>
		<title>menu </title>
		<meta content="Microsoft Visual Studio .NET 7.1" name="GENERATOR">
		<meta content="Visual Basic .NET 7.1" name="CODE_LANGUAGE">
		<meta content="JavaScript" name="vs_defaultClientScript">
		<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
		<LINK href="menu.css" type="text/css" rel="stylesheet">
		<script src="menu.js" type="text/javascript"></script>
	</HEAD>
	<body class="master" onload=update_onuser();>
<div class="master">
<table height="100%" cellspacing="0" cellpadding="0" border="0">
<tr><td  class="master" onclick="openDiv('memberlist');"><span>Home</span></td></tr></table></div>
<div id="memberlist" style="display: block;">
<table width="200" cellspacing="0" cellpadding="0" border="0" class="link">
<tr><td width="15"></td><td><a class="master" href="editmenu.php?menuid=1" target="main">Home</a></td><tr>

<td colspan="3" class="separator"></td>
</tr>
</table>
</div>
<div class="master">
<table height="100%" cellspacing="0" cellpadding="0" border="0">
<tr><td  class="master" onclick="openDiv('memberlist');"><span>Tentang Kami</span></td></tr></table></div>
<div id="memberlist" style="display: block;">
<table width="200" cellspacing="0" cellpadding="0" border="0" class="link">
<tr><td width="15"></td><td><a class="master" href="editmenu.php?menuid=2" target="main">Tentang Kami</a></td><tr>

<td colspan="3" class="separator"></td>
</tr>
</table>
</div>
<div class="master">
<table height="100%" cellspacing="0" cellpadding="0" border="0">
<tr><td  class="master" onclick="openDiv('memberlist');"><span>Fasilitas</span></td></tr></table></div>
<div id="memberlist" style="display: block;">
<table width="200" cellspacing="0" cellpadding="0" border="0" class="link">
<tr><td width="15"></td><td><a class="master" href="editmenu.php?menuid=3" target="main">Fasilitas</a></td><tr>
<tr><td width="15"></td><td><a class="master" href="editmenu.php?menuid=8" target="main">General Medical Check Up</a></td><tr>
<tr><td width="15"></td><td><a class="master" href="editmenu.php?menuid=9" target="main">Medical Center</a></td><tr>

<td colspan="3" class="separator"></td>
</tr>
</table>
</div>
<div class="master">
<table height="100%" cellspacing="0" cellpadding="0" border="0">
<tr><td  class="master" onclick="openDiv('memberlist');"><span>Jadwal Dokter</span></td></tr></table></div>
<div id="memberlist" style="display: block;">
<table width="200" cellspacing="0" cellpadding="0" border="0" class="link">
<tr><td width="15"></td><td><a class="master" href="editmenu.php?menuid=4" target="main">Jadwal Dokter</a></td><tr>

<td colspan="3" class="separator"></td>
</tr>
</table>
</div>
<div class="master">
<table height="100%" cellspacing="0" cellpadding="0" border="0">
<tr><td  class="master" onclick="openDiv('memberlist');"><span>Events</span></td></tr></table></div>
<div id="memberlist" style="display: block;">
<table width="200" cellspacing="0" cellpadding="0" border="0" class="link">
<tr><td width="15"></td><td><a class="master" href="addevent.php" target="main">Events</a></td><tr>

<td colspan="3" class="separator"></td>
</tr>
</table>
</div>
<div class="master">
<table height="100%" cellspacing="0" cellpadding="0" border="0">
<tr><td  class="master" onclick="openDiv('lblForecast');"><span>Account</span></td></tr></table></div>
<div id="lblForecast" style="display: block;"><table width="200" cellspacing="0" cellpadding="0" border="0" class="link">
<tr><td width="15"></td><td><a class="master" href="admin_password.php" target="main">Password</a></td></tr>
<tr><td width="15"></td><td><a class="master" href="logoff.php" target="_parent">Log Out</a></td></tr><tr><td colspan="3" class="separator"></td></tr>
</table></div>


		<iframe id="onuserframe" style="WIDTH: 0px; HEIGHT: 0px" name="onuserframe" frameBorder="0">
		</iframe><input name="lblSessionLogged" type="hidden" id="lblSessionLogged" value="... Another session has been logged in ...{1} Your session will be terminated!!! {1} If that is not you, please contact your upline!!!" />
	</body>
</HTML>