<?php
    require_once dirname(__FILE__).'/../layouts/main.php';
    include_once CLASS_PATH.'/MysqlDB.class.php';
    include_once DAO_PATH.'/BoardDao.class.php';
    include_once DAO_PATH.'/PostDao.class.php';
    $backUrl = "/admin/before-after";


    $where = !empty($_GET['id']) ? " WHERE id = " . $_GET['id'] : "";

    if (!$where) {
        alertLocationHref("잘못된 주소입니다.", $backUrl);
    }

    $dao = new PostDao();

    $data = $dao->getDetail("before_afters", $where);

    if (!$data) {
        alertLocationHref("게시글이 존재하지 않습니다.", $backUrl);
    }
?>
<script src="../cheditor/cheditor.js"></script>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("치료전후사진 수정", "치료전후사진 관리", "치료전후사진 수정"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="update" readonly>
                    <input type="hidden" name="id" value=<?php echo $data['id'] ?> readonly>
                    <input type="hidden" name="written_by" value="<?php echo $userInfo['name'] ?? "원치과"; ?>" readonly>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">제목</label>
                                <input type="text" name="title" title="제목" class="required"
                                       placeholder="제목를 입력해주세요" value="<?php echo $data['title'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">치료위치</label>
                                <input type="text" name="therapy_location" title="치료위치" class="required"
                                       placeholder="치료위치를 입력해주세요" value="<?php echo $data['therapy_location'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">임플란트 개수</label>
                                <input type="text" name="implant_number" title="임플란트 개수" class="required"
                                       placeholder="임플란트 개수를 입력해주세요" value="<?php echo $data['implant_number'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label class="text-danger">세부사항</label>
                                <input type="text" name="detail" title="세부사항" class="required"
                                       placeholder="세부사항를 입력해주세요" value="<?php echo $data['detail'] ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>사진 Before 썸네일 (290*290)
                                    <?php if($data['file_01_path']): ?>
                                        <span class="text-danger pointer ms-1"
                                              onclick="deleteFile(<?php echo $data['id']?>, 'file_01')">
                                            삭제
                                        </span>
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="file_01" title="사진 Before 썸네일">
                                <?php if($data['file_01_path']): ?>
                                    <a href="<?php echo $data['file_01_path'] ?>" download class="w-100">
                                        <?php echo $data['file_01_name'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>사진 After 썸네일 (290*290)
                                    <?php if($data['file_02_path']): ?>
                                        <span class="text-danger pointer ms-1"
                                              onclick="deleteFile(<?php echo $data['id']?>, 'file_02')">
                                            삭제
                                        </span>
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="file_02" title="사진 After 썸네일">
                                <?php if($data['file_02_path']): ?>
                                    <a href="<?php echo $data['file_02_path'] ?>" download class="w-100">
                                        <?php echo $data['file_02_name'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>영상 썸네일 (290*290)
                                    <?php if($data['file_03_path']): ?>
                                        <span class="text-danger pointer ms-1"
                                              onclick="deleteFile(<?php echo $data['id']?>, 'file_03')">
                                            삭제
                                        </span>
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="file_03" title="영상 썸네일">
                                <?php if($data['file_03_path']): ?>
                                    <a href="<?php echo $data['file_03_path'] ?>" download class="w-100">
                                        <?php echo $data['file_03_name'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="input-style-1">
                                <label>내용</label>
                                <textarea
                                        id="content" name="content" cols="30" rows="8" title="내용"
                                        placeholder="내용을 입력해주세요"><?php echo $data['content'] ?></textarea>
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
                url:"../../controller/before_after_proc.php",
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
