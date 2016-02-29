<?php
// Include settings
require_once("config.php");
// Get the filename to be deleted
$file=$_GET['file'];

// Check if the file has needed args
if ($file==NULL){
  print("<script type='text/javascript'>window.alert('ΑΚΥΡΟ ΟΝΟΜΑ ΑΡΧΕΙΟΥ.')</script>");
  print("<script type='text/javascript'>window.location='manage.php'</script>");
  print("You have not provided a file to delete.<br>Click <a href='manage.php'>here</a> if your browser doesn't automatically redirect you.");
  die();
}

if($allow_delete) {
		// Delete the SQL file
		if (!is_dir($backup_dir. $file . '.sql')) {
			 unlink($backup_dir . $file . '.sql');
		}
	if($create_files_backup)
		// Delete the ZIP file
		if (!is_dir($backup_dir . $file . '.zip')) {
			 unlink($backup_dir . $file . '.zip');
		}
}
// Redirect
header("Location: manage.php");
?>
