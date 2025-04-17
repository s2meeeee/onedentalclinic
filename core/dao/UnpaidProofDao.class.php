<?php
	class UnpaidProofDao
	{
		var $db;
        var $board;
        var $result = false;
        var $msg;


		public function __construct()
		{
			$this->db = new MysqlDB();
		}

        public function getList($view_table,$where=null,$page=null,$limit=null)
        {
            $query ="SELECT * FROM ".$view_table
                ." WHERE 1 " . $where . " ORDER BY order_by, order_by_02";

            $start_page = ($page > 1) ? (($page-1)*$limit) : 0;

            $limit_query = "";
            if ($page && $limit) {
                $limit_query = ' limit  '.$start_page.', '.$limit;
            }

            $values = $this->db->get_list($query.$limit_query);

            $total_cnt  = $this->db->get_record('SELECT count(*) as total_cnt FROM ('.$query.') CNT');

            return  array('total_cnt'=>$total_cnt['total_cnt'], 'values'=>$values);
        }

        public function getDetail($view_table, $where)
        {
            return $this->db->get_record("SELECT * FROM ".$view_table.$where);
        }

        public function insert($params)
        {
            if ($this->db->insert('unpaid_proofs',$params['unpaid_proofs'])) {
                $this->result = true;
                $this->msg = "등록이 완료되었습니다.";
            } else {
                $this->msg = "등록이 실패하였습니다.";
            }

            return array('result'=>$this->result, 'msg'=>$this->msg);
        }

        public function update($params, $where)
        {
            if ($this->db->update('unpaid_proofs',$params['unpaid_proofs'], $where)) {
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
	}
?>