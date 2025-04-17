<?php
/**
 * Author: yg
 * Date: 2019-09-30
 *
 * Mysql DB DataAccess for PHP5(Mysqli)
 */

class MysqlDB
{
    public $connection_info = array('choyosan1'=>array('hostname'=>'localhost', 'username'=>'choyosan1', 'password'=>'1fighter',
        'database'=>'choyosan1'));
	public $con=null;
	public $prepared_con = null;
	public $result = null;
	public $num_rows = 0;
	public $error_msg = null;
	public $insert_id = null;
	public $transaction = false;

	//public function __construct(){}

	// Destructor: Clean up
	public function __destruct()
	{
		$this->db_close();
	}

	/**
	 * @brief throw_error(): Print an error message
	 * @param string $message   A descriptive error message that will print when invoked
	 */
	private function throw_error($message, $line = 0)
	{
		$this->error_msg = 'There was an error on line' . $line .' in class "' . __CLASS__ . '": ' . $message;
		$line = ( !empty($line) ) ? $line = ' on line ' . $line : '' ;
		$this->email_error($this->error_msg, $message);
		die ($this->error_msg);
		if($this->con!=null && !empty($this->con)) $this->db_close();
	}

	public function error_message()
	{
		return $this->error_msg;
	}

	public function transaction_start()
	{
		$this->connect();
		mysqli_autocommit($this->con, FALSE);
		$this->transaction = true;
	}

	public function transaction_end()
	{
		$flag = false;
		if($this->error_msg==null)
		{
			$flag = mysqli_commit($this->con);
		}
		else
		{
			mysqli_rollback($this->con);
		}

		mysqli_autocommit($this->con, TRUE);
		$this->transaction = false;
		$this->db_close();

		return $flag;
	}

	// DB connection
	protected function connect($sid='choyosan1')
	{
		$this->con = mysqli_connect($this->connection_info[$sid]['hostname'], $this->connection_info[$sid]['username'], $this->connection_info[$sid]['password']) or $this->throw_error(mysqli_error($con), __LINE__);
		mysqli_query($this->con,"SET NAMES 'utf8'");
		$this->selectdb($this->connection_info[$sid]['database']);
	}

	protected function prepared_connect($sid='choyosan1')
	{
		$this->prepared_con = new mysqli($this->connection_info[$sid]['hostname'], $this->connection_info[$sid]['username'], $this->connection_info[$sid]['password'], $this->connection_info[$sid]['database']);
	}

	// DB select
	protected function selectdb($database)
	{
		mysqli_select_db($this->con, $database) or $this->throw_error(mysqli_error($this->con), __LINE__);
	}

	// close_connection(): Close connection to MySQL
	public function db_close()
	{
		if(!empty($this->con) && $this->con!=null) @mysqli_close($this->con);
		if(!empty($this->prepared_con) && $this->prepared_con!=null) @$this->prepared_con->close();
	}

	// return mysqli_insert_id
	public function get_insert_id()
	{
		return $this->insert_id;
	}

	public function get_page_info($sql, $where=null, $page=1, $lpp=10, $ppp=10)
	{
		$page = (strlen($page) && $page > 1) ? $page : 1;
		$lpp = (strlen($lpp) && $lpp > 1) ? $lpp : 10;
		$ppp = (strlen($ppp) && $ppp > 1) ? $ppp : 10;

		$sql = preg_replace('/select.*from/ism', 'SELECT COUNT(*) AS total FROM', $sql);

		$this->query($sql, $where);
		$row = mysqli_fetch_assoc($this->result);

		// Calc page_info
		$total_count = $row['total'];
		$total_page  = ceil($total_count / $lpp);

		$start_page  = floor(($page-1) / $ppp) * $ppp + 1; // start page number of current paging
		$end_page    = ($start_page-1 + $ppp < $total_page) ? $start_page-1 + $ppp : $total_page; // end page number of current paging

		$page_info = array();
		$page_info['total_page']    = $total_page;  // Total page
		$page_info['start_page']    = $start_page;  // start page number of current paging
		$page_info['end_page']      = $end_page;    // end page number of current paging
		$page_info['page']          = $page;        // current page
		$page_info['total_count']   = $total_count; // Total count
		$page_info['line_per_page'] = $lpp;         // line per page
		$page_info['page_per_pages'] = $ppp;        // page per pages

		return $page_info;
	}

	public function get_record($sql, $where=null, $operand='')
	{
		$this->query($sql, $where, $operand);
		return mysqli_fetch_assoc($this->result);
	}

	public function get_list($sql, $where=null, $operand='')
	{
		$this->query($sql, $where, $operand);
		$this->num_rows = mysqli_num_rows($this->result);
		$result = array();
		while ($row = mysqli_fetch_assoc($this->result))
		{
			array_push($result, $row);
		}
								 
		return $result;
	}

	public function insert_into($insert_query)
	{
		$result = array();
		if(!$this->transaction) $this->connect();
			$result = mysqli_query($this->con, $insert_query);
		if(!$this->transaction) $this->db_close();

		return $result; 
	}

	/**
	 * @brief insert(): Insert data into a table
	 * @param string $table Table to insert into
	 * @param array $data   The healthColumn name & data
	 * @param boolean $slashes True if you want to add 's to the string
	 * @return boolean True if successful, false if not.
	 */
	public function insert($table, $data, $slashes = false)
	{
		if ( $table == '' || $data == '' ) { return; }

		$fields = '';
		$values = '';
	
		$result = array();
		foreach($data as $key => $val)
		{
			$fields .= '`' . $key . '`, ';
			$val = ( $slashes == true ) ? addslashes($val) : $val;
			$values .= "'" . addslashes( stripslashes($val) ) . "'" . ', ';
		}

		$fields = preg_replace( "/, $/" , "" , $fields);
		$values = preg_replace( "/, $/" , "" , $values);

		if(!$this->transaction) $this->connect();

//        echo 'INSERT INTO `' . $table . '` (' . $fields . ') VALUES (' . $values . ')';
//        exit;
		$result = mysqli_query($this->con, 'INSERT INTO `' . $table . '` (' . $fields . ') VALUES (' . $values . ')') or $this->throw_error(mysqli_error($this->con).', Query: '.'INSERT INTO `' . $table . '` (' . $fields . ') VALUES (' . $values . ')', __LINE__);
		$this->insert_id = mysqli_insert_id($this->con);
		if(!$this->transaction) $this->db_close();

		//$result['insert_id'] = $this->insert_id;
		return $result;
	}

	/**
	 * @brief update(): Update data into a table
	 * @param string $table Table to insert into
	 * @param array $data   The healthColumn name & data
	 * @param multi $operand    operand => value
	 * @param boolean $slashes True if you want to add 's to the string
	 * @return boolean True if successful, false if not.
	 */
	public function update($table, $data, $where, $operand = '', $slashes = false)
	{
		if ( $table == '' || $data == '' || $where == '') { return; }

		$update_phrase  = '';
		$tmp = '';

		if(is_array($data))
		{			
			foreach($data as $key => $val)
			{
				$update_phrase .= '`' . $key . "` = '" . $this->escape_str($val) . "', ";
			}
		}
		else $update_phrase = $data;
		$update_phrase = preg_replace( "/, $/" , "" , $update_phrase);
		$where = $this->get_where_phrase('', $where, $operand);
//        echo 'UPDATE `' . $table . '` SET ' . $update_phrase . $where;
//        exit;
		if(!$this->transaction) $this->connect();

		$result = mysqli_query($this->con, 'UPDATE `' . $table . '` SET ' . $update_phrase . $where) or $this->throw_error(mysqli_error($this->con).', Query: '.'UPDATE `' . $table . '` SET ' . $update_phrase . $where, __LINE__);
		if(!$this->transaction) $this->db_close();
		return $result;
	}

	// join 업데이트 할때는 `테이블 A JOIN 테이블 B ON A.ID = B.ID`할 경우 오류가 생겨서 JOIN UPDATE 함수 하나 만들었다.
	public function join_update($table, $data, $where, $operand = '', $slashes = false)
	{
		if ( $table == '' || $data == '' || $where == '') { return; }

		$update_phrase  = '';
		$tmp = '';
		
		
		if(is_array($data))
		{			
			foreach($data as $key => $val)
			{
				$update_phrase .= '' . $key . " = '" . $this->escape_str($val) . "', ";
			}
		}
		else $update_phrase = $data;
		$update_phrase = preg_replace( "/, $/" , "" , $update_phrase);
		$where = $this->get_where_phrase('', $where, $operand);

	
		if(!$this->transaction) $this->connect();
		$result = mysqli_query($this->con, 'UPDATE ' . $table . ' SET ' . $update_phrase . $where) or $this->throw_error(mysqli_error($this->con).', Query: '.'UPDATE ' . $table . ' SET ' . $update_phrase . $where, __LINE__);
		if(!$this->transaction) $this->db_close();
		return $result;
	}

	public function update_into($update_query)
	{
		$result = array();
		if(!$this->transaction) $this->connect();
			$result = mysqli_query($this->con, $update_query) or $this->throw_error(mysqli_error($this->con), __LINE__);
		if(!$this->transaction) $this->db_close();

		return $result; 
	}

	/**
	 * @brief delete(): Delete a row from a table
	 * @param string $table Table to insert into
	 * @param array $data   The healthColumn name & data
	 * @return Result
	 */
	public function delete($table, $where='', $operand = '')
	{
		if ( $table == '' || $where == '') { return; }

		if(is_array($where))
		{
			$tmp = '';
			$i = 0;
			foreach ($where as $key => $val)
			{
				if($i>0) $tmp .= $operand[$i-1].' ';
				$tmp .= '`' . $key . "` = '" . $this->escape_str($val). "' ";
				$i++;
			}
			$where = preg_replace( "/ $operand $/" , "" , $tmp);
		}

		if(!$this->transaction) $this->connect();
		$result = mysqli_query($this->con, 'DELETE FROM `' . $table . '` WHERE ' . $where) or $this->throw_error(mysqli_error($this->con).' SQL:'.'DELETE FROM `' . $table . '` WHERE ' . $where, __LINE__);

		if(!$this->transaction) $this->db_close();

		return $result;
	}


	/**
	 * @brief select(): Select a row or rows from the DB
	 * @param string $sql DML of DB
	 * @param array $where      where option
	 * @param multi $operand    operand => value
	 * @param int $page
	 * @param int $lpp
	 * @param int $ppp
	 * @return MySQL resource
	 */
	protected function select($sql, $where=null, $operand='', $page=null, $lpp=10, $ppp=10)
	{
		/*
		if ( $sql == '') { return; }

		$limit = '';
		$_is_paging = $page!=null;
		if($_is_paging)
		{
			$page_info = $this->page_info($sql, $where, $page, $lpp, $ppp);

			$start_num = ($page-1) * $lpp; // start number to get list
			$end_num   = $start_num + $lpp <= $page_info['total_count'] ? $start_num + $lpp : $page_info['total_count'];

			$limit = ($page!=null) ? ' limit '.$start_num.', '.$end_num : '';
		}

		$this->result = $this->query($sql . $limit, $where, $operand);

		if(strpos($sql, '?')===false) $this->set_resultset($page);
		if($_is_paging)
		{
			$page_result['page_info'] = $page_info;
			$page_result['data'] = $result;
			$result = $page_result;
			unset($page_result);
		}
		*/
	}

	/**
	 * @param string $sql       Table to insert into
	 * @param multi $where      The healthColumn name & where
	 * @param multi $operand    operand => value
	 * @return result from DB resources.
	 */
	protected function query($sql, $where='', $operand = '')
	{
		if(!$this->transaction) $this->connect();

		// Set up the WHERE
		$where = $this->get_where_phrase($sql, $where, $operand);

		$this->result = mysqli_query($this->con, $sql . $where) or $this->throw_error(mysqli_error($this->con).', SQL: '.$sql.$where, __LINE__);
	   if(!$this->transaction) $this->db_close();
		/*
		if(strpos($sql, '?')===false)
		{
			$this->connect();

			// Set up the WHERE
			$where = $this->get_where_phrase($sql, $where, $operand);

			$result = mysqli_query($this->con, $sql . $where) or $this->throw_error(mysqli_error($this->con).', SQL: '.$sql.$where, __LINE__);
		}
		else
		{
			// prepared statement
			$this->prepared_connect();

			$stmt = $mysqli->stmt_init();
			$stmt->prepare($sql);
			call_user_func_array(array($stmt, 'bind_param'), $this->ref_values($data));

			$stmt->execute() or $this->throw_error(mysqli_error($this->con).', SQL: '.$sql, __LINE__);
			$res = $stmt->get_result();
			while($row = $res->fetch_array(MYSQLI_ASSOC)) {
				array_push($temp_array, $row);
			}
			$this->result = $tmp_array;

			$stmt->close();
		}
		$this->db_close();

		return $result;
		*/
	}

	protected function get_where_phrase($sql, $where, $operand)
	{
		
		if(is_array($where))
		{	
			$tmp = '';
			$i = 0;
			foreach ($where as $key => $val)
			{
				if($i>0) $tmp .= $operand[$i-1].' ';
				$tmp .= '`' . $key . "` = '" . $this->escape_str($val). "' ";
				$i++;
			}
			$where_phrase = ' '.$this->get_operand($sql).' ' . preg_replace( "/ $operand $/" , "" , $tmp);
		}
		else
		{
			$where_phrase = strlen($where) ? ' '.$this->get_operand($sql).' ' . $where : '';
		}
		return $where_phrase;
	}

   protected function escape_str($string)
	{
		if ( is_array($string) )
		{
			foreach($string as $key => $val)
			{
				$str[$key] = $this->escape_str($val);
			}
			return $str;
		}

		if ( function_exists('mysql_escape_string') )
		{
			return mysql_escape_string( stripslashes($string) );
		}
		else
		{
			return addslashes( stripslashes($string) );
		}
	}

	protected function get_operand($sql, $operand='AND')
	{
		return strpos(strtoupper($sql), 'WHERE')===false ? 'WHERE' : $operand;
	}

	protected function ref_values($arr)
	{
		if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
		{
			$refs = array();
			foreach($arr as $key => $value)
				$refs[$key] = &$arr[$key];
			return $refs;
		}
		return $arr;
	}

    public function branchWhere($branch)
    {
        if (gettype($branch) == 'integer') {
            return " AND branch_id = ". $branch;
        } else if (gettype($branch) == 'string') {
            return " AND jm_branches.name_en = '". $branch."'";
        }
    }

    public function getPassword($value)
    {
        $sql ="SELECT PASSWORD('$value') as password";
        $this->query($sql);
        return mysqli_fetch_assoc($this->result)['password'];
    }
}
?>