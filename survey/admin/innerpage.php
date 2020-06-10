<html>
<head>
<title>
<?=SITE_NAME?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/admin.css" rel="stylesheet" type="text/css">
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
                    <td height="25" align="left" valign="middle" class="td_heading">Heading :</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="border2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="25" align="left" valign="top"><table width="100%"  border="0" cellspacing="2" cellpadding="0">
                              <tr>
                                <td width="87%" align="left" valign="top">&nbsp;</td>
                                <td width="10%" align="right" valign="middle"><img src="images/add.gif" width="24" height="24"></td>
                                <td align="center" valign="middle"><a href="add.php" target="_self" class="blue_text"><b>Add</b></a></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"><form name="form1" method="post" action="">
                              <table width="100%"  border="0" cellpadding="2" cellspacing="1" >
                                <tr align="center" valign="middle">
                                  <td width="70%" height="25" align="left" valign="middle" class="td_heading">Page Name</td>
                                  <td width="10%" class="td_heading">Edit</td>
                                  <td width="10%" class="td_heading">Status</td>
                                  <td class="td_heading">Delete</td>
                                </tr>
                                <tr class="tr_bg">
                                  <td height="20" align="left" valign="middle" class="black_text">text text text </td>
                                  <td align="center" valign="middle"><a href="edit.php" target="_self" class="blue_link">Edit</a></td>
                                  <td align="center" valign="middle" class="black_text">Active</td>
                                  <td align="center" valign="middle"><input type="checkbox" name="checkbox" value="checkbox">
                                  </td>
                                </tr>
                                <tr class="tr_bg">
                                  <td height="20" colspan="4" align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="15%" height="20" align="left" valign="middle" class="red_text">Page 1 of 5</td>
                                        <td align="right" valign="middle" class="blue_text"><span class="red_text"><b>1</b></span> 2  3  4  5  | <span class="red_text">Next</span></td>
                                        <td width="1%" align="left" valign="top">&nbsp;</td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr class="tr_bg2">
                                  <td height="25" colspan="4" align="right" valign="middle" class="black_text" style="padding-right:8px;"><input name="Submit" type="submit" class="submit" value="Update">
                                  </td>
                                </tr>
                              </table>
                          </form></td>
                        </tr>
                    </table></td>
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
