<?php
// Tourgar/index.php
// Redirect dari root langsung ke public/ (landing page)
$currentDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
header('Location: ' . $currentDir . '/public/');
exit;
