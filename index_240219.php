
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/head.php'; ?>
<div id="wrapper">
 
<div class="mainBox00">
  <div class="flexslider" >
          <ul class="slides">
            <li><a href="<?php echo menu0206_url ?>"><img src="https://nowwd.speedgabia.com/onedc/main/new_top_img01.png" class="web" /><img src="https://nowwd.speedgabia.com/onedc/main/new_top_img01m.png" alt="" class="mobile" /></a></li>
            <li><a href="<?php echo menu0207_url ?>"><img src="https://nowwd.speedgabia.com/onedc/main/new_top_img02.png" class="web" /><img src="https://nowwd.speedgabia.com/onedc/main/new_top_img02m.png" alt="" class="mobile" /></a></li>
			<li><a href="<?php echo menu0105_url ?>"><img src="https://nowwd.speedgabia.com/onedc/main/new_top_img03.png" class="web" /><img src="https://nowwd.speedgabia.com/onedc/main/new_top_img03m.png" alt="" class="mobile" /></a></li>
            <!--li><a href="<?php echo menu0208_url ?>"><img src="https://nowwd.speedgabia.com/onedc/main/new_top_img04.png" class="web" /><img src="https://nowwd.speedgabia.com/onedc/main/new_top_img04m.png" alt="" class="mobile" /></a></li-->

          </ul>
        </div>		
</div>
    <!-- FlexSlider -->


  <script type="text/javascript">
// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide"
  });
});
  </script>
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
	
	<script type="text/JavaScript">
<!--
function tabSwap(sw) {
	for (i = 1; i < 10; i++) {
		if (sw == i) {
			document.getElementById('menu'+i+'contents').style.display='';

		} else {
			document.getElementById('menu'+i+'contents').style.display='none';

		}
	}
}

//-->
</script>
	
	
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
	
	<div class="mainBox04">
		<ul>
			<li onclick="location.href='<?php echo menu0701_url ?>';">
				<dt>치료 전후 사진</dt>
				<dl>하루만에 느껴지는 건강한 치아</dl>
			</li>
			<li onclick="location.href='<?php echo menu0201_url ?>';">
				<dt>ONE.ONE 시스템 </dt>
				<dl>더욱 안전한 첨단장비로 건강하게</dl>
			</li>
			<li>
				<dt>원치과 고객센터</dt>
				<h2>1661-1511</h2>
			</li>
			<li>
				<dd onclick="location.href='<?php echo menu0101_url ?>';">원치과 소개</dd>
				<dd onclick="location.href='<?php echo menu0102_url ?>';">의료진 소개</dd>
			</li>
		</ul>
	</div>

</div>

	
<!-- 팝업 -->
<div id="layer_popup" >
	<div class="popupBg"></div>
    <div class="popupBox">    	
        <div class="b-close" style="z-index: 9999" onclick = "document.all['layer_popup'].style.display = 'none';">X</div>
   
    <div class="popupContent">

1.개인정보의수집ㆍ이용목적<br>
① 서비스 이용에 따른 본인식별, 실명확인, 신청의사 확인 이용<br>
② 고지사항 전달, 불만사항의 의사소통 경로 확보, 물품배송시 정확한 배송지 정보<br>
③ 신규서비스 등 최신정보 안내 및 개인맞춤서비스 제공을 위한 자료<br>
④ 불량회원 부정이용 방지 및 비인가 사용방지<br>
⑥ 기타 원활한 양질의 서비스 제공 등<br><br>

2. 수집하는 개인정보의 항목<br>
①성명, 연락처,이메일 주소, IP정보, 그외 선택항목<br><br>

3.개인정보의 보유 및 이용기간<br>
① 원칙적으로 개인정보의 수집 또는 제공받은 목적 달성 시 지체없이 파기합니다.<br>
② 전자상거래에서의 소비자보호에 관한 법률 등 타 법률에 의해 보존할 필요가 있는 경우에는 아래와 같이 일정기간 보존합니다<br><br>

가. 계약 또는 청약철회 등에 관한 기록<br><br>

- 보존 이유 : 전자상거래 등에서의 소비자보호에 관한 법률<br><br>

- 보존 기간 : 5년<br><br>

나. 대금결제 및 재화 등의 공급에 관한 기록<br><br>

- 보존 이유 : 전자상거래 등에서의 소비자보호에 관한 법률<br><br>

- 보존 기간 : 5년<br><br>

다. 소비자의 불만 또는 분쟁처리에 관한 기록<br><br>

- 보존 이유 : 전자상거래 등에서의 소비자보호에 관한 법률<br><br>

- 보존 기간 : 3년<br><br>

라. 본인 확인에 관한 기록<br><br>

- 보존 이유 : 정보통신 이용촉진 및 정보보호 등에 관한 법률<br><br>

- 보존 기간 : 6개월<br><br>

마. 방문에 관한 기록<br><br>

- 보존 이유 : 통신비밀보호법<br><br>

- 보존 기간 : 3개월<br><br>

4. 개인정보의 제공에 관한 사항<br>
① 개인(신용)정보를 제공받는 자<br>
- 제휴 상품 및 이벤트, 서비스 소개와 관련된 업무를 위탁받은 자<br>
- 귀사 및 제휴사의 상품·서비스 소개 등 아래 이용목적과 관련한 제휴사 및 업무를 위탁받은 자<br>
② 개인정보 이용목적 <br>
- 귀사 및 제휴사의 상품·서비스 안내 및 이용권유, 고객 만족도조사, 회원유치 시장조사 및 상품 서비스 개발연구 등<br>
- 회원유치, 통신판매, 및 실사 업무 등 <br>
③ 제공대상 개인정보 : 성명, 이메일, 핸드폰, 회사명, 직함 등<br>
④ 제공받는 자의 개인정보 보유 및 이용기간: 제공 동의일로부터 개인정보의 제공 목적을 달성할 때까지<br><br>

※ 위 사항에 대한 동의를 거부할 수 있으나, 이에 대한 동의가 없을 경우 관련 편의 제공에 일부 제한이 있을 수 있습니다<br><br>

 * 개인정보 제3자 제공 동의서<br>
 본인은 아래와 같이 회사가 본인의 개인정보를 (주)이엠씨지 등 제공하는 것에 동의 합니다.<br>
① 제공받는자 : (주)이엠씨지 등<br>
② 개인정보 제공내역 : 성명, 이메일, 핸드폰, 회사명, 직함 등<br>
③ 개인정보 제공 목적 : 안내를 위한 전화 및 운영에 관한 사항<br>
④ 개인정보 보유 및 이용기간 : 제공 동의일로부터 개인정보의 제공 목적을 달성할 때까지<br><br>

※ 위 사항에 대한 동의를 거부할 수 있으나, 이에 대한 동의가 없을 경우 관련 편의 제공에 일부 제한이 있을 수 있습니다.<br><br>
		
귀하가 동의하여 주시는 경우, 회사는 수집한 귀하의 [성명, 연락처]를 이용해 귀하께 회사의 제품 및 서비스, 회사가 진행하는 이벤트 등에 대한 안내(연락처)를 보내드리고자 합니다. 회사는 귀하께서 상기 안내의 수신을 거부하시는 때까지 귀하의 상기 정보를 보유 및 이용할 예정입니다. 귀하는 이에 동의를 거부할 권리가 있으나, 동의를 거부하는 경우 회사가 제공하는 제품 및 서비스, 이벤트 등에 대한 안내를 받지 못 하십니다.		

	</div>
	</div>	
</div>	




<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?> 