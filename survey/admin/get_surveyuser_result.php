<? include("../includes/connection.php");
$survey_id=$_REQUEST['survey_id'];
$survey_user_id=$_REQUEST['survey_user_id'];
$survey_title=$obj->getSurveyTitle($survey_id);
$row_usrdt=$obj->selectData(TABLE_SURVEY_USER." as a,".TABLE_SURVEY_TAKERINFO." as b","survey_user_enddt","a.survey_user_id=b.survey_user_id and b.survey_takerinfo_id='".$survey_user_id."' and survey_id='".$survey_id."'",1);
$cimp_dt=$obj->formatdatetime($row_usrdt['survey_user_enddt']);
$usr=$_REQUEST['usr'];
$fltype=$_REQUEST['fltype'];
$res_op=$obj->selectData(TABLE_OPTION,"option_id,option_title");
while($row_op=mysql_fetch_array($res_op))
{
	$opArray[$row_op['option_id']]=$row_op['option_title'];
}
$res_ans=$obj->selectData(TABLE_SURVEY_ANSWER." as a,".TABLE_QUESTION." as b,".TABLE_SURVEY_QUESTION." as c","a.*,b.question_title,b.question_id","a.survey_answer_qid=b.question_id and b.question_id=c.question_id and survey_takerinfo_id='".$survey_user_id."' and c.survey_id='".$survey_id."'","","c.question_order");
//echo $obj->getQuery();
$res_ansinfo=$obj->selectData(TABLE_SURVEY_ANSWERINFO." as a,".TABLE_QUESTION." as b,".TABLE_SURVEY_QUESTIONINFO." as c","a.*,b.question_title","a.survey_answerinfo_qid=b.question_id and b.question_id=c.question_id and survey_takerinfo_id='".$survey_user_id."' and c.survey_id='".$survey_id."'","","c.question_order");
//echo $obj->getQuery();
$k=0;
$qString='';
while($row_ans=mysql_fetch_array($res_ans))
{
	$sqArray[$k]['question']='Q.'.($k+1).'. '.$row_ans['question_title'];
	$cur_ans=empty($row_ans['survey_answer_opid'])?$row_ans['survey_answer_optxt']:empty($opArray[$row_ans['survey_answer_opid']])?empty($row_ans['survey_answer_opid'])?$row_ans['survey_answer_optxt']:$row_ans['survey_answer_opid']:$opArray[$row_ans['survey_answer_opid']];
	$sqArray[$k]['answer']='A. '.$cur_ans;
	$k++;
	$qString.=$row_ans['question_id'].",";
	$arrQ[$row_ans['question_id']]=$k;
}
$survey_tuser_id=$survey_user_id.",";
$grtype="3";
$qhid=serialize($arrQ);
$k=0;
$newstr="";
while($row_ansinfo=mysql_fetch_array($res_ansinfo))
{
	$sqArrayInfo[$k]['question']='Q.'.($k+1).'. '.$row_ansinfo['question_title'];
	$cur_ans=empty($row_ans['survey_answerinfo_opid'])?$row_ansinfo['survey_answerinfo_optxt']:empty($opArray[$row_ansinfo['survey_answerinfo_opid']])?empty($row_ansinfo['survey_answerinfo_opid'])?$row_ansinfo['survey_answerinfo_optxt']:$row_ansinfo['survey_answerinfo_opid']:$opArray[$row_ansinfo['survey_answerinfo_opid']];
	$sqArrayInfo[$k]['answer']='A. '.$cur_ans;
	$k++;
}
if($fltype=='pdf')
{
	$qrystr='?grtype=3&survey_id='.$survey_id.'&survey_user_id='.$survey_tuser_id.'&question_id='.$qString.'&arrdata='.$qhid.'&imgtag=no';
	$dataurl = AURL.'ajax_script/get_survey_graph.php'.$qrystr;
	if(ini_get('allow_url_fopen'))
	{
		$img_url=@file_get_contents($dataurl);
	}
	else
	{
		$curl_handle=curl_init();
		curl_setopt($curl_handle,CURLOPT_URL,$dataurl);
		curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
		curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);
		if (empty($buffer))
		{
			$img_url="";
		}
		else
		{
			$img_url=$buffer;
		}
	}
	if($img_url)
	{
		$newstr.=$img_url.'<br>';
	}
	//echo AURL.$img_url;
	//echo "<pre>";
	//print_r($sqArray);
	//print_r($sqArrayInfo);
	//echo "</pre>";
	//exit;
}

$str="Survey Title: ".$survey_title."<br>";
$str.="Completed by ".$usr." on ".$cimp_dt."<br><br>";
$str.=$newstr;
if($fltype!='xls')
{
	for($i=1;$i<=count($opArray);$i++)
	{
		$opTxt=empty($opArray[$i])?$i:$opArray[$i];
		$str.=$i." => ".$opTxt."<br>";
	}
	$str.="<br>";
	for($i=0;$i<count($sqArray);$i++)
	{
		$str.=$sqArray[$i]['question']."<br>";
		$str.=$sqArray[$i]['answer']."<br><br>";
	}
}
if(count($sqArrayInfo)>0)
{
	if($fltype!='xls')
	{
		$str.="Questions for Info<br><br>";
		for($i=0;$i<count($sqArrayInfo);$i++)
		{
			$str.=$sqArrayInfo[$i]['question']."<br>";
			$str.=$sqArrayInfo[$i]['answer']."<br><br>";
		}
	}
}
$folder=FULLRESULT;
$fname=$survey_title.'_'.$usr.'.'.$fltype;
$path=$folder.$fname;
switch($fltype)
{
   case 'txt': 
	   include("get_result_txt.php");
	   break;
   case 'pdf': 
	   include("get_result_pdf.php");
	   break;
   case 'xls': 
	   include("get_result_xls.php");
	   break;
   case 'doc': 
	   include("get_result_doc.php");
	   break;
}
header("Content-Type: application/".$fltype);
header('Content-disposition: attachment;filename="'.$fname.'"');
readfile($folder.$fname);
exit;
?>