<? include("../includes/connection.php");
$no_head_link=1;
$mailSend=0;
if($_POST['Submit'])
{
	$survey_title=$_POST['survey_title'];
	$client_email=$_POST['client_email'];
	$client_username=$_POST['client_username'];
	$client_company=$_POST['client_company'];
	$client_password=base64_decode($_POST['cp']);
	$survey_url=$_POST['survey_url'];
	$send_msg=$obj->makeString($_POST['send_msg']);
	$subject="Client URL for [".$survey_title."] from Julia Shea";
	$to=$client_email;
	$from=SURVEY_EMAIL;
	$fromname="Julia Shea";
	$body='<p>Thank you for taking the time to  distribute the survey and being a key part of the continuous improvement  process. <br>'.$send_msg.'</p><p>Here is the link for the  administration panel of your surveys:<br><a href="'.CURL.'">'.CURL.'</a>';
	$body.='<br>Username:'.$client_username.'<br>Password:'.$client_password.'</p>';
	$body.='<br>Directions for Administration of the survey can be downloaded at:<a href="'.SURVEY_INST_DOC.'">'.SURVEY_INST_DOC.'</a><br>If the link is not active, please copy and paste link to your browser.';

	$stat=$obj->sendMail($to,$subject,$body,$from,$fromname);
	if($stat==1)
	{
		$_SESSION['curMsg']='URL send Successfully';
		$arrSend['survey_client_senddt']=date("Y-m-d H:i:s");
		$arrSend['survey_client_send']=1;
		$obj->updateData(TABLE_SURVEY_CLIENT,$arrSend,"survey_client_id='".$_REQUEST['survey_client_id']."'");
		$mailSend=1;
	}
	else
	{
		$_SESSION['curMsg']='Can not send URL.Try latter!!';
	}
}
if($_REQUEST['survey_client_id']){
$row=$obj->selectData(TABLE_SURVEY_CLIENT." as a,".TABLE_CLIENT." as b,".TABLE_SURVEY." as c","a.*,b.client_username,b.client_email,b.client_company,b.client_password,c.survey_title","a.client_id=b.client_id and a.survey_id=c.survey_id and survey_client_status='A' and survey_client_id='".$_REQUEST['survey_client_id']."'",1);
}
?>
<html>
<head>
<title><?=SITE_NAME?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript">
<? if($mailSend==1)
{?>
	alert('<?=$_SESSION['curMsg']?>...close this window?');
	self.close();
<? unset($_SESSION['curMsg']);}?>
</script>
</head>
<body>
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
   <tr>
    <td height="125" align="left" valign="top"><?php include("includes/header.php"); ?></td>
  </tr>
  <tr>
    <td align="center" valign="top" class="mainbodybg"><table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td align="left" valign="top" class="inner"><table width="100%"  border="0" cellpadding="0" cellspacing="2">
                <tr>
                  <td height="25" align="left" valign="middle" class="td_heading">Send URL to client :</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="border2"><form name="form1" method="post" action="">
                      <table width="100%" border="0" cellspacing="1" cellpadding="2">
                        <? if($_SESSION['curMsg']){?>
						<tr class="tr_bg">
                          <td height="30" align="left" valign="middle" class="blacktxt_bold">&nbsp;</td>
                          <td align="center" valign="middle" class="blacktxt_bold">&nbsp;</td>
                          <td align="left" valign="middle" class="error"><? echo $_SESSION['curMsg'];unset($_SESSION['curMsg']);?></td>
                        </tr>
						<? }?>
                        <tr class="tr_bg">
                          <td width="10%" height="30" align="left" valign="middle" class="blacktxt_bold">Survey</td>
                          <td width="2%" align="center" valign="middle" class="blacktxt_bold">:</td>
                          <td width="86%" align="left" valign="middle" class="blacktxt_bold"><?=$row['survey_title']?><input name="survey_title" type="hidden" id="survey_title" value="<?=$row['survey_title']?>"></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="blacktxt_bold" id="sur_tit">Client</td>
                          <td align="center" valign="top" class="black_text" id="sur_tit"><span class="blacktxt_bold">:</span></td>
                          <td align="left" valign="top" class="blacktxt_bold" id="sur_tit"><?=$row['client_username']?>&lt;<?=$row['client_email']?>&gt;<input name="client_email" type="hidden" id="client_email" value="<?=$row['client_email']?>"><input name="client_username" type="hidden" id="client_username" value="<?=$row['client_username']?>">
                            <input name="client_company" type="hidden" id="client_company" value="<?=$row['client_company']?>">
                            <input name="cp" type="hidden" id="cp" value="<?=base64_encode($row['client_password'])?>"></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="blacktxt_bold">Url</td>
                          <td align="center" valign="top" class="blacktxt_bold">:</td>
                          <td align="left" valign="top" class="blacktxt_bold"><? echo $obj->getSurveyLink($row['survey_title'],$row['survey_client_key']);?><input name="survey_url" type="hidden" id="survey_url" value="<? echo $obj->getSurveyLink($row['survey_title'],$row['survey_client_key']);?>"></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="blacktxt_bold">Message</td>
                          <td align="center" valign="top" class="black_text"><span class="blacktxt_bold">:</span></td>
                          <td align="left" valign="top" class="black_text"><textarea name="send_msg" cols="50" rows="8" id="send_msg"></textarea></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="center" valign="top" class="black_text">&nbsp;</td>
                          <td align="center" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="top" class="black_text"><input name="Submit" type="submit" class="submit" value="Send"></td>
                        </tr>
                      </table>
                  </form></td>
                </tr>
                <tr>
                  <td height="3" align="left" valign="top" class="td_bottom"><img src="images/spacer.gif" width="1" height="1"></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="29" align="left" valign="top"><?php include("includes/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
