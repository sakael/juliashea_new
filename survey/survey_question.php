<? include("user_chksession.php");
if(!$_SESSION['servey_info']['survey_takerinfo_id'])
{
	$obj->reDirect(FURL."start_survey.php");
}
$pg_obj=new pagingRecords();
$noLmt=10;
$cur_pgno=$_REQUEST['pageno'];
if($cur_pgno==0)
{
	$obj->reDirect(FURL."takeuser_info.php");
}
$pgNo=3+$cur_pgno;
if($_SESSION['servey_info']['pageNo']<($pgNo-1))
{
	$obj->reDirect(FURL."start_survey.php");
}
$slNost=(($cur_pgno-1)*$noLmt)+1;
$sql=$obj->selectData(TABLE_QUESTION." as a,".TABLE_SURVEY_QUESTION." as b","","a.question_id=b.question_id and a.question_status='A' and b.survey_question_status='A' and b.survey_id='".$_SESSION['servey_info']['survey_id']."'",2,"b.question_order");
$pg_obj->setPagingParam("d",5,$noLmt,1,1);
$getarr=$_GET;
$res=$pg_obj->runQueryPaging($sql,$cur_pgno,$getarr);
if($pg_obj->thispgtotrecord==-1 && $cur_pgno>0)
{
	$_SESSION['servey_info']['survey_q_last_pg']=$cur_pgno-1;
	$obj->reDirect(FURL."survey_questioninfo.php");
}
$resop=$obj->selectData(TABLE_OPTION,"","option_status='A'");
$k=0;
while($rowop=mysql_fetch_array($resop))
{
	$k++;
	$op_id[$k]=$rowop['option_id'];
	$op_title[$k]=$rowop['option_title'];
}
?>
<?php include("page_includes/header.php"); ?>
<script type="text/javascript" src="js/formValidation.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script language="javascript">
function chkblk()
{
	var frm=document.form1;
	var tot=$('#tot_q').val();
	for(i=1;i<=tot;i++)
	{
		var sel=0;
		if($('#q_type_'+i).val()==1)
		{
			for(j=1;j<=<?=$k?>;j++)
			{
				if($('#op_'+i+'_'+j).is(':checked'))
				{
					sel=1;
					break;
				}
			}
			if(sel==0)
			{
				alert('Please answer all questions to continue');
				return false;
			}
		}
		/*else
		{
			if(isWhitespace($('#op_'+i).val()))
			{
				alert("Please write a answer!");
				$('#op_'+i)[0].focus();
				return false;
			}
		}*/
	}
	return true;
}

</script>
      <table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" valign="top" class="inner"><form name="form1" action="survey_question_submit.php" method="post" onSubmit="return chkblk()">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="left" valign="top" class="main_table_bg"><table width="100%" border="0" cellspacing="1" cellpadding="0" class="main_table_bg_1">
                            <tr>
                              <td align="left" valign="top" class="ins_text_inner"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                
                                <tr>
                                  <td align="left" valign="top" class="border_btm"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="border_top_right_lft2" style="padding:10px 0 10px 10px;"><!--<h5><strong><? //=$_SESSION['servey_info']['survey_title']?></strong></h5>--></td>
	<td height="30" align="center" valign="bottom" class="border_top_rightBG" colspan="<?=$k?>"><table width="100%" border="0" cellspacing="2" cellpadding="0">
	  <? for($ot=1;$ot<=count($op_title);$ot++){?>
	  <? if($op_title[$ot]){?>
	  <tr>
		<td width="30" height="20" align="right" valign="top"  class="blue_boldtxt" >&nbsp;&nbsp;&nbsp;<?=$op_id[$ot]?></td>
		<td width="15" height="20" align="center" valign="top"  class="blue_boldtxt" >=</td>
		<td align="left" valign="top" class="blue_boldtxt"><b><?=$op_title[$ot]?></b></td>
	  </tr>
	  <? }?>
	  <? }?>
	</table>
	</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="border_top_right_lft2" style="padding:10px 0 10px 10px;"><!--<h5><strong><? //=$_SESSION['servey_info']['survey_title']?></strong></h5>--></td>
    <? for($ot=1;$ot<=count($op_title);$ot++){?>
	<td height="30" align="center" valign="middle" class="border_top_rightBGbold"><b><?=$op_id[$ot]?></b></td>
	<? }?>
  </tr>
  <? $j=1;
	while($row=mysql_fetch_array($res)){
	  $slrow=$obj->selectData(TABLE_SURVEY_ANSWER,"","survey_takerinfo_id='".$_SESSION['servey_info']['survey_takerinfo_id']."' and survey_answer_qid='".$row['question_id']."'",1);
	  $sl_op_id=$slrow['survey_answer_opid'];
	  $sl_op_txt=$slrow['survey_answer_optxt'];
	  $survey_answer_id=$slrow['survey_answer_id'];
	?>
  <tr>
    <td align="left" valign="top" class="border_top_right_lft"><table width="100%" border="0" cellspacing="0" cellpadding="2">
	  <tr>
		<td width="2%">&nbsp;</td>
		<td width="5%" align="left" class="option_text">&nbsp;<?=$slNost?>.&nbsp;</td>
		<td align="left" class="option_text"><?=$row['question_title']?></td>
	  </tr>
	</table><input type="hidden" name="q_<?=$j?>" value="<?=$row['question_id']?>"/><input type="hidden" name="q_type_<?=$j?>" value="<?=$row['question_type']?>" id="q_type_<?=$j?>" /><? if($survey_answer_id){?><input type="hidden" name="q_ed_<?=$j?>" id="q_ed_<?=$j?>" value="<?=$survey_answer_id?>" /><? }?></td>
	<? if($row['question_type']==1){?>
	<? for($op=1;$op<=$k;$op++){?>
	<td width="41" height="30" align="center" valign="middle" class="border_top_right"><input type="radio" name="op_<?=$j?>" value="<?=$op_id[$op]?>" id="op_<?=$j?>_<?=$op?>" <? if($sl_op_id==$op_id[$op]){ echo 'checked';}?>/></td>
	<? }?>
	<? }?>
	<? if($row['question_type']==2){?>
	<td colspan="<?=$k?>" align="center" valign="middle"  class="border_top_right2" style="padding:10px 0 10px 10px;"><textarea class="textarea" rows="8" cols="40" name="op_<?=$j?>" id="op_<?=$j?>"><?=$sl_op_txt?></textarea></td>
	<? }?>
    </tr>
  <? $slNost++;$j++;}?>
<input type="hidden" name="tot_q" value="<?=($j-1)?>" id="tot_q"/>
<input type="hidden" name="pgnocur" value="<?=$cur_pgno?>" id="pgnocur"/>
</table></td>
                                </tr>
                              </table></td>
                          </table></td>
                      </tr>
                      <tr>
                        <td height="40" align="right" valign="middle" style="text-align:right"><? if($cur_pgno!=1){?><input name="Prev" type="button" class="submit" id="Prev" value="&lt;&lt;Prev" onClick="gotopg('survey_question_<?=($cur_pgno-1)?>.php')"/>&nbsp;&nbsp;<? }?><input name="Next" type="submit" class="submit" id="" value="Next >>" /></td>
                      </tr>
                    </table>
                  </form></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
      </table>
      <?php include("page_includes/footer.php"); ?>
