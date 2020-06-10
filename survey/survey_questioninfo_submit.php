<? include("user_chksession.php");
$pgNo=$_SESSION['servey_info']['survey_q_last_pg'];
if(!$_SESSION['servey_info']['survey_takerinfo_id'])
{
	$obj->reDirect(FURL."start_survey.php");
}
else
{
	if($_POST['Next'])
	{
		$pgNo=$_SESSION['servey_info']['survey_q_last_pg']+$_POST['pgnocur'];
		if($_SESSION['servey_info']['pageNo']<$pgNo)
		{
			$_SESSION['servey_info']['pageNo']=$pgNo;
		}
		$tot_q=$_POST['tot_q'];
		$pgnocur=$_POST['pgnocur'];
		for($qu=1;$qu<=$tot_q;$qu++)
		{
			$arrAns['survey_answerinfo_crdt']=date("Y-m-d H:i:s");
			$arrAns['survey_answerinfo_qid']=$_POST['q_'.$qu];
			$arrAns['survey_takerinfo_id']=$_SESSION['servey_info']['survey_takerinfo_id'];
			if($_POST['q_type_'.$qu]==1)
			{
				$arrAns['survey_answerinfo_opid']=$_POST['op_'.$qu];
				$arrAns['survey_answerinfo_optxt']='';
			}
			if($_POST['q_type_'.$qu]==2)
			{
				$arrAns['survey_answerinfo_opid']=0;
				$arrAns['survey_answerinfo_optxt']=$_POST['op_'.$qu];
			}
			if($_POST['q_ed_'.$qu])
			{
				//echo 'up';
				$obj->updateData(TABLE_SURVEY_ANSWERINFO,$arrAns,"survey_answerinfo_id='".$_POST['q_ed_'.$qu]."'");
			}
			else
			{
				//echo 'in';
				$obj->insertData(TABLE_SURVEY_ANSWERINFO,$arrAns);
			}
		}
		$endarr['survey_user_attend']='Y';
		$endarr['survey_user_enddt']=date("Y-m-d H:i:s");
		$row=$obj->updateData(TABLE_SURVEY_USER,$endarr,"survey_user_id='".$_SESSION['servey_info']['survey_user_id']."'");
		$obj->reDirect(FURL."thank_you.php");
	}
}
?>