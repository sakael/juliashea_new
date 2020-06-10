<? include("../includes/connection.php");
$del_id=(int)$_GET['del_id'];
if($del_id)
{
	$row_tkinfo=$obj->selectData(TABLE_SURVEY_TAKERINFO,"survey_takerinfo_id,survey_user_id,survey_id","survey_takerinfo_id='".$del_id."'",1);
	$res_ans=$obj->selectData(TABLE_SURVEY_ANSWER,"","survey_takerinfo_id='".$del_id."'");
	$i=0;
	while($row_ans=mysql_fetch_array($res_ans))
	{
		$ansArray[$i]=$row_ans;
		$i++;
	}
	$res_ansinfo=$obj->selectData(TABLE_SURVEY_ANSWERINFO,"","survey_takerinfo_id='".$del_id."'");
	$j=0;
	while($row_ansinfo=mysql_fetch_array($res_ansinfo))
	{
		$ansinfoArray[$j]=$row_ansinfo;
		$j++;
	}
	$ansBkp['survey_takerinfo_id']=$del_id;
	$ansBkp['answer_backup_ansdata']=serialize($ansArray);
	$ansBkp['answer_backup_ansinfodata']=$ansinfoArrayStr=serialize($ansinfoArray);
	$ansBkp['answer_backup_date']=date("Y-m-d H:i:s");
	$inQry=$obj->insertData(TABLE_SURVEY_ANSWER_BACKUP,$ansBkp);
	$delDtAns=$obj->deleteData(TABLE_SURVEY_ANSWER,"survey_takerinfo_id='".$del_id."'");
	$delDtAnsInfo=$obj->deleteData(TABLE_SURVEY_ANSWERINFO,"survey_takerinfo_id='".$del_id."'");
	$upArr['survey_user_enddt']='0000-00-00 00:00:00';
	$upArr['survey_user_attend']='N';
	$upSql=$obj->updateData(TABLE_SURVEY_USER,$upArr,"survey_user_id='".$row_tkinfo['survey_user_id']."'");
}
$obj->reDirect("analyze_surveyuser_result.php");
?>