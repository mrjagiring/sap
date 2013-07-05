<?php
session_start();
include("config.php");
$cfgProgDir =  'tgsecure/';
$bodybgcolor="white";
$tablebgcolor="#66ccff";
$trbgcolor="#006699";

$angkaonly="onKeypress=\"if (event.keyCode < 48 || event.keyCode > 57 || event.keyCode == 13) { if (event.keyCode == 43 || event.keyCode == 13) event.returnValue=true; else event.returnValue = false; }\"";

?>