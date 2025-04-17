<?php
	class FastConsultDao
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
            $name = $params['fast_consults']['name'];
            $phone = $params['fast_consults']['phone'];
            $pain_area = $params['fast_consults']['pain_area'];
            $selectWhere = "WHERE `name` = '$name' AND `phone` = '$phone' AND `pain_area` = '$pain_area'";
            $selectWhere .= " AND created_at >= DATE_SUB(NOW(), INTERVAL 5 SECOND)";
            $selectSql = "SELECT COUNT(*) cnt FROM `fast_consults` ".$selectWhere;
            if ($this->db->get_record($selectSql)['cnt'] < 1) {
                if ($this->db->insert('fast_consults', $params['fast_consults'])) {
                    $this->bonaoamCRMInsert($params);
                    $this->result = true;
                    $this->msg = "등록이 완료되었습니다.";
                } else {
                    $this->result = false;
                    $this->msg = "등록이 실패하였습니다.";
                }
            }
            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function update($params, $files=null, $folderName=null, $where)
        {
            if ($this->db->update('fast_consults',$params['fast_consults'], $where)) {
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

        private function bonaoamCRMInsert($params)
        {
            $header_data = [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Token da6c89ef-5c37-4806-bd23-d8e794dd05cf'
            ];

            $fast_consults = $params['fast_consults'];
            $customer = $fast_consults['name'];
            $telePhone = $fast_consults['phone'];
            $question = $fast_consults['pain_area'];

            $url = 'http://bonaoam.cloudcc.co.kr/WebCallback/api/submit';

            $data = "TenantPrefix=MDH&Customer=$customer&TelePhone=$telePhone&Question=$question";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);


            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_exec ($ch);
        }
	}
?>