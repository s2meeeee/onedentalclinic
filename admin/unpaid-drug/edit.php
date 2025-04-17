<?php
    require_once dirname(__FILE__).'/../layouts/main.php';
    include_once CLASS_PATH.'/MysqlDB.class.php';
    include_once DAO_PATH.'/UnpaidDrugDao.class.php';
    $backUrl = "/admin/unpaid-drug";


    $where = !empty($_GET['id']) ? " WHERE id = " . $_GET['id'] : "";

    if (!$where) {
        alertLocationHref("잘못된 주소입니다.", $backUrl);
    }

    $dao = new UnpaidDrugDao();

    $data = $dao->getDetail("unpaid_drugs", $where);

    if (!$data) {
        alertLocationHref("게시글이 존재하지 않습니다.", $backUrl);
    }
?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("비급여 약제비 수정", "비급여 약제비 관리", "비급여 약제비 수정"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="update" readonly>
                    <input type="hidden" name="id" value=<?php echo $data['id'] ?> readonly>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>코드</label>
                                <input type="text" name="codename" title="코드"
                                       placeholder="코드를 입력해주세요" value="<?php echo $data["codename"] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">명칭</label>
                                <input type="text" name="designation" title="명칭" class="required"
                                       placeholder="명칭를 입력해주세요" value="<?php echo $data["designation"] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">비용</label>
                                <input type="text" name="cost" title="비용" class="required"
                                       placeholder="비용를 입력해주세요" value="<?php echo $data["cost"] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>특이사항</label>
                                <input type="text" name="uniqueness" title="특이사항"
                                       placeholder="특이사항를 입력해주세요" value="<?php echo $data["uniqueness"] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>최종변경일</label>
                                <input type="text" name="last_change_date" title="최종변경일"
                                       placeholder="최종변경일를 입력해주세요" value="<?php echo $data["last_change_date"] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">노출 순서</label>
                                <input type="number" name="order_by" title="노출순서" class="required"
                                       placeholder="노출순서를 입력해주세요" value="<?php echo $data["order_by"] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">노출 순서2</label>
                                <input type="number" name="order_by_02" title="노출순서2" class="required"
                                       placeholder="노출순서2를 입력해주세요" value="<?php echo $data["order_by_02"] ?>">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn info-btn btn-hover" href="/admin/unpaid-drug">목록</a>
                            <input type="submit" class="btn primary-btn btn-hover" value="수정" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    jQuery("#_form").submit(function(event){
        event.preventDefault();
        let checkValidate = validated(jQuery(".required"));
        let mainSpinner = jQuery("#mainSpinner")
        if (checkValidate === true) {
            jQuery.ajax({
                type:"POST",
                url:"../../controller/unpaid_drug_proc.php",
                dataType:"json",
                data : new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.result) {
                        alert(response.msg);
                        location.reload();
                    } else {
                        alert(response.msg);
                        return false;
                    }
                },beforeSend:function() {
                    mainSpinner.removeClass("d-none");
                    mainSpinner.css("height", document.body.scrollHeight);
                },complete:function() {
                    mainSpinner.addClass("d-none");
                    mainSpinner.css("height", 0);
                }
            })
        }
    })
</script>
<?php require_once dirname(__FILE__).'/../layouts/bottom.php'; ?>
