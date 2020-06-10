<? include("admin_chksession.php");
$tot_op=7;
$default_open=3;
if($_POST['Submit'])
{
	if(!$_GET['question_id'])
	{
		$row=$obj->selectData(TABLE_QUESTION,"","survey_id='".$obj->data_prepare($_POST['survey_id'],0)."' and question_title='".$obj->data_prepare($_POST['question_title'],0)."' and question_status='A'",1);
		if($row==0)
		{
			$_POST['question_crdt']=date("Y-m-d H:i:s");
			$q_id=$obj->insertData(TABLE_QUESTION,$_POST);
			for($i=1;$i<=$_POST['tot_option'];$i++)
			{
				if($_POST['option_title'.$i]!='')
				{
					$opArr['option_title']=$_POST['option_title'.$i];
					$opArr['option_crdt']=date("Y-m-d H:i:s");
					$opArr['question_id']=$q_id;
					$op_id=$obj->insertData(TABLE_OPTION,$opArr);
				}
			}
			$_SESSION['curMsg']=INSERT;
			$obj->reDirect("list_question.php");
		}
		else 
		{
			$msg='This title already exist! Try another.';
		}
	}
	else
	{
		$row=$obj->selectData(TABLE_QUESTION,"","survey_id='".$obj->data_prepare($_POST['survey_id'],0)."' and question_id!='".$_REQUEST['question_id']."' and question_title='".$obj->data_prepare($_POST['question_title'],0)."' and question_status='A'",1);
		if($row==0)
		{
			$_POST['question_moddt']=date("Y-m-d H:i:s");
			if(!$_POST['question_skipped'])
			{
				$_POST['question_skipped']=0;
			}
			if(!$_POST['question_other'])
			{
				$_POST['question_other']=0;
			}
			$obj->updateData(TABLE_QUESTION,$_POST,"question_id='".$_REQUEST['question_id']."'");
			$q_id=$_REQUEST['question_id'];
			for($i=1;$i<=$_POST['tot_option'];$i++)
			{
				if($_POST['option_title'.$i]!='')
				{
					$opArr['option_title']=$_POST['option_title'.$i];
					$opArr['question_id']=$q_id;
					if($_POST['option_hid'.$i])
					{
						$opArr['option_moddt']=date("Y-m-d H:i:s");
						$obj->updateData(TABLE_OPTION,$opArr,"option_id='".$_POST['option_hid'.$j]."'");
					}
					else
					{
						$opArr['option_crdt']=date("Y-m-d H:i:s");
						$op_id=$obj->insertData(TABLE_OPTION,$opArr);
					}
				}
			}
			for($j=$i;$j<$tot_op;$j++)
			{
				$obj->qUpdate(TABLE_OPTION,"option_status='D'","option_id='".$_POST['option_hid'.$j]."'");
				//echo $obj->getQuery();
			}
			$_SESSION['curMsg']=UPDATE;
			$obj->reDirect("list_question.php");
		}
		else
		{
			$msg='This title already exist! Try another.';
		}
	}
}

$caption='Add';
if($_GET['question_id'])
{
	$row=$obj->selectData(TABLE_QUESTION,"","question_id='".$_GET['question_id']."'",1);
	$caption='Edit';
	$resop=$obj->selectData(TABLE_OPTION,"","question_id='".$_GET['question_id']."' and option_status='A'");
	$k=0;
	while($rowop=mysql_fetch_array($resop))
	{
		$k++;
		$op_id[$k]=$rowop['option_id'];
		$op_title[$k]=$rowop['option_title'];
	}
	$default_open=$k;
}
?>
<html>
<head>
<title><?=SITE_NAME?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/formValidation.js"></script>
<script language="javascript">
function chkBlank()
{
	var frm=document.form1;
	if(isWhitespace(frm.question_title.value))
	{
		alert("Please enter question!");
		frm.question_title.focus();
		return false;
	}
	return true;
}
function show_hide_option(id)
{
	for(y=1;y<=<?=$tot_op?>;y++)
	{
		$('#option_tr_'+y).hide();
	}
	for(y=1;y<=id;y++)
	{
		$('#option_tr_'+y).fadeIn("slow");
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
                  <td height="25" align="left" valign="middle" class="td_heading"><?=$caption?> Question and options:</td>
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
                          <td align="left" valign="top"><input name="question_title" type="text" class="input" id="question_title" value="<?=$row['question_title']?>" size="40"></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">Total Option </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><select name="tot_option" class="input" onChange="show_hide_option(this.value)">
                            <? for($i=1;$i<=$tot_op;$i++){?>
							<option value="<?=$i?>" <? if($default_open==$i){ echo 'selected';}?>><?=$i?></option>
							<? }?>
                          </select>                          </td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="middle"><? for($i=1;$i<=$tot_op;$i++){?><div id="option_tr_<?=$i?>" style="display:none; height:30px"><input name="option_title<?=$i?>" type="text" class="input" id="option_title<?=$i?>" size="40" value="<?=$op_title[$i]?>"><input name="option_hid<?=$i?>" type="hidden" value="<?=$op_id[$i]?>"></div><? }?></td>
                        </tr>
                        <!--<tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">Other Option</td>
                          <td align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="top"><input name="question_other" type="checkbox" id="question_other" value="1" <? //if($row['question_other']=='1'){echo 'checked';}?>></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">Skipped</td>
                          <td align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="middle"><input name="question_skipped" type="checkbox" id="question_skipped" value="1" <? //if($row['question_skipped']=='1'){echo 'checked';}?>></td>
                        </tr>-->
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="middle"><input type="submit" name="Submit" value="Save" class="submit"></td>
                        </tr>
                      </table>
                  </form></td>
                </tr>
				<script language="javascript">
				show_hide_option(<?=$default_open?>)
				</script>
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
