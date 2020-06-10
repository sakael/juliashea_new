<? include("admin_chksession.php");

$pg_obj=new pagingRecords();

if($_POST['Delete'])
{
	if(!empty($_POST['del_rec']))
	{
		$ids=implode(",",$_POST['del_rec']);
		$obj->qUpdate(TABLE_CLIENT,"client_status='D'","client_id in(".$ids.")");
		$_SESSION['curMsg']=DELETE;
	}
	else
	{
		$_SESSION['curMsg']=CHECKONE;
	}
}
$sql=$obj->selectData(TABLE_CLIENT." as a,".TABLE_INDUSTRY." as b","","a.industry_id=b.industry_id and client_status='A'",2);
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
                    <td height="25" align="left" valign="middle" class="td_heading">Client :</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="border2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="25" align="left" valign="top"><table width="100%"  border="0" cellspacing="2" cellpadding="0">
                              <tr>
                                <td width="87%" align="left" valign="middle" class="error"><? echo $_SESSION['curMsg']; session_unregister('curMsg')?></td>
                                <td width="10%" align="right" valign="middle"><img src="images/add.gif" width="24" height="24"></td>
                                <td align="center" valign="middle"><a href="manage_client.php" target="_self" class="blue_text"><b>Add</b></a></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"><form name="form1" method="post" action="">
                              <table width="100%"  border="0" cellpadding="2" cellspacing="1" >
                                <tr align="center" valign="middle">
                                  <td width="24%" height="25" align="left" valign="middle" class="td_heading">Client Username </td>
                                  <td width="28%" align="left" valign="middle" class="td_heading">Client Email </td>
                                  <!--<td width="34%" align="left" valign="middle" class="td_heading">Client Industry </td>-->
                                  <td width="6%" class="td_heading"> Edit</td>
                                  <td width="8%" class="td_heading">Delete</td>
                                </tr>
                                <? while($row=mysql_fetch_array($res)){?>
								<tr class="tr_bg">
                                  <td height="20" align="left" valign="middle" class="black_text"><?=$row['client_username']?></td>
                                  <td height="20" align="left" valign="middle" class="black_text"><?=$row['client_email']?></td>
                                  <!--<td height="20" align="left" valign="middle" class="black_text"><? //=$row['industry_title']?></td>-->
                                  <td align="center" valign="middle"><a href="manage_client.php?client_id=<?=$row['client_id']?>" target="_self" class="blue_link">Edit</a></td>
                                  <td align="center" valign="middle"><input type="checkbox" name="del_rec[]" value="<?=$row['client_id']?>"></td>
                                </tr>
								<? }?>
                                <tr class="tr_bg">
                                  <td height="20" colspan="5" align="left" valign="middle">&nbsp;</td>
                                </tr>
                                <tr class="tr_bg2">
                                  <td height="25" colspan="5" align="right" valign="middle" class="black_text" style="padding-right:8px;"><input name="Delete" type="submit" class="submit" value="Delete" onClick="return confirm('Are you sure?')">                                  </td>
                                </tr>
                                <tr class="tr_bg2">
                                  <td colspan="5" align="center" valign="middle" class="black_text"><?=$pg_obj->pageingHTML?></td>
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