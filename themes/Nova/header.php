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
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/yui/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/yui/2.6.0/build/menu/assets/skins/sam/menu.css" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Nova/css/reset.css"/>
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Nova/css/layout.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Nova/css/header.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Nova/css/footer.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Nova/css/visual.css" media="screen" />
	<!--[if IE]> 	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Nova/css/ie_style.css" media="screen"/> <![endif]-->
	<!--[if IE 6]> 	<link rel="stylesheet" type="text/css" href="/eclipse.org-common/themes/Nova/css/ie6_style.css" media="screen"/> <![endif]-->
	<!-- Dependencies --> 
	<!-- Source File -->
	<?php if( isset($extraHtmlHeaders) ) echo $extraHtmlHeaders; ?>
</head>

<body>
	<div id="novaWrapper"><?//This Div is closed in footer.php?>
		<div id="clearHeader">
			<div id="logo">
				<? if ($App->Promotion == FALSE) { ?>
					 <img src="/eclipse.org-common/themes/Nova/images/eclipse.png" alt="Eclipse.org"/>
				<? } else {
						if ($App->CustomPromotionPath != "") {
							include($App->CustomPromotionPath);
						}
						else {
							include($App->getPromotionPath($theme));
						}
					}
				?>
			</div>
			<div id="otherSites">
				<div id="sites">
				<ul id="sitesUL">
					<li><a href='http://www.eclipseplugincentral.com'><img alt="Eclipse Plugin Central" src="http://dev.eclipse.org/custom_icons/network-wired-bw.png"/>&nbsp;<div>Eclipse Plugin Central</div></a></li>
					<li><a href='http://live.eclipse.org'><img alt="Eclipse Live" src="http://dev.eclipse.org/custom_icons/audio-input-microphone-bw.png"/>&nbsp;<div>Eclipse Live</div></a></li>
		    		<li><a href='https://bugs.eclipse.org/bugs/'><img alt="Bugzilla" src="http://dev.eclipse.org/custom_icons/system-search-bw.png"/>&nbsp;<div>Bugzilla</div></a></li>
		    		<li><a href='http://www.planeteclipse.org/'><img alt="Planet Eclipse" src="http://dev.eclipse.org/large_icons/devices/audio-card.png"/>&nbsp;<div>Planet Eclipse</div></a></li>
		    		<li><a href='http://wiki.eclipse.org/'><img alt="Eclipse Wiki" src="http://dev.eclipse.org/custom_icons/accessories-text-editor-bw.png"/>&nbsp;<div>Eclipse Wiki</div></a></li>
		    		<li><a href='http://portal.eclipse.org'><img alt="MyFoundation Portal" src="http://dev.eclipse.org/custom_icons/preferences-system-network-proxy-bw.png"/><div>My Foundation Portal</div></a></li>
		    	</ul>
		    	</div>
			</div>		
		</div>

