<?php

	if ($_SERVER['SERVER_NAME'] == "www.eclipse.org")
		require_once "/home/data/httpd/eclipse-php-classes/system/dbconnection.class.php";
		
	elseif ($_SERVER['SERVER_NAME'] == "phoenix.eclipse.org")
		require_once ($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/dbconnection.class.php");
	
	else
		require_once ($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/dbconnection.class.php");

?>