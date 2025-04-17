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
                                <input type="text" readonly disabled value="<?php echo $data['identity'] ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label class="text-danger">새로운 비밀번호</label>
                                <input type="password" name="password" title="새로운 비밀번호" class="required"
                                       placeholder="새로운 비밀번호를 입력해주세요.">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn info-btn btn-hover" onclick="window.history.back();">목록</a>
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
        let checkValidate = validated(jQuery(".required"));
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
</script>
<?php require_once dirname(__FILE__).'/../layouts/bottom.php'; ?>
