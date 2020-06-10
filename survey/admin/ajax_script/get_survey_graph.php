<? include("../../includes/connection.php");
include("../graph_class/pData.class");
include("../graph_class/pChart.class");
$DataSet = new pData;
$grtype=$_REQUEST['grtype'];
$survey_id=$_REQUEST['survey_id'];
$imgtag=$_REQUEST['imgtag'];
$survey_tuser_id=rtrim($_REQUEST['survey_user_id'],",");
$question_id=rtrim($_REQUEST['question_id'],",");
$survey_title=$obj->getSurveyTitle($survey_id);
$obj->delete_all_files("../graph_img/");
$qorderarr=unserialize($_REQUEST['arrdata']);
$img_name="graph_img/".date("YmdHis")."graph.png";
if($imgtag=='no'){
$img_name="graph_img_attach/".date("YmdHis")."graph.png";
}
$question_res=$obj->selectData(TABLE_QUESTION." as a,".TABLE_SURVEY_QUESTION." as b","a.question_id,a.question_title","a.question_id=b.question_id and a.question_status='A' and a.question_type=1 and b.survey_id='".$survey_id."' and a.question_id in(".$question_id.")","","b.question_order");
while($rowq=mysql_fetch_array($question_res))
{
	$qs[]=$rowq['question_id'];
	$qst[]=$rowq['question_title'];
}
$cond="";
if($survey_tuser_id!=0)
{
	$cond.=" and survey_takerinfo_id in(".$survey_tuser_id.")";
}
$res=$obj->selectData(TABLE_SURVEY_ANSWER,"","survey_answer_opid!=0 and survey_answer_qid in(".$question_id.")".$cond,"","survey_takerinfo_id");
//echo $obj->getQuery();
$stid=0;
$k=-1;
while($row=mysql_fetch_array($res))
{
	if($stid!=$row['survey_takerinfo_id'])
	{
		$stid=$row['survey_takerinfo_id'];
		$k++;
		$row_uid=$obj->selectData(TABLE_SURVEY_USER." as a,".TABLE_SURVEY_TAKERINFO." as b","a.survey_user_email","b.survey_id='".$survey_id."' and a.survey_user_id=b.survey_user_id and survey_takerinfo_id='".$stid."'",1,"","survey_takerinfo_id");
		$user_mail[$k]=$row_uid['survey_user_email'];
	}
	$ans[$k][$row['survey_answer_qid']]=$row['survey_answer_opid'];
}
for($ansc=0;$ansc<count($ans);$ansc++)
{
	for($qc=0;$qc<count($qs);$qc++)
	{
		$finalarr[$ansc]=$finalarr[$ansc].",".(int)$ans[$ansc][$qs[$qc]];
		$xAxixarr[$qs[$qc]]=$qorderarr[$qs[$qc]];
	}
}
switch($grtype)
{
   case 1: 
       include("ver_pie_graph.php");
       break;
   case 2: 
       include("line_graph.php");
       break;
   case 3: 
       include("ver_bar_graph.php");
       break;
   case 4:
       include("overlayed_bar_graph.php");
       break;
}
?>
<img src="<?=$img_name?>" />

