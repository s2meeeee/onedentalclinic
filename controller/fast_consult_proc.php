<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include dirname(__FILE__).'/../config/config.php';
require_once(DOCUMENT_ROOT.'/lib/htmlpurifier/library/HTMLPurifier.auto.php');
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);
$params = array();
$mode = !empty($_POST['mode']) ? $_POST['mode'] : '';
$result = array();
$files = array();
$folderName = "doctor_consult";

if($mode)
{
	include dirname(__FILE__).'/../core/class/MysqlDB.class.php';
	include dirname(__FILE__).'/../core/dao/FastConsultDao.class.php';
	include dirname(__FILE__).'/../core/dao/BoardDao.class.php';
	include dirname(__FILE__).'/../function.php';

	$dao = new FastConsultDao();

	switch($mode)
	{
		case 'insert' :
            unset($_POST['mode']);

            foreach($_POST as $key => $value) {
                $params['fast_consults'][$key] = $purifier->purify($value);
            }

            $result =  $dao->insert($params, $files, $folderName);
		break;

		case 'update':
            unset($_POST['mode']);

            foreach($_POST as $key => $value) {
                $params['fast_consults'][$key] = $purifier->purify($value);
            }

            $where = " id = ".$_POST['id'];
            unset($_POST['id']);
            foreach($_POST as $key => $value) {
                $params['fast_consults'][$key] = $purifier->purify($value);
            }

            $result =  $dao->update($params, $files, $folderName, $where);
		break;

        case 'delete':
            unset($_POST['mode']);
            $where = " id = ".$_POST['id'];
            unset($_POST['id']);
            $table = "fast_consults";
            $result =  $dao->delete($table, $where);
        break;
	}
}

echo json_encode($result);



?>