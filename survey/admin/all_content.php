<? include("admin_chksession.php");

if($_REQUEST['id']) $id=$_REQUEST['id'];
else $id=1;

if($_POST['Submit'])
{
	$obj->updateData(TABLE_CONTENT,array("content_descr"=>$_POST['content_descr']),"content_id='".$id."'");
	$msg='Content Updated!';
}

$sql=$obj->selectData(TABLE_CONTENT,"","content_id='".$id."'",1);
$sql1=$obj->selectData(TABLE_CONTENT,"","content_id in(2,4,7)");
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
                  <td height="25" align="left" valign="middle" class="td_heading">Manage Content  :</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="border2"><form name="form1" method="post" action="">
                      <table width="100%" border="0" cellspacing="1" cellpadding="2">
                      <? if($msg){?>  <tr  class="tr_bg">
                          <td align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top">&nbsp;</td>
                          <td height="20" align="left" valign="middle" class="error"><?=$msg?></td>
                        </tr> <? }?>
                        <tr class="tr_bg">
                          <td width="20%" height="30" align="left" valign="middle" class="black_text">Page Name </td>
                          <td width="4%" align="center" valign="middle" class="black_text">:</td>
                          <td align="left" valign="middle"><select name="pagename"  class="input" id="client_type" style="width:200px" onChange="javascript:window.location.href='all_content.php?id='+this.value">
<? while($row=mysql_fetch_array($sql1))
{
		if($id==$row['content_id'])
		{ 
		echo '<option value="'.$row['content_id'].'" selected>'.$row[content_title].'</option>';
		}
		else
		echo '<option value="'.$row['content_id'].'">'.$row[content_title].'</option>';
}
?>
</select>                          </td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">Page Content </td>
                          <td align="center" valign="top" class="black_text">:</td>
                          <td align="left" valign="top"><? 
								require_once(FCKPATH.'FCKeditor/fckeditor.php');
								$oFCKeditor = new FCKeditor('content_descr') ;
								$oFCKeditor->BasePath	=FCKPATH."FCKeditor/" ;
								$oFCKeditor->Height	= 500 ;
								$oFCKeditor->Width	= 700 ;
								$oFCKeditor->Value	=html_entity_decode($sql['content_descr']);								
								$oFCKeditor->Create() ; ?></td>
                        </tr>
                        <tr class="tr_bg">
                          <td height="25" align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="top" class="black_text">&nbsp;</td>
                          <td align="left" valign="middle"><input type="submit" name="Submit" value="Update" class="submit"></td>
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
