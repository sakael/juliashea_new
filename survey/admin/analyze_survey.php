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
		$("#place_question").css("display", "none"); 
		$("#place_submit").css("display", "none");
		$("#place_grtype").css("display", "none");
		$("#place_graph").css("display", "none");
	}
	else
	{
		$("#place_attender").css("display", ""); 
		$("#place_question").css("display", ""); 
		$("#place_attender_dd").attr("innerHTML","Loading...");
		$("#place_question_dd").attr("innerHTML","Loading...");
		$("#place_submit").css("display", "none");
		$("#place_grtype").css("display", "none");
		$("#place_graph").css("display", "none");
		var dataurl = 'ajax_script/get_attender_dd.php?id='+id;
			  $.ajax({
				type: "GET",
				url: dataurl,
				success: function(html){
					if(html=='0')
					{
						$("#place_submit").css("display", "none");
						$("#place_grtype").css("display", "none");
						$("#place_question").css("display", "none");
						$("#place_attender_dd").attr("innerHTML","<span class='error'>No one has completed this survey</span>");
					}
					else
					{
						var newhtml=html.split("*****");
						$("#place_attender_dd").html(newhtml[0]);
						$("#place_question_dd").html(newhtml[1]);
						$("#place_submit").css("display", "");
						$("#place_grtype").css("display", "");
					}
				},
				error: function(){
				   alert("Error occured during Ajax request...");
				}
			});
	}

}
function drawGraph()
{
	var usr=outputSelected(form1.survey_user_id.options,0);
	var qs=outputSelected(form1.question_id.options,0);
	if($("#grtype").val()==1)
	{
		var totSel=getSelected(form1.survey_user_id.options,1);
		if (totSel>1)
		{
			$("#place_graph").css("display", "none");
			alert('Please select one "Survey Attended By" for pie chart');
			return false;
		}
	}
	var qrystr='?grtype='+$("#grtype").val()+'&survey_id='+$("#survey_id").val()+'&survey_user_id='+usr+'&question_id='+qs+'&arrdata='+$("#qhid").val();
	var dataurl = 'ajax_script/get_survey_graph.php'+qrystr;
	$("#place_graph").css("display", "");
	$("#place_graph_img").attr("innerHTML","<img src='images/graph-loader.gif' align='absmiddle'>&nbsp;Generating Graph.Please wait....");
			  //alert(dataurl);
			  $.ajax({
				type: "GET",
				url: dataurl,
				success: function(html){
						$("#place_graph_img").html(html);
						$("#downlink").css("display", "");
						$("#downlink").attr("innerHTML","<a href='get_com_ess.php"+qrystr+"' class='leftmenu_link'>&gt;&gt;Comment/Essay Answer Download</a>");
				},
				error: function(){
				   $("#place_graph").css("display", "none");
				   alert("Error occured during Ajax request...");
				}
			});
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
                  <td height="25" align="left" valign="middle" class="td_heading">Analyze Survey Wise:</td>
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
                        <tr class="tr_bg" id="place_question" style="display:none">
                          <td height="25" align="left" valign="top" class="black_text">Questions</td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="middle" id="place_question_dd">&nbsp;</td>
                        </tr>
                        <tr class="tr_bg" id="place_grtype" style="display:none">
                          <td height="25" align="left" valign="top" class="black_text">Graph Type </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="middle"><select name="grtype" class="input" id="grtype">
                            <option value="1">Pie</option>
							<option value="2">Line</option>
                            <option value="3">Bar</option>
                            <option value="4">Overlay Bar</option>
                          </select></td>
                        </tr>
                        <tr class="tr_bg" id="place_submit" style="display:none">
                          <td height="25" align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="middle"><input name="draw" type="button" class="submit" id="draw" value="Draw Graph" onClick="drawGraph()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="downlink"></span></td>
                        </tr>
                        <tr class="tr_bg" id="place_graph" style="display:none">
                          <td align="left" valign="middle" id="place_graph_img" colspan="3">&nbsp;</td>
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