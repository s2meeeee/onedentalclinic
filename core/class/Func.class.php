<?php
	/** 
	 * @author eunsik(eunsik@interactivy.com)
	 * @date 2013-12-03
	 *
	 * 일반적인 Utilities 클래스
	 */

	class Func
	{
		// 다중 배열내 특정 배열값 찾기
		function multidimensional_search($parents, $searched)
		{
			if (empty($searched) || empty($parents))
			{
				return false;
			}

			foreach ($parents as $key => $value)
			{
				$exists = true;
				foreach ($searched as $skey => $svalue)
				{
					$exists = ($exists && isset($parents[$key][$skey]) && $parents[$key][$skey] == $svalue);
				}
				if($exists)
				{
					return $key;
				}
			}

			return false;
		}

		function in_array_field($needle, $needle_field, $haystack)
		{

			foreach ($haystack as $i=>$item)
			{
				foreach($item[$needle_field] as $val)
				{
					if($val==$needle) return array('idx'=>$i, 'result'=>true);
				}
			}

			return array('idx'=>null, 'result'=>false);
		}
		function in_array_data($needle, $needle_field, $haystack, $strict = false)
		{

			foreach ($haystack as $i=>$item)
			{
				if($item[$needle_field]==$needle) return array('idx'=>$i, 'result'=>true);
			}

			return array('idx'=>null, 'result'=>false);
		}

		function in_array_field_data($needle, $needle_field, $haystack, $strict = false)
		{
			if ($strict)
			{
				foreach ($haystack as $i=>$item)
				{
					if (isset($item->$needle_field) && $item->$needle_field === $needle)
					{
						return array('idx'=>$i, 'result'=>true);
					}
				}
			}
			else
			{
				foreach ($haystack as $i=>$item)
					if (isset($item->$needle_field) && $item->$needle_field == $needle)
						return array('idx'=>$i, 'result'=>true);
			}

			return array('idx'=>null, 'result'=>false);
		}

		/**
		 * 페이지 네비를 바로 출력
		 * $page_info : array, 페이지 관련 정보
		 * $query_string : string, 현재 페이지 $_SEVER['QUERY_STRING']
		 * $ppp : Number, pages per page 현 페이지에 출력할 페이징 수
		 */
		public function printPaging($page_info, $query_string, $page_variable='page')
		{
			parse_str($query_string, $page_out);
			$page_out[$page_variable] = !empty($page_out[$page_variable]) ? $page_out[$page_variable] : 1;
			$ppp = strlen($page_info['pagesPerPage']) ? $page_info['pagesPerPage'] : 10;
			$total_page_block	= ceil($page_info['totalPage']/$ppp);
			$page_block			= ceil($page_info['endPage']/$ppp);

			if($page_block > 1)
			{
				$page_out[$page_variable] = $page_info['startPage']-1;
				echo '
					<a href="'.$_SERVER['PHP_SELF'].'?'.htmlentities(http_build_query($page_out)).'">이전</a>&nbsp;';

				$page_out[$page_variable] = 1;
				echo '
					<a href="'.$_SERVER['PHP_SELF'].'?'.htmlentities(http_build_query($page_out)).'">1</a>&nbsp;...&nbsp;';
			}

			for($i=$page_info['startPage']; $i<=$page_info['endPage']; $i++)
			{
				if($page_info[$page_variable]==$i)
				{
					echo '
					<strong>'.$i.'</strong> &nbsp;';
				}
				else
				{
					$page_out[$page_variable] = $i;
					echo '
					<a href="'.$_SERVER['PHP_SELF'].'?'.htmlentities(http_build_query($page_out)).'">'.$i.'</a> &nbsp;';
				}
			}

			if($total_page_block > $page_block)
			{
				$page_out[$page_variable] = $page_info['totalPage'];
				echo '...&nbsp; <a href="'.$_SERVER['PHP_SELF'].'?'.htmlentities(http_build_query($page_out)).'">'.$page_info['totalPage'].'</a>';
				$page_out[$page_variable] = $page_info['endPage'] + 1;
				echo '
					&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?'.htmlentities(http_build_query($page_out)).'">다음</a>';
			}

			if (!$page_info['totalPage']) {
				echo '<strong>1</strong>';
			}
		}

		/**
		 * userAgent를 활용하여 사용자의 Browser 정보 추출
		 */
		function getBrowser()
		{
			$u_agent = $_SERVER['HTTP_USER_AGENT'];
			$bname = 'Unknown';
			$platform = 'Unknown';
			$version= "";

			// OS(Platform)정보 추출
			if (preg_match('/linux/i', $u_agent)){ $platform = 'linux'; }
			elseif (preg_match('/macintosh|mac os x/i', $u_agent)){ $platform = 'mac'; }
			elseif (preg_match('/windows|win32/i', $u_agent)){ $platform = 'windows'; }

			// 브라우저 정보 추출
			if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
			{
				$bname = 'Internet Explorer';
				$ub = "MSIE";
			}
			elseif(preg_match('/Firefox/i',$u_agent))
			{
				$bname = 'Mozilla Firefox';
				$ub = "Firefox";
			}
			elseif(preg_match('/Chrome/i',$u_agent))
			{
				$bname = 'Google Chrome';
				$ub = "Chrome";
			}
			elseif(preg_match('/Safari/i',$u_agent))
			{
				$bname = 'Apple Safari';
				$ub = "Safari";
			}
			elseif(preg_match('/Opera/i',$u_agent))
			{
				$bname = 'Opera';
				$ub = "Opera";
			}
			elseif(preg_match('/Netscape/i',$u_agent))
			{
				$bname = 'Netscape';
				$ub = "Netscape";
			}

			// version 번호 추출
			$known = array('Version', $ub, 'other');
			$pattern = '#(?<browser>'.join('|', $known).')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
			if (!preg_match_all($pattern, $u_agent, $matches)) {
				// version 번호 없음.  just continue
			}

			$i = count($matches['browser']);
			if ($i != 1)
			{
				if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){ $version= $matches['version'][0]; }
				else { $version= $matches['version'][1]; }
			}
			else { $version= $matches['version'][0]; }

			if ($version==null || $version==""){ $version="?"; }
			return array(
			'agent' => $u_agent,
			'os' => $platform,
			'browser' => $bname,
			'browser_ver' => $version
			);
		}

		// 문자열내 한글 포함 여부 확인
		function includeHangul($str)
		{
			$cnt = strlen($str);
			for($i=0; $i<$cnt; $i++)
			{
				$char = ord($str[$i]);
				if($char >= 0xa1 && $char <= 0xfe)
				{
					return true;
				}
			}
			return false;
		}
	}
?>