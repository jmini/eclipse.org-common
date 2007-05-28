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
<div id="topnav">
<ul>
<li>&nbsp;&nbsp;&nbsp;</li>
<?php
	$nextclass = "";
	
	for($i = 0; $i < $Menu->getMenuItemCount(); $i++) {
		$MenuItem = $Menu->getMenuItemAt($i);
		$startclass 	= "tabstart";
		$aclass 		= "";
		$separatorclass = "tabseparator";
		
		if($nextclass != "") {
			$startclass = $nextclass;
			$nextclass = "";
		}
		
		
		if(strpos($_SERVER['SCRIPT_FILENAME'], $MenuItem->getURL())) {
			$startclass		="tabstartselected";
			$aclass 		= "tabselected";
			$nextclass 		= "tabseparatorselected";
		}
		
		
?>
<li class="<?= $startclass ?>">&#160;&#160;&#160;</li>
<li><a class="<?= $aclass ?>" href="<?= $MenuItem->getURL() ?>" target="<?= $MenuItem->getTarget() ?>"><?= $MenuItem->getText() ?></a></li>
<?php
	}
?>
<li class="<?= $separatorclass ?>">&#160;&#160;&#160;</li>			
</ul>
<div id="topnavsep"></div>
</div>
