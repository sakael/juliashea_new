<? include("admin_chksession.php");

$pg_obj=new pagingRecords();

if($_POST['Delete'])
{
	if(!empty($_POST['del_rec']))
	{
		$ids=implode(",",$_POST['del_rec']);
		$obj->qUpdate(TABLE_SURVEY_CLIENT,"survey_client_status='D'","survey_client_id in(".$ids.")");
		$_SESSION['curMsg']=DELETE;
	}
	else
	{
		$_SESSION['curMsg']=CHECKONE;
	}
}
$sql=$obj->selectData(TABLE_SURVEY_CLIENT." as a,".TABLE_CLIENT." as b,".TABLE_SURVEY." as c","a.*,b.client_username,c.survey_title","a.client_id=b.client_id and a.survey_id=c.survey_id and survey_client_status='A' and c.survey_status='A'",2);
$pg_obj->setPagingParam("d",5,20,1,1);
$getarr=$_GET;
unset($getarr['msg']);
$res=$pg_obj->runQueryPaging($sql,$pageno,$getarr);
$qr_str=$pg_obj->makeLnkParam($getarr,0);
$i=0;
?>
<html>
<head>
<title><?=SITE_NAME?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/admin.css" rel="stylesheet" type="text/css">
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
                <td width="220" align="left" valign="top" class="inner_left"><?php include("includes/left.php"); ?></td>
                <td align="left" valign="top" class="inner"><table width="100%"  border="0" cellpadding="0" cellspacing="2">
                  <tr>
                    <td height="25" align="left" valign="middle" class="td_heading">Survey To Client :</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="border2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="25" align="left" valign="top"><table width="100%"  border="0" cellspacing="2" cellpadding="0">
                              <tr>
                                <td width="87%" align="left" valign="middle" class="error"><? echo $_SESSION['curMsg']; session_unregister('curMsg')?></td>
                                <td width="10%" align="right" valign="middle"><img src="images/add.gif" width="24" height="24"></td>
                                <td align="center" valign="middle"><a href="manage_client_survey.php" target="_self" class="blue_text"><b>Assign</b></a></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"><form name="form1" method="post" action="">
                              <table width="100%"  border="0" cellpadding="2" cellspacing="1" >
                                <tr align="center" valign="middle">
                                  <td width="20%" height="25" align="left" valign="middle" class="td_heading">Client</td>
                                  <td width="20%" align="left" valign="middle" class="td_heading">Survey</td>
                                  <td width="45%" align="left" valign="middle" class="td_heading">URL</td>
                                  <td width="5%" align="center" valign="middle" class="td_heading">User</td>
                                  <td width="6%" class="td_heading">Send</td>
                                  <td width="8%" class="td_heading">Delete</td>
                                </tr>
                                <? while($row=mysql_fetch_array($res)){?>
								<tr class="tr_bg">
                                  <td height="20" align="left" valign="middle" class="black_text"><?=$row['client_username']?></td>
                                  <td height="20" align="left" valign="middle" class="black_text"><?=$row['survey_title']?></td>
                                  <td height="20" align="left" valign="middle" class="black_text"><? echo $obj->getSurveyLink($row['survey_title'],$row['survey_client_key']);?></td>
                                  <td height="20" align="center" valign="middle" class="black_text"><a href="javascript:void(window.open('list_user_email.php?survey_client_id=<?=$row['survey_client_id']?>','Sue','resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,width=600,height=600'))" class="blue_link">View</a></td>
                                  <td align="center" valign="middle"><? if($row['survey_client_send']=='1'){ echo '<b>YES</b><br>';}?><a href="javascript:void(window.open('send_survey_url.php?survey_client_id=<?=$row['survey_client_id']?>','SeqWin','resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,width=600,height=600'))" class="blue_link">Send<? if($row['survey_client_send']=='1'){ echo ' again?';}?></a></td>
                                  <td align="center" valign="middle"><input type="checkbox" name="del_rec[]" value="<?=$row['survey_client_id']?>"></td>
                                </tr>
								<? }?>
                                <tr class="tr_bg">
                                  <td height="20" colspan="4" align="left" valign="top">&nbsp;</td>
                                  <td height="20" align="center" valign="top">&nbsp;</td>
                                  <td height="20" align="center" valign="top"><input name="Delete" type="submit" class="submit" value="Delete" onClick="return confirm('Are you sure?')"></td>
                                </tr>
                                <tr class="tr_bg2">
                                  <td colspan="6" align="center" valign="middle" class="black_text"><?=$pg_obj->pageingHTML?></td>
                                </tr>
                              </table>
                          </form></td>
                        </tr>
                    </table></td>
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