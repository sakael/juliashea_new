<? include("../../includes/connection.php");
$res=$obj->selectData(TABLE_SURVEY_CLIENT,"survey_id","client_id='".$_GET['id']."' and survey_client_status='A'");
while($row=mysql_fetch_array($res))
{
	$arrSurvey[]=$row['survey_id'];
}
?>
<select name="survey_id[]" size="10" multiple id="survey_id">
<?=$obj->getSurvey($arrSurvey)?>
</select>