<?php
class ProjectNav {

	#*****************************************************************************
	#
	# project-nav.class.php
	#
	# Author: 		Bjorn Freeman-Benson
	# Date			2005-12-05
	#
	# Description: Functions and modules related to Project Specific nav bar
	#
	# HISTORY:
	#
	#*****************************************************************************	
	
    // About
    var $description		= "";
    var $project_plan		= "";
    var $leadership			= "";
    var $committers			= "";
    var $contributors		= "";
    var $ip_log				= "";
    // Downloads
    var $downloads			= "";
    // Getting Started
    var $getting_started	= "";
    // Development
    var $development_plan	= "";
    var $mailing_lists		= "";
    var $cvs				= "";
    var $bugs				= "";
   
	function setDescriptionURL( $d ) {		$this->description = $d;	}
	function setProjectPlanURL( $p ) {		$this->project_plan = $p;	}
	function setLeadershipURL( $u ) {		$this->leadership = $u;	}
	function setCommittersURL( $c ) {		$this->committers = $c; }
	function setContributorsURL( $c ) {		$this->contributors = $c; }
	function setIPLogURL( $i ) {			$this->ip_log = $i; }
	function setDownloadsURL( $d ) {		$this->downloads = $d; }
	function setGettingStartedURL( $g ) {	$this->getting_started = $g; }
	function setDevelopmentPlanURL( $p ) {	$this->development_plan = $p; }
	function setMailingListsURL( $m ) {		$this->mailing_lists = $m;	}
	function setCVSURL( $c ) {				$this->cvs = $c; }
	function setBugsURL( $b ) {				$this->bugs = $b; }
	
    function generate_nav( $thenav ) {
    	$thenav->addNavSeparator("Project Links", "");
        $thenav->addCustomNav("About", $this->description, "", 1);
            $thenav->addCustomNav("Description", $this->description, "", 2);
            $thenav->addCustomNav("Project Plan", $this->project_plan, "", 2);
            $thenav->addCustomNav("Leadership", $this->leadership, "", 2);
            $thenav->addCustomNav("Committers", $this->committers, "", 2);
            $thenav->addCustomNav("Contributors", $this->contributors, "", 2);
            $thenav->addCustomNav("IP Log", $this->ip_log, "", 2);
        $thenav->addCustomNav("Downloads", $this->downloads, "", 1);
        $thenav->addCustomNav("Getting Started", $this->getting_started, "", 1);
        $thenav->addCustomNav("Development", $this->development_plan, "", 1);
            $thenav->addCustomNav("Project Plan", $this->development_plan, "", 2);
            $thenav->addCustomNav("Mailing Lists", $this->mailing_lists, "", 2);
            $thenav->addCustomNav("CVS", $this->cvs, "", 2);
            $thenav->addCustomNav("Bugs", $this->bugs, "", 2);
    }
}
?>
