<?
session_start();
include("../includes/connection.php");
if(!isset($_SESSION['admin_email'])) 
{
	$redUrl = $obj->get_page_name($_SERVER['REQUEST_URI']);
	$obj->reDirect("index.php?redirect=".urlencode($redUrl));
}
?>