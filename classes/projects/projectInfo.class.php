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
 *    Nathan Gervais (Eclipse Foundation) - Expanded new fields being added
 *******************************************************************************/
#require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/smartconnection.class.php");
//require_once "/home/data/httpd/eclipse-php-classes/system/dbconnection.class.php";
#require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");

	$ProjectInfo = new ProjectInfo("tools.ajdt");
	
	echo "Project Name:" . $ProjectInfo->getValue("name") . "\n";
	echo "Releases:" . "\n";
	

	
	

	$list_of_releases_array = $ProjectInfo->getValueList("release");
	for($i = 0; $i < count($list_of_releases_array); $i++) {
		$ProjectInfoValue = $list_of_releases_array[$i];
		echo $i . " " . $ProjectInfoValue->getSubkey() . ": " . $ProjectInfoValue->getValue() . "\n"; 
	}


?>

	




<?php



class ProjectInfo {
	var $projectID		= "";
	var $List 			= array();   # array of ProjectInfoValues()
	
	
	# Default constructor
	function ProjectInfo($_projectID) { 
		$this->setProjectID($_projectID);
		$this->selectProjectInfo($_projectID);
	}
	
	function getProjectID() {
		return $this->projectID;
	}
	function getProjectInfoValues() {
		return $List;
	}

	function setProjectID($_projectID) {
		$this->projectID = $_projectID;
	}
	
	function getValue($_mainKey) {
		$rValue = "";
		if($_mainKey != "") {
			# loop through 
			for($i = 0; $i < $this->getCount(); $i++) {
				$ProjectInfoValue = $this->getItemAt($i);
				
				if($ProjectInfoValue->getMainKey() == $_mainKey) {
					$rValue = $ProjectInfoValue->getValue();
					break;
				}
			}
		}
		
		return $rValue;
	}

	function getValueList($_mainKey) {
		$rValue = array();
		if($_mainKey != "") {
			# loop through 
			for($i = 0; $i < $this->getCount(); $i++) {
				$ProjectInfoValue = $this->getItemAt($i);
				
				if($ProjectInfoValue->getMainKey() == $_mainKey) {
					$rValue[count($rValue)] = $ProjectInfoValue;
				}
			}
		}
		
		return $rValue;  # Array of ProjectInfovalues
	}
	
	function selectProjectInfo($_projectID, $_subkey, $_orderby) {

	}
	
	function selectProjectInfo($_projectID) {
		# $sql = select *everything* for this project
		# while($mysqlroy) {
			$ProjectInfoValue = new ProjectInfoValue();
			$ProjectInfoValue->setProjectInfoID(13822);
			$ProjectInfoValue->setMainKey("name");
			$ProjectInfoValue->setSubKey(null);
			$ProjectInfoValue->setValue("AJDT Developer Tools");
			$this->add($ProjectInfoValue); 

			$ProjectInfoValue = new ProjectInfoValue();
			$ProjectInfoValue->setProjectInfoID(19223);
			$ProjectInfoValue->setMainKey("modulepath");
			$ProjectInfoValue->setSubKey(null);
			$ProjectInfoValue->setValue("org.eclipse-cdt.build");
			$this->add($ProjectInfoValue);
		
			$ProjectInfoValue = new ProjectInfoValue();
			$ProjectInfoValue->setProjectInfoID(2928);
			$ProjectInfoValue->setMainKey("release");
			$ProjectInfoValue->setSubKey("status");
			$ProjectInfoValue->setValue("completed");
			$this->add($ProjectInfoValue);

			$ProjectInfoValue = new ProjectInfoValue();
			$ProjectInfoValue->setProjectInfoID(2928);
			$ProjectInfoValue->setMainKey("release");
			$ProjectInfoValue->setSubKey("name");
			$ProjectInfoValue->setValue("3.0.2");
			$this->add($ProjectInfoValue);

			$ProjectInfoValue = new ProjectInfoValue();
			$ProjectInfoValue->setProjectInfoID(2928);
			$ProjectInfoValue->setMainKey("release");
			$ProjectInfoValue->setSubKey("date");
			$ProjectInfoValue->setValue("2005-02-07");
			$this->add($ProjectInfoValue);
		# }
	}
	
	
	
    function add($_projectInfoValue) {
            $this->List[count($this->List)] = $_projectInfoValue;
    }
    function getCount() {
            return count($this->List);
    }
    function getItemAt($_pos) {
		if($_pos < $this->getCount()) {
			return $this->List[$_pos];
		}
    }
}

class ProjectInfoValue {

	var $projectInfoID 		= 0;
	var	$mainKey			= "";
	var $subKey				= "";
	var $value				= "";
	
	
	function getProjectInfoID() {
		return $this->projectInfoID;
	}
	function getMainKey() {
		return $this->mainKey;
	}
	function getSubKey() {
		return $this->subKey;
	}
	function getValue() {
		return $this->value;
	}
	
	function setProjectInfoID($_projectInfoID) {
		$this->projectInfoID = $_projectInfoID;
	}
	function setMainKey($_mainKey) {
		$this->mainKey = $_mainKey;
	}
	function setSubKey($_subKey) {
		$this->subKey = $_subKey;
	}
	function setValue($_value) {
		$this->value = $_value;
	}

}
?>
