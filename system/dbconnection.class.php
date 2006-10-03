<?
/*******************************************************************************
 * Copyright (c) 2006 Eclipse Foundation and others.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Denis Roy (Eclipse Foundation)- initial API and implementation
 *******************************************************************************/
class DBConnection {
		#*****************************************************************************
        #
        # dbconnection.class.php
        #
        # Author:       Denis Roy
        # Date:         2004-08-05
        #
        # Description: Functions and modules related to the MySQL database connection
        #
        # HISTORY:  THIS IS A READ-ONLY DB CONNECTION CLASS!
        #
		#*****************************************************************************

        var $MysqlUrl           = "";
        var $MysqlUser          = "";
        var $MysqlPassword      = "";
        var $MysqlDatabase      = "";

        function connect()
        {
                static $dbh;

                $dbh = mysql_connect($this->MysqlUrl, $this->MysqlUser, $this->MysqlPassword);

                if (!$dbh) {
                        echo( "<P>Unable to connect to the database server at this time.</P>" );
                }
                $DbSelected = mysql_select_db($this->MysqlDatabase, $dbh);
                return $dbh;
        }

        function disconnect() {
                mysql_close();
        }
}
?>
