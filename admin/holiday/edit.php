<?php
    require_once dirname(__FILE__).'/../layouts/main.php';
    include_once CLASS_PATH.'/MysqlDB.class.php';
    include_once DAO_PATH.'/HolidayDao.class.php';
    $backUrl = "/admin/holiday";


    $where = !empty($_GET['id']) ? " WHERE id = " . $_GET['id'] : "";

    if (!$where) {
        alertLocationHref("잘못된 주소입니다.", $backUrl);
    }

    $dao = new HolidayDao();

    $data = $dao->getDetail("holidays", $where);

    if (!$data) {
        alertLocationHref("게시글이 존재하지 않습니다.", $backUrl);
    }
?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("공휴일 수정", "공휴일 관리", "공휴일 수정"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="update" readonly>
                    <input type="hidden" name="id" value=<?php echo $data['id'] ?> readonly>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">공휴일 명</label>
                                <input type="text" name="title" title="공휴일 명" class="required"
                                       placeholder="공휴일 명를 입력해주세요" value="<?php echo $data["title"] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">공휴일 날짜</label>
                                <input type="date" name="holiday" title="공휴일 날짜" class="required"
                                       placeholder="공휴일 날짜를 입력해주세요" value="<?php echo $data["holiday"] ?>">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn info-btn btn-hover" href="/admin/holiday">목록</a>
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
                url:"../../controller/holiday_proc.php",
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
