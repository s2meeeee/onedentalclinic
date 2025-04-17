<?php
	class LoginDao
	{
		var $db;

		public function __construct()
		{
			$this->db = new MysqlDB();
		}

		//로그인
		public function login($params)
		{
			// 1. 회원 DB에서 회원 정보조회
			$query = "SELECT password FROM users WHERE identity = '".$params['identity']."' AND is_active = 'active'";
			if($array = $this->db->get_record($query)) {
				// 2. 패스워드 검증 
				if (!password_verify($params['password'], $array['password'])) {
					$response['result'] = false; //로그인 성공여부 (0:실패, 1:성공)
					$response['msg'] = '비밀번호가 일치하지 않습니다.';
				} else {
					// 3. 쿠키에 담을 회원 정보 조회
					$query2 = "SELECT identity, gubun FROM users WHERE identity = '".$params['identity']."'  AND is_active = 'active'";
	
					$row = $this->db->get_record($query2);
                    session_start();
                    $_SESSION['identity'] = $row['identity'];
                    $_SESSION['gubun'] = $row['gubun'];

                    $response['result'] = true;
                    $response['gubun'] = $row['gubun'];
				}	// step2 if end
			} else {
				$response['result'] = false; //로그인 성공여부 (0:실패, 1:성공)
				$response['msg'] = '등록된 ID가 없습니다 다시확인하시고 로그인해주세요.';
			}	// step1 if end
			// 5. 로그인 히스토리 저장
//			$history_arr = array();
//			$history_arr['access_id']	= !empty($params['login_id']) ? $params['login_id'] : '';
//			$history_arr['access_ip']	= !empty($params['login_ip']) ? $params['login_ip'] : '';
//			$history_arr['access_time'] = date("Y-m-d H:i:s");
//			$history_arr['access_agent']= $_SERVER['HTTP_USER_AGENT'];
//			$history_arr['result'] 		= $response['result'];
//			$history_arr['msg'] 		= $response['msg'];
//
//			$this->db->insert('EZ_LOGIN_LOG',$history_arr);
		
			return $response;
		}

        public function loginInfo($identity)
        {
            $query = "SELECT id, identity, name, email, phone, birthday, gender, sns_yn, gubun
                        FROM users WHERE identity = '".$identity."'  AND is_active = 'active'";
            return $this->db->get_record($query);
        }

		//쿠키 삭제
		public function log_out()
		{
            session_start();
			session_destroy();
			$response['msg'] = '로그아웃이 되었습니다.';
			return $response;
		}

        public function updateCountUpNumbers() {
            $query = "SELECT * FROM count_up_numbers WHERE DATE(daily_date_checked) = CURDATE() - INTERVAL 1 DAY";
            $result = $this->db->get_record($query);
            if (!empty($result)) {
                $therapyRandomNumber = rand(10, 21) + $result['therapy'];
                $implantRandomNumber = rand(40, 61) + $result['implant'];
                $daily_date_checked_now = date("Y-m-d H:i:s");
                $params['popups']['therapy'] = $therapyRandomNumber;
                $params['popups']['implant'] = $implantRandomNumber;
                $params['popups']['daily_date_checked'] = $daily_date_checked_now;
                $where = " id = 1";
                $this->db->update('count_up_numbers',$params['popups'], $where);
            }
        }
	}
?>