<?php
/*
find_move_files.php
Version 0.10 -20120131 - move files to folders
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
NOTES :
-Include it once in monthly SQL backup NOT it find files (cause you might cancel links problems)
move_files("../files_to_seachTest_/","../files_to_seachTestHIDDEN_/");

ToDO:
-


Changes :
Version 0.10 -20120131 - move files to folders




*/
$minUserLevel=5;
$cfgProgDir = './phpSecurePages/phpSecurePages/';
require($cfgProgDir . "secure.php");


function move_files($source_dir ="../files_to_seachTest_/",$target_dir="../files_to_seachTestHIDDEN_/")
{
$debug_jon=false;
//$source_dir ="../files_to_seachTest_/";

//$target_dir="../files_to_seachTestHIDDEN_/";

if($debug_jon) echo '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">'; // to show correct char encoding of files

//========================MONTHLY BACKUP ,ARCHIVE & DELETE DAILY ARCHIVES		
$monthly_backup_folder_exists=false;
$string_to_search_monthly=date("Ym");


//$scanned_target_directory = array_diff(scandir($target_dir), array('..', '.')); // ignore '.' and '..'
$scanned_target_directory = scandir($target_dir);
//$current_file= iconv( "iso-8859-7","utf-8", $current_file );
if ($debug_jon)print_r($scanned_target_directory);
foreach($scanned_target_directory as $name){
	
	//if ($debug_jon) if(!is_dir($target_dir.$name))echo "<BR>isFile string_to_search_monthly=$string_to_search_monthly | name=".$name." - isDir=".$monthly_backup_folder_exists;//debug
	if (is_dir($target_dir.$name)) {
		if ($debug_jon)echo "<BR>isDir string_to_search_monthly=$string_to_search_monthly | name=".$name." - isDir=".$monthly_backup_folder_exists;//debug
		if (strpos('t'.$name,$string_to_search_monthly))  { // *** MUST add 'x' in front to work
			$monthly_backup_folder_exists=true; 
			if ($debug_jon)echo "<hr>monthly_backup_folder_exists";
		}
		if ($debug_jon)echo "<BR>".$name." - isDir=".$monthly_backup_folder_exists;//debug
	}
}	 //end of foreach



if(!$monthly_backup_folder_exists) 	{
	$source_list=scandir($source_dir);
	//if($debug_jon)print_r($source_list);
	$folderCreated=mkdir($target_dir.$string_to_search_monthly);
	echo "<hr><BR>Trying to create folder ($target_dir$string_to_search_monthly) : ".$folderCreated;//debug
	if($folderCreated==true){ 
		foreach($source_list as $name){
			if ($debug_jon)echo "<br>checking ($name): ".$source_dir.$name;
			if (is_file($source_dir.$name)){
				$targetfile=$target_dir.$string_to_search_monthly.'/'.$name;
				if ($debug_jon)echo "<h2>is_file : ".$source_dir.$name." , <br>targetfile=$targetfile</h2>";
				$fileMoved=rename($source_dir.$name, $targetfile);
				if($fileMoved){
					if ($debug_jon)echo "<br>ok Moved file : ".$name;
				}else {
					echo "<br>Problem with file : ".$name;
				}
			} //end of if(is_dir($sourceDir){
		}//end of foreach
	} // end of if($folderCreated){
		
} //end of if(!$monthly_backup_folder_exists) 	{

}// end of function move_files

//move_files("../files_to_seachTest_/","../files_to_seachTestHIDDEN_/");

	
?>