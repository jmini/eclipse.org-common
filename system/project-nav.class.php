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
   
	function setDescriptionPath( $d ) {		$this->description = $d;	}
	
	function setProjectPlanPath( $p ) {		$this->project_plan = $p;	}
	
	function setLeadershipPath( $u ) {		$this->leadership = $u;	}
	
	function setCommittersPath( $c ) {		$this->committers = $c; }
	
	function setContributorsPath( $c ) {		$this->contributors = $c; }
	
	function setIPLogPath( $i ) {			$this->ip_log = $i; }
	
	function setDownloadsPath( $d ) {		$this->downloads = $d; }
	
	function setGettingStartedPath( $g ) {	$this->getting_started = $g; }
	
	function setDevelopmentPlanPath( $p ) {	$this->development_plan = $p; }
	
	/* Use this function if you have a local page listing mailing lists */
	function setMailingListsPath( $m ) {		$this->mailing_lists = $m;	}
	/* Use this function if you have one mailing list */
	function setMailingListName( $m ) {	$this->mailing_lists = "http://dev.eclipse.org/mhonarc/lists/$m/maillist.html";	}
	
	function setCVSPath( $c ) {				$this->cvs = $c; }
	
	/* Use this function if you have a local page listing bugs */
	function setBugsPath( $b ) {			$this->bugs = $b; }
	/* Use this function if you want a link to the product bug listing */
	function setBugsProduct( $b ) {			$this->bugs = "https://bugs.eclipse.org/bugs/buglist.cgi?classification=$b"; }
	
    function generate_nav( $thenav ) {
    echo $thenav;
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
