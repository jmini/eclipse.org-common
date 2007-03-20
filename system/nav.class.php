<?php

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
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/link.class.php");

class Nav {

	#*****************************************************************************
	#
	# nav.class.php
	#
	# Author: 		Denis Roy
	# Date			2004-09-11
	#
	# Description: Functions and modules related to Navbar objects
	#
	# HISTORY:
	#
	#*****************************************************************************	
	
	var $LinkList = array();
	
	
	function getLinkList() {
		return $this->LinkList;
	}
	
	function setLinkList($_LinkList) {
		$this->LinkList = $_LinkList;
	}
	
	# Main constructor
	function Nav() {

		$www_prefix = "";
		
		global $App;

		if(isset($App)) {
			$www_prefix = $App->getWWWPrefix();
		}

		$Link = new Link("Committers", "http://wiki.eclipse.org/index.php/Development_Resources", "_self", 1);
		$this->LinkList[count($this->LinkList)] = $Link;

		$Link = new Link("Newsgroups", $www_prefix . "/newsgroups/", "_self", 1);
		$this->LinkList[count($this->LinkList)] = $Link;

		$Link = new Link("Bugs", "https://bugs.eclipse.org/bugs/", "_self", 1);
		$this->LinkList[count($this->LinkList)] = $Link;

		$Link = new Link("Articles", $www_prefix . "/articles/", "_self", 1);
		$this->LinkList[count($this->LinkList)] = $Link;


	}
	
	function addCustomNav($_Text, $_URL, $_Target, $_Level) {
		if($_Level == "") {
			$_Level = 0;
		}
		$Link = new Link($_Text, $_URL, $_Target, $_Level);
			
		# Add incoming Nav Item
		$this->LinkList[count($this->LinkList)] = $Link;
	}

	function addNavSeparator($_Text, $_URL) {
		$Link = new Link($_Text, $_URL, "__SEPARATOR", 1);
			
		# Add incoming Nav Item
		$this->LinkList[count($this->LinkList)] = $Link;
	}
	

	function getLinkCount() {
		return count($this->LinkList);
	}
	
	function getLinkAt($_Pos) {
		if($_Pos < $this->getLinkCount()) {
			return $this->LinkList[$_Pos];
		}
	}
	
	

}
?>