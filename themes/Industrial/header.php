<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?= $pageTitle ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="<?= $pageAuthor ?>" />
	<meta name="keywords" content="<?= $pageKeywords ?>" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Industrial/css/visual.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Industrial/css/layout.css" media="screen" />
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
<div id="header"> <a href="http://www.eclipse.org/"><img src="/eclipse.org-common/themes/Industrial/images/header_logo.gif" alt="Eclipse Logo" class="logo" border="0" height="68" /></a> 
  <div id="searchbar"> <img src="/eclipse.org-common/themes/Industrial/images/searchbar_transition.gif" class="transition" alt="" height="26" width="92" /> 
    <img src="/eclipse.org-common/themes/Industrial/images/searchbar_header.gif" class="header" alt="Search" height="17" width="64" /> 
    <form method="get" action="/search/search.cgi">
      <input name="t" value="All" type="hidden" />
      <input name="t" value="Doc" type="hidden" />
      <input name="t" value="Downloads" type="hidden" />
      <input name="t" value="Wiki" type="hidden" />
      <input name="wf" value="574a74" type="hidden" />
      <input name="q" value="" type="text" />
      <input class="button" src="/eclipse.org-common/themes/Industrial/images/searchbar_submit.gif" alt="Submit" onclick="this.submit();" type="image" />
    </form>
  </div>
  <ul id="headernav">
    <li class="first"><a href="http://www.eclipse.org/org/foundation/contact.php">Contact</a></li>
    <li><a href="http://www.eclipse.org/legal/">Legal</a></li>
  </ul>
</div>