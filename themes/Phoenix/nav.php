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
		} elseif( $level > $newlevel ) {
			while( $level > $newlevel ) {
				?></li></ul><?php
				$level--;
			}
			?> 
<?= substr("                  ", 0, $level * 2) ?></li>
<?php
		} else {
			?></li>
<?php
		}
		if( $Link->getURL() == "" ) {
			if($Link->getTarget() == "__SEPARATOR") {
				?>
<?= substr("                  ", 0, $level * 2) ?><li class="separator"><a class="separator"><?= $Link->getText() ?> &#160;&#160;<img src="/eclipse.org-common/themes/Phoenix/images/leftnav_bullet_down.gif" border="0" alt="" /></a><?php
			} else {
				?>
<?= substr("                  ", 0, $level * 2) ?><li><a href="#"><span class="nolink"><?= $Link->getText() ?></span></a><?php
			}
		} else {
			if($Link->getTarget() == "__SEPARATOR") {
				?>
<?= substr("                  ", 0, $level * 2) ?><li class="separator"><a class="separator" href="<?= $Link->getURL() ?>"><?= $Link->getText() ?> &#160;&#160;<img src="/eclipse.org-common/themes/Phoenix/images/leftnav_bullet_down.gif" border="0" alt="" /></a><?php
			} else {
				?>
<?= substr("                  ", 0, $level * 2) ?><li><a href="<?= $Link->getURL() ?>"><?= $Link->getText() ?></a><?php
			}
		}
	}
	for($i = $level; $i > 1; $i-- ) {
		?></li></ul><?php
	}
	?> 
  </li>
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
