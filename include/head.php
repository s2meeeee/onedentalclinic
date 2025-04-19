<? $chkdir1 = $_SERVER['REQUEST_URI']; ?>
<? $chkdir2 =  "/" .explode('/', $_SERVER['PHP_SELF'])[1] ; ?>
<?php
$pagename = basename($_SERVER['PHP_SELF']);
$dir = basename($_SERVER['REQUEST_URI']);
session_start();
include_once dirname(__FILE__).'/../config/config.php';
include_once dirname(__FILE__).'/../config/defined_list.php';
include_once dirname(__FILE__).'/../function.php';

require_once DOCUMENT_ROOT . '/core/class/MysqlDB.class.php';
require_once DOCUMENT_ROOT . '/core/dao/LoginDao.class.php';
require_once DOCUMENT_ROOT . '/core/dao/PopupDao.class.php';
require_once DOCUMENT_ROOT . '/core/dao/TopBannerDao.class.php';
require_once DOCUMENT_ROOT . '/core/dao/CountUpNumberDao.class.php';
require_once DOCUMENT_ROOT . '/core/dao/BoardDao.class.php';


$loginDao = new LoginDao();
$popupDao = new PopupDao();
$topBannerDao = new TopBannerDao();
$countUpNumberDao = new CountUpNumberDao();

if ($_SESSION['identity']) {
    $loginInfo = $loginDao->loginInfo($_SESSION['identity']);
}
$countUpData = $countUpNumberDao->getDetail('count_up_numbers', ' where id = 1');
$loginDao->updateCountUpNumbers();

$topBannerInfo = $topBannerDao->getDetail("top_banner", " WHERE id = 2");
$popups = $popupDao->getList("popups", 1, 3, " AND is_active = 'Y'");
?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/include/menu.php'; ?>

<!doctype html>

	

<!-- Danggeun Market Code -->
<script src="https://karrot-pixel.business.daangn.com/0.2/karrot-pixel.umd.js"></script>
<script>
  window.karrotPixel.init('1717731705205100001');
  window.karrotPixel.track('ViewPage');
</script>
<!-- End Danggeun Market Code -->



<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">
<meta name="HandheldFriendly" content="true">
<meta name="format-detection" content="telephone=no">
<meta name="robots" content="index,follow">
<meta name="description" content="단 하루 만에 당신의 미소를 찾아 드립니다">
<meta name="keyword" content="강남역임플란트, 전체임플란트, 임플란트, 네비게이션, 강남수면임플란트, 강남오스템임플란트, 강남야간진료, 강남라미네이트, 강남충치치료, 강남치아교정, 강남사랑니발치, 세라믹, 크라운, 레진, 인레이">
<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1">
	<title>원치과</title>
    <link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" media="( min-width:701px ) and ( max-width:1000px )" href="/css/mobile.css">
	<link rel="stylesheet" media="( min-width:0px ) and ( max-width:700px )" href="/css/mobile.css">
	<link rel="stylesheet" href="/css/flexslider.css" type="text/css" media="screen" />
	<link rel="icon" type="image/png" sizes="16x16" href="https://onedentalad.co.kr/img/one.png">
	<script src="/js/jquery-1.7.2.min.js"></script>
	<script src="/js/jquery.menu.js"></script>
	<script src="/js/default.js"></script>
	<script src="/js/common.js"></script>
	<script src="/js/regExp.js"></script>
	<script src="/js/validated.js"></script>
	<script src="/js/jquery.flexslider.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.8.5/countUp.min.js"></script>

</head>

<body>
	<div id="wrap">
		<div class="topBnner">
			<ul>
				<li>
					<ol>
						<dl>누적 치료건수</dl>
						<dt id="countUpTherapy">0</dt>
						<dd>명</dd>
					</ol>
				</li>
				<li>
					<ol>
						<dl>식립 임플란트</dl>
						<dt id="countUpImplant">0</dt>
						<dd>개</dd>
					</ol>
				</li>
			</ul>
		</div>
		
		<div id="header" class="header">

			<div class="headerTop web">
                 <div class="inner">
         			<a href="/" class="logo"></a>
       
                
                	
              
                    <div class="headerTopR ">
						
						
						<!-- 로그인 전 -->
                        <?php if($loginInfo): ?>
                            <a onclick="logout()" style="margin-right: 20px;" class="pointer">로그아웃</a>
                            <a href="<?php echo mypage_url ?>" class="mypage">마이페이지</a>
						<!-- //로그인 전 -->
                        <?php else: ?>
                            <a href="<?php echo login_url ?>" class="login">로그인</a>
                            <a href="<?php echo join_url ?>" class="join">회원가입</a>
                        <?php endif; ?>
                    </div>
                 </div>  
                <button type="button" id="gnb_open"  ><img src="/img/all.png"  alt=""/><span class="sound_only"> 메뉴열기</span></button>
                
            </div> 
			
			<div class="headerTopM mobile">
                 <div class="inner">
         			<a href="/" class="logoM"><img src="/img/logo2.png"  alt=""/></a>
       
                <button type="button" id="gnb_open" onclick = "document.all['gnb2'].style.display = 'inline';" ><img src="/img/all.png"  alt=""/><span class="sound_only"> 메뉴열기</span></button>
				</div>
            </div>    
			

	 	  <div class="menu">
             
       
              
              <nav class="web ">
	<ul>
		<li><a href="<?php echo menu01_url ?>"><?php echo menu01 ?></a>
			<a href="<?php echo menu02_url ?>"><?php echo menu02 ?></a>
			<a href="<?php echo menu03_url ?>"><?php echo menu03 ?></a>
			<a href="<?php echo menu04_url ?>"><?php echo menu04 ?></a>
			<!--a href="<?php echo menu05_url ?>"><?php echo menu05 ?></a-->
			<a href="<?php echo menu06_url ?>"><?php echo menu06 ?></a>
			<a href="<?php echo menu07_url ?>"><?php echo menu07 ?></a>
			<a href="<?php echo menu08_url ?>"><?php echo menu08 ?></a>
			
            <ul>
                <ol class="inner">
                    <article>
                       <a href="<?php echo menu0101_url ?>"><?php echo menu0101 ?></a>
                            <a href="<?php echo menu0102_url ?>"><?php echo menu0102 ?></a>
                            <a href="<?php echo menu0103_url ?>"><?php echo menu0103 ?></a>
                            <a href="<?php echo menu0104_url ?>"><?php echo menu0104 ?></a>
							<a href="<?php echo menu0105_url ?>"><?php echo menu0105 ?></a>
							<a href="<?php echo menu0106_url ?>"><?php echo menu0106 ?></a>
                            <!--예은 기공소 추가-->

							<!-- 선미 의료진소개 작업 시작 -->
							<a href="<?php echo menu0107_url ?>"><?php echo menu0107 ?></a>
							<!-- 선미 의료진소개 작업 끝 -->
                    </article>
                   	<article>
                            <a href="<?php echo menu0200_url ?>"><?php echo menu0200 ?></a>
                            <!--예은 원케어 추가-->
							<a href="<?php echo menu0201_url ?>"><?php echo menu0201 ?></a>
                        	<!--<a href="<?php echo menu0206_url ?>"><?php echo menu0206 ?></a>
							<a href="<?php echo menu0207_url ?>"><?php echo menu0207 ?></a>
							<a href="<?php echo menu0208_url ?>"><?php echo menu0208 ?></a>-->
                            <a href="<?php echo menu0202_url ?>"><?php echo menu0202 ?></a>
                            <a href="<?php echo menu0203_url ?>"><?php echo menu0203 ?></a>
                            <a href="<?php echo menu0204_url ?>"><?php echo menu0204 ?></a>
                            <a href="<?php echo menu0205_url ?>"><?php echo menu0205 ?></a>
                       
                    </article>
					<article>
                        <a href="<?php echo menu0302_url ?>"><?php echo menu0302 ?></a>
                        <a href="<?php echo menu0303_url ?>"><?php echo menu0303 ?></a>
						 <a href="<?php echo menu0304_url ?>"><?php echo menu0304 ?></a>
                    </article>
					
					<!--article>
                        <a href="<?php echo menu0501_url ?>"><?php echo menu0501 ?></a>
							<a href="<?php echo menu0502_url ?>"><?php echo menu0502 ?></a>

                        
                    </article -->
					<article>
                       <a href="<?php echo menu0601_url ?>"><?php echo menu0601 ?></a>
							<a href="<?php echo menu0602_url ?>"><?php echo menu0602 ?></a>
				            <a href="<?php echo menu0603_url ?>"><?php echo menu0603 ?></a>
                            <a href="<?php echo menu0604_url ?>"><?php echo menu0604 ?></a>
                        <!--예은충치치료 메뉴바 추가-->
						<!-- 선미치아교정 메뉴바 추가 -->
							<a href="<?php echo menu0605_url ?>"><?php echo menu0605 ?></a>
							<a href="<?php echo menu0606_url ?>"><?php echo menu0606 ?></a>
							<!-- 선미치아교정 메뉴바 추가 -->
                    </article>
					<article>
                        <a href="<?php echo menu0701_url ?>"><?php echo menu0701 ?></a>
							<a href="<?php echo menu0702_url ?>"><?php echo menu0702 ?></a>
				            <a href="<?php echo menu0703_url ?>"><?php echo menu0703 ?></a>
                            <a href="<?php echo menu0704_url ?>"><?php echo menu0704 ?></a>
                            <a href="<?php echo menu0705_url ?>"><?php echo menu0705 ?></a>
                        
                    </article>
					<article>
                        <a href="<?php echo menu0801_url ?>"><?php echo menu0801 ?></a>
							<a href="<?php echo menu0802_url ?>"><?php echo menu0802 ?></a>
                        
                    </article>
                </ol>
			</ul>
        </li>
		
        
	</ul>
</nav>

				</div>    
         </div>	   
			
			<div id="gnb2" >
            <button type="button" class="btn_close" onclick = "document.all['gnb2'].style.display = 'none';"><i class="fa fa-times"></i></button>
            <ul class="gnb_tnb">
               <br><br>

            </ul>
            <ul id="gnb2_1dul">
            	<li class="gnb2_1dli">
                    <a href="<?php echo menu01_url ?>" target="_self" class="gnb2_1da"><?php echo menu01 ?></a>
                    	<button type="button" class="btn_gnb_op">하위분류</button>
						<ul class="gnb2_2dul">
                        	<li class="gnb2_2dli"><a href="<?php echo menu0101_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0101 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0102_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0102 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0103_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0103 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0104_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0104 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0105_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0105 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0106_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0106 ?></a></li>
                    	<!-- 선미 의료진소개작업 시작 -->
							<li class="gnb2_2dli"><a href="<?php echo menu0107_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0107 ?></a></li>
							<!-- 선미 의료진소개작업 끝 -->

						</ul>
                </li>
				<li class="gnb2_1dli">
                    <a href="<?php echo menu02_url ?>" target="_self" class="gnb2_1da"><?php echo menu02 ?></a>
                    	<button type="button" class="btn_gnb_op">하위분류</button>
						<ul class="gnb2_2dul">
                        	<!--<li class="gnb2_2dli"><a href="<?php echo menu0206_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0206 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0207_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0207 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0208_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0208 ?></a></li>-->
                            <li class="gnb2_2dli"><a href="<?php echo menu0200_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0200 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0201_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0201 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0202_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0202 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0203_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0203 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0204_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0204 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0205_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0205 ?></a></li>
                    	</ul>
                </li>
				<li class="gnb2_1dli">
                    <a href="<?php echo menu03_url ?>" target="_self" class="gnb2_1da"><?php echo menu03 ?></a>
                    <button type="button" class="btn_gnb_op">하위분류</button>
						<ul class="gnb2_2dul">
							<li class="gnb2_2dli"><a href="<?php echo menu0302_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0302 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0303_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0303 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0304_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0304 ?></a></li>
                    	</ul>	
                </li>
				<li class="gnb2_1dli">
                    <a href="<?php echo menu04_url ?>" target="_self" class="gnb2_1da"><?php echo menu04 ?></a>

                </li>
				<!--li class="gnb2_1dli">
                    <a href="<?php echo menu05_url ?>" target="_self" class="gnb2_1da"><?php echo menu05 ?></a>
                    	<button type="button" class="btn_gnb_op">하위분류</button>
						<ul class="gnb2_2dul">
                        	<li class="gnb2_2dli"><a href="<?php echo menu0501_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0501 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0502_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0502 ?></a></li>
                    	</ul>
                </li-->
				<li class="gnb2_1dli">
                    <a href="<?php echo menu06_url ?>" target="_self" class="gnb2_1da"><?php echo menu06 ?></a>
                    	<button type="button" class="btn_gnb_op">하위분류</button>
						<ul class="gnb2_2dul">
                        	<li class="gnb2_2dli"><a href="<?php echo menu0601_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0601 ?></a></li>
                            <li class="gnb2_2dli"><a href="<?php echo menu0602_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0602 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0603_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0603 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0604_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0604 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0605_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0605 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0606_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0606 ?></a></li>
                    	</ul>
                </li>
				<li class="gnb2_1dli">
                    <a href="<?php echo menu07_url ?>" target="_self" class="gnb2_1da"><?php echo menu07 ?></a>
                    	<button type="button" class="btn_gnb_op">하위분류</button>
						<ul class="gnb2_2dul">
                        	<li class="gnb2_2dli"><a href="<?php echo menu0701_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0701 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0702_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0702 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0703_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0703 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0704_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0704 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0705_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0705 ?></a></li>
                    	</ul>
                </li>
                <li class="gnb2_1dli">
                    <a href="<?php echo menu08_url ?>" target="_self" class="gnb2_1da"><?php echo menu08 ?></a>
                    	<button type="button" class="btn_gnb_op">하위분류</button>
						<ul class="gnb2_2dul">
                        	<li class="gnb2_2dli"><a href="<?php echo menu0801_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0801 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0802_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0802 ?></a></li>
                    	</ul>
                </li>
                
             </ul>

        </div>     
		        <script>
          $(function () {
            //폰트 크기 조정 위치 지정
            var font_resize_class = get_cookie("ck_font_resize_add_class");
            if( font_resize_class == 'ts_up' ){
                $("#text_size button").removeClass("select");
                $("#size_def").addClass("select");
            } else if (font_resize_class == 'ts_up2') {
                $("#text_size button").removeClass("select");
                $("#size_up").addClass("select");
            }

            $(".hd_opener").on("click", function() {
                var $this = $(this);
                var $hd_layer = $this.next(".hd_div");

                if($hd_layer.is(":visible")) {
                    $hd_layer.hide();
                    $this.find("span").text("열기");
                } else {
                    var $hd_layer2 = $(".hd_div:visible");
                    $hd_layer2.prev(".hd_opener").find("span").text("열기");
                    $hd_layer2.hide();

                    $hd_layer.show();
                    $this.find("span").text("닫기");
                }
            });


            $(".btn_gnb_op").click(function(){
                $(this).toggleClass("btn_gnb_cl").next(".gnb2_2dul").slideToggle(300);
                
            });

            $(".hd_closer").on("click", function() {
                var idx = $(".hd_closer").index($(this));
                $(".hd_div:visible").hide();
                $(".hd_opener:eq("+idx+")").find("span").text("열기");
            });

            $(".hd_sch_btn").on("click", function() {
                $("#hd_sch").show();
            });

            $("#hd_sch .btn_close").on("click", function() {
                $("#hd_sch").hide();
            });

            
            $("#gnb_open").on("click", function() {
                $("#gnb2").show();
            });

            $("#gnb2 .btn_close").on("click", function() {
                $("#gnb2").hide();
            });

 			
        });


      
        </script>

		<?php include $_SERVER['DOCUMENT_ROOT'].'/include/sub_top.php'; ?>	
		
		
		