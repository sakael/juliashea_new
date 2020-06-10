<? include("admin_chksession.php");?>
<html>
<head>
<title><?=SITE_NAME?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/common.js"></script>
<script language="javascript">
function getAttenderQs(id)
{
	if(id==0)
	{
		$("#place_attender").css("display", "none"); 
		$("#place_submit").css("display", "none");
		$("#place_fltype").css("display", "none");
	}
	else
	{
		$("#place_attender").css("display", ""); 
		$("#place_attender_dd").attr("innerHTML","Loading...");
		$("#place_submit").css("display", "none");
		$("#place_fltype").css("display", "none");
		var dataurl = 'ajax_script/get_attender_dd.php?id='+id+'&needqs=1&nSel=1';
			  $.ajax({
				type: "GET",
				url: dataurl,
				success: function(html){
					if(html=='0')
					{
						$("#place_submit").css("display", "none");
						$("#place_fltype").css("display", "none");
						$("#place_attender_dd").attr("innerHTML","<span class='error'>No one has completed this survey</span>");
					}
					else
					{
						var newhtml=html.split("*****");
						$("#place_attender_dd").html(html);
						$("#place_submit").css("display", "");
						$("#place_fltype").css("display", "");
					}
				},
				error: function(){
				   alert("Error occured during Ajax request...");
				}
			});
	}

}
function getResult()
{
	var survey_id=$('#survey_id').val();
	var survey_user_id=$('#survey_user_id').val();
	var fltype=$('#fltype').val();
	var usr=$('#survey_user_id :selected').text();
	window.location.href='get_surveyuser_result.php?survey_id='+survey_id+'&survey_user_id='+survey_user_id+'&fltype='+fltype+'&usr='+usr;
}
function delSurveyUser()
{
	if(confirm('Are you sure to delete the survey result of this perticular user?'))
	{
		//alert($('#survey_user_id').val());
		window.location.href='del_survey_user_res.php?del_id='+$('#survey_user_id').val();
	}
	else
	{
		//alert('thanks');
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
                  <td height="25" align="left" valign="middle" class="td_heading">Survey Result User Wise:</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="border2"><form name="form1" method="post" action="">
                      <table width="100%" border="0" cellspacing="1" cellpadding="2">
                        <tr class="tr_bg">
                          <td width="20%" height="30" align="left" valign="middle" class="black_text">Survey Name  </td>
                          <td width="4%" align="center" valign="middle" class="black_text">:</td>
                          <td align="left" valign="middle"><select name="survey_id" id="survey_id" class="input" onChange="getAttenderQs(this.value)">
                            <option value="0">---Please Select---</option>
                            <?=$obj->getSurvey("","order by survey_title")?>
                          </select></td>
                        </tr>
                        <tr class="tr_bg" id="place_attender" style="display:none">
                          <td height="25" align="left" valign="top" class="black_text">Survey Attended By</td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top" id="place_attender_dd"></td>
                        </tr>
                        <tr class="tr_bg" id="place_fltype" style="display:none">
                          <td height="25" align="left" valign="top" class="black_text">Download Format</td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="middle"><select name="fltype" class="input" id="fltype">
                            <option value="txt">txt</option>
							<option value="pdf">pdf</option>
                            <option value="xls">xls</option>
                          </select></td>
                        </tr>
                        <tr class="tr_bg" id="place_submit" style="display:none">
                          <td height="25" align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="middle"><input name="getres" type="button" class="submit" id="getres" value="Get Result" onClick="getResult()"></td>
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