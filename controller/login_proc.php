<?php

//error_reporting(E_ALL);
//ini_set("display_errors", 1);
include dirname(__FILE__).'/../config/config.php';

require_once(DOCUMENT_ROOT.'/lib/htmlpurifier/library/HTMLPurifier.auto.php');
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

$params = array();
$mode = !empty($_POST['mode']) ? $_POST['mode'] : '';
$result = array();
if($mode)
{

	include dirname(__FILE__).'/../core/class/MysqlDB.class.php';
	include dirname(__FILE__).'/../core/dao/LoginDao.class.php';
	
	$dao = new LoginDao();
	
	switch($mode)
	{
		case 'login' :
            $params['identity'] = $_POST['identity'];
            $params['password'] = $_POST['password'];

			$result =  $dao->login($params);
		break;

		case 'log_out':
			$result	=  $dao->log_out();
		break;
	}
}

echo json_encode($result);



?>