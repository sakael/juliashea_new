<? include("admin_chksession.php");

if($_POST['Submit'])
{
	$sql=$obj->selectData(TABLE_ADMIN,"","admin_pass='".trim($_POST['admin_passo'])."'",1);
	if($sql==0) $msg='Please enter correct current password!';
	
	else
	{
		$obj->updateData(TABLE_ADMIN,array("admin_pass"=>trim($_POST['admin_pass'])),"admin_id='1'");
		$msg='Password changed successfully!';
	}
}
?>
<html>
<head>
<title><?=SITE_NAME?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/formValidation.js"></script>
<script language="javascript">
function chkBlank()
{
	if(isWhitespace(document.form1.admin_passo.value)==true)
	{
		alert("Please enter old password!");
		document.form1.admin_passo.focus();
		return false;
	}	
	if(isWhitespace(document.form1.admin_pass.value)==true)
	{
		alert("Please enter new password!");
		document.form1.admin_pass.focus();
		return false;
	}
	if(isWhitespace(document.form1.admin_passc.value)==true)
	{
		alert("Please re-enter new password!");
		document.form1.admin_passc.focus();
		return false;
	}
	if(document.form1.admin_pass.value!=document.form1.admin_passc.value)
	{
		alert("Password field mismatch!");
		document.form1.admin_passc.focus();
		return false;
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
              <td width="220" align="left" valign="top" class="inner_left"><?php include("includes/left.php"); ?></td>
              <td align="left" valign="top" class="inner"><table width="100%"  border="0" cellpadding="0" cellspacing="2">
                <tr>
                  <td height="25" align="left" valign="middle" class="td_heading">Change your admin password  :</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="border2"><form name="form1" method="post" action="" onSubmit="return chkBlank();">
                      <table width="100%" border="0" cellspacing="1" cellpadding="2">
                        <? if($msg){?>
						<tr class="tr_bg">
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top">&nbsp;</td>
                          <td height="20" align="left" valign="middle" class="error"><?=$msg?></td>
                        </tr>
						<? }?>
                        <tr class="tr_bg">
                          <td width="20%" height="30" align="left" valign="middle" class="black_text">Enter old password </td>
                          <td width="4%" align="center" valign="middle" class="black_text">:</td>
                          <td align="left" valign="middle"><input name="admin_passo" type="password" class="input" id="admin_passo" size="30">                          </td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">Enter new password </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><input name="admin_pass" type="password" class="input" id="admin_pass" size="30"></td>
                        </tr>
						<tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">Re-enter new password</td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><input name="admin_passc" type="password" class="input" id="admin_passc" size="30"></td>
                        </tr>

                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="middle"><input type="submit" name="Submit" value="Submit" class="submit"></td>
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
