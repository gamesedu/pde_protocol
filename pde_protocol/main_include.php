<?php
/*
Main variables for usage. Maybe this can be used to select A' bathnmia, B' bathmia & dieythynseis
put 
include_once "main_include.php";

*/
$version="protocol 1.48c -20120215";
$version="protocol 1.53a -20160202";
$relative_joomla_dir='';
$css_dir="jon/css/";
$ada_url="https://diavgeia.gov.gr/decision/view/"; //
//include_once "css_jon_codeBLUE.php"; //CSS class
//include_once $css_dir."css_jon_codeMONOSPACE.php"; //CSS class
//include_once $css_dir."css_jon_codeMONOSPACE_PRINT.php"; //CSS class
//include_once $css_dir."css_jon_codeGENERICSMALL.php"; //CSS class
//include_once $css_dir."css_jon_codeGENERIC.php"; //CSS class
//include_once $css_dir."css_jon_codeVictor.php"; //CSS class
include_once $css_dir."css_jon_codeVictor2.php"; //CSS class
//DEFAULT// include_once $css_dir."css_jon_codeBLUE.php"; //CSS class

/*  //Uncomment for Joomla (& put the coorect Itemid)
$relative_joomla_dir="modules/mod_poll/"; //used for joomla
$opts['url']=array('images' => $relative_joomla_dir.'images/'); //used for Joomla
$opts['page_name']='http://localhost/joochronoforms/index.php?option=com_content&view=section&id=10&Itemid=83'; //Used for JOOMLA
$opts['url']=array('images' => 'modules/mod_poll/images/');
$opts['page_name']='http://localhost/joochronoforms/index.php?option=com_content&view=section&id=10&Itemid=83';

//Uncomment for Joomla
*/

   $calendarArray= array(
	   'ifFormat'    => '%Y-%m-%d', // defaults to the ['strftimemask']
	   'firstDay'    => 1,          // 0 = Sunday, 1 = Monday
	   'singleClick' => true,       // single or double click to close
	   'weekNumbers' => false,       // Show week numbers
	   'showsTime'   => false,      // Show time as well as date
	   'timeFormat'  => '24',       // 12 or 24 hour clock
	   'label'       => '...',      // button label (used by phpMyEdit)
	   'date'        => '2010-12-19' // Initial date/time for popup
										   // (see notes below)
	);



//LOCAL
$opts['hn'] = 'localhost';
$opts['un'] = 'john';
$opts['pw'] = 'john';
//$opts['db'] = 'pde_protocol';	
$opts['db'] = 'pde_protocol_production';	

include_once "daily_backup_tables.php"; //Not activated yet
require_once "./jon/jon_functions.php";	
	
?>