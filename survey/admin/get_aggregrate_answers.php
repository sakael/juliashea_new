<? include("../includes/connection.php");
$question_id=$_REQUEST['question_id'];
$ddtype=$_REQUEST['ddtype'];
$row_sur=$obj->selectData(TABLE_QUESTION,"question_title","question_id='".$question_id."'",1);
$question_title=$row_sur['question_title'];
$sur_id=rtrim($_REQUEST['sid'],","); 
if($ddtype!='ge')
{
	$arrVal=$obj->getInfoDdArr($ddtype);
	$arrTypeVal=$arrVal[$ddtype]['title'];
}
if($ddtype=='ge')
{
	$arrTypeVal=array('Male','Female');
}
$values="'".implode("','",$arrTypeVal)."'";
$fieldArr=array("ge"=>"survey_takerinfo_gender",
				"ag"=>"survey_takerinfo_age",
				"po"=>"survey_takerinfo_pos",
				"de"=>"survey_takerinfo_dept",
				"tc"=>"survey_takerinfo_tmcom",
				"tp"=>"survey_takerinfo_tmpp",
				"ed"=>"survey_takerinfo_edu");
$fieldCap=array("ge"=>"Gender",
				"ag"=>"Age",
				"po"=>"Position",
				"de"=>"Department",
				"tc"=>"Time with Company",
				"tp"=>"Time in Present Position",
				"ed"=>"Education");
$res=$obj->selectData(TABLE_SURVEY_TAKERINFO,"survey_takerinfo_id,".$fieldArr[$ddtype],$fieldArr[$ddtype]." in (".$values.") and survey_id in(".$sur_id.")");
//echo $obj->getQuery();
while($row=mysql_fetch_array($res))
{
	$arrGrp[$row[$fieldArr[$ddtype]]][]=$row['survey_takerinfo_id'];
}
$str="Aggregrate answers on ".$fieldCap[$ddtype]." on question: ".$question_title."\r\n\r\n";
for($i=0;$i<count($arrTypeVal);$i++)
{
	if(is_array($arrGrp[$arrTypeVal[$i]]))
	{
		$valOp=implode(",",$arrGrp[$arrTypeVal[$i]]);
		$countOp=count($arrGrp[$arrTypeVal[$i]]);
		$row_sumans=$obj->selectData(TABLE_SURVEY_ANSWER,"sum(survey_answer_opid) as totAns","survey_answer_qid='".$question_id."' and survey_takerinfo_id in(".$valOp.")",1);
		//echo $obj->getQuery();
		$str.=$arrTypeVal[$i].":\r\nTotal number of attender: ".$countOp."  Aggregrate answer: ".number_format(($row_sumans['totAns']/$countOp), 2, '.', '')."\r\n\r\n";
	}
	else
	{
		$str.=$arrTypeVal[$i].":\r\nTotal number of attender: 0   Aggregrate answer: 0\r\n\r\n";
	}
}
$folder=AGGANS;
$fname=$fieldCap[$ddtype].'.txt';
$path=$folder.$fname;
$obj->fileWrite($str,$path);
header("Content-Type: application/txt");
header('Content-disposition: attachment;filename="'.$fname.'"');
readfile($folder.$fname);
exit;
/*echo "<pre>";
print_r($arrGrp);
echo $str;*/
?>