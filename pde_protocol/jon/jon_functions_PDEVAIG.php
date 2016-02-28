<?php
function getNextProtocolNumber(){

		  $db_link = mysql_connect("userdb2222", "pde2222","222222");
		  mysql_select_db("pdev22222",$db_link);
		  /* SET NAMES 'utf-8' COLLATE 'collation_name' */
		  @mysql_query("SET NAMES 'utf8'",$db_link);

		//$this->dbh 
		//Now we will find the largest protocol number and and 1 to it so we can get our NEW number
		$queryMaxProtocolNumber="SELECT MAX(protocol_number) as maxnum FROM protocol_entries";

		$result = mysql_query($queryMaxProtocolNumber,$db_link );
		$row = mysql_fetch_array($result);
		$max=$row[maxnum] ;
		mysql_close($db_link);	 
		
		return $max+1;

} // end of getNextProtocolNumber(){ =================================
/*
//$this->dbh 
//Now we will find the largest protocol number and and 1 to it so we can get our NEW number
$queryMaxProtocolNumber="SELECT MAX(protocol_number) as maxnum FROM protocol_entries";

$result = mysql_query($queryMaxProtocolNumber,$this->dbh );
$row = mysql_fetch_array($result);
$max=$row[maxnum] ;
return $max;
*/
?>