<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/head.php';

if (!$loginInfo) {
    alertLocationHref("권한지 없는 페이지입니다.", "/index.php");
}

include $_SERVER['DOCUMENT_ROOT'].'/include/sub_top.php';
?>

<div id="wrapper">
    <div class="inner1200 mt50">
		<div class="txtCenter fs42"><dt>마이페이지</dt></div>
        <form id="_form" method="post">
            <input type="hidden" name="mode" value="update" readonly>
            <input type="hidden" name="id" value="<?php echo $loginInfo['id'] ?>" readonly>
        <div class="joinBox01 joinBox01b mt100">
            <ul>
                <li><h2>회원정보</h2>
                    <a id="password_change" class="joinBtn04 hide ohcMKAg1!">PW변경</a>
                    <a onclick = "document.all['pop'].style.display = 'inline';" id="witherawal" class="joinBtn04">회원탈퇴</a>
                </li>
                <li>
                    <table>
                        <tr>
                            <th>성명</th>
                          <td>
                              <input type="text" name="name" title="성명" class="required" value="<?php echo $loginInfo['name'] ?>">&nbsp;&nbsp;
                              <input name="gender" type="radio" <?php if($loginInfo['gender'] == 'M') echo 'checked' ?> value="M"> 남자  &nbsp;&nbsp;<input name="gender" type="radio" <?php if($loginInfo['gender'] == 'F') echo 'checked' ?> value="F" > 여자 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <span>반드시 실명으로 기재하여 주세요.</span>
                          </td>
                        </tr>
                        <tr>
                            <th>아이디</th>
                            <td><?php echo $loginInfo['identity'] ?></td>
                        </tr>
                        <tr id="old_password_tr">
                            <th>비밀번호 확인</th>
                            <td><input type="password" id="old_password"> <span>4~12자 이내 영문과 숫자 조합(대소문자 구별)</span><b onclick="checkPassword()" class="pointer">확인</b></td>
                        </tr>
<!--                        <tr id="password_tr" class="hide">-->
<!--                            <th>비밀번호</th>-->
<!--                            <td><input type="password" name="password" title="비밀번호" disabled> <span>4~12자 이내 영문과 숫자 조합(대소문자 구별)</span></td>-->
<!--                        </tr>-->
<!--                        <tr id="password_confirm_tr" class="hide">-->
<!--                            <th>비밀번호 재입력</th>-->
<!--                            <td><input type="password" id="password_confirm" title="비밀번호 재입력" disabled></td>-->
<!--                        </tr>-->
                        <tr>
                            <th>생년월일</th>
                            <td><input type="date" name="birthday" title="생년월일" class="required" value="<?php echo $loginInfo['birthday'] ?>"></td>
                        </tr>
                        <tr>
                            <th>휴대폰</th>
                            <td><input type="text" name="phone" title="휴대폰" class="required" value="<?php echo $loginInfo['phone'] ?>">
                                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="sns_yn" value="Y" <?php if($loginInfo['sns_yn'] == 'Y') echo 'checked' ?>> <span>예약 및 상담관련 SMS을 받습니다.</span>
                          </td>
                        </tr>
                        <tr>
                            <th>이메일</th>
                          <td><input type="text" name="email" title="이메일" class="required" value="<?php echo $loginInfo['email'] ?>"><br>
                                <span>※ 이메일주소는 아이디찾기, 비밀번호 찾기에 활용되는 정보이므로 정확한 이메일 주소를 입력해주십시오.</span>
                          </td>
                        </tr>
                    </table>
                </li>
            </ul>
           
        </div>
        
        <!-- 버튼 -->
        <div class="txtCenter mt30">
            <input type="submit" class="joinBtn01" value="정보수정">
            <a href="/" class="joinBtn02">취소</a>
        </div>
        </form>
        <!-- //버튼 -->
    </div>  
    
    <!-- 탈퇴 팝업 -->
    <div class="joinPop" id="pop">
        <div class="bg"></div>
        <div class="myPopBox01">
            <div class="txtCenter">
                <dd>회원탈퇴는 번복할 수 없습니다.<br>정말 탈퇴하시겠습니까?</dd>
                <a id="witherawal_real" class="joinBtn05">확인</a>
                <a onclick = "document.all['pop'].style.display = 'none';" class="joinBtn05">취소</a>
            </div>
        </div>
    </div>
    <!-- //탈퇴 팝업 -->
    
     <!-- 탈퇴완료 팝업 -->
    <div class="joinPop" id="pop2">
        <div class="bg"></div>
        <div class="myPopBox01 myPopBox01b">
            <div class="txtCenter">
                <dd><span id="pop2_name"></span>님께서는 <span id="pop2_date"></span>에 회원에서 탈퇴 하셨습니다.</dd>
                <a onclick="window.location.href = '/';" class="joinBtn05">확인</a>
            </div>
        </div>
    </div>
    <!-- //탈퇴완료 팝업 -->
    
</div>
    <script>
        jQuery("#_form").submit(function(event){
            event.preventDefault();
            if (jQuery("#old_password").prop("disabled") === false) {
                alert("비밀번호 확인을 먼저 해주세요");
                jQuery("#old_password").focus();
                return false;
            }

            let checkValidate = validated(jQuery(".required"));
            if (checkValidate === true) {
                jQuery.ajax({
                    type:"POST",
                    url:"../../controller/user_proc.php",
                    dataType:"json",
                    data : new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.result) {
                            alert(response.msg);
                            window.location.reload();
                        } else {
                            alert(response.msg);
                            return false;
                        }
                    }
                })
            }
        })

        const checkPassword = (event) => {
            let old_password = jQuery("#old_password").val();
            if (old_password === "") {
                alert("비밀번호 확인을 입력해주세요.");
                return false;
            } else {
                let password_check_data = {
                    mode: 'password_checked',
                    identity: "<?php echo $loginInfo['identity'] ?>",
                    old_password
                }
                jQuery.ajax({
                    url:"../../../controller/user_proc.php",
                    type:"post",
                    dataType:"json",
                    data : password_check_data,
                    success: function(response) {
                        if (response.result) {
                            alert(response.msg);
                            jQuery("#password_change").removeClass("hide");
                            jQuery("#password_change").css("right", "150px");
                            jQuery("#witherawal").removeClass("hide");
                            jQuery("#old_password").attr("disabled", true);
                            jQuery("#old_password_tr").addClass("hide");
                        } else {
                            alert(response.msg);
                            return false;
                        }
                    }
                })
            }
        }

        jQuery("#witherawal_real").click(function () {
            witherawal_data = {
                mode : 'witherawal',
                id : "<?php echo $loginInfo['id'] ?>"
            };
            jQuery.ajax({
                url:"../../../controller/user_proc.php",
                type:"post",
                dataType:"json",
                data : witherawal_data,
                success: function(response) {
                    if (response.result) {
                        document.getElementById("pop2").style.display = 'inline';
                        jQuery("#pop2_name").text("<?php echo $loginInfo['name'] ?>")
                        const witherawal_today = new Date();
                        const witherawal_year = witherawal_today.getFullYear(); // 년도
                        const witherawal_month = witherawal_today.getMonth() + 1;  // 월
                        const witherawal_date = witherawal_today.getDate();  // 날짜
                        const witherawal_full_date = witherawal_year + '년' + witherawal_month + '월' + witherawal_date + '일';
                        jQuery("#pop2_date").text(witherawal_full_date)
                    } else {
                        alert(response.msg);
                        return false;
                    }
                }
            })
        })

        jQuery("#password_change").click(function (){
            let password_change = {
                mode : 'password_cookie',
            }
            jQuery.ajax({
                url:"../../../controller/user_proc.php",
                type:"post",
                dataType:"json",
                data : password_change,
                success: function(response) {
                    if (response.result) {
                        window.location.href = "/membership/pwchange.php";
                    } else {
                        alert(response.msg);
                        return false;
                    }
                }
            })
        })
    </script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>