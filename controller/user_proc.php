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

if($mode)
{

	include dirname(__FILE__).'/../core/class/MysqlDB.class.php';
	include dirname(__FILE__).'/../core/dao/UserDao.class.php';
	include dirname(__FILE__).'/../function.php';

	$dao = new UserDao();

	switch($mode)
	{
		case 'insert' :
            unset($_POST['mode']);

            foreach($_POST as $key => $value) {
                $params['users'][$key] = $purifier->purify($value);
            }
            $result =  $dao->insert($params);
		break;

		case 'update':
            unset($_POST['mode']);
            $where = " id = ".$_POST['id'];
            unset($_POST['id']);
            foreach($_POST as $key => $value) {
                $params['users'][$key] = $purifier->purify($value);
            }
            $params['users']['sns_yn'] = empty($params['users']['sns_yn']) ? "N" : "Y";
            $params['users']['updated_at'] = date('Y-m-d H:i:s', time());
            $result =  $dao->update($params, $where);
		break;

        // 갱신 - 일년에 한 번씩 개인정보 동의 같은거 다시 양해 구해야 한다.
        case 'agree_update':
            unset($_POST['mode']);
            $where = " id = ".$_POST['id'];
            unset($_POST['id']);
            $params['users']['last_login'] = date('Y-m-d H:i:s', time());
            $result =  $dao->agreeUpdate($params, $where);
        break;

        case 'delete':
            unset($_POST['mode']);
            $where = " id = ".$_POST['id'];
            unset($_POST['id']);
            $table = "users";
            $result =  $dao->delete($table, $where);
        break;

        case 'check_id':
            $identity = $_POST['identity'];
            $result = $dao->checkId($identity);
        break;

        case 'password_change':
            unset($_POST['mode']);
            $where = " id = ".$_POST['id'];
            unset($_POST['id']);
            foreach($_POST as $key => $value) {
                $params['users'][$key] = $purifier->purify($value);
            }
            $result =  $dao->password_change($params, $where);
        break;

        case 'password_checked':
            unset($_POST['mode']);
            foreach($_POST as $key => $value) {
                $params['users'][$key] = $purifier->purify($value);
            }
            $result =  $dao->password_checked($params);
        break;

        case 'witherawal':
            unset($_POST['mode']);
            $where = " id = ".$_POST['id'];
            unset($_POST['id']);
            $params['users']['deleted_at'] = date('Y-m-d H:i:s', time());
            $params['users']['is_active'] = 'deleted';
            $result =  $dao->witherawal($params, $where);
        break;

        case 'find_id':
            unset($_POST['mode']);
            $name = $_POST['name'];
            $email = $_POST['email'];
            $result = $dao->find_id($name, $email);
        break;

        case 'find_password':
            unset($_POST['mode']);
            $identity = $_POST['identity'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $result = $dao->find_password($identity, $name, $email);
        break;

        case 'password_cookie':
            $str=rand();
            $result = sha1($str);
            session_start();
            $_SESSION['pwchange'] = $result;
            setcookie("pwchange", $result, time() + 30, "/");
            $result = array('result'=>true);
            break;

        case 'excel_download':
            unset($_POST['mode']);
            $table = $_POST['table'];
            $columns = $_POST['columns'];
            $where = $_POST['where'];
            $names = $_POST['names'];
            $excel_title = $_POST['excel_title'];
            $branch = isset($_POST['branch']) ? $_POST['branch'] : null;
            $sleep = isset($_POST['sleep']) ? true : false;
            $is_active = isset($_POST['is_active']) ? 0 : 1;
            $dao->excel_download($table, $columns, $where, $names, $excel_title, $branch, $sleep, $is_active);
            exit;
        break;
	}
}

echo json_encode($result);



?>