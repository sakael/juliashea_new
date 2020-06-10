<?php
 // Dataset definition
 for($grp=0;$grp<count($finalarr);$grp++)
 {
	 $fdata=explode(",",trim($finalarr[$grp],","));
	 $DataSet->AddPoint($fdata,"Serie".$grp);
 }
 $height=(count($qst)*20)+247;
 // Initialise the graph
 $Test = new pChart(850,$height);
 $DataSet->AddAllSeries();
 $DataSet->SetAbsciseLabelSerie("Serie2");
 $DataSet->AddPoint($qst,"Serie2");

 // Initialise the graph
 $Test->drawFilledRoundedRectangle(7,7,373,193,5,240,240,240);
 $Test->drawRoundedRectangle(5,5,375,195,5,230,230,230);

 // Draw the pie chart
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),150,90,110,PIE_PERCENTAGE,TRUE,50,20,5);
 $Test->drawTitle(-300,22,"Pie Graph of ".$survey_title,50,50,50,585);
 $Test->drawPieLegend(10,250,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);

 $Test->Render("../".$img_name);
?>