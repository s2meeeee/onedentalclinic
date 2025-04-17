 <?php
require_once dirname(__FILE__).'/../layouts/main.php';

include_once DAO_PATH.'/DoctorScheduleDao.class.php';

$backUrl = "/admin/doctors";

$dao = new DoctorScheduleDao();

$where = !empty($_GET['doctor_id']) ? " WHERE doctor_id = " . $_GET['doctor_id'] : "";

if (!$where) {
    alertLocationHref("잘못된 주소입니다.", $backUrl);
}

$data = $dao->getDetail("doctor_schedules", $where);

//if (!$data) {
//    alertLocationHref("잘못된 주소입니다.", $backUrl);
//}
 $name = $_GET['name'];
?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("$name 원장 스케쥴 등록", "원장 스케쥴 관리", "원장 스케쥴 등록"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="insert" readonly>
                    <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $_GET['doctor_id'] ?>" readonly>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>월요일 오전</label>
                                <input type="text" name="mon_morning" title="월요일 오전" placeholder="월요일 오전 일정을 입력해주세요." value="<?php echo $data['mon_morning'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>월요일 오후</label>
                                <input type="text" name="mon_noon" title="월요일 오후" placeholder="월요일 오후 일정을 입력해주세요." value="<?php echo $data['mon_noon'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>화요일 오전</label>
                                <input type="text" name="tue_morning" title="화요일 오전" placeholder="화요일 오전 일정을 입력해주세요." value="<?php echo $data['tue_morning'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>화요일 오후</label>
                                <input type="text" name="tue_noon" title="화요일 오후" placeholder="화요일 오후 일정을 입력해주세요." value="<?php echo $data['tue_noon'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>수요일 오전</label>
                                <input type="text" name="wed_morning" title="수요일 오전" placeholder="수요일 오전 일정을 입력해주세요." value="<?php echo $data['wed_morning'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>수요일 오후</label>
                                <input type="text" name="wed_noon" title="수요일 오후" placeholder="수요일 오후 일정을 입력해주세요." value="<?php echo $data['wed_noon'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>목요일 오전</label>
                                <input type="text" name="thu_morning" title="목요일 오전" placeholder="목요일 오전 일정을 입력해주세요." value="<?php echo $data['thu_morning'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>목요일 오후</label>
                                <input type="text" name="thu_noon" title="목요일 오후" placeholder="목요일 오후 일정을 입력해주세요." value="<?php echo $data['thu_noon'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>금요일 오전</label>
                                <input type="text" name="fri_morning" title="금요일 오전" placeholder="금요일 오전 일정을 입력해주세요." value="<?php echo $data['fri_morning'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>금요일 오후</label>
                                <input type="text" name="fri_noon" title="금요일 오후" placeholder="금요일 오후 일정을 입력해주세요." value="<?php echo $data['fri_noon'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>토요일</label>
                                <input type="text" name="saturday" title="토요일" placeholder="토요일 일정을 입력해주세요." value="<?php echo $data['saturday'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>진료시간 공개여부</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input pointer" type="radio"
                                       name="no_schedules" id="no_schedules_01" value='N'
                                    <?php if($data['no_schedules'] == 'N') echo 'checked' ?>>
                                <label class="form-check-label pointer" for="no_schedules_01">진료시간 공개</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input pointer" type="radio"
                                       name="no_schedules" id="no_schedules_02" value='Y'
                                    <?php if($data['no_schedules'] == 'Y') echo 'checked' ?>>
                                <label class="form-check-label pointer" for="no_schedules_02">진료시간 비공개</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>스케쥴이 없는 이유</label>
                                <label>
                                    <textarea name="no_schedules_reason" cols="30" rows="10"><?php echo $data['no_schedules_reason'] ?></textarea>
                                </label>
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
        let mainSpinner = jQuery("#mainSpinner")
        jQuery.ajax({
            type:"POST",
            url:"../../controller/doctor_schedule_proc.php",
            dataType:"json",
            data : new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.result) {
                    alert(response.msg);
                    location.href = '/admin/doctors/schedule.php?doctor_id=' + jQuery("#doctor_id").val();
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
    })
</script>
<?php require_once dirname(__FILE__).'/../layouts/bottom.php'; ?>
