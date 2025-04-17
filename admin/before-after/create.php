<?php
require_once dirname(__FILE__).'/../layouts/main.php';
include_once CLASS_PATH.'/MysqlDB.class.php';


?>
<script src="../cheditor/cheditor.js"></script>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("치료전후사진 등록", "치료전후사진 관리", "치료전후사진 등록"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="insert" readonly>
                    <input type="hidden" name="written_by" value="<?php echo $userInfo['name'] ?? "원치과" ?>" readonly>
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
                                <label class="text-danger">치료위치</label>
                                <input type="text" name="therapy_location" title="치료위치" class="required"
                                       placeholder="치료위치를 입력해주세요">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">임플란트 개수</label>
                                <input type="text" name="implant_number" title="임플란트 개수" class="required"
                                       placeholder="임플란트 개수를 입력해주세요">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">세부사항</label>
                                <input type="text" name="detail" title="세부사항" class="required"
                                       placeholder="세부사항를 입력해주세요">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>사진 Before 썸네일 (290*290)</label>
                                <input type="file" name="file_01" title="사진 Before 썸네일">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>사진 After 썸네일 (290*290)</label>
                                <input type="file" name="file_02" title="사진 After 썸네일">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>영상 썸네일 (290*290)</label>
                                <input type="file" name="file_03" title="영상 썸네일">
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="input-style-1">
                                <label>내용</label>
                                <textarea
                                        name="content" id="content" cols="30" rows="8" title="내용"
                                        placeholder="내용을 입력해주세요"></textarea>
                                <script type="text/javascript">
                                    var myeditor = new cheditor();
                                    myeditor.config.editorHeight = '200px';
                                    myeditor.config.editorWidth = '99%';
                                    myeditor.inputForm = 'content';
                                    myeditor.run();
                                </script>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn info-btn btn-hover" href="/admin/before-after">목록</a>
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
        document.getElementById("content").value = myeditor.outputBodyHTML();
        if (checkValidate === true) {
            jQuery.ajax({
                type:"POST",
                url:"../../controller/before_after_proc.php",
                dataType:"json",
                data : new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.result) {
                        alert(response.msg);
                        location.href = '/admin/before-after';
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
