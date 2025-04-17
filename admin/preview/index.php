<?php
require_once dirname(__FILE__).'/../layouts/main.php';
include_once DAO_PATH.'/PreviewDao.class.php';
include_once DAO_PATH.'/BoardDao.class.php';

$dao = new PreviewDao();

$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$search = !empty($_GET['search']) ? $_GET['search'] : "";
$where = " WHERE 1";

if ($search) {

}

$controller_proc = "preview_proc.php";
$table_b1 = "previews_b1";
$table_1f = "previews_1f";
$table_2f = "previews_2f";
$table_3f = "previews_3f";
$table_4f = "previews_4f";
$table_5f = "previews_5f";

$previews_b1_data = $dao->getDetail($table_b1, $where);
$previews_1f_data = $dao->getDetail($table_1f, $where);
$previews_2f_data = $dao->getDetail($table_2f, $where);
$previews_3f_data = $dao->getDetail($table_3f, $where);
$previews_4f_data = $dao->getDetail($table_4f, $where);
$previews_5f_data = $dao->getDetail($table_5f, $where);
$previews_b1_data['view_table'] = 'previews_b1';
$previews_1f_data['view_table'] = 'previews_1f';
$previews_2f_data['view_table'] = 'previews_2f';
$previews_3f_data['view_table'] = 'previews_3f';
$previews_4f_data['view_table'] = 'previews_4f';
$previews_5f_data['view_table'] = 'previews_5f';
$data = array('total_cnt' => 6, 'values' =>
    array($previews_b1_data, $previews_1f_data, $previews_2f_data, $previews_3f_data, $previews_4f_data, $previews_5f_data));
?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("둘러보기 목록", "둘러보기 관리", "둘러보기 목록"); ?>
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
                                    <th><h6>제목</h6></th>
                                    <th><h6>작성자</h6></th>
                                    <th><h6>생성일</h6></th>
                                    <th><h6>삭제</h6></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($data['total_cnt'] > 0):
                                    $no = ($page > 1) ? $data['total_cnt']-(($page-1)*10) : $data['total_cnt'];
                                    foreach($data['values'] as $value):
                                        $view_table =  $value['view_table'];
                                        ?>
                                        <tr>
                                            <td class="min-width">
                                                <p><?php echo $no--; ?></p>
                                            </td>
                                            <td class="min-width">
                                                <p>
                                                    <a href="/admin/preview/edit.php?id=<?php echo $value['id'] ?>&view_table=<?php echo $view_table ?>" title="<?php echo $value['title'] ?>">
                                                        <?php
                                                        if(mb_strlen($value['title'], 'utf-8') > 68):
                                                            echo iconv_substr($value['title'], 0, 64, "utf-8").'...';
                                                        else:
                                                            echo $value['title'];
                                                        endif;
                                                        ?>
                                                    </a>
                                                </p>
                                            </td>
                                            <td class="min-width">
                                                <p><?php echo $value['written_by'] ?></p>
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
                        <div>

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
