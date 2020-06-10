<?php
	include("html_to_doc.inc.php");
	
	$htmltodoc= new HTML_TO_DOC();
	
	//$htmltodoc->createDoc("reference1.html","test");
	$htmltodoc->createDocFromURL("http://yahoo.com","test");
	

?>