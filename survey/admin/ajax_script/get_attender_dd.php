<? include("../../includes/connection.php");
$notqs=(int)$_REQUEST['needqs'];
if(!$_REQUEST['nSel'])
{
	$msel=1;
}
$res_uid=$obj->selectData(TABLE_SURVEY_USER." as a,".TABLE_SURVEY_TAKERINFO." as b","a.survey_user_email,b.survey_takerinfo_id,a.survey_client_id","b.survey_id='".$_REQUEST['id']."' and a.survey_user_attend='Y' and a.survey_user_id=b.survey_user_id","","a.survey_user_email");
//echo $obj->getQuery();
if(mysql_num_rows($res_uid)>0)
{
?>
<select name="survey_user_id" <? if($msel==1){?>size="10" multiple="multiple"<? }else{?> class="input" <? }?> id="survey_user_id">
<?
while($row_uid=mysql_fetch_array($res_uid)){
$row_client=$obj->selectData(TABLE_SURVEY_CLIENT." as a1,".TABLE_CLIENT." as b1","client_username","a1.client_id=b1.client_id and survey_client_id='".$row_uid['survey_client_id']."'",1,"");
?>
<option value="<?=$row_uid['survey_takerinfo_id']?>" <? if($msel==1){?>selected="selected"<? }?>><?=$row_uid['survey_user_email']."[".$row_client['client_username']."]"?></option>
<? }?>
</select><? if($notqs==1){?>&nbsp;&nbsp;<a href="javascript://" onclick="delSurveyUser()" title="Delete Survey Details"><img src="images/cross_icon2.gif" border="0" align="absmiddle" alt="Delete Survey Details"/></a><? }?><? if($notqs==0){?>*****
<? $res_qs=$obj->selectData(TABLE_QUESTION." as a,".TABLE_SURVEY." as b,".TABLE_SURVEY_QUESTION." as c","a.question_title,a.question_id","question_status='A' and survey_status='A' and a.question_id=c.question_id and b.survey_id=c.survey_id and survey_question_status='A' and b.survey_id='".$_REQUEST['id']."' and a.question_type=1","","c.question_order");
//echo $obj->getQuery();
?>
<select name="question_id" size="10" multiple id="question_id">
<? $qno=1;
while($row_qs=mysql_fetch_array($res_qs)){?>
<option value="<?=$row_qs['question_id']?>" selected="selected"><?="[".$qno."]".$row_qs['question_title']?></option>
<? 
$arrQ[$row_qs['question_id']]=$qno;
$qno++;}?>
</select>
<input type="hidden" name="qhid" id="qhid" value="<?=serialize($arrQ)?>" />
<? }}else{ echo '0'; }?>
