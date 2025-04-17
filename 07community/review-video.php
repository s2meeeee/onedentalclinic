<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/head.php';

include_once DAO_PATH.'/PostDao.class.php';

$dao = new PostDao();

$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$search = !empty($_GET['search']) ? $_GET['search'] : "";
$where = " AND gubun = 'videoReview'";

if ($search) {
    $where .= " AND title like '%".$search."%'";
}

$data = $dao->getList("posts", $page, "9", $where);
?>
<div id="wrapper">
    <div class="inner">

        <!-- 검색 -->
        <div class="boardSearch">
            <form method="get">
                <select name="search">
                    <option value="title">제목</option>
                </select>
                <input type="text" name="search" value="<?php echo $search ?>" placeholder="검색어를 입력하세요.">
                <input type="hidden" name="page" value="<?php echo $page ?>">
                <input type="submit" value="검색">
            </form>
        </div>
        <!-- //검색 -->

        <!-- 리스트 -->
        <div class="boardListImg boardListImg2">
            <ul>
                <?php
        if($data['total_cnt'] > 0):
            $no = ($page > 1) ? $data['total_cnt']-(($page-1)*10) : $data['total_cnt'];
            foreach($data['values'] as $value):
                ?>
                <li onclick="location.href='review-video_view.php?id=<?= $value['id']; ?>';">
                    <ol class="img01"><img style="width: 100%;" src="<?= $value['file_01_path']; ?>"
                            alt="<?= $value['title']; ?>" /></ol>
                    <ol class="info">
                        <dt>원치과 임플란트 #<?= $no--;?> <?= $value['title']; ?></dt>
                        <dd><?= substr($value['created_at'], 0, 10); ?></dd>
                    </ol>
                </li>
                <?php endforeach; else: ?>
                <li style="width: 100%; cursor: auto;">
                    <div style="display: flex; justify-content: center; align-items: center; height: 8vh;">
                        <b style="font-size: 2.4rem;">영상후기가 없습니다.</b>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- //리스트 -->



        <!-- 페이지 넘버링 -->
        <div class="boardPage">
            <?php
          if ($data['values']):
              echo printPaging($data['total_cnt'],$_SERVER['QUERY_STRING'], "page", 9, 9);
          endif;
          ?>
        </div>
        <!-- // 페이지 넘버링 -->

    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>