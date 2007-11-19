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
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/smartconnection.class.php");
require_once("/home/data/httpd/eclipse-php-classes/system/dbconnection_bugs_ro.class.php");

class Friend {

	private $friend_id 		= 0;
	private $bugzilla_id	= 0;
	private $first_name		= "";
	private $last_name		= "";
	private $date_joined	= "";
	private $is_anonymous	= 0;
	private $is_benefit		= 0;


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
	


	function setFriendID($_friend_id) {
		$this->friend_id = $_friend_id;
	}
	function setBugzillaID($_bugzilla_id) {
		$this->bugzilla_id = $_bugzilla_id;
	}
	function setFirstName($_first_name) {
		$this->first_name = $_first_name;
	}
	function setLastName($_LastName) {
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
	
	function insertUpdateFriend() {

		if($this->getFriendID() != "") {

			$App = new App();
			#$ModLog = new ModLog();
			#$ModLog->setLogTable("Person");
			#$ModLog->setPK1($this->getPersonID());

			$dbc = new DBConnectionRW();
			$dbh = $dbc->connect();

			if($this->selectFriendExists($this->getFriendID())) {
				# update
				$sql = "UPDATE friends SET
							bugzilla_id = " . $App->returnQuotedString($this->getBugzillaID()) . ",
							first_name = " . $App->returnQuotedString($this->getFirstName()) . ",
							last_name = " . $App->returnQuotedString($this->getLastName()) . ",
							date_joinded = " . $App->returnQuotedString($this->getDateJoined()) . ",
							is_anonymous = " . $App->returnQuotedString($this->getIsAnonymous()) . ",
							is_benefit = " . $App->returnQuotedString($this->getIsBenefit()) . "
						WHERE
							friend_id = " . $this->getFriendID();

					mysql_query($sql, $dbh);

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
							" . $App->returnQuotedString($this->getDateJoined()) . ",
							" . $App->returnQuotedString($this->getIsAnonymous()) . ",
							" . $App->returnQuotedString($this->getIsBenefit()) . ")";

				mysql_query($sql, $dbh);

				#$ModLog->setLogAction("INSERT");
				#$ModLog->insertModLog();
			}

			$dbc->disconnect();
		}
	}


	function selectFriend($_friend_id) {

		if($_friend_id != "") {
			$App = new App();

			$dbc = new DBConnectionRW();
			$dbh = $dbc->connect();

			$sql = "SELECT friend_id,
							bugzilla_id,
							first_name,
							last_name,
							date_joined,
							is_anonymous,
							is_benefit
					FROM friends
					WHERE friend_id = " . $App->returnQuotedString($_friend_id);

			$result = mysql_query($sql, $dbh);

			if ($myrow = mysql_fetch_array($result))	{
				$this->setFriendID		($myrow["friend_id"]);
				$this->setBugzillaID	($myrow["bugzilla_id"]);
				$this->setFirstName		($myrow["first_name"]);
				$this->setLastName		($myrow["last_name"]);
				$this->setDateJoined	($myrow["date_joined"]);
				$this->setIsAnonymous	($myrow["is_anonymous"]);
				$this->setIsBenefit		($myrow["is_benefit"]);
			}
			$dbc->disconnect();
		}
	}


	function selectFriendExists($_friend_id) {
		$result = 0;

		if($_PersonID != "") {
			$App = new App();

			$dbc = new DBConnectionRW();
			$dbh = $dbc->connect();

			$sql = "SELECT friend_id
					FROM friends
					WHERE friend_id = " . $App->returnQuotedString($_friend_id);

			$result = mysql_query($sql, $dbh);
			$myrow = mysql_fetch_array($result);

			$result = $myrow['RecordCount'] > 1 ? 1 : 0;

			$dbc->disconnect();

		}
		return $result;
	}
	
	function getBugzillaIDFromEmail($_email) {
		$result = 0;

		if($_email != "") {
			$App = new App();

			$dbc = new DBConnectionBugs();
			$dbh = $dbc->connect();

			$sql = "SELECT userid
					FROM profiles
					WHERE login_name = " . $App->returnQuotedString($_email);

			$result = mysql_query($sql, $dbh);
			$myrow = mysql_fetch_array($result);

			$result = $myrow['userid'];
			$dbc->disconnect();
		}
		return $result;
	}
}
?>