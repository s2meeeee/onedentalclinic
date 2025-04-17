<?php include $_SERVER['DOCUMENT_ROOT'].'/include/head.php'; ?>
<div id="wrapper">
	<div class="inner2">
		<div class="locBox02 mt0">
			<ul>
				<li><iframe src="https://www.youtube.com/embed/b9KJLTbxtUg?si=G2srWxIGHga4O1dk"
						title="YouTube video player" frameborder="0"
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
						allowfullscreen></iframe></li>
				<li><iframe src="https://www.youtube.com/embed/OW8atviXArw?si=5wWtkQjp1dyFViwT"
						title="YouTube video player" frameborder="0"
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
						allowfullscreen></iframe></li>
			</ul>
		</div>

		<div class="txtCenter mt100">
			<img src="/img/01about/loc_img01.png" class="web">
			<img src="/img/01about/loc_img01m.png" class="mobile img100">
		</div>

		<div class="locBox01">
			<!-- * 카카오맵 - 지도퍼가기 -->
			<!-- 1. 지도 노드 -->
			<div id="daumRoughmapContainer1703741424039" class="root_daum_roughmap root_daum_roughmap_landing web">
			</div>

			<!--
	2. 설치 스크립트
	* 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
-->
			<script charset="UTF-8" class="daum_roughmap_loader_script"
				src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

			<!-- 3. 실행 스크립트 -->
			<script charset="UTF-8">
				new daum.roughmap.Lander({
					"timestamp": "1703741424039",
					"key": "2hf7b",
					"mapWidth": "1300",
					"mapHeight": "687"
				}).render();
			</script>

			<!-- * 카카오맵 - 지도퍼가기 -->
			<!-- 1. 지도 노드 -->
			<div id="daumRoughmapContainer1703741449584" class="root_daum_roughmap root_daum_roughmap_landing mobile"
				style="margin:  auto"></div>



			<!-- 3. 실행 스크립트 -->
			<script charset="UTF-8">
				new daum.roughmap.Lander({
					"timestamp": "1703741449584",
					"key": "2hf7c",
					"mapWidth": "300",
					"mapHeight": "400"
				}).render();
			</script>

			<ul>
				<li>
					<dl>서울특별시 강남구 테헤란로 10길 7, 원치과</dl>
				</li>
				<li><a href="https://naver.me/GFYzLmfF" target="_blank">네이버 길찾기</a><a
						href="https://place.map.kakao.com/310416507" target="_blank">카카오 길찾기</a></li>
			</ul>

			<table>
				<tr>
					<th><img src="/img/01about/loc_img06.png"> 지하철 이용시</th>
					<td>
						<dl>강남역 1번출구 <br>약 300m</dl>
						<dl>강남역 3번출구 <br>약 500m</dl>
						<dl>역삼역 3번출구 <br>약 300m</dl>
					</td>
				</tr>
				<tr>
					<th><img src="/img/01about/loc_img07.png"> 버스 이용시</th>
					<td>
						<dt>역삼역.포스코P&S타워 정류장</dt>
						<dd><span>간선</span>146 / 740 / 341 / 360</dd>
						<dd><span>직행</span>1100 / 1700 / 2000 / 7007 / 8001</dd>
					</td>
				</tr>
			</table>
		</div>

		<div class="locBox02">
			<dt>약국 위치 안내</dt>
			<img src="/img/01about/loc_img08.png">
		</div>


	</div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>