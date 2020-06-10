<? include("../../includes/connection.php");
$res_sur=$obj->selectData(TABLE_SURVEY_QUESTION." as a,".TABLE_SURVEY." as b","b.survey_id,b.survey_title","a.question_id='".$_REQUEST['qid']."' and a.survey_id=b.survey_id","","","b.survey_title,b.survey_id");
//echo $obj->getQuery();
if(mysql_num_rows($res_sur)){?>
<select name="survey_id" size="10" multiple="multiple" id="survey_id">
<? while($row_sur=mysql_fetch_array($res_sur)){?>
<option value="<?=$row_sur['survey_id']?>" selected="selected"><?=$row_sur['survey_title']?></option>
<? }?>
</select>
<? }else{ echo '0'; }?>