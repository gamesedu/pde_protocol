<?php
/*
v152b_20130529b mod for protocol manager (pamela)
v121_20120119 reset newvals to oldvals
-version trigger_edit_only _last_entries_v120_20120119

TRIGGER για να μην αλλάζουμε παλιά πρωτ
ToDo: 
-Check also that we are in current year
-BUG : This Creates a problem when we change year 

Works ONLY id protocol_number amd protocol_year is set to 'input|A'   => 'R', (NOT READ ONLY on edit)

$oldvals works only in this trigger:
$opts['triggers']['update']['before'] = './jon/trigger_edit_only _last_entries.php'; //this works

$opts['triggers']['update']['pre'] = './jon/trigger_edit_only _last_entries.php'; // PRE does not work in PRE (no $oldvals)
NOT in pre

Changes :
v121_20120119 reset newvals to oldvals
-version trigger_edit_only _last_entries_v120_20120119


*/
//Reset New values to Old values (This userlevel can't change Protocol_number & year 
if($newvals['protocol_number'] != $oldvals['protocol_number']) 
	{
		$newvals['protocol_number'] = $oldvals['protocol_number']; 
		echo "<br>ΔΕΝ ΕΠΙΤΡΕΠΕΤΑΙ Η ΑΛΛΑΓΗ ΤΟΥ ΑΡΙΘΜΟΥ ΠΡΩΤΟΚΟΛΟΥ!";
	}
if($newvals['protocol_year'] != $oldvals['protocol_year']) {
		$newvals['protocol_year'] = $oldvals['protocol_year']; 
		echo "<br>ΔΕΝ ΕΠΙΤΡΕΠΕΤΑΙ Η ΑΛΛΑΓΗ ΤΟΥ ΕΤΟΥΣ ΠΡΩΤΟΚΟΛΟΥ!";
		}

$currentYear=getCurrentYear();
$entries_allowed_to_edit=4000;


// 20130529 eresos proposal

//print_r($oldvals);//debug
$query2 = "SELECT MAX(protocol_number) as maxnum FROM protocol_entries WHERE protocol_year=".($currentYear-1); 
//
if($data=$this->MyQuery($query2)){ 

   $result = mysql_fetch_array($data); 
   $last_number = $result[0]; 
		
   $trigger_error_message="<h2><font color=red>ΔΕΝ ΕΠΙΤΡΕΠΕΤΑΙ Η ΑΛΛΑΓΗ ΠΑΛΑΙΩΝ ΕΓΓΡΑΦΩΝ ΣΕ ΑΥΤΟ ΤΟΝ ΧΡΗΣΤΗ! </font></h2>Επικοινωνείστε με τον διαχειριστή εαν πρέπει να αλλάξει η εγγραφή.";
	$this_protocol_number	=$oldvals['protocol_number'];
	$this_protocol_year		=$oldvals['protocol_year'];
   //print_r($this);
   //$this->fdd['excavation']['input'] = 'R';



		//Quick and Dirty Fix : DO NOT ALLOW LAST YEAR PROTOCOLS TO CHANGE (only as admin)
		if($this_protocol_year==$currentYear)return true;//added by john 20130529eresos agra
		if($this_protocol_year==($currentYear-1)){
			//We are in current year (we don't care if we have a negative $last_number-$entries_allowed_to_edit)
			if($this_protocol_number>($last_number-$entries_allowed_to_edit)
			){
				return true;
			} else {
					echo $trigger_error_message;
					//$this->opts['options'] = 'VF';  // Changed for VIEW only user (View ,Filter) 
					return false; // Don't allow the update
			}
		}

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
echo  $trigger_error_message."<br>Maybe SQL error";

return false; // Do not allow edit on SQL error
?>