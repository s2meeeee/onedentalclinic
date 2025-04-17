<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/head.php';

include_once DAO_PATH.'/NoticeDao.class.php';

$dao = new NoticeDao();

$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$search = !empty($_GET['search']) ? $_GET['search'] : "";
$where = " AND gubun = 'notice'";

if ($search) {
    $where .= " AND title like '%".$search."%'";
}

$data = $dao->getList("notices", $page, "9", $where);
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
    <table class="boardList">
      <colgroup>
          <col width="10%" />
          <col width="*"/>
          <col width="12%" />
          <col width="15%" />
      </colgroup>
      <tbody>
        <tr onclick="location.href='notice_view.php';">
          <th>번호</th>
          <th>제목</th>
          <th>글쓴이</th>    
          <th>등록일</th>
        </tr>
    <?php
    if($data['total_cnt'] > 0):
        $no = ($page > 1) ? $data['total_cnt']-(($page-1)*10) : $data['total_cnt'];
        foreach($data['values'] as $value):
            ?>
        <tr onclick="location.href='notice_view.php?id=<?= $value['id']; ?>';">
          <td><?= $no-- ?></td>
          <td><?= $value['title'] ?></td>
          <td><?= $value['written_by'] ?></td>
          <td><?= substr($value['created_at'], 0, 10) ?></td>
        </tr>
        <?php endforeach; else: ?>
        <tr>
            <td colspan="4">공지사항이 없습니다.</td>
        </tr>
    <?php endif; ?>
      </tbody>
    </table>
    
    <!-- //리스트 --> 
      

      
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