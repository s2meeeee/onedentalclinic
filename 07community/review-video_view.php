<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/head.php';

$backUrl = "/07community/review-video.php";

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
$prevNextData = $dao->board->getBoardPrevNext('posts', $_GET['id'], "videoReview");
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
            <li><b>치료위치</b>  |  <?= $data['therapy_location'] ?><br>
                <b>임플란트 개수</b>  |  <?= $data['implant_number'] ?><br>
                <br>
                <div class="boardViewBefore">
                    <ol class="img02"><img style="width: 100%;" src="<?= $data['file_01_path'] ?>"  alt=""/></ol>
                </div>

            </li>
        </ul>
    </div>
    <!-- 버튼 -->
    <div class="boardBtn" >
		 <span class="right" >
            <a href="review-video.php" class="list">목록</a>
		</span>	 
    </div>
   <!-- //버튼 -->
	  
   <!-- 이전 이후 글 -->
	<div class="boardBottomList">
		<ul>
            <?php if($prevNextData[1]): ?>
                <li><span>이전</span><a href="/07community/review-video_view.php?id=<?= $prevNextData[1]['id']; ?>"><?= $prevNextData[1]['title']; ?></a></li>
            <?php endif; ?>
            <?php if($prevNextData[0]): ?>
                <li><span>다음</span><a href="/07community/review-video_view.php?id=<?= $prevNextData[0]['id']; ?>"><?= $prevNextData[0]['title']; ?></a></li>
            <?php endif; ?>
		</ul>
	</div>
   <!-- //이전 이후 글 -->	  
    
  </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>
