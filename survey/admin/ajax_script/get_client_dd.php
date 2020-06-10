<? include("../../includes/connection.php");
$ret_html=$obj->clientList(""," and industry_id='".$_REQUEST['id']."'");
if($ret_html!='0'){?>
<select name="client_id" id="client_id" class="input" onchange="setSurvey(this.value)">
<option value="0">---Please Select---</option>
<?=$ret_html?>
</select>
<? }else{ echo '0'; }?>