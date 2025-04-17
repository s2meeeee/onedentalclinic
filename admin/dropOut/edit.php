<?php
require_once dirname(__FILE__).'/../layouts/main.php';
include_once DAO_PATH.'/UserDao.class.php';
include_once DAO_PATH.'/BranchDao.class.php';
$backUrl = "/adm/super/user";


$where = !empty($_GET['id']) ? " WHERE id = " . $_GET['id'] : "";

if (!$where) {
    alertLocationHref("잘못된 주소입니다.", $backUrl);
}

$branchDao = new BranchDao();
$branches = $branchDao->getIndexTitle();

$dao = new UserDao();

$data = $dao->getDetail("jm_users", $where);

if (!$data) {
    alertLocationHref("게시글이 존재하지 않습니다.", $backUrl);
}
$gubunTitle = "";
if ($data['gubun'] == 1) {
    $gubunTitle = "일반회원";
} else if($data['gubun'] == 2) {
    $gubunTitle = "관리자";
}

?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("탈퇴회원 수정", "탈퇴회원 관리", "탈퇴회원 수정"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post">
                    <input type="hidden" name="mode" value="update" readonly>
                    <input type="hidden" name="id" value=<?php echo $data['id'] ?> readonly>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>지점</label>
                                <div class="select-position">
                                        <?php foreach($branches as $branch):?>
                                            <?php if($data['branch_id'] == $branch['id']): ?>
                                                <input type="text" readonly disabled value="<?php echo $branch['name'] ?>">
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
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
                                       placeholder="이름을 입력해주세요." readonly disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이메일</label>
                                <input type="email" name="email" title="이메일" value="<?php echo $data['email'] ?>"
                                       placeholder="이메일을 입력해주세요" readonly disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>전화번호</label>
                                <input type="text" name="phone" title="전화번호" value="<?php echo $data['phone'] ?>"
                                       placeholder="전화번호를 입력해주세요 (-포함)" readonly disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>회원유형</label>
                                <input type="text" name="phone" title="전화번호" value="<?php echo $gubunTitle ?>"
                                       placeholder="전화번호를 입력해주세요 (-포함)" readonly disabled>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>탈퇴이유</label>
                                <textarea cols="30" rows="10" readonly disabled><?php echo $data['why_out'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn info-btn btn-hover" href="/adm/super/dropOut">목록</a>
                            <div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require_once dirname(__FILE__).'/../layouts/bottom.php'; ?>
