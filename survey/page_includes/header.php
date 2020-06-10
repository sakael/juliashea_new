<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=WEBSITE_NAME?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/common.js"></script>
</head>
<body>
<? $resh=$obj->selectData(TABLE_CONTENT,"","content_id in(1,3,5,6)");
while($rowh=mysql_fetch_array($resh))
{
	$headerText[]=$rowh['content_descr'];
}
?>	
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
   <tr>
    <td height="139" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="126" align="left" valign="top" class="header_bg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="500" align="left" valign="top" class="headerBG_lft"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="126" align="left" valign="top" class="logo_content"><ul>
		  	<li><?=empty($headerText[0])?'&nbsp;':$headerText[0]?>
				<ul>
					<li><?=empty($headerText[1])?'&nbsp;':$headerText[1]?>
					<ul>
						<li><?=empty($headerText[2])?'&nbsp;':$headerText[2]?>
							<ul>
								<li><?=empty($headerText[3])?'&nbsp;':$headerText[3]?></li>
							</ul>
						</li>
					</ul>
					</li>
				</ul>
				</li>
		  </ul></td>
          </tr>
        </table></td>
        <td align="center" valign="top"><img src="images/header_mid_img.jpg" alt="" width="89" height="126" border="0"></td>
        <td width="260" align="right" valign="top"><a href="index.php" target="_self"><img src="images/logo.jpg" alt="logo" border="0"></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="34" align="left" valign="top" class="header_menu_bg"><?php include("menu.php"); ?></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td align="center" valign="top">
