  ---------------------------------------------------------------
 /###############################################################\
 ----------------------------------------------------------------
 |#| phpSecurePages.php  20071014   mod version v029b-mod_v1.3b (SRV1edit) |#|
 ----------------------------------------------------------------
 \###############################################################/
  ---------------------------------------------------------------



-------------------------------------------------------------------
############################################################
-------------------------------------------------------------------
add/modify  this to Secure.php

// ini_set ("error_reporting","E_ALL"); // JON : If you get too many notises, uncomment this (required in users.sch)


$languageFile = 'lng_greek.php';   // this is my modified lng_english.php


include($cfgProgDir ."jon_user_access_list.php"); // include new users here

$cfgLogin[2] 		= 'jon';
$cfgPassword[2] 	= 'jon';
$cfgUserLevel[2] 	= '1';//user jon has access level 1
$cfgUserID[2] 		= '2';


-------------------------------------------------------------------
############################################################
-------------------------------------------------------------------
// Add THIS at the START of each page

<?PHP
$requiredUserLevel = array(1,2); // allow users with user access 1 or 2
$cfgProgDir = '../phpSecurePages/phpSecurePages/';
include($cfgProgDir . "secure.php");
?>


-------------------------------------------------------------------
############################################################
-------------------------------------------------------------------

//**** to logout make a link pointing here :
-------------------------------------------------------------------
put this on your page :
<A HREF="<?php echo "logout_jon.php"; ?>" target="_main" >...</a>
-------------------------------------------------------------------
name the file ***logout_jon.php***:

<?PHP
// this is my logout page from phpSecurePages. put it on root
$logout = true;
$cfgProgDir = '../phpSecurePages/phpSecurePages/';
include($cfgProgDir . "secure.php");

 /* <A HREF="<?php echo "logout_jon.php"; ?>" target="_main" > */
?>
<a href="index.php" >return to index page </a>
-------------------------------------------------------------------




-------------------------------------------------------------------
############################################################
-------------------------------------------------------------------
------------
TIPS/CLUES :
------------


---------------------------------------------
If you get too many notises, add this to secure.php :
ini_set ("error_reporting","E_ALL");


---------------------------------------------
Maybe you'll need to put before the phpSecurePages entry the code for utf8:
<HTML>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

---------------------------------------------

Δεν ξέρω αν μπορεί να σε βοηθήσει η παρακάτω λύση (ίσως χρειάζεται κάτι πολύ πιο αναλυτικό) αλλά μια από τις βασικότερες διαφορές μεταξύ PHP4 με την PHP5 είναι οι δήλωση των μεταβλητών HTTP_GET/POST/COOKIE...

Δοκίμασε λοιπόν να αλλάξεις τα παρακάτω από:

$HTTP_GET_VARS σε $_GET
$HTTP_POST_VARS σε $_POST
$HTTP_COOKIE_VARS σε $_COOKIE