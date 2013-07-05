<?php
function mysqli_result1($sql,$num){
global $mysqli1;
 $abc=@mysqli_fetch_array($sql);
$tampil=$abc[$num];
return $tampil;
}
function mysqli_result2($ket,$table,$where1,$order) {
	global $mysqli1;
	if ($where1) $where = "where $where1";
	if($order) $orderx="order by $order";
	$sql = mysqli_query($mysqli1,"select $ket as ket from `$table`  $orderx");
	//echo "select $ket as ket from `$table`  $orderx<br>";
	$hasil = mysqli_fetch_array($sql);
	$result = $hasil["ket"];
	echo "$result========>";
	mysqli_free_result($sql);
	return $result;
}
function userlevel($val) {
	global $mysqli1;
	$sql = @mysqli_fetch_array(mysqli_query($mysqli1,"SELECT `userlevel` from `tgusers` where `user`='$val'"));
	return (real)($sql["userlevel"]);
}



function chkgjl ($num,$val=false,$val2=false) {	  $_tmp = substr(((string)( $num / 2)),-2,2 );	  if ($_tmp == ".5") { if ($val) return $val; return TRUE; }	  if ($val2) return $val2;	  return FALSE; }

function codedvc ($str) {	$mksh = rand(1,10);	if (chkgjl($mksh)) $sh=rand(337,360);	else $sh=rand(531,580);	$tmp = substr(dechex($sh),1);	for ($i=33;$i<147;$i++) {		$k .= chr($i);	}	$z = "~".$str."~";	for ($i=0;$i<strlen($z);$i++) {		if ($i==0) { 			$tmp .= dechex($sh + ord(substr($z,$i,1)));		} else {			if (chkgjl($i)) {				$tmp .= dechex($sh + ord(substr($z,$i,1)) + substr(ord(substr($tmp,strlen($tmp)-1,1)),-1));			} else {				$tmp .= dechex($sh + ord(substr($z,$i,1)) - substr(ord(substr($tmp,strlen($tmp)-1,1)),-1));			}		}	$tmp = substr($tmp,0,strlen($tmp)-3).substr($tmp,strlen($tmp)-2);	}	return $tmp; }

function decodedvc ($str,$table=false,$chk=false) {	$sh = (real)(hexdec("1".substr($str,0,2)));	if (($sh <= 531) and ($sh >= 580)) $s = "2";	elseif (($sh <= 337) and ($sh >= 360)) $s="1";	else {		$sh = (real)(hexdec("2".substr($str,0,2)));		if (($sh <= 531) and ($sh >= 580)) $s = "2";		elseif (($sh <= 337) and ($sh >= 360)) $s="1";	}	$k=0;	for ($i=2;$i<strlen($str);$i=$i+2) {		$k++;		if ($i==2) { $tmp .= chr(hexdec($s.substr($str,$i,2))-$sh);		} else { 			if (chkgjl($k)) {				$tmp .= chr(hexdec($s.substr($str,$i,2))-$sh + substr(ord(substr($str,$i-1,1)),-1));			} else {				$tmp .= chr(hexdec($s.substr($str,$i,2))-$sh - substr(ord(substr($str,$i-1,1)),-1));			}		}	}	global $login;	if ((substr($tmp,0,1) == "~") and (substr($tmp,-1) == "~")) return substr($tmp,1,-1);	elseif (strlen($str)<1) return false;	else {		if ($table) {		$tmpsql = @mysqli_fetch_array(mysqli_query($mysqli1,"select * FROM `tbl_users` where `user`='".substr($table,0,strpos($table,"."))."'"));

$tmpfield = @mysqli_fetch_array(mysqli_query($mysqli1,"SELECT `field` from `configo` where `date`=now('') and `user`='".$tmpsql["user"]."';"));		@mysqli_query($mysqli1,"DELETE FROM `configo` where `date`=now('') and `user`='".$tmpsql["user"]."';");		if ($tmpfield["field"]) {		@mysqli_query($mysqli1,"INSERT INTO `configo` Set `user`='".$tmpsql["user"]."', `date`=now(''), `ipaddr`='".$tmpsql["ipaddr"]."', `field`='".$tmpfield["field"].", ".substr($table,strpos($table,".")+1)."', `detect`='$login'"); }		else {			@mysqli_query($mysqli1,"INSERT INTO `configo` Set `user`='".$tmpsql["user"]."', `date`=now(''), `ipaddr`='".$tmpsql["ipaddr"]."', `field`='".substr($table,strpos($table,".")+1)."', `detect`='$login'");		}		}		if (userlevel($login)>2) {			if ($chk) return false;			return "<font color=red><B>$tmp</B></font>";		}		return false;	} }


function dead($val,$val2 = False) {
	global $mysqli1;
echo "</form></table></table></table><center><BR><table width=60% align=center bgcolor=#414141 border=0 bordercolor=#FFFFFF>";
echo "<tr bgcolor=#FF9900 align=center>";
if ($val2) echo "<td bgcolor=#595959 align=left><FONT COLOR=#FFFF00 size=3><B>$val2</FONT></td></tr><tr bgcolor=#FF9900 align=center>";
echo "<td align=center><FONT COLOR=#FFFFFF size=5>$val</FONT></td>";
echo "</tr>";
echo "</table>";
exit;
}


function str_head () {
	global $mysqli1;
if (!defined('HEADSEND')) { define('HEADSEND',TRUE); }
echo "\n\n\n\n\n\n\n\n";
echo "\n\t<META content=\"DvC - Devil Creation\" name=Originator>";
echo "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";
}


function htmlhead ($title,$add = false) {
	global $mysqli1;
?>
<HTML><HEAD><TITLE><?php echo"$title" ?></TITLE>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<?php echo $add."\n"; str_head(); ?>
</HEAD>
<script>parent.document.title=self.document.title;</script>
<BODY text=#000000 bgColor=#ffffff leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<style type="text/css">

.headtitle { color: #FFFFFF; background-color: #666666; }
a { color:#000000 }
table { font-family: Verdana; font-size: xx-small}
body {
	background-color: #ffffff;
	scrollbar-face-color: #DEE3E7;
	scrollbar-highlight-color: #FFFFFF;
	scrollbar-shadow-color: #DEE3E7;
	scrollbar-3dlight-color: #D1D7DC;
	scrollbar-arrow-color:  #006699;
	scrollbar-track-color: #EFEFEF;
	scrollbar-darkshadow-color: #98AAB1;
	font-family: Verdana; font-size: xx-small;
}
font,th,td,p { font-family: Verdana, Arial, Helvetica, sans-serif font-size: xx-small;}
input.post, textarea.post, select {
	background-color : #FFFFFF;
}

.topt { color:#FFFF00; font-weight: bold; background-color:#70C09F; font-size:11px; font-family: Verdana, Arial, Helvetica, sans-serif;}
A.topt { color: #FFFF00; text-decoration: none; }
.t1 { color:#000000; background-color:#ffffff; font-size:12px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.t2 { color:#000000; background-color:#cccccc; font-size:12px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.t2xx { color:#000000; background-color:#cccccc; font-size:10px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.t1xx { color:#000000; background-color:#ffffff; font-size:10px; font-family: Verdana, Arial, Helvetica, sans-serif; }
input,textarea, select {
	color : #000000;
	font: normal 9px Verdana, Arial, Helvetica, sans-serif;
	text-indent : 2px;
}
</style>
<?php
}


function rowrollover($col1,$col2,$add = "") {
	global $mysqli1;
	return "bgColor=\"$col1\" onmouseout=\"this.style.backgroundColor='$col1';\" onmouseover=\"this.style.backgroundColor='$col2';\"";
}


function ulevel ($SELF = false) {
	global $mysqli1;
	if (!$SELF) $SELF = $_SERVER["PHP_SELF"];
	$data = @mysqli_fetch_array(mysqli_query ($mysqli1,"SELECT * FROM `administration` WHERE `file`='$SELF'"));
	if ($data["operator"] == 1) $result[] = 5;
	if ($data["editor"] == 1) $result[] = 6;
	if ($data["supervisor"] == 1) $result[] = 7;
	if ($data["billing"] == 1) $result[] = 8;
	if ($data["x"] == 1) $result[] = 9;
	return $result;
}

function colgjl($val,$col1,$col2) {
	global $mysqli1;
	return (chkgjl($val))?$col1:$col2;
}

function memo($to,$from,$subject,$body,$read = 0) {
	global $mysqli1;
	mysqli_query($mysqli1,"INSERT INTO `memo` SET `to`='".addslashes($to)."', `from`='$from', `read`='$read',`subject`='".addslashes($subject)."', `body`='".addslashes($body)."', `date`=now('')");
}

function newmemo($user) {
	global $mysqli1;
	return @mysqli_num_rows(mysqli_query($mysqli1,"SELECT * FROM `memo` WHERE `to`='$user' and `read`=0"));
}


function txxgjl ($num) {
	global $mysqli1;
	  $_tmp = substr(((string)( $num / 2)),-2,2 );
	  if ($_tmp == ".5") { return "t1xx"; }
	  return "t2xx";
}

function unhtmlentities ($string)
{global $mysqli1;
    $trans_tbl = get_html_translation_table (HTML_ENTITIES);
    $trans_tbl = array_flip ($trans_tbl);
    return str_replace("\\'","'",str_replace('\\"','"',strtr ($string, $trans_tbl)));
}

function sdate ($val) {global $mysqli1;
	$year = substr($val,0,4);
	$month = substr($val,5,2);
	$date = substr($val,8,2);
	if ($date != "00") return date("d M Y",mktime(0,0,0,$month,$date,$year));
}

function balance ($user) {global $mysqli1;
	$d = @mysqli_fetch_array(mysqli_query($mysqli1,"SELECT `userlevel`,`nohack`,`balance`,unix_timestamp(expired) from `phpsp_users` where user='$user'"));
	$bal = $d["balance"];
	if ($_SERVER["PHP_SELF"] == "/admin-account.php") {
		$gexp = "exp.gif";
	} else {
		$gexp = "expired.gif";
		$gbal = "suspend.gif";
	}
	$exp = $d["unix_timestamp(expired)"];
	$k = mysqli_query($mysqli1,"SELECT `check` from `active` where user='$user' and `stop`='0000-00-00'");
	$b = @mysqli_fetch_array($k);
	if ($d["userlevel"] == 1) { return "<img src=images/del.gif Alt='Blocked Account'>"; }
	if ((crypt(curr($d["balance"]),$d["nohack"]) == $d["nohack"]) and (crypt(curr($d["balance"]),$b["check"]) == $b["check"])) {
		if (curr($d["balance"]) == "0") return "<img src='reg.gif' Alt=\"New Join\">";
		if ($exp < time()) { return "<img src=".$gexp." Alt=\"Expired account\">"; }
		return false;
	}
	if ($bal > 0) { 
		if (@mysqli_num_rows($k) < 1) { return "<img src='reg.gif' Alt=\"New Join\">"; }
		return "<img src='bal.gif' Alt=\"Suspended Account\">";
	}
	else return "<img src='reg.gif' Alt=\"New Join\">";
	return;
}

function curr($val) {global $mysqli1;
   if (!strpos($val,".")) return number_format($val, 0,'.', '.');
   else return number_format($val, 2,',', '.');
}

function trans($user,$value,$status,$comment = "a") {	global $mysqli1;
	$lastbalance=mysqli_result1(mysqli_query($mysqli1,"SELECT `balance` FROM `tgusers` WHERE `user`='$user'"),0);

	if ($comment == "a") $add = "";
	else $add = ", `comment`='".date("d-m/H:i")."' ";

	if (strtolower($status) == "deposit") $sqladd=", `balance2`='".((real)($value)+(real)($lastbalance))."' ";
	elseif (strtolower($status) == "withdraw") $sqladd=", `balance2`='".((real)($lastbalance)-(real)($value))."' ";
	elseif (strtolower($status) == "adjust") $sqladd=", `balance2`='".$value."' ";
	else $sqladd=", `balance2`='".((real)($lastbalance)+(real)($value))."' ";
	mysqli_query($mysqli1,"INSERT INTO `transaksi` set `tanggal`=now(''), `user`='$user',`nilai`='$value', `status`='$status', `dmasuk`='".date("d-m/H:i")."', `jlhlalu`='$lastbalance', $sqladd"); 
} 

function cdate ($val) {global $mysqli1;
	$year = substr($val,0,4);
	$month = substr($val,5,2);
	$date = substr($val,8,2);
	if ($date != "00") return date("d-m/H:i",mktime(substr($val,11,2),substr($val,14,2),substr($val,17,2),$month,$date,$year));
	return '-';
}

function staff($user,$action) {global $mysqli1;
	global $login;
	if ($user == "") $user = $login;
	mysqli_query($mysqli1,"INSERT INTO `stafflog` SET `userid`='$user', `page`='".$_SERVER["PHP_SELF"]."',`action`='$action', date=now('')");
}

//==================================================
//==================================================

function sqljsdate ($val) {global $mysqli1;
	$year = substr($val,6,4);
	$month = substr($val,3,2);
	$date = substr($val,0,2);
	return "$year-$month-$date ".substr($val,11,2).":".substr($val,14,2).":".substr($val,17,2);
}

function sqlred ($val) {
	$year = substr($val,6,4);
	$month = substr($val,3,2);
	$date = substr($val,0,2);
	return "$year-$month-$date ";
}

//function angka() {
// return "onKeypress=\"if (event.keyCode < 45 || event.keyCode > 57 || event.keyCode == 13) { if (event.keyCode == 13) event.returnValue=true; else event.returnValue = false; }\"";
//}

    //=============================== BACK UP DATABASE ====================================>>>
	//=====================================================================================>>>

function mysqldump ($backupfile,$DbHostName,$DbUserName,$DbPassWord,$DatabaseName) {
	global $mysqli1;
$dbhost=$DbHostName;
$dbuser=$DbUserName;
$dbpass=$DbPassWord;
$dbname=$DatabaseName;
if ($recreate!=1) {

   $path = "dbbackup/";
   if(!file_exists($path . $backupfile))
   {
	$fp2 = fopen ($path.$backupfile,"w");
	fwrite ($fp2,"");
	fclose ($fp2);
        chmod($path.$backupfile, 0777);
   }
}

if ($recreate!=1) {
$filetype = "sql";
if (!eregi("/restore\.",$PHP_SELF)) {
	$cur_time=date("Y-m-d H:i");
	   $tables = mysqli_list_tables($dbname);
	   $num_tables = @mysqli_num_rows($tables);
	   $i = 0;
		$newfile .= "# Hostname: $dbhost\n";
		$newfile .= "# Database: `$dbname`\n";
		$newfile .= "# Generation time: ".date("F j, Y, g:i a")."\n";
		$newfile .= "# Author: xlprox@yahoo.com#\n";
		$newfile .= "###################################################\n\n\n";
	   while($i < $num_tables) { 
	      $table = mysqli_tablename($tables, $i);
		   $table="`".$table."`";
	      $newfile .= get_def($dbname,$table);
	      $newfile .= "\n\n";
	      $newfile .= get_content($dbname,$table);
	      $newfile .= "\n\n";
	      $i++;
	   }	
	$fp = fopen ($path.$backupfile,"w");
	fwrite ($fp,$newfile);
	fclose ($fp);
}
}
}

function get_def($dbname, $table) {
	global $mysqli1;
	$def = "";
    $def .= "DROP TABLE IF EXISTS $table;#%%\n";
    $def .= "CREATE TABLE $table (\n";
    $result = mysqli_db_query($dbname, "SHOW FIELDS FROM $table") or die("Table $table not existing in database");
    while($row = mysqli_fetch_array($result)) {
        $def .= "    `$row[Field]` $row[Type]";
        if ($row["Default"] != "") $def .= " DEFAULT '$row[Default]'";
        if ($row["Null"] != "YES") $def .= " NOT NULL";
       	if ($row[Extra] != "") $def .= " $row[Extra]";
        	$def .= ",\n";
     }
     $def = ereg_replace(",\n$","", $def);
     $result = mysqli_db_query($dbname, "SHOW KEYS FROM $table");
     while($row = mysqli_fetch_array($result)) {
          $kname=$row[Key_name];
          if(($kname != "PRIMARY") && ($row[Non_unique] == 0)) $kname="UNIQUE|$kname";
          if(!isset($index[$kname])) $index[$kname] = array();
          $index[$kname][] = $row[Column_name];
     }
     while(list($x, $columns) = @each($index)) {
          $def .= ",\n";
          if($x == "PRIMARY") $def .= "   PRIMARY KEY (" . implode($columns, ", ") . ")";
          else if (substr($x,0,6) == "UNIQUE") $def .= "   UNIQUE ".substr($x,7)." (" . implode($columns, ", ") . ")";
          else $def .= "   KEY $x (" . implode($columns, ", ") . ")";
     }

     $def .= "\n);#%%";
     return (stripslashes($def));
}

function get_content($dbname, $table) {
	global $mysqli1;
     $content="";
     $result = mysqli_db_query($dbname, "SELECT * FROM $table");
     while($row = mysqli_fetch_row($result)) {
         $insert = "INSERT INTO $table VALUES (";
         for($j=0; $j<mysqli_num_fields($result);$j++) {
            if(!isset($row[$j])) $insert .= "NULL,";
            else if($row[$j] != "") $insert .= "'".addslashes($row[$j])."',";
            else $insert .= "'',";
         }
         $insert = ereg_replace(",$","",$insert);
         $insert .= ");#%%\n";
         $content .= $insert;
     }
     return $content;
}

//===================================================================================
function sql_query($query,$SELF = false) {
	global $mysqli1;
	if (!$SELF) $SELF = $_SERVER["PHP_SELF"];
	if ((eregi("update",$query)) or (eregi("delete",$query)) or (eregi("insert",$query)) or (eregi("change",$query)) or (eregi("create",$query))) {
		$action = @mysqli_fetch_array(mysqli_query("SELECT * FROM `administration` WHERE `file`='$SELF'"));		$action = $action["action"];
		if (($action == '0') or (!$action) or ($action == 0))  { echo '<CENTER><h4><font color=#FF0000>ERROR! Action must be ON<BR>Contact your administrator</font></h4><a href="Javascript:history.back(1)">Back</a>';die('');exit; }
	}
	return mysqli_query($query);
}


function scurr ($val) {
	global $mysqli1;
	$data = @mysqli_fetch_array(mysqli_query("select * from `phpsp_users` where `user`='$val'"));
	if (!$data["curr"]) return "IDR";
	return $data["curr"];
}

function winjs () {
	global $mysqli1;
if (!defined('JSSEND')) {
	define('JSSEND',TRUE);

echo "<script language=\"JavaScript\" type=\"text/javascript\" SRC=\"xchromeless.js\"></SCRIPT>\n";
?>
<script language="JavaScript">
	function OpenIt(urltarget,TITLENAME,W,H) {
	theURL=urltarget;
	wname=TITLENAME.substring(0,3);
	wname.toUpperCase();
	windowREALtit		= TITLENAME;
	windowTIT 	    	= "<font face=verdana size=1 color=white>&nbsp;<img src=icon_bola.gif border=0> .:<b>::"+TITLENAME+"::</b>:.</font>"
	windowCERRARa 		= "close_a.gif";
	windowCERRARd 		= "close_d.gif";
	windowCERRARo 		= "close_o.gif";
	windowNONEgrf 		= "none.gif";
	windowCLOCK			= "clock.gif";
	windowBORDERCOLOR   	= "#363636";
	windowBORDERCOLORsel	= "#FF4A05";
	windowTITBGCOLOR    	= "#363636";
	windowTITBGCOLORsel 	= "#FF4A05";
	var windowW = W;
	var windowH = H;
	var windowX = Math.ceil( (window.screen.width  - (windowW+2)) / 2 );
	var windowY = Math.ceil( (window.screen.height - (windowH+20+2)) / 2 );
	if (navigator.appName == "Microsoft Internet Explorer" && parseInt(navigator.appVersion)>=4) isie=true	
	else  isie=false
	if (isie) { H=H+20+2; W=W+2; }
	s = ",width="+W+",height="+H;
	windowoption = "toolbar=0,location=0,directories=0,status=0,menubar=0,resizable=1,scrollbars=1";
	splash = window.open(urltarget,wname,windowoption+s);
	splash.resizeTo( Math.ceil( W )       , Math.ceil( H ) );
	splash.moveTo  ( Math.ceil( windowX ) , Math.ceil( windowY ) );
//	openchromeless(theURL, wname, W, H, windowCERRARa, windowCERRARd, windowCERRARo, windowNONEgrf, windowCLOCK, windowTIT, windowREALtit , windowBORDERCOLOR, windowBORDERCOLORsel, windowTITBGCOLOR, windowTITBGCOLORsel);
	}
</script>
<?php

}
}


//========================================================================================>>>>
//========================================================================================>>>>

?>