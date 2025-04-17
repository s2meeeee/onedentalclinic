<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/head.php';

include_once DAO_PATH.'/BeforeAfterDao.class.php';

$dao = new BeforeAfterDao();

$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$search = !empty($_GET['search']) ? $_GET['search'] : "";
$where = "";

if ($search) {
    $where .= " AND title like '%".$search."%'";
}

$data = $dao->getList("before_afters", $page, "8", $where);
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
        <div class="boardListImg">
            <ul>
                <?php
            if($data['total_cnt'] > 0):
                $no = ($page > 1) ? $data['total_cnt']-(($page-1)*10) : $data['total_cnt'];
                foreach($data['values'] as $value):
                    $pictureOrVideo = empty($value['file_03_name']) ? "[사진]" : "[영상]";
                    ?>
                <?php if($loginInfo): ?>
                <li onclick="location.href='before-after_view.php?id=<?=$value['id']?>&no=<?=$no?>';">
                    <?php else: ?>
                <li>
                    <?php endif; ?>
                    <?php if(empty($value['file_03_name'])): ?>
                    <ol class="img01">
                        <div class="box01"><img src="<?=$value['file_01_path']?>" alt="" />BEFORE</div>
                        <div class="box02"><?php if(!$loginInfo): ?><span>로그인이 필요합니다.</span><?php endif; ?>
                            <img src="<?=$value['file_02_path']?>" alt="" />AFTER</div>
                    </ol>
                    <ol class="info">
                        <dl><?=$value['title']?></dl>
                        <dd><?= substr($value['created_at'], 0, 10)?></dd>
                    </ol>
                    <?php else: ?>
                    <ol class="img01"><?php if(!$loginInfo): ?><span>로그인이 필요합니다.</span><?php endif; ?>
                        <img src="<?=$value['file_03_path']?>" alt="" /></ol>
                    <?php endif; ?>
                    <?php endforeach; else: ?>
                <li style="width: 100%; cursor: auto;">
                    <div style="display: flex; justify-content: center; align-items: center; height: 8vh;">
                        <b style="font-size: 2.4rem;">Before&After가 없습니다.</b>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- 리스트 설명
		1. 등록은 [영상, 사진] 으로 구분
		2. 영상 사진 사이즈 : 580 * 328
		3. 사진 사이즈 : 290*290
		4. Case.262 [영상]  >> 설명 부분에 이부분은 자동으로 순번이 등록되며 영상, 사진 구분자 표시 
        5. 60대 여성 김*은 >> 제목
        6. 내용을 보려면 로그인은 필수 항목이며, 리스트에서 [로그인이 필요합니다.] 이명칭은 로그인 후에 노출 안되게 해주시면 됩니다. 
    -->
        <!-- //리스트 -->



        <!-- 페이지 넘버링 -->
        <div class="boardPage">
            <?php
          if ($data['values']):
              echo printPaging($data['total_cnt'],$_SERVER['QUERY_STRING'], "page", 8, 8);
          endif;
          ?>
        </div>
        <!-- // 페이지 넘버링 -->

    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>