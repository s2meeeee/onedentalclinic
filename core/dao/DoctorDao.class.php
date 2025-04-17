<?php
	class DoctorDao
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

		public function getList($view_table,$page=null,$limit=null,$where=null, $id=null)
		{
            $order = " ORDER BY order_by, id DESC";

            if ($id) {
                $sub_query =  ", (select title from departments where id = ".$id.") as title";
            }

            $query ="SELECT * ".$sub_query." FROM ".$view_table
					." WHERE 1 " . $where . $order;
//            echo $query;
            if (!empty($page) && !empty($limit)) {
                $start_page = ($page > 1) ? (($page-1)*$limit) : 0;
                $limit_query = ' limit  '.$start_page.', '.$limit;
            }


			$values = $this->db->get_list($query.$limit_query);

			$total_cnt  = $this->db->get_record('SELECT count(*) as total_cnt FROM ('.$query.') CNT');

			return array('total_cnt'=>$total_cnt['total_cnt'], 'values'=>$values);
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
                $params['doctors'][$key.'_name'] = $file[0];
                $params['doctors'][$key.'_path'] = $file[1];
            }

            if ($this->db->insert('doctors',$params['doctors'])) {
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
                $params['doctors'][$key.'_name'] = $file[0];
                $params['doctors'][$key.'_path'] = $file[1];
            }
            if ($this->db->update('doctors',$params['doctors'], $where)) {
                $this->result = true;
                $this->msg = "수정이 완료되었습니다.";
            } else {
                $this->msg = "수정이 실패하였습니다.";
            }

            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function delete($table, $where)
        {
            $this->board->delete_file($this->getFilePaths($where));
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
            if ($this->db->update('doctors',$params['doctors'], $where)) {
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
                                                FROM doctors WHERE".$where);

            foreach($values as $key => $value) {
                if (!empty($value)) {
                    $filePaths[$key] = $value;
                }
            }
            return $filePaths;
        }

        private function getDeleteFilePath($column, $where)
        {
            return $this->db->get_record("SELECT ".$column." FROM doctors WHERE".$where);
        }


	}
?>