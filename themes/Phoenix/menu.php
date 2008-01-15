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
<div id="header-menu"><div id="header-nav">
		<ul>
<?php
	global $App;
	$www_prefix = "";
	$pageRSS = "";
	
	if(isset($App)) {
		$www_prefix = $App->getWWWPrefix();
		
		if($App->PageRSS != "") {
			$pageRSS = $App->PageRSS;
		}
	}

	$firstClass = "class=\"first_one\""; 
	$nextclass = "";
	
	for($i = 0; $i < $Menu->getMenuItemCount(); $i++) {
		$MenuItem = $Menu->getMenuItemAt($i);
			
		
		?>
		<li><a <?=$firstClass;?> href="<?= $MenuItem->getURL(); ?>" target="<?= $MenuItem->getTarget(); ?>"><?= $MenuItem->getText(); ?></a></li> 
		<?php
		$firstClass="";
			}
		?>
		</ul>
	</div>
	<div id="header-utils">
<form action="http://www.google.com/cse" id="searchbox_001774807050229944597:xrjquhh7kg8">
  <input type="hidden" name="cx" value="001774807050229944597:xrjquhh7kg8" />
  <input class="input" type="text" name="q" size="60" />
  <input class="button" type="image" name="sa" value="Search" onclick="this.submit();" alt="Search" title="Search" src="/eclipse.org-common/themes/Phoenix/images/search_btn.gif"/>
</form>
<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=searchbox_001774807050229944597%3Axrjquhh7kg8&lang=en"></script>
		<ul>
			<?php
				if($pageRSS != "") {
			?><li class="rss_feed"><a href="<?= $pageRSS ?>" target="_blank"><img src="/eclipse.org-common/themes/Phoenix/images/rss_btn.gif" alt="RSS" height="16" width="16" border="0" class="rss_icon" /></a></li>
			<?php
				} 
			?>
			<li class="text_size"><a class="smallText" title="Small Text" href="#" onclick="setActiveStyleSheet('small');return false;">A</a> <a class="largeText" title="Large Text" href="#" onclick="setActiveStyleSheet('large');return false;">A</a></li>
		</ul>
	</div></div>