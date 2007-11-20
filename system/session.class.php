<?php
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

define('ECLIPSE_SESSION', 'ECLIPSESESSION');

require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/classes/friends/friend.class.php");
require_once("/home/data/httpd/eclipse-php-classes/system/dbconnection_rw.class.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");

class Session {

	private $gid		= "";
	private $bugzilla_id= 0;
	private $subnet		= "";
	private $updated_at	= "";
	private $is_persistent	= 0;
	private $Friend		= null;
	private $data		= "";
	
	/**
	 * Default constructor
	 *
	 * @return null
	 */
	function Session($persistent=null) {
		$this->is_persistent = $persistent;
		$this->validate();			
	}
	

	
	function getGID() {
		return $this->gid;
	}
	function getBugzillaID() {
		return $this->bugzilla_id;
	}
	function getSubnet() {
		return $this->subnet;
	}
	function getUpdatedAt() {
		return $this->updated_at;
	}
	function getFriend() {
		return $this->Friend;
	}
	function getData() {
		return unserialize($this->data);
	}
	function getIsPersistent() {
		return $this->is_persistent;
	}
	
	function setGID($_gid) {
		$this->gid = $_gid;
	}
	function setBugzillaID($_bugzilla_id) {
		$this->bugzilla_id = $_bugzilla_id;
	}
	function setSubnet($_subnet) {
		$this->subnet = $_subnet;
	}
	function setUpdatedAt($_updated_at) {
		$this->updated_at = $_updated_at;
	}
	function setFriend($_friend) {
		$this->Friend = $_friend;
	}
	function setData($_data) {
		$this->data = serialize($_data);
	}
	function setIsPersistent($_is_persistent) {
		$this->is_persistent = $_is_persistent;
	}

	
	/**
	 * Validate session based on browser cookie
	 *
	 * @return boolean
	 */
	function validate() {
		$cookie = (isset($_COOKIE[ECLIPSE_SESSION]) ? $_COOKIE[ECLIPSE_SESSION] : "");
		$rValue = false;
		if ( (!$this->load($cookie))) {
        	# Failed - no such session, or session no match.  Need to relogin
        	setcookie(ECLIPSE_SESSION, "", -36000, "/", "eclipse.org");
        	$rValue = false;
        }
        else {
			# TODO: update session?
			$rValue = true;
        	$this->maintenance();
        	$this->setFriend($this->getData());
        }
        return $rValue;
	}

	function destroy() {
	  $cookie = (isset($_COOKIE[ECLIPSE_SESSION]) ? $_COOKIE[ECLIPSE_SESSION] : "");
      $rValue = 1;
	  
/*        if($nbr) {
        	# TODO: untaint
        	$sql = "DELETE FROM sessions WHERE userid = " . $nbr;
        	sqlQuery($sql);
        	unset($_SESSION['s_userAcct']);
  			unset($_SESSION['s_userName']);
  			unset($_SESSION['s_userType']);
        }
      }*/
	}
	
	function create() {
		# create session on the database
		$Friend = $this->getFriend();
		$this->setData($Friend);
		
		# need to have a bugzilla ID to log in
		if($Friend->getBugzillaID() > 0) {
			$App = new App();
			$this->setGID(md5(uniqid(rand(),true)));
			$this->setSubnet($this->getClientSubnet());
			$this->setUpdatedAt($App->getCURDATE());
			
			#$ModLog = new ModLog();
			#$ModLog->setLogTable("Person");
			#$ModLog->setPK1($this->getPersonID());

			$dbc = new DBConnectionRW();
			$dbh = $dbc->connect();
			
			$sql = "INSERT INTO sessions (
						gid,
						bugzilla_id,
						subnet,
						updated_at,
						data,
						is_persistent)
						VALUES (
							" . $App->returnQuotedString($this->getGID()) . ",
							" . $Friend->getBugzillaID() . ",
							" . $App->returnQuotedString($this->getSubnet()) . ",
							NOW(),
							'" . $App->returnJSSAfeString($this->data) . "',
							" . $this->getIsPersistent() . ")";

			mysql_query($sql, $dbh);

			#$ModLog->setLogAction("INSERT");
			#$ModLog->insertModLog();
			$dbc->disconnect();
			
			$cookie_time = 0;
			if($this->persistent) {
				$cookie_time = time()+3600*24*365;
			}
			setcookie(ECLIPSE_SESSION, $this->getGID(), $cookie_time, "/", "eclipse.org");			
		}
	}
	
	function load($_gid) {
		# need to have a bugzilla ID to log in
		
		$rValue = false;
		
		$App = new App();
		$sql = "SELECT	gid,
						bugzilla_id,
						subnet,
						updated_at,
						data,
						is_persistent
				FROM sessions
				WHERE gid = " . $App->returnQuotedString($_gid) . "
					AND subnet = " . $App->returnQuotedString($this->getClientSubnet());
		
		$dbc = new DBConnectionRW();
		$dbh = $dbc->connect();
		$result = mysql_query($sql, $dbh);
		if($result && mysql_num_rows($result) > 0) {
			$rValue = true;
			$myrow = mysql_fetch_assoc($result);
			$this->setGID($_gid);
			$this->setBugzillaID($myrow['bugzilla_id']);
			$this->setSubnet($myrow['subnet']);
			$this->setUpdatedAt($myrow['updated_at']);
			$this->data = $myrow['data'];
			$this->setIsPersistent($myrow['is_persistent']);
		}
		$dbc->disconnect();
		
		return $rValue;
	}
	
	
	function maintenance() {
		$dbc = new DBConnectionRW();
		$dbh = $dbc->connect();
			
		$sql = "DELETE FROM sessions 
				WHERE (updated_at < DATE_SUB(NOW(), INTERVAL 1 DAY) AND is_persistent = 0) 
				OR (subnet = '" . $this->getClientSubnet() . "' AND gid <> '" . $this->getGID() . "')"; 

		mysql_query($sql, $dbh);

		$dbc->disconnect();
	}
		
	function getClientSubnet() {
		# return class-c subnet
		return substr($_SERVER['REMOTE_ADDR'], 0, strrpos($_SERVER['REMOTE_ADDR'], ".")) . ".0";
	}	
}    
?>