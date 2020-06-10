<? include("../includes/connection.php");
$no_head_link=1;
$mailSend=0;
if($_POST['Submit'])
{
	$survey_title=$_POST['survey_title'];
	$arrSCU['survey_client_user_type']=$_POST['survey_client_user_type'];
	if($arrSCU['survey_client_user_type']==1)
	{
		$arrSCU['survey_client_user_content']=$_POST['content_c'];
	}
	if($arrSCU['survey_client_user_type']==2)
	{
		list($fileName,$error) = $obj->uploadFiles('content_f','../'.USER_LIST,'csv');
		if($error=="")
		{
			$arrSCU['survey_client_user_content']=$fileName;
		}
	}
	$arrSCU['survey_client_id']=$_REQUEST['survey_client_id'];
	$arrSCU['survey_client_user_msg']=$_POST['send_msg'];
	if($error=="")
	{
		$arrSCU['survey_client_user_crdt']=date("Y-m-d H:i:s");
		$obj->insertData(TABLE_SURVEY_CLIENT_USER,$arrSCU);
		$_SESSION['curMsg']='Your surveys have been sent successfully!';
		$mailSend=1;
	}
	else
	{
		$_SESSION['curMsg']=$error;
	}
}
if($_REQUEST['survey_client_id']){
$row=$obj->selectData(TABLE_SURVEY_CLIENT." as a,".TABLE_CLIENT." as b,".TABLE_SURVEY." as c","a.*,b.client_username,b.client_email,c.survey_title","a.client_id=b.client_id and a.survey_id=c.survey_id and survey_client_status='A' and survey_client_id='".$_REQUEST['survey_client_id']."'",1);
}
?>
<html>
<head>
<title><?=CLIENT_SITE_NAME?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/client.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/formValidation.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript">
<? if($mailSend==1)
{?>
	alert('<?=$_SESSION['curMsg']?>');
	self.close();
<?php unset($_SESSION['curMsg']);}?>
function setDisplay(id)
{
	$('#div_content_c').css("display","none");
	$('#div_content_f').css("display","none");
	if(id==1)
	{
		$('#div_content_c').css("display","");
	}
	if(id==2)
	{
		$('#div_content_f').css("display","");
	}
}
function chkExt(val)
{
	var str=val;
	str=str.toLowerCase();
	var pos=str.lastIndexOf(".");
	var len=str.length;
	var upper=len-pos;
	var ext=str.substring(pos,len);
	if(ext!='.csv')
	{
		return false;
	}
	return true;
}
function chkBlank()
{
	var frm=document.form1;
	if(frm.survey_client_user_type[0].checked==true)
	{
		if(isWhitespace(frm.content_c.value))
		{
			alert('Please enter comma seperated email here');
			frm.content_c.focus();
			return false;
		}
	}
	if(frm.survey_client_user_type[1].checked==true)
	{
		if(isWhitespace(frm.content_f.value))
		{
			alert('Please upload a csv which contains emails');
			frm.content_f.focus();
			return false;
		}
		else
		{
			if(!chkExt(frm.content_f.value))
			{
				alert('Please upload .csv only');
				return false;
			}
		}
	}
}
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
                  <td height="25" align="left" valign="middle" class="td_heading">Send URL:</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="border2"><form name="form1" method="post" action="" enctype="multipart/form-data">
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
                          <td height="25" align="left" valign="top" class="blacktxt_bold" id="sur_tit">Emails </td>
                          <td align="center" valign="top" class="black_text" id="sur_tit"><span class="blacktxt_bold">:</span></td>
                          <td align="left" valign="top" class="black_text" id="sur_tit"><input name="survey_client_user_type" type="radio" value="1" checked onClick="setDisplay(1)">
                            Enter emails below(comma separated)<span class="blacktxt_bold">&nbsp;&nbsp;OR&nbsp;&nbsp;</span><input name="survey_client_user_type" type="radio" value="2" onClick="setDisplay(2)">
                            Upload a CSV(email in one column)</td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="blacktxt_bold">&nbsp;</td>
                          <td align="center" valign="top" class="blacktxt_bold">&nbsp;</td>
                          <td align="left" valign="top" class="blacktxt_bold"><div id="div_content_f" style="display:none"><input name="content_f" type="file" size="40"></div><div id="div_content_c">
                            <textarea name="content_c" cols="50" rows="8" id="content_c"></textarea>
                          </div></td>
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
                          <td align="left" valign="top" class="black_text"><input name="Submit" type="submit" class="submit" value="Send" onClick="return chkBlank()"></td>
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
