<?php
/*
Main variables for usage. Maybe this can be used to select A' bathnmia, B' bathmia & dieythynseis
put 
include_once "main_include.php";

*/
echo "Όνομα χρήστη : $ID <BR> <h2>ΕΠΙΛΟΓΕΣ ";
if($userLevel>6){
	echo" 
	<a href='protocol_entries_full.php' >ΠΡΩΤΟΚΟΛΛΟ</a> |
	<a href='protocol_status_full.php' >ΔΙΑΧ. ΚΑΤΑΣΤΑΣΕΩΝ ΕΓΓΡΑΦΟΥ </a> |
	<a href='protocol_assign_names_full.php' >ΔΙΑΧ. ΠΡΟΣΩΠΙΚΟΥ ΧΡΕΩΣΗΣ </a> |
	<a href='protocol_completion_media_full.php' >ΔΙΑΧ. ΜΕΣΩΝ ΔΙΕΚΠ. </a> | ";
	}
if($userLevel>=9){echo "  <a href='backup_excel_request.php' >ΕΞΑΓΩΓΗ XLS</a> |";	}
echo "
<A HREF='logout_jon.php' target='_main' >ΕΞΟΔΟΣ</a>


</h2>";
//include_once "css_jon_codeBLUE.php"; //CSS class


//include_once "./jon/jon_functions.php";	
//if(!$todays_backup_file_exists) 	echo "<br>--Δημιουργήθηκε ημερήσιο αντίγραφο ασφαλείας.--";		
//if(!$monthly_backup_file_exists) 	echo "<br>--Δημιουργήθηκε ημερήσιο αντίγραφο ασφαλείας.--";		
?>