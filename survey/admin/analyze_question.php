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
		$("#place_submit").css("display", "none");
		$("#place_grtype").css("display", "none");
		$("#place_graph").css("display", "none");
		$("#place_opt").css("display", "none");
	}
	else
	{
		$("#place_survey").css("display", "");
		$("#place_survey_dd").attr("innerHTML","Loading...");
		$("#place_submit").css("display", "none");
		$("#place_opt").css("display", "none");
		$("#place_grtype").css("display", "none");
		$("#place_graph").css("display", "none");
		var dataurl = 'ajax_script/get_survey_dd.php?qid='+qid;
			  $.ajax({
				type: "GET",
				url: dataurl,
				success: function(html){
					if(html=='0')
					{
						$("#place_submit").css("display", "none");
						$("#place_grtype").css("display", "none");
						$("#place_opt").css("display", "none");
						$("#place_survey_dd").attr("innerHTML","<span class='error'>This question is not assign yet in any survey</span>");
					}
					else
					{
						$("#place_survey_dd").html(html);
						$("#place_submit").css("display", "");
						$("#place_grtype").css("display", "");
						$("#place_opt").css("display", "");
					}
				},
				error: function(request,error) {
				   alert("Error occured during Ajax request...Error Details:"+error);
				}
			});
	}

}
function drawGraph()
{
	var sid=outputSelected(form1.survey_id.options,0);
	var opt=$('input:radio:checked').val();
	if($("#grtype").val()==1)
	{
		var totSel=getSelected(form1.survey_id.options,1);
		if (totSel>1 && opt==1)
		{
			$("#place_graph").css("display", "none");
			alert('Please select one "Survey " for pie chart');
			return false;
		}
	}	
	var dataurl = 'ajax_script/get_question_graph.php?grtype='+$("#grtype").val()+'&survey_id='+sid+'&question_id='+$("#question_id").val()+'&opt='+opt;
	$("#place_graph").css("display", "");
	$("#place_graph_img").attr("innerHTML","<img src='images/graph-loader.gif' align='absmiddle'>&nbsp;Generating Graph.Please wait....");
			  $.ajax({
				type: "GET",
				url: dataurl,
				success: function(html){
						$("#place_graph_img").html(html);
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
                  <td height="25" align="left" valign="middle" class="td_heading">Analyze Question Wise :</td>
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
                        <tr class="tr_bg" id="place_opt" style="display:none">
                          <td height="25" align="left" valign="top" class="black_text">OutPut Type </td>
                          <td align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="middle"><input name="opt" type="radio" value="1" checked>
                            Individual 
                              <input name="opt" type="radio" value="0">
                              Combine</td>
                        </tr>
                        <tr class="tr_bg" id="place_submit" style="display:none">
                          <td height="25" align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="middle"><input name="draw" type="button" class="submit" id="draw" value="Draw Graph" onClick="drawGraph()"></td>
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