	<ul id="topnav">
<?php
	$nextclass = "";
	
	for($i = 0; $i < $Menu->getMenuItemCount(); $i++) {
		$MenuItem = $Menu->getMenuItemAt($i);
		

		$aclass = "";		
		if(strpos($_SERVER['SCRIPT_FILENAME'], $MenuItem->getURL())) {
			$aclass 		= "class=\"tabselected\"";
		}
		
		
?>
		<li><a <?php echo $aclass; ?>" href="<?php echo $MenuItem->getURL(); ?>" target="<?php echo $MenuItem->getTarget(); ?>"><?php echo $MenuItem->getText(); ?></a></li>
<?php
	}
?>			
	</ul>
</div>