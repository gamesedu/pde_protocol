<?php  
$minUserLevel=4;
$cfgProgDir = './phpSecurePages/phpSecurePages/';
require_once($cfgProgDir . "secure.php");
/*
* find_files.php  
//Version 1.1b 20120127 GET implemented  
*
*
* Notes :
	You must put in the phpMyEdit field this :
*  'URL' 	 => './find_files.php?seek=$value',
  'URLtarget' => '_blank', 
*
*ToDO:
*-Ignore "*.php files"
*-Maybe allow only eml,doc,ppt,xls,xlsx,...
*-Move from Shared folder to Hidden folder INSIDE a 201202 type directory monthly
*-

*Changes:
*
//Version 1.1b 20120127 GET implemented  
//Version 1.1a 20120127 EML need to select "Save As"



http://www.php.net/manual/en/function.scandir.php
Everyone seems to enjoy using recursive method, while i think recursive 
method is very inefficient.The function below will demonstrate how to 
iteratively (faster than recursive method) dump every object (files and 
folders) and it's child tree starting from specified path ($dir) :
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>ΔΙΑΧΕΙΡΙΣΗ ΠΡΩΤΟΚΟΛΟΥ </title>
</head>
<body>
<? 



$dir_to_search ="../files_storage_shared_";
$debug_jon=false;

$string_to_search="";
if(isSet($_GET["seek"])){
		$string_to_search=$_GET["seek"];
		if(!is_numeric($string_to_search)) $string_to_search="000";
	}else {
		$string_to_search="000";
	}

//if ($debug_jon)$string_to_search="437";  //jon for debug	

function dir_tree($dir,$search_string="0000") {
   global $debug_jon,$dir_to_search;
   if($string_to_search=="000") return "NoFile";
   $path = '';
   $stack[] = $dir;
   while ($stack) {
       $thisdir = array_pop($stack);
       if ($dircont = scandir($thisdir)) {
           $i=0;
           while (isset($dircont[$i])) {
               if ($dircont[$i] !== '.' && $dircont[$i] !== '..') {
                   $current_file = "{$thisdir}/{$dircont[$i]}";
				   
                   if (is_file($current_file)) {
						//$current_file=mb_convert_encoding($current_file,"utf8","8859-1");
						$current_file= iconv( "iso-8859-7","utf-8", $current_file );
						$dircont[$i]=  iconv( "iso-8859-7","utf-8", $dircont[$i] );
					   if (strpos($current_file,$search_string))  {
								echo "<h3><a href='$current_file' target=_blank >$dircont[$i]</a></h3>";
								//if($debug_jon) 
								//echo "<h2>smartDOWNLOADFILE ONLY<a href='../$dir_to_search/download.php?f=". urlencode("$current_file")."' target=_blank >$dircont[$i]</a></h2>";
						}				   
                       $path[] = "{$thisdir}/{$dircont[$i]}";
					   
                   } elseif (is_dir($current_file)) {
                        $path[] = "{$thisdir}/{$dircont[$i]}";
                       $stack[] = $current_file;
                   }
               }
               $i++;
           }
       }
   }
   return $path;
}



echo "<h1>Αναζήτηση εγγράφων που περιέχουν την φράση :'$string_to_search'</h1><h2>ΣΗΜΕΙΩΣΗ: Πρέπει με δεξί κλικ να επιλέξετε 'αποθήκευση συνδεσμου ως' και μέτα να ανοίξετε τα αρχεία τύπου 'EML - Outlook Express'</h2>";

$dir_to_search ="../files_storage_shared_";
$result=dir_tree($dir_to_search,$string_to_search);

$dir_to_search ="../file_storage_hidden_";
$result=dir_tree($dir_to_search,$string_to_search);
//if ($debug_jon) print_r($result);

?>