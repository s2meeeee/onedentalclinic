<?php
    session_start();
    include_once dirname(__FILE__).'/../../config/config.php';
    include_once dirname(__FILE__).'/../../config/defined_list.php';
    include_once dirname(__FILE__).'/../function.php';
    include_once CLASS_PATH.'/MysqlDB.class.php';
    include_once DAO_PATH.'/LoginDao.class.php';
    $loginDao = new LoginDao();

    if ($_SESSION['identity']) {
        $userInfo = $loginDao->loginInfo($_SESSION['identity']);
    }

    if (!$userInfo || $userInfo['gubun'] != 'admin') {
        alertLocationHref("페이지에 대한 권한이 없습니다.", '/');
    }
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" >
    <meta name="author" content="" >
    <meta property="og:title" content="원치과 관리자 페이지">
    <meta property="og:url" content="https://choyosan1.cafe24.com/admin">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/lineicons.css" />
    <link rel="stylesheet" href="../assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="../assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/regExp.js"></script>
    <script src="../../js/validated.js"></script>
    <title>원치과 관리자 페이지</title>
</head>
<body>
<div id="mainSpinner" class="d-none w-100 position-absolute" style="z-index:100; background-color: rgba(0, 0, 0, 0.4);">
    <div class="spinner-border position-absolute top-50 end-50" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<?php require_once '../layouts/aside.php'; ?>
<main class="main-wrapper">
<?php require_once '../layouts/header.php'; ?>
<?php require_once '../function.php'; ?>
