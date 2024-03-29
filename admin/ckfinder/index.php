<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CKeditor in CKfinder</title>
</head>

<body>
<form>
<?php

// Helper function for this sample file.
function printNotFound( $ver )
{
	static $warned;

	if (!empty($warned))
		return;

	echo '<p><br><strong><span style="color: #ff0000">Error</span>: '.$ver.' not found</strong>. ' .
		'This sample assumes that '.$ver.' (not included with CKFinder) is installed in ' .
		'the "ckeditor" sibling folder of the CKFinder installation folder. If you have it installed in ' .
		'a different place, just edit this file, changing the wrong paths in the include ' .
		'(line 57) and the "basePath" values (line 70).</p>' ;
	$warned = true;
}

// This is a check for the CKEditor PHP integration file. If not found, the paths must be checked.
// Usually you'll not include it in your site and use correct path in line 57 and basePath in line 70 instead.
// Remove this code after correcting the include_once statement.
if ( !@file_exists( '../ckeditor/ckeditor.php' ) )
{
	if ( @file_exists('../ckeditor/ckeditor.js') || @file_exists('../ckeditor/ckeditor_source.js') )
		printNotFound('CKEditor 3.1+');
	else
		printNotFound('CKEditor');
}

include_once '../ckeditor/ckeditor.php' ;
require_once 'ckfinder.php' ;

// This is a check for the CKEditor class. If not defined, the paths in lines 57 and 70 must be checked.
if (!class_exists('CKEditor'))
{
	printNotFound('CKEditor');
}
else
{
	$initialValue = '<p>Just click the <b>Image</b> or <b>Link</b> button, and then <b>&quot;Browse Server&quot;</b>.</p>' ;

	$ckeditor = new CKEditor( ) ;
	$ckeditor->basePath	= '/ckeditor/' ;

	// Just call CKFinder::SetupCKEditor before calling editor(), replace() or replaceAll()
	// in CKEditor. The second parameter (optional), is the path for the
	// CKFinder installation (default = "/ckfinder/").
	CKFinder::SetupCKEditor( $ckeditor, '/ckfinder/' ) ;

	$ckeditor->editor('CKEditor1', $initialValue);
}

?>
</form>
</body>
</html>
