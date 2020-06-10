<? require_once("dompdf/dompdf_config.inc.php");
$old_limit = ini_set("memory_limit", "100M");
$dompdf = new DOMPDF();
$dompdf->load_html($str);
$dompdf->set_paper("letter", "portrait");
$dompdf->render();
$dompdf->stream($path);
?>