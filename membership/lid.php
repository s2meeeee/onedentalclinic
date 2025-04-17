<?php include $_SERVER['DOCUMENT_ROOT'].'/include/head.php'; ?>

<div id="wrapper">
    <div class="inner1200 mt100">
        <div class="txtCenter fs42"><dt>회원정보 찾기</dt></div>
        <div class="lidBox01 mt100">
            <div class="fs24 txtCenter mt30px">원치과는은 회원 여러분의 소중한 개인정보를 보호하기 위하여 최선의 노력을 다하고 있습니다.</div>
            <ul>
                <li>
                    <dt>아이디찾기</dt>
                    <dl><span>이름</span><input type="text" name="name" id="find__id__name" placeholder="이름을 입력해주세요"></dl>
                    <dl><span>이메일</span><input type="text" name="email" id="find__id__email" placeholder="이메일을 입력해주세요"></dl>
                    <a class="btn01" id="find__id__btn">확인</a>
                </li>
                <li>
                    <dt>비밀번호찾기</dt>
                    <dl><span>이름</span><input type="text" name="name" id="find__pw__name" placeholder="이름을 입력해주세요"></dl>
                    <dl><span>아이디</span><input type="text" name="identity" id="find__pw__identity" placeholder="아이디를 입력해주세요"></dl>
                    <dl><span>이메일</span><input type="text" name="email" id="find__pw__email" placeholder="이메일을 입력해주세요"></dl>
                    <a id="find__pw__btn" class="btn01">확인</a>
                </li>
            </ul>
        </div>
        
    </div>
    
     <!-- 아이디찾기 팝업 -->
    <div class="joinPop" id="find_id_pop">
        <div class="bg"></div>
        <div class="lidPopBox01">
            <div class="txtCenter">
                <dt>아이디 찾기 결과</dt>
                <dd><b id="find__pop_name"></b>회원님, 아이디는 <b id="find__pop_id"></b>입니다.</dd>
                <a onclick = "window.location.href = '/membership/login.php'" class="joinBtn03">확인</a>
            </div>
        </div>
    </div>
    <!-- //아이디찾기 팝업 -->
    
     <!-- 비밀번호찾기 팝업 -->
    <div class="joinPop" id="find_pw_pop">
        <div class="bg"></div>
        <div class="lidPopBox01">
            <div class="txtCenter">
                <dt>비밀번호 찾기 결과</dt>
                <dd><b id="find_pw_name"></b>회원님, 임시 비밀번호는 <b id="find_pw_password"></b>입니다.</dd>
                <a onclick = "window.location.href = '/membership/login.php'" class="joinBtn03">확인</a>
            </div>
        </div>
    </div>
    <!-- //비밀번호찾기 팝업 -->
    
</div>
    <script>
        jQuery("#find__id__btn").click(function () {
            const name = jQuery("#find__id__name").val();
            const email = jQuery("#find__id__email").val();
            if (name === "") {
                alert("이름을 입력해주세요");
                jQuery("#find__id__name").focus();
                return false;
            }
            if (email === "") {
                alert("이메일을 입력해주세요");
                jQuery("#find__id__email").focus();
                return false;
            } else if (emailReg.test(email) === false) {
                alert("이메일 주소 형식이 잘못되었습니다");
                jQuery("#find__id__email").focus();
                return false;
            }
            const find_id_data = {
                mode: 'find_id',
                name,
                email
            };
            jQuery.ajax({
                type:"POST",
                url:"../../controller/user_proc.php",
                dataType:"json",
                data : find_id_data,
                success: function(response) {
                    if (response.result) {
                        document.getElementById("find_id_pop").style.display = 'inline';
                        jQuery("#find__pop_name").text(name);
                        jQuery("#find__pop_id").text(response.msg);
                    } else {
                        alert(response.msg);
                        return false;
                    }
                }
            })
        })

        jQuery("#find__pw__btn").click(function () {
            const name = jQuery("#find__pw__name").val();
            const identity = jQuery("#find__pw__identity").val();
            const email = jQuery("#find__pw__email").val();
            if (name === "") {
                alert("이름을 입력해주세요");
                jQuery("#find__pw__name").focus();
                return false;
            }
            if (identity === "") {
                alert("아이디를 입력해주세요");
                jQuery("#find__pw__identity").focus();
                return false;
            }
            if (email === "") {
                alert("이메일을 입력해주세요");
                jQuery("#find__pw__email").focus();
                return false;
            } else if (emailReg.test(email) === false) {
                alert("이메일 주소 형식이 잘못되었습니다");
                jQuery("#find__pw__email").focus();
                return false;
            }

            const find_id_data = {
                mode: 'find_password',
                name,
                identity,
                email
            };
            jQuery.ajax({
                type:"POST",
                url:"../../controller/user_proc.php",
                dataType:"json",
                data : find_id_data,
                success: function(response) {
                    if (response.result) {
                        document.getElementById("find_pw_pop").style.display = 'inline';
                        jQuery("#find_pw_name").text(name);
                        jQuery("#find_pw_password").text(response.msg);
                    } else {
                        alert(response.msg);
                        return false;
                    }
                }
            })
        })
    </script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>