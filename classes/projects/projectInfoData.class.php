<?php
/*******************************************************************************
 * Copyright (c) 2007 Eclipse Foundation and others.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Bjorn Freeman-Benson - Initial API
 *    Nathan Gervais - Fixed __get function to return correct values for multirow records
 *******************************************************************************/
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/smartconnection.class.php");

class ProjectInfoData
{
	private $rows; // raw query results for database, ProjectID, MainKey, SubKey, Value, ProjectInfoID
	private $mainkeys; // [main key] -> # of rows
	private $subkeys;  // [main key] -> true if has subkeys, false otherwise

	function ProjectInfoData( $projectid )
	{
		$dbc = new DBConnection();
		$dbh = $dbc->connect();
		$result = mysql_query("
					SELECT * FROM ProjectInfo, ProjectInfoValues 
						WHERE ProjectID = '$projectid' 
						  AND ProjectInfo.ProjectInfoID = ProjectInfoValues.ProjectInfoID", $dbh);
		$this->rows = array();
		$this->mainkeys = array();
		$this->subkeys = array();
		while($row = mysql_fetch_assoc($result)) {
			$this->rows[] = $row;
			$mainkey = $row['MainKey'];
			if( isset($this->mainkeys[$mainkey])) 
				$this->mainkeys[$mainkey]++;
			else
				$this->mainkeys[$mainkey] = 1;
			if( !isset($this->subkeys[$mainkey]))
				$this->subkeys[$mainkey] = false;
			if( $row['SubKey'] != null )
				$this->subkeys[$mainkey] = true;
		}
		
	}

	function __get( $varname )
	{
		foreach( $this->rows as $row ) {
			$mainkey = $row['MainKey'];
			if( $mainkey == $varname ) {
				if( $this->mainkeys[$mainkey] == 1 ) {
					if( $this->subkeys[$mainkey] == false ) {
						return $row['Value'];
					} else {
						$subrows = array();
						foreach( $this->rows as $rr ) {
							if( $row['ProjectInfoID'] == $rr['ProjectInfoID']) {
								$subrows[] = $rr;

							}
						}
						return new ProjectInfoValues( $this, $subrows );
					}
				} else {
					if( $this->subkeys[$mainkey] == false ) {
						$result = array();
						foreach( $this->rows as $rr ) {
							if( $rr['MainKey'] == $mainkey) {
								$result[] = $rr['Value'];
								
							}
						}
						return $result;
					} else {
						$result = array();
						foreach( $this->rows as $rr ) {
							if( $rr['MainKey'] == $mainkey) {
								$subrows = array();
								foreach( $this->rows as $rrr ) {

									if( $rr['ProjectInfoID'] == $rrr['ProjectInfoID']) {
										$subrows[] = $rrr;
									}
								}
								$result[] = new ProjectInfoValues( $this, $subrows );
							}
						}
						return $result;
					}
				}
			}
		}
		return null;
	}
}

class ProjectInfoValues {
	private $rows;
		function ProjectInfoValues( $projectinfo, $subrows ) {
			$this->rows = $subrows;
		}
		function __get( $varname )
		{
			foreach( $this->rows as $row ) {
				$subkey = $row['SubKey'];
				if( $subkey == $varname ) {
					return $row['Value'];
				}
			}
			return null;
		}
}


?>