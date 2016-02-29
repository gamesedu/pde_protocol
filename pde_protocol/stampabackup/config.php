<?php
//Version 1.01 - 
$minUserLevel=8;
$cfgProgDir = '../phpSecurePages/phpSecurePages/';
require_once($cfgProgDir . "secure.php");
// Settings
$table = '*';
$DBhost = 'localhost';
$DBuser = 'john';
$DBpass = 'john';
$DBName = 'pde_protocol_production';
$create_files_backup=false; // leave it to FALSE - it has BUGS
$backup_dir="../backup_sql_/";
$allow_delete=false;
?>