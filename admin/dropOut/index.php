<?php
require_once dirname(__FILE__).'/../layouts/main.php';
include_once DAO_PATH.'/UserDao.class.php';

$dao = new UserDao();

$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$search = !empty($_GET['search']) ? $_GET['search'] : "";
$where = "";

if ($search) {
    $where .= " AND (identity like '%".$search."%' OR name like '%".$search."%' OR email like '%".$search."%')";
}

$controller_proc = "user_proc.php";
$table = "users";
$names = implode(",", ["No.", "아이디", "이름", "이메일", "연락처", "생성일", "지점"]);
$columns = implode(",$table.", ["identity", "name", "email", "phone", "created_at"]);
$excel_title = "탈퇴회원 ".date("Y-m-d h:i:s");

$data = $dao->getList($table, $page, '10', $where, 'deleted');

?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("탈퇴회원 목록", "탈퇴회원 관리", "탈퇴회원 목록"); ?>
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <div class="d-none d-md-flex justify-content-between align-items-center mb-10">
                            <h6>탈퇴 회원목록</h6>
                            <div class="d-flex">
                                <form method="get" class="d-flex">
                                    <input type="hidden" name="page" value="<?php echo $page ?>">
                                    <div class="d-flex position-relative bg-light board-search ms-2 w-auto">
                                        <input type="text" name="search" value="<?php echo $search ?>"
                                               class="form-control" placeholder="아이디, 이메일주소, 전화번호">
                                        <button class="position-absolute top-0 border-0 bg-transparent"
                                                style="height:38px; right:10px;">
                                            <i class="lni lni-search-alt"></i>
                                        </button>
                                    </div>
                                </form>
<!--                                --><?php //if($data['total_cnt'] > 0): ?>
<!--                                <form action="../../../controller/--><?php //echo $controller_proc?><!--" method="post">-->
<!--                                    <input type="hidden" name="mode" value="excel_download" readonly>-->
<!--                                    <input type="hidden" name="where" value="--><?php //echo $where ?><!--">-->
<!--                                    <input type="hidden" name="names" value="--><?php //echo $names ?><!--">-->
<!--                                    <input type="hidden" name="table" value="--><?php //echo $table ?><!--">-->
<!--                                    <input type="hidden" name="columns" value="--><?php //echo $columns ?><!--">-->
<!--                                    <input type="hidden" name="is_active" value="0">-->
<!--                                    <input type="hidden" name="excel_title" value="--><?php //echo $excel_title ?><!--">-->
<!--                                    <input type="submit" value="엑셀 다운로드" class="btn primary-btn btn-hover ms-3">-->
<!--                                </form>-->
<!--                                --><?php //endif; ?>
                            </div>
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><h6>No</h6></th>
                                    <th><h6>아이디</h6></th>
                                    <th><h6>이름</h6></th>
                                    <th><h6>이메일</h6></th>
                                    <th><h6>번호</h6></th>
                                    <th><h6>탈퇴일</h6></th>
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
                                            <p><?php echo $no-- ?></p>
                                        </td>
                                        <td class="min-width">
                                            <p><?php echo $value['identity'] ? $value['identity'] : "-" ?></p>
                                        </td>
                                        <td class="min-width">
                                            <p><?php echo $value['name'] ? $value['name'] : "-" ?></p>
                                        </td>
                                        <td class="min-width">
                                            <p><?php echo $value['email'] ? $value['email'] : "-" ?></p>
                                        </td>
                                        <td class="min-width">
                                            <p><?php echo $value['phone'] ? $value['phone'] : "-" ?></p>
                                        </td>
                                        <td class="min-width">
                                            <div class="lead-text">
                                                <p><?php echo substr($value['deleted_at'], 0, 10) ?></p>
                                            </div>
                                        </td>
                                        <?php /* ?>
                                        <td>
                                            <div class="action">
                                                <div
                                                    onclick="deleteItem(<?php echo $value['id'] ?>)">
                                                    <button class="text-danger">
                                                        <i class="lni lni-trash-can"></i>
                                                    </button>
                                                    </form>
                                                </div>
                                        </td>
                                        <?php */ ?>
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
    const updateItem = (id) => {
        if (confirm("갱신하시겠습니까?")) {
            let data = {
                id,
                'mode' : 'agree_update'
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
