<?php
/*******************************************************************************
 * Copyright (c) 2007 Eclipse Foundation and others.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Denis Roy (Eclipse Foundation)- initial API and implementation
 *    Nathan Gervais (Eclipse Foundation) - Extended GetValue, GetValueList 
 *                                          to Accept SubKey
 * 										  - Created new GetHashedValueList()
 *******************************************************************************/
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/smartconnection.class.php");

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
	
	function getValue($_mainKey, $_subKey = NULL) {
		$rValue = "";
		if($_mainKey != "") {
			# loop through 
			for($i = 0; $i < $this->getCount(); $i++) {
				$ProjectInfoValue = $this->getItemAt($i);
				
				if($ProjectInfoValue->getMainKey() == $_mainKey) {
					if ($_subKey == NULL || $ProjectInfoValue->getSubKey() == $_subKey) {
						$rValue = $ProjectInfoValue->getValue();
						break;
					}
				}
			}
		}
		
		return $rValue;
	}

	function getValueList($_mainKey, $_subKey = NULL) {
		$rValue = array();
		if($_mainKey != "") {
			# loop through 
			for($i = 0; $i < $this->getCount(); $i++) {
				$ProjectInfoValue = $this->getItemAt($i);
				
				if($ProjectInfoValue->getMainKey() == $_mainKey) {
					if($_subKey == NULL || $ProjectInfoValue->getSubKey() == $_subKey) {
					$rValue[count($rValue)] = $ProjectInfoValue;						
					}
				}
			}
		}
		
		return $rValue;  # Array of ProjectInfovalues
	}
	
	function getHashedValueList($_projectInfoID) {
		$rValue = array();
		if ($_projectInfoID != "") {
			# loop through
			for($i = 0; $i < $this->getCount(); $i++) {
				$ProjectInfoValue = $this->getItemAt($i);
				
				if($ProjectInfoValue->getProjectInfoID() == $_projectInfoID) {
					$rValue[$ProjectInfoValue->getSubKey()] = $ProjectInfoValue->getValue();
				}
			}
		}
		return $rValue;  # Hashed Array of ProjectInfoValues		
	}
	
	
	function selectProjectInfo($_projectID) {
		
		$dbc = new DBConnection();
		$dbh = $dbc->Connect();

		$sql = "SELECT ProjectInfo.ProjectInfoID, MainKey, SubKey, Value
					FROM ProjectInfo, ProjectInfoValues
					WHERE ProjectID = '$_projectID'
						AND ProjectInfo.ProjectInfoID = ProjectInfoValues.ProjectInfoID";
		$result = mysql_query($sql, $dbh) or die("projectInfo.SelectProjectInfo Error: " .mysql_error()); 
		
		while ($sqlIterator = mysql_fetch_array($result))
		{
			$ProjectInfoValue = new ProjectInfoValue();
			$ProjectInfoValue->setProjectInfoID($sqlIterator[ProjectInfoID]);
			$ProjectInfoValue->setMainKey($sqlIterator[MainKey]);
			$ProjectInfoValue->setSubKey($sqlIterator[SubKey]);
			$ProjectInfoValue->setValue($sqlIterator[Value]);
			$this->add($ProjectInfoValue); 
		}

		
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
