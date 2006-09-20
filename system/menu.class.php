<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menuitem.class.php");
class Menu {

	#*****************************************************************************
	#
	# menu.class.php
	#
	# Author: 		Denis Roy
	# Date			2004-09-11
	#
	# Description: Functions and modules related to menu objects
	#
	# HISTORY:
	#
	#*****************************************************************************	
	
	var $MenuItemList = array();
	
	var $projectBranding = "";

	function getProjectBranding() {
	  return $this->projectBranding;
	}

	function setProjectBranding($_projectBranding) {
	  $this->projectBranding = $_projectBranding;
	}
	
	function getMenuItemList() {
		return $this->MenuItemList;
	}
	
	function setMenuItemList($_MenuItemList) {
		$this->MenuItemList = $_MenuItemList;
	}
	
	# Main constructor
	function Menu() {
		
		$MenuText = "Home";
		$MenuItem = new MenuItem($MenuText, "/", "_self", 0);
		$this->MenuItemList[count($this->MenuItemList)] = $MenuItem;

		$MenuText = "Community";
		$MenuItem = new MenuItem($MenuText, "/community/", "_self", 0);
		$this->MenuItemList[count($this->MenuItemList)] = $MenuItem;

		$MenuText = "Membership";
		$MenuItem = new MenuItem($MenuText, "/membership/", "_self", 0);
		$this->MenuItemList[count($this->MenuItemList)] = $MenuItem;

		$MenuText = "Committers";
		$MenuItem = new MenuItem($MenuText, "http://wiki.eclipse.org/index.php/Development_Resources", "_self", 0);
		$this->MenuItemList[count($this->MenuItemList)] = $MenuItem;
		

		$MenuText = "Downloads";
		$MenuItem = new MenuItem($MenuText, "/downloads/", "_self", 0);
		$this->MenuItemList[count($this->MenuItemList)] = $MenuItem;

		$MenuText = "Resources";
		$MenuItem = new MenuItem($MenuText, "/resources/", "_self", 0);
		$this->MenuItemList[count($this->MenuItemList)] = $MenuItem;

		$MenuText = "Projects";
		$MenuItem = new MenuItem($MenuText, "/projects/", "_self", 0);
		$this->MenuItemList[count($this->MenuItemList)] = $MenuItem;

		$MenuText = "About Us";
		$MenuItem = new MenuItem($MenuText, "/org/", "_self", 0);
		$this->MenuItemList[count($this->MenuItemList)] = $MenuItem;

	}
	
	function addMenuItem($_Text, $_URL, $_Target) {
		# Menu Items must be added at position 1 .. position 0 is dashboard, last position is Signout
		$MenuItem = new MenuItem($_Text, $_URL, $_Target, 0);
			
		# Add incoming menuitem
		$this->MenuItemList[count($this->MenuItemList)] = $MenuItem;
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

	function getMenuItemCount() {
		return count($this->MenuItemList);
	}
	
	function getMenuItemAt($_Pos) {
		if($_Pos < $this->getMenuItemCount()) {
			return $this->MenuItemList[$_Pos];
		}
	}
	
	

}
?>