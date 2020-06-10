<? include("admin_chksession.php");
if($_POST['Submit'])
{
	$arrSurvey=$_POST['survey_id'];
	$arrStC['client_id']=$_POST['client_id'];
	for($i=0;$i<count($arrSurvey);$i++)
	{
		$arrStC['survey_id']=$arrSurvey[$i];
		$ex=$obj->selectData(TABLE_SURVEY_CLIENT,"","client_id='".$arrStC['client_id']."' and survey_id='".$arrStC['survey_id']."'",1);
		if($ex==0)
		{
			$arrStC['survey_client_key']=$obj->generateKey();
			$arrStC['survey_client_crdt']=date("Y-m-d H:i:s");
			$obj->insertData(TABLE_SURVEY_CLIENT,$arrStC);
		}
		else
		{
			$id=$ex['survey_client_id'];
			$obj->qUpdate(TABLE_SURVEY_CLIENT,"survey_client_status='A'","survey_client_id='".$id."'");
		}
	}
	$_SESSION['curMsg']='Record Saved Successfully';
	$obj->reDirect("list_client_survey.php");
}
?>
<html>
<head>
<title><?=SITE_NAME?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript">
function setSurvey(id)
{
	if(id==0)
	{
		$("#place_survey").css("display", "none"); 
		$("#place_submit").css("display", "none");
	}
	else
	{
		$("#place_survey").css("display", "");
		$("#place_submit").css("display", "none");
		$("#place_survey_dd").attr("innerHTML","Loading...");
		var dataurl = 'ajax_script/get_survey_ms.php?id='+id;
		$.ajax({
			type: "GET",
			url: dataurl,
			success: function(html){
					$("#place_survey_dd").html(html);
					$("#place_survey").css("display", ""); 
					$("#place_submit").css("display", ""); 
			},
			error: function(){
			   alert("Error occured during Ajax request...");
			}
		});
	}
}
function setClient(id)
{
	if(id==0)
	{
		$("#place_client").css("display", "none"); 
		$("#place_survey").css("display", "none"); 
		$("#place_submit").css("display", "none");
	}
	else
	{
		$("#place_client").css("display", ""); 
		$("#place_client_dd").attr("innerHTML","Loading...");
		$("#place_survey").css("display", "none"); 
		$("#place_submit").css("display", "none");
		var dataurl = 'ajax_script/get_client_dd.php?id='+id;
			  $.ajax({
				type: "GET",
				url: dataurl,
				success: function(html){
					if(html=='0')
					{
						$("#place_survey").css("display", "none"); 
						$("#place_submit").css("display", "none"); 
						$("#place_client_dd").attr("innerHTML","<span class='error'>No client under this industry</span>");
					}
					else
					{
						$("#place_client_dd").html(html);
					}
				},
				error: function(){
				   alert("Error occured during Ajax request...");
				}
			});
	}
}
function checkBlank()
{
	if (!$("#survey_id option:selected").length)
	{
		alert('please select a survey')
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
                  <td height="25" align="left" valign="middle" class="td_heading">Assign Survey to Client  :</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="border2"><form name="form1" method="post" action="">
                      <table width="100%" border="0" cellspacing="1" cellpadding="2">
                        <tr class="tr_bg" style="display:none">
                          <td width="20%" height="30" align="left" valign="middle" class="black_text">Industry </td>
                          <td width="4%" align="center" valign="middle" class="black_text">:</td>
                          <td align="left" valign="middle"><select name="industry_id" class="input" onChange="setClient(this.value)">
						  	<option value="0">------Please Select------</option>
							<?=$obj->getIndustry();?>
                          </select></td>
                        </tr>
                        <tr class="tr_bg" id="place_client" style="display:none">
                          <td height="25" align="left" valign="top" class="black_text">Client</td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top" class="black_text" id="place_client_dd">Loading...</td>
                        </tr>
                        <tr class="tr_bg" id="place_survey" style="display:none">
                          <td height="25" align="left" valign="top" class="black_text">Survey</td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top" class="black_text" id="place_survey_dd"></td>
                        </tr>
                        <tr class="tr_bg" id="place_submit" style="display:none">
                          <td height="25" align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="middle"><input type="submit" name="Submit" value="Submit" class="submit" onClick="return checkBlank()"></td>
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
<script>setClient(1)</script>
</body>
</html>
