<? session_start();
include("includes/connection.php");
if($_REQUEST['responce'])
{
	$to="ccm@juliashea.com";
	$cc="julia@juliashea.com";
	$subject="Survey Completed!";
	$responce=$_REQUEST['responce'];
	$survey_id=$_SESSION['servey_info']['survey_id'];
	$survey_user_id=$_SESSION['servey_info']['survey_takerinfo_id'];
	$usr=$_SESSION['servey_info']['survey_user_email'];
	$survey_title=$obj->getSurveyTitle($survey_id);
	$res_op=$obj->selectData(TABLE_OPTION,"option_id,option_title","option_status='A'");
	while($row_op=mysql_fetch_array($res_op))
	{
		$opArray[$row_op['option_id']]=$row_op['option_title'];
	}
	$res_ans=$obj->selectData(TABLE_SURVEY_ANSWER." as a,".TABLE_QUESTION." as b,".TABLE_SURVEY_QUESTION." as c","a.*,b.question_title","a.survey_answer_qid=b.question_id and b.question_id=c.question_id and survey_takerinfo_id='".$survey_user_id."' and c.survey_id='".$survey_id."'","","c.question_order");
	//echo $obj->getQuery();
	$k=0;
	while($row_ans=mysql_fetch_array($res_ans))
	{
		$sqArray[$k]['question']=($k+1).'&bull; '.$row_ans['question_title'];
		$cur_ans=empty($row_ans['survey_answer_opid'])?$row_ans['survey_answer_optxt']:$opArray[$row_ans['survey_answer_opid']];
		$sqArray[$k]['answer']=empty($cur_ans)?'':' - '.$cur_ans;
		$sqArray[$k]['number']=empty($row_ans['survey_answer_opid'])?'':' '.$row_ans['survey_answer_opid'];
		$k++;
	}
	//print_r($sqArray);
	$str="Survey Title: ".$survey_title."<br>";
	$str.="Completed by ".$usr."<br><br>";
	for($i=0;$i<count($sqArray);$i++)
	{
		$str.=$sqArray[$i]['question']." ".$sqArray[$i]['number'].$sqArray[$i]['answer']."<br><br>";
	}
	$str.='I authorize my response to be used by Julia Shea, Inc. : '.$responce;
	$obj->sendMail($to,$subject,$str,SURVEY_EMAIL,"JuliaShea Inc","","",$bcc,$cc);
	session_unregister('servey_info');
}
?>