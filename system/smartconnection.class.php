<?php

	if (file_exists("/home/data/httpd/eclipse-php-classes/system/dbconnection.class.php")) {
		echo "<!-- Using server database -->";
		require_once "/home/data/httpd/eclipse-php-classes/system/dbconnection.class.php";
	} else {
		echo "<!-- Using local database -->";
		require_once ($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/dbconnection.class.php");
	}

?>