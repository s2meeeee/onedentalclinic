<?php
    require_once dirname(__FILE__).'/../layouts/main.php';
    include_once CLASS_PATH.'/MysqlDB.class.php';
    include_once DAO_PATH.'/BoardDao.class.php';
    include_once DAO_PATH.'/StepDao.class.php';
    $backUrl = "/admin/steps";


    $where = !empty($_GET['id']) ? " WHERE id = " . $_GET['id'] : "";

    if (!$where) {
        alertLocationHref("잘못된 주소입니다.", $backUrl);
    }

    $dao = new StepDao();

    $data = $dao->getDetail("steps", $where);

    if (!$data) {
        alertLocationHref("게시글이 존재하지 않습니다.", $backUrl);
    }
?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("의사관리 수정", "의사관리 관리", "의사관리 수정"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="update" readonly>
                    <input type="hidden" name="id" value=<?php echo $data['id'] ?> readonly>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">부서</label>
                                <input type="text" name="department" title="부서" class="required"
                                       placeholder="부서를 입력해주세요"value="<?php echo $data['department'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">이름</label>
                                <input type="text" name="name" title="이름" class="required"
                                       placeholder="제목를 입력해주세요" value="<?php echo $data['name'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">노출 순서 (낮을수록 우선 순위)</label>
                                <input type="text" name="order_by" title="노출 순서" class="required"
                                placeholder="제목를 입력해주세요" value="<?php echo $data['order_by'] ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>스텝사진
                                    <?php if($data['file_01_path']): ?>
                                        <span class="text-danger pointer ms-1"
                                              onclick="deleteFile(<?php echo $data['id']?>, 'file_01')">
                                            삭제
                                        </span>
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="file_01">
                                <?php if($data['file_01_path']): ?>
                                    <a href="<?php echo $data['file_01_path'] ?>" download class="w-100">
                                        <?php echo $data['file_01_name'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn info-btn btn-hover" href="/admin/steps">목록</a>
                            <input type="submit" class="btn primary-btn btn-hover" value="수정" />
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
        let mainSpinner = jQuery("#mainSpinner");
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
                        location.reload();
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

    const deleteFile = (id, fileName) => {
        if (confirm("삭제하시겠습니까?")) {
            let data = {
                id,
                fileName,
                'mode' : 'delete_file'
            }
            jQuery.ajax({
                url:"../../controller/step_proc.php",
                type:"post",
                dataType:"json",
                data,
                success: function(response) {
                    if (response.result) {
                        alert(response.msg);
                        location.reload();
                    } else {
                        alert(response.msg);
                        return false;
                    }
                }
            })
        }
    }
</script>
<?php require_once dirname(__FILE__).'/../layouts/bottom.php'; ?>
