<? include("admin_chksession.php");
$cnt=4;
if($_POST['Submit'])
{
	for($i=0;$i<$cnt;$i++)
	{
		$arr=array();
		$arr=array("content_descr"=>$_POST['content_descr'.$i]);
		$obj->updateData(TABLE_CONTENT,$arr,"content_id='".$_REQUEST['content_id'.$i]."'");
		//echo $obj->getQuery()."<br>";
	}
	$_SESSION['curMsg']=UPDATE;
}

$caption='Edit';
$res=$obj->selectData(TABLE_CONTENT,"","content_id in(1,3,5,6)");
?>
<html>
<head>
<title><?=SITE_NAME?></title>
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
                  <td height="25" align="left" valign="middle" class="td_heading"><?=$caption?> Header Text :</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="border2"><form name="form1" method="post" action="">
                      <table width="100%" border="0" cellspacing="1" cellpadding="2">
                        <? if($msg){?>
						<tr class="tr_bg">
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top">&nbsp;</td>
                          <td height="20" align="left" valign="middle" class="error"><?=$msg?></td>
                        </tr><? }?>
						<? $i=0;while($row=mysql_fetch_array($res)){?>
                        <tr class="tr_bg">
                          <td width="20%" height="30" align="left" valign="top" class="black_text"><?=$row['content_title']?></td>
                          <td width="4%" align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><input name="content_descr<?=$i?>" type="text" class="input" id="content_descr<?=$i?>" value="<?=$row['content_descr']?>" size="40">
                            <input type="hidden" name="content_id<?=$i?>" id="content_id<?=$i?>" value="<?=$row['content_id']?>"></td>
                        </tr>
						<? $i++;}?>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="middle"><input type="submit" name="Submit" value="Save" class="submit"></td>
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
