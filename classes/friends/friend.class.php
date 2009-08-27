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

class Friend {

	private $friend_id 		= 0;
	private $bugzilla_id	= "";
	private $first_name		= "";
	private $last_name		= "";
	private $date_joined	= NULL;
	private $is_anonymous	= 0;
	private $is_benefit		= 0;
	private $email			= "";
	private $roles			= ""; 	## FORMAT: ::XX::  where XX is a Foundation role (CM, PL, PM, etc)
									## Concatenate for multiples: ::CM::::PL::::PM::


	function getFriendID() {
		return $this->friend_id;
	}
	function getBugzillaID() {
		return $this->bugzilla_id;
	}
	function getFirstName() {
		return $this->first_name;
	}
	function getLastName() {
		return $this->last_name;
	}
	function getDateJoined() {
		return $this->date_joined;
	}
	function getIsAnonymous() {
		return $this->is_anonymous;
	}
	function getIsBenefit() {
		return $this->is_benefit;
	}	
	function getEmail() {
		return $this->email;
	}
	private function getRoles() {
		return $this->roles;
	}
	


	function setFriendID($_friend_id) {
		$this->friend_id = $_friend_id;
	}
	function setBugzillaID($_bugzilla_id) {
		$this->bugzilla_id = $_bugzilla_id;
	}
	function setFirstName($_first_name) {
		$this->first_name = $_first_name;
	}
	function setLastName($_last_name) {
		$this->last_name = $_last_name;
	}
	function setDateJoined($_date_joined) {
		$this->date_joined = $_date_joined;
	}
	function setIsAnonymous($_is_anonymous) {
		$this->is_anonymous = $_is_anonymous;
	}
	function setIsBenefit($_is_benefit) {
		$this->is_benefit = $_is_benefit;
	}
	function setEmail($_email) {
		$this->email = $_email;
	}
	private function setRoles($_roles) {
		$this->roles = $_roles;
	}
	
	
	/**
	 * getIsCommitter() - return committer status
	 * @see authenticate()
	 * @return bool user is a committer
	 */
	function getIsCommitter() {
		$rValue = strpos($this->getRoles(), "::CM::");
		if($rValue !== false && $rValue >= 0) {
			$rValue = true;		
		}
		return $rValue;
	}
	
	function insertUpdateFriend() {
		$retVal = 0;

		$App = new App();
		#$ModLog = new ModLog();
		#$ModLog->setLogTable("Person");
		#$ModLog->setPK1($this->getPersonID());

		if ($this->date_joined == NULL)
			$default_date_joined = "NOW()";
		else
			$default_date_joined = $App->returnQuotedString($this->date_joined);
		
		if($this->selectFriendID("friend_id", $this->getFriendID())) {
			# update
			$sql = "UPDATE friends SET
						bugzilla_id = " . $App->returnQuotedString($App->sqlSanitize($this->getBugzillaID(), $dbh)) . ",
						first_name = " . $App->returnQuotedString($App->sqlSanitize($this->getFirstName(), $dbh)) . ",
						last_name = " . $App->returnQuotedString($App->sqlSanitize($this->getLastName(), $dbh)) . ",
						date_joined = " . $default_date_joined . ",
						is_anonymous = " . $App->returnQuotedString($App->sqlSanitize($this->getIsAnonymous(), $dbh)) . ",
						is_benefit = " . $App->returnQuotedString($App->sqlSanitize($this->getIsBenefit(), $dbh)) . "
					WHERE
						friend_id = " . $App->sqlSanitize($this->getFriendID(), $dbh);

				$App->eclipse_sql($sql);
				$retVal = $this->friend_id;
				#$ModLog->setLogAction("UPDATE");
				#$ModLog->insertModLog();

				# Set the Primary Employer ID
		}
		else {
			# insert
			$sql = "INSERT INTO friends (
						bugzilla_id,
						first_name,
						last_name,
						date_joined,
						is_anonymous,
						is_benefit)
					VALUES (
						" . $App->returnQuotedString($this->getBugzillaID()) . ",
						" . $App->returnQuotedString($this->getFirstName()) . ",
						" . $App->returnQuotedString($this->getLastName()) . ",
						" . $default_date_joined . ",
						" . $App->returnQuotedString($this->getIsAnonymous()) . ",
						" . $App->returnQuotedString($this->getIsBenefit()) . ")";
			$App->eclipse_sql($sql);
			$retVal = mysql_insert_id();
			#$ModLog->setLogAction("INSERT");
			#$ModLog->insertModLog();
		}
		return $retVal;
	}


	function selectFriend($_friend_id) {

		if($_friend_id != "") {
			$App = new App();
			$_friend_id = $App->sqlSanitize($_friend_id, $dbh);
			
			$sql = "SELECT /* USE MASTER */ friend_id,
							bugzilla_id,
							first_name,
							last_name,
							date_joined,
							is_anonymous,
							is_benefit
					FROM friends 
					WHERE friend_id = " . $App->returnQuotedString($_friend_id);

			$result = $App->eclipse_sql($sql);

			if ($myrow = mysql_fetch_array($result))	{
				$this->setFriendID		($myrow["friend_id"]);
				$this->setBugzillaID	($myrow["bugzilla_id"]);
				$this->setFirstName		($myrow["first_name"]);
				$this->setLastName		($myrow["last_name"]);
				$this->setDateJoined	($myrow["date_joined"]);
				$this->setIsAnonymous	($myrow["is_anonymous"]);
				$this->setIsBenefit		($myrow["is_benefit"]);
			}
		}
	}
	
	function selectFriendID($_fieldname, $_searchfor) {
		$retVal = 0;

		if( ($_fieldname != "") && ($_searchfor != "")) {
			$App = new App();
			$_fieldname = $App->sqlSanitize($_fieldname, null);
			$_searchfor = $App->sqlSanitize($_searchfor, null);
			
			$sql = "SELECT /* USE MASTER */ friend_id
					FROM friends
					WHERE $_fieldname = " . $App->returnQuotedString($_searchfor);

			$result = $App->eclipse_sql($sql);
			if ($result){
				$myrow = mysql_fetch_array($result);
				$retVal = $myrow['friend_id'];
			}
		}
		return $retVal;
	}
	
	function getBugzillaIDFromEmail($_email) {
		$result = 0;

		if($_email != "") {
			$App = new App();

			$_email 		= $App->sqlSanitize($_email, $dbh);
			
			$sql = "SELECT userid
					FROM profiles
					WHERE login_name = " . $App->returnQuotedString($_email);

			$result = $App->bugzilla_sql($sql);
			$myrow = mysql_fetch_array($result);

			$result = $myrow['userid'];
		}
		return $result;
	}

	/**
	 * authenticate() - Authenticate user using bugzilla credentials
	 * 
	 * @author droy
	 * @param string Email address
	 * @param string password
	 * @return boolean - auth was successful or not
	 * @since 2007-11-20
	 * 
	 * 2009-08-27: Added code for crypt/sha-256 passes
	 * 
	 */
	function authenticate($email, $password) {

		$rValue = false;
		
		$validPaths = array(
			"/home/data/httpd/dev.eclipse.org/html/site_login/"
		);
		$App = new App();
		if($email != "" && $password != "" && ($App->isValidCaller($validPaths) || $App->devmode)) {
			
			$email 		= $App->sqlSanitize($email, null);
			$password 	= $App->sqlSanitize($password, null);

			$sql = "SELECT
						userid,
						login_name,
						LEFT(realname, @loc:=LENGTH(realname) - LOCATE(' ', REVERSE(realname))) AS first_name, 
						SUBSTR(realname, @loc+2) AS last_name,
						cryptpassword
				FROM 
					profiles 
				WHERE login_name = '$email' 
					AND disabledtext = ''";
			$result = $App->bugzilla_sql($sql);
			
			if($result && mysql_num_rows($result) > 0) {
				$myrow 				= mysql_fetch_assoc($result);
				$db_cryptpassword 	= $myrow['cryptpassword'];
				$pw 				= "abc12345";  // never allow db == pw by default
				
				# check password
				if(preg_match("/{([^}]+)}$/", $db_cryptpassword, $matches)) {
					$hash = $matches[0];
					$salt = substr($db_cryptpassword,0,8);
					$pw = $salt . str_replace("=", "", base64_encode(mhash(MHASH_SHA256,$password . $salt))) . $hash;
				}
				else {
					$pw = crypt($password, $db_cryptpassword);
				}

				if($db_cryptpassword == $pw) {
  					$rValue = true;
				
					$this->setBugzillaID($myrow['userid']);
					$this->setEmail($myrow['login_name']);
				
					# Load up the rest of the Friend record
					$friend_id = $this->selectFriendID("bugzilla_id", $this->getBugzillaID());
					if($friend_id > 0) {
						$this->selectFriend($friend_id);
					}
				
					# Override the friend record with (known good) Bugzilla info
					$this->setFirstName($myrow['first_name']);
					$this->setLastName($myrow['last_name']);
				
				
					# Get user roles				
					# Committer
					$sql = "SELECT /* friend.class.php authenticate */ COUNT(1) AS RecordCount FROM PeopleProjects AS PRJ
						INNER JOIN People AS P ON P.PersonID = PRJ.PersonID
						WHERE P.EMail = '$email' AND PRJ.Relation = 'CM' 
						AND (LEFT(PRJ.InactiveDate,10) = '0000-00-00' OR PRJ.InactiveDate IS NULL OR PRJ.InactiveDate > NOW())";

					$result = $App->foundation_sql($sql);
					if($result && mysql_num_rows($result) > 0) {
						$myrow = mysql_fetch_assoc($result);
						if($myrow['RecordCount'] > 0) {
							$this->roles .= "::CM::";
						}			
					}
				}
			}
		}
		return $rValue;
	}
}
?>