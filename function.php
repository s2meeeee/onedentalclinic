<?php 

	//쿠키생성
	function setCookieFn($key,$value,$expire=LOGIN_COOKIE_EXPIRE,$path=LOGIN_COOKIE_PATH,$domain=LOGIN_COOKIE_DOMAIN,$secure=LOGIN_COOKIE_SECURE)
	{	
		return setCooKie($key,$value,$expire,$path,$domain,$secure);
	}

	//select box option 생성
	function setOptionTag($arr,$selected="")
	{
		foreach ($arr as $key => $value)
		{
		?>
		<option value="<?=$key?>" <?=select($key, $selected)?> ><?= $value?></option>
		<?
		}
	}

	//select box option 생성
	function setOptionTagReturn($arr,$selected="")
	{
		$option = "";
		foreach ($arr as $key => $value)
		{
			$option .= '<option value="'.$key.'"'.select($key, $selected).'>'.$value.'</option>';
		}

		return $option;
	}

	//select box 초기화
	function select($value, $controll)
	{
		if(trim($value) === trim($controll))
		{ 
			return "selected=\"selected\" ";
		}
	}

	//check box , radio button 
	function check($value, $controll)
	{
		if(trim($value) === trim($controll))
		{
			return "checked=\"checked\"";
		}
	}

	//말줄임표
	function text_dot($text, $len)
	{
		$text = strip_tags($text);
		if(strlen($text)<=$len) {
			return $text;
		} else {
			$text = htmlspecialchars_decode($text);
			$text = mb_strcut($text, 0, $len, 'utf-8');
			$text = htmlspecialchars($text);
			return $text."…";
		}
	}

    function alert($message) {
        echo "<script>";
        echo "alert('".$message."');";
        echo "</script>";
    }

	function reload() {
		echo "<script>";
		echo "window.location.reload();";
		echo "</script>";
	}

    function close() {
        echo "<script>";
        echo "window.close();";
        echo "</script>";
    }

	function alertReload($message) {
		echo "<script>";
		echo "alert('".$message."');";
		echo "window.location.reload();";
		echo "</script>";
	}

	function alertLocationHref($message, $locationHref) {
		echo "<script>";
		echo "alert('".$message."');";
		echo "window.location.href = '" . $locationHref . "';";
		echo "</script>";
	}

    function goHref($locationHref) {
        echo "<script>";
        echo "window.location.href = '" . $locationHref . "';";
        echo "</script>";
    }

	function alertLocationBack($message) {
		echo "<script>";
		echo "alert('".$message."');";
		echo "window.history.back();";
		echo "</script>";
	}

	//페이징
    function printPaging($total_count, $query_string, $page_variable='page', $lpp=10, $ppp=10)
    {
        parse_str($query_string, $parameter);

        $parameter[$page_variable] = !empty($parameter[$page_variable]) ? $parameter[$page_variable] : 1;
        $total_page = ceil($total_count/$lpp);
        $page_block = ceil($parameter[$page_variable]/$ppp);
        $offset = ( ($page_block-1)*$ppp ) + 1;
        $limit = ($total_page==1) ? $total_page+1 : ($offset+$ppp>$total_page ? $total_page+1 : $offset+$ppp);

        if($total_count>0)
        {
            $curr_page = $parameter[$page_variable];
            $prev_page = $parameter[$page_variable]-1;
            $next_page = $parameter[$page_variable]+1;

            if($prev_page>0)
            {
                $parameter[$page_variable] = $prev_page;
                echo '<a href="'.$_SERVER['PHP_SELF'].'?'.htmlentities(http_build_query($parameter)).'"><img src="/img/board/pre.png" alt="이전으로 가기"></a>';
            }
            else echo '<img src="/img/board/pre.png" alt="이전으로 가기" class="a">';
            for($p=$offset; $p<$limit; $p++)
            {
                $curr = ($curr_page == $p) ? 'class="on"' : '';

                $parameter[$page_variable] = $p;
                echo '<a href="'.$_SERVER['PHP_SELF'].'?'.htmlentities(http_build_query($parameter)).'" '.$curr.'>'.$p.'</a>';

            }
            if($total_page>=$next_page)
            {
                $parameter[$page_variable] = $next_page;
                echo ' <a href="'.$_SERVER['PHP_SELF'].'?'.htmlentities(http_build_query($parameter)).'"><img src="/img/board/next.png" alt="다음으로 가기"></a>';
            }
            else echo ' <img src="/img/board/next.png" alt="다음으로 가기" class="a">';
        }
    }

	//비고페이징
	function printPaging_bigo($total_count, $query_string, $page_variable='page', $lpp=3, $ppp=10)
	{
		parse_str($query_string, $parameter);
		
		$parameter[$page_variable] = !empty($parameter[$page_variable]) ? $parameter[$page_variable] : 1;
		$total_page = ceil($total_count/$lpp);
		$page_block = ceil($parameter[$page_variable]/$ppp);
		$offset = ( ($page_block-1)*$ppp ) + 1;
		$limit = ($total_page==1) ? $total_page+1 : ($offset+$ppp>$total_page ? $total_page+1 : $offset+$ppp);

		if($total_count>0)
		{
			$curr_page = $parameter[$page_variable];
			$prev_page = $parameter[$page_variable]-1;
			$next_page = $parameter[$page_variable]+1;

			if($parameter[$page_variable] > 1)
			{
				$parameter[$page_variable] = 1;
				echo '<a href="'.$_SERVER['PHP_SELF'].'?'.htmlentities(http_build_query($parameter)).'" class="btn-prev-end a"><img src="/images/btn_prev_end.png" alt="첫번째로 가기"></a>';
			}else echo '<img src="/images/btn_prev_end.png" alt="첫번째로 가기" class="a">';

			if($prev_page>0)
			{
				$parameter[$page_variable] = $prev_page;
				echo '<a href="'.$_SERVER['PHP_SELF'].'?'.htmlentities(http_build_query($parameter)).'" class="btn-prev a"><img src="/images/btn_prev.png" alt="이전으로 가기"></a>';
			}
			else echo '<img src="/images/btn_prev.png" alt="이전으로 가기" class="a">';
			echo '<span class="paging">';
			for($p=$offset; $p<$limit; $p++)
			{				
				$curr = ($curr_page == $p) ? 'class="current"' : '';
											
				$parameter[$page_variable] = $p;
				echo '<a href="'.$_SERVER['PHP_SELF'].'?'.htmlentities(http_build_query($parameter)).'" '.$curr.'>'.$p.'</a>';
				
			}
			echo '</span>';
			if($total_page>=$next_page)
			{
				$parameter[$page_variable] = $next_page;
				echo ' <a href="'.$_SERVER['PHP_SELF'].'?'.htmlentities(http_build_query($parameter)).'" class="btn-next-end a"><img src="/images/btn_next.png" alt="다음으로 가기"></a>';
			}
			else echo ' <img src="/images/btn_next.png" alt="다음으로 가기" class="a">';

			if($total_page>=$next_page)
			{
				$parameter[$page_variable] = $total_page;
				echo ' <a href="'.$_SERVER['PHP_SELF'].'?'.htmlentities(http_build_query($parameter)).'" class="btn-next a"><img src="/images/btn_next_end.png" alt="마지막으로 가기"></a>';
			}
			else echo ' <img src="/images/btn_next_end.png" alt="마지막으로 가기" class="a">';
		}
	}

	//템플릿용 페이징
	function printPaging2($total_count,$host, $query_string, $page_variable='page', $lpp=10, $ppp=10)
	{
		parse_str($query_string, $parameter);	
		$parameter[$page_variable] = !empty($parameter[$page_variable]) ? $parameter[$page_variable] : 1;

		$total_page = ceil($total_count/$lpp);
		$page_block = ceil($parameter[$page_variable]/$ppp);
		$offset = ( ($page_block-1)*$ppp ) + 1;
		$limit = ($total_page==1) ? $total_page+1 : ($offset+$ppp>$total_page ? $total_page+1 : $offset+$ppp);

		if($total_count>0)
		{
			$curr_page = $parameter[$page_variable];
			$prev_page = $parameter[$page_variable]-1;
			$next_page = $parameter[$page_variable]+1;

			if($parameter[$page_variable] > 1)
			{
				$parameter[$page_variable] = 1;
				echo '<a href="'.$host.'?'.htmlentities(http_build_query($parameter)).'" class="btn-prev-end a page_arrow" data-page=1><img src="/images/btn_prev_end.png" alt="첫번째로 가기"></a>';
			}else echo '<img src="/images/btn_prev_end.png" alt="첫번째로 가기" class="a">';

			if($prev_page>0)
			{
				$parameter[$page_variable] = $prev_page;
				echo '<a href="'.$host.'?'.htmlentities(http_build_query($parameter)).'" class="btn-prev a page_arrow" data-page="'.$prev_page.'"><img src="/images/btn_prev.png" alt="이전으로 가기"></a>';
			}
			else echo '<img src="/images/btn_prev.png" alt="이전으로 가기" class="a">';
			echo '<span class="paging">';
			for($p=$offset; $p<$limit; $p++)
			{				
				$curr = ($curr_page == $p) ? 'class="current"' : '';
											
				$parameter[$page_variable] = $p;
				echo '<a href="'.$host.'?'.htmlentities(http_build_query($parameter)).'" '.$curr.'>'.$p.'</a>';
				
			}
			echo '</span>';
			if($total_page>=$next_page)
			{
				$parameter[$page_variable] = $next_page;
				echo ' <a href="'.$host.'?'.htmlentities(http_build_query($parameter)).'" class="btn-next-end a page_arrow" data-page="'.$next_page.'"><img src="/images/btn_next.png" alt="다음으로 가기"></a>';
			}
			else echo ' <img src="/images/btn_next.png" alt="다음으로 가기" class="a">';

			if($total_page>=$next_page)
			{
				$parameter[$page_variable] = $total_page;
				echo ' <a href="'.$host.'?'.htmlentities(http_build_query($parameter)).'" class="btn-next a page_arrow" data-page="'.$total_page.'"><img src="/images/btn_next_end.png" alt="마지막으로 가기"></a>';
			}
			else echo ' <img src="/images/btn_next_end.png" alt="마지막으로 가기" class="a">';
		}
	}

	//디렉토리 내 파일 목록구하기
	function filesInDir ($tdir, $ext='') 
	{ 
		if($dh = opendir ($tdir)) { 
		
			$files = Array(); 
			$in_files = Array(); 
			
			while($a_file = readdir ($dh)) { 
				if($a_file[0] != '.') { 

					if(!empty($ext))
					{
						if(strstr($a_file, $ext))
						{
							if(is_dir ($tdir . "/" . $a_file)) { 
								$in_files = filesInDir ($tdir . "/" . $a_file); 
								if(is_array ($in_files)) $files = array_merge ($files , $in_files); 
							} else { 
								array_push ($files ,$a_file); 
							} 
						}
					}
					else
					{
						if(is_dir ($tdir . "/" . $a_file)) { 
							$in_files = filesInDir ($tdir . "/" . $a_file); 
							if(is_array ($in_files)) $files = array_merge ($files , $in_files); 
						} else { 
							array_push ($files ,$a_file); 
						} 						
					}
					
					
				} 
			} 
			
			closedir ($dh); 

			return $files ; 
		} 
	} 

    /*
     * commnt by kjg0904, 2019/06/18
     * desc : 개발서버에서 hosts파일에 박아서 테스트 할 경우에, 웹서버에도 도메인정보를 박아서 테스트를 해야 한다.
     * 즉 웹서버의 /etc/hosts파일에 정보 등록하고, pc내의 hosts파일과 동일하게 정보를 등록하여야 테스트가 된다.
     * 사유 : 웹서버단에서 curl로 정보를 가져오므로
     */
	
	//파일 컨텐츠 복사
	function create_contents($file_url, $copy_file)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $file_url);		
		$data = curl_exec($ch);
		curl_close($ch);	

		
		$f = fopen($copy_file , 'w' ) ; 	
		fwrite($f, stripslashes($data) ); 
		fclose( $f ) ;
	}


	//신규 게시물
	function is_new($date)
	{
		return ($date > date("Y-m-d",strtotime("-1 week", time()))) ? '<span class="new"></span>' : '';
	}

    function array_key_last_7_0_0($array) {
        if (!is_array($array) || empty($array)) {
            return null;
        }

        end($array);
        return key($array);
    }
?>