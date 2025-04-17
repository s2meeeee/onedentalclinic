<?php include $_SERVER['DOCUMENT_ROOT'].'/include/head.php'; ?>
<?php
if (!$loginInfo) {
    alertLocationHref("권한지 없는 페이지입니다.", "/");
}

if (empty($_SESSION['pwchange']) && empty($_COOKIE['pwchange'])) {
    alertLocationHref("권한지 없는 페이지입니다.", "/");
}

if ($_SESSION['pwchange'] !== $_COOKIE['pwchange']) {
    alertLocationHref("권한지 없는 페이지입니다.", "/");
}

?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/sub_top.php'; ?>

<div id="wrapper">
    <div class="inner1200 mt50">
        <div class="txtCenter fs42"><dt>비밀번호 변경</dt></div>
        <form id="_form" method="post">
            <input type="hidden" name="mode" value="update" readonly>
            <input type="hidden" name="id" value="<?php echo $loginInfo['id'] ?>" readonly>
        <div class="joinBox01 joinBox01b">
            <ul>
                <li><h2>회원정보</h2>
                </li>
                <li>
                    <table>
                        <tr>
                            <th>아이디</th>
                            <td><?php echo $loginInfo['identity'] ?></td>
                        </tr>
                        <tr id="password_tr">
                            <th>비밀번호</th>
                            <td><input type="password" name="password" id="password" title="비밀번호" placeholder="비밀번호 입력"> <span>4~12자 이내 영문과 숫자 조합(대소문자 구별)</span></td>
                        </tr>
                        <tr id="password_confirm_tr">
                            <th>비밀번호 확인</th>
                            <td><input type="password" id="password_confirm" title="비밀번호 확인" placeholder="비밀번호 확인 입력"></td>
                        </tr>
                    </table>
                </li>
            </ul>
           
        </div>
        
        <!-- 버튼 -->
        <div class="txtCenter mt30">
            <input type="submit" class="joinBtn01" value="PW수정">
            <a href="/" class="joinBtn02">취소</a>
        </div>
        </form>
        <!-- //버튼 -->
    </div>
    
</div>
    <script>
        jQuery("#_form").submit(function(event){
            event.preventDefault();
            const password = jQuery("#password").val();
            const password_confirm = jQuery("#password_confirm").val();
            if (password === "") {
                alert("비밀번호를 입력해주세요");
                jQuery("#password").focus();
                return false;
            } else if (passwordReg.test(password) === false) {
                alert("비밀번호는 영어,숫자,특수문자가 하나씩 포함 8자 이상 16자 이하가 되어야 합니다");
                jQuery("#password").focus()
                return false;
            }
            if (password_confirm === "") {
                alert("비밀번호 확인을 입력해주세요");
                jQuery("#password_confirm").focus();
                return false;
            }
            if (password !== password_confirm) {
                alert("비밀번호와 비밀번호 확인이 일치하지 않습니다.");
                jQuery("#password").focus();
                return false;
            }
            let password_change = {
                mode : 'password_change',
                id : "<?php echo $loginInfo['id'] ?>",
                password
            }
            jQuery.ajax({
                type:"POST",
                url:"../../controller/user_proc.php",
                dataType:"json",
                data : password_change,
                success: function(response) {
                    if (response.result) {
                        alert(response.msg);
                        window.location.href = "/";
                    } else {
                        alert(response.msg);
                        return false;
                    }
                }
            })
        });
    </script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>