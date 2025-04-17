<?php
require_once dirname(__FILE__).'/../layouts/main.php';

include_once DAO_PATH.'/DoctorReserveDao.class.php';

$backUrl = "/admin/doctors";

$dao = new DoctorReserveDao();

$where = !empty($_GET['doctor_id']) ? " AND doctor_id = " . $_GET['doctor_id'] : "";

if (!$where) {
    alertLocationHref("잘못된 주소입니다.", $backUrl);
}

$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$data = $dao->getList("doctor_reserves", $page, 10, $where);

$controller_proc = "doctor_reserve_proc.php";


$now = date('Y-m-d',time());
$tomorrow =  date('Y-m-d',strtotime($now."+1 day"));

$doctor_id = $_GET['doctor_id'];
$name = $_GET['name'];
?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("$name 원장 예약일목록", "원장 예약일관리", "원장 예약일목록"); ?>
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><h6>No</h6></th>
                                    <th><h6>예약현황</h6></th>
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
                                                <div class="lead-text">
                                                    <?php if($value['reserve'] === "N"): ?>
                                                        <p><?php echo $value['reserve_date']." ".$value['reserve_reason'] ?></p>
                                                    <?php else: $reason = ""; ?>

                                                        <?php if($value['morning'] === "N"): ?>
                                                        <?php $reason .= $value['morning_date']." 오전 ".$value['morning_reason'].", "; endif;?>
                                                        <?php if($value['noon'] === "N"): ?>
                                                            <?php $reason .= $value['noon_date']." 오후 ".$value['noon_reason'].", "; endif;?>
                                                        <p>
                                                            <?php echo substr($reason, 0,-2) ?>
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
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
                            <a href="/admin/doctors" class="btn info-btn btn-hover">목록</a>
                            <a href="/admin/doctors/reserve_create.php?doctor_id=<?= $doctor_id ?>&name=<?= $name ?>" class="btn primary-btn btn-hover">등록</a>
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
