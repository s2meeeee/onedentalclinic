<?php
require_once dirname(__FILE__).'/../layouts/main.php';

include_once DAO_PATH.'/StepDao.class.php';
include_once DAO_PATH.'/BoardDao.class.php';
$dao = new StepDao();
?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("스텝관리 등록", "스텝관리 관리", "스텝관리 등록"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="insert" readonly>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">부서</label>
                                <input type="text" name="department" title="부서" class="required"
                                       placeholder="부서를 입력해주세요">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">이름</label>
                                <input type="text" name="name" title="이름" class="required"
                                       placeholder="제목를 입력해주세요">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">노출 순서 (낮을수록 우선 순위)</label>
                                <input type="text" name="order_by" title="노출 순서" class="required"
                                       placeholder="제목를 입력해주세요">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">포지션</label>
                                <input type="text" name="position" title="포지션" class="required"
                                       placeholder="포지션을 입력해주세요">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>스텝사진</label>
                                <input type="file" name="file_01">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn info-btn btn-hover" href="/admin/steps">목록</a>
                            <input type="submit" class="btn primary-btn btn-hover" value="등록" />
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
                url:"../../controller/step_proc.php",
                dataType:"json",
                data : new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.result) {
                        alert(response.msg);
                        location.href = '/admin/steps';
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
