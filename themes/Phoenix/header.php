<? 
/*******************************************************************************
 * Copyright (c) 2006 Eclipse Foundation and others.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Denis Roy (Eclipse Foundation)- initial API and implementation
 *******************************************************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?= $pageTitle ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="author" content="<?= $pageAuthor ?>" />
	<meta name="keywords" content="<?= $pageKeywords ?>" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Phoenix/css/small.css" title="small" />
	<link rel="alternate stylesheet" type="text/css" href="/eclipse.org-common/themes/Phoenix/css/large.css" title="large" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Phoenix/css/visual.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Phoenix/css/layout.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Phoenix/css/print.css" media="print" />
	<script type="text/javascript" src="/eclipse.org-common/themes/Phoenix/styleswitcher.js"></script>
	<?php if( isset($extraHtmlHeaders) ) echo $extraHtmlHeaders; ?>
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
			<input type="hidden" name="t" value="Wiki" />
			<input type="hidden" name="wf" value="574a74" />
			<input type="text" name="q" value="" />
			<input type="image" class="button" src="/eclipse.org-common/themes/Phoenix/images/searchbar_submit.gif" alt="Submit" onclick="this.submit();" />
		</form>
	</div>
	<ul id="headernav">
		<li class="first"><a class="smallText" title="Small Text" href="#" onclick="setActiveStyleSheet('small');return false;">A</a> <a class="largeText" title="Large Text" href="#" onclick="setActiveStyleSheet('large');return false;">A</a></li>
		<li><a href="/org/foundation/contact.php">Contact</a></li>
		<li><a href="/legal/">Legal</a></li>
	</ul>
</div>