<?php
require_once dirname(__FILE__).'/../layouts/main.php';

$doctor_id = $_GET['doctor_id'];
$name = $_GET['name'];

$now = date('Y-m-d',time());
$tomorrow =  date('Y-m-d',strtotime($now."+1 day"));

?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("$name 원장 예약일 등록", "원장 예약일 관리", "원장 예약일 등록"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="insert" readonly>
                    <input type="hidden" name="doctor_id" value=<?= $doctor_id ?> readonly>
                    <div class="row">
                        <div class="col-4">
                            <div class="input-style-1">
                                <label>특정일예약가능여부</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input pointer" type="radio"
                                       name="reserve" id="reserve_01" value='Y'>
                                <label class="form-check-label pointer" for="reserve_01">예약가능</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input pointer" type="radio"
                                       name="reserve" id="reserve_02" value='N'>
                                <label class="form-check-label pointer" for="reserve_02">예약불가</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-style-1">
                                <label>특정일예약불가능날짜</label>
                                <input type="date" name="reserve_date" title="특정일예약불가능날짜" min="<?= $tomorrow ?>"
                                       placeholder="특정일예약불가능날짜를 입력해주세요" disabled>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-style-1">
                                <label>특정일예약불가능이유</label>
                                <input type="text" name="reserve_reason" title="특정일예약불가능이유"
                                       placeholder="특정일예약불가능이유를 입력해주세요" disabled>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-style-1">
                                <label>오전예약가능여부</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input pointer" type="radio"
                                       name="morning" id="morning_01" value='Y'>
                                <label class="form-check-label pointer" for="morning_01">예약가능</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input pointer" type="radio"
                                       name="morning" id="morning_02" value='N'>
                                <label class="form-check-label pointer" for="morning_02">예약불가</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-style-1">
                                <label>오전예약불가능날짜</label>
                                <input type="date" name="morning_date" title="오전예약불가능날짜" min="<?= $tomorrow ?>"
                                       placeholder="오전예약불가능날짜를 입력해주세요" disabled>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-style-1">
                                <label>오전예약불가능이유</label>
                                <input type="text" name="morning_reason" title="오전예약불가능이유"
                                       placeholder="오전예약불가능이유를 입력해주세요" disabled>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-style-1">
                                <label>오후예약가능여부</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input pointer" type="radio"
                                       name="noon" id="noon_01" value='Y'>
                                <label class="form-check-label pointer" for="noon_01">예약가능</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input pointer" type="radio"
                                       name="noon" id="noon_02" value='N'>
                                <label class="form-check-label pointer" for="noon_02">예약불가</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-style-1">
                                <label>오후예약불가늘날짜</label>
                                <input type="date" name="noon_date" title="오후예약불가늘날짜" min="<?= $tomorrow ?>"
                                       placeholder="오후예약불가늘날짜를 입력해주세요" disabled>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-style-1">
                                <label>오후예약불가능이유</label>
                                <input type="text" name="noon_reason" title="오후예약불가능이유"
                                       placeholder="오후예약불가능이유를 입력해주세요" disabled>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn info-btn btn-hover" href="/admin/doctors/reserve.php?doctor_id=<?= $doctor_id ?>&name=<?= $name ?>">목록</a>
                            <input type="submit" class="btn primary-btn btn-hover" value="등록" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    const reserve = jQuery("input[name='reserve']");
    const reserve_date = jQuery("input[name='reserve_date']");
    const reserve_reason = jQuery("input[name='reserve_reason']");

    const morning = jQuery("input[name='morning']");
    const morning_date = jQuery("input[name='morning_date']");
    const morning_reason = jQuery("input[name='morning_reason']");

    const noon = jQuery("input[name='noon']");
    const noon_date = jQuery("input[name='noon_date']");
    const noon_reason = jQuery("input[name='noon_reason']");

    jQuery("#_form").submit(function(event){
        event.preventDefault();
        const reserve_value = jQuery("input[name='reserve']:checked").val();
        const morning_value = jQuery("input[name='morning']:checked").val();
        const noon_value = jQuery("input[name='noon']:checked").val();
        let mainSpinner = jQuery("#mainSpinner");

        if (reserve.is(":checked") === false && morning.is(":checked") === false && noon.is(":checked") === false) {
            alert("예약불가를 한 가지 선택하셔야 등록이 가능합니다.");
            return false;
        }

        if (reserve_value === "N" && (morning_value === "N" || noon_value === "N")) {
            alert("특정일예약불가 혹은 오전/오후 예약불가 중 선택해주세요.");
            return false;
        }

        if (reserve_value === "N") {
            if (reserve_date.val() === "") {
                alert("특정일예약불가능날짜를 선택해주세요.");
                return false;
            }
            if (reserve_reason.val() === "") {
                alert("특정일예약불가능이유를 입력해주세요.");
                return false;
            }
        }

        if (morning_value === "N") {
            if (morning_date.val() === "") {
                alert("오전예약불가능날짜를 선택해주세요.");
                return false;
            }
            if (morning_reason.val() === "") {
                alert("오전예약불가능이유를 입력해주세요.");
                return false;
            }
        }

        if (noon_value === "N") {
            if (noon_date.val() === "") {
                alert("오후예약불가능날짜를 선택해주세요.");
                return false;
            }
            if (noon_reason.val() === "") {
                alert("오후예약불가능이유를 입력해주세요.");
                return false;
            }
        }



        jQuery.ajax({
            type:"POST",
            url:"../../controller/doctor_reserve_proc.php",
            dataType:"json",
            data : new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.result) {
                    alert(response.msg);
                    location.href = '/admin/doctors/reserve.php?doctor_id=<?= $doctor_id ?>&name=<?= $name ?>';
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

    jQuery(reserve).click(function () {
        if ($(this).val() === "N") {
            reserve_date.prop('disabled', false);
            reserve_reason.prop('disabled', false);
        } else {
            reserve_date.prop('disabled', true);
            reserve_reason.prop('disabled', true);
        }
    });

    jQuery(morning).click(function () {
        if ($(this).val() === "N") {
            morning_date.prop('disabled', false);
            morning_reason.prop('disabled', false);
        } else {
            morning_date.prop('disabled', true);
            morning_reason.prop('disabled', true);
        }
    });

    jQuery(noon).click(function () {
        if ($(this).val() === "N") {
            noon_date.prop('disabled', false);
            noon_reason.prop('disabled', false);
        } else {
            noon_date.prop('disabled', true);
            noon_reason.prop('disabled', true);
        }
    })


</script>
<?php require_once dirname(__FILE__).'/../layouts/bottom.php'; ?>
