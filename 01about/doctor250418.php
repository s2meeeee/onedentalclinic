<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/head.php'; ?>
<link rel="stylesheet" href="/css/doctor_style_250418.css">
<div id="wrapper wrap_bg">
	<div class="inner2">
		<script type="text/JavaScript">
			<!--
function tabSwap(sw) {
	for (i = 1; i < 9; i++) {
		if (sw == i) {
			document.getElementById('menu'+i+'contents').style.display='';

		} else {
			document.getElementById('menu'+i+'contents').style.display='none';

		}
	}
}

$(function () {
  // 수정: 이벤트 위임으로 변경 (동적으로 추가된 버튼 대응)
  document.addEventListener('click', function (e) {
    const btn = e.target.closest('.open_modal');
    if (btn) {
      const target = btn.getAttribute('data-target');
      const modal01 = document.querySelector(target);
      if (modal01) {
				modal01.style.display = 'flex';
			} 
    }
  });

  // 모달 닫기 (닫기 버튼, 오버레이 클릭 시)
  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('modal_close') || e.target.classList.contains('modal_overlay')) {
      const modal01 = e.target.closest('.modal01');
      if (modal01) modal01.style.display = 'none';
    }
  });
	

});

//-->
		</script>

		<div id="wrapper wrap_bg">
			<div class="inner2">
				<div id="menu1contents">
					<div class="doctorBox01">
						<ul>
							<li class="open_modal on" data-target="#popupMenu1contents"><img src="https://onedentalad.co.kr/img/01about/doctor_img01.png">
								<dl><b>유현진</b> 병원장</dl>
							</li>
							<li class="open_modal" data-target="#popupMenu3contents"><img src="https://onedentalad.co.kr/img/01about/doctor_img05.png">
								<dl><b>김지아</b> 임플란트 전담원장</dl>
							</li>
							<li class="open_modal" data-target="#popupMenu2contents"><img src="https://onedentalad.co.kr/img/01about/doctor_img06.png">
								<dl><b>송병근</b> 임플란트 전담원장</dl>
							</li>
							<li class="open_modal" data-target="#popupMenu4contents"><img src="https://onedentalad.co.kr/img/01about/doctor_img08.png">
								<dl><b>김태형</b> 임플란트 전담원장</dl>
							</li>
							<li class="open_modal" data-target="#popupMenu7contents"><img src="https://onedentalad.co.kr/img/01about/doctor_img02.png">
								<dl><b>오혜민</b> 임플란트 전담원장</dl>
							</li>
							<li class="open_modal" data-target="#popupMenu6contents"><img src="https://onedentalad.co.kr/img/01about/doctor_img09.png">
								<dl><b>이유민</b> 일반진료, 보철 전담원장</dl>
							</li>
							<li class="open_modal" data-target="#popupMenu5contents"><img src="https://onedentalad.co.kr/img/01about/doctor_img07.png">
								<dl><b>허세미</b> 치아교정 전담원장</dl>
							</li>
						</ul>
					</div>


					<!-- 팝업모음 -->
					<div class="modal01" id="popupMenu1contents" style="display: none;">
						<div class="modal_overlay"></div>
						<div class="modal_content">
							<div class="doctorBox02">
								<h2>유현진 <span>병원장</span></h2>
								<img src="https://onedentalad.co.kr/img/01about/doctor_img01.png" class="mobile">
								<ul>
									<li>
										<dl><span>ㆍ</span>서울대학교 임플란트 과정 수료</dl>
										<dl><span>ㆍ</span>치과대학 보철과 인턴, 레지던트 수료</dl>
										<dl><span>ㆍ</span>독일 시로나 3D-CAD 시스템 마이스터 과정 수료 </dl>
										<dl><span>ㆍ</span>대한 임플란트학회 정회원 인정의</dl>
										<dl><span>ㆍ</span>노벨 바이오케어 브레네막 임플란트 시스템 보철과정 수료</dl>
										<dl><span>ㆍ</span>쿠루드 자치정부 수반 감사패 수여</dl>
										<dl><span>ㆍ</span>삼군 특수 사령관 감사패 수여</dl>
										<dl><span>ㆍ</span>(전) 오늘안 치과 선릉점 대표원장 역임</dl>
										<dl><span>ㆍ</span>대한 보철학회 정회원 인정의</dl>
										<dl><span>ㆍ</span>심미보철학회 정회원 인정의</dl>
										<dl><span>ㆍ</span>좋은 병원 박람회 치과부분 대상 수여</dl>

									</li>
									<li><img src="https://onedentalad.co.kr/img/01about/doctor_img01.png"></li>
									<li class="pop_logo"><img src="../img/01about/logo_00.png" alt="원치과로고"></li>
								</ul>
								<div></div>
							</div>
							<button class="modal_close">닫기</button>
						</div>
					</div>
					<div class="modal01" id="popupMenu2contents" style="display: none;">
						<div class="modal_overlay"></div>
						<div class="modal_content">
							<div class="scroll">
								<div class="doctorBox02">
									<h2>송병근 <span>임플란트 전담원장</span></h2>
									<img src="https://onedentalad.co.kr/img/01about/doctor_img06.png" class="mobile">
									<ul>
										<li>
											<dl><span>ㆍ</span>보건복지부 인증 통합치의학과 전문의</dl>
											<dl><span>ㆍ</span>서울대학교 졸업</dl>
											<dl><span>ㆍ</span>서울대학교 치의학대학원 치의학과 석사</dl>
											<dl><span>ㆍ</span>서울대학교치의학대학원 구강악안면외과 박사 수료</dl>
											<dl><span>ㆍ</span>미국 Cornell 대학병원 구강외과 연수</dl>
											<dl><span>ㆍ</span>미국 UPENN 치과대학 미세근관치료 과정 수료</dl>
											<dl><span>ㆍ</span>대한인공치아골유착학회 이사</dl>
											<dl><span>ㆍ</span>대한구강악안면임플란트학회 정회원</dl>
											<dl><span>ㆍ</span>대한치과보철학회 평생회원 및 우수보철치과의사</dl>
											<dl><span>ㆍ</span>대한턱관절교합학회 정회원</dl>
										</li>
										<li><img src="https://onedentalad.co.kr/img/01about/doctor_img06.png"></li>
										<li class="pop_logo"><img src="../img/01about/logo_00.png" alt="원치과로고"></li>

									</ul>
								</div>
							</div>
							<button class="modal_close">닫기</button>
						</div>
					</div>
					<div class="modal01" id="popupMenu3contents" style="display: none;">
						<div class="modal_overlay"></div>
						<div class="modal_content">
							<div class="doctorBox02">
								<h2>김지아 <span>임플란트 전담원장</span></h2>
								<img src="https://onedentalad.co.kr/img/01about/doctor_img05.png" class="mobile">
								<ul>
									<li>
										<dl><span>ㆍ</span>보건복지부인증 통합치의학 전문의</dl>
										<dl><span>ㆍ</span>대한심미학회 인정의 펠로우 </dl>
										<dl><span>ㆍ</span>서울대학교 졸업 </dl>
										<dl><span>ㆍ</span>경희대학교 치의학대학원 치의학 석사 </dl>
										<dl><span>ㆍ</span>경희대학교 치과병원 전공의 </dl>
										<dl><span>ㆍ</span>미국 NYU 임플란트 과정 수료 </dl>
										<dl><span>ㆍ</span>미국UPENN 치과대학 근관치료학 과정 수료 </dl>
										<dl><span>ㆍ</span>Ossem AIC 임플란트 advanced / sinus 과정 수료 </dl>
										<dl><span>ㆍ</span>Dentium 심미 보철 과정 수료</dl>
									</li>

									<li><img src="https://onedentalad.co.kr/img/01about/doctor_img05.png"></li>
									<li class="pop_logo"><img src="../img/01about/logo_00.png" alt="원치과로고"></li>

								</ul>
							</div>
							<button class="modal_close">닫기</button>
						</div>
					</div>
					<div class="modal01" id="popupMenu4contents" style="display: none;">
						<div class="modal_overlay"></div>
						<div class="modal_content">
							<div class="doctorBox02">
								<h2>김태형 <span> 임플란트 전담원장</span></h2>
								<img src="https://onedentalad.co.kr/img/01about/doctor_img08.png" class="mobile">
								<ul>
									<li>
										<dl><span>ㆍ</span>연세대학교 치과대학원 박사 과정</dl>
										<dl><span>ㆍ</span>보건복지부 인증 통합치의학과 전문의</dl>
										<dl><span>ㆍ</span>서울대학교 치의학대학원<br>Advanced Periodontal / Implant Therapy Course 수료</dl>
										<dl><span>ㆍ</span>대한 구강악안면 임플란트학회 정회원</dl>
										<dl><span>ㆍ</span>영상치의학회 정회원</dl>
										<dl><span>ㆍ</span>오스템 임플란트 자문의원</dl>
									</li>
									<li><img src="https://onedentalad.co.kr/img/01about/doctor_img08.png"></li>
									<li class="w1" style="display: none">


									</li>
									<li class="pop_logo"><img src="../img/01about/logo_00.png" alt="원치과로고"></li>

								</ul>
							</div>
							<button class="modal_close">닫기</button>
						</div>
					</div>
					<div class="modal01" id="popupMenu5contents" style="display: none;">
						<div class="modal_overlay"></div>
						<div class="modal_content">
							<div class="doctorBox02">
								<h2>허세미 <span>치아교정 전담원장</span></h2>
								<img src="https://onedentalad.co.kr/img/01about/doctor_img07.png" class="mobile">
								<ul>
									<li>
										<dl><span>ㆍ</span>연세대학교 대학원 교정과 박사과정 수료</dl>
										<dl><span>ㆍ</span>대학병원 치과 인턴 레지던트</dl>
										<dl><span>ㆍ</span>치의학전문대학원 석사과정 졸업</dl>
										<dl><span>ㆍ</span>KAIST 석사과정 졸업</dl>
										<dl><span>ㆍ</span>고려대학교 졸업</dl>
										<dl><span>ㆍ</span>티끌교정 연수회 수료</dl>
										<dl><span>ㆍ</span>미국 인비절라인 인정의</dl>
										<dl><span>ㆍ</span>대한치과교정학회 정회원</dl>
									</li>
									<li><img src="https://onedentalad.co.kr/img/01about/doctor_img07.png"></li>
									<li class="w1" style="display: none">


									</li>
									<li class="pop_logo"><img src="../img/01about/logo_00.png" alt="원치과로고"></li>

								</ul>
							</div>
							<button class="modal_close">닫기</button>
						</div>
					</div>
					<div class="modal01" id="popupMenu6contents" style="display: none;">
						<div class="modal_overlay"></div>
						<div class="modal_content">
							<div class="doctorBox02">
								<h2>이유민 <span>일반진료, 보철 전담원장</span></h2>
								<img src="https://onedentalad.co.kr/img/01about/doctor_img09.png" class="mobile">
								<ul>
									<li>
										<dl><span>ㆍ</span>단국대학교 치대 졸업</dl>
										<dl><span>ㆍ</span>서울대학교 치과병원 수련의</dl>
										<dl><span>ㆍ</span>전) 서울대학교 치과병원 근무</dl>
										<dl><span>ㆍ</span>전) 세림병원 치과 과장</dl>
										<dl><span>ㆍ</span>대한 영상치의학회 정회원</dl>
										<dl><span>ㆍ</span>보건복지부 인증 구강검진 전문과정 수료</dl>
										<dl><span>ㆍ</span>Oral design non-prep veneer academy 무삭제 라미네이트 코스 수료</dl>
										<dl><span>ㆍ</span>Doctor's endo seminar hands on course 수료</dl>
										<dl><span>ㆍ</span>Dental Bean Master of Third Molar Extraction 수료</dl>
										<dl><span>ㆍ</span>Dental Bean Endo seminar 수료</dl>
										<dl><span>ㆍ</span>Dental Bean Tooth preparation seminar 수료</dl>
										<dl><span>ㆍ</span>Dr. Choi Tooth preparation, Occlusal adjustment seminar 수료</dl>
										<dl><span>ㆍ</span>TAS lifting seminar수료</dl>
										<dl><span>ㆍ</span>Dr.Choi 얼굴치과아카데미 Botox, filler seminar 수료</dl>

									</li>
									<li><img src="https://onedentalad.co.kr/img/01about/doctor_img09.png"></li>
									<li class="w1" style="display: none">


									</li>
									<li class="pop_logo"><img src="../img/01about/logo_00.png" alt="원치과로고"></li>

								</ul>
							</div>
							<button class="modal_close">닫기</button>
						</div>
					</div>
					<div class="modal01" id="popupMenu7contents" style="display: none;">
						<div class="modal_overlay"></div>
						<div class="modal_content">
							<div class="doctorBox02">
								<h2>오혜민 <span>임플란트 전담원장</span></h2>
								<img src="https://onedentalad.co.kr/img/01about/doctor_img02.png" class="mobile">
								<ul>
									<li>
										<dl><span>ㆍ</span>서울대학교 치의학대학원 졸업</dl>
										<dl><span>ㆍ</span>서울대학교 치의학대학원 석사</dl>
										<dl><span>ㆍ</span>서울대학교 치과병원 인턴</dl>
										<dl><span>ㆍ</span>보건복지부 인증 구강악안면외과 전문의</dl>
										<dl><span>ㆍ</span>삼성서울병원 구강악안면외과 레지던트</dl>
										<dl><span>ㆍ</span>대한악안면성형재건외과학회 인정의</dl>
										<dl><span>ㆍ</span>대한구강악안면외과학회 정회원</dl>
										<dl><span>ㆍ</span>대한악안면성형재건외과학회 정회원</dl>
										<dl><span>ㆍ</span>대한구강악안면임플란트학회 정회원</dl>
										<dl><span>ㆍ</span>대한통합치과학회 정회원</dl>

									</li>
									<li><img src="https://onedentalad.co.kr/img/01about/doctor_img02.png"></li>

									<li class="w1" style="display: none">


									</li>
									<li class="pop_logo"><img src="../img/01about/logo_00.png" alt="원치과로고"></li>

								</ul>
							</div>
							<button class="modal_close">닫기</button>
						</div>
					</div>
				</div>

			</div>
		</div>

		</li>
		</ul>
	</div>
</div>
</div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/bottom.php'; ?>