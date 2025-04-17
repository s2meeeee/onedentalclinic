<?php include $_SERVER['DOCUMENT_ROOT'].'/include/head.php'; ?>

<div id="wrapper">
    <div class="inner1200 ">
		<div class="txtCenter mt200">
			<img src="/img/membership/logo.png">
			<dt class="fs35 mt40">원치과에 방문해 주셔서 감사합니다.</dt>
			<dl class="fs18">홈페이지 서비스를 이용하기 위해서는 로그인해 주시기 바랍니다.</dl>
		</div>
        <div class="loginBox01 mt40">
            <ul>
                <form id="_form" method="post">
                <input type="hidden" name="mode" value="login">
                    <li><span>아이디</span><input type="text" name="identity" title="아이디" class="required" placeholder="아이디를 입력해주세요">
                <input type="submit" class="btn01" value="로그인"></li>
                <li><span>비밀번호</span><input type="password" name="password" title="비밀번호" class="required" placeholder="비밀번호를 입력해주세요"></li>
                </form>
            </ul>
            <ul>
                <li><span>원치과만의 특별한 서비스를 만나보세요.</span> <a href="<?php echo join_url ?>" class="btn02">회원가입</a></li>
                <li><span>아이디, 비밀번호를 잊으셨나요?</span> <a href="<?php echo lid_url ?>" class="btn03">회원정보 찾기</a></li>
            </ul>
        </div>    
    </div>
</div>
    <script>
        jQuery("#_form").submit(function(event){
            event.preventDefault();
            let checkValidate = validated(jQuery(".required"));
            if (checkValidate === true) {
                jQuery.ajax({
                    type:"POST",
                    url:"../../controller/login_proc.php",
                    dataType:"json",
                    data : new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.result) {
                            alert("로그인에 성공하였습니다.");
                            window.location.href = "/"
                        } else {
                            alert(response.msg);
                            return false;
                        }
                    }
                })
            }
        })
    </script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>