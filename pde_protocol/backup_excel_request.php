<?php  
 
//Part of backup_excel.php   //version 1.1c 20120219
//note phpSecurePages AUTH is moved under the if check to avoid the headers already send

//$minUserLevel=8;
//$cfgProgDir = './phpSecurePages/phpSecurePages/';
//require_once($cfgProgDir . "secure.php");

$backup_excel_path="jon/admin/";
$tri_debug=false;




$xro=$_REQUEST["PME_xro"];
//if ($xro ==null){echo "ERROR"; $xro="error";}

if($_REQUEST["PME_sys_xls"] =="sended" && is_numeric($xro) && $xro>2010 && $xro <2030 ) {
	// MUST RUn the excel class and disable the final commande
	if($tri_debug)echo "<h1>all ok   PME_sys_xls =".$_REQUEST["PME_sys_xls"]."</h1>";
	if($tri_debug)echo "<h1>all ok   PME_xro=".$xro."</h1>";
	include_once $backup_excel_path."backup_excel_protocol.php";
} else {
$minUserLevel=8;
$cfgProgDir = './phpSecurePages/phpSecurePages/';
require($cfgProgDir . "secure.php");

?>
<html>
<body>
<H3>ΓΙΑ ΕΞΑΓΩΓΗ ΣΤΟΙΧΕΙΩΝ ΣΕ EXCEL ΕΙΣΑΓΕΤΕ ΧΡΟΝΙΑ </H3>
<A HREF='logout_jon.php' target='_main' >ΕΞΟΔΟΣ</a>
<BR>
<form method="post" action="" name="query_for_excel">
	<input type="hidden" name="PME_sys_xls" value="sended" />
	<input type="text" name="PME_xro" value="<?php echo date("Y"); ?>"  size=4 />
	<input type="submit" name="PME_sys_operation" value="Υποβολή" />
</form>





</body> </html>
<?php } ?>