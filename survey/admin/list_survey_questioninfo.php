<? include("admin_chksession.php");
$pg_obj=new pagingRecords();
if($_REQUEST['survey_id'])
{
	$cond=" and b.survey_id='".$_REQUEST['survey_id']."'";
}
if($_POST['Delete'])
{
	if(!empty($_POST['del_rec']))
	{
		$ids=implode(",",$_POST['del_rec']);
		$obj->qUpdate(TABLE_SURVEY_QUESTIONINFO,"survey_questioninfo_status='D'","survey_questioninfo_id in(".$ids.")");
		$_SESSION['curMsg']=DELETE;
	}
	else
	{
		$_SESSION['curMsg']=CHECKONE;
	}
}
$sql=$obj->selectData(TABLE_QUESTION." as a,".TABLE_SURVEY." as b,".TABLE_SURVEY_QUESTIONINFO." as c","a.question_title,a.question_type,b.survey_title,c.*","question_status='A' and survey_status='A' and a.question_id=c.question_id and b.survey_id=c.survey_id and survey_questioninfo_status='A' and question_type=2".$cond,2,"survey_id,c.question_order");
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
<script type="text/javascript" src="../js/jquery.js"></script>
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
                    <td height="25" align="left" valign="middle" class="td_heading">Question to Survey Info:</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="border2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="25" align="left" valign="top"><table width="100%"  border="0" cellspacing="2" cellpadding="0">
                              <tr>
                                <td width="70%" align="left" valign="middle"><? echo $_SESSION['curMsg']; session_unregister('curMsg')?></td>
                                <td width="10%" align="right" valign="middle"><img src="images/add.gif" width="24" height="24"></td>
                                <td align="center" valign="middle"><a href="manage_survey_questioninfo.php" target="_self" class="blue_text"><b>Assign Question </b></a></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"><form name="form1" method="post" action="">
                              <table width="100%"  border="0" cellpadding="2" cellspacing="1" >
                                <tr align="center" valign="middle">
                                  <td width="30%" height="25" align="left" valign="middle" class="td_heading">Survey</td>
                                  <td width="30%" align="left" valign="middle" class="td_heading">Question</td>
                                  <td width="30%" align="center" valign="middle" class="td_heading">Type</td>
                                  <!--<td width="10%" class="td_heading"> Edit</td>-->
                                  <td class="td_heading">Delete</td>
                                </tr>
                                <? while($row=mysql_fetch_array($res)){?>
								<tr class="tr_bg">
                                  <td height="20" align="left" valign="middle" class="black_text"><?=$row['survey_title']?></td>
                                  <td height="20" align="left" valign="middle" class="black_text"><?=$row['question_title']?></td>
                                  <td height="20" align="center" valign="middle" class="black_text"><?=$obj->getQuesType($row['question_type'])?></td>
                                  <!--<td align="center" valign="middle"><a href="manage_question.php?question_id=<?=$row['question_id']?>&<?=$qr_str?>" target="_self" class="blue_link">Edit</a></td>-->
                                  <td align="center" valign="middle"><input type="checkbox" name="del_rec[]" value="<?=$row['survey_questioninfo_id']?>"></td>
                                </tr>
								<? }?>
                                <tr class="tr_bg">
                                  <td height="20" colspan="6" align="left" valign="middle">&nbsp;</td>
                                </tr>
                                <tr class="tr_bg2">
                                  <td height="25" colspan="6" align="right" valign="middle" class="black_text" style="padding-right:8px;"><input name="Delete" type="submit" class="submit" value="Delete" onClick="return confirm('Are you sure?')">                                  </td>
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
