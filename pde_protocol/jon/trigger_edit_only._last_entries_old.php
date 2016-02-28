<?php
/*
TRIGGER για να μην αλλάζουμε παλιά πρωτ
ToDo: 
-Check also that we are in current year
-BUG : This Creates a problem when we change year 

Works ONLY id protocol_number is set to 'input|A'   => 'R', (NOT READ ONLY on edit)

$oldvals works only in this trigger:
$opts['triggers']['update']['before'] = './jon/trigger_edit_only _last_entries.php'; //this works

$opts['triggers']['update']['pre'] = './jon/trigger_edit_only _last_entries.php'; // PRE does not work in PRE (no $oldvals)
NOT in pre

*/

//print_r($oldvals);//debug
$query2 = "SELECT MAX(protocol_number) as maxnum FROM protocol_entries WHERE protocol_year=".getCurrentYear(); 
//
if($data=$this->MyQuery($query2)){ 

   $result = mysql_fetch_array($data); 
   $last_number = $result[0]; 

   //print_r($this);
   //$this->fdd['excavation']['input'] = 'R';
   $number_of_entries_allowed_to_edit=50;
   if($oldvals['protocol_number']<($last_number-$number_of_entries_allowed_to_edit)) {
   
		echo "<h2><font color=red>ΔΕΝ ΕΠΙΤΡΕΠΕΤΑΙ Η ΑΛΛΑΓΗ ΠΑΛΑΙΩΝ ΕΓΓΡΑΦΩΝ ΣΕ ΑΥΤΟ ΤΟΝ ΧΡΗΣΤΗ! </font></h2>";
		echo "Επικοινωνείστε με τον διαχειριστή εαν πρέπει να αλλάξει η εγγραφή.";
		//$this->opts['options'] = 'VF';  // Changed for VIEW only user (View ,Filter) 
		return false; // Don't allow the update
   }
   
   return true; //must be true to execute the trigger

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