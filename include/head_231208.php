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
require_once DOCUMENT_ROOT . '/core/dao/BoardDao.class.php';


$loginDao = new LoginDao();
$popupDao = new PopupDao();

if ($_SESSION['identity']) {
    $loginInfo = $loginDao->loginInfo($_SESSION['identity']);
}
?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/include/menu_231208.php'; ?>

<!doctype html>

	

<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">
<meta name="HandheldFriendly" content="true">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1">
	<title>원치과</title>
	<link rel="stylesheet" href="/css_231208/common.css">
	<link rel="stylesheet" href="/css_231208/style.css">
	<link rel="stylesheet" href="/css_231208/font-awesome.min.css">
	<link rel="stylesheet" media="( min-width:701px ) and ( max-width:1000px )" href="/css_231208/mobile.css">
	<link rel="stylesheet" media="( min-width:0px ) and ( max-width:700px )" href="/css_231208/mobile.css">
	<link rel="stylesheet" href="/css_231208/flexslider.css" type="text/css" media="screen" />
	<script src="/js/jquery-1.7.2.min.js"></script>
	<script src="/js/jquery.menu.js"></script>
	<script src="/js/default.js"></script>
	<script src="/js/common.js"></script>
	<script src="/js/regExp.js"></script>
	<script src="/js/validated.js"></script>
	<script src="/js/jquery.flexslider.js"></script>
</head>

<body>

	<div id="wrap">
		
		<div id="header" class="header">

			<div class="headerTop web">
                 <div class="inner1200">
         			<a href="/" class="logo"></a>
       
                
                	<div class="headerTopL ">
                    	<a href="">원치과 제1관</a>
                    	<a href="">원치과 제2관</a>
                    	<a href="">원치과 제3관</a>
                    </div>
              
                    <div class="headerTopR ">
						<a href="" class="topBtn01">ALL 바른치약 ></a>
						
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
                <button type="button" id="gnb_open" ><img src="/img/all.png"  alt=""/><span class="sound_only"> 메뉴열기</span></button>
                
            </div> 
			
			<div class="headerTopM mobile">
                 <div class="inner">
         			<a href="/" class="logoM"><img src="/img/logo.png"  alt=""/></a>
       
                <button type="button" id="gnb_open" onclick = "document.all['gnb2'].style.display = 'inline';"><img src="/img/all.png"  alt=""/><span class="sound_only"> 메뉴열기</span></button>
				</div>
            </div>    
			

	 	  <div class="menu">
             
       
              
              <nav class="web ">
	<ul>
		<li><a href="<?php echo menu01_url ?>"><?php echo menu01 ?></a>
			<a href="<?php echo menu02_url ?>"><?php echo menu02 ?></a>
			<a href="<?php echo menu03_url ?>"><?php echo menu03 ?></a>
			<a href="<?php echo menu04_url ?>"><?php echo menu04 ?></a>
			<a href="<?php echo menu05_url ?>"><?php echo menu05 ?></a>
			<a href="<?php echo menu06_url ?>"><?php echo menu06 ?></a>
			<a href="<?php echo menu07_url ?>"><?php echo menu07 ?></a>
			<a href="<?php echo menu08_url ?>"><?php echo menu08 ?></a>
			
            <ul>
                <ol class="inner1200">
                    <article>
                        <li><a href="<?php echo menu0101_url ?>"><?php echo menu0101 ?></a>
							<a href="<?php echo menu0101_01_url ?>" class="l2"><?php echo menu0101_01 ?></a>
				            <a href="<?php echo menu0101_02_url ?>" class="l2"><?php echo menu0101_02 ?></a>
                            <a href="<?php echo menu0102_url ?>"><?php echo menu0102 ?></a>
                            <a href="<?php echo menu0102_01_url ?>" class="l2"><?php echo menu0102_01 ?></a>
                            <a href="<?php echo menu0102_02_url ?>" class="l2"><?php echo menu0102_02 ?></a>
                            <a href="<?php echo menu0103_url ?>"><?php echo menu0103 ?></a>
                            <a href="<?php echo menu0104_url ?>"><?php echo menu0104 ?></a>
							<a href="<?php echo menu0105_url ?>"><?php echo menu0105 ?></a>
							<a href="<?php echo menu0105_01_url ?>" class="l2"><?php echo menu0105_01 ?></a>
							<a href="<?php echo menu0105_02_url ?>" class="l2"><?php echo menu0105_02 ?></a>
							<a href="<?php echo menu0106_url ?>"><?php echo menu0106 ?></a>
                        </li>
                    </article>
                   	<article>
                        <li><a href="<?php echo menu0201_url ?>"><?php echo menu0201 ?></a>
							<a href="<?php echo menu0201_01_url ?>" class="l2"><?php echo menu0201_01 ?></a>
				            <a href="<?php echo menu0201_02_url ?>" class="l2"><?php echo menu0201_02 ?></a>
                            <a href="<?php echo menu0201_03_url ?>" class="l2"><?php echo menu0201_03 ?></a>
                            <a href="<?php echo menu0202_url ?>"><?php echo menu0202 ?></a>
                            <a href="<?php echo menu0203_url ?>"><?php echo menu0203 ?></a>
                            <a href="<?php echo menu0204_url ?>"><?php echo menu0204 ?></a>
                            <a href="<?php echo menu0205_url ?>"><?php echo menu0205 ?></a>
                        </li>
                    </article>
					<article>
                        <li><a href="<?php echo menu0301_url ?>"><?php echo menu0301 ?></a>
                        </li>
                    </article>
					<article>
                        <li><a href="<?php echo menu0401_url ?>"><?php echo menu0401 ?></a>
                        </li>
                    </article>
					<article>
                        <li><a href="<?php echo menu0501_url ?>"><?php echo menu0501 ?></a>
							<a href="<?php echo menu0502_url ?>"><?php echo menu0502 ?></a>
				            <a href="<?php echo menu0503_url ?>"><?php echo menu0503 ?></a>
                            <a href="<?php echo menu0504_url ?>"><?php echo menu0504 ?></a>
                            <a href="<?php echo menu0505_url ?>"><?php echo menu0505 ?></a>

                        </li>
                    </article>
					<article>
                        <li><a href="<?php echo menu0601_url ?>"><?php echo menu0601 ?></a>
							<a href="<?php echo menu0602_url ?>"><?php echo menu0602 ?></a>
				            <a href="<?php echo menu0603_url ?>"><?php echo menu0603 ?></a>
                            <a href="<?php echo menu0604_url ?>"><?php echo menu0604 ?></a>
                            <a href="<?php echo menu0605_url ?>"><?php echo menu0605 ?></a>
                        </li>
                    </article>
					<article>
                        <li><a href="<?php echo menu0701_url ?>"><?php echo menu0701 ?></a>
							<a href="<?php echo menu0702_url ?>"><?php echo menu0702 ?></a>
				            <a href="<?php echo menu0703_url ?>"><?php echo menu0703 ?></a>
                            <a href="<?php echo menu0704_url ?>"><?php echo menu0704 ?></a>
                            <a href="<?php echo menu0705_url ?>"><?php echo menu0705 ?></a>
                            <a href="<?php echo menu0706_url ?>"><?php echo menu0706 ?></a>
                            <a href="<?php echo menu0707_url ?>"><?php echo menu0707 ?></a>
                            <a href="<?php echo menu0707_01_url ?>" class="l2"><?php echo menu0707_01 ?></a>
							<a href="<?php echo menu0707_02_url ?>" class="l2"><?php echo menu0707_02 ?></a>
                        </li>
                    </article>
					<article>
                        <li><a href="<?php echo menu0801_url ?>"><?php echo menu0801 ?></a>
							<a href="<?php echo menu0802_url ?>"><?php echo menu0802 ?></a>
                        </li>
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
							<li class="gnb2_2dli"><a href="<?php echo menu0101_01_url ?>" target="_self" class="gnb2_2da l2"><span></span><?php echo menu0101_01 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0101_02_url ?>" target="_self" class="gnb2_2da l2"><span></span><?php echo menu0101_02 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0102_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0102 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0102_01_url ?>" target="_self" class="gnb2_2da l2"><span></span><?php echo menu0102_01 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0102_02_url ?>" target="_self" class="gnb2_2da l2"><span></span><?php echo menu0102_02 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0103_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0103 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0104_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0104 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0105_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0105 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0105_01_url ?>" target="_self" class="gnb2_2da l2"><span></span><?php echo menu0105_01 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0105_02_url ?>" target="_self" class="gnb2_2da l2"><span></span><?php echo menu0105_02 ?></a></li>
                            <li class="gnb2_2dli"><a href="<?php echo menu0106_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0106 ?></a></li>
                    	</ul>
                </li>
				<li class="gnb2_1dli">
                    <a href="<?php echo menu02_url ?>" target="_self" class="gnb2_1da"><?php echo menu02 ?></a>
                    	<button type="button" class="btn_gnb_op">하위분류</button>
						<ul class="gnb2_2dul">
                        	<li class="gnb2_2dli"><a href="<?php echo menu0201_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0201 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0201_01_url ?>" target="_self" class="gnb2_2da l2"><span></span><?php echo menu0201_01 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0201_02_url ?>" target="_self" class="gnb2_2da l2"><span></span><?php echo menu0201_02 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0201_03_url ?>" target="_self" class="gnb2_2da l2"><span></span><?php echo menu0201_03 ?></a></li>
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
                        	<li class="gnb2_2dli"><a href="<?php echo menu0301_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0301 ?></a></li>
                    	</ul>
                </li>
				<li class="gnb2_1dli">
                    <a href="<?php echo menu04_url ?>" target="_self" class="gnb2_1da"><?php echo menu04 ?></a>
                    	<button type="button" class="btn_gnb_op">하위분류</button>
						<ul class="gnb2_2dul">
                        	<li class="gnb2_2dli"><a href="<?php echo menu0401_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0401 ?></a></li>

                    	</ul>
                </li>
				<li class="gnb2_1dli">
                    <a href="<?php echo menu05_url ?>" target="_self" class="gnb2_1da"><?php echo menu05 ?></a>
                    	<button type="button" class="btn_gnb_op">하위분류</button>
						<ul class="gnb2_2dul">
                        	<li class="gnb2_2dli"><a href="<?php echo menu0501_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0501 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0502_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0502 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0503_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0503 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0504_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0504 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0505_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0505 ?></a></li>
                    	</ul>
                </li>
				<li class="gnb2_1dli">
                    <a href="<?php echo menu06_url ?>" target="_self" class="gnb2_1da"><?php echo menu06 ?></a>
                    	<button type="button" class="btn_gnb_op">하위분류</button>
						<ul class="gnb2_2dul">
                        	<li class="gnb2_2dli"><a href="<?php echo menu0601_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0601 ?></a></li>
                            <li class="gnb2_2dli"><a href="<?php echo menu0602_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0602 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0603_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0603 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0604_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0604 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0605_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0605 ?></a></li>
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
							<li class="gnb2_2dli"><a href="<?php echo menu0706_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0706 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0707_url ?>" target="_self" class="gnb2_2da"><span></span><?php echo menu0707 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0707_01_url ?>" target="_self" class="gnb2_2da l2"><span></span><?php echo menu0707_01 ?></a></li>
							<li class="gnb2_2dli"><a href="<?php echo menu0707_02_url ?>" target="_self" class="gnb2_2da l2"><span></span><?php echo menu0707_02 ?></a></li>
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
		
		
		