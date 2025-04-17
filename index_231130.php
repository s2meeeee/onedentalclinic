
<?php include $_SERVER['DOCUMENT_ROOT'].'/include_231208/head_231208.php'; ?>
<div id="wrapper">
 
	
  <div class="flexslider" >
          <ul class="slides">
            <li><img src="/img/main/top_img01.png" class="web" /><img src="/img/main/top_img01m.png" alt="" class="mobile" /></li>
            <li><img src="/img/main/top_img02.png" class="web" /><img src="/img/main/top_img02m.png" alt="" class="mobile" /></li>
            <li><img src="/img/main/top_img03.png" class="web" /><img src="/img/main/top_img03m.png" alt="" class="mobile" /></li> 
			<li><img src="/img/main/top_img04.png" class="web" /><img src="/img/main/top_img04m.png" alt="" class="mobile" /></li>
			<li><img src="/img/main/top_img05.png" class="web" /><img src="/img/main/top_img05m.png" alt="" class="mobile" /></li>
			<li><img src="/img/main/top_img06.png" class="web" /><img src="/img/main/top_img06m.png" alt="" class="mobile" /></li>
			<li><img src="/img/main/top_img07.png" class="web" /><img src="/img/main/top_img07m.png" alt="" class="mobile" /></li>  
          </ul>
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
			<li><input type="checkbox" id="fast__agreed" name="agreed" class="agreed" value="Y"> <span>개인정보 수집 및 이용 동의</span><br><a href="">[전문보기]</a></li>
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
	
	
	<div class="mainBox02">
		<article class="l1">
			<dt><img src="/img/main/box02_img0100.png" alt=""/> 원치과 지향 임플란트</dt>
			<dl>전국 어디서나 즉시 식립 임플란트를 지향합니다.</dl>
			<dd>지도의 위치표시를 클릭하면 해당 지역 환자의 원치과 하루 지향 임플란트 과정을 보실 수 있습니다.</dd>
			<ol>
				<img src="/img/main/box02_img0101.png" alt=""/>
				
				<a href="javascript:tabSwap('1');" class="map01"><img src="/img/main/box02_img0102.png" alt="화성"/></a>
				<a href="javascript:tabSwap('2');" class="map02"><img src="/img/main/box02_img0103.png" alt="용인"/></a>
				<a href="javascript:tabSwap('3');" class="map03"><img src="/img/main/box02_img0104.png" alt="계룡"/></a>
				<a href="javascript:tabSwap('4');" class="map04"><img src="/img/main/box02_img0105.png" alt="담양"/></a>
				<a href="javascript:tabSwap('5');" class="map05"><img src="/img/main/box02_img0106.png" alt="고흥"/></a>
				<a href="javascript:tabSwap('6');" class="map06"><img src="/img/main/box02_img0107.png" alt="강원"/></a>
				<a href="javascript:tabSwap('7');" class="map07"><img src="/img/main/box02_img0108.png" alt="울산"/></a>
			</ol>
			<dd>개인 치아상태나 골질에 따라 난이도가 다르며, 그에 따른 수술 소요시간이나 내원 횟수 차이는 있을 수 있습니다.</dd>
		</article>
		
		<article class="r1">
			<ol class="c1"><img src="/img/main/box02_img0201.png" alt=""/></ol>
			<ol class="c2">
				<h2>원치과 시술 과정</h2>
				
				<div class="mainBox03" id="menu1contents">
					<ul>
						<li class="c2l1">
							<dl>경기도 화성</dl>
							<dt><span>안지현</span>님</dt>
							<img src="/img/main/box02_img0301.png" alt=""/>
						</li>
						<li class="c2l2">
							<dl>화성에서 원치과까지</dl>
							<dt><span>2시간 46분</span> 걸렸습니다. </dt>
							<dd><img src="/img/main/box02_img0302.png" alt=""/> KTX 이용시간 <span>2시간 13분</span></dd>
							<dd><img src="/img/main/box02_img0303.png" alt=""/> 지하철 이용시간 <span>33분</span></dd>
							<dd><img src="/img/main/box02_img0304.png" alt=""/> 임플란트 3대 식립 <span>20분</span></dd>
						</li>
					</ul>
				</div>
				
				<div class="mainBox03" id="menu2contents" style="display: none"> 
					<ul>
						<li class="c2l1">
							<dl>경기도 용인</dl>
							<dt><span>안지현</span>님</dt>
							<img src="/img/main/box02_img0301.png" alt=""/>
						</li>
						<li class="c2l2">
							<dl>용인에서 원치과까지</dl>
							<dt><span>2시간 46분</span> 걸렸습니다. </dt>
							<dd><img src="/img/main/box02_img0302.png" alt=""/> KTX 이용시간 <span>2시간 13분</span></dd>
							<dd><img src="/img/main/box02_img0303.png" alt=""/> 지하철 이용시간 <span>33분</span></dd>
							<dd><img src="/img/main/box02_img0304.png" alt=""/> 임플란트 3대 식립 <span>20분</span></dd>
						</li>
					</ul>
				</div>
				
				<div class="mainBox03" id="menu3contents" style="display: none">
					<ul>
						<li class="c2l1">
							<dl>충청남도 계룡</dl>
							<dt><span>안지현</span>님</dt>
							<img src="/img/main/box02_img0301.png" alt=""/>
						</li>
						<li class="c2l2">
							<dl>계룡에서 원치과까지</dl>
							<dt><span>2시간 46분</span> 걸렸습니다. </dt>
							<dd><img src="/img/main/box02_img0302.png" alt=""/> KTX 이용시간 <span>2시간 13분</span></dd>
							<dd><img src="/img/main/box02_img0303.png" alt=""/> 지하철 이용시간 <span>33분</span></dd>
							<dd><img src="/img/main/box02_img0304.png" alt=""/> 임플란트 3대 식립 <span>20분</span></dd>
						</li>
					</ul>
				</div>
				
				<div class="mainBox03" id="menu4contents" style="display: none">
					<ul>
						<li class="c2l1">
							<dl>전라남도 담양</dl>
							<dt><span>안지현</span>님</dt>
							<img src="/img/main/box02_img0301.png" alt=""/>
						</li>
						<li class="c2l2">
							<dl>담양에서 원치과까지</dl>
							<dt><span>2시간 46분</span> 걸렸습니다. </dt>
							<dd><img src="/img/main/box02_img0302.png" alt=""/> KTX 이용시간 <span>2시간 13분</span></dd>
							<dd><img src="/img/main/box02_img0303.png" alt=""/> 지하철 이용시간 <span>33분</span></dd>
							<dd><img src="/img/main/box02_img0304.png" alt=""/> 임플란트 3대 식립 <span>20분</span></dd>
						</li>
					</ul>
				</div>
				
				<div class="mainBox03" id="menu5contents" style="display: none">
					<ul>
						<li class="c2l1">
							<dl>전라남도 고흥</dl>
							<dt><span>안지현</span>님</dt>
							<img src="/img/main/box02_img0301.png" alt=""/>
						</li>
						<li class="c2l2">
							<dl>고흥에서 원치과까지</dl>
							<dt><span>2시간 46분</span> 걸렸습니다. </dt>
							<dd><img src="/img/main/box02_img0302.png" alt=""/> KTX 이용시간 <span>2시간 13분</span></dd>
							<dd><img src="/img/main/box02_img0303.png" alt=""/> 지하철 이용시간 <span>33분</span></dd>
							<dd><img src="/img/main/box02_img0304.png" alt=""/> 임플란트 3대 식립 <span>20분</span></dd>
						</li>
					</ul>
				</div>
							
				<div class="mainBox03" id="menu6contents" style="display: none">
					<ul>
						<li class="c2l1">
							<dl>강원</dl>
							<dt><span>안지현</span>님</dt>
							<img src="/img/main/box02_img0301.png" alt=""/>
						</li>
						<li class="c2l2">
							<dl>강원에서 원치과까지</dl>
							<dt><span>2시간 46분</span> 걸렸습니다. </dt>
							<dd><img src="/img/main/box02_img0302.png" alt=""/> KTX 이용시간 <span>2시간 13분</span></dd>
							<dd><img src="/img/main/box02_img0303.png" alt=""/> 지하철 이용시간 <span>33분</span></dd>
							<dd><img src="/img/main/box02_img0304.png" alt=""/> 임플란트 3대 식립 <span>20분</span></dd>
						</li>
					</ul>
				</div>
				
				<div class="mainBox03" id="menu7contents" style="display: none">
					<ul>
						<li class="c2l1">
							<dl>울산</dl>
							<dt><span>안지현</span>님</dt>
							<img src="/img/main/box02_img0301.png" alt=""/>
						</li>
						<li class="c2l2">
							<dl>울산에서 원치과까지</dl>
							<dt><span>2시간 46분</span> 걸렸습니다. </dt>
							<dd><img src="/img/main/box02_img0302.png" alt=""/> KTX 이용시간 <span>2시간 13분</span></dd>
							<dd><img src="/img/main/box02_img0303.png" alt=""/> 지하철 이용시간 <span>33분</span></dd>
							<dd><img src="/img/main/box02_img0304.png" alt=""/> 임플란트 3대 식립 <span>20분</span></dd>
						</li>
					</ul>
				</div>
				
				
				
			</ol>
		</article>	
			
	</div>
	
	
	<div class="mainBox04">
		<ul>
			<li onclick="location.href='/community/before-after.php';">
				<dt>Before & After</dt>
				<dl>하루만 느낄 수 있는 아름다운 변화<br>로그인 후 확인하실 수 있습니다.</dl>
			</li>
			<li onclick="location.href='/about/equipment-system.php';">
				<dt>원치과 첨단시스템 소개 </dt>
				<dl>더욱 안전하고 정밀한 첨단 장비로<br>당신의 치아를 더욱 건강하게 만듭니다.</dl>
			</li>
			<li>
				<dt>원치과 고객센터</dt>
				<h2>02.000.0000</h2>
			</li>
			<li>
				<dd onclick="location.href='/about/introduce.php';">원치과 소개</dd>
				<dd onclick="location.href='/about/doctor.php';">의료진/스텝소개</dd>
			</li>
		</ul>
	</div>

</div>

<div class="inner mobile">
	<div class="MmainBox01">
		<a href=""><img src="/img/main/mbox01_img01.png" alt=""/></a>
		<a href=""><img src="/img/main/mbox01_img02.png" alt=""/></a>
		<a href=""><img src="/img/main/mbox01_img03.png" alt=""/></a>
	</div>
	<div class="MmainBox02">
		<a href=""><img src="/img/main/mbox02_img01.png" alt=""/></a>
	</div>
	<div class="MmainBox03">
		<a href=""><img src="/img/main/mbox03_img01.png" alt=""/></a>
		<a href=""><img src="/img/main/mbox03_img02.png" alt=""/></a>
	</div>
	<div class="MmainBox04">
		<img src="/img/main/mbox04_img01.png" class="b1" alt=""/>
		<img src="/img/main/mbox04_img02.png" class="b2" alt=""/>
		<a href="" class="b3"><img src="/img/main/mbox04_img03.png" alt=""/></a>
		<a href="" class="b4"><img src="/img/main/mbox04_img04.png" alt=""/></a>
	</div>
	
	<div class="MmainBox05">
		<img src="/img/main/mbox05_img01.png" alt=""/>
	</div>
</div>




<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?> 