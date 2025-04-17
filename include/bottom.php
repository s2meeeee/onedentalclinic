<!-- 하단 카피라이터 -->		
        <div id="footer">
			<div class="footerCenter inner1100">
			<div class="footerCenter01">
                <img src="/img/bottom_logo.png"  alt=""/>
				<div class="copyInfo">
					<a href="<?php echo privacy_url ?>" ><b><?php echo privacy ?></b></a><span>ㅣ</span>
					<a href="<?php echo service_url ?>" ><?php echo service ?></a>
                    <dd>원치과의원<span>ㅣ</span>병원장 : 유현진 <span class="web">ㅣ</span><br class="mobile">사업자등록번호 : 238-28-01840<br>
						주소 : 서울특별시 강남구 테헤란로 10길 7, 원치과<br>
						개인정보관리담당자 : 정원석<br>
						Copyright (c) 원치과의원. All rights reserved.
					</dd>	
				</div>
			</div>
			
				<!--div class="footerCenter02">
					<h2>고객센터</h2>
					<dt>02.000.0000</dt>
				</div-->	
				
				<div class="footerCenter03">
					<a href="https://www.facebook.com/people/%EC%9B%90%EC%B9%98%EA%B3%BC/61557393236484/" target="_blank"><img src="/img/bottom_sns01.png"></a>
					<a href="https://www.instagram.com/onedental_1204/" target="_blank"><img src="/img/bottom_sns02.png"></a>
					<a href="https://blog.naver.com/nsch7w0m" target="_blank"><img src="/img/bottom_sns03.png"></a>
					<!--select>
					  <option>패밀리 사이트</option>
					</select-->
				</div>
			</div>
		</div>	
<!-- //하단 카피라이터 -->
		<!--div class="mobile"><a href=""><img src="/img/main/mbox06_img01.png" class="img100"></a-->
	</div>

<!-- 오른쪽 카톡, top 버튼 -->
<div class="quick quick__mobile">
	<a href="http://pf.kakao.com/_CjnJG" target="_blank"><img src="/img/quick01.png"></a>
    <a href="https://www.instagram.com/onedental_1204/" target="_blank"><img src="/img/quick03.png"></a>
    <a href="https://www.youtube.com/@gangnam_onedental" target="_blank"><img src="/img/quick04.png"></a>
     
	<a class="scroll_top_btn" style="display: none; cursor: pointer;"><img src="/img/quick02.png"></a>
</div>
<!-- //오른쪽 카톡, top 버튼 -->

<?php if (($pagename == 'index.php') ) {  ?>


<?php } else {?>
<!-- 하단 간편견적문의 -->
<div class="bottomBox web">
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
</div>
<!-- //하단 간편견적문의 -->
<?php }  ?>



<!-- 하단 간편견죽문의 팝업 -->
<div id="layer_popup" >
    <div class="popupBg"></div>
    <div class="popupBox">
        <div class="b-close" style="z-index: 9999" onclick = "document.all['layer_popup'].style.display = 'none';">X</div>

        <div class="popupContent">

            1.개인정보의수집ㆍ이용목적<br>
            병의원은 수집한 개인정보를 다음의 목적을 위해 활용합니다.<br> 
            ① 서비스 제공에 관한 계약 이행 및 서비스 제공<br>
            ② 서비스 이용에 따른 본인식별, 실명확인, 신청의사 확인 이용<br>
            ③ 회원관리: 회원제 서비스 이용에 따른 고지사항 전달,불량회원의 부정 이용 방지와 비인가 사용 방지, 가입 의사 확인, <br>불만사항의 의사소통 경로 확보, 물품배송시 정확한 배송지 정보<br>
            ④ 마케팅 및 광고에 활용: 신규서비스 개발 및 특화, 이벤트 등 광고성 정보 전달, 접속 빈도 파악 또는 회원의 서비스 이용에 대한 통계 <br>
            <!--신규서비스 등 최신정보 안내 및 개인맞춤서비스 제공을 위한 자료 -->
            ⑤ 불량회원 부정이용 방지 및 비인가 사용방지<br>
            ⑥ 이벤트 참여시 의원에서 이벤트 내용 안내 및 상담(전화, 문자)<br>
            ⑦ 기타 원활한 양질의 서비스 제공 등<br><br>
            

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
<!-- //하단 간편견죽문의 팝업 -->


<script>
    const logout = () => {
        const logout_data = {
            mode: 'log_out'
        }
        jQuery.ajax({
            url:"../../controller/login_proc.php",
            type:"post",
            dataType:"json",
            data : logout_data,
            success: function(response) {
                alert(response.msg);
                location.href = "/";
            }
        })
    }

    const fastValidation = (name, phone, pain_area, age, agree_checked) => {
        if (name.val() === "") {
            alert("이름을 입력해주세요");
            name.focus();
            return false;
        }
        if (phone === "") {
            alert("연락처를 입력해주세요");
            return false;
        } else if (phoneNumberReg.test(phone) === false) {
            alert("-없이 입력해주세요");
            return false;
        }
        if (pain_area.val() === "") {
            alert("진료과목을 선택해주세요");
            pain_area.focus();
            return false;
        }
        if (age.val() === "") {
            alert("연령을 선택해주세요");
            age.focus();
            return false;
        }
        if(agree_checked === false) {
            alert("개인정보수집동의를 선택해주세요");
            return false;
        }
        return {
            mode: 'insert',
            name : name.val(),
            phone : phone,
            age : age.val(),
            pain_area : pain_area.val()
        }
    }

    const fastConsultInsert = (fastConsultData, fastBtn) => {
        if (fastConsultData) {
            fastBtn.attr("disabled", true);
            if (fastBtn.is(":disabled") === true) {
                jQuery.ajax({
                    type: "POST",
                    url: "../../controller/fast_consult_proc.php",
                    dataType: "json",
                    data: fastConsultData,
                    success: function (response) {
                        if (response.result) {
                            alert(response.msg);
                            window.location.reload();
                        } else {
                            if (response.msg != null) {
                                alert(response.msg);
                            }
                            return false;
                        }
                    }
                });
            }
        }
    }

    jQuery("#fast__btn").click(function(){
        const phone = jQuery("#phone_01").val() + jQuery("#phone_02").val() + jQuery("#phone_03").val();
        const fast__data = fastValidation(jQuery("#fast__name"), phone, jQuery("#fast__pain_area"),
            jQuery("#fast__age"), jQuery("#fast__agreed").is(":checked"))
        fastConsultInsert(fast__data, $(this));
    });

    $(document).ready(function() {
        var countUpTherapy = new CountUp('countUpTherapy', 0, <?= $countUpData['therapy'] ?>);
        var countUpImplant = new CountUp('countUpImplant', 0, <?= $countUpData['implant'] ?>);
        if (!countUpTherapy.error) {
            countUpTherapy.start();
            countUpImplant.start();
        } else {
            console.error(countUpTherapy.error);
        }
    });


    document.addEventListener("DOMContentLoaded", function() {
        let scrollToTopBtn = document.querySelector('.scroll_top_btn');
        window.addEventListener('scroll', function() {
            // 사용자가 일정 거리 이상 스크롤하면 버튼을 표시
            if (document.documentElement.scrollTop > 400) {
                scrollToTopBtn.style.display = 'block';
            } else {
                scrollToTopBtn.style.display = 'none';
            }
        });

        scrollToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            // 첫 번째 시도
            window.scrollTo({ top: 0, behavior: 'smooth' });

            // 첫 번째 스크롤 시도 후에 상단으로 완전히 이동하지 않았다면, 재시도
            setTimeout(function() {
                if (document.documentElement.scrollTop > 0) {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            }, 200); // 500밀리초 후에 상태 확인 후 재시도
        });
    });
</script>
</body>
</html>
