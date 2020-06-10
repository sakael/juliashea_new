<? include("admin_chksession.php");
if($_POST['Submit'])
{
	$survey_id=$_POST['survey_id'];
	$question_id=$_POST['question_id'];
	//print_r($question_id);
	for($i=0;$i<count($question_id);$i++)
	{
		$arr['survey_id']=$survey_id;
		$arr['question_id']=$question_id[$i];
		$row=$obj->selectData(TABLE_SURVEY_QUESTIONINFO,"","survey_id='".$arr['survey_id']."' and question_id='".$arr['question_id']."'",1);
		if($row==0)
		{
			$arr['survey_questioninfo_crdt']=date("Y-m-d H:i:s");
			$arr['question_order']=$obj->getQuesOrderInfo($arr['survey_id']);
			$q_id=$obj->insertData(TABLE_SURVEY_QUESTIONINFO,$arr);
		}
	}
	$obj->reDirect("list_survey_questioninfo.php?survey_id=".$survey_id);
}
$caption='Assign';
?>
<html>
<head>
<title><?=SITE_NAME?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/formValidation.js"></script>
<script language="javascript">
function checkBlank()
{
	if (!$("#question_id option:selected").length)
	{
		alert('please select atleast one question')
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
                  <td height="25" align="left" valign="middle" class="td_heading"><?=$caption?> Question to Survey Info:</td>
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
                          <td height="30" align="left" valign="top" class="black_text">Select Survey </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><select name="survey_id" class="input">
						  <?=$obj->getSurvey($row['survey_id'])?>
                          </select></td>
                        </tr>
                        <tr class="tr_bg">
                          <td width="20%" height="30" align="left" valign="top" class="black_text">Question </td>
                          <td width="4%" align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><select name="question_id[]" size="10" multiple id="question_id">
                            <?=$obj->questionList(""," and question_type='2' order by question_type")?>
                          </select></td>
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
