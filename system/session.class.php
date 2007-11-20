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
	private $persistent	= 0;
	private $Friend		= null;
	
	/**
	 * Default constructor
	 *
	 * @return null
	 */
	function Session($persistent=null) {
		$this->persistent = $persistent;
		session_set_cookie_params(0, "/", "eclipse.org", false, true);
		session_start();
		
		if(isset($_SESSION['Friend'])) {
			$this->setFriend($_SESSION['Friend']);
		}
		else {
			$this->setFriend(new Friend());
		}
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

	
	/**
	 * Validate session based on browser cookie
	 *
	 * @return boolean
	 */
	function validate() {
	  $cookie = (isset($_COOKIE[ECLIPSE_SESSION])?$_COOKIE[ECLIPSE_SESSION]:"");
      $rValue = 1;
	  
      /* if ( (!$this->sqlLoad("gid", $gid)) 
        	|| $gid != $this->_gid
        	|| $this->getSubnet() != $this->_subnet) {
        	# Failed - no such session, or session no match.  Need to relogin
        	setcookie(COOKIE_REMEMBER, "", -36000, "/");
        	$rValue = 0;
        }
        else {
        	# Update the session updated_at
        	$this->sqlTouch("updated_at");
        	$this->maintenance();
        }
        SetSessionVar('s_userAcct', $this->_userid);  */
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
						updated_at)
						VALUES (
							" . $App->returnQuotedString($this->getGID()) . ",
							" . $Friend->getBugzillaID() . ",
							" . $App->returnQuotedString($this->getSubnet()) . ",
							NOW())";

			mysql_query($sql, $dbh);

			#$ModLog->setLogAction("INSERT");
			#$ModLog->insertModLog();
			$dbc->disconnect();
			
			if($this->persistent) {
				setcookie(ECLIPSE_SESSION, $this->getGID(), time()+3600*24*365, "/", "eclipse.org");
			}
			
			$_SESSION['Friend'] = $this->getFriend();
		}
	}
	
	function maintenance() {
		# Delete sessions older than 14 days
		#$this->sqlCmd("DELETE FROM {SELF} WHERE updated_at < DATE_SUB(NOW(), INTERVAL 14 DAY)");
	}
		
	function getClientSubnet() {
		# return class-c subnet
		return substr($_SERVER['REMOTE_ADDR'], 0, strrpos($_SERVER['REMOTE_ADDR'], ".")) . ".0";
	}	
}    
?>