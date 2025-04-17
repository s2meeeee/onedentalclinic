<?php
require_once dirname(__FILE__).'/../layouts/main.php';
include_once CLASS_PATH.'/MysqlDB.class.php';


?>

<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("팝업 등록", "팝업 관리", "팝업 등록"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="insert" readonly>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">제목</label>
                                <input type="text" name="title" title="제목" class="required"
                                       placeholder="제목를 입력해주세요">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>링크</label>
                                <input type="text" name="link" title="링크"
                                       placeholder="링크를 입력해주세요">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">노출여부</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input pointer" type="radio"
                                       name="is_active" id="is_active_01" value='Y' checked>
                                <label class="form-check-label pointer" for="is_active_01">노출</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input pointer" type="radio"
                                       name="is_active" id="is_active_02" value='N'>
                                <label class="form-check-label pointer" for="is_active_02">비노출</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">노출순서</label>
                                <input type="text" name="order_by" title="노출순서" class="required"
                                       placeholder="노출순서를 입력해주세요" value=1>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label class="text-danger">이미지 (518*291)</label>
                                <input type="file" name="file_01" title="이미지" class="required">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn info-btn btn-hover" href="/admin/popup">목록</a>
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
                url:"../../controller/popup_proc.php",
                dataType:"json",
                data : new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.result) {
                        alert(response.msg);
                        location.href = '/admin/popup';
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
