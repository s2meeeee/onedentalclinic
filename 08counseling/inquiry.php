<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/head.php';

include_once DAO_PATH.'/DoctorConsultDao.class.php';

$dao = new DoctorConsultDao();

$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$search = !empty($_GET['search']) ? $_GET['search'] : "";
$where = "";

if ($search) {
    $where .= " AND title like '%".$search."%'";
}

$data = $dao->getList("doctor_consults", $page, '12', $where);
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
        <table class="boardList boardSpeList">
            <colgroup>
                <col width="11%" />
                <col width="*" />
                <col width="10%" />
                <col width="10%" />
                <col width="15%" />
            </colgroup>
            <tbody>
                <tr onclick="location.href='inquiry_view.php';">
                    <th>번호</th>
                    <th>제목</th>
                    <th>답변</th>
                    <th>글쓴이</th>
                    <th>등록일</th>
                </tr>
                <?php
        if($data['total_cnt'] > 0):
            $no = ($page > 1) ? $data['total_cnt']-(($page-1)*10) : $data['total_cnt'];
            foreach($data['values'] as $value):
                ?>
                <?php if ($value['open'] == 'Y'): ?>
                <tr onclick="location.href='inquiry_check.php?id=<?php echo $value['id'] ?>';">
                    <?php else: ?>
                <tr onclick="location.href='inquiry_view.php?id=<?php echo $value['id'] ?>';">
                    <?php endif; ?>
                    <td><?php echo $no-- ?></td>
                    <td><?php echo $value['title'] ?>
                        <?php if ($value['open'] == 'Y'): ?>
                        <img src="/img/board/lock.png" alt="" />
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($value['status'] == 'Y'): ?>
                        <span class="on">답변완료</span>
                        <?php elseif($value['status'] == 'W'): ?>
                        <span>답변보류</span>
                        <?php else: ?>
                        <span>답변대기</span>
                        <?php endif; ?>

                    </td>
                    <td><?php echo substr($value['created_at'],0 ,10) ?></td>
                    <td><?php echo $value['written_by'] ?></td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="5">
                        <p>데이터가 없습니다.</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- //리스트 -->

        <!-- 버튼 -->
        <div class="boardBtn">
            <span class="right">
                <a href="inquiry_write.php" class="on">문의하기</a>
            </span>
        </div>
        <!-- //버튼 -->

        <!-- 페이지 넘버링 -->
        <div class="boardPage">
            <?php
          if ($data['values']):
              echo printPaging($data['total_cnt'],$_SERVER['QUERY_STRING'], "page", 12, 12);
          endif;
          ?>
        </div>
        <!-- // 페이지 넘버링 -->

    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>