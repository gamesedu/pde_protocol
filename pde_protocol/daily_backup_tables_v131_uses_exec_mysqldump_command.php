<?php
/*
Version 1.31 - Changed to mysqldump using exec() -THis solves execution timeout errors if sql file becomes too big
Below will return an array of file names and folders in directory
http://php.net/manual/en/function.readdir.php

ToDO:
-Create a monthly backup script (just a copy paste of this code with different FOLDER
-Delete OLDER daily backups -or clear daily folder (maybe when checking for monthly backups)

Changes :
Version 1.31 - Changed to mysqldump using exec() -THis solves execution timeout errors if sql file becomes too big
Version 1.30 - Added Archive & delete daily backups each month (uses pclzip.leb.php)
Version 1.22 - Added Monthly backup
Version 1.21 - Just Daily backup
Version 1.0b
Version 1.0a
- Compare with String 'db-backup-'.date("Ymd")




*/

$PROGPATH='c:/xampp/htdocs/pde_protocol/';// MAKE SURE THIS IS CORRECT
$backup_dir="backup_sql_/";
$allow_deletion_of_older_daily_files=true;
$arr_daily_sql_files=array(); //files *.sql

//DAILY BACKUP
$todays_backup_file_exists=false;
$string_to_search='db-backup-'.date("Ymd");
$dh = opendir($backup_dir);

//========================Create list of daily .sql files
while (($filename = readdir($dh)) !== false)
{
	if (stristr($filename,$string_to_search)) $todays_backup_file_exists=true;
	if (stristr($filename,".sql")) {
		//echo "<BR> ok file ".$filename;//debug
		$arr_daily_sql_files[]=$backup_dir.$filename;
	}
}
//print_r($arr_daily_sql_files);
closedir($dh);

//========================Create daily backup
if(!$todays_backup_file_exists) 
	{
		//echo "<h1>NOT EXISTS</h1>";
		
		require_once ("backup_tables.php");
		///backup_tables($opts['hn'],$opts['un'] ,$opts['pw'] ,$opts['db'],'*',$backup_dir); //original EXECUTION TIMEOUT for LARGE FILES
		//mysqldump -ujohn -pjohn pde_protocol_production > %PROGPATH%db-backup-%THISDATE%%THISEXT%
		exec ('c:\xampp\mysql\bin\mysqldump -u'.$opts['un']." -p".$opts['pw']." ".$opts['db'].' > '.$PROGPATH.$backup_dir."db-backup-".date("Ymd").'-'.time().'.sql');
		//echo "--Daily Backup Created--"; 
		echo"<br>--Δημιουργήθηκε ημερήσιο αντίγραφο ασφαλείας.--";
	}	

//========================MONTHLY BACKUP ,ARCHIVE & DELETE DAILY ARCHIVES		
$monthly_backup_file_exists=false;
$string_to_search_monthly='db-backup-'.date("Ym");
//$backup_dir=$backup_dir.'monthly_/';  // Disabled this to allow easier DELETION code
$dh = opendir($backup_dir.'monthly_/');
while (($filename = readdir($dh)) !== false)
{
	if (stristr($filename,$string_to_search_monthly)) $monthly_backup_file_exists=true;
}
closedir($dh);

if(!$monthly_backup_file_exists) 
	{
		//echo "<h1>NOT EXISTS</h1>";
		// MONTHLY BACKUP file		
		require_once ("backup_tables.php");
		//backup_tables($opts['hn'],$opts['un'] ,$opts['pw'] ,$opts['db'],'*',$backup_dir.'monthly_/');
		exec ('c:\xampp\mysql\bin\mysqldump -u'.$opts['un']." -p".$opts['pw']." ".$opts['db']." > ".$PROGPATH.$backup_dir."monthly_/db-backup-".date("Ymd").'-'.time().'.sql');
		//echo "-- Backup Created--"; 
		echo"<br>--Δημιουργήθηκε μηνιαίο αντίγραφο ασφαλείας.--";

		//========================ARCHIVE & DELETE OLDER DAILY BACKUPS
		///require_once ("jon/csv_export.php");
		require_once('jon/pclzip.lib.php');
		$archive_name=$backup_dir.'archived_/'.$string_to_search_monthly."_daily_archives.zip"; // Files are stored in the archived_/ folder
		//echo "<BR> archive_name=$archive_name";
		$archive = new PclZip($archive_name);
		
		//==============Add to archive all files
		foreach($arr_daily_sql_files as $filename){
			//echo "<BR>".$backup_dir.$filename;//debug
			$v_list = $archive->add($filename, PCLZIP_OPT_REMOVE_ALL_PATH);
			if ($v_list == 0) {
				echo "<BR>Error on filename : ".$filename;
				echo("<BR> Error : ".$archive->errorInfo(true));
			} else { 
				// file added to archive DELETE it now from folder
				if($allow_deletion_of_older_daily_files) unlink($filename);
			}
		}	 //end of foreach
		if($v_list != 0 ) {
			echo"<br>--Δημιουργήθηκε συμπιεσμένο (ZIP) αντίγραφο ασφαλείας.--";
		}
		
		if($userLevel>=2){
			include_once ("jon/find_move_files.php");
			move_files("../files_storage_shared_/","../file_storage_hidden_/");
		}
	}	



	
?>