<?
session_start();
include("../includes/connection.php");
if(!isset($_SESSION['client_id'])) 
{
	$redUrl = $obj->get_page_name($_SERVER['REQUEST_URI']);
	$obj->reDirect("index.php?redirect=".urlencode($redUrl));
}
else
{
	$cur_client_id=$_SESSION['client_id'];
	$cur_client_email=$_SESSION['client_email'];
	$cur_client_username=$_SESSION['client_username'];
}
?>