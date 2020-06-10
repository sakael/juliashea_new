<? include("../../includes/connection.php");
$resop=$obj->selectData(TABLE_OPTION,"","option_status='A'");
?>
<table width="100%"  border="0" cellpadding="0" cellspacing="2">
  <tr>
    <td align="left" valign="top" class="border2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top">
          <table width="100%"  border="0" cellpadding="2" cellspacing="1" >
            <? while($rowop=mysql_fetch_array($resop)){?>
            <tr class="tr_bg">
			  <td height="20" width="10%" align="right" valign="middle" class="black_text"><?=$rowop['option_id']?></td>
              <td height="20" align="left" valign="middle" class="black_text"><?=$rowop['option_title']?></td>
              </tr>
			<? }?>
          </table>
        </td>
      </tr>
    </table></td>
  </tr>
</table>