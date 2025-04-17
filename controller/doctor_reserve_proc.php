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
$folderName = "doctor_reserves";
if($mode)
{
	include dirname(__FILE__).'/../core/class/MysqlDB.class.php';
	include dirname(__FILE__).'/../core/dao/DoctorReserveDao.class.php';
	include dirname(__FILE__).'/../function.php';

	$dao = new DoctorReserveDao();

	switch($mode)
	{
		case 'insert' :
            unset($_POST['mode']);

            foreach($_POST as $key => $value) {
                $params['doctor_reserves'][$key] = $purifier->purify($value);
            }

            $result =  $dao->insert($params);
		break;

		case 'update':
            unset($_POST['mode']);

            foreach($_POST as $key => $value) {
                $params['doctor_reserves'][$key] = $purifier->purify($value);
            }

            $where = " id = ".$_POST['id'];
            unset($_POST['id']);
            foreach($_POST as $key => $value) {
                $params['doctor_reserves'][$key] = $purifier->purify($value);
            }

            $result =  $dao->update($params, $where);
		break;

        case 'get_doctor_reserve':
            $result =  $dao->getDoctorReserve('doctor_reserves', $_POST['weeks'], $_POST['ymd'], $_POST['doctor_id']);
            break;


        case 'delete':
            unset($_POST['mode']);
            $where = " id = ".$_POST['id'];
            unset($_POST['id']);
            $table = "doctor_reserves";
            $result =  $dao->delete($table, $where);
        break;

        case 'delete_file':
            $params['doctor_reserves'][$_POST['fileName'].'_path'] = NULL;
            $params['doctor_reserves'][$_POST['fileName'].'_name'] = NULL;
            unset($_POST['mode']);
            $where = " id = ".$_POST['id'];
            unset($_POST['id']);
            $table = "doctor_reserves";
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