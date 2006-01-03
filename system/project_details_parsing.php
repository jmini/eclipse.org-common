<?php
/*********************************************************
 *
 * Name: project_details_parsing
 * function: contains the functions that read  the files created by the individual projects to describe their
 * newsgroups and mailing lists, and inserts that data into the web stream
 * 
 * By: M. Ward
 * Date: Dec 13/05
 *
*********************************************************/

/*****************************
 * Name: getfile
 * Function: given a project id builds a location path
 * I/O: the project id and the name of the file, and the location of the document root of the server. returns the path
 * 
 * By: M. Ward
 * Date: Dec 21/05
*****************************/
function GetFile( $name, $filename, $docroot ) {

  //remove any index.html 
  $name = str_replace("index.html","", $name);
  //same thing for main.html
  $name = str_replace("main.html","", $name);
  //if there isn't a trailing / then insert one'
  if( substr($name,-1,1) != "/" )
    $name .= "/";
  //replace the www path with the internal document path
  $name = str_replace("http://www.eclipse.org/", $docroot . "/", $name);
  $localname = str_replace("http://eclipse.org/", $docroot . "/", $name);
  //build up the name of hte file on the local filesystem
  $group_file = $localname . "project-info/" . $filename;
  
  //echo "!! $group_file ??\n\r";
  
  return $group_file;
	
}

/***************************************
 * Name: NewsParse
 * function: Parses the news file and build the project specific html
 * I/O: takes the name of the project(getProjectID()) and a pointer to the html output stream, as
 * well as a bool to turn off the descriptive text
 * 
 * By: M. Ward
 * Date: Dec 13/05
****************************************/
function NewsParse( $name, &$html, $id ) {
  $group_file = GetFile( $name, "newsgroup",$_SERVER['DOCUMENT_ROOT'] );
  if( !file_exists($group_file) ) {
  	$group_file = GetFile( $name, "newsgroup" , $_SERVER['DOCUMENT_ROOT'] . "/projects/temporary" );  
    if( !file_exists($group_file) )
      return;
  }
  //get the contents
  $contents = file_get_contents($group_file);
  //now break them down        
  $array = explode("::",$contents);
  $group_count = count($array);
  for ( $loop = 1; $loop < $group_count; $loop+=2) {
    $news_name = $array[$loop];
    $news_html = "<a href=\"news://news.eclipse.org/" . $news_name . "\" ><img src='images/file_obj.gif' alt='News server' title=\"News server\"/></a>";
    $webnews_html = "<a href=\"http://www.eclipse.org/newsportal/thread.php?group=" . $news_name . "\""  . "><img src='images/discovery.gif' alt='Web interface' title=\"Web interface\" /></a>";
	$newsarch_html = "<a href=\"http://dev.eclipse.org/newslists/news." . $news_name . "/maillist.html\""  . "><img src='images/save_edit.gif' alt='Archive' title=\"Archive\" /></a>";
	$description = $array[$loop+1];
	$html .= "<blockquote> <a href=\"javascript:switchMenu('$news_name.$id');\" title=\"Description\" alt='Description' >$news_name</a>  $news_html $webnews_html $newsarch_html </blockquote> <div id=\"$news_name.$id\" class=\"switchcontent\"> <p> $description </p></div>";
  }          
}

/***************************************
 * Name: MailParse
 * function: Parses the mail file and build the project specific html
 * I/O: takes the name of the project(getProjectID()) and a pointer to the html output stream
 * 
 * By: M. Ward
 * Date: Dec 21/05
****************************************/
function MailParse( $name, &$html, $id ) {
  $group_file = GetFile( $name, "maillist",$_SERVER['DOCUMENT_ROOT'] );
  if( !file_exists($group_file) ) {
  	$group_file = GetFile( $name, "maillist", $_SERVER['DOCUMENT_ROOT'] . "/projects/temporary");
    if( !file_exists($group_file) )
      return;
  }
  //get the contents
  $contents = file_get_contents($group_file);
  //now break them down        
  $array = explode("::",$contents);

  $group_count = count($array);
  for ( $loop = 1; $loop < $group_count; $loop+=2) {
    $mail_name = $array[$loop];
    $mail_html = "<a href=\"http://dev.eclipse.org/mailman/listinfo/" . $mail_name . "\""  . "><img src='images/taskmrk_tsk.gif' alt='Subscribe' title=\"Subscribe\" /></a>";
	$mailarch_html = "<a href=\"http://dev.eclipse.org/mhonarc/lists/" . $mail_name . "/maillist.html\""  . "><img src='images/save_edit.gif' alt='Archive' title=\"Archive\" /></a>";
	$description = $array[$loop+1];
	$html .= "<blockquote> <a href=\"javascript:switchMenu('$mail_name.$id');\" title=\"Description\" alt='Description'>$mail_name</a>  $mail_html $mailarch_html </blockquote> <div id=\"$mail_name.$id\" class=\"switchcontent\"> <p> $description </p></div>";
  }          
}



?>
