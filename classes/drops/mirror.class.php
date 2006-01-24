<?php

require_once("/home/data/httpd/eclipse-php-classes/system/dbconnection.class.php");  # Read-only slave
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");


class Mirror {

	#*****************************************************************************
	#
	# mirror.class.php
	#
	# Author: 	Denis Roy
	# Date:		2005-01-24
	#
	# Description: Functions and modules related to mirror objects
	#
	# HISTORY:
	#
	#*****************************************************************************

	# this class will eventually contain mirror information	


	function selectCountryCodeByIP($_IP) {
		
		$App = new App();
		
		$rValue = "xx";  # no ccode info for this IP
	
	    if($_IP != "") {
	    	
	    	$ipnum = sprintf("%u", ip2long($_IP));
	
		    $dbc = new DBConnection();  # Read-only, to slave!
		    $dbh = $dbc->connect();
		
		    $sql = "SELECT 
						ccode
		        	FROM
						geoip
					WHERE $ipnum BETWEEN start AND end";

		    $result = mysql_query($sql, $dbh);
	
			if($myrow = mysql_fetch_array($result)) {
		    		
				$rValue = $myrow['ccode'];
		    }
		    
		    $dbc->disconnect();
		    $dbh 	= null;
		    $dbc 	= null;
		    $result = null;
		    $myrow	= null;

	    }
	    
	    return $rValue;
	}
}
?>
