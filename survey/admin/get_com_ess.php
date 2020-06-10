<? include("../includes/connection.php");
$grtype=$_REQUEST['grtype'];
$survey_id=$_REQUEST['survey_id'];
$survey_tuser_id=rtrim($_REQUEST['survey_user_id'],",");
$question_id=rtrim($_REQUEST['question_id'],",");
$survey_title=$obj->getSurveyTitle($survey_id);
$stid=0;
$k=-1;
$qs=array();
$qst=array();
$user_mail=array();
if($survey_tuser_id!=0)
{
	$cond.=" and survey_takerinfo_id in(".$survey_tuser_id.")";
}
$question_res=$obj->selectData(TABLE_QUESTION." as a,".TABLE_SURVEY_QUESTION." as b","a.question_id,a.question_title","a.question_id=b.question_id and a.question_status='A' and a.question_type=2 and b.survey_id='".$survey_id."'","","b.question_order");
//echo $obj->getQuery();
while($rowq=mysql_fetch_array($question_res))
{
	$qs[]=$rowq['question_id'];
	$qst[]=$rowq['question_title'];
}
$res=$obj->selectData(TABLE_SURVEY_ANSWER,"","survey_answer_opid=0".$cond,"","survey_takerinfo_id");
//echo $obj->getQuery();
while($row=mysql_fetch_array($res))
{
	if($stid!=$row['survey_takerinfo_id'])
	{
		$stid=$row['survey_takerinfo_id'];
		$k++;
		$row_uid=$obj->selectData(TABLE_SURVEY_USER." as a,".TABLE_SURVEY_TAKERINFO." as b","a.survey_user_email","b.survey_id='".$survey_id."' and a.survey_user_id=b.survey_user_id and survey_takerinfo_id='".$stid."'",1,"","survey_takerinfo_id");
		$user_mail[$k]=$row_uid['survey_user_email'];
	}
	$ans[$k][$row['survey_answer_qid']]=empty($row['survey_answer_optxt'])?'Not Answered':$row['survey_answer_optxt'];
	$ans2[$row['survey_answer_qid']][]=empty($row['survey_answer_optxt'])?'Not Answered':$row['survey_answer_optxt'];
	$stinf[$k]=$stid;
}
//print_r($ans2);
$str='';
$j=0;
$idx=0;
	for($qc=0;$qc<count($qs);$qc++)
	{
		$str.="Q. ".$qst[$qc]."\r\nAll answers for above Question\r\n";
		for($ansc2=0;$ansc2<count($ans2[$qs[$qc]]);$ansc2++)
		{
			$str.="A".($ansc2+1).". ".$ans2[$qs[$qc]][$ansc2]."\r\n";
		}
		$str.="\r\n";
	}
	
$folder=COMMENTESSAY_DOC;
$fname=$survey_title.'.txt';
$path=$folder.$fname;
$obj->fileWrite($str,$path);
header("Content-Type: application/txt");
header('Content-disposition: attachment;filename="'.$fname.'"');
readfile($folder.$fname);
exit;
?>