<?php
/*
TRIGGER για τον επόμενο ΑΡ. ΠΡΩΤΟΚΟΛΟΥ 


*/

$query2 = "SELECT MAX(protocol_number) as maxnum FROM protocol_entries WHERE protocol_year=".getCurrentYear(); 
//
if($data=$this->MyQuery($query2)){ 

   $result = mysql_fetch_array($data); 
   $next = $result[0]+1; 
   $newvals['protocol_number'] = $next; 
   print "<h1><font color=green> ΕΚΔΟΘΗΚΕ Ο ΑΡ. ΠΡΩΤΟΚΟΛΟΥ  = $next </font></h1>"; 
   return true; //must be tru to execute the trigger

}else{ 
	print "<h2><font color=red> ΠΑΡΟΥΣΙΑΣΤΗΚΕ ΣΦΑΛΜΑ </font></h2>"; 
	echo "\n".'<p>'.mysql_error().'</p>'; 
	/*
   echo "\n".'<p>'.mysql_error().'</p>'; 
   echo "\n".'<a href="javascript:history.go(-1)" onmouseover="self.status=document.referrer;return true">Go Back</a>'; 
   @mysql_close($this->dbh); 
   require_once('./inc/footer.php'); 
   */
   //exit; 

} 

return true;
?>