<?php
require_once dirname(__FILE__).'/../layouts/main.php';
include_once DAO_PATH.'/ConsultDao.class.php';
include_once DAO_PATH.'/DefaultDao.class.php';;

$dao = new ConsultDao();

$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$search = !empty($_GET['search']) ? $_GET['search'] : "";
$where = " AND types= 'fast'";

if ($search) {
    $where .= " AND (written_by like '%".$search."%')";
}
$controller_proc = "consult_proc.php";
$table = "consult";

$excel_title = "빠른 상담  ".date("Y-m-d h:i:s");

$data = $dao->getList($table, $page, '10', $where);

?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("빠른상담 목록", "빠른상담 관리", "빠른상담 목록"); ?>
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <div class="d-none d-md-flex justify-content-between align-items-center mb-10">
                            <h6>전체글</h6>
                            <div class="d-flex">
                                <form method="get" class="d-flex">
                                    <input type="hidden" name="page" value="<?php echo $page ?>">
                                    <div class="d-flex position-relative bg-light board-search ms-2 w-auto">
                                        <input type="text" name="search" value="<?php echo $search ?>"
                                               class="form-control" placeholder="작성자, 제목">
                                        <button class="position-absolute top-0 border-0 bg-transparent"
                                                style="height:38px; right:10px;">
                                            <i class="lni lni-search-alt"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><h6>No</h6></th>
                                    <th><h6>작성자</h6></th>
                                    <th><h6>전화번호</h6></th>
                                    <th><h6>상태</h6></th>
                                    <th><h6>답글갯수</h6></th>
                                    <th><h6>생성일</h6></th>
                                    <th><h6>삭제</h6></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($data['total_cnt'] > 0):
                                    $no = ($page > 1) ? $data['total_cnt']-(($page-1)*10) : $data['total_cnt'];
                                    foreach($data['values'] as $value):
                                        ?>
                                        <tr>
                                            <td class="min-width">
                                                <p><?php echo $no--; ?></p>
                                            </td>
                                            <td class="min-width">
                                                <p>
                                                    <a href="/admin/fast/edit.php?id=<?php echo $value['id'] ?>"> <?php echo $value['written_by']; ?></a>
                                                </p>
                                            </td>
                                            <td class="min-width">
                                                <p><?php echo $value['phone'] ?? "-" ?></p>
                                            </td>
                                            <td class="min-width">
                                                <p><?php echo statusConsultText($value['status']); ?></p>
                                            </td>
                                            <td class="min-width">
                                                <p><?php echo $dao->default->getCommentCount('consult_comment', 'consult_id', $value['id']) ?></p>
                                            </td>
                                            <td class="min-width">
                                                <div class="lead-text">
                                                    <p><?php echo substr($value['created_at'], 0, 10) ?></p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="action">
                                                    <div
                                                            onclick="deleteItem(<?php echo $value['id'] ?>)">
                                                        <button class="text-danger">
                                                            <i class="lni lni-trash-can"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; else: ?>
                                    <tr>
                                        <td class="min-width">
                                            <div class="lead">
                                                <div class="lead-text">
                                                    <p>데이터가 없습니다.</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <?php
                                if ($data['values']):
                                    echo printPaging($data['total_cnt'],$_SERVER['QUERY_STRING']);
                                endif;
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<script>
    const deleteItem = (id) => {
        if (confirm("삭제하시겠습니까?")) {
            let data = {
                id,
                'mode' : 'delete'
            }
            jQuery.ajax({
                url:"../../../controller/<?php echo $controller_proc ?>",
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
    }
</script>
<?php require_once dirname(__FILE__).'/../layouts/bottom.php'; ?>
