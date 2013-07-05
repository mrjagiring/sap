<?php
require_once'../fx.php';
$nav= "select * from page order by page_id";
$query_nav=mysql_query($nav);
$r = mysql_fetch_object($query_nav);


?>

<div id="nav">

<div id="list">
	<div class="top"></div>
    	<p><a href="admin.php" class="parent">Home</a></p>
    <div class="bot"></div>		
</div><!--list-->
<div id="list">
	<div class="top"></div>
    	<p><a href="page.php" class="parent">Page</a></p>
        <ul>
         <?php
		do{
			if($r->page_status == "page"){
				$a = "page.php?id=".$r->page_id;
			}elseif($r->page_status == "unique"){
				$a = $r->page_name.".php";
			}
		echo "<li><a href=\"$a\">$r->page_webname</a></li>";
		}while($r = mysql_fetch_object($query_nav));
		?>
        </ul>
    <div class="bot"></div>		
</div><!--list-->
		
<!--<div id="list">
	<div class="top"></div>
    	<p><a href="#" class="parent" id="add_sub_page">(+) Add New Sub Page</a></p>
    <div class="bot"></div>		
</div>--><!--list-->
<div id="list">
	<div class="top"></div>
    	<p><a href="#" class="parent">Account</a></p>
        <ul>
        	<li><a href="new_pass.php">Reset Password</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    <div class="bot"></div>		
</div><!--list-->

                
</div><!--nav-->
<script type="text/javascript">
	$('#add_sub_page').click(function(){
window.open('add_sub_page.php','image','width=400,height=250,screenX=50,screenY=50,scrollbars=yes,dependent=yes,location=no');
	});
</script>