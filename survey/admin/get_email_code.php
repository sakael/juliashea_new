<? include("../includes/connection.php");
include("../includes/classes/excelwriter.inc.php");

$survey_id=$_REQUEST['survey_id'];
$res_uid=$obj->selectData(TABLE_SURVEY_USER." as a,".TABLE_SURVEY_TAKERINFO." as b","a.survey_user_email,a.survey_user_code","b.survey_id='".$_REQUEST['survey_id']."' and a.survey_user_attend='Y' and a.survey_user_id=b.survey_user_id","","a.survey_user_email");
//echo $obj->getQuery();
$survey_title=$obj->getSurveyTitle($survey_id);
$folder=EMAILCODE;
$fname=$survey_title.'_email_code.xls';
$path=$folder.$fname;
$excel=new ExcelWriter($path);
if($excel==false)	
echo $excel->error;
$excel->writeRow();
$excel->writeCol("Survey Title: ".$survey_title);
if(mysql_num_rows($res_uid)>0)
{
	$excel->writeRow();
	$excel->writeCol("<b>Email</b>");
	$excel->writeCol("<b>Code</b>");
	while($row_uid=mysql_fetch_array($res_uid))
	{
		$excel->writeRow();
		$excel->writeCol($row_uid['survey_user_email']);
		$excel->writeCol($row_uid['survey_user_code']);
	}
}
header("Content-Type: application/xls");
header('Content-disposition: attachment;filename="'.$fname.'"');
readfile($folder.$fname);
exit;
?>