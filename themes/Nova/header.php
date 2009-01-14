<? 
/*******************************************************************************
 * Copyright (c) 2008 Eclipse Foundation and others.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *     Nathan Gervais (Eclipse Foundation)- initial API and implementation
 *******************************************************************************/

$www_prefix = "";
global $App;
if(isset($App)) {
	$www_prefix = $App->getWWWPrefix();
}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?= $pageTitle ?></title><meta name="author" content="<?= $pageAuthor ?>" />
	<meta name="keywords" content="<?= $pageKeywords ?>" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/yui/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/yui/2.6.0/build/menu/assets/skins/sam/menu.css" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Nova/css/reset.css"/>
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Nova/css/layout.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Nova/css/header.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Nova/css/footer.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Nova/css/visual.css" media="screen" />
	<!--[if IE]> 	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Nova/css/ie_style.css" media="screen"/> <![endif]-->
	<!-- Dependencies --> 
	<!-- Source File -->
	<?php if( isset($extraHtmlHeaders) ) echo $extraHtmlHeaders; ?>
</head>

<body>
	<div id="novaWrapper"><?//This Div is closed in footer.php?>
		<div id="clearHeader">
			<div id="logo">
				<img src="/eclipse.org-common/themes/Nova/images/eclipse.png"/>
			</div>
			<div id="otherSites">
				<div id="sites">
				<ul id="sitesUL">
					<li><a id="epic" href='http://www.eclipseplugincentral.com' alt="Eclipse Plugin Central">&nbsp;<div>Eclipse Plugin Central</div></a></li>
					<li><a id="live" href='http://live.eclipse.org' alt="Eclipse Live">&nbsp;<div>Eclipse Live</div></a></li>
		    		<li><a id="bugzilla" href='https://bugs.eclipse.org/bugs/' alt="Bugzilla">&nbsp;<div>Bugzilla</div></a></li>
		    		<li><a id="planet" href='http://www.planeteclipse.org/' alt="Planet Eclipse">&nbsp;<div>Planet Eclipse</div></a></li>
		    		<li><a id="wiki" href='http://wiki.eclipse.org/' alt="Eclipse Wiki">&nbsp;<div>Eclipse Wiki</div></a></li>
		    		<li><a id="portal" href='http://portal.eclipse.org' alt="MyFoundation Portal">&nbsp;<div>My Foundation Portal</div></a></li>
		    	</ul>
		    	</div>

				<!-- <div id="arrow" class="<?=$siteShow;?>">
					<a class="yui-button" id="otherSitesButton">Other Eclipse Sites</a>
				</div> -->
			</div>		
		</div>

