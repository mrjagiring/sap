<?PHP
$cekbrowser=$_SERVER['HTTP_USER_AGENT'];
$opera=ereg("Opera",$cekbrowser);
if($opera){
echo "<center><BR><BR><BR><BR><BR><BR><BR><BR><table width=500 border=1 bordercolor=black cellspacing=0 cellpadding=0 style='border-width:1px;border-collapse:collapse;' bgcolor=black><tr><td width=100% align=center><BR><font color=yellow size=2 face=arial><B><I>Please Use Internet Explorer or Mozilla for Better Performance...<BR>".$SITENAME."<BR>&nbsp;</i></b></td></tr></table></center>";
die();
}
//  ------ create table variable ------
// variables for Netscape Navigator 3 & 4 are +4 for compensation of render errors
$Browser_Type  =  strtok($HTTP_ENV_VARS['HTTP_USER_AGENT'],  "/");
if ( ereg( "MSIE", $HTTP_ENV_VARS['HTTP_USER_AGENT']) || ereg( "Mozilla/5.0", $HTTP_ENV_VARS['HTTP_USER_AGENT']) || ereg ("Opera/5.11", $HTTP_ENV_VARS['HTTP_USER_AGENT']) ) {
	$theTable = 'WIDTH="400" HEIGHT="245"';
} else {
	$theTable = 'WIDTH="404" HEIGHT="249"';
}

echo $HTTP_ENV_VARS["QUERY_STRING"];

// ------ create document-location variable ------
if ( ereg("php\.exe", $HTTP_SERVER_VARS['PHP_SELF']) || ereg("php3\.cgi", $HTTP_SERVER_VARS['PHP_SELF']) || ereg("phpts\.exe", $HTTP_SERVER_VARS['PHP_SELF']) ) {
	$documentLocation = $HTTP_ENV_VARS['PATH_INFO'];
} else {
	$documentLocation = $HTTP_SERVER_VARS['PHP_SELF'];
}
if ( $HTTP_ENV_VARS['QUERY_STRING'] ) {
	$documentLocation .= "?" . $HTTP_ENV_VARS['QUERY_STRING'];
}

?>
<html><head>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<title></title>
	
<SCRIPT LANGUAGE="JavaScript">
<!--
//  ------ check form ------
function checkData() {
	var f1 = document.forms[0];
	var wm = "<?PHP echo $strJSHello; ?>\n\r\n";
	var noerror = 1;

	// --- entered_login ---
	var t1 = f1.entered_login;
	if (t1.value == "" || t1.value == " ") {
		wm += "<?PHP echo $strLogin; ?>\r\n";
		noerror = 0;
	}

	// --- entered_password ---
	var t1 = f1.entered_password;
	if (t1.value == "" || t1.value == " ") {
		wm += "<?PHP echo $strPassword; ?>\r\n";
		noerror = 0;
	}

	// --- check if errors occurred ---
	if (noerror == 0) {
		alert(wm);
		return false;
	}
	else return true;
}
//-->
</SCRIPT>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

<body bgcolor="White" TEXT="Black" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" valign=top>
  <!--DWLayoutDefaultTable-->

  <tr>
    <td width="85%" valign=top><form action='<?PHP echo $documentLocation; ?>' METHOD="post" onsubmit="md5hash(entered_password, vb_login_md5password, vb_login_md5password_utf, 0)"><br><br><br>
	<script type="text/javascript" src="tgsecure/vbulletin_md5.js"></script>
<TABLE width=550 Align=center BORDER=0 CELLPADDING="0" CELLSPACING="0">
        <TBODY>

<TR height=25>
   <TD bgcolor=darkblue colspan=2 style="BORDER-RIGHT: #214db5 1px solid; BORDER-TOP: #214db5 1px solid; BORDER-LEFT: #214db5 1px solid" 
         >
       <FONT face=Verdana Size=3 color=#ffffff>
          <B>&nbsp;Admin Login</B>
       </FONT>   
   </TD>
</TR>   


<TR height=70>
   <TD bgcolor=lightyellow colspan=2 align=middle style="BORDER-RIGHT: #214db5 1px solid; BORDER-LEFT: #214db5 1px solid" 
         >
       <FONT align="middle" face="verdana" size="2" color=black>
             <MARQUEE width=500 SCROLLDELAY=150 BEHAVIOR="alternate" ><b>
                  Admin Login Interface</b>
             </MARQUEE>
       </FONT>
   </TD>
</TR>   
<tr>
   <td bgcolor=lightyellow width="50%" ALIGN="right" style="BORDER-LEFT: #214db5 1px solid">
       <font face="Verdana" Size=3 color=mediumblue>
            <b>User Name :&nbsp;</b> 
       </font>
   </td>

   <td bgcolor=lightyellow style="BORDER-RIGHT: #214db5 1px solid">
       <font face="Verdana">
             <input id="navbar_username"  name="entered_login" tabindex="1" autocomplete=off size="16" style=height:19 type="text">
       </font>
   </td>
</tr>

<tr>
   <td bgcolor=lightyellow ALIGN="right" style="BORDER-LEFT: #214db5 1px solid">
       <font face="Verdana" size="3" color=mediumblue>
            <b>Password :&nbsp;</b>
       </font>
   </td>

   <td bgcolor=lightyellow style="BORDER-RIGHT: #214db5 1px solid">
       <font face="Verdana">
            <input id="navbar_password" type="password" tabindex="2" name="entered_password" size="16" style=height:20 autocomplete=off  style='font-size:14px;'>
       </font>
   </td>
</tr>

<tr>
   <td bgcolor=lightyellow ALIGN="right" style="BORDER-LEFT: #214db5 1px solid">
       <font face="Verdana" size="3" color=mediumblue>
            <b>validation :&nbsp;</b>
       </font>
   </td>

   <td bgcolor=lightyellow style="BORDER-RIGHT: #214db5 1px solid">
       <font face="Verdana">
            <input type="text" tabindex="2" style=height:19 name="entered_val" size=16 autocomplete=off align=center style='font-size:14px;'>
       </font>
   </td>
</tr>

<tr>
   <td bgcolor=lightyellow ALIGN="right" style="BORDER-LEFT: #214db5 1px solid">
       <font face="Verdana" size="3" color=mediumblue>&nbsp;
       </font>
   </td>

   <td bgcolor=lightyellow style="BORDER-RIGHT: #214db5 1px solid">
       <font face="Verdana">
           <img src="captcha/captcha.php?.png" alt="CAPTCHA" width="115" height="25">
       </font>
   </td>
</tr>

<tr height=50>
   <td bgcolor=lightyellow colspan=2 style="BORDER-RIGHT: #214db5 1px solid; BORDER-LEFT: #214db5 1px solid">&nbsp;
      
   </td>
</TD>

<tr>
   <td bgcolor=lightyellow align=middle colspan=2 style="BORDER-RIGHT: #214db5 1px solid; BORDER-LEFT: #214db5 1px solid">

   </td></TD>

<tr>
   <td bgcolor=lightyellow colspan=2 style="BORDER-RIGHT: #214db5 1px solid; BORDER-LEFT: #214db5 1px solid; BORDER-BOTTOM: #214db5 1px solid">&nbsp;
       
   </td>
</tr>
      
<tr height=10>
   <td colspan=2>&nbsp;
       
   </td>
</tr>

<tr>
   <td colspan=2 ALIGN="right">
       <font face="Verdana">
           <input name="Reset" Type="reset" value="Reset">
           <input name="Submit" Type="submit" value="Login" onSubmit="return checkData()">
       </font>
   </td>
</tr>

<tr height=10>
   <td colspan=2 align=middle>
       <font face="Verdana" size="2" color="blue">©Copyright 2008 by <?php echo $webname; ?></A></font>
   </td>
</tr>
<input name="vb_login_md5password" type="hidden">
<input name="vb_login_md5password_utf" type="hidden">
</form>
</TABLE>

</td>
  </tr>
  </table>
<map name="Map">
  <area shape="rect" coords="3,4,115,34" href="join.php" target="utama">
</map>
<map name="Map2">
  <area shape="rect" coords="2,3,102,31" href="index_login.php" target="_parent">
</map>




</body></html>
