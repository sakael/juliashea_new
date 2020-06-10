<?php include("../includes/classes/excelwriter.inc.php");
$excel=new ExcelWriter($path);
if($excel==false)	
echo $excel->error;
$excel->writeRow();
$excel->writeCol($str);
for($i=1;$i<=count($opArray);$i++)
{
	$opTxt=empty($opArray[$i])?$i:$opArray[$i];
	$excel->writeRow();
	$excel->writeCol($i." => ".$opTxt);
}
$excel->writeRow();
$excel->writeCol(" ");
for($i=0;$i<count($sqArray);$i++)
{
	$excel->writeRow();
	$excel->writeCol($sqArray[$i]['question']);
	$excel->writeCol($sqArray[$i]['answer']);
}
if(count($sqArray)>0)
{
	$excel->writeRow();
	$excel->writeCol('Questions for Info');
	for($i=0;$i<count($sqArrayInfo);$i++)
	{
		$excel->writeRow();
		$excel->writeCol($sqArrayInfo[$i]['question']);
		$excel->writeCol($sqArrayInfo[$i]['answer']);
	}
}
$excel->close();
?>