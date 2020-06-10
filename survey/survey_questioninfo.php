<? include("user_chksession.php");
if(!$_SESSION['servey_info']['survey_takerinfo_id'])
{
	$obj->reDirect(FURL."start_survey.php");
}
$cur_pgno=1;
$pgNo=$_SESSION['servey_info']['survey_q_last_pg']+$cur_pgno;
if($_SESSION['servey_info']['pageNo']<($pgNo-1))
{
	$obj->reDirect(FURL."start_survey.php");
}
$slNost=(($cur_pgno-1)*$noLmt)+1;
$res=$obj->selectData(TABLE_QUESTION." as a,".TABLE_SURVEY_QUESTIONINFO." as b","","a.question_id=b.question_id and a.question_status='A' and b.survey_questioninfo_status='A' and b.survey_id='".$_SESSION['servey_info']['survey_id']."'","","b.question_order");
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
      <table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" valign="top" class="inner"><form name="form1" action="survey_questioninfo_submit.php" method="post">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="20" align="left" valign="top"><?=$obj->putContent(7);?></td>
                      </tr>
                      <tr>
                        <td height="20" align="right" valign="middle"></td>
                      </tr>
					  <tr>
                        <td align="left" valign="top" class="main_table_bg"><table width="100%" border="0" cellspacing="1" cellpadding="0" class="main_table_bg_1">
                            <tr>
                              <td align="left" valign="top" class="ins_text_inner2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td align="left" valign="top" class="border_btm"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <? $j=1;
	while($row=mysql_fetch_array($res)){
	  $slrow=$obj->selectData(TABLE_SURVEY_ANSWERINFO,"","survey_takerinfo_id='".$_SESSION['servey_info']['survey_takerinfo_id']."' and survey_answerinfo_qid='".$row['question_id']."'",1);
	  $sl_op_id=$slrow['survey_answerinfo_opid'];
	  $sl_op_txt=$slrow['survey_answerinfo_optxt'];
	  $survey_answerinfo_id=$slrow['survey_answerinfo_id'];
	?>
  <tr>
    <td align="left" valign="top" class="border_top_right_lft"><table width="100%" border="0" cellspacing="0" cellpadding="2">
	  <tr>
		<td width="2%">&nbsp;</td>
		<td width="5%" align="left" class="option_text">&nbsp;<?=$slNost?>.&nbsp;</td>
		<td align="left" class="option_text"><?=$row['question_title']?></td>
	  </tr>
	</table><input type="hidden" name="q_<?=$j?>" value="<?=$row['question_id']?>"/><input type="hidden" name="q_type_<?=$j?>" value="<?=$row['question_type']?>" id="q_type_<?=$j?>" /><? if($survey_answerinfo_id){?><input type="hidden" name="q_ed_<?=$j?>" id="q_ed_<?=$j?>" value="<?=$survey_answerinfo_id?>" /><? }?></td>
	<? if($row['question_type']==2){?>
	<td align="left" valign="top"  class="border_top_right2" style="padding:10px 0 10px 10px;"><textarea class="textarea" rows="2" cols="80" name="op_<?=$j?>" id="op_<?=$j?>"><?=$sl_op_txt?></textarea></td>
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
                        <td height="40" align="right" valign="middle" style="text-align:right"><input name="Prev" type="button" class="submit" id="Prev" value="&lt;&lt;Prev" onClick="gotopg('survey_question_<?=$_SESSION['servey_info']['survey_q_last_pg']?>.php')"/>&nbsp;&nbsp;<input name="Next" type="submit" class="submit" id="" value="Next >>" /></td>
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
