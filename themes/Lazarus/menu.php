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
		<li><a class="<?php echo $aclass; ?>" href="<?php echo $MenuItem->getURL(); ?>" target="<?php echo $MenuItem->getTarget(); ?>"><?php echo $MenuItem->getText(); ?></a></li>
<?php
	}
?>
	</ul>

</div>


	<div id="searchbar"><?php echo $App->getGoogleSearchHTML(); ?></div>

<div id="topnavsep">
</div>

<?php echo $Menu->getProjectBranding(); ?>
