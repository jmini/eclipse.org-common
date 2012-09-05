<div id="leftcol">
	<div class="sideitem">
		<h3>Navigation</h3>
		<ul id="leftnav">
<?php
	for($i = 0; $i < $Nav->getLinkCount(); $i++) {
		$liClass = "";
		$aClass = "";
		$aClassSelected = "";
		$Link = $Nav->getLinkAt($i);
		

		if($Link->getLevel() == 2 || $Link->getLevel() == 3) {
			$aClass = "class=\"level" . $Link->getLevel();
			if($Link->getURL() && strpos($_SERVER['SCRIPT_FILENAME'], $Link->getURL())) {
				$aClass .= "selected";
			}
			
			$aClass .= "\"";
		}
		
		# Selected tab
	
		$out = "";
		
		if($Link->getTarget() == "__SEPARATOR") {
			
			echo "</ul></div><div class=\"sideitem\"><h3>" . $Link->getText() . "</h3><ul id=\"leftnav\">";
		}
		else {
			$target = "";
			if($Link->getTarget() != "" && $Link->getTarget() != "_self") {
				$target = "target=\"" . $Link->getTarget() . "\"";
			}
	
	        if( $Link->getURL() ) {
	?>    		<li <?php echo $liClass; ?>><a <?php echo $aClass; ?> href="<?php echo $Link->getURL(); ?>" <?php echo $target; ?>><?php echo $Link->getText(); ?></a></li>
	<?php
	        } else {
	?>    <li <?php echo $liClass; ?>><span <?php echo $aClass; ?>><?php echo $Link->getText(); ?></span></li>
	<?php
	        }
		}		
	}	
?>
		</ul>
	</div>
</div>
