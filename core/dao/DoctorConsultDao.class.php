<?php
	class DoctorConsultDao
	{
		var $db;
        var $board;
        var $result = false;
        var $msg;


		public function __construct()
		{
			$this->db = new MysqlDB();
			$this->board = new BoardDao();
		}

		public function getList($view_table,$page,$limit,$where=null)
		{
            $query ="SELECT * FROM ".$view_table
					." WHERE 1 " . $where . " ORDER BY id DESC";

			$start_page = ($page > 1) ? (($page-1)*$limit) : 0;
			$limit_query = ' limit  '.$start_page.', '.$limit;

			$values = $this->db->get_list($query.$limit_query);

			$total_cnt  = $this->db->get_record('SELECT count(*) as total_cnt FROM ('.$query.') CNT');

			return  array('total_cnt'=>$total_cnt['total_cnt'], 'values'=>$values);
		}

        public function getDetail($view_table, $where)
        {
            return $this->db->get_record("SELECT * FROM ".$view_table.$where);
        }

        public function insert($params, $files, $folderName)
        {
            $fileUploadResult = $this->board->upload_file($files, $folderName);

            if (!$fileUploadResult['result']) {
                return $fileUploadResult;
            }

            foreach ($fileUploadResult['files'] as $key => $file) {
                $params['doctor_consults'][$key.'_name'] = $file[0];
                $params['doctor_consults'][$key.'_path'] = $file[1];
            }
            if (!empty($params['doctor_consults']['password'])) {
                $params['doctor_consults']['password'] = password_hash($params['doctor_consults']['password'], PASSWORD_DEFAULT);
            }

            if ($this->db->insert('doctor_consults',$params['doctor_consults'])) {
                $this->result = true;
                $this->msg = "등록이 완료되었습니다.";
            } else {
                $this->msg = "등록이 실패하였습니다.";
            }

            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function update($params, $files, $folderName, $where)
        {
            $filePaths = $this->getFilePaths($where);

            $fileUploadResult = $this->board->upload_file($files, $folderName, $filePaths);

            if (!$fileUploadResult['result']) {
                return $fileUploadResult;
            }

            foreach ($fileUploadResult['files'] as $key => $file) {
                $params['doctor_consults'][$key.'_name'] = $file[0];
                $params['doctor_consults'][$key.'_path'] = $file[1];
            }

            if (!empty($params['doctor_consults']['password'])) {
                $params['doctor_consults']['password'] = password_hash($params['doctor_consults']['password'], PASSWORD_DEFAULT);
            }

            if ($this->db->update('doctor_consults',$params['doctor_consults'], $where)) {
                $this->result = true;
                $this->msg = "수정이 완료되었습니다.";
            } else {
                $this->msg = "수정이 실패하였습니다.";
            }

            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function consult_check($params)
        {
            $query = "SELECT password FROM doctor_consults
                        WHERE id = ".$params['doctor_consults']['id'];
            if($array = $this->db->get_record($query)) {
                // 2. 패스워드 검증
                if (!password_verify($params['doctor_consults']['password'], $array['password'])) {
                    $this->result = false; //로그인 성공여부 (0:실패, 1:성공)
                    $this->msg = '비밀번호가 일치하지 않습니다.';
                } else {
                    $str=rand();
                    $result = sha1($str);
                    session_start();
                    $_SESSION['specialist' .$params['doctor_consults']['id'] ] = $result;
                    setcookie("specialist" .$params['doctor_consults']['id'] , $result, time() + 60 * 20, "/");
                    $this->result = true; //로그인 성공여부 (0:실패, 1:성공)
                }
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

        public function delete_file($params, $column, $where)
        {
            $this->board->delete_file($this->getDeleteFilePath($column.'_path', $where));
            if ($this->db->update('doctor_consults',$params['doctor_consults'], $where)) {
                $this->result = true;
                $this->msg = "파일삭제가 완료되었습니다.";
            } else {
                $this->msg = "파일삭제가 실패하였습니다.";
            }
            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        private function getFilePaths($where)
        {
            $filePaths = [];
            $values = $this->db->get_record("SELECT file_01_path
                                                FROM doctor_consults WHERE".$where);

            foreach($values as $key => $value) {
                if (!empty($value)) {
                    $filePaths[$key] = $value;
                }
            }
            return $filePaths;
        }

        private function getDeleteFilePath($column, $where)
        {
            return $this->db->get_record("SELECT ".$column." FROM doctor_consults WHERE".$where);
        }
	}
?>