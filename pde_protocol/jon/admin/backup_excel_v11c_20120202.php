<?php  
/* 
//backup_excel.php   //version 1.1c 20120202

//Don't implement phpSecurePages because it sends headers!!
$minUserLevel=8;
$cfgProgDir = './phpSecurePages/phpSecurePages/';
require($cfgProgDir . "secure.php");
*/
/*


File taken from here : http://davidwalsh.name/backup-mysql-database-php
database backup function
Instructions :
Run it like this :
backup_tables("localhost","john","john","my_database","backup_dir/");
or
backup_tables('localhost','username','password','blog');

Change log:
1.0a : 
-Added UTF-8 support
-
*/
// load library
require_once 'php-excel.class.php';

/* backup the db OR just a table */
function backup_excel($host,$user,$pass,$dbname,$table='*',$backup_subdir="")
{
  //$backup_subdir="backup_/"; // Must include trailing SLASH (eg "backup/". NOTE this MUST EXIST. Subdirectory where the backups will be saved
  
  $link = mysql_connect($host,$user,$pass);
  mysql_select_db($dbname,$link);
  @mysql_query("SET NAMES 'utf8'",$link);  //ADDED By JOHN	
   //$table='protocol_entries'; 
	$this_date=date('Ymd');
	$sql='SELECT * FROM '.$table.' ORDER BY protocol_year DESC,protocol_number DESC';
	
	//print_r($result_assoc);
	
	$xls = new Excel_XML('UTF-8', false, 'protocol'.$this_date);
    $myarray = array();
	$results_for_array=array();
	
	
	
    $columns = array();
/*	
    $result = mysql_query('SHOW COLUMNS FROM '.$table);
	//$num_fields = mysql_num_fields($result);

    while($row = mysql_fetch_row($result))
    {
      $columns[] = $row[0];
    }
	$myarray[]=$columns;
	*/
    ///$result = mysql_query('SELECT * FROM '.$table);//orig
	$result = mysql_query($sql);
    $num_fields = mysql_num_fields($result);
    
	if (mysql_num_rows($result) > 0) {
		$numfields = mysql_num_fields($result);
		for ($i=0; $i < $numfields; $i++) {
		$columns[] =mysql_field_name($result, $i);
		//echo mysql_field_name($result, $i).'</br>';
		}
	}
	

  //$xls->addRow($columns);
  $xls->addRowWithExtras($columns,'bold'); //excel style deafult for bold is s21
  $xls->addWorksheetOptions(1) ; // freeze first row
 
    $result = mysql_query($sql);
    $num_fields = mysql_num_fields($result);
    
	
    //$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
    for ($i = 0; $i < $num_fields; $i++) 
    {
	  
      //while($row = mysql_fetch_row($result))
	  while($row = mysql_fetch_array($result))
      {	
		//$myarray = array('all rows');
        //$return.= 'INSERT INTO '.$table.' VALUES(';
		$results_for_array=array();
        for($j=0; $j<$num_fields; $j++) 
        {
          $row[$j] = addslashes($row[$j]);
          $row[$j] = ereg_replace("\n","\\n",$row[$j]);
          if (isset($row[$j])) {
			$results_for_array[]=$row[$j];
		  } else { $results_for_array[]= ''; }
          if ($j<($num_fields-1)) { $return.= ','; }
        }
		//echo"<h2>results_for_array</h2>";
		//print_r($results_for_array);
		$myarray[]=$results_for_array;
		$xls->addRow($results_for_array);
      }
    }
			//echo"<h2>myarray</h2>";
  

			
		//print_r($myarray);
		///$xls->addArray($myarray);
		$xls->generateXML('BASE_export-'.$this_date);
	
  
  //save file
  //$handle = fopen($backup_subdir.'db-backup-'.date("Ymd").'-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
  //fwrite($handle,$return);
  //fclose($handle);
  //echo $return;
  
} //function backup_tables($host,$user,$pass,$dbname,$tables = '*')
//Run it like this :
backup_excel("localhost","john","john","pde_protocol",'protocol_entries',"backup_sql_/");

//echo "<br> NOW OTHER TEST: <BR>";
//TEST excel with array
// create a simple 2-dimensional array
//$data_test = array(        1 => array ('Name', 'Surname'),        array('ΓΙΑΝΝΗΣ', 'Oliver'),        array('Test', 'Peter')        );
//print_r($data_test);		
// generate file (constructor parameters are optional)
//$xls = new Excel_XML('UTF-8', false, 'My Test Sheet');
//$xls->addArray($data);
//$xls->generateXML('normal_array_my-test');


?>