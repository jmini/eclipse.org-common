<div id="leftcol">
<?php
    $level = 0;
	for($i = 0; $i < $Nav->getLinkCount(); $i++) {
		$Link = $Nav->getLinkAt($i);
		$newlevel = $Link->getLevel();
		if( $level < $newlevel ) {
			if( $level == 0 ) {
				?><ul id="leftnav">
<?php
			} else {
				?><ul>
<?php
			}
			$level++;
			?><!-- += <?= $level ?> -->
<?php
		} elseif( $level > $newlevel ) {
			while( $level > $newlevel ) {
				?></li></ul>
				<?php
				$level--;
			}
			?><!-- -= <?= $level ?> -->
<?php
		} else {
			?></li><?php
		}
		if($Link->getTarget() == "__SEPARATOR") {
			?><li class="separator"><a class="separator" href="<?= $Link->getURL() ?>"><?= $Link->getText() ?> &#160;&#160;<img src="/eclipse.org-common/themes/Phoenix/images/leftnav_bullet_down.gif" border="0" alt="" /></a>
<?php
		} else {
			?><li><a href="<?= $Link->getURL() ?>"><?= $Link->getText() ?></a>
<?php
		}
	}
	for($i = $level; $i > 1; $i-- ) {
		?></li></ul>
<?php
	}
/*
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
		
		if($Link->getTarget() == "__SEPARATOR") {
			$liClass = "class=\"separator\"";
			$aClass = "class=\"separator\"";
			$Link->setTarget("");
			
			$Link->setText($Link->getText() . "&#160;&#160;<img src=\"/eclipse.org-common/themes/Phoenix/images/leftnav_bullet_down.gif\" border=\"0\" alt=\"\" />");
		}
		$target = "";
		if($Link->getTarget() != "" && $Link->getTarget() != "_self") {
			$target = "target=\"" . $Link->getTarget() . "\"";
		}

		if( $Link->getLevel() == 2 ) {
?    ?php
		}
		if( $Link->getLevel() == 3 ) {
?    ?php
		}
        if( $Link->getURL() ) {
?    <li <?= $liClass ?>><a <?= $aClass ?> href="<?= $Link->getURL() ?>" <?= $target ?>><?= $Link->getText() ?></a></li>
?php
        } else {
?    <li <?= $liClass ?>><span <?= $aClass ?>><?= $Link->getText() ?></span></li>
?php
        }		
	}	
        */
?>
		<li style="background-image: url(/eclipse.org-common/themes/Phoenix/images/leftnav_fade.jpg); background-repeat: repeat-x; border-style: none;">
			<br /><br /><br /><br /><br />
		</li>
	</ul>
<? /*
	<br />
	<div class="sideitem">
		<h6>Did you know?</h6>
		<p>We may be adding neat tips and tricks, and other stuff here.</p>
		<ul>
			<li>Who writes them?</li>
			<li>Do we moderate them?</li>
			<li>Should the style of this box be identical to the boxes on the right?</li>
		</ul>
		<p>
			<a href="https://bugs.eclipse.org/bugs/show_bug.cgi?id=117903">go comment on quips! &raquo;</a>
		</p>
		<br />
	</div>
*/  ?>

</div>
