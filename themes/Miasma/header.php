<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title><?= $pageTitle ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta name="author" content="<?= $pageAuthor ?>" />
	<meta name="keywords" content="<?= $pageKeywords ?>" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Miasma/css/visual.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Miasma/css/layout.css" media="screen" />
	<?php if( isset($extraHtmlHeaders) ) echo $extraHtmlHeaders; ?>
</head>

<body>
<div id="header">
	<a href="/"><img src="/eclipse.org-common/themes/Miasma/images/header_logo.gif" alt="Eclipse Logo" class="logo" border="0" height="71" width="128" /></a>
	<div id="searchbar">
		<form method="get" action="/search/search.cgi">
			<input name="t" value="All" type="hidden" />
			<input name="t" value="Doc" type="hidden" />
			<input name="t" value="Downloads" type="hidden" />
			<input name="wf" value="574a74" type="hidden" />
			<label for="q">Search:</label>
			<input name="q" id="q" value="" type="text" />			
			<input class="button" alt="Submit" onclick="this.submit();" type="submit" value="Go" name="searchbtn" id="searchbtn" />
		</form>
	</div>
	<ul id="headernav">
		<li class="first"><a href="/org/foundation/contact.php">Contact</a></li>
		<li><a href="/legal/">Legal</a></li>
	</ul>