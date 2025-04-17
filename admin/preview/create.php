<?php
require_once dirname(__FILE__).'/../layouts/main.php';
include_once CLASS_PATH.'/MysqlDB.class.php';

$gubun = !empty($_GET['gubun']) ? $_GET['gubun'] : 1;
?>
<script src="../cheditor/cheditor.js"></script>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("둘러보기 등록", "둘러보기 관리", "둘러보기 등록"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="insert" readonly>
                    <input type="hidden" name="table_name" value="<?php echo "previews_".$gubun ?>" readonly>
                    <input type="hidden" name="written_by" value="<?php echo $userInfo['name'] ?? "원치과" ?>" readonly>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-style-1">
                                <label class="text-danger">제목</label>
                                <input type="text" name="title" title="제목" class="required"
                                       placeholder="제목를 입력해주세요">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_01</label>
                                <input type="file" name="file_01" title="이미지_01">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_02</label>
                                <input type="file" name="file_02" title="이미지_02">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_03</label>
                                <input type="file" name="file_03" title="이미지_03">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_04</label>
                                <input type="file" name="file_04" title="이미지_04">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_05</label>
                                <input type="file" name="file_05" title="이미지_05">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_06</label>
                                <input type="file" name="file_06" title="이미지_06">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_07</label>
                                <input type="file" name="file_07" title="이미지_07">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_08</label>
                                <input type="file" name="file_08" title="이미지_08">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_09</label>
                                <input type="file" name="file_09" title="이미지_09">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_10</label>
                                <input type="file" name="file_10" title="이미지_10">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn info-btn btn-hover" href="/admin/preview">목록</a>
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
                url:"../../controller/preview_proc.php",
                dataType:"json",
                data : new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.result) {
                        alert(response.msg);
                        location.href = '/admin/preview';
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
