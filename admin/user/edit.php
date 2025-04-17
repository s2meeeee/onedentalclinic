<?php
require_once dirname(__FILE__).'/../layouts/main.php';
include_once DAO_PATH.'/UserDao.class.php';
$backUrl = "/admin/user";


$where = !empty($_GET['id']) ? " WHERE id = " . $_GET['id'] : "";

if (!$where) {
    alertLocationHref("잘못된 주소입니다.", $backUrl);
}

$dao = new UserDao();

$data = $dao->getDetail("users", $where);

if (!$data) {
    alertLocationHref("게시글이 존재하지 않습니다.", $backUrl);
}

?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("회원수정", "회원관리", "회원수정"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post">
                    <input type="hidden" name="mode" value="update" readonly>
                    <input type="hidden" name="id" value=<?php echo $data['id'] ?> readonly>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>아이디</label>
                                <input type="text" readonly disabled value="<?php echo $data['identity'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이룸</label>
                                <input type="text" name="name" title="이름" value="<?php echo $data['name'] ?>"
                                       placeholder="이름을 입력해주세요.">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">이메일</label>
                                <input type="email" name="email" title="이메일" value="<?php echo $data['email'] ?>"
                                       class="required" placeholder="이메일을 입력해주세요">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">전화번호</label>
                                <input type="text" name="phone" title="전화번호" value="<?php echo $data['phone'] ?>"
                                       class="required" placeholder="전화번호를 입력해주세요">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="select-style-1">
                                <label class="text-danger">성별</label>
                                <div class="select-position">
                                    <select name="gender">
                                        <option value="M" <?php if($data['gender'] == "M") echo 'selected' ?>>남자</option>
                                        <option value="F" <?php if($data['gender'] == "F") echo 'selected' ?>>여자</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="select-style-1">
                                <label class="text-danger">구분</label>
                                <div class="select-position">
                                    <select name="gubun">
                                        <option value="customer" <?php if($data['gubun'] == "customer") echo 'selected' ?>>고객</option>
                                        <option value="worker" <?php if($data['gubun'] == "worker") echo 'selected' ?>>직원</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="">생년월일</label>
                                <input type="date" name="birthday" title="생년월일"
                                       placeholder="생년월일을 입력해주세요 (19000101)" value="<?php echo $data['birthday'] ?>"
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-between">
                        <a class="btn info-btn btn-hover" href="/admin/user">목록</a>
                        <div>
                            <a href="/admin/user/password.php?id=<?php echo $data['id'] ?>" class="btn btn-info btn-hover text-white me-3" >비밀번호 변경</a>
                            <input type="submit" class="btn primary-btn btn-hover" value="수정" />
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
            jQuery.ajax({
                url:"../../../controller/user_proc.php",
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
</script>
<?php require_once dirname(__FILE__).'/../layouts/bottom.php'; ?>
