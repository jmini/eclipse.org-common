<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/smartconnection.class.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/classes/projects/projectInfo.class.php");
#Proof of Concept
$classFoo = new ProjectInfoList();
$classFoo->selectProjectInfoList(NULL, "categories", NULL, "ENT", NULL, NULL);

$count = $classFoo->getCount();

for ($i = 0; $i < $count ;$i++)
{
	
	$FooIterator = $classFoo->getItemAt($i);
	echo $FooIterator->getProjectID() . "---<br/>";
	$mailingListIterator = $FooIterator->getValueList("mailinglist", "type");
	foreach ($mailingListIterator as $pivIt)
	{
		$value = $pivIt->getProjectInfoID();
		$mailingListArray = $FooIterator->getHashedValueList($value);
		echo "Name: $mailingListArray[name]<br/>";
		echo "Type: $mailingListArray[type]<br/>";
		echo "Description: $mailingListArray[description]<br/><br/>";

	}
}
# End PoC

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
	            $wheresql = " WHERE " . $wheresql. "AND ProjectInfo.ProjectInfoID = ProjectInfoValues.ProjectInfoID";
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