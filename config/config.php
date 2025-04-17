<?php
header('Content-Type: text/html; charset=utf-8');

define('DOCUMENT_ROOT', dirname(__FILE__) . '/..');
define('DAO_PATH', DOCUMENT_ROOT . '/core/dao');
define('CLASS_PATH', DOCUMENT_ROOT . '/core/class');
define('UPLOAD_PATH', DOCUMENT_ROOT . '/upload/');
define('HOST', 'https://choyosan1.cafe24.com/');
define('ADM_PATH', DOCUMENT_ROOT . '/admin');

$dir = explode("/", getcwd());
define('DAO_NAME', ucfirst($dir[sizeof($dir) - 1]) . 'Dao');
$DAO_NAME = DAO_NAME;

//  한국 표준시 (KST) 설정
date_default_timezone_set("Asia/Seoul");

?>