<?php
	class DoctorScheduleDao
	{
		var $db;
        var $board;
        var $result = false;
        var $msg;


		public function __construct()
		{
			$this->db = new MysqlDB();
		}

		public function getList($view_table,$page,$limit,$where=null)
		{
            $query ="SELECT * FROM ".$view_table
					." WHERE 1 " . $where . " ORDER BY id DESC";

			$start_page = ($page > 1) ? (($page-1)*$limit) : 0;
			$limit_query = ' limit  '.$start_page.', '.$limit;

			$values = $this->db->get_list($query.$limit_query);

			$total_cnt  = $this->db->get_record('SELECT count(*) as total_cnt FROM ('.$query.') CNT');

			return array('total_cnt'=>$total_cnt['total_cnt'], 'values'=>$values);
		}

        public function getDetail($view_table, $where)
        {
            return $this->db->get_record("SELECT * FROM ".$view_table.$where);
        }

        public function getDoctorSchedules($view_table, $id)
        {
            $query = "SELECT 
                    CASE WHEN mon_morning = '' THEN '월요일 오전' ELSE mon_morning END AS mon_morning,
                    CASE WHEN mon_noon = '' THEN '월요일 오전' ELSE mon_noon END AS mon_noon,
                    CASE WHEN tue_morning = '' THEN '월요일 오전' ELSE tue_morning END AS tue_morning,
                    CASE WHEN tue_noon = '' THEN '월요일 오전' ELSE tue_noon END AS tue_noon,
                    CASE WHEN wed_morning = '' THEN '월요일 오전' ELSE wed_morning END AS wed_morning,
                    CASE WHEN wed_noon = '' THEN '월요일 오전' ELSE wed_noon END AS wed_noon,
                    CASE WHEN thu_morning = '' THEN '월요일 오전' ELSE thu_morning END AS thu_morning,
                    CASE WHEN thu_noon = '' THEN '월요일 오전' ELSE thu_noon END AS thu_noon,
                    CASE WHEN fri_morning = '' THEN '월요일 오전' ELSE fri_morning END AS fri_morning,
                    CASE WHEN fri_noon = '' THEN '월요일 오전' ELSE fri_noon END AS fri_noon
                FROM ".$view_table;
            return $this->db->get_record($query." where doctor_id = " . $id);
        }

        public function getDoctorReserveSchedules($view_table, $doctor_id, $weeks)
        {
            $week = $this->weeks($weeks);

            if (!$week) {
                return array('result' => false);
            }

            $query = "select $week[0] as morning , $week[1] as noon from $view_table where doctor_id = $doctor_id";

            if ($this->db->get_record($query)) {
                $this->result = true;
            }
            return array('result' => $this->result, 'value' => $this->db->get_record($query));
        }

        public function insert($table, $where, $params)
        {
            $this->db->delete($table, $where);
            if ($this->db->insert('doctor_schedules',$params['doctor_schedules'])) {
                $this->result = true;
                $this->msg = "등록이 완료되었습니다.";
            } else {
                $this->msg = "등록이 실패하였습니다.";
            }

            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function update($params, $where)
        {
            if ($this->db->update('doctor_schedules',$params['doctor_schedules'], $where)) {
                $this->result = true;
                $this->msg = "수정이 완료되었습니다.";
            } else {
                $this->msg = "수정이 실패하였습니다.";
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
            if ($this->db->update('doctor_schedules',$params['doctor_schedules'], $where)) {
                $this->result = true;
                $this->msg = "파일삭제가 완료되었습니다.";
            } else {
                $this->msg = "파일삭제가 실패하였습니다.";
            }
            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        private function weeks($week)
        {
            switch ($week) {
                case 1:
                    return array('mon_morning', 'mon_noon');
                case 2:
                    return array('tue_morning', 'tue_noon');
                case 3:
                    return array('wed_morning', 'wed_noon');
                case 4:
                    return array('thu_morning', 'thu_noon');
                case 5:
                    return array('fri_morning', 'fri_noon');
//                default:
//                    return array('result'=>false);
            }
        }
	}
?>