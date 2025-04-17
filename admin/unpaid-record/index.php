<?php
require_once dirname(__FILE__).'/../layouts/main.php';
include_once DAO_PATH.'/UnpaidRecordDao.class.php';

$dao = new UnpaidRecordDao();

$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$search = !empty($_GET['search']) ? $_GET['search'] : "";
$where = "";

if ($search) {
    $where .= " AND (designation like '%".$search."%')";
}
$controller_proc = "unpaid_record_proc.php";
$table = "unpaid_record";
$excel_title = "비급여 사본 기록 ".date("Y-m-d h:i:s");

$data = $dao->getList($table, $where, $page, '10');

$order_number = $data['total_cnt'];

?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("비급여 의무기록 사본 목록", "비급여 의무기록 사본 관리", "비급여 의무기록 사본 목록"); ?>
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
                                               class="form-control" placeholder="명칭">
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
                                    <th><h6>표준코드</h6></th>
<!--                                    <th><h6>수가코드</h6></th>-->
                                    <th><h6>명칭</h6></th>
                                    <th><h6>비용</h6></th>
                                    <th><h6>특이사항</h6></th>
                                    <th><h6>최종<br/>변경일</h6></th>
                                    <th><h6>노출<br/>순위</h6></th>
                                    <th><h6>노출<br/>순위2</h6></th>
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
                                                <p><?php echo $value['codename'] ?? "-" ?></p>
                                            </td>
<!--                                            <td class="min-width">-->
<!--                                                <p>--><?php //echo $value['koicd'] ?? "-" ?><!--</p>-->
<!--                                            </td>-->
                                            <td class="min-width">
                                                <p>
                                                    <a href="/admin/unpaid-record/edit.php?id=<?php echo $value['id'] ?>" title="<?php echo $value['designation'] ?>">
                                                        <?php echo $value['designation']; ?>
                                                    </a>
                                                </p>
                                            </td>
                                            <td class="min-width">
                                                <p><?php echo $value['cost'] ?? "-" ?></p>
                                            </td>
                                            <td class="min-width">
                                                <p><?php echo $value['uniqueness'] ?? "-" ?></p>
                                            </td>
                                            <td class="min-width">
                                                <p><?php echo $value['last_change_date'] ?? "-" ?></p>
                                            </td>
                                            <td class="min-width">
                                                <p><?php echo $value['order_by'] ?? "-" ?></p>
                                            </td>
                                            <td class="min-width">
                                                <p><?php echo $value['order_by_02'] ?? "-" ?></p>
                                            </td>
                                            <td class="min-width">
                                                <p><?php echo substr($value['created_at'], 0, 10) ?></p>
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
                        <div>
                            <a href="/admin/unpaid-record/create.php?order_number=<?php echo $order_number ?>" class="btn primary-btn btn-hover">등록</a>
                        </div>

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
