<?php
/*******************************************************************************
 * Copyright (c) 2007 Eclipse Foundation and others.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Nathan Gervais (Eclipse Foundation)- initial API and implementation
 *******************************************************************************/
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/smartconnection.class.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/classes/friends/contribution.class.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/classes/friends/friend.class.php");

class FriendsContributions {
	private $friend_id;
	private $contribution_id;
	private $friendObject;
	private $contributionObject;
	
	
	# default constructor
	function FriendsContributions() {
		$this->friend_id 		= "";
		$this->contribution_id	= "";
		$this->friendObject	= new Friend();
		$this->contribitionObject	= new Contribution();
	}
	
	function getFriendID() {
		return $this->friend_id;
	}
	function getContribution() {
		return $this->contribution_id;
	}
	function getFriendObject() {
		return $this->friendObject;
	}
	function getContributionObject() {
		return $this->contributionObject;
	}
	
	function setFriendID($_friend_id){
		$this->friend_id = $_friend_id;
	}
	function setContributionID($_contribution_id) {
		$this->contribution_id = $_contribution_id;
	}
	function setFriendObject($_friendObject) {
		$this->friendObject = $_friendObject;
	}
	function setContributionObject($_contributionObject){
		$this->contributionObject = $_contributionObject;
	}
	
}
