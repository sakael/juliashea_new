<? $docRoot="/home/50168/domains/juliashea.com/html/survey/";
include($docRoot."includes/connection.php");
$f_pre=$docRoot.USER_LIST;
$res=$obj->selectData(TABLE_SURVEY_CLIENT_USER,"","survey_client_user_status='N'");
while($row=mysql_fetch_array($res))
{
	$cur_id=$row['survey_client_user_id'];
	$cur_data=$row['survey_client_user_content'];
	$row2=$obj->selectData(TABLE_SURVEY_CLIENT." as a,".TABLE_CLIENT." as b,".TABLE_SURVEY." as c","a.*,b.client_username,b.client_email,b.client_company,c.survey_title","a.client_id=b.client_id and a.survey_id=c.survey_id and survey_client_status='A' and a.survey_client_id='".$row['survey_client_id']."'",1);
	//echo $obj->getQuery();
	$arrList=array();
	$curEmailArr=array();
	$data_to_fill=array();
	$obj->qUpdate(TABLE_SURVEY_CLIENT_USER,"survey_client_user_status='P'","survey_client_user_id='".$cur_id."'");
	if($row['survey_client_user_type']=='1')
	{
		$data_to_fill=explode(",",$cur_data);
	}
	if($row['survey_client_user_type']=='2')
	{
		$file_name=$f_pre.$cur_data;
		$handle = fopen($file_name, "r");
		while (($data = fgetcsv($handle,1000000,",")) !== FALSE)
		{
			$num = count($data);
			if($num==1)
			{
				$data_to_fill[]=$data[0];
			}
			else
			{
				$arrSCU['survey_client_user_remark']='Wrong .CSV format';
			}
		}
	}
	$arrList['survey_client_id']=$row['survey_client_id'];
	$arrList['survey_user_crdt']=date("Y-m-d H:i:s");
	//$client_company=$row2['client_company'];
	$survey_title=$row2['survey_title'];
	$survey_url=$obj->getSurveyLink($row2['survey_title'],$row2['survey_client_key']);
	$send_msg=$obj->makeString($row['survey_client_user_msg']);
	$subject="URL for [".$survey_title."] from Julia Shea";
	$body='Your participation in this survey is an important part of my continuous improvement process enhancing the experience of my clients.  Thank you in advance for improving my business.<br>'.$send_msg;
	$body.='<br>Here is the survey link of '.$survey_title.':<br><br><a href="'.$survey_url.'" alt="Click Here">'.$survey_url.'</a><br><br>If the link is not active, please copy and paste the link to your browser to open survey.';
	$body.='<br><br>Sincerely,<br>   Julia';
	for($i=0;$i<count($data_to_fill);$i++)
	{
		$arrList['survey_user_email']=trim($data_to_fill[$i]);
		if($obj->validate_email($arrList['survey_user_email']))
		{
			if (!in_array($arrList['survey_user_email'], $curEmailArr))
			{
				$curEmailArr[]=$data_to_fill[$i];
				$arrList['survey_user_code']=$obj->generateUserCode(6);
				$in_id=$obj->insertData(TABLE_SURVEY_USER,$arrList);
				if($in_id)
				{
					//$body.='<br>Here is your code: '.$arrList['survey_user_code'];
					$sndStat=$obj->sendMail($arrList['survey_user_email'], $subject, $body,$row2['client_email'],$row2['client_username']);
					if($sndStat==1)
					{
						$obj->qUpdate(TABLE_SURVEY_USER,"survey_user_status='Y'","survey_user_id='".$in_id."'");
					}
				}
			}
		}
	}
	$arrSCU['survey_client_user_status']='S';
	$obj->updateData(TABLE_SURVEY_CLIENT_USER,$arrSCU,"survey_client_user_id='".$cur_id."'");
}
@mail("demoforclient@gmail.com", "Cron is Running", "hello"); 
?>