<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/classes/projects/category.class.php");
require_once("/home/data/httpd/eclipse-php-classes/system/dbconnection.class.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");

class CategoryList {

	#*****************************************************************************
	#
	# CategoryList.class.php
	#
	# Author: 	Denis Roy
	# Date:		2005-10-25
	#
	# Description: Functions and modules related Lists of categories (for projects)
	#
	# HISTORY:
	#
	#*****************************************************************************

	var $list = array();
	
	
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

	function selectCategoryList() {
		
		$App = new App();
	    $WHERE = "";
	
	    $sql = "SELECT 
					CAT.category_id,
					CAT.description,
					CAT.image_name
	        	FROM
					categories AS CAT 
				ORDER BY CAT.description ";
				
	    $dbc = new DBConnection();
	    $dbh = $dbc->connect();

	    $result = mysql_query($sql, $dbh);

	    while($myrow = mysql_fetch_array($result)) {
	    		
	            $Category = new Category();
	            $Category->setCategoryID	($myrow["category_id"]);
	            $Category->setDescription	($myrow["description"]);
	            $Category->setImageName	($myrow["image_name"]);
	            $this->add($Category);
	    }

	    $dbc->disconnect();
	    $dbh 	= null;
	    $dbc 	= null;
	    $result = null;
	    $myrow	= null;
	}
}
?>
