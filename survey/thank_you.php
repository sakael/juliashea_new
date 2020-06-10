<? include("user_chksession.php");
if(!$_SESSION['servey_info']['survey_takerinfo_id'])
{
	$obj->reDirect(FURL."index.php");
}
?>
<?php include("page_includes/header.php"); ?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.blockUI.js"></script>
<script type="text/javascript"> 
$(document).ready(function() { 
// cache the question element 

        $('#close').click(function() { 
            // update the block message 
			var chk = $("input:checked").length;
			if(chk==1)
			{
				var chkStat ='Yes';
			}
			if(chk==0)
			{
				var chkStat ='No';
			}
            $.blockUI(wait, { 
			backgroundColor: '#FFFFCC',
			border: '2px solid #9e0000',
			color: '#00a',
			left: ($(window).width()/2-100) + 'px',
			width: '200px' 
        	}); 
            $.ajax({ 
				url: 'survey_complete_email.php?responce='+chkStat+'&dt=' + new Date().getTime(), // prevent caching in IE
                complete: function() { 
                    // unblock when remote call returns
					$.unblockUI();
					self.close();
                } 
            }); 
            return false; 
        }); 
    }); 
</script>
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" valign="top" class="inner"><form id="form1" name="form1" method="post" action=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
				 <tr>
                    <td align="left" valign="top"><?=$obj->putContent(4);?></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center" valign="top"><input name="close" type="button" class="submit" id="close" value="Close Survey"/></td>
                  </tr>
                  <tr>
                    <td align="center" valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center" valign="top"><input name="resp" type="checkbox" value="1" checked />I authorize my response to be used by Julia Shea, Inc.</td>
                  </tr>
                </table>
                </form></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="25" align="left" valign="top"></td>
        </tr>
      </table>
<?php include("page_includes/footer.php"); ?>
<div id="wait" style="display:none; padding:10px 10px 10px 10px; cursor: default"><center><b>Please Wait...</b></center></div> 