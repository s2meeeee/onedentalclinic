<?php
require_once dirname(__FILE__).'/../layouts/main.php';
include_once DAO_PATH.'/UserDao.class.php';
$backUrl = "/admin/user";

$where = " WHERE id = ".$userInfo['id'];

$dao = new UserDao();

$data = $dao->getDetail("users", $where);

if (!$data) {
    alertLocationHref("게시글이 존재하지 않습니다.", $backUrl);
}

?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("비밀번호변경", "회원관리", "비밀번호변경"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post">
                    <input type="hidden" name="mode" value="password_change" readonly>
                    <input type="hidden" name="id" value=<?php echo $data['id'] ?> readonly>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>아이디</label>
                                <input type="text" id="identity" readonly value="<?php echo $data['identity'] ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label class="text-danger">기존 비밀번호 <span class="pointer" id="password_checked" style="color: blue;">확인하기</span></label>
                                <input type="password" id="old_password" name="old_password" title="비밀번호 확인"
                                       placeholder="비밀번호 확인을 입력해주세요.">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label class="text-danger">새로운 비밀번호</label>
                                <input type="password" name="password" title="새로운 비밀번호" class="required"
                                       placeholder="새로운 비밀번호를 입력해주세요.">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label class="text-danger">새로운 비밀번호 확인</label>
                                <input type="password" id="password_confirm" title="새로운 비밀번호 확인" class="required"
                                       placeholder="새로운 비밀번호 확인을 입력해주세요.">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn info-btn btn-hover" href="/admin/user">목록</a>
                            <input type="submit" class="btn primary-btn btn-hover" value="비밀번호 변경" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    jQuery("#_form").submit(function(event){

        event.preventDefault();
        const password = jQuery("input[name=password]").val();
        const passwordConfirm = jQuery("#password_confirm").val();

        if (jQuery("#old_password").is(":disabled") === false) {
            alert("기존 비밀번호를 확인해주세요.");
            jQuery("#old_password").focus();
            return false;
        }

        let checkValidate = validated(jQuery(".required"));



        if (password !== passwordConfirm) {
            alert("비밀번호와 비밀번호 확인이 일치하지 않습니다.");
            return false;
        }
        let data = jQuery(this).serializeArray();
        if (checkValidate === true) {
            jQuery.ajax({
                url:"../../controller/user_proc.php",
                type:"post",
                dataType:"json",
                data,
                success: function(response) {
                    if (response.result) {
                        alert(response.msg);
                        location.reload();
                    } else {
                        alert(response.msg);
                        return false;
                    }
                }
            })
        }
    })


    jQuery("#password_checked").click(function() {
        const old_password = jQuery("#old_password").val();
        const identity = jQuery("#identity").val();

        if (old_password === "") {
            alert("기존 비밀번호를 입력해주세요.");
            jQuery("#old_password").focus();
            return false;
        }
        if (passwordReg.test(old_password) === false) {
            alert("비밀번호는 영어,숫자,특수문자가 하나씩 포함 8자 이상 16자 이하가 되어야 합니다.");
            jQuery("#old_password").focus();
            return false;
        }
        data = {
            mode : 'password_checked',
            identity,
            old_password
        }
        jQuery.ajax({
            url:"../../controller/user_proc.php",
            type:"post",
            dataType:"json",
            data,
            success: function(response) {
                if (response.result) {
                    alert(response.msg);
                    jQuery("#identity").attr("disabled", true)
                    jQuery("#old_password").attr("disabled", true).prop("readonly", true)
                    jQuery("#password_checked").remove();
                } else {
                    alert(response.msg);
                    return false;
                }
            }
        })
    })
</script>
<?php require_once dirname(__FILE__).'/../layouts/bottom.php'; ?>
