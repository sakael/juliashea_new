<? include("../includes/connection.php");
if($_POST['Submit'])
{
	$tot_num=$_POST['tot_rec'];
	$survey_id=$_REQUEST['survey_id'];
	for($tm=1;$tm<=$tot_num;$tm++)
	{
		$seq=$_POST['change_seq_'.$tm];
		$q_id=$_POST['q_id_'.$tm];
		$obj->qUpdate(TABLE_SURVEY_QUESTION,"question_order='".$seq."'","question_id='".$q_id."' and survey_id='".$survey_id."'");
	}
}
$res=$obj->selectData(TABLE_QUESTION." as a,".TABLE_SURVEY_QUESTION." as b","a.question_title,a.question_type,b.*","question_status='A' and survey_question_status='A' and a.question_id=b.question_id  and b.survey_id='".$_REQUEST['survey_id']."'","","survey_id,question_order");
$numrows=mysql_num_rows($res);
$no_head_link=1;
$survey_title=$obj->getSurveyTitle($_REQUEST['survey_id']);
?>
<html>
<head>
<title><?=SITE_NAME?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript">
<? if($_POST['Submit'])
{?>
if(confirm('close this window?'))
{
	self.close();
}
<? }?>
$(document).ready(function(){
	$("#sur_tit").attr('innerHTML', $('#survey_title').val());
});
function chk_seq()
{
	for(x=1;x<=<?=$numrows?>;x++)
	{
		for(y=x+1;y<=<?=$numrows?>;y++)
		{
			if($('#change_seq_'+x).val()==$('#change_seq_'+y).val())
			{
				alert("Can not set same order in more than one question");
				return false;
			}
		}
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
              <td align="left" valign="top" class="inner"><table width="100%"  border="0" cellpadding="0" cellspacing="2">
                <tr>
                  <td height="25" align="left" valign="middle" class="td_heading">Set Question Order :</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="border2"><form name="form1" method="post" action="">
                      <table width="100%" border="0" cellspacing="1" cellpadding="2">
					  <? if($numrows>0){?>
                        <tr class="tr_bg">
                          <td height="30" align="left" valign="middle" class="blacktxt_bold">Survey:</td>
                          </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text" id="sur_tit">&nbsp;</td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="blacktxt_bold">Questions:</td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <? $k=1; while($row=mysql_fetch_array($res)){
							if($k==1)
							{
							?>
							<input name="survey_title" type="hidden" value="<?=$survey_title?>" id="survey_title">
							<?
							}
							?>
							<tr>
                              <td width="8%" height="25" align="left" valign="top">&nbsp;</td>
                              <td width="40%" align="left" valign="top"><?=$row['question_title']?></td>
                              <td width="20%" align="left" valign="top"><?=$obj->getQuesType($row['question_type'])?></td>
                              <td align="left" valign="top"><? if($numrows==1){?> <span class="errortext">Can not change sequence</span><? }else{?>
                        <select name="change_seq_<?=$k?>" class="input" id="change_seq_<?=$k?>">
						<? for($j=1;$j<=$numrows;$j++){?>
                          <option value="<?=$j?>" <? if($j==$k){ echo 'selected';}?>><?=$j?></option>
						<? }?>
                        </select>
                        <input name="q_id_<?=$k?>" type="hidden" id="q_id_<?=$k?>" value="<?=$row['question_id']?>">
                        <? }?><? $k++;?></td>
                            </tr><? }?>
                          </table></td>
                          </tr>
                        <tr class="tr_bg">
                          <td height="25" align="center" valign="top" class="black_text"><input name="tot_rec" type="hidden" id="tot_rec" value="<?=$numrows?>"><input name="Submit" type="submit" class="submit" value="Save" onClick="return chk_seq()"></td>
                        </tr>
						<? }else{?>
                        <tr class="tr_bg">
                          <td height="25" align="center" valign="top" class="error">No Question in this Survey!!!</td>
                        </tr>
						<? }?>
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
