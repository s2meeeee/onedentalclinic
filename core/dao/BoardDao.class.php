<?php
	class BoardDao
	{
        var $db;
        var $excel_column_basic;

        public function __construct()
        {
            $this->db = new MysqlDB();
            $this->excel_column_basic = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N"];
        }

        var $result = false;
        var $msg = "";
        public function upload_file($files, $folderName, $filePaths=null)
        {
            $uniqid_file_path = uniqid();
            $path_name = dirname(__FILE__).'/../../upload/' . $folderName . "/".$uniqid_file_path;
            $sub_path_name = dirname(__FILE__).'/../../upload/' . $folderName . "/".$uniqid_file_path;


            $basic_path_name = "/upload/" . $folderName . "/$uniqid_file_path";


            $new_file_arr = [];

            if ($filePaths) {
                $this->update_delete_file($files, $filePaths);
            }

            //사이트 디렉토리 존재 확인
            if(!is_dir($path_name))
            {
                umask(0002);
                mkdir($path_name, 0777, true);
            }

            if(!is_dir($sub_path_name))
            {
                umask(0002);
                mkdir($sub_path_name, 0777, true);
            }



            foreach($files as $key => $file) {
                if ($file['error'] != 0) {
                    $this->result = false;
                    $this->msg = "에러가 발생하였습니다.";
                    return array('result'=>$this->result,'msg'=>$this->msg);
                } else if ($file['size'] > 20 * 1024 * 1024) {
                    $this->result = false;
                    $this->msg = "파일 크기가 20MB를 초과하였습니다..";
                    return array('result'=>$this->result,'msg'=>$this->msg);
                } else {
                    $new_file_name = $file['name'];
                    $new_path_name = $sub_path_name.'/'.$new_file_name;
                    $new_db_path_name = $basic_path_name.'/'.$new_file_name;
                    $new_file_arr[$key] = [$new_file_name, $new_db_path_name];
                    if(!move_uploaded_file($file['tmp_name'], $new_path_name)) {
                        $this->result = false;
                        $this->msg = '파일업로드가 실패하였습니다.';
                        return array('result'=>$this->result,'msg'=>$this->msg);
                    }
                }
            }

            $this->result = true;
            return array('result'=>$this->result, 'files'=>$new_file_arr);
        }

        public function update_delete_file($files, $filePaths)
        {
            foreach($filePaths as $key => $filePath) {
                foreach ($files as $key2 => $file) {
                    if ($key == $key2.'_path') {
                        if (file_exists(dirname(__FILE__).'/../..'.$filePath)) {
                            $dirName = $this->find_file_dir_name($filePath);
                            unlink(dirname(__FILE__).'/../..'.$filePath);
                            if ((count(glob(dirname(__FILE__).'/../..'.$dirName."/*")) === 0)) {
                                rmdir(dirname(__FILE__).'/../..'.$dirName);
                            }
                        }
                    }
                }
            }
        }

        public function delete_file($filePaths)
        {
            foreach($filePaths as $filePath) {
                if (file_exists(dirname(__FILE__).'/../..'.$filePath)) {
                    $dirName = $this->find_file_dir_name($filePath);
                    unlink(dirname(__FILE__).'/../..'.$filePath);
                    if ((count(glob(dirname(__FILE__).'/../..'.$dirName."/*")) === 0)) {
                        rmdir(dirname(__FILE__).'/../..'.$dirName);
                    }
                }
            }
        }

        public function find_file_dir_name($filePath)
        {
            $filepathArray = explode("/", $filePath);
            $dirName = "";
            foreach ($filepathArray as $index => $fpath) {
//                print_r($filepathArray);
                if ($index !== array_key_last_7_0_0($filepathArray)) {
                    $dirName .= $fpath."/";
                }
            }
            return $dirName;
        }

        public function hitUpBoard($view_table, $id)
        {
            $recodrWhere = " WHERE id = ".$id;
            $updateWhere = " id = ".$id;

            $hit = $this->db->get_record("SELECT hit FROM ".$view_table.$recodrWhere)['hit'];
            $params[$view_table]['hit'] = $hit + 1;
            $this->db->update($view_table,$params[$view_table], $updateWhere);
        }

        // 이전/다음 글 가져오기
        public function getBoardPrevNext($view_table,$id, $gubun=null)
        {
            $where = "";
            if ($gubun) {
                $where = " AND gubun = '".$gubun."'";
            }

            $near_board[0] = $this->db->get_record('SELECT * FROM '.$view_table.' WHERE id > '.$id.$where.' ORDER BY id limit 0, 1');

            $near_board[1] = $this->db->get_record('SELECT * FROM '.$view_table.' WHERE id < '.$id.$where.' ORDER BY id desc limit 0, 1');

            return $near_board;
        }

        public function getDoctors($view_table, $department_id)
        {
            $query = "select id, name from " . $view_table . " where department_id = " . $department_id . " AND reserve_active = 'Y'";
            $values = $this->db->get_list($query);
            return $values;
        }

        public function getDepartments($view_table, $where = false)
        {
            $query = "select * from " . $view_table . " WHERE 1 " . $where;
            $values = $this->db->get_list($query);
            return $values;
        }

        public function getDoctorItem($view_table, $id)
        {
            return $this->db->get_record("SELECT * FROM ".$view_table." where id = " . $id);
        }

        public function getDepartmentItem($view_table, $id)
        {
            return $this->db->get_record("SELECT * FROM ".$view_table." where id = " . $id);
        }

        public function getCommentCount($view_table, $column=null, $id)
        {
            $query = "SELECT COUNT(*) as cnt FROM ".$view_table. " WHERE ".$column." = ".$id;
            return $this->db->get_record($query)['cnt'];
        }

        public function getIndexData($view_table, $order_by = false  , $limit = 5)
        {
            if ($order_by) {
                $order_by = " order_top DESC, id DESC";
            } else {
                $order_by = "  id DESC";
            }
            $query ="SELECT * FROM " . $view_table . " ORDER BY " . $order_by;
            $limit_query = ' limit  '. $limit;

            return $this->db->get_list($query.$limit_query);
        }

        public function excel_download($table, $columns, $where, $names, $excel_title, $branch=null)
        {
            ini_set('memory_limit','512M');

            include_once "../lib/PHPExcel/Classes/PHPExcel.php";
            include dirname(__FILE__).'/../../config/defined_list.php';
            if ($branch) {
                $where .= $this->db->branchWhere((int) $branch);
            }

            $phpExcel = new PHPExcel();
            $query = "SELECT " .$table. ".". $columns . ", jm_branches.name as branch_name"
                ." FROM " . $table . " join jm_branches on ".$table.".branch_id = jm_branches.id"
                ." WHERE 1 " . $where
                ." ORDER BY " .$table. ".id DESC";
            

            $values = $this->db->get_list($query);
            $total_cnt  = $this->db->get_record('SELECT count(*) as total_cnt FROM ('.$query.') CNT')['total_cnt'];

            $phpExcel->setActiveSheetIndex(0);
            $excel_first_columns = $phpExcel->getActiveSheet();

            $excel_column_count = 1;
            foreach(explode(",", $names) as $key => $name) {
                $excel_first_columns = $excel_first_columns->setCellValue($this->excel_column_basic[$key].$excel_column_count, $name);
            }

            $phpExcel->setActiveSheetIndex(0);
            $excel_columns = $phpExcel->getActiveSheet();

            $excel_column_count = 2;
            foreach ($values as $value) {
                $excel_head_count = 0;
                foreach($value as $key => $data ) {
                    $excel_columns = $excel_columns->setCellValue($this->excel_column_basic[$excel_head_count].$excel_column_count, $total_cnt);
                    if ($table == "jm_notices" && $key == "gubun") {
                        $excel_columns = $excel_columns->setCellValue($this->excel_column_basic[$excel_head_count].$excel_column_count, $notice_gubun_reserve_list[$data]);
                    } else {
                        $data = empty($data) ? "-" : $data;
                        $excel_columns = $excel_columns->setCellValue($this->excel_column_basic[$excel_head_count].$excel_column_count, $data);
                    }
                    $excel_head_count++;
                }
                $total_cnt--;
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