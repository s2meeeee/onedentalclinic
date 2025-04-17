<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/head.php';

$backUrl = "/07community/before-after.php";

if (!$loginInfo) {
    alertLocationHref("권한이 없는 페이지입니다.", $backUrl);
}



$where = !empty($_GET['id']) ? " WHERE id = " . $_GET['id'] : "";

if (!$where) {
    alertLocationHref("잘못된 주소입니다.", $backUrl);
}

$beforeAfterNo = empty($_GET['no']) ? $_GET['id'] : $_GET['no'];

include_once DAO_PATH.'/BeforeAfterDao.class.php';

$dao = new BeforeAfterDao();
$data = $dao->getDetail("before_afters", $where);
$dao->board->hitUpBoard('before_afters', $_GET['id']);

if (!$data) {
    alertLocationHref("게시글이 존재하지 않습니다.", $backUrl);
}
$prevNextData = $dao->board->getBoardPrevNext('before_afters', $_GET['id']);
?>

<div id="wrapper">
    <div class="inner">
        <!-- 리스트 -->
        <div class="boardView">
            <ul>
                <li><b>Case.<?= $beforeAfterNo ?></b> <?= $data['title'] ?></li>
            </ul>
            <ul class="lineB">
                <li><?= $data['written_by'] ?> l <?= substr($data['created_at'], 0, 10) ?></li>

            </ul>
            <ul class="lineC">
                <li><b>치료위치</b> | <?= $data['therapy_location'] ?><br>
                    <b>임플란트 개수</b> | <?= $data['implant_number'] ?><br>
                    <b>세부사항</b> | <?= $data['detail'] ?><br><br><br>

                    <div class="boardViewBefore">
                        <?php if(empty($data['file_01_name']) && empty($data['file_02_name'])): ?>
                        <ol class="img01"><img style="width: 100%;" src="<?= $data['file_03_path'] ?>" alt="" /></ol>
                        <?php endif; ?>
                        <?php if(empty($data['file_03_name'])): ?>
                        <ol class="img01">
                            <div class="box01"><img style="width: 100%;" src="<?= $data['file_01_path'] ?>"
                                    alt="" />BEFORE</div>
                            <div class="box02"><img style="width: 100%;" src="<?= $data['file_02_path'] ?>"
                                    alt="" />AFTER</div>
                        </ol>
                        <?php endif; ?>
                    </div>

                </li>
            </ul>
        </div>
        <!-- //리스트 -->

        <!-- 버튼 -->
        <div class="boardBtn">
            <span class="right">
                <a href="before-after.php" class="list">목록</a>
            </span>
        </div>
        <!-- //버튼 -->

        <!-- 이전 이후 글 -->
        <div class="boardBottomList">
            <ul>
                <?php if($prevNextData[1]): ?>
                <li><span>이전</span><a
                        href="/07community/before-after_view.php?id=<?= $prevNextData[1]['id']; ?>"><?= $prevNextData[1]['title']; ?></a>
                </li>
                <?php endif; ?>
                <?php if($prevNextData[0]): ?>
                <li><span>다음</span><a
                        href="/07community/before-after_view.php?id=<?= $prevNextData[0]['id']; ?>"><?= $prevNextData[0]['title']; ?></a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- //이전 이후 글 -->

    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>