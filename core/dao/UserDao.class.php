<?php
	class UserDao
	{
		var $db;
        var $result = false;
        var $msg;
        var $excel_column_basic;

		public function __construct()
		{
			$this->db = new MysqlDB();
            $this->excel_column_basic = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N"];
		}

		public function getList($view_table,$page,$limit,$where=null, $is_active='active')
		{
			$query ="SELECT * FROM " .$view_table
                    ." WHERE 1 AND gubun != 'admin' AND is_active = '".$is_active."'"
					.$where
                    ." ORDER BY id DESC";

			$start_page = ($page > 1) ? (($page-1)*$limit) : 0;
			$limit_query = ' limit  '.$start_page.', '.$limit;

			$values = $this->db->get_list($query.$limit_query);

			$total_cnt  = $this->db->get_record('SELECT count(*) as total_cnt FROM ('.$query.') CNT');

			return  array('total_cnt'=>$total_cnt['total_cnt'], 'values'=>$values);
		}

        public function getDetail($view_table, $where)
        {
            return $this->db->get_record("SELECT id, identity, name, email, phone, gubun, gender, birthday FROM ".$view_table.$where);
        }

        public function insert($params)
        {
            $checkId = $this->checkId($params['users']['identity']);
            if (empty($checkId['result'])) {
                return array('result'=>$checkId['result'], 'msg'=>$checkId['msg']);
                exit;
            }

            $params['users']['password'] = password_hash($params['users']['password'], PASSWORD_DEFAULT);
            if ($this->db->insert('users',$params['users'])) {
                $this->result = true;
                $this->msg = "등록이 완료되었습니다.";

            } else {
                $this->msg = "등록이 실패하였습니다.";
            }

            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function update($params, $where)
        {
            if ($this->db->update('users',$params['users'], $where)) {
                $this->result = true;
                $this->msg = "수정이 완료되었습니다.";
            } else {
                $this->msg = "수정이 실패하였습니다.";
            }

            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function agreeUpdate($params, $where)
        {
            if ($this->db->update('users',$params['users'], $where)) {
                $this->result = true;
                $this->msg = "갱신이 완료되었습니다.";
            } else {
                $this->msg = "갱신이 실패하였습니다.";
            }

            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function delete($table, $where)
        {
            if ($this->db->delete($table, $where)) {
                $this->result = true;
                $this->msg = "삭제가 완료되었습니다.";
            } else {
                $this->msg = "삭제가 실패하였습니다.";
            }
            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function witherawal($params, $where)
        {
            if ($this->db->delete('users', $where)) {
                session_start();
                session_destroy();
                $this->result = true;
                $this->msg = "탈퇴처리가 완료되었습니다.";
            } else {
                $this->msg = "탈퇴처리가 실패하였습니다.";
            }
            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function checkId($identity)
        {
            $query =  "SELECT count(identity) as cnt FROM users WHERE identity = '".$identity."' AND is_active = 'active'";
            $cnt = $this->db->get_record($query)['cnt'];
            if ($cnt < 1) {
                $this->result = true;
                $this->msg = "아이디 확인이 완료되었습니다.";
            } else {
                $this->msg = "중복된 아이디입니다.";
            }
            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function password_change($params, $where)
        {
            $params['users']['password'] = password_hash($params['users']['password'], PASSWORD_DEFAULT);
            if ($this->db->update('users',$params['users'], $where)) {
                if (!empty($_SESSION['pwchange'])) {
                    unset($_SESSION['pwchange']);
                }
                $this->result = true;
                $this->msg = "비밀번호 변경이 완료되었습니다.";
            } else {
                $this->msg = "비밀번호 변경이 실패하였습니다.";
            }

            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function password_checked($params)
        {
            $query = "SELECT password FROM users WHERE identity = '".$params['users']['identity']."'";
            $hash_password = $this->db->get_record($query)['password'];
            if (!password_verify($params['users']['old_password'], $hash_password)) {
                return array('result'=>false, 'msg'=>"비밀번호가 일치하지 않습니다");
            } else {
                return array('result'=>true, 'msg'=>"비밀번호가 확인되었습니다");
            }
        }

        public function find_id($name, $email)
        {
            $query =  "SELECT identity FROM users WHERE name = '".$name."' AND email = '".$email."' AND is_active = 'active'";

            $identity = $this->db->get_record($query)['identity'] ?? false;
            if ($identity) {
                $html = $this->find_id_html($identity);
                $subject = $name." 님의 회원정보입니다.";
//                $this->send_email($email, $name, $html, $subject);
                $this->result = true;
//                $this->msg = "이메일로 아이디를 발송하였습니다.";
                $this->msg = $identity;
            } else {
                $this->msg = "이름과 이메일을 정확하게 입력해주세요";
            }
            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function find_password($identity, $name, $email)
        {
            $query =  "SELECT count(identity) as cnt FROM users WHERE identity = '".$identity."' AND name = '".$name."' AND email = '".$email."' AND is_active = 'active'";
            $cnt = $this->db->get_record($query)['cnt'];
            if ($cnt > 0) {
                $randPassword = $this->getRandomString();
                $password = password_hash($randPassword, PASSWORD_DEFAULT);
                $params['users']['password'] = $password;
                $where = " identity = '".$identity."' AND name = '".$name."' AND email = '".$email."' AND is_active = 'active'";
                $this->db->update('users',$params['users'], $where);
                $this->result = true;
                $this->msg = $randPassword;
            } else {
                $this->msg = "이름, 아이디, 이메일을 정확하게 입력해주세요";
            }
            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

//        public function find_password($identity, $name, $email)
//        {
//            $query =  "SELECT count(identity) as cnt FROM users WHERE identity = '".$identity."' AND name = '".$name."' AND email = '".$email."' AND is_active = 'active'";
//            $cnt = $this->db->get_record($query)['cnt'];
//            if ($cnt > 0) {
//                $randPassword = $this->getRandomString();
//                $password = password_hash($randPassword, PASSWORD_DEFAULT);
//                $params['users']['password'] = $password;
//                $where = " identity = '".$identity."' AND name = '".$name."' AND email = '".$email."' AND is_active = 'active'";
//                $this->db->update('users',$params['users'], $where);
//                $html = $this->find_id_html($identity, $randPassword);
//                $subject = "모두병원 ".$name." 님의 회원정보입니다.";
//                $this->send_email($email, $name, $html, $subject);
//                $this->result = true;
//                $this->msg = "이메일로 비밀번호를 발송하였습니다.";
//            } else {
//                $this->msg = "이름, 아이디, 이메일을 정확하게 입력해주세요";
//            }
//            return array('result'=>$this->result, 'msg'=>$this->msg);
//        }

        private function send_email($tomail, $toname, $html, $subject) {
            require $_SERVER["DOCUMENT_ROOT"]."/PHPMailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;	//Create a new PHPMailer instance
            $mail->isSMTP();				//Tell PHPMailer to use SMTP
            $mail->SMTPDebug		= 0;	//0:off / 1:client / 2:cliend and server
            $mail->Debugoutput	= 'html';		//Ask for HTML-friendly debug output
            $mail->CharSet			= "utf-8";
            //$mail->Host				= "ppm2019.co.kr";
            $mail->Host				= "smtp.cafe24.com";
//            $mail->Host				= "moduhosp.cafe24.com";
            $mail->Port				= 587;
            $mail->SMTPSecure		= "SSL";
            //$mail->SMTPSecure		= "TLS";	//좋은생각 웹메일 계정
            $mail->SMTPAuth		= true;			//Whether to use SMTP authentication
            //$mail->Username		= "webmaster@ppm2019.co.kr";	//Username to use for SMTP authentication
            $mail->Username		= "webmaster@xmail01.cafe24.com";	//Username to use for SMTP authentication
            //$mail->Password			= "ppm2019!";						//Password to use for SMTP authentication
            $mail->Password			= "whgdmstodrkr0070";						//Password to use for SMTP authentication
            $mail->setFrom("webmaster@xmail01.cafe24.com", '모두병원');
            $mail->addReplyTo("webmaster@xmail01.cafe24.com", '모두병원');
            $mail->addAddress($tomail, $toname);		//받는 사람
            $mail->Subject			= $subject;
            //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
            $mail->msgHTML($html);		//메일내용
            //$mail->AltBody			= 'Temporary your password:'.$tmp_pass;
            //send the message, check for errors
            if (!$mail->send()) {
                //echo "Mailer Error: " . $mail->ErrorInfo;
                return false;
            } else {
                //echo "Message sent!";
                return true;
            }
        }

        private function find_id_html($identity, $password=null) {
            $dmi = "http://".$_SERVER['HTTP_HOST'];

            $html = "<table width=640 border=0 cellpadding=0 cellspacing=0>
			   <tr> 
				<td align=center valign=top class=root>
					 <table width=550 border=0 cellpadding=0 cellspacing=0>
					<tr> 
					  <td height=150 class=root align=left><font color=#878787 size=2 face=돋움>본 
						메일은 정보통신망법 시행규칙 개정안 제11조 1항 1조에 의거해 발송되었으며, 회원님께서는 모두병원 회원가입시 또는 그 이후 
						메일 수신을 동의하셨습니다. 
						본 메일은 발신전용으로 회신되지 않습니다. 문의는 고객센터로 연락주세요. </font></td>
					</tr>
				  </table>
				   </td>
			  </tr>
			  <tr> 
				<td align=center valign=top class=root>
					<br>
					<table width=550 border=0 cellpadding=7 cellspacing=1 bgcolor=#D5D5D5>
					<tr bgcolor=#FFFFFF> 
					  <td align=center height=40 width=250><font size=2 face=돋움><strong>아이디</strong></font></td>
					  <td align=left><font size=2 face=돋움>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$identity</font></td>
					</tr>";
                if ($password) {
                    $html .= "<tr bgcolor=#FFFFFF> 
                          <td align=center height=40><font size=2 face=돋움><strong>임시 비밀번호</strong></font></td>
                          <td align=left><font size=2 face=돋움>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$password</font></td>
                        </tr>";
                }
					$html .= "</table>
                           </td>
                      </tr>
                      <tr> 
                        <td align=center valign=top class=root>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td valign=top class=root>&nbsp;</td>
                      </tr>
                    </table>";
            return $html;
        }

        private function getRandomString() {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';

            for ($i = 0; $i < 7; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }

            return $randomString."1!";
        }

        public function excel_download($table, $columns, $where, $names, $excel_title, $branch=null, $sleep=false, $is_active=1)
        {
            ini_set('memory_limit','512M');

            include_once "../lib/PHPExcel/Classes/PHPExcel.php";
            include dirname(__FILE__).'/../../config/defined_list.php';

            if ($sleep == true) {
                $where .= " AND last_login < DATE_SUB(NOW(), INTERVAL 1 YEAR)";
            } else {
                $where .= " AND last_login > DATE_SUB(NOW(), INTERVAL 1 YEAR)";
            }

            if ($branch) {
                $where .= $this->db->branchWhere((int) $branch);
            }

            $phpExcel = new PHPExcel();
            $query = "SELECT (SELECT COUNT(".$table.".id) FROM ".$table." join jm_branches on "
                .$table.".branch_id = jm_branches.id "." WHERE 1 AND gubun = 1 AND ".$table.".is_active = ".$is_active . $where . ") AS total_cnt, "
                .$table. ".". $columns . ", jm_branches.name as branch_name"
                ." FROM " . $table . " join jm_branches on ".$table.".branch_id = jm_branches.id"
                ." WHERE 1 AND gubun = 1 AND ".$table.".is_active = ".$is_active . $where
                ." ORDER BY " .$table. ".id DESC";

            $values = $this->db->get_list($query);

            $phpExcel->setActiveSheetIndex(0);
            $excel_first_columns = $phpExcel->getActiveSheet();

            $excel_column_count = 1;
            foreach(explode(",", $names) as $key => $name) {
                $excel_first_columns = $excel_first_columns->setCellValue($this->excel_column_basic[$key].$excel_column_count, $name);
            }

            $phpExcel->setActiveSheetIndex(0);
            $excel_columns = $phpExcel->getActiveSheet();

            $excel_column_count = 2;
            $cnt_for_negative = 0;
            foreach ($values as $value) {
                $excel_head_count = 0;
                foreach($value as $key => $data ) {
                    if ($key == "total_cnt") {
                        $excel_columns = $excel_columns->setCellValue($this->excel_column_basic[$excel_head_count].$excel_column_count, $data - $cnt_for_negative);
                    }else if ($table == "jm_notices" && $key == "gubun") {
                        $excel_columns = $excel_columns->setCellValue($this->excel_column_basic[$excel_head_count].$excel_column_count, $notice_gubun_reserve_list[$data]);
                    } else {
                        $data = empty($data) ? "-" : $data;
                        $excel_columns = $excel_columns->setCellValue($this->excel_column_basic[$excel_head_count].$excel_column_count, $data);
                    }
                    $excel_head_count++;
                }
                $cnt_for_negative++;
                $excel_column_count++;
            }

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$excel_title.'.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }
	}
?>