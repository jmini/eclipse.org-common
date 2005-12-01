<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");
require_once("/home/data/httpd/eclipse-php-classes/system/dbconnection_rw.class.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/classes/projects/project.class.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/classes/projects/category.class.php");

class ProjectCategory {

	#*****************************************************************************
	#
	# projectCategory.class.php
	#
	# Author: 	Denis Roy
	# Date:		2005-10-25
	#
	# Description: Functions and modules related to associations between a project and a category
	#
	# HISTORY:
	#
	#*****************************************************************************

	var $project_id;
	var $category_id;
	var $description;
	var $projectObject;
	var $categoryObject;


	# default constructor
	function projectCategory() {
		$this->project_id 		= "";
		$this->category_id		= "";
		$this->description 		= "";
		$this->projectObject	= new Project();
		$this->categoryObject	= new Category();
	}
	
	function getProjectID() {
		return $this->project_id;
	}
	function getCategoryID() {
		return $this->category_id;
	}
	function getDescription() {
		return $this->description;
	}
	function getProjectObject() {
		return $this->projectObject;
	}
	function getCategoryObject() {
		return $this->categoryObject;
	}
	 

	function setProjectID($_project_id) {
		$this->project_id = $_project_id;
	}
	function setCategoryID($_category_id) {
		$this->category_id = $_category_id;
	}
	function setDescription($_description) {
		$this->description = $_description;
	}
	function setProjectObject($_Project) {
		$this->projectObject = $_Project;
	}
	function setCategoryObject($_Category) {
		$this->categoryObject = $_Category;
	}


	function deleteProjectCategory($_project_id, $_category_id) {
		
		$App = new App();
	
	    if($_project_id != "" && $_category_id != "") {
			$WHERE .= " WHERE project_id = " . $App->returnQuotedString($_project_id);
			$WHERE .= " AND category_id = " . $App->returnQuotedString($_category_id);
	
		
		    $sql = "DELETE
	        	FROM
					project_categories "
				. $WHERE;

		    $dbc = new DBConnectionRW();
		    $dbh = $dbc->connect();
		
		    $result = mysql_query($sql, $dbh);
		
		    $dbc->disconnect();
		    $dbh 	= null;
		    $dbc 	= null;
		    $result = null;
		    $myrow	= null;
	    }
	}

	function insertUpdateProjectCategory($_project_id, $_category_id, $_description) {
		
		$App = new App();
	
	    if($_project_id != "" && $_category_id != "") {
		
		    $sql = "INSERT INTO project_categories (
						project_id,
						category_id,
						description
						)
	        		VALUES (
					" . $App->returnQuotedString($_project_id) . ",
					" . $App->returnQuotedString($_category_id) . ",
					" . $App->returnQuotedString($_description) . "
						)";


		    $dbc = new DBConnectionRW();
		    $dbh = $dbc->connect();
		
		    $result = mysql_query($sql, $dbh);
		
		    $dbc->disconnect();
		    $dbh 	= null;
		    $dbc 	= null;
		    $result = null;
		    $myrow	= null;
	    }
	}

}
?>
