<?php 
// Second way to create MultiSelect  and store all multiselect values seperated by comma is to use select="M" and include this script
// REMEMBER to use CORRECT table to  this command $opts['fdd']['assigned_to']['values2']=$array_names;
/*$opts['fdd']['assigned_to']['values2']=array(
'displayed' => 'Displayed Article',
'hidden' => 'Hidden Article'
);
*/
//To DO use better mysql connect
		  $db_link = mysql_connect($opts['hn'], $opts['un'],$opts['pw']);
		  mysql_select_db($opts['db'],$db_link);
		  /* SET NAMES 'utf-8' COLLATE 'collation_name' */
		  @mysql_query("SET NAMES 'utf8'",$db_link);	

 $array_names='';
  //$query='SELECT * FROM protocol_assign_names WHERE is_active=1 ORDER BY sort_order'; 
  $query='SELECT *
FROM protocol_completion_media
ORDER BY sort_order,is_active DESC
';

  $media_type_templist = ''; 
  $res = mysql_query($query,$db_link); 
  while ($row = @mysql_fetch_array($res)) { 
		$media_type_temp = $row['media_type']; 
      $array_names[$media_type_temp]=$media_type_temp; 

    
  } 
  mysql_close($db_link);
  
  
  $opts['fdd'][$table_column_name]['values2']=$array_names;
  ?>