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
	var $mirror_id 				= 0;  #PK
	var $organization			= "";
	var $ccode					= "";
	var $r30					= 0;
	var $update_ip_allow		= "";
	var $email					= "";
	var $is_internal			= 0;
	var $is_advertise			= 0;
	var $date_enabled			= "";
	var $create_status			= "";
	var $contact				= "";
	var $internal_host_pattern	= "";
	var $last_verified 			= "";

	
	function getMirrorID() {
		return $this->mirror_id;
	}
	function getOrganization() {
		return $this->organization;
	}
	function getCCode() {
		return $this->ccode;
	}
	function getR30() {
		return $this->r30;
	}
	function getUpdateIPAllow() {
		return $this->update_ip_allow;
	}
	function getEMail() {
		return $this->email;
	}
	function getIsInternal() {
		return $this->is_internal;
	}
	function getIsAdvertise() {
		return $this->is_advertise;
	}
	function getDateEnabled() {
		return $this->date_enabled;
	}
	function getCreateStatus() {
		return $this->CreateStatus;
	}
	function getContact() {
		return $this->Contact;
	}
	function getInternalHostPattern() {
		return $this->internal_host_pattern;
	}
	function getLastVerified() {
		return $this->last_verified;
	}

	function setMirrorID($_mirror_id) {
		$this->mirror_id = $_mirror_id;
	}
	function setOrganization($_organization) {
		$this->organization = $_organization;
	}
	function setCCode($_ccode) {
		$this->ccode = $_ccode;
	}
	function setR30($_r30) {
		$this->r30 = $_r30;
	}
	function setUpdateIPAllow($_update_ip_allow) {
		$this->update_ip_allow = $_update_ip_allow;
	}
	function setEMail($_email) {
		$this->email = $_email;
	}
	function setIsInternal($_is_internal) {
		$this->is_internal = $_is_internal;
	}
	function setIsAdvertise($_is_advertise) {
		$this->is_advertise = $_is_advertise;
	}
	function setDateEnabled($_date_enabled) {
		$this->date_enabled = $_date_enabled;
	}
	function setCreateStatus($_create_status) {
		$this->CreateStatus = $_create_status;
	}
	function setContact($_contact) {
		$this->Contact = $_contact;
	}
	function setInternalHostPattern($_internal_host_pattern) {
		$this->internal_host_pattern = $_internal_host_pattern;
	}
	function setLastVerified($_last_verified) {
		$this->last_verified = $_last_verified;
	}
	
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
