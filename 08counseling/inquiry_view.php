<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/head.php';

include_once DAO_PATH.'/DoctorConsultDao.class.php';
include_once DAO_PATH.'/DoctorConsultCommentDao.class.php';
$backUrl = "/08counseling/inquiry.php";

$where = !empty($_GET['id']) ? " WHERE id = " . $_GET['id'] : "";

if (!$where) {
    alertLocationHref("잘못된 주소입니다.", $backUrl);
}

$dao = new DoctorConsultDao();
$doctorConsultCommentDao = new DoctorConsultCommentDao();

$data = $dao->getDetail("doctor_consults", $where);

if (!$data) {
    alertLocationHref("게시글이 존재하지 않습니다.", $backUrl);
}

if ($data['open'] == "Y"
    && (empty($_SESSION['specialist'.$_GET['id']]) || empty($_COOKIE['specialist'.$_GET['id']]))) {
    alertLocationHref("잘못된 주소입니다.", $backUrl);
} else {
    if ($_SESSION['specialist'.$_GET['id']] !== $_COOKIE['specialist'.$_GET['id']]) {
        alertLocationHref("잘못된 주소입니다.", $backUrl);
    }
}

if (empty($_COOKIE['specialist'.$_GET['id']])) {
    unset($_SESSION['specialist'.$_GET['id']]);
}

$dao->board->hitUpBoard('doctor_consults', $_GET['id']);

$department = $dao->board->getDepartmentItem('departments', $data['department_id']);
$doctor = $dao->board->getDoctorItem('doctors', $data['doctor_id']);

$departments = $dao->board->getDepartments('departments');
$doctors = $dao->board->getDoctors('doctors', $data['department_id']);

$doctorConsultCommentWhere = " where doctor_consult_id = " . $data['id'];

$doctorConsultComments = $doctorConsultCommentDao->getList('doctor_consult_comments', $doctorConsultCommentWhere);
?>

<div id="wrapper">
    <div class="inner">

        <!-- 리스트 -->
        <table class="boardView02">
            <colgroup>
                <col width="20%" />
                <col width="*" />
            </colgroup>
            <form id="_form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="mode" value="update" readonly>
                <input type="hidden" name="id" value=<?php echo $data['id'] ?> readonly>
                <tbody>
                    <tr>
                        <th>제목</th>
                        <td>
                            <input type="text" name="title" title="제목" class="required" style="width:60%;"
                                value="<?php echo $data['title'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>진료과목</th>
                        <td>
                            <select id="department_id" name="department_id" style="width: 60%;">
                                <?php foreach($departments as $department): ?>
                                <option value="<?php echo $department['id'] ?>"
                                    <?php if($department['id'] == $data['department_id']) echo 'selected' ?>>
                                    <?php echo $department['title'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>담당의사</th>
                        <td>
                            <select id="doctor_id" name="doctor_id" style="width: 60%;">
                                <?php foreach($doctors as $doctor): ?>
                                <option value="<?php echo $doctor['id'] ?>"
                                    <?php if($doctor['id'] == $data['doctor_id']) echo 'selected' ?>>
                                    <?php echo $doctor['name'] ?> 원장
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>작성자</th>
                        <td>
                            <input type="text" name="written_by" title="작성자" class="required" style="width:60%;"
                                value="<?php echo $data['written_by'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>이메일주소</th>
                        <td>
                            <input type="text" name="email" title="이메일" style="width:60%;"
                                value="<?php echo $data['email'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>전화번호</th>
                        <td>
                            <input type="text" name="phone" title="전화번호" style="width:60%;"
                                value="<?php echo $data['phone'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>첨부파일</th>
                        <td>
                            <input type="file" name="file_01">
                            <a href="<?php echo $data['file_01_path'] ?>"
                                download><?php echo $data['file_01_name'] ?></a>
                        </td>
                    </tr>
                    <th>등록일</th>
                    <td><?php echo $data['created_at'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <dl><textarea name="content" cols="100" rows="8"><?php echo $data['content'] ?></textarea>
                            </dl>
                            <?php if($doctorConsultComments['total_cnt'] > 0):?>
                            <?php foreach($doctorConsultComments['values'] as $key => $value): ?>
                            <dd style="<?php if($key != 0) echo 'border-top: #d3d3d3 1px solid;'?>"><span>RE :
                                    <?php echo $value['comment']; ?></dd>
                            <?php endforeach; ?>
                            <?php endif ?>
                        </td>
                        </th>
                    </tr>
                </tbody>
        </table>

        <!-- //리스트 -->

        <!-- 버튼 -->
        <div class="boardBtn">
            <span class="left">
                <a href="inquiry.php" class="list">목록</a>
            </span>
            <?php if($loginInfo['id'] == $data['member_id']): ?>
            <span class="right">
                <input type="submit" class="on" value="수정" />
                <a id="deleteBtn" class="write">삭 제</a>
            </span>
            <?php endif;?>
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
                    console.log(response);
                    if (response.result) {
                        alert(response.msg);
                        window.location.reload();
                    } else {
                        alert(response.msg);
                        return false;
                    }
                }
            })
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

    jQuery("#deleteBtn").click(function () {
        if (confirm("삭제하시겠습니까?")) {
            data = {
                mode: 'delete',
                id: "<?php echo $data['id'] ?>"
            }
            jQuery.ajax({
                type: "POST",
                url: "../../controller/doctor_consult_proc.php",
                dataType: "json",
                data,
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
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>