<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?= $pageTitle ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="<?= $pageAuthor ?>" />
	<meta name="keywords" content="<?= $pageKeywords ?>" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Phoenix/css/visual.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Phoenix/css/layout.css" media="screen" />
	<?php if( isset($extraHtmlHeaders) ) echo $extraHtmlHeaders; ?>
<script type="text/javascript">

sfHover = function() {
	var sfEls = document.getElementById("leftnav").getElementsByTagName("LI");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
</script>
</head>
<body>
<div id="header">
	<a href="/"><img src="/eclipse.org-common/themes/Phoenix/images/header_logo.gif" width="163" height="68" border="0" alt="Eclipse Logo" class="logo" /></a>
	<div id="searchbar">
		<img src="/eclipse.org-common/themes/Phoenix/images/searchbar_transition.gif" width="92" height="26" class="transition" alt="" />
		<img src="/eclipse.org-common/themes/Phoenix/images/searchbar_header.gif" width="64" height="17" class="header" alt="Search" />
		<form method="get" action="/search/search.cgi">
			<input type="hidden" name="t" value="All" />
			<input type="hidden" name="t" value="Doc" />
			<input type="hidden" name="t" value="Downloads" />
			<input type="hidden" name="wf" value="574a74" />
			<input type="text" name="q" value="" />
			<input type="image" class="button" src="/eclipse.org-common/themes/Phoenix/images/searchbar_submit.gif" alt="Submit" onclick="this.submit();" />
		</form>
	</div>
	<ul id="headernav">
		<li class="first"><a href="/org/foundation/contact.php">Contact</a></li>
		<li><a href="/legal/">Legal</a></li>
	</ul>
</div>