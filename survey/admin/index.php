<? include("../includes/connection.php");
$no_head_link=1;
if($_POST['Submit'])
{
	$row=$obj->selectData(TABLE_ADMIN,"","admin_login='".trim($_POST['admin_login'])."' and admin_pass='".trim($_POST['admin_pass'])."'",1);
	if($row==0)
	{
		$msg=INVALID_LOGIN;
	}
	else
	{
		$redUrl=$_REQUEST['redirect'];
		$_SESSION['admin_login']=$row['admin_login'];
		$_SESSION['admin_email']=$row['admin_email'];
		if(empty($redUrl))
		$obj->reDirect("adminhome.php");
		else
		$obj->reDirect($redUrl);
	}
}
?>
<html>
<head>
<title><?=SITE_NAME?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript">
$(document).ready(function(){
  document.getElementById("admin_login").focus();
});
</script>
</head>
<body>
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="125" align="left" valign="top"><?php include("includes/header.php"); ?></td>
  </tr>
  <tr>
    <td align="center" valign="top" class="mainbodybg"><table width="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="60" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" valign="top"><table width="50%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" valign="top" class="border2"><form name="form1" method="post" action="">
                    <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                      <tr align="left" valign="top">
                        <td width="40%"><table width="98%" border="0" cellpadding="0" cellspacing="3">
                            <tr>
                              <td height="98" align="center" valign="top"><a href="index.php" target="_self"><img src="images/login_pic.gif" alt="" border="0"></a></td>
                            </tr>
                            <tr>
                              <td height="30" align="center" valign="top" class="blue_text">Welcome to the admin of<br>
<b><?=WEBSITE_NAME?></b></td>
                            </tr>
                        </table></td>
                        <td align="center" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="25" align="left" valign="middle" class="blue_text"><b>LOGIN :</b></td>
                            </tr>
                           <? if($msg){?> <tr>
                              <td height="18" align="left" valign="top" class="error" >Please input correct user name and password</td>
                            </tr>
							<? }?>
                            <tr>
                              <td align="left" valign="top"><table width="96%" border="0" cellpadding="0" cellspacing="3" class="innertable">
                                <tr>
                                  <td height="20" align="left" valign="middle" class="blue_text"><b>User name:</b></td>
                                </tr>
                                <tr>
                                  <td height="20" align="left" valign="top"><input name="admin_login" type="text" class="input" id="admin_login" size="25"></td>
                                </tr>
                                <tr>
                                  <td height="20" align="left" valign="middle" class="blue_text"><b>Password:</b></td>
                                </tr>
                                <tr>
                                  <td height="25" align="left" valign="top"><input name="admin_pass" type="password" class="input"  id="admin_pass" size="25"></td>
                                </tr>
                                <tr>
                                  <td height="30" align="left" valign="top"><input name="Submit" type="submit" id="Submit" class="submit" value="Login"></td>
                                </tr>
                                <tr>
                                  <td colspan="2" align="left" valign="top"><img src="images/spacer.gif" alt="" width="1" height="1"></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height="10" align="left" valign="top"></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table>
                  </form></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="30" align="left" valign="top"><?php include("includes/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
