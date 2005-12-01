<?php

class Link {

	#*****************************************************************************
	#
	# link.class.php
	#
	# Author: 		Denis Roy
	# Date			2004-09-14
	#
	# Description: Functions and modules related to link objects
	#
	# HISTORY:
	#
	#*****************************************************************************	
	
	var $Text	= "";
	var $URL	= "";
	var $Target	= "";
	var $Level = 0;
	
	
	function getText() {
		return $this->Text;
	}
	function getURL() {
		return $this->URL;
	}
	function getTarget() {
		return $this->Target;
	}
	function getLevel() {
		return $this->Level;
	}
	
	function setText($_Text) {
		$this->Text = $_Text;
	}
	function setURL($_URL) {
		$this->URL = $_URL;
	}
	function setTarget($_Target) {
		$this->Target = $_Target;
	}
	function setLevel($_Level) {
		$this->Level = $_Level;
	}


	# Main constructors
	function Link($_Text, $_URL, $_Target, $_Level) {
		$this->setText		($_Text);
		$this->setURL		($_URL);
		$this->setTarget	($_Target);
		$this->setLevel		($_Level);
	}

}
?>