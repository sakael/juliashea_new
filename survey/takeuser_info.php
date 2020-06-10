<? include("user_chksession.php");
$pgNo=3;
if(!$_SESSION['servey_info']['survey_takerinfo_id'])
{
	$obj->reDirect(FURL."start_survey.php");
}
if($_SESSION['servey_info']['pageNo']<$pgNo)
{
	$_SESSION['servey_info']['pageNo']=$pgNo;
}
$obj->reDirect(FURL."survey_question_1.php");
$row=$obj->selectData(TABLE_SURVEY_TAKERINFO,"","survey_takerinfo_id='".$_SESSION['servey_info']['survey_takerinfo_id']."'",1);
$infoArr=$obj->getInfoDdArr();
?>
<?php include("page_includes/header.php"); ?>
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="220" align="left" valign="top" class="inner_left"><?php include("page_includes/left.php"); ?></td>
                <td align="left" valign="top" class="inner"><form id="form1" name="form1" method="post" action="takeuser_info_submit.php"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="40" align="left" valign="top"><h2 class="white_text"><?=$_SESSION['servey_info']['survey_title']?></h2></td>
                  </tr>
                  <tr>
                    <td height="40" align="left" valign="top"><h2 class="white_text"><?=$_SESSION['servey_info']['welcome_text']?></h2></td>
                  </tr>
				  <? if($_SESSION['servey_info']['client_logo']!='../'){?>
                  <tr>
                    <td align="left" valign="top"><a href="<?=FURL?>"><img src="thumb/phpThumb.php?&src=<?=$_SESSION['servey_info']['client_logo']?>&hp=100&wl=100" alt="Logo" border="0" title="Logo"></a></td>
                  </tr>
				  <? }?>
                  <tr>
                    <td height="20" align="left" valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="25%" height="25">Number</td>
                        <td width="4%" align="center">:</td>
                        <td><?=$_SESSION['servey_info']['survey_takerinfo_id']?></td>
                      </tr>
                      <tr>
                        <td height="25">Gender</td>
                        <td align="center">:</td>
                        <td><select name="survey_takerinfo_gender" class="input" id="survey_takerinfo_gender">
                          <option value="Male" <? if($row['survey_takerinfo_gender']=='Male'){ echo 'selected';}?>>Male</option>
                          <option value="Female" <? if($row['survey_takerinfo_gender']=='Female'){ echo 'selected';}?>>Female</option>
                        </select></td>
                      </tr>
                      <tr>
                        <td height="25">Age</td>
                        <td align="center">:</td>
                        <td><select name="survey_takerinfo_age" class="input" id="survey_takerinfo_age">
						<? $obj->getInfoDd($infoArr['ag']['title'],$row['survey_takerinfo_age']);?>
                        </select></td>
                      </tr>
                      <tr>
                        <td height="25">Position</td>
                        <td align="center">:</td>
                        <td><select name="survey_takerinfo_pos" class="input" id="survey_takerinfo_pos">
						<? $obj->getInfoDd($infoArr['po']['title'],$row['survey_takerinfo_pos']);?>
                        </select></td>
                      </tr>
                      <tr>
                        <td height="25">Department</td>
                        <td align="center">:</td>
                        <td><select name="survey_takerinfo_dept" class="input" id="survey_takerinfo_dept">
						<? $obj->getInfoDd($infoArr['de']['title'],$row['survey_takerinfo_dept']);?>
                        </select></td>
                      </tr>
                      <tr>
                        <td height="25">Time With Company </td>
                        <td align="center">:</td>
                        <td><select name="survey_takerinfo_tmcom" class="input" id="survey_takerinfo_tmcom">
						<? $obj->getInfoDd($infoArr['tc']['title'],$row['survey_takerinfo_tmcom']);?>
                        </select></td>
                      </tr>
                      <tr>
                        <td height="25">Time in present position </td>
                        <td align="center">:</td>
                        <td><select name="survey_takerinfo_tmpp" class="input" id="survey_takerinfo_tmpp">
						<? $obj->getInfoDd($infoArr['tp']['title'],$row['survey_takerinfo_tmpp']);?>
                        </select></td>
                      </tr>
                      <tr>
                        <td height="25" align="left">Education</td>
                        <td align="center">:</td>
                        <td><select name="survey_takerinfo_edu" class="input" id="survey_takerinfo_edu">
						<? $obj->getInfoDd($infoArr['ed']['title'],$row['survey_takerinfo_edu']);?>
                        </select></td>
                      </tr>
                      <tr>
                        <td height="25" align="left">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td><span class="error">*</span> Mandatory Entries</td>
                      </tr>
                      <tr>
                        <td height="25" align="left">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td>
                      <input name="Prev" type="button" class="submit" id="Prev" value="&lt;&lt;Prev" onclick="gotopg('view_introduction.php')"/>
                      &nbsp;&nbsp;<input name="Next" type="submit" class="submit" id="Next" value="Next&gt;&gt;"/>
                    </td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                  </tr>
                </table></form></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
      </table>
<?php include("page_includes/footer.php"); ?>