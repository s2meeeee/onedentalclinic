<?php
	class PreviewDao
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
					." WHERE 1 " . $where . " ORDER BY order_top DESC, id DESC";

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
                $params[$folderName][$key.'_name'] = $file[0];
                $params[$folderName][$key.'_path'] = $file[1];
            }

            if ($this->db->insert($folderName,$params[$folderName])) {
                $this->result = true;
                $this->msg = "등록이 완료되었습니다.";
            } else {
                $this->msg = "등록이 실패하였습니다.";
            }

            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function update($params, $files, $folderName, $where)
        {
            $filePaths = $this->getFilePaths($where, $folderName);

            $fileUploadResult = $this->board->upload_file($files, $folderName, $filePaths);

            if (!$fileUploadResult['result']) {
                return $fileUploadResult;
            }
            foreach ($fileUploadResult['files'] as $key => $file) {
                $params[$folderName][$key.'_name'] = $file[0];
                $params[$folderName][$key.'_path'] = $file[1];
            }
            if ($this->db->update($folderName,$params[$folderName], $where)) {
                $this->result = true;
                $this->msg = "수정이 완료되었습니다.";
            } else {
                $this->msg = "수정이 실패하였습니다.";
            }

            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function delete($table, $where)
        {
            $this->board->delete_file($this->getFilePaths($where, $table));
            if ($this->db->delete($table, $where)) {
                $this->result = true;
                $this->msg = "삭제가 완료되었습니다.";
            } else {
                $this->msg = "삭제가 실패하였습니다.";
            }
            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function delete_file($params, $column, $where, $tableName)
        {
            $this->board->delete_file($this->getDeleteFilePath($column.'_path', $where, $tableName));
            if ($this->db->update($tableName,$params[$tableName], $where)) {
                $this->result = true;
                $this->msg = "파일삭제가 완료되었습니다.";
            } else {
                $this->msg = "파일삭제가 실패하였습니다.";
            }
            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        private function getFilePaths($where , $tableName)
        {
            $filePaths = [];
            $values = $this->db->get_record("SELECT file_01_path, file_02_path, file_03_path, file_04_path
                                                ,file_05_path ,file_06_path ,file_07_path ,file_08_path
                                                ,file_09_path ,file_10_path
                                                FROM ".$tableName." WHERE".$where);

            foreach($values as $key => $value) {
                if (!empty($value)) {
                    $filePaths[$key] = $value;
                }
            }
            return $filePaths;
        }

        private function getDeleteFilePath($column, $where, $tableName)
        {
            return $this->db->get_record("SELECT ".$column." FROM ".$tableName." WHERE".$where);
        }
	}
?>