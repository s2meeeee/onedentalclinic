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
$files = array();
$folderName = "notice";
$subFolderName = "";
if($mode)
{

	include dirname(__FILE__).'/../core/class/MysqlDB.class.php';
	include dirname(__FILE__).'/../core/dao/DoctorConsultCommentDao.class.php';
	include dirname(__FILE__).'/../core/dao/BoardDao.class.php';
	include dirname(__FILE__).'/../function.php';

	$dao = new DoctorConsultCommentDao();

	switch($mode)
	{
		case 'insert' :
            unset($_POST['mode']);

            foreach($_POST as $key => $value) {
                $params['doctor_consult_comments'][$key] = $purifier->purify($value);
            }

            $result =  $dao->insert($params);
		break;
		case 'update':
            unset($_POST['mode']);
            
            $where = " id = ".$_POST['id'];
            unset($_POST['id']);
            foreach($_POST as $key => $value) {
                $params['doctor_consult_comments'][$key] = $purifier->purify($value);
            }

            $result =  $dao->update($params, $files, $folderName, $subFolderName, $where);
		break;

        case 'delete':
            unset($_POST['mode']);
            $where = " id = ".$_POST['id'];
            unset($_POST['id']);
            $table = "doctor_consult_comments";
            $result =  $dao->delete($table, $where);
        break;
	}
}

echo json_encode($result);



?>