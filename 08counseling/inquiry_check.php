<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/head.php';

include_once DAO_PATH.'/DoctorConsultDao.class.php';
include_once DAO_PATH.'/BoardDao.class.php';
$backUrl = "/08counseling/inquiry.php";

?>
<div id="wrapper">
    <div class="inner">
        <div class="txtB txtCenter fs32 mt80">비용문의.</div>
        <table class="boardView02">
            <colgroup>
                <col width="20%" />
                <col width="*" />
            </colgroup>
            <tbody>
                <tr>
                    <th>비밀번호</th>
                    <td>
                        <input type="password" name="password" id="password" title="비밀번호" style="width:60%;">
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="boardBtn">
            <span class="left">
                <a href="inquiry.php" class="list">목록</a>
            </span>
            <span class="right">
                <input type="button" id="specialist_check" class="on" value="확인" />
            </span>
        </div>
    </div>
</div>
</div>
<script>
    jQuery("#specialist_check").click(function () {
        const password = jQuery("#password").val()
        if (password === "") {
            alert("비밀번호를 입력해주세요");
            jQuery("#password").focus();
            return false;
        }
        specialist_check_data = {
            mode: "consult_check",
            id: "<?php echo $_GET['id'] ?>",
            password
        }
        jQuery.ajax({
            type: "POST",
            url: "../../controller/doctor_consult_proc.php",
            dataType: "json",
            data: specialist_check_data,
            success: function (response) {
                console.log(response);
                if (response.result) {
                    window.location.href = '/08counseling/inquiry_view.php?id=' + < ?
                        php echo $_GET['id'] ? >
                } else {
                    alert(response.msg);
                }
            }
        })
    })
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>