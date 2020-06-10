<? include("../includes/connection.php");
$pg_obj=new pagingRecords();
$no_head_link=1;
$mailSend=0;
if($_REQUEST['survey_client_id']){
$sql=$obj->selectData(TABLE_SURVEY_USER,"","survey_client_id='".$_REQUEST['survey_client_id']."'",2);
$pg_obj->setPagingParam("d",5,20,1,1);
$getarr=$_GET;
unset($getarr['msg']);
$res=$pg_obj->runQueryPaging($sql,$pageno,$getarr);
$qr_str=$pg_obj->makeLnkParam($getarr,0);
//echo $obj->getQuery();
}
?>
<html>
<head>
<title><?=CLIENT_SITE_NAME?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/client.css" rel="stylesheet" type="text/css">
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
                  <td height="25" align="left" valign="middle" class="td_heading">Email List:</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="border2">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="border2"><table width="100%"  border="0" cellpadding="2" cellspacing="1" >
                    <tr align="center" valign="middle">
                      <td width="50%" height="25" align="left" valign="middle" class="td_heading">Email</td>
                      <td width="12%" class="td_heading">Sent Link </td>
                      <td class="td_heading">Sent Date </td>
                      </tr>
					 <? while($row=mysql_fetch_array($res)){?>
                    <tr class="tr_bg">
                      <td height="20" align="left" valign="middle" class="black_text"><?=$row['survey_user_email']?></td>
                      <td align="center" valign="middle"><?=($row['survey_user_status']=='Y')?'Yes':'No'?></td>
                      <td align="center" valign="middle" class="black_text"><?=$row['survey_user_crdt']?></td>
                      </tr>
					 <? }?>
                    <tr class="tr_bg">
                      <td colspan="3" align="center" valign="middle"><?=$pg_obj->pageingHTML?></td>
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