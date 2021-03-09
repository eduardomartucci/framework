<?php
header("Content-type: text/html; charset=windows-1252");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once("/home/base/public_html/sys/inc/config.inc.php");

$utils = new Utils();
$data = new Data();
?>
