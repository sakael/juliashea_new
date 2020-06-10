<? include("../../includes/connection.php");
include("../graph_class/pData.class");
include("../graph_class/pChart.class");
$DataSet = new pData;
$grtype=$_REQUEST['grtype'];
$survey_id=rtrim($_REQUEST['survey_id'],",");
$question_id=$_REQUEST['question_id'];
$obj->delete_all_files("../graph_img/");
$img_name="graph_img/".date("YmdHis")."graph.png";
$qst[]="Question";
$opt=$_REQUEST['opt'];
$survey_title="above Question in selected survey";
$error=0;
$res_st=$obj->selectData(TABLE_SURVEY_TAKERINFO." as a,".TABLE_SURVEY_USER." as b,".TABLE_SURVEY." as c","a.survey_takerinfo_id,b.survey_client_id,b.survey_user_email,c.survey_title","b.survey_user_attend='Y' and c.survey_id in(".$survey_id.") and a.survey_id=c.survey_id and a.survey_user_id=b.survey_user_id");
while($row_st=mysql_fetch_array($res_st))
{
	$row_client=$obj->selectData(TABLE_SURVEY_CLIENT." as a1,".TABLE_CLIENT." as b1","client_username","a1.client_id=b1.client_id and survey_client_id='".$row_st['survey_client_id']."'",1);
	$sur[]=$row_st['survey_title'];
	$user_mail[]=$row_st['survey_user_email']."[".$row_client['client_username']."]";
	$sur_tinf[]=$row_st['survey_takerinfo_id'];
}
$tot_point=0;
for($u=0;$u<count($sur_tinf);$u++)
{
	$row_ans=$obj->selectData(TABLE_SURVEY_ANSWER,"survey_answer_opid","survey_answer_qid='".$question_id."' and survey_takerinfo_id='".$sur_tinf[$u]."'",1); 
	$tot_point+=$row_ans['survey_answer_opid'];
	if($opt==1)
	{
		$ans[$u]=$row_ans['survey_answer_opid'];
	}
}
if($opt==0)
{
	if(count($sur_tinf)>0)
	{
		$ans[]=$tot_point/count($sur_tinf);
		$user_mail=array();
		$user_mail[]="Combination of all";
	}
	if(count($sur_tinf)==0)
	{
		$error=1;
	}
}
if($error==0)
{
	if(count($ans)==0)
	{
		$error=1;
	}
}
if($error==0)
{
	for($ansc=0;$ansc<count($ans);$ansc++)
	{
		$finalarr[$ansc]=$finalarr[$ansc].",".(int)$ans[$ansc];
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
<? }else{
echo '<span class="error">No one has completed this survey</span>';
}?>