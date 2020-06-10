<? include("user_chksession.php");
$pgNo=1;
if($_POST['submitHid'])
{
	$cur_user_email=$_POST['survey_user_email'];
	$cur_user_code=$_POST['survey_user_code'];
	$cur_survey_client_id=$_SESSION['servey_info']['survey_client_id'];
	//$row=$obj->selectData(TABLE_SURVEY_USER,"","survey_client_id='".$cur_survey_client_id."' and survey_user_email='".$cur_user_email."' and survey_user_code='".$cur_user_code."'",1);
	//$row=$obj->selectData(TABLE_SURVEY_USER,"","survey_client_id='".$cur_survey_client_id."' and survey_user_code='".$cur_user_code."'",1);
	$row=$obj->selectData(TABLE_SURVEY_USER,"","survey_client_id='".$cur_survey_client_id."' and survey_user_email='".$cur_user_email."'",1);
	//echo $obj->getQuery();
	if($row==0)
	{
		$msg='Email or code mismatch!!';
	}
	else
	{
		if($row['survey_user_status']=='Y')
		{
			$arrSt['survey_user_id']=$row['survey_user_id'];
			$_SESSION['servey_info']['survey_user_email']=$row['survey_user_email'];
			$arrSt['survey_id']=$_SESSION['servey_info']['survey_id'];
			$arrSt['survey_takerinfo_crdt']=date("Y-m-d H:i:s");
			$ex_tkinfo=$obj->selectData(TABLE_SURVEY_TAKERINFO,"survey_takerinfo_id","survey_user_id='".$arrSt['survey_user_id']."' and survey_id='".$arrSt['survey_id']."'",1);
			if($ex_tkinfo==0)
			{
				$in_id=$obj->insertData(TABLE_SURVEY_TAKERINFO,$arrSt);
			}
			else
			{
				$in_id=$ex_tkinfo['survey_takerinfo_id'];
			}
			$_SESSION['servey_info']['survey_takerinfo_id']=$in_id;
			$_SESSION['servey_info']['survey_user_id']=$arrSt['survey_user_id'];
			$_SESSION['servey_info']['pageNo']=1;
			$row=$obj->updateData(TABLE_SURVEY_USER,array("survey_user_attend"=>"P"),"survey_user_id='".$arrSt['survey_user_id']."'");
			$obj->reDirect(FURL."view_introduction.php");
		}
		else
		{
			$msg='You can not access this survey..';
		}
	}
}
?>
<?php include("page_includes/header.php"); ?>
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" valign="top" class="inner"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <!--<tr>
                    <td height="40" align="left" valign="top"><h2 class="white_text"><? //=$_SESSION['servey_info']['survey_title']?></h2></td>
                  </tr>-->
				  <tr>
                    <td height="40" align="left" valign="top"><h2 class="white_text"><?=$_SESSION['servey_info']['welcome_text']?></h2></td>
                  </tr>
				  <? if($_SESSION['servey_info']['client_logo']!='../'){?>
                  <tr>
                    <td align="left" valign="top"><a href="<?=FURL?>"><img src="thumb/phpThumb.php?&src=<?=$_SESSION['servey_info']['client_logo']?>&hp=150&wl=150" alt="Logo" border="0" title="Logo"></a></td>
                  </tr>
				  <? }?>
				  <? if($msg){?>
                  <tr>
                    <td height="25" align="center" valign="top" class="red_text"><?=$msg?></td>
                  </tr>
				  <? }?>
                  <tr>
                    <td align="left" valign="top"><form id="form1" name="form1" method="post" action="">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="210" height="30" align="left" valign="middle" class="paddingBtm">Please Enter Your Email Address </td>
                          <td width="10" align="left" valign="middle" class="paddingBtm">:</td>
                          <td width="250" align="left" valign="top"><input name="survey_user_email" type="text" class="field_wht" id="survey_user_email" size="40" style="width:250px;"/></td>
                          <td width="10">&nbsp;</td>
                          <td><input name="email_submit" type="submit" class="submit" id="email_submit" value="Take Survey" /></td>
                        </tr>
                        <!--<tr>
                          <td height="30" width="210" align="left" valign="top">Please Enter Your  Code </td>
                          <td align="left" width="10" valign="top">:</td>
                          <td align="left" width="50" valign="top"><input name="survey_user_code" type="text" class="field_wht" id="survey_user_code" size="6" maxlength="6" /></td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>-->
                        <tr>
                          <td height="25" align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top"><input type="hidden" name="submitHid" value="1" id="submitHid"/></td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                     </form>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
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