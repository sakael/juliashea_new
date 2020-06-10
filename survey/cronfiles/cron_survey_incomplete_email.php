<? $docRoot="/home/50168/domains/juliashea.com/html/survey/";
include($docRoot."includes/connection.php");
	$to="ccm@juliashea.com";
	$cc="julia@juliashea.com";
	$subject="Survey not completed yet.";
	$date7=date("Y-m-d", $obj->dateminus(date("Y-m-d"),7,"d"));
	$res=$obj->selectData(TABLE_SURVEY_USER,"survey_user_email,survey_client_id","DATE_FORMAT( `survey_user_crdt` , '%Y-%m-%d' ) = '".$date7."' and survey_user_enddt='0000-00-00 00:00:00' and survey_user_attend='N'");
	if(mysql_num_rows($res)>0)
	{
		$str='Here is the details.<br>';
		$str.='<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="50%" height="25" align="left" valign="top"><b>User Email</b></td>
				<td width="50%" height="25" align="left" valign="top"><b>Survey</b></td>
			  </tr>';
		while($row=mysql_fetch_array($res))
		{
			$row2=$obj->selectData(TABLE_SURVEY_CLIENT." as a,".TABLE_SURVEY." as b","survey_title","a.survey_id=b.survey_id and a.survey_client_id='".$row['survey_client_id']."'",1);
			$survey_title=$row2['survey_title'];
			$user_email=$row['survey_user_email'];
			$str.='<tr>
			<td width="50%" height="25" align="left" valign="top">'.$survey_title.'</td>
			<td width="50%" height="25" align="left" valign="top">'.$user_email.'</td>
			</tr>';
		}
		$str.='</table>';
		$obj->sendMail($to,$subject,$str,SURVEY_EMAIL,"JuliaShea Inc","","","",$cc);
	}
?>