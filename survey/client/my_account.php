<? include("client_chksession.php");
$row=$obj->selectData(TABLE_CLIENT." as a,".TABLE_INDUSTRY." as b","","a.industry_id=b.industry_id and client_id='".$cur_client_id."'",1);
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
              <td width="220" align="left" valign="top" class="inner_left"><?php include("includes/left.php"); ?></td>
              <td align="left" valign="top" class="inner"><table width="100%"  border="0" cellpadding="0" cellspacing="2">
                <tr>
                  <td height="25" align="left" valign="middle" class="td_heading">My Account:</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="border2"><form action="" method="post" enctype="multipart/form-data" name="form1" onSubmit="return chkBlank()">
                      <table width="100%" border="0" cellspacing="1" cellpadding="2">
                        <? if($msg){?>
						<tr class="tr_bg">
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top">&nbsp;</td>
                          <td height="20" align="left" valign="middle" class="error"><?=$msg?></td>
                        </tr><? }?>
                        <tr class="tr_bg">
                          <td width="20%" height="25" align="left" valign="top" class="black_text">Username  </td>
                          <td width="4%" align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><?=$row['client_username']?></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">Password </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><?=$row['client_password']?></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">Email </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><?=$row['client_email']?></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text"> Company </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><?=$row['client_company']?></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text"> Industry </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><?=$row['industry_title']?></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text"> Logo </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="middle"><? if($row['client_logo']){ $cl_logo='../'.CLIENT_LOGO.$row['client_logo']; if(is_file($cl_logo)){?><img src="../thumb/phpThumb.php?&src=<?=$cl_logo?>&hp=100&wl=100" alt="Client Logo" title="Client Logo"><? }}?></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text"> Banner </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="middle"><? if($row['client_banner']){ $cl_ban='../'.CLIENT_BANNER.$row['client_banner']; if(is_file($cl_ban)){?><img src="../thumb/phpThumb.php?&src=<?=$cl_ban?>&hp=100&wl=100" alt="Client Banner" title="Client Banner"><? }}?></td>
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