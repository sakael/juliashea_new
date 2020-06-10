<? include("user_chksession.php");
$pgNo=2;
if(!$_SESSION['servey_info']['survey_takerinfo_id'])
{
	$obj->reDirect(FURL."start_survey.php");
}
else
{
	if($_SESSION['servey_info']['pageNo']<$pgNo)
	{
		$_SESSION['servey_info']['pageNo']=$pgNo;
	}
}
$obj->reDirect(FURL."takeuser_info.php");
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
                <td align="left" valign="top" class="inner"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <!--<tr>
                    <td height="40" align="left" valign="top"><h2 class="white_text"><? //=$_SESSION['servey_info']['survey_title']?></h2></td>
                  </tr>
                  <tr>
                    <td height="40" align="left" valign="top"><h2 class="white_text"><? //=$_SESSION['servey_info']['welcome_text']?></h2></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><a href="<? //=FURL?>"><img src="thumb/phpThumb.php?&src=<? //=$_SESSION['servey_info']['client_logo']?>&hp=100&wl=100" alt="Logo" border="0" title="Logo"></a></td>
                  </tr>
                  <tr>
                    <td height="20" align="left" valign="top">&nbsp;</td>
                  </tr>-->
                  <tr>
                    <td align="left" valign="top"><?=$obj->putContent(3);?></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><form id="form1" name="form1" method="post" action="takeuser_info.php">
                      <input name="Next" type="submit" class="submit" id="Next" value="Next&gt;&gt;"/>
                     </form>
                    </td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
      </table>
<?php include("page_includes/footer.php"); ?>