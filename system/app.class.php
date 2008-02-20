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
	#		2007-03-13: added WWW_PREFIX functionality, and default class constructor
	#
	#*****************************************************************************

	private $APPVERSION 	= "1.0";
	private $APPNAME		= "Eclipse.org";
	
	
	private $DEFAULT_ROW_HEIGHT	= 20;
	
	private $POST_MAX_SIZE		= 262144;   # 256KB Max post
	private $OUR_DOWNLOAD_URL   = "http://download1.eclipse.org";
	private $PUB_DOWNLOAD_URL   = "http://download.eclipse.org";
	private $DOWNLOAD_BASE_PATH = "/home/data2/httpd/download.eclipse.org";
	
	private $WWW_PREFIX			= "";  # default is relative
	
	# Additional page-related variables
	private $ExtraHtmlHeaders   = "";
	private	$PageRSS			= "";
	private $PageRSSTitle		= "";
	
	private $THEME_LIST 		=  array("", "Phoenix", "Miasma", "Lazarus");
	
	# Set to TRUE to disable all database operations
	private $DB_READ_ONLY		= false;
	
	# Default constructor
	function App() {
		# Set value for WWW_PREFIX
		if($_SERVER['SERVER_NAME'] != "www.eclipse.org") {
			$this->WWW_PREFIX = "http://www.eclipse.org";
		}
	}
	
	
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
	function getDBReadOnly() {
		return $this->DB_READ_ONLY;
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
	
	function getWWWPrefix() {
		return $this->WWW_PREFIX;
	}
	
	function getUserLanguage() {
		/* @return: String
		 * 
		 * Check the browser's default language and return
		 * 
		 * 2006-06-28: droy
		 * 
		 */
		
		$validLanguages = array('en', 'de', 'fr');
		$defaultLanguage = "en";
		
		# get the default browser language (first one reported)
		$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		
		if(array_search($language, $validLanguages)) {
				return $language;
		}
		else {
			return $defaultLanguage;
		}
	}

	function getLocalizedContentFilename() {
		/* @return: String
		 * 
		 * return the content/xx_filename.php filename, according to availability of the file
		 * 
		 * 2006-06-28: droy
		 * 
		 */
		
		$language = $this->getUserLanguage();
		$filename = "content/" . $language . "_" . $this->getScriptName();
		
		if(!file_exists($filename)) {
			$filename = "content/en_" . $this->getScriptName();
		}
		
		return $filename;
	}

	
	function getScriptName() {
		# returns only the filename portion of a script
		return substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
	}

	function getProjectCommon() {
		/** @return: String
		 * 
		 * Walk up the directory structure to find the closest _projectCommon.php file
		 * 
		 * 2005-12-06: droy
		 * - created basic code to walk up all the way to the DocumentRoot  
		 * 
		 */
		
		$currentScript 	= $_SERVER['SCRIPT_FILENAME'];
		$strLen 		= strlen($currentScript);
		$found 			= false;
		$antiLooper		= 0;
		
		# default to /home/_projectCommon.php
		$rValue 		= $_SERVER['DOCUMENT_ROOT'] . "/home/_projectCommon.php";  
		
		
		while($strLen > 1 && ! $found) {
			$currentScript 	= substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($currentScript, "/"));
			$testPath 		= $currentScript . "/_projectCommon.php";
			
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
			$_String = $_String . " AND ";
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

	function str_replace_count($find, $replace,$subject, $count) {
		# Replaces $find with $replace in $subnect $count times only
		
		$nC = 0;
		
		$subjectnew = $subject;
		$pos = strpos($subject, $find);
		if ($pos !== FALSE)   {
			while ($pos !== FALSE) {
				$nC++;
				$temp = substr($subjectnew, $pos+strlen($find));
				$subjectnew = substr($subjectnew, 0, $pos) . $replace . $temp;
				if ($nC >= $count)   {
					break;
				}
		        $pos = strpos($subjectnew, $find);
			}
		}
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
		
		# OPT1: ob_start();
		
		# All web page parameters passed for variable scope
		
		if($theme == "") {
			$theme = "Phoenix";
		}
		
		if($pageTitle == "") {
			$pageTitle = "eclipse.org page";
		}

		# page-specific RSS feed
		if($this->PageRSS != "") {
			if ($this->PageRSSTitle != "") {
				$this->PageRSSTitle = "Eclipse RSS Feed";
			}
			$this->ExtraHtmlHeaders .= '<link rel="alternate" title="' . $this->PageRSSTitle . '" href="' . $this->PageRSS . '" type="application/rss+xml">';
		}
		
		$extraHtmlHeaders = $this->ExtraHtmlHeaders;

		include($this->getHeaderPath($theme));
		
		if ($Menu != NULL)
		include($this->getMenuPath($theme));
		
		if ($Nav != NULL)
		include($this->getNavPath($theme));
		
		echo $html;
		include($this->getFooterPath($theme));
		
		# OPT1:$starttime = microtime();
		# OPT1:$html = ob_get_contents();
		# OPT1:ob_end_clean();
		
		# OPT1:$stripped_html = $html;
		# OPT1:$stripped_html = preg_replace("/^\s*/", "", $stripped_html);
		# OPT1:$stripped_html = preg_replace("/\s{2,}/", " ", $stripped_html);
		# OPT1:$stripped_html = preg_replace("/^\t*/", "", $stripped_html);
		# OPT1:$stripped_html = preg_replace("/\n/", "", $stripped_html);
		# OPT1:$stripped_html = preg_replace("/>\s</", "><", $stripped_html);
		# $stripped_html = preg_replace("/<!--.*-->/", "", $stripped_html);
		# OPT1:$endtime = microtime();
		
		# OPT1:echo "<!-- unstripped: " . strlen($html) . " bytes/ stripped: " . strlen($stripped_html) . "bytes - " . sprintf("%.2f", strlen($stripped_html) / strlen($html)) . " Bytes saved: " . (strlen($html) - strlen($stripped_html)) . " Time: " . ($endtime - $starttime) . " -->";
		# echo $stripped_html;
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
	
	function getHTTPParameter($_param_name, $_method="") {
		/** @author droy
		 * @since version - Oct 19, 2006
		 * @param String _param_name name of the HTTP GET/POST parameter
		 * @param String _method GET or POST, or the empty string for POST,GET order 
		 * @return String HTTP GET/POST parameter value, or the empty string
		 *  
		 * Fetch the HTTP parameter
		 * 
		 */
		
		$rValue = "";
		$_method = strtoupper($_method);

		# Always fetch the GET VALUE, override with POST unless a GET was specifically requested
		if(isset($_GET[$_param_name])) {
			$rValue = $_GET[$_param_name];
		}
		if(isset($_POST[$_param_name]) && $_method != "GET") {	
			$rValue = $_POST[$_param_name];
		}
		return $rValue;
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

			// Establish NT 6.0 as Vista
			if(stristr($v,'NT') && $v2 == 6.0) $v = 'win32';
            
			// Establish NT 5.1 as Windows XP
			elseif(stristr($v,'NT') && $v2 == 5.1) $v = 'win32';

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
        


        function isValidTheme($_theme) {
		/* @return: bool
		 * 
		 * returns true if supplied theme is in the array of valid themes
		 * 
		 * 2005-12-07: droy
		 * 
		 */
        	return array_search($_theme, $this->THEME_LIST);
        }
        	
        
        function getUserPreferedTheme() {
		/* @return: String
		 * 
		 * returns theme name in a browser cookie, or the Empty String
		 * 
		 * 2005-12-07: droy
		 * 
		 */
        	if(isset($_COOKIE["theme"])) {
				$theme = $_COOKIE["theme"];
				
				if($this->isValidTheme($theme)) {
					return $theme;
				}
				else {
					return "";
				}
        	}
        }
        
        function usePolls() {
        	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/classes/polls/poll.php");
        }	
        
        function useProjectInfo() {
        	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/classes/projects/projectInfoList.class.php");
        }
        /*
         * This function applies standard formatting to a date. 
         * 
         * The first parameter is either a string or a number representing a date. 
         * If it's a string, it must be in a format that is parseable by the 
         * strtotime() function. If it is a number, it must be an integer representing 
         * a UNIX timestamp (number of seconds since January 1 1970 00:00:00 GMT) 
         * which, conveniently, is the output of the strtotime() function. 
         * 
         * The second (optional) parameter is the format for the result. This must
         * one of 'short', or 'long'.
         */
        function getFormattedDate($date, $format = 'long') {
        	if (is_string($date)) $date = strtotime($date);
        	switch ($format) {
        		case 'long' : return date("F j, Y", $date);
        		case 'short' : return date("d M y", $date);
        	}
        }
        
        /*
         * This function applies standard formatting to a date range. 
         * 
         * See the comments for getFormattedDate($date, $format) for information
         * concerning what's expected in the parameters of this method).
         */
        function getFormattedDateRange($start_date, $end_date, $format) {
        	if (is_string($start_date)) $start_date = strtotime($start_date);
        	if (is_string($end_date)) $end_date = strtotime($end_date);
        	switch ($format) {
        		case 'long' : 
        			if ($this->same_year($start_date, $end_date)) {
						if ($this->same_month($start_date, $end_date)) {
							return date("F", $start_date) 
								. date(" d", $start_date)
								. date("-d, Y", $end_date);
						} else {
							return date("F d", $start_date)
								. date("-F d, Y", $end_date);
						}
					} else {
						return date("F d, Y", $start_date)
							. date("-F d, Y", $end_date);
					}
        		case 'short' :         	
        			if ($this->same_year($start_date, $end_date)) {
						if ($this->same_month($start_date, $end_date)) {
							return date("d", $start_date) 
								. date ("-d", $end_date)
								. date(" M", $start_date)
								. date(" y", $end_date);
						} else {
							return date("d M", $start_date)
								. date("-d M y", $end_date);
						}
					} else {
						return date("d M y", $start_date)
							. date("-d M y", $end_date);
					}
        	}
        }       

        /*
         * This method answers true if the two provided values represent
         * dates that occur in the same year.
         */
		function same_year($a, $b) {
			return date("Y", $a) == date("Y", $b);
		}
		
        /*
         * This method answers true if the two provided values represent
         * dates that occur in the same month.
         */
		function same_month($a, $b) {
			return date("F", $a) == date("F", $b);
		}
		
		/**
		 * Returns a string representing the size of a file in the downloads area
		 * @author droy
		 * @since Jun 7, 2007
		 * @param string file File name relative to http://download.eclipse.org (the &file= parameter used)
		 * @return string Returns a string in the format of XX MB
		 */
		function getDownloadFileSizeString($_file) {
			$fileSize = "N/A";
			$filesizebytes  = filesize($this->getDownloadBasePath() . $_file);
			if($filesizebytes > 0) {
				$fileSize = floor($filesizebytes / 1048576) . " MB";
			}
			return $fileSize;
		}

		function useSession($required="") {
			require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/session.class.php");
        	$ssn = new Session();
        	if ((!$ssn->validate()) && $required == "required") {
        		$ssn->redirectToLogin();
			}
        	return $ssn;
		}
		
		function isValidCaller($_pathArray) {
			$a = debug_backtrace();
			$caller = $a[1]['file'];  # Caller 0 is the class that called App();
			$validCaller = false;
			for($i = 0; $i < count($_pathArray); $i++) {
				# TODO: use regexp's to match the leftmost portion for better security 
				if(strstr($caller, $_pathArray[$i])) {
					$validCaller = true;
					break;
				}
			}
			return $validCaller;			
		}

		function sqlSanitize($_value, $_dbh) {
		/**
		 * Sanitize incoming value to prevent SQL injections
		 * @param string value to sanitize
		 * @param dbh database resource to use
		 * @return string santized string
		 */
			if(get_magic_quotes_gpc()) {
				$_value = stripslashes($_value);
			}
			$_value = mysql_real_escape_string($_value, $_dbh);
        	return $_value;
		}
		
	function getGoogleSearchHTML() {
		$strn = <<<EOHTML
		<form action="http://www.google.com/cse" id="searchbox_017941334893793413703:sqfrdtd112s">
	 	<input type="hidden" name="cx" value="017941334893793413703:sqfrdtd112s" />
  		<input type="text" name="q" size="25" />
  		<input type="submit" name="sa" value="Search" />
		</form>
		<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=searchbox_017941334893793413703%3Asqfrdtd112s&lang=en"></script>";
EOHTML;
		return $strn;
	}
}

?>