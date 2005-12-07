<?php

class App {

	#*****************************************************************************
	#
	# app.class.php
	#
	# Author: 		Denis Roy
	# Date:			2004-08-05
	#
	# Description: Functions and modules related to the application
	#
	# HISTORY:
	#
	#*****************************************************************************

	var $APPVERSION 	= "1.0";
	var $APPNAME		= "Eclipse.org";
	
	
	var $DEFAULT_ROW_HEIGHT	= 20;
	
	var $POST_MAX_SIZE		= 262144;   # 256KB Max post
	var $OUR_DOWNLOAD_URL   = "http://download1.eclipse.org";
	var $PUB_DOWNLOAD_URL   = "http://download.eclipse.org";
	var $DOWNLOAD_BASE_PATH = "/home/data/httpd/download.eclipse.org";
	
	var $ExtraHtmlHeaders   = "";
	var $GazooMode			= "";
	
	function setIncubation() {	$this->GazooMode = "incubation"; }
	function setProposal() {	$this->GazooMode = "proposal"; }
	
	function getAppVersion() {
		return $this->APPVERSION;
	}
	
	function getHeaderPath($_theme) {
		return $_SERVER["DOCUMENT_ROOT"] . "/eclipse.org-common/themes/" . $_theme . "/header.php";
	}
	function getMenuPath($_theme) {
		return $_SERVER["DOCUMENT_ROOT"] . "/eclipse.org-common/themes/" . $_theme . "/menu.php";
	}
	function getNavPath($_theme) {
		return $_SERVER["DOCUMENT_ROOT"] . "/eclipse.org-common/themes/" . $_theme . "/nav.php";
	}
	function getFooterPath($_theme) {
		return $_SERVER["DOCUMENT_ROOT"] . "/eclipse.org-common/themes/" . $_theme . "/footer.php";
	}
	
	function getAppName() {
		return $this->APPNAME;
	}
	function getPostMaxSize() {
		return $this->POST_MAX_SIZE;
	}
	function getDefaultRowHeight() {
		return $this->DEFAULT_ROW_HEIGHT;
	}
	
	function sendXMLHeader() {
		header("Content-type: text/xml");
	}

	function getOurDownloadServerUrl() {
		return $this->OUR_DOWNLOAD_URL;
	}

	function getDownloadBasePath() {
		return $this->DOWNLOAD_BASE_PATH;
	}

	function getPubDownloadServerUrl() {
		return $this->PUB_DOWNLOAD_URL;
	}
	
	function getUserLanguage() {
		# for later use
		# we'll grab the language from the PHP session or from the browser
		
		return "en";
	}
	
	function getScriptName() {
		# returns only the filename portion of a script
		return substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
	}

	function getProjectCommon() {
		/* @return: String
		 * 
		 * Walk up the directory structure to find the closest _projectCommon.php file
		 * 
		 * 2005-12-06: droy
		 * - created basic code to walk up all the way to the DocumentRoot  
		 * 
		 */
		
		$currentScript 	= $_SERVER['SCRIPT_NAME'];
		$strLen 		= strlen($currentScript);
		$found 			= false;
		$antiLooper		= 0;
		
		# default to /home/_projectCommon.php
		$rValue 		= $_SERVER['DOCUMENT_ROOT'] . "/home/_projectCommon.php";  
		
		
		while($strLen > 1 && ! $found) {
			$currentScript 	= substr($_SERVER['SCRIPT_NAME'], 0, strrpos($currentScript, "/"));
			$testPath 		= $_SERVER['DOCUMENT_ROOT'] . $currentScript . "/_projectCommon.php";
			
			if(file_exists($testPath)) {	
				$found 	= true;
				$rValue = $testPath;
			}
			$strLen = strlen($currentScript);
			
			# break free from endless loops
			$antiLooper++;
			if($antiLooper > 20) {
				$found = true;
			}
		}
		return $rValue;
	}


	function runStdWebAppCacheable() {
		 session_start();
		 
		 header("Cache-control: private");
		 header("Expires: 0");
	}

	function getAlphaCode($_NumChars)
	{
		# Accept: int - number of chars
		# return: string - random alphanumeric code
		
	
		# Generate alpha code
		$addstring = "";
		for ($i = 1; $i <= $_NumChars; $i++) {
			if(rand(0,1) == 1) {
				# generate character
				$addstring = $addstring . chr(rand(0,5) + 97);
			}
			else {
				$addstring = $addstring . rand(0,9);
			}
		}
		return $addstring;
	}

	function getCURDATE() {
		return date("Y-m-d");
	}

	function addOrIfNotNull($_String) {
		# Accept: String - String to be AND'ed
		# return: string - AND'ed String
		
		if($_String != "") {
			$_String = $_String . " OR ";
		}
		
		return $_String;
	}

	function addAndIfNotNull($_String) {
		# Accept: String - String to be AND'ed
		# return: string - AND'ed String
		
		if($_String != "") {
			$_String = $_String . " OR ";
		}
		
		return $_String;
	}
	
	function getNumCode($_NumChars)
	{
		# Accept: int - number of chars
		# return: int - random numeric code
		
	
		# Generate code
		$addstring = "";
		for ($i = 1; $i <= $_NumChars; $i++) {
			if($i > 1) {
				# generate first digit
				$addstring = $addstring . rand(1,9);
			}
			else {
				$addstring = $addstring . rand(0,9);
			}
		}
		return $addstring;
	}

	function str_replace_count($find,$replace,$subject,$count) {
		# Replaces $find with $replace in $subnect $count times only
		
		$subjectnew = $subject;
		$pos = strpos($subject,$find);
		if ($pos !== FALSE)   {
			while ($pos !== FALSE) {
				$nC = $nC + 1;
				$temp = substr($subjectnew,$pos+strlen($find));
				$subjectnew = substr($subjectnew,0,$pos) . $replace . $temp;
				if ($nC >= $count)   {
					break;
				}
		        $pos = strpos($subjectnew,$find);
			} // closes the while loop
		} // closes the if
		return $subjectnew;
	}

	function returnQuotedString($_String)
	{
		# Accept: String - String to be quoted
		# return: string - Quoted String
		
		// replace " with '
		$_String = str_replace('"', "'", $_String);
	
		return "\"" . $_String . "\"";
	}

	function returnHTMLSafeString($_String)
	{
		# Accept: String - String to be HTMLSafified
		# return: string
		
		// replace " with '
		$_String = str_replace('<', "&lt;", $_String);
		$_String = str_replace('<', "&gt;", $_String);
		$_String = str_replace("\n", "<br />", $_String);
	
		return $_String;
	}

	function returnJSSAfeString($_String)
	{
		# Accept: String - String to be quoted
		# return: string - Quoted String
		
		// replace " with '
		$_String = str_replace("'", "\\'", $_String);
	
		return $_String;
	}

	function replaceEnterWithBR($_String) {
		return str_replace("\n", "<br />", $_String);
	}
	
	function generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html) {
		
		# All web page parameters passed for variable scope
		
		if($theme == "") {
			$theme = "Phoenix";
		}
		
		if($pageTitle == "") {
			$pageTitle = "eclipse.org page";
		}
		
		if( $this->GazooMode == "incubation" 
		 || $this->GazooMode == "proposal" ) {
			$idx = strpos( $html, "id=\"rightcolumn\"" );
			if( $idx ) {
				$idx = strpos( $html, ">", $idx );
				$html = substr( $html, 0, $idx )
				      . "
	<div class=\"sideitem\">
		<h6>Incubation</h6>
			<div align=\"center\"><a href=\"/projects/gazoo.php\"><img align=\"center\" src=\"/images/gazoo-" . $this->GazooMode . ".jpg\" border=\"0\" /></a></div>
	</div>"
				      . substr( $html, $idx + 1);
			} else {
				$html .= "
<div id=\"rightcolumn\">
	<div class=\"sideitem\">
		<h6>Incubation</h6>
			<div align=\"center\"><a href=\"/projects/gazoo.php\"><img align=\"center\" src=\"/images/gazoo-" . $this->GazooMode . ".jpg\" border=\"0\" /></a></div>
	</div>
</div>";
			}
		}
		
		$extraHtmlHeaders = $this->ExtraHtmlHeaders;

		include($this->getHeaderPath($theme));
		include($this->getMenuPath($theme));
		include($this->getNavPath($theme));
		echo $html;
		include($this->getFooterPath($theme));
	}
	
	function AddExtraHtmlHeader( $string ) {
		$this->ExtraHtmlHeaders .= $string;
	}
	
	function getThemeURL($_theme) {
		if($_theme == "") {
			$theme = "Phoenix";
		}
		
		return "/eclipse.org-common/themes/" . $_theme;
		
	}


	function getClientOS() {

        $UserAgent = $_SERVER['HTTP_USER_AGENT'];

        $regex_windows  = '/([^dar]win[dows]*)[\s]?([0-9a-z]*)[\w\s]?([a-z0-9.]*)/i';
        $regex_mac      = '/(68[k0]{1,3})|(mac os x)|(darwin)/i';
        $regex_os2      = '/os\/2|ibm-webexplorer/i';
        $regex_sunos    = '/(sun|i86)[os\s]*([0-9]*)/i';
        $regex_irix     = '/(irix)[\s]*([0-9]*)/i';
        $regex_hpux     = '/(hp-ux)[\s]*([0-9]*)/i';
        $regex_aix      = '/aix([0-9]*)/i';
        $regex_dec      = '/dec|osfl|alphaserver|ultrix|alphastation/i';
        $regex_vms      = '/vax|openvms/i';
        $regex_sco      = '/sco|unix_sv/i';
        $regex_linux    = '/x11|inux/i';
        $regex_bsd      = '/(free)?(bsd)/i';
        $regex_amiga    = '/amiga[os]?/i';
        $regex_ppc		= '/ppc/i';

        $regex_x86_64   = "/x86_64/i";

        // look for Windows Box
        if(preg_match_all($regex_windows,$UserAgent,$match))  {


                        $v  = $match[2][count($match[0])-1];
                $v2 = $match[3][count($match[0])-1];

                        // Establish NT 5.1 as Windows XP
                        if(stristr($v,'NT') && $v2 == 5.1) $v = 'win32';

                        // Establish NT 5.0 and Windows 2000 as win2k
            elseif($v == '2000') $v = '2k';
                elseif(stristr($v,'NT') && $v2 == 5.0) $v = 'win32';
            // Establish 9x 4.90 as Windows 98
            elseif(stristr($v,'9x') && $v2 == 4.9) $v = 'win32';
                // See if we're running windows 3.1
            elseif($v.$v2 == '16bit') $v = 'win16';
                // otherwise display as is (31,95,98,NT,ME,XP)
                        else $v .= $v2;
                // update browser info container array
                        if(empty($v)) $v = 'win32';
                        return (strtolower($v));
                }

                //  look for amiga OS
                elseif(preg_match($regex_amiga,$UserAgent,$match))  {
                        if(stristr($UserAgent,'morphos')) {
                        // checking for MorphOS
                                return ('morphos');
                                }
                }
                        elseif(stristr($UserAgent,'mc680x0')) {
                        // checking for MC680x0
                        return ('mc680x0');
                        }
                        elseif(preg_match('/(AmigaOS [\.1-9]?)/i',$UserAgent,$match)) {
                              // checking for AmigaOS version string
                                return ($match[1]);
                        }
                // look for OS2
                elseif( preg_match($regex_os2,$UserAgent))  {
                        return ('os2');
                }
                // look for mac
                // sets: platform = mac ; os = 68k or ppc
                elseif( preg_match($regex_mac,$UserAgent,$match) )
                {
                    $os = !empty($match[1]) ? 'mac68k' : '';
                    $os = !empty($match[2]) ? 'macosx' : $os;
                    $os = !empty($match[3]) ? 'macppc' : $os;
                    $os = !empty($match[4]) ? 'macosx' : $os;
                    return ('macosx');
                }
                //  look for *nix boxes
                //  sunos sets: platform = *nix ; os = sun|sun4|sun5|suni86
                elseif(preg_match($regex_sunos,$UserAgent,$match))
                {
                    if(!stristr('sun',$match[1])) $match[1] = 'sun'.$match[1];
                    return ('solaris');
                }
                //  irix sets: platform = *nix ; os = irix|irix5|irix6|...
                elseif(preg_match($regex_irix,$UserAgent,$match))
                {
                    return ($match[1].$match[2]);
                }
                //  hp-ux sets: platform = *nix ; os = hpux9|hpux10|...
                elseif(preg_match($regex_hpux,$UserAgent,$match))
                {
                    $match[1] = str_replace('-','',$match[1]);
                    $match[2] = (int) $match[2];
                    return ('hpux');
                }
                //  aix sets: platform = *nix ; os = aix|aix1|aix2|aix3|...
                elseif(preg_match($regex_aix,$UserAgent,$match))
                {
                    return ('aix');
                }
                //  dec sets: platform = *nix ; os = dec
                elseif(preg_match($regex_dec,$UserAgent,$match))
                {
                    return ('dec');
                }
                //  vms sets: platform = *nix ; os = vms
                elseif(preg_match($regex_vms,$UserAgent,$match))
                {
                    return ('vms');
                }
                //  dec sets: platform = *nix ; os = dec
                elseif(preg_match($regex_dec,$UserAgent,$match))
                {
                    return ('dec');
                }
                //  vms sets: platform = *nix ; os = vms
                elseif(preg_match($regex_vms,$UserAgent,$match))
                {
                    return ('vms');
                }
                //  sco sets: platform = *nix ; os = sco
                elseif(preg_match($regex_sco,$UserAgent,$match))
                {
                    return ('sco');
                }
                //  unixware sets: platform = *nix ; os = unixware
                elseif(stristr($UserAgent,'unix_system_v'))
               {
                    return ('unixware');
                }
                //  mpras sets: platform = *nix ; os = mpras
                elseif(stristr($UserAgent,'ncr'))
                {
                    return ('mpras');
                }
                //  reliant sets: platform = *nix ; os = reliant
                elseif(stristr($UserAgent,'reliantunix'))
                {
                    return ('reliant');
                }
                //  sinix sets: platform = *nix ; os = sinix
                elseif(stristr($UserAgent,'sinix'))
                {
                    return ('sinix');
                }
                //  bsd sets: platform = *nix ; os = bsd|freebsd
                elseif(preg_match($regex_bsd,$UserAgent,$match))
                {
                    return ($match[1].$match[2]);
                }
                //  last one to look for
                //  linux sets: platform = *nix ; os = linux
                elseif(preg_match($regex_linux,$UserAgent,$match))
                {

                        if(preg_match($regex_x86_64,$UserAgent,$match)) {
                                return "linux-x64";
                        }
                        elseif(preg_match($regex_ppc,$UserAgent,$match)) {
                                return "linux-ppc";
                        }
                        else {
                                return ('linux');
                        }
                }
        }

}

?>