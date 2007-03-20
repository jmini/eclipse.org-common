<div id="topnav">
	<ul>

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
		<li><a class="<?= $aclass ?>" href="<?= $MenuItem->getURL() ?>" target="<?= $MenuItem->getTarget() ?>"><?= $MenuItem->getText() ?></a></li>
<?php
	}
?>
	</ul>

</div>


	<div id="searchbar">
		<form method="get" action="<?= $App->getWWWPrefix() ?>/search/search.cgi">
		Search:
			<input type="hidden" name="t" value="All" />
			<input type="hidden" name="t" value="Doc" />
			<input type="hidden" name="t" value="Downloads" />
			<input type="hidden" name="t" value="Wiki" />
			<input type="hidden" name="wf" value="574a74" />
			<input type="text" class="textfield" name="q" value="" />
			<input type="image" class="button" src="<?= $App->getWWWPrefix() ?>/eclipse.org-common/themes/Phoenix/images/searchbar_submit.gif" alt="Submit" onclick="this.submit();" />
		</form>	
	</div>

<div id="topnavsep">
</div>

<?= $Menu->getProjectBranding() ?>
