<?php
require_once dirname(__FILE__).'/../layouts/main.php';

include_once DAO_PATH.'/DoctorDao.class.php';
include_once DAO_PATH.'/BoardDao.class.php';
$dao = new DoctorDao();
$departments= $dao->board->getDepartments('departments');

?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("의사관리 등록", "의사관리 관리", "의사관리 등록"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="insert" readonly>
                    <div class="row">
                        <div class="col-12">
                            <div class="select-style-1">
                                <label>부서</label>
                                <div class="select-position">
                                    <select name="department_id">
                                        <?php foreach($departments as $department): ?>
                                            <option value="<?php echo $department['id'] ?>"><?php echo $department['title'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
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
                                <label>주특기</label>
                                <input type="text" name="sub_department" title="주특기"
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
                            <div class="select-style-1">
                                <label>예약노출</label>
                                <div class="select-position">
                                    <select name="reserve_active">
                                        <option value="Y">노출</option>
                                        <option value="N">비노출</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>의사사진</label>
                                <input type="file" name="file_01">
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="input-style-1">
                                <label>학력 및 경력</label>
                                <textarea
                                        name="career" id="career" cols="30" rows="8" title="내용"
                                        placeholder="내용을 입력해주세요"></textarea>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn info-btn btn-hover" href="/admin/doctors">목록</a>
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
                url:"../../controller/doctor_proc.php",
                dataType:"json",
                data : new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.result) {
                        alert(response.msg);
                        location.href = '/admin/doctors';
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
