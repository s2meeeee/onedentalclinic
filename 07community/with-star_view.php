<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/head.php';

$backUrl = "/07community/with-star.php";

$where = !empty($_GET['id']) ? " WHERE id = " . $_GET['id'] : "";

if (!$where) {
    alertLocationHref("잘못된 주소입니다.", $backUrl);
}

include_once DAO_PATH.'/PostDao.class.php';

$dao = new PostDao();
$data = $dao->getDetail("posts", $where);
$dao->board->hitUpBoard('posts', $_GET['id']);

if (!$data) {
    alertLocationHref("게시글이 존재하지 않습니다.", $backUrl);
}
$prevNextData = $dao->board->getBoardPrevNext('posts', $_GET['id'], "withStar");
?>
<div id="wrapper">
    <div class="inner">
        <!-- 리스트 -->
        <div class="boardView">
            <ul>
                <li><?= $data['title']; ?></li>
            </ul>
            <ul class="lineB">
                <li><?= $data['written_by']; ?> l <?php echo  substr($data['created_at'], 0, 10); ?></li>

            </ul>
            <ul class="lineC">
                <li>
                    <!-- 내용 -->
                    <div style="text-align: center">
                        <?php echo $data['content']; ?>
                    </div>
                    <!-- //내용 -->
                </li>
            </ul>
        </div>
        <!-- //리스트 -->

        <!-- 버튼 -->
        <div class="boardBtn">
            <span class="right">
                <a href="with-star.php" class="list">목록</a>
            </span>
        </div>
        <!-- //버튼 -->

        <!-- 이전 이후 글 -->
        <div class="boardBottomList">
            <ul>
                <?php if($prevNextData[1]): ?>
                <li><span>이전</span><a
                        href="/07community/with-star_view.php?id=<?= $prevNextData[1]['id']; ?>"><?= $prevNextData[1]['title']; ?></a>
                </li>
                <?php endif; ?>
                <?php if($prevNextData[0]): ?>
                <li><span>다음</span><a
                        href="/07community/with-star_view.php?id=<?= $prevNextData[0]['id']; ?>"><?= $prevNextData[0]['title']; ?></a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- //이전 이후 글 -->

    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>