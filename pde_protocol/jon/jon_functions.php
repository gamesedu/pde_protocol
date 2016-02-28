<?php

function getCurrentYear(){
		$currentYear=date("Y");
		//$currentYear=date("Y"); //orig line
		return $currentYear;

}

// Create Values2 Array (2011,2010,2009,...)
function getYearValues2(){
	$array_years=null;
	$startYear=2015;
	$currentYear=getCurrentYear();
	for($j=$currentYear;$j>=$startYear;$j--){
		//echo "<h1>j=$j</h1>";
		$array_years[$j]=$j; 			
	}
	return $array_years;
}

function getNextProtocolNumber(){
		  global $opts;

		  $db_link = mysql_connect($opts['hn'], $opts['un'],$opts['pw']);
		  mysql_select_db($opts['db'],$db_link);

		 
		  //mysql_select_db("pdevaig-db1",$db_link);
		  
		  /* SET NAMES 'utf-8' COLLATE 'collation_name' */
		  @mysql_query("SET NAMES 'utf8'",$db_link);

		//$this->dbh 
		//Now we will find the largest protocol number and and 1 to it so we can get our NEW number
		$queryMaxProtocolNumber="SELECT MAX(protocol_number) as maxnum FROM protocol_entries WHERE protocol_year=".getCurrentYear();

		$result = mysql_query($queryMaxProtocolNumber,$db_link );
		$row = mysql_fetch_array($result);
		$max=$row[maxnum] ;
		mysql_close($db_link);	 
		if($max==null) $max=0;
		//print_r(getYearValues2());
		//echo"<h1>HELLO max=$max ,getCurrentYear=getCurrentYear() ,queryMaxProtocolNumber=$queryMaxProtocolNumber </h1>";
		return $max+1;

} // end of getNextProtocolNumber(){ =================================

?>