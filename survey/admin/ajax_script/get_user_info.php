<? include("../../includes/connection.php");
$survey_user_id=$_REQUEST['survey_user_id'];
$row=$obj->selectData(TABLE_SURVEY_TAKERINFO,"","survey_user_id='".$survey_user_id."'",1);
?>
<table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr class="tr_bg">
          <td width="25%" height="25">Number</td>
          <td width="4%" align="center">:</td>
          <td><?=$row['survey_takerinfo_id']?></td>
        </tr>
        <tr class="tr_bg">
          <td height="25">Gender</td>
          <td align="center">:</td>
          <td><?=$row['survey_takerinfo_gender']?></td>
        </tr>
        <tr class="tr_bg">
          <td height="25">Age</td>
          <td align="center">:</td>
          <td><?=$row['survey_takerinfo_age']?></td>
        </tr>
        <tr class="tr_bg">
          <td height="25">Position</td>
          <td align="center">:</td>
          <td><?=$row['survey_takerinfo_pos']?></td>
        </tr>
        <tr class="tr_bg">
          <td height="25">Department</td>
          <td align="center">:</td>
          <td><?=$row['survey_takerinfo_dept']?></td>
        </tr>
        <tr class="tr_bg">
          <td height="25">Time With Company </td>
          <td align="center">:</td>
          <td><?=$row['survey_takerinfo_tmcom']?></td>
        </tr class="tr_bg">
        <tr class="tr_bg">
          <td height="25">Time in present position </td>
          <td align="center">:</td>
          <td><?=$row['survey_takerinfo_tmpp']?></td>
        </tr>
        <tr class="tr_bg">
          <td height="25" align="left">Education</td>
          <td align="center">:</td>
          <td><?=$row['survey_takerinfo_edu']?></td>
        </tr>
      </table>