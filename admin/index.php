<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/head.php';
require_once DOCUMENT_ROOT . '/core/dao/PostDao.class.php';
$postDao = new PostDao();
$postMainCnt = 4;
$mobile_check = "M";
$popupZindex = 99;
if (!preg_match($mobilePattern, $userAgent)) {
    $postMainCnt = 12;
    $mobile_check = "W";
}
$postWhere = " AND gubun = 'videoReview'";
$beforeAfterMainData = $postDao->getListMain("posts", $postMainCnt, $postWhere)['values'];
?>
<div class="popups__container">
<?php
if ($popups['total_cnt'] > 0):
    foreach ($popups['values'] as $index => $value):
        if ($value['is_active']):
            $position_move = "";
            $popup_width = "";
            $popup_height = "";
            $popup_left = "";
            $popup_position = "";
            if ($mobile_check == "W"):
                $position_move = "left: " . 420 * $popupCnt . "px;";
            else:
                $position_move = "top: " . (130 + (460 * $popupCnt)) . "px; ";
                $popup_width = "width: 90%; ";
                $popup_height = "height: 430px;";
                $popup_left = "left: 5%;";
                $popup_position = "position: absolute;";
            endif;

            if ($index < 5): if (is_null($_COOKIE['popup_id_' . $value['id']])):
                $popupCnt++;
                $popupZindex--;
                ?>
				
                <div class="popups" id="popup_id_<?php echo $value['id'] ?>"
                     style="<?php
                     echo $popup_position;
                     echo $popup_width;
                     echo $popup_height;
                     echo $popup_left;
                     echo "z-index: " . $popupZindex ?>; ">
                    <div class="popups__img">
                        <a <?php if (!empty($value['link'])) echo "href='" . $value['link'] . "'"; ?>>
                            <img style="width:100%;" src="<?php echo $value['file_01_path'] ?>"
                                 alt="<?php echo $value['file_01_name'] ?>">
                        </a>
                    </div>
                    <div class="popups__check">
                        <div style="display: none">
                            <p style="margin: 0;">하루동일 열지 않기</p>
                            <input type="checkbox" onclick="remove_popup(<?php echo $value['id'] ?>)">
                        </div>
						<span onclick="remove_popup(<?php echo $value['id'] ?>)" class="pointer">오늘 그만 보기</span>
                        <span onclick="close_popup(<?php echo $value['id'] ?>)" class="pointer">닫기</span>
                    </div>
                </div>
            <?php endif;
            endif;
        endif;
    endforeach;
endif; ?>
</div>
<div id="wrapper2">

    <div class="mainBox00">
		<a href="/07community/with-star_view.php?id=115"><img src="<?=$topBannerInfo['file_01_path']?>" class="web" /><img src="<?=$topBannerInfo['file_02_path']?>" alt="" class="mobile" style="width: 100%" /></a>
        <div class="flexslider" style="display: none" >
            <ul class="slides">
                <li><a href="/07community/with-star_view.php?id=115"><img src="<?=$topBannerInfo['file_01_path']?>" class="web" /><img src="<?=$topBannerInfo['file_02_path']?>" alt="" class="mobile" /></a></li>
<!--             <li><a href="/07community/with-star_view.php?id=115"><img src="https://nowwd.speedgabia.com/onedc/main/new_top_img01.png" class="web" /><img src="https://nowwd.speedgabia.com/onedc/main/new_top_img01m.png" alt="" class="mobile" /></a></li>-->
            <!--li><a href="<?php echo menu0207_url ?>"><img src="https://nowwd.speedgabia.com/onedc/main/new_top_img02.png" class="web" /><img src="https://nowwd.speedgabia.com/onedc/main/new_top_img02m.png" alt="" class="mobile" /></a></li>
			<li><a href="<?php echo menu0105_url ?>"><img src="https://nowwd.speedgabia.com/onedc/main/new_top_img03.png" class="web" /><img src="https://nowwd.speedgabia.com/onedc/main/new_top_img03m.png" alt="" class="mobile" /></a></li>
            <!--li><a href="<?php echo menu0208_url ?>"><img src="https://nowwd.speedgabia.com/onedc/main/new_top_img04.png" class="web" /><img src="https://nowwd.speedgabia.com/onedc/main/new_top_img04m.png" alt="" class="mobile" /></a></li-->

            </ul>
        </div>
    </div>

    <div class="mainBox01">
        <ul>
            <li>간편견적문의</li>
            <li><input type="text" id="fast__name" name="name" title="이름" placeholder="이름을 입력하세요"></li>
            <li>
                <select id="fast__pain_area" class="pain_area" name="pain_area" title="이름">
                    <option value="">진료과목</option>
                    <option value="임플란트">임플란트</option>
                    <option value="교정">교정</option>
                    <option value="미백">미백</option>
                    <option value="충치치료">충치치료</option>
                    <option value="기타">기타</option>
                </select>
            </li>
            <li>연락처 <input type="text" id="phone_01" class="phone_01" maxlength="3"> - <input type="text" id="phone_02" class="phone_02" maxlength="4"> - <input type="text" id="phone_03" class="phone_03" maxlength="4"></li>
            <li>
                <select id="fast__age" name="age" title="나이">
                    <option value="">연령</option>
                    <option value="10대">10대</option>
                    <option value="20대">20대</option>
                    <option value="30대">30대</option>
                    <option value="40대">40대</option>
                    <option value="50대">50대</option>
                    <option value="60대 이상">60대 이상</option>
                </select>
            </li>
            <li><input type="checkbox" id="fast__agreed" name="agreed" class="agreed" value="Y"> <span>개인정보 수집 및 이용 동의</span><br><a onclick="document.all['layer_popup'].style.display = 'inline';">[전문보기]</a></li>
            <!--			<li><a id="fast__btn" style="cursor: pointer;">문의하기</a></li>-->
            <li><input type="button" id="fast__btn" value="문의하기"></li>
        </ul>
    </div>
   
	
	<div class="inner">
        <div class="mainBox07">
            <a href="/07community/review-video.php">
                <dt><b>매일 업데이트</b>되는 수술 이야기</dt>
                <dl>파노라마로 보는 <b>LIVE</b> 오늘 식립 임플란트</dl>
            </a>
            <div class="mainBox11 <?php if (!preg_match($mobilePattern, $userAgent)){ echo 'flexslider2'; } else { echo 'mainBox11_hide'; } ?>">
                <ul class="slides">
                    <li>
                        <div style="display: flex;">
                            <a href="/07community/review-video_view.php?id=<?= $beforeAfterMainData[0]['id'] ?>"><img  src="<?= $beforeAfterMainData[0]['file_01_path'] ?>"  alt=""/></a>
                            <a href="/07community/review-video_view.php?id=<?= $beforeAfterMainData[1]['id'] ?>" style="padding: 0 20px;"><img  src="<?= $beforeAfterMainData[1]['file_01_path'] ?>"  alt=""/></a>
                            <a href="/07community/review-video_view.php?id=<?= $beforeAfterMainData[2]['id'] ?>"><img  src="<?= $beforeAfterMainData[2]['file_01_path'] ?>"  alt=""/></a>
                        </div>
                    </li>
                    <li>
                        <div style="display: flex;">
                            <a href="/07community/review-video_view.php?id=<?= $beforeAfterMainData[3]['id'] ?>"><img  src="<?= $beforeAfterMainData[3]['file_01_path'] ?>"  alt=""/></a>
                            <a href="/07community/review-video_view.php?id=<?= $beforeAfterMainData[4]['id'] ?>" style="padding: 0 20px;"><img  src="<?= $beforeAfterMainData[4]['file_01_path'] ?>"  alt=""/></a>
                            <a href="/07community/review-video_view.php?id=<?= $beforeAfterMainData[5]['id'] ?>"><img  src="<?= $beforeAfterMainData[5]['file_01_path'] ?>"  alt=""/></a>
                        </div>
                    </li>
                    <li>
                        <div style="display: flex;">
                            <a href="/07community/review-video_view.php?id=<?= $beforeAfterMainData[6]['id'] ?>"><img  src="<?= $beforeAfterMainData[6]['file_01_path'] ?>"  alt=""/></a>
                            <a href="/07community/review-video_view.php?id=<?= $beforeAfterMainData[7]['id'] ?>" style="padding: 0 20px;"><img  src="<?= $beforeAfterMainData[7]['file_01_path'] ?>"  alt=""/></a>
                            <a href="/07community/review-video_view.php?id=<?= $beforeAfterMainData[8]['id'] ?>"><img  src="<?= $beforeAfterMainData[8]['file_01_path'] ?>"  alt=""/></a>
                        </div>
                    </li>
                    <li>
                        <div style="display: flex;">
                            <a href="/07community/review-video_view.php?id=<?= $beforeAfterMainData[9]['id'] ?>"><img  src="<?= $beforeAfterMainData[9]['file_01_path'] ?>"  alt=""/></a>
                            <a href="/07community/review-video_view.php?id=<?= $beforeAfterMainData[10]['id'] ?>" style="padding: 0 20px;"><img  src="<?= $beforeAfterMainData[10]['file_01_path'] ?>"  alt=""/></a>
                            <a href="/07community/review-video_view.php?id=<?= $beforeAfterMainData[11]['id'] ?>"><img  src="<?= $beforeAfterMainData[11]['file_01_path'] ?>"  alt=""/></a>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="mainBox11 <?php if (preg_match($mobilePattern, $userAgent)){ echo 'flexslider2'; } else { echo 'mainBox11_hide'; } ?>">
                <ul class="slides">
                    <li>
                        <div style="display: flex;">
                            <a href="/07community/review-video_view.php?id=<?= $beforeAfterMainData[0]['id'] ?>"><img  src="<?= $beforeAfterMainData[0]['file_01_path'] ?>"  alt=""/></a>
                        </div>
                    </li>
                    <li>
                        <div style="display: flex;">
                            <a href="/07community/review-video_view.php?id=<?= $beforeAfterMainData[1]['id'] ?>"><img  src="<?= $beforeAfterMainData[1]['file_01_path'] ?>"  alt=""/></a>
                        </div>
                    </li>
                    <li>
                        <div style="display: flex;">
                            <a href="/07community/review-video_view.php?id=<?= $beforeAfterMainData[2]['id'] ?>"><img  src="<?= $beforeAfterMainData[2]['file_01_path'] ?>"  alt=""/></a>
                        </div>
                    </li>
                    <li>
                        <div style="display: flex;">
                            <a href="/07community/review-video_view.php?id=<?= $beforeAfterMainData[3]['id'] ?>"><img  src="<?= $beforeAfterMainData[3]['file_01_path'] ?>"  alt=""/></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
	
		<div class="mainBox14">
		<div class="flexslider3" >
            <ul class="slides">
             <li><a href="/01about/preview.php"><img src="https://nowwd.speedgabia.com/onedc/main/new_box05_img01.png"  /></a></li>
            <li><a href="/01about/location.php"><img src="https://nowwd.speedgabia.com/onedc/main/new_box05_img02.png"  /></a></li>
			<li><a href="/02one-plant/one-system.php"><img src="https://nowwd.speedgabia.com/onedc/main/new_box05_img03.png"  /></a></li>
            </ul>
        </div>	
	</div>	
	
	
	<div class="mainBox13">
         <div class="inner">
             <dt>원치과 리얼스토리</dt>
             <dl><b>원치과X채널A ‘가족을 부탁해’</b> 프로그램 실제 환자 후기</dl>
			 
			 <img src="https://nowwd.speedgabia.com/onedc/main/new_box04_img02.png" alt=""/>
			 <a href="/04navigation-implant/navigation-implant.php">네비게이션 임플란트 바로가기</a>
		</div>   
	</div>
	
	
	 <div class="mainBox05">
        <div class="inner">
            <ul>
                <li class="mobile"><img src="https://nowwd.speedgabia.com/onedc/main/new_box01_img01m.png" alt=""/></li>
                <li>
                    <dl><b>ONE.ONE 시스템</b>은 믿을수 있습니다!</dl>
                    <dd></dd>
                    <div class="web">
                        <a href="<?php echo menu0206_url ?>"><img src="https://nowwd.speedgabia.com/onedc/main/new_box01_img03c.png" alt=""/><span>정직한 진료</span></a>
                        <a href="<?php echo menu0207_url ?>"><img src="https://nowwd.speedgabia.com/onedc/main/new_box01_img04c.png" alt=""/><span>전문 의료진</span></a>
                        <a href="<?php echo menu0208_url ?>"><img src="https://nowwd.speedgabia.com/onedc/main/new_box01_img05c.png" alt=""/><span>체계적 관리</span></a>
                    </div>
                    <div class="mobile">
                        <a href="<?php echo menu0206_url ?>"><img src="https://nowwd.speedgabia.com/onedc/main/new_box01_img03b.png" alt=""/><span>정직한 진료</span></a>
                        <a href="<?php echo menu0207_url ?>"><img src="https://nowwd.speedgabia.com/onedc/main/new_box01_img04b.png" alt=""/><span>전문 의료진</span></a>
                        <a href="<?php echo menu0208_url ?>"><img src="https://nowwd.speedgabia.com/onedc/main/new_box01_img05b.png" alt=""/><span>체계적 관리</span></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

	
	
    <div class="mainBox06">

        <ul>
            <li><div class="mainBox06s">
                    <dt><img src="https://nowwd.speedgabia.com/onedc/main/new_box02_img02.png" alt=""/> 원치과</dt>
                    <!-- * 카카오맵 - 지도퍼가기 -->
                    <!-- 1. 지도 노드 -->
                    <div id="daumRoughmapContainer1701310911535" class="root_daum_roughmap root_daum_roughmap_landing web"></div>

                    <!--
                        2. 설치 스크립트
                        * 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
                    -->
                    <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

                    <!-- 3. 실행 스크립트 -->
                    <script charset="UTF-8">
                        new daum.roughmap.Lander({
                            "timestamp" : "1701310911535",
                            "key" : "2hzy7",
                            "mapWidth" : "700",
                            "mapHeight" : "456"
                        }).render();
                    </script>



                    <!-- * 카카오맵 - 지도퍼가기 -->
                    <!-- 1. 지도 노드 -->
                    <div id="daumRoughmapContainer1701310928225" class="root_daum_roughmap root_daum_roughmap_landing mobile" style="margin: 0 auto"></div>

                    <!--
                        2. 설치 스크립트
                        * 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
                    -->
                    <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

                    <!-- 3. 실행 스크립트 -->
                    <script charset="UTF-8">
                        new daum.roughmap.Lander({
                            "timestamp" : "1701310928225",
                            "key" : "2hzy8",
                            "mapWidth" : "300",
                            "mapHeight" : "400"
                        }).render();
                    </script>
                    <dl><img src="https://nowwd.speedgabia.com/onedc/main/new_box02_img03.png" alt=""/> 서울특별시 강남구 테헤란로 10길 7, 원치과</dl>
                </div>
            </li>
            <li><div class="mainBox06s">
                    <ol><dt><span>예약상담<br>대표번호</span>1661-1511</dt></ol>
                    <ol>
                        <dl>진료시간</dl>
                        <dd><span>월,수,금</span>오전 9:30 ~ 오후 6:30 <font>(점심시간 오후 1:00 ~ 2:00)</font> </dd>
                        <dd><span>화,목</span>오전 9:30 ~ 오후 8:00 <font>(점심시간 오후 1:00 ~ 2:00)</font> </dd>
                        <dd><span>토요일</span>오전 9:30 ~ 오후 2:00 <font>(점심시간없이 진료)</font> </dd>
                        <dd><span>휴   무</span>일요일, 공휴일</dd>
                    </ol>
                </div>
            </li>
        </ul>

    </div>
	
	

    

    <div class="mainBox08">
        <div class="inner">
            <div class="mainBox09">
                <a href="/02one-plant/one-system.php">
                    <dt><b>ONE.ONE </b>시스템</dt>
                    <dl>더욱 안전한 첨단장비로 건강하게</dl>
                    <dd>바로가기 <img src="https://nowwd.speedgabia.com/onedc/main/box04_img02.png" alt=""/></dd>
                </a>
            </div>

            <div class="mainBox10">
                <ul>
                    <li><a href="/01about/introduce.php">
                            <dl>원치과 소개</dl>
                            <dt><img src="https://nowwd.speedgabia.com/onedc/main/box05_img01.png" alt=""/></dt>
                            <dd>ONE. ONE 시스템으로 단 하루 만에 <br class="web">당신의 미소를 찾아 드립니다.</dd>
                        </a>
                    </li>
                    <li>
                        <dl>원치과 고객센터</dl>
                        <dt>1661-1511</dt>
                        <dd>진료시간 외 문의는 상담문의 게시판을 <br class="web">이용해 주시길 바랍니다.</dd>
                    </li>
                    <li><a href="/01about/doctor.php">
                            <dl>의료진 소개</dl>
                            <dt><img src="https://nowwd.speedgabia.com/onedc/main/box05_img02.png" alt=""/></dt>
                            <dd>임플란트는 처음부터 원(ONE)치과 <br class="web">숙련된 의료진, 수준높은 치료</dd>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
	
	<div class="mainBox12"><img src="https://nowwd.speedgabia.com/onedc/main/new_box03_img01.png" alt=""/></div>	

</div>





<script>
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            autoplay: true,
            slideshowSpeed: 3000
        });

        $('.flexslider2').flexslider({
            animation: "slide",
            autoplay: true,
            slideshowSpeed: 3000
        });
		
		$('.flexslider3').flexslider({
            animation: "fade",
            autoplay: true,
            slideshowSpeed: 4000
        });

        let spanWidthSize = $('.mainBox11 div ul li:not(.clone) a img')[0].width;

        $('.mainBox11 div ul li a span').each(function () {
            $(this).css('width', spanWidthSize+'px')
        });

        if (window.innerWidth <= 768) {
            $('.mainBox11 div ul li a img').each(function () {
                $(this).attr('style', function() {
                    return 'width: 100% !important;' + $(this).attr('style');
                });
            });

            $('.mainBox11 div ul li a span').each(function () {
                $(this).attr('style', function() {
                    return 'width: 100% !important;' + $(this).attr('style');
                });
            });
        }
    });

    function tabSwap(sw) {
        for (i = 1; i < 10; i++) {
            if (sw == i) {
                document.getElementById('menu'+i+'contents').style.display='';

            } else {
                document.getElementById('menu'+i+'contents').style.display='none';

            }
        }
    }

    const remove_popup = (id) => {
        const remove_popup_data = {
            mode: 'remove_popup',
            id
        }
        jQuery.ajax({
            type: "POST",
            url: "../../../controller/popup_proc.php",
            dataType: "json",
            data: remove_popup_data,
            success: function (response) {
                if (response.result) {
                    document.getElementById("popup_id_" + response.id).remove();
                }
            }
        })
    }

    const close_popup = (id) => {
        document.getElementById("popup_id_" + id).remove();
    }
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?> 