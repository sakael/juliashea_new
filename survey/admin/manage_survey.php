<? include("admin_chksession.php");
if($_POST['Submit'])
{
	if(!$_GET['survey_id'])
	{
		$row=$obj->selectData(TABLE_SURVEY,"","surveytype_id='".$obj->data_prepare($_POST['surveytype_id'],0)."' and survey_title='".$obj->data_prepare($_POST['survey_title'],0)."' and survey_status='A'",1);
		if($row==0)
		{
			$_POST['survey_crdt']=date("Y-m-d H:i:s");
			$obj->insertData(TABLE_SURVEY,$_POST);
			$_SESSION['curMsg']=INSERT;
			$obj->reDirect("list_survey.php");
		}
		else 
		{
			$msg='This title already exist! Try another.';
		}
	}
	else
	{
		$row=$obj->selectData(TABLE_SURVEY,"","surveytype_id='".$obj->data_prepare($_POST['surveytype_id'],0)."' and survey_id!='".$_REQUEST['survey_id']."' and survey_title='".$obj->data_prepare($_POST['survey_title'],0)."' and survey_status='A'",1);
		if($row==0)
		{
			$_POST['survey_moddt']=date("Y-m-d H:i:s");
			$obj->updateData(TABLE_SURVEY,$_POST,"survey_id='".$_REQUEST['survey_id']."'");
			$_SESSION['curMsg']=UPDATE;
			$obj->reDirect("list_survey.php");
		}
		else
		{
			$msg='This title already exist! Try another.';
		}
	}
}

$caption='Add';
if($_GET['survey_id'])
{
	$row=$obj->selectData(TABLE_SURVEY,"","survey_id='".$_GET['survey_id']."'",1);
	$caption='Edit';
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
	if(isWhitespace(frm.survey_title.value))
	{
		alert("Please enter survey title!");
		frm.survey_title.focus();
		return false;
	}
	else
	{
		if(!validateSpChar(frm.survey_title.value))
		{
			alert("Please do not use special characters in survey title!");
			frm.survey_title.focus();
			return false;
		}
	}
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
                  <td height="25" align="left" valign="middle" class="td_heading"><?=$caption?> Survey :</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="border2"><form name="form1" method="post" action="" onSubmit="return chkBlank()">
                      <table width="100%" border="0" cellspacing="1" cellpadding="2">
                        <? if($msg){?>
						<tr class="tr_bg">
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top">&nbsp;</td>
                          <td height="20" align="left" valign="middle" class="error"><?=$msg?></td>
                        </tr><? }?>
                        <tr class="tr_bg">
                          <td height="30" align="left" valign="top" class="black_text">Select Survey Type </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><select name="surveytype_id" class="input">
						  <?=$obj->getSurveyType($row['surveytype_id'])?>
                          </select>
                          </td>
                        </tr>
                        <tr class="tr_bg">
                          <td width="20%" height="30" align="left" valign="top" class="black_text">Survey Title </td>
                          <td width="4%" align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><input name="survey_title" type="text" class="input" id="survey_title" value="<?=$row['survey_title']?>" size="40"></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">Survey Description </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><textarea name="survey_descr" cols="40" rows="5" class="textarea" id="survey_descr"><?=$row['survey_descr']?></textarea></td>
                        </tr>
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
