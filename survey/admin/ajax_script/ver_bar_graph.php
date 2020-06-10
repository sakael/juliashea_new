<?php
 for($grp=0;$grp<count($finalarr);$grp++)
 {
	 $fdata=explode(",",trim($finalarr[$grp],","));
	 $DataSet->AddPoint($fdata,"Serie".$grp);
 }
 $DataSet->AddAllSeries();
 if(is_array($xAxixarr))
 {
	 $DataSet->AddPoint($xAxixarr,"xaxis");
	 $DataSet->SetAbsciseLabelSerie("xaxis");
 }
 else
 {
 	$DataSet->SetAbsciseLabelSerie();
 }
 for($ue=0;$ue<count($user_mail);$ue++)
 {
	$DataSet->SetSerieName($user_mail[$ue],"Serie".$ue);
 }
 $height=(count($user_mail)*20)+247;
 // Initialise the graph
 $Test = new pChart(850,$height);
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->setGraphArea(50,30,680,200);
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);
 $Test->drawGraphArea(255,255,255,TRUE);
 $Test->setFixedScale(0,10,10);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,TRUE);
 $Test->drawGrid(4,TRUE,230,230,230,50);

 // Draw the 0 line
 $Test->setFontProperties("Fonts/tahoma.ttf",6);
 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);

 // Draw the bar graph
 $Test->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE);

 // Finish the graph
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->drawLegend(10,250,$DataSet->GetDataDescription(),255,255,255);
 $Test->setFontProperties("Fonts/tahoma.ttf",10);
 $Test->drawTitle(50,22,"Bar Graph of ".$survey_title,50,50,50,585);
 $Test->Render("../".$img_name);
?>