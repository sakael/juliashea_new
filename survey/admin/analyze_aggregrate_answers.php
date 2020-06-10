<? include("admin_chksession.php");?>
<html>
<head>
<title><?=SITE_NAME?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/common.js"></script>
<script language="javascript">
function getSurvey(qid)
{
	if(qid==0)
	{
		$("#place_survey").css("display", "none");
		$("#place_ddtype").css("display", "none");
		$("#place_submit").css("display", "none");
	}
	else
	{
		$("#place_survey").css("display", "");
		$("#place_survey_dd").attr("innerHTML","Loading...");
		$("#place_submit").css("display", "none");
		var dataurl = 'ajax_script/get_survey_dd.php?qid='+qid;
			  $.ajax({
				type: "GET",
				url: dataurl,
				success: function(html){
					if(html=='0')
					{
						$("#place_submit").css("display", "none");
						$("#place_survey_dd").attr("innerHTML","<span class='error'>This question is not assign yet in any survey</span>");
						$("#place_ddtype").css("display", "none");
					}
					else
					{
						$("#place_survey_dd").html(html);
						$("#place_submit").css("display", "");
						$("#place_ddtype").css("display", "");
					}
				},
				error: function(request,error) {
				   alert("Error occured during Ajax request...Error Details:"+error);
				}
			});
	}
}
function getAggAns()
{
	var question_id=$('#question_id').val();
	var ddtype=$('#ddtype').val();
	var sid=outputSelected(form1.survey_id.options,0);
	window.location.href='get_aggregrate_answers.php?question_id='+question_id+'&ddtype='+ddtype+'&sid='+sid;
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
                  <td height="25" align="left" valign="middle" class="td_heading">Analyze Answer Aggregate :</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="border2"><form name="form1" method="post" action="" id="form1">
                      <table width="100%" border="0" cellspacing="1" cellpadding="2">
                        <tr class="tr_bg">
                          <td width="20%" height="30" align="left" valign="top" class="black_text">Question  </td>
                          <td width="4%" align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><select name="question_id" class="input" id="question_id" onChange="getSurvey(this.value)">
							<option value="0">--Please Select--</option>
							<?=$obj->questionList("","and question_type=1",0)?>
                          </select></td>
                        </tr>
                        <tr class="tr_bg" id="place_survey" style="display:none">
                          <td height="25" align="left" valign="top" class="black_text">Survey</td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top" id="place_survey_dd"></td>
                        </tr>
                        <tr class="tr_bg" id="place_ddtype" style="display:none">
                          <td height="25" align="left" valign="top" class="black_text">Result On </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="middle"><select name="ddtype" class="input" id="ddtype">
						  	<option value="ge">Gender</option>
                            <option value="po">Position</option>
							<option value="de">Department</option>
                            <option value="tc">Time with Company</option>
                            <option value="tp">Time in Present Position</option>
							<option value="ed">Education</option>
							<option value="ag">Age</option>
                          </select></td>
                        </tr>
                        <tr class="tr_bg" id="place_submit" style="display:none">
                          <td height="25" align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="middle"><input name="gres" type="button" class="submit" id="gres" value="Get Result" onClick="getAggAns()"></td>
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