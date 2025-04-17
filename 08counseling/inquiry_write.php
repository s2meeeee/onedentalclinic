<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/head.php';

include_once DAO_PATH.'/DoctorDao.class.php';
include_once DAO_PATH.'/BoardDao.class.php';
$dao = new DoctorDao();
$departments= $dao->board->getDepartments('departments');
$doctors= $dao->board->getDoctors('doctors', 1);

?>
<div id="wrapper">
    <div class="inner">

        <!-- 리스트 -->
        <table class="boardWrite">
            <colgroup>
                <col width="20%" />
                <col width="*" />
            </colgroup>
            <tbody>
                <form id="_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="insert" readonly>
                    <input type="hidden" name="member_id" value="<?= $loginInfo['id'] ?>" readonly>
                    <tr>
                        <th>옵션</th>
                        <td>
                            <input type="checkbox" name="open" id="open" class="pointer" value="Y"> 비밀글
                            <input type="password" name="password" id="password" title="비밀번호" style="margin-left: 15px;"
                                class="hide" placeholder="비밀번호를 입력해주세요" disabled>
                        </td>
                    </tr>
                    <tr>
                        <th>진료과목</th>
                        <td>
                            <select id="department_id" name="department_id" class="mr-25">
                                <?php foreach($departments as $department): ?>
                                <option value="<?php echo $department['id'] ?>"><?php echo $department['title'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <select id="doctor_id" name="doctor_id">
                                <?php foreach($doctors as $doctor): ?>
                                <option value="<?php echo $doctor['id'] ?>"><?php echo $doctor['name'] ?> 원장</option>
                                <?php endforeach; ?>
                            </select></td>
                    </tr>
                    <tr>
                        <th>작성자명</th>
                        <td><input type="text" name="written_by" title="작성자명" class="required"
                                value="<?php echo $loginInfo['name'] ?>" </td> </tr> <tr>
                        <th>이메일</th>
                        <td><input type="text" name="email" title="이메일" value="<?php echo $loginInfo['email'] ?>" </td>
                                </tr> <tr>
                        <th>전화번호</th>
                        <td><input type="text" name="phone" title="전화번호" class="required"
                                value="<?php echo $loginInfo['phone'] ?>" </td> </tr> <tr>
                    <tr>
                        <th>제목</th>
                        <td><input type="text" name="title" title="제목" class="required"></td>
                    </tr>
                    <tr>
                        <th>내용</th>
                        <td>
                            <textarea name="content" title="내용" rows="10" class="required"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>첨부파일</th>
                        <td><input type="file" name="file_01"></td>
                    </tr>
            </tbody>
        </table>

        <!-- //리스트 -->

        <!-- 버튼 -->
        <div class="boardBtn">
            <span class="left">
                <a onclick="window.history.back()" class="list pointer">목록</a>
            </span>
            <span class="right">
                <input type="submit" class="on" value="등록" />
                <a href="inquiry_write.php" class="write">취소</a>
            </span>
        </div>
        </form>
        <!-- //버튼 -->




    </div>
</div>
<script>
    jQuery("#_form").submit(function (event) {
        event.preventDefault();
        let checkValidate = validated(jQuery(".required"));
        if (checkValidate === true) {
            jQuery.ajax({
                type: "POST",
                url: "../../controller/doctor_consult_proc.php",
                dataType: "json",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.result) {
                        alert(response.msg);
                        location.href = '/08counseling/inquiry.php';
                    } else {
                        alert(response.msg);
                        return false;
                    }
                }
            })
        }
    })

    jQuery("#open").click(function () {
        if ($(this).is(":checked")) {
            jQuery("#password").addClass("required");
            jQuery("#password").removeClass("hide");
            jQuery("#password").prop("disabled", false);
        } else {
            jQuery("#password").addClass("hide");
            jQuery("#password").removeClass("required");
            jQuery("#password").prop("disabled", true);
            jQuery("#password").val("");
        }
    })

    jQuery("#department_id").change(function () {
        data = {
            mode: 'get_doctors',
            doctor_id: $(this).val()
        }
        jQuery.ajax({
            type: "POST",
            url: "../../controller/doctor_proc.php",
            dataType: "json",
            data,
            success: function (response) {
                console.log(response);
                jQuery("#doctor_id option").remove();
                response.forEach(item => {
                    jQuery("#doctor_id").append(
                        `<option value=${item.id}>${item.name}  원장</option>`)
                })
            }
        })
    })
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>