<?php
include("config.inc.php");
$menuid=$_POST[menuid];
?>
<html>
    <head>
        <title>Save Page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="robots" content="noindex, nofollow">
        
    </head>
    <body>
        <h1>Your page has been updated</h1>
        <hr>
        <table width="100%" border="1" cellspacing="0" bordercolor="#999999">
			<?php
			if ( isset( $_POST ) )
			   $postArray = &$_POST ;            // 4.1.0 or later, use $_POST
			else
			   $postArray = &$HTTP_POST_VARS ;    // prior to 4.1.0, use HTTP_POST_VARS

			foreach ( $postArray as $sForm => $value )
			{
				$postedValue = htmlspecialchars( stripslashes( $value ) ) ;
				$writeValue = stripslashes( $value ) ; 
				mysqli_query($mysqli1,"update `menu_special` set `desc`='$postedValue' where `id`='$menuid'");
			}
			?>
        </table>
</body>
</html>