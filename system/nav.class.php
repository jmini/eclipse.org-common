<?php
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
		

		$Link = new Link("Committers", "http://dev.eclipse.org/", "_self", 1);
		$this->LinkList[count($this->LinkList)] = $Link;

		$Link = new Link("Newsgroups", "/newsgroups/", "_self", 1);
		$this->LinkList[count($this->LinkList)] = $Link;

        $Link = new Link("Mailing Lists", "/mail/", "_self", 1);
		$this->LinkList[count($this->LinkList)] = $Link;


		$Link = new Link("Bugs", "https://bugs.eclipse.org/bugs/", "_self", 1);
		$this->LinkList[count($this->LinkList)] = $Link;

		$Link = new Link("Articles", "/articles/", "_self", 1);
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
	

	function getLabel($_Label, $_Language) {
	
		switch($_Language) {
			case "en":
				switch($_Label) {
					case "save" :
						return "Save";
						break;
					case "list" :
						return "Back to list";
						break;
					case "delete" :
						return "Delete";
						break;
				}
			break;
			case "fr":
				switch($_Label) {
					case "save" :
						return "Sauvegarder";
						break;
					case "list" :
						return "Retour � la liste";
						break;
					case "delete" :
						return "Supprimer";
						break;
				}
			break;
		}
				
				
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