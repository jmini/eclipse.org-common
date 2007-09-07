<?php
/*******************************************************************************
 * Copyright (c) 2007 Eclipse Foundation and others.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Nathan Gervais (Eclipse Foundation)- initial API and implementation
 *    Karl Matthias (Eclipse Foundation) - initial API and implementation
 *******************************************************************************/
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/smartconnection.class.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/classes/projects/projectInfo.class.php");


class projectInfoList {

	var $List = array();

	function getList() {
		return $this->$list;
	} 
	function setList($_list) {
		$this->list = $_list;
	}

    function add($_project) {
            $this->list[count($this->list)] = $_project;
    }

    function getCount() {
            return count($this->list);
    }

    function getItemAt($_pos) {
            if($_pos < $this->getCount()) {
                    return $this->list[$_pos];
            }
    }

	function selectProjectInfoList($_projectID = NULL, $_mainKey = NULL, $_subKey = NULL, $_value = NULL, $_projectInfoID = NULL , $_order_by = NULL) {

		   $dbc = new DBConnection();
		   $dbh = $dbc->Connect();		   	
		   	
		   $sql = "SELECT DISTINCT ProjectID
						FROM ProjectInfo, ProjectInfoValues";
		   
		   if ($_projectID) {
		   	
		   		$wheresql .= " ProjectID = '$_projectID'";
		   }
		   if ($_mainKey) {
		   		$wheresql = $this->addAndIfNotNull($wheresql);	
		   		$wheresql .= " MainKey = '$_mainKey'";
		   }
		   if ($_subKey) {
		   		$wheresql = $this->addAndIfNotNull($wheresql);	
		   		$wheresql .= " SubKey = '$_subKey'";
		   }
		   if ($_value) {
		   		$wheresql = $this->addAndIfNotNull($wheresql);	
		   		$wheresql .= " Value = '$_value'";
		   }
		   if ($_projectInfoID) {
		   		$wheresql = $this->addAndIfNotNull($wheresql);	
		   		$wheresql .= " ProjectInfo.ProjectInfoID = '$_projectInfoID'";
		   }
		   		   		   		   
	   
		if($wheresql != "") {
	            $wheresql = " WHERE " . $wheresql. " AND ProjectInfo.ProjectInfoID = ProjectInfoValues.ProjectInfoID";
	    }
	
	    if($_order_by == "") {
	            $_order_by = "MainKey";
	    }
	    $_order_by = " ORDER BY " . $_order_by;		   	
	    
	    $sql = $sql . $wheresql . $_order_by;
	    
	    
	    $result = mysql_query($sql, $dbh) or die ("ProjectInfoList.selectProjectInfoList: ". mysql_error());
	    
	    while ($sqlIterator = mysql_fetch_array($result))
	    {
	    	$projectID = $sqlIterator[ProjectID];
	    	$ProjectInfo = new ProjectInfo($projectID);
	    	$this->add($ProjectInfo); 
	    } 		   
    }
    
	function addAndIfNotNull($_String) {
		# Accept: String - String to be AND'ed
		# return: string - AND'ed String
		
		if($_String != "") {
			$_String = $_String . " AND ";
		}
		
		return $_String;
	}    
}
?>