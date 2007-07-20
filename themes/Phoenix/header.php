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
 
	$www_prefix = "";
		
	global $App;

	if(isset($App)) {
		$www_prefix = $App->getWWWPrefix();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title><?= $pageTitle ?></title><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta name="author" content="<?= $pageAuthor ?>" />
<meta name="keywords" content="<?= $pageKeywords ?>" /><link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Phoenix/css/small.css" title="small" /><link rel="alternate stylesheet" type="text/css" href="/eclipse.org-common/themes/Phoenix/css/large.css" title="large" /><link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Phoenix/css/visual.css" media="screen" /><link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Phoenix/css/layout.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Phoenix/css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Phoenix/css/header.css" media="screen" />
<script type="text/javascript" src="/eclipse.org-common/themes/Phoenix/styleswitcher.js"></script>
<?php if( isset($extraHtmlHeaders) ) echo $extraHtmlHeaders; ?></head>
<body>
<div id="header">
	<div id="header-graphic" class="eclipse-main">
		<h1>Eclipse</h1>
	</div>
	<div id="header-global-holder"  class="eclipse-main-global">

		<div id="header-global-links">
			<ul>
				<li><a href="/org/foundation/contact.php" class="first_one">Contact</a></li>
				<li><a href="/legal/">Legal</a></li>
			</ul>
		</div>
		<div id="header-icons">
			<a href="#"><img src="/eclipse.org-common/themes/Phoenix/images/eclipse_home_icon.png" width="28" height="28" alt="eclipse foundation button" title="Eclipse Foundation" /></a><a href="#"><img src="/eclipse.org-common/themes/Phoenix/images/planet_icon.png" width="28" height="28" alt="planet eclipse button" title="Planet Eclipse" /></a><a href="#"><img src="/eclipse.org-common/themes/Phoenix/images/plugin_icon.png" width="28" height="28" alt="eclipse plugin central button" title="Eclipse Plugin Central" /></a>

		</div>
	</div>
	<div id="header-nav">
		<ul>
			<li><a href="/" class="first_one">Home</a></li>
			<li><a href="/community/">Community</a></li>
			<li><a href="/membership/">Membership</a></li>

			<li><a href="http://wiki.eclipse.org/index.php/Development_Resources">Committers</a></li>
			<li><a href="/downloads/">Downloads</a></li>
			<li><a href="/resources/">Resources</a></li>
			<li><a href="/projects/">Projects</a></li>
			<li><a href="/org/">About Us</a></li>
		</ul>

	</div>
	<div id="header-utils">
		<form action="/search/search.cgi" method="get">
				<input type="hidden" value="All" name="t"/>
				<input type="hidden" value="Downloads" name="t"/>
				<input type="hidden" value="Live" name="t"/>
				<input type="hidden" value="Wiki" name="t"/>
				<input type="hidden" value="574a74" name="wf"/>
				<input class="input" type="text" value="" name="q"/>

				<input class="button" type="image" onclick="this.submit();" alt="Submit" title="Search" src="/eclipse.org-common/themes/Phoenix/images/search_btn.gif" width="54" height="18"/>
		</form>
		<ul>
			<li class="rss_feed"><a href="http://www.eclipse.org/home/eclipsenews.rss" target="_blank"><img src="/eclipse.org-common/themes/Phoenix/images/rss_btn.gif" height="16" width="16" border="0" class="rss_icon" /></a></li>
			<li class="text_size"><a class="smallText" title="Small Text" href="#" onclick="setActiveStyleSheet('small');return false;">A</a> <a class="largeText" title="Large Text" href="#" onclick="setActiveStyleSheet('large');return false;">A</a></li>
		</ul>
	</div>

</div>