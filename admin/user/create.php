<?php
require_once dirname(__FILE__).'/../layouts/main.php';
include_once CLASS_PATH.'/MysqlDB.class.php';

?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("회원등록", "회원관리", "회원등록"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post">
                    <input type="hidden" name="mode" value="insert" readonly>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">
                                    아이디
                                    <span
                                        id="checkId" class="pointer ms-2 text-black"
                                        onclick="checkId()"
                                    >
                                        중복확인
                                    </span>
                                </label>
                                <input type="text" name="identity" title="아이디" class="required"
                                       placeholder="아이디를 입력해주세요">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">비밀번호</label>
                                <input type="password" name="password" title="비밀번호" class="required"
                                       placeholder="비밀번호를 입력해주세요">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이름</label>
                                <input type="text" name="name" title="이름"
                                       placeholder="이름을 입력해주세요">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">이메일</label>
                                <input type="email" name="email" title="이메일" class="required"
                                       placeholder="이메일을 입력해주세요">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">전화번호</label>
                                <input type="text" name="phone" title="전화번호" class="required"
                                       placeholder="전화번호를 입력해주세요">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="select-style-1">
                                <label class="text-danger">성별</label>
                                <div class="select-position">
                                    <select name="gender">
                                        <option value="M">남자</option>
                                        <option value="F">여자</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="select-style-1">
                                <label class="text-danger">구분</label>
                                <div class="select-position">
                                    <select name="gubun">
                                        <option value="customer">고객</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="">생년월일</label>
                                <input type="date" name="birthday" title="생년월일"
                                       placeholder="생년월일을 입력해주세요 (19000101)">
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn info-btn btn-hover" href="/admin/user">목록</a>
                            <input type="submit" class="btn primary-btn btn-hover" value="등록" />
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
        let checkValidate = validated(jQuery(".required"));

        let data = jQuery(this).serializeArray();
        if (checkValidate === true) {
            if (jQuery("#checkId") && jQuery("input[name=identity]").is('[readonly]') === false) {
                alert("아이디 중복확인을 해주세요.");
                return false;
            }
            jQuery.ajax({
                url:"../../controller/user_proc.php",
                type:"post",
                dataType:"json",
                data,
                success: function(response) {
                    if (response.result) {
                        alert(response.msg);
                        location.href = '/admin/user';
                    } else {
                        alert(response.msg);
                        return false;
                    }
                }
            })
        }
    })

    const checkId = () => {
        const identity = jQuery("input[name=identity]");
        if (identity.val() === "") {
            alert("아이디를 입력해주세요");
            identity.focus();
            return false;
        } else {
            data = {
                mode: 'check_id',
                identity: identity.val()
            }
            jQuery.ajax({
                url:"../../controller/user_proc.php",
                type:"post",
                dataType:"json",
                data,
                success: function(response) {
                    console.log(response);
                    if (response.result) {
                        alert(response.msg);
                        jQuery("#checkId").remove();
                        identity.attr('readonly', true)
                    } else {
                        alert(response.msg);
                        return false;
                    }
                }
            })
        }
    }
</script>
<?php require_once dirname(__FILE__).'/../layouts/bottom.php'; ?>
