<? 
session_start();
include("includes/connection.php");
if(!isset($_SESSION['servey_info'])) 
{
	$obj->reDirect("index.php");
}
?>