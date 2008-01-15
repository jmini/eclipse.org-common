<div id="topnav">
	<ul>

<?php
	global $App;
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
<form action="http://www.google.com/cse" id="searchbox_001774807050229944597:xrjquhh7kg8">
  <input type="hidden" name="cx" value="001774807050229944597:xrjquhh7kg8" />
  <input class="input" type="text" name="q" size="20" />
  <input class="button" type="image" name="sa" value="Search" onclick="this.submit();" alt="Search" title="Search" src="/eclipse.org-common/themes/Phoenix/images/search_btn.gif"/>
</form>
<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=searchbox_001774807050229944597%3Axrjquhh7kg8&lang=en"></script>
	</div>

<div id="topnavsep">
</div>

<?= $Menu->getProjectBranding() ?>
