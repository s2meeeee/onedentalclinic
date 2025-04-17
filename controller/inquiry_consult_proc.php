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
	include dirname(__FILE__).'/../core/dao/DoctorConsultDao.class.php';
	include dirname(__FILE__).'/../core/dao/BoardDao.class.php';
	include dirname(__FILE__).'/../function.php';

	$dao = new DoctorConsultDao();

	switch($mode)
	{
		case 'insert' :
            foreach($_FILES as $key => $file) {
                if ($file['error'] == 0 && $file['name'] && $file['size'] > 0) {
                    $files[$key] = $file;
                }
            }
            unset($_POST['mode']);

            foreach($_POST as $key => $value) {
                $params['doctor_consults'][$key] = $purifier->purify($value);
            }

            $result =  $dao->insert($params, $files, $folderName);
		break;

		case 'update':
            foreach($_FILES as $key => $file) {
                if ($file['error'] == 0 && $file['name'] && $file['size'] > 0) {
                    $files[$key] = $file;
                }
            }
            unset($_POST['mode']);

            foreach($_POST as $key => $value) {
                $params['doctor_consults'][$key] = $purifier->purify($value);
            }

            $where = " id = ".$_POST['id'];
            unset($_POST['id']);
            foreach($_POST as $key => $value) {
                $params['doctor_consults'][$key] = $purifier->purify($value);
            }

            $result =  $dao->update($params, $files, $folderName, $where);
		break;

        case 'consult_check':
            unset($_POST['mode']);
            foreach($_POST as $key => $value) {
                $params['doctor_consults'][$key] = $purifier->purify($value);
            }

            $result =  $dao->consult_check($params);
            break;

        case 'delete':
            unset($_POST['mode']);
            $where = " id = ".$_POST['id'];
            unset($_POST['id']);
            $table = "doctor_consults";
            $result =  $dao->delete($table, $where);
        break;

        case 'delete_file':
            $params['doctor_consults'][$_POST['fileName'].'_path'] = NULL;
            $params['doctor_consults'][$_POST['fileName'].'_name'] = NULL;
            unset($_POST['mode']);
            $where = " id = ".$_POST['id'];
            unset($_POST['id']);
            $table = "doctor_consults";
            $result =  $dao->delete_file($params, $_POST['fileName'], $where);
            break;

        case 'excel_download':
            unset($_POST['mode']);
            $table = $_POST['table'];
            $columns = $_POST['columns'];
            $where = $_POST['where'];
            $names = $_POST['names'];
            $excel_title = $_POST['excel_title'];
            $branch = isset($_POST['branch']) ? $_POST['branch'] : null;
            $dao->board->excel_download($table, $columns, $where, $names, $excel_title, $branch);
            exit;
        break;
	}
}

echo json_encode($result);



?>