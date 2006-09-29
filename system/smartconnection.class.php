<?php

	if (file_exists("/home/data/httpd/eclipse-php-classes/system/dbconnection_rw.class.php")) {
		require_once "/home/data/httpd/eclipse-php-classes/system/dbconnection_rw.class.php";
	} else {
		require_once ($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/dbconnection.class.php");
	}

?>