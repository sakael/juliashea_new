<? include("admin_chksession.php");
$msg=$_REQUEST['msg'];
if($_POST['Submit'])
{
	if(!$_GET['client_id'])
	{
		$row=$obj->selectData(TABLE_CLIENT,"","(client_username='".$obj->data_prepare($_POST['client_username'],0)."' or client_email='".$obj->data_prepare($_POST['client_email'],0)."') and client_status='A'",1);
		if($row==0)
		{
			$_POST['client_crdt']=date("Y-m-d H:i:s");
		}
	}
	else
	{
		$row=$obj->selectData(TABLE_CLIENT,"","client_id!='".$_REQUEST['client_id']."' and (client_username='".$obj->data_prepare($_POST['client_username'],0)."' or client_email='".$obj->data_prepare($_POST['client_email'],0)."') and client_status='A'",1);
		if($row==0)
		{
			$_POST['client_moddt']=date("Y-m-d H:i:s");
		}
	}
	if($row==0)
	{
		$uploadError='';
		if($_FILES['client_logo']['name'])
		{
			list($fileName,$error) = $obj->uploadFiles('client_logo','../'.CLIENT_LOGO,'jpg,jpeg,gif');
			if($error)
			{
				$uploadError.=$error;
			}
			else
			{
				$_POST['client_logo']=$fileName;
			}
		}
		if($_FILES['client_banner']['name'])
		{
			list($fileName,$error) = $obj->uploadFiles('client_banner','../'.CLIENT_BANNER,'jpg,jpeg,gif');
			if($error)
			{
				$uploadError.=$error;
			}
			else
			{
				$_POST['client_banner']=$fileName;
			}
		}
		if(!$_GET['client_id'])
		{
			$obj->insertData(TABLE_CLIENT,$_POST);
			$_SESSION['curMsg']=INSERT." ".$uploadError;
		}
		else
		{
			$obj->updateData(TABLE_CLIENT,$_POST,"client_id='".$_REQUEST['client_id']."'");
			$_SESSION['curMsg']=UPDATE." ".$uploadError;
		}
		$obj->reDirect("list_client.php");
	}
	else
	{
		$msg='This username or email already exist! Try another.';
	}
}

$caption='Add';
if($_GET['client_id'])
{
	$row=$obj->selectData(TABLE_CLIENT." as a,".TABLE_INDUSTRY." as b","","a.industry_id=b.industry_id and client_id='".$_GET['client_id']."'",1);
	$caption='Edit';
	$del=0;
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
	var frm=document.form1;
	if(isWhitespace(frm.client_username.value))
	{
		alert("Please enter client title!");
		frm.client_username.focus();
		return false;
	}
	if(isWhitespace(frm.client_password.value))
	{
		alert("Please enter client password!");
		frm.client_password.focus();
		return false;
	}
	if(isWhitespace(frm.client_email.value))
	{
		alert("Please enter client email!");
		frm.client_email.focus();
		return false;
	}
	else
	{
		if(!validateEmail(frm.client_email.value))
		{
			alert("Please enter email in proper format");
			frm.client_email.focus();
			return false;
		}
	}
	/*if(isWhitespace(frm.client_company.value))
	{
		alert("Please enter client company!");
		frm.client_company.focus();
		return false;
	}*/
	return true;
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
                  <td height="25" align="left" valign="middle" class="td_heading"><?=$caption?> Client :</td>
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
                          <td width="20%" height="25" align="left" valign="top" class="black_text">Client Username  </td>
                          <td width="4%" align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><input name="client_username" type="text" class="input" id="client_username" value="<?=$row['client_username']?>" size="40"></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">Client Password </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><input name="client_password" type="text" class="input" id="client_password" value="<?=$row['client_password']?>" size="40"></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">Client Email </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><input name="client_email" type="text" class="input" id="client_email" value="<?=$row['client_email']?>" size="40"></td>
                        </tr>
                        <!--<tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">Client Company </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><input name="client_company" type="text" class="input" id="client_company" value="<?=$row['client_company']?>" size="40"></td>
                        </tr>-->
                        <tr class="tr_bg" style="display:none">
                          <td height="25" align="left" valign="top" class="black_text">Client Industry </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><select name="industry_id" class="input">
						  	<?=$obj->getIndustry($row['industry_id'])?>
                          </select></td>
                        </tr>
                        <!--<tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">Client Logo </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="middle"><input name="client_logo" type="file" class="input" id="client_logo"><? //if($row['client_logo']){ $cl_logo='../'.CLIENT_LOGO.$row['client_logo']; if(is_file($cl_logo)){?><br><img src="../thumb/phpThumb.php?&src=<? //=$cl_logo?>&hp=100&wl=100" alt="Client Logo" title="Client Logo">&nbsp;&nbsp;<a href="del_logo_banner.php?client_id=<? //=$_GET['client_id']?>&type=l" class="blue_link">Delete</a><? //}}?></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">Client Banner </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="middle"><input name="client_banner" type="file" class="input" id="client_banner"><? //if($row['client_banner']){ $cl_ban='../'.CLIENT_BANNER.$row['client_banner']; if(is_file($cl_ban)){?><br><img src="../thumb/phpThumb.php?&src=<? //=$cl_ban?>&hp=100&wl=100" alt="Client Banner" title="Client Banner">&nbsp;&nbsp;<a href="del_logo_banner.php?client_id=<? //=$_GET['client_id']?>&type=b" class="blue_link">Delete</a><? //}}?></td>
                        </tr>-->
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="middle"><input type="submit" name="Submit" value="Save" class="submit"></td>
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