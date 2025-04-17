<?php
	class DoctorReserveDao
	{
		var $db;
        var $board;
        var $result = false;
        var $msg;


		public function __construct()
		{
			$this->db = new MysqlDB();
		}

		public function getList($view_table,$page=null,$limit=null,$where=null)
		{
            $query ="SELECT * FROM ".$view_table
					." WHERE 1 " . $where . " ORDER BY id desc";

            if ($page && $limit) {
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

        public function getDoctorReserve($view_table, $weeks, $ymd, $doctor_id)
        {
            if ((int)$weeks === 6 or (int)$weeks === 0) {
                $this->msg = "주말은 예약할수 없습니다.";
                return array('result' => $this->result, 'value' => $this->msg);
                exit;
            }

            $holiday_query = "SELECT title FROM holidays WHERE DATE(holiday) = '$ymd'";

            if ($this->db->get_record($holiday_query)) {
                $this->msg = $this->db->get_record($holiday_query)['title'];
                return array('result' => $this->result, 'value' => $this->msg);
                exit;
            }

            $query = "SELECT reserve, reserve_reason, morning, morning_reason, noon, noon_reason
                        FROM $view_table WHERE doctor_id = $doctor_id
                        AND (DATE(reserve_date) = '$ymd' or DATE(morning_date) = '$ymd' or DATE(noon_date) = '$ymd')";

            if ($this->db->get_record($query)) {
                $this->result = true;
                $this->msg = $this->db->get_record($query);
            }

            if (!$this->result) {
                switch ($weeks) {
                    case 1:
                        $this->result = true;
                        $weeksQuery = $this->getDoctorSchedules("mon_morning", "mon_noon", $doctor_id);
                        $this->msg = $this->db->get_record($weeksQuery);
                        break;
                    case 2:
                        $this->result = true;
                        $weeksQuery = $this->getDoctorSchedules("tue_morning", "tue_noon", $doctor_id);
                        $this->msg = $this->db->get_record($weeksQuery);
                        break;
                    case 3:
                        $this->result = true;
                        $weeksQuery = $this->getDoctorSchedules("wed_morning", "wed_noon", $doctor_id);
                        $this->msg = $this->db->get_record($weeksQuery);
                        break;
                    case 4:
                        $this->result = true;
                        $weeksQuery = $this->getDoctorSchedules("thu_morning", "thu_noon", $doctor_id);
                        $this->msg = $this->db->get_record($weeksQuery);
                        break;
                    case 5:
                        $this->result = true;
                        $weeksQuery = $this->getDoctorSchedules("fri_morning", "fri_noon", $doctor_id);
                        $this->msg = $this->db->get_record($weeksQuery);
                        break;
                }
            }
            return array('result' => $this->result, 'value' => $this->msg);
        }

        public function insert($params)
        {
            if ($this->db->insert('doctor_reserves',$params['doctor_reserves'])) {
                $this->result = true;
                $this->msg = "등록이 완료되었습니다.";
            } else {
                $this->msg = "등록이 실패하였습니다.";
            }

            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function update($params, $where)
        {
            if ($this->db->update('doctor_reserves',$params['doctor_reserves'], $where)) {
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
            if ($this->db->update('doctor_reserves',$params['doctor_reserves'], $where)) {
                $this->result = true;
                $this->msg = "파일삭제가 완료되었습니다.";
            } else {
                $this->msg = "파일삭제가 실패하였습니다.";
            }
            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function weeks($week)
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
//                    return array('result'=>false, 'msg'=>'주말은 예약할 수 없습니다.');
            }
        }

        public function getDoctorSchedules($week_morning, $week_noon, $week_doctor_id) {
            $query = "SELECT
                      CASE
                        WHEN TRIM($week_morning) = '' OR $week_morning IS NULL THEN 'Y'
                        ELSE 'N'
                      END AS morning,
                       CASE
                        WHEN (CASE WHEN TRIM($week_morning) = '' OR $week_morning IS NULL THEN 'Y' ELSE $week_morning END) = 'Y'
                        THEN NULL
                        ELSE $week_morning
                      END AS morning_reason,
                      CASE
                        WHEN TRIM($week_noon) = '' OR $week_noon IS NULL THEN 'Y'
                        ELSE 'N'
                      END AS noon,
                      CASE
                        WHEN (CASE WHEN TRIM($week_noon) = '' OR $week_noon IS NULL THEN 'Y' ELSE $week_noon END) = 'Y'
                        THEN NULL
                        ELSE $week_noon
                      END AS noon_reason,
                      'Y' as reserve, null as reserve_reason
                     FROM doctor_schedules
                    WHERE doctor_id = $week_doctor_id";
            return $query;
        }
	}
?>