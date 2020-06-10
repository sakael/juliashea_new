<? if(!session_id())
{
	session_start();
}
require_once("configure.php");
require_once("allconfig.php");
require_once(CLASSES."class_db_connect.php");
require_once(CLASSES."class_main_function.php");
require_once(CLASSES."class_gen_function.php"); 
require_once(CLASSES."class_paging.php");
$obj = new gen_function;
global $obj;
?>