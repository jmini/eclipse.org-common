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

/***************************************
 * Name: NewsParse
 * function: Parses the news file and build the project specific html
 * I/O: takes the name of the project(getProjectID()) and a pointer to the html output stream
 * 
 * By: M. Ward
 * Date: Dec 13/05
****************************************/
function NewsParse( $name, &$html) {
  //build up the name of hte file on the local filesystem
  $group_file = $_SERVER['DOCUMENT_ROOT'] . "/" . $name . "/" . "newsgroup";
  if( file_exists($group_file) ) {
  	//get the contents
    $contents = file_get_contents($group_file);
    //now break them down        
    $array = explode("::",$contents);

    $group_count = count($array);
    for ( $loop = 1; $loop < $group_count; $loop+=2) {
      $news_name = $array[$loop];
      $news_html = "<a href=\"news://news.eclipse.org/" . $news_name . "\""  . ">" . $news_name . "</a>";
	  $webnews_html = "<a href=\"http://www.eclipse.org/newsportal/thread.php?group=" . $news_name . "\""  . "><img src='images/discovery.gif' alt='Web interface' /></a>";
	  $newsarch_html = "<a href=\"http://dev.eclipse.org/newslists/news." . $news_name . "/maillist.html\""  . "><img src='images/save_edit.gif' alt='Archive' /></a>";
	  $description = $array[$loop+1];
	  $html .= "<blockquote><p>$news_html $webnews_html $newsarch_html </p><blockquote><p> $description </p></blockquote></blockquote>";
	}
  }          
}

?>
