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
<link href="css/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/iutil.js"></script>
<script type="text/javascript" src="../js/idrag.js"></script>
<script language="javascript">
function showUserInfo(id)
{
	$("#userinfo").Draggable();  
	$("#userinfo").css("display", "");
	$("#place_info").attr("innerHTML","<img src='images/graph-loader.gif' align='absmiddle'>&nbsp;Loading...");
	var dataurl = 'ajax_script/get_user_info.php?survey_user_id='+id;
			  $.ajax({
				type: "GET",
				url: dataurl,
				success: function(html){
						$("#place_info").html(html);
				},
				error: function(request,error){
				   $("#userinfo").css("display", "none");
				   alert("Error occured during Ajax request...Error Details:"+error);
				}
			});
}
function closeInfo()
{
	$("#userinfo").css("display", "none");
}
</script>
<style type="text/css">
<!--
#userinfo {
	position:absolute;
	left:30px;
	top:187px;
	width:400px;
	z-index:1;
}
-->
</style>
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
                  <td height="25" align="left" valign="middle" class="td_heading">User List send by client:</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="border2">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="border2"><table width="100%"  border="0" cellpadding="2" cellspacing="1" >
                    <tr align="center" valign="middle">
                      <td width="40%" height="25" align="left" valign="middle" class="td_heading">Email</td>
                      <!--<td width="10%" align="center" valign="middle" class="td_heading">Code</td>-->
                      <td width="10%" class="td_heading">Sent Link </td>
                      <td width="10%" class="td_heading">Attended</td>
                      <td width="15%" class="td_heading">Received Date </td>
                      <td class="td_heading">Completed Date</td>
                    </tr>
					 <? while($row=mysql_fetch_array($res)){?>
                    <tr class="tr_bg">
                      <td height="20" align="left" valign="middle" class="black_text"><?=$row['survey_user_email']?></td>
                      <!--<td height="20" align="center" valign="middle" class="black_text"><? //=$row['survey_user_code']?></td>-->
                      <td align="center" valign="middle"><?=($row['survey_user_status']=='Y')?'Yes':'No'?></td>
                      <td align="center" valign="middle"><?=$obj->attendStatus($row['survey_user_attend']);?></td>
                      <td align="center" valign="middle" class="black_text"><?=$row['survey_user_crdt']?></td>
                      <td align="center" valign="middle" class="black_text"><?=$row['survey_user_enddt']?></td>
                    </tr>
					 <? }?>
                    <tr class="tr_bg">
                      <td colspan="5" align="center" valign="middle"><?=$pg_obj->pageingHTML?></td>
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
<div id="userinfo" style="display:none">
  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25" align="left" valign="middle" class="td_heading"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_heading">About User:</td>
    <td align="right"><img src="images/cross_icon2.gif" alt="Close" width="16" height="18" onClick="closeInfo()" style="cursor:pointer">&nbsp;&nbsp;</td>
  </tr>
</table>
</td>
    </tr>
    <tr>
      <td align="left" valign="top" class="border2" id="place_info"></td>
    </tr>
    <tr>
      <td height="3" align="left" valign="top" class="td_bottom"><img src="images/spacer.gif" width="1" height="1"></td>
    </tr>
  </table>
</div>
</body>
</html>