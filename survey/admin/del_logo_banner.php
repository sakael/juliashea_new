<? include("../includes/connection.php");
$client_id=$_REQUEST['client_id'];
$type=$_REQUEST['type'];
$fldNm='';
if($type=='l')
{
	$fldNm='client_logo';
	$txt='Logo';
}
if($type=='b')
{
	$fldNm='client_banner';
	$txt='Banner';
}
if($fldNm)
{
	$msg=$txt.' deleted successfully.';
	$obj->updateData(TABLE_CLIENT,array($fldNm=>''),"client_id='".$client_id."'");
	$obj->reDirect("manage_client.php?client_id=".$client_id."&msg=".$msg);
}
?>