<? include("admin_chksession.php");

$pg_obj=new pagingRecords();

if($_POST['Delete'])
{
	if(!empty($_POST['del_rec']))
	{
		$ids=implode(",",$_POST['del_rec']);
		$obj->qUpdate(TABLE_SURVEY,"survey_status='D'","survey_id in(".$ids.")");
		$_SESSION['curMsg']=DELETE;
	}
	else
	{
		$_SESSION['curMsg']=CHECKONE;
	}
}
$sql=$obj->selectData(TABLE_SURVEY." as a,".TABLE_SURVEYTYPE." as b","a.*,b.surveytype_title","survey_status='A' and surveytype_status='A' and a.surveytype_id=b.surveytype_id",2,"surveytype_id,survey_id desc");
//echo $obj->getQuery();
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
                    <td height="25" align="left" valign="middle" class="td_heading">Survey :</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="border2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="25" align="left" valign="top"><table width="100%"  border="0" cellspacing="2" cellpadding="0">
                              <tr>
                                <td width="87%" align="left" valign="middle" class="error"><? echo $_SESSION['curMsg']; session_unregister('curMsg')?></td>
                                <td width="10%" align="right" valign="middle"><img src="images/add.gif" width="24" height="24"></td>
                                <td align="center" valign="middle"><a href="manage_survey.php" target="_self" class="blue_text"><b>Add</b></a></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"><form name="form1" method="post" action="">
                              <table width="100%"  border="0" cellpadding="2" cellspacing="1" >
                                <tr align="center" valign="middle">
                                  <td width="40%" height="25" align="left" valign="middle" class="td_heading">Survey type</td>
                                  <td width="20%" align="left" valign="middle" class="td_heading">Survey title</td>
                                  <td width="10%" align="center" valign="middle" class="td_heading">Questions Order </td>
                                  <td width="10%" align="center" valign="middle" class="td_heading">Info Questions Order</td>
                                  <td width="10%" class="td_heading"> Edit</td>
                                  <td width="10%" class="td_heading">Delete</td>
                                </tr>
                                <? while($row=mysql_fetch_array($res)){?>
								<tr class="tr_bg">
                                  <td height="20" align="left" valign="middle" class="black_text"><?=$row['surveytype_title']?></td>
                                  <td height="20" align="left" valign="middle" class="black_text"><?=$row['survey_title']?></td>
                                  <td height="20" align="center" valign="middle" class="black_text"><a href="javascript:void(window.open('change_question_order.php?survey_id=<?=$row['survey_id']?>','SeqWin','resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,width=600,height=600'))" class="blue_link">Set</a></td>
                                  <td height="20" align="center" valign="middle" class="black_text"><a href="javascript:void(window.open('change_questioninfo_order.php?survey_id=<?=$row['survey_id']?>','SeqWin','resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,width=600,height=600'))" class="blue_link">Set</a></td>
                                  <td align="center" valign="middle"><a href="manage_survey.php?survey_id=<?=$row['survey_id']?>&<?=$qr_str?>" target="_self" class="blue_link">Edit</a></td>
                                  <td align="center" valign="middle"><input type="checkbox" name="del_rec[]" value="<?=$row['survey_id']?>"></td>
                                </tr>
								<? }?>
                                <tr class="tr_bg">
                                  <td height="20" colspan="7" align="left" valign="middle">&nbsp;</td>
                                </tr>
                                <tr class="tr_bg2">
                                  <td height="25" colspan="7" align="right" valign="middle" class="black_text" style="padding-right:8px;"><input name="Delete" type="submit" class="submit" value="Delete" onClick="return confirm('Are you sure?')">                                  </td>
                                </tr>
                                <tr class="tr_bg2">
                                  <td colspan="7" align="center" valign="middle" class="black_text"><?=$pg_obj->pageingHTML?></td>
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
