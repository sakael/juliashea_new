<?php include("includes/connection.php");
unset($_SESSION['servey_info']);
if($_GET['acckey'])
{
	$cur_acckey=$_GET['acckey'];
	$row=$obj->selectData(TABLE_SURVEY_CLIENT." as a,".TABLE_SURVEY." as b","","a.survey_id=b.survey_id and b.survey_status='A' and survey_client_key='".$cur_acckey."' and survey_client_status='A'",1);
	if($row==0)
	{
		echo 'This url is not exist,Please check it again...';
	}
	else
	{
		$logobanner=$obj->getClientLogoBanner($row['client_id']);
		$cl_logo='';
		$cl_banner=CLIENT_BANNER.'side_banner.jpg';
		if(!empty($logobanner[0]))
		{
			$cl_logo=CLIENT_LOGO.$logobanner[0];
			if(!is_file($cl_logo))
			{
				$cl_logo='';
			}
		}
		if(!empty($logobanner[1]))
		{
			$cl_banner=CLIENT_BANNER.$logobanner[1];
			if(!is_file($cl_banner))
			{
				$cl_banner=CLIENT_BANNER.'demo_banner.jpg';
			}
		}
		$_SESSION['servey_info']['survey_client_id']=$row['survey_client_id'];
		$_SESSION['servey_info']['client_id']=$row['client_id'];
		$_SESSION['servey_info']['survey_id']=$row['survey_id'];
		$_SESSION['servey_info']['survey_title']=$obj->getSurveyTitle($row['survey_id']);
		$_SESSION['servey_info']['survey_client_key']=$row['survey_client_key'];
		$_SESSION['servey_info']['client_logo']='../'.$cl_logo;
		$_SESSION['servey_info']['client_banner']='../'.$cl_banner;
		$_SESSION['servey_info']['client_company']=$row['client_company'];
		$_SESSION['servey_info']['welcome_text']=$obj->putContent(2);
		$_SESSION['servey_info']['survey_cur_pgno']=0;
		$obj->reDirect(FURL."start_survey.php");
	}
}
else
{
?>
<script language="javascript">window.close();</script>
<?php }?>
