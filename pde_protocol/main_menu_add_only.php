<?php
/*
Main variables for usage. Maybe this can be used to select A' bathnmia, B' bathmia & dieythynseis
put 
For ADD only :
-DELETE LINE include_once "main_include.php";
-ADD LINE include_once "main_menu_add_only.php";  //BEFORE new phpMyEdit Class
-Change $minUserLevel=7; to =5
*/
$opts['options'] = 'AVF';  // Changed for ADD only user (ADD,VIEW,FILTER)
echo "Όνομα χρήστη : $ID <BR> <h2>ΕΠΙΛΟΓΕΣ ";
echo "
<A HREF='logout_jon.php' target='_main' >ΕΞΟΔΟΣ</a>


</h2>";
//include_once "css_jon_codeBLUE.php"; //CSS class
?>