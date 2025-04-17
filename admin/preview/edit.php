<?php
    require_once dirname(__FILE__).'/../layouts/main.php';
    include_once CLASS_PATH.'/MysqlDB.class.php';
    include_once DAO_PATH.'/BoardDao.class.php';
    include_once DAO_PATH.'/PreviewDao.class.php';
    $backUrl = "/admin/preview";


    $where = !empty($_GET['id']) ? " WHERE id = " . $_GET['id'] : "";
    $view_table = !empty($_GET['view_table']) ? $_GET['view_table'] : "";

    if (!$where) {
        alertLocationHref("잘못된 주소입니다.", $backUrl);
    }

    if (!$view_table) {
        alertLocationHref("잘못된 주소입니다.", $backUrl);
    }

    $dao = new PreviewDao();

    $data = $dao->getDetail($view_table, $where);

    if (!$data) {
        alertLocationHref("게시글이 존재하지 않습니다.", $backUrl);
    }
?>
<script src="../cheditor/cheditor.js"></script>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("둘러보기 수정", "둘러보기 관리", "둘러보기 수정"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="update" readonly>
                    <input type="hidden" name="id" value=<?php echo $data['id'] ?> readonly>
                    <input type="hidden" name="table_name" value="<?php echo $view_table ?>" readonly>
                    <input type="hidden" name="written_by" value="<?php echo $userInfo['name'] ?? "원치과"; ?>" readonly>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-style-1">
                                <label class="text-danger">제목</label>
                                <input type="text" name="title" title="제목" class="required"
                                       placeholder="제목를 입력해주세요" value="<?php echo $data['title'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_01
                                    <?php if($data['file_01_path']): ?>
                                        <span class="text-danger pointer ms-1"
                                              onclick="deleteFile(<?php echo $data['id']?>, 'file_01')">
                                            삭제
                                        </span>
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="file_01" title="이미지_01">
                                <?php if($data['file_01_path']): ?>
                                    <a href="<?php echo $data['file_01_path'] ?>" target="_blank" class="w-100">
                                        <?php echo $data['file_01_name'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_02
                                    <?php if($data['file_02_path']): ?>
                                        <span class="text-danger pointer ms-1"
                                              onclick="deleteFile(<?php echo $data['id']?>, 'file_02')">
                                            삭제
                                        </span>
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="file_02" title="이미지_02">
                                <?php if($data['file_02_path']): ?>
                                    <a href="<?php echo $data['file_02_path'] ?>" target="_blank" class="w-100">
                                        <?php echo $data['file_02_name'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_03
                                    <?php if($data['file_03_path']): ?>
                                        <span class="text-danger pointer ms-1"
                                              onclick="deleteFile(<?php echo $data['id']?>, 'file_03')">
                                            삭제
                                        </span>
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="file_03" title="이미지_03">
                                <?php if($data['file_03_path']): ?>
                                    <a href="<?php echo $data['file_03_path'] ?>" target="_blank" class="w-100">
                                        <?php echo $data['file_03_name'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_04
                                    <?php if($data['file_04_path']): ?>
                                        <span class="text-danger pointer ms-1"
                                              onclick="deleteFile(<?php echo $data['id']?>, 'file_04')">
                                            삭제
                                        </span>
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="file_04" title="이미지_04">
                                <?php if($data['file_04_path']): ?>
                                    <a href="<?php echo $data['file_04_path'] ?>" target="_blank" class="w-100">
                                        <?php echo $data['file_04_name'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_05
                                    <?php if($data['file_05_path']): ?>
                                        <span class="text-danger pointer ms-1"
                                              onclick="deleteFile(<?php echo $data['id']?>, 'file_05')">
                                            삭제
                                        </span>
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="file_05" title="이미지_05">
                                <?php if($data['file_05_path']): ?>
                                    <a href="<?php echo $data['file_05_path'] ?>" target="_blank" class="w-100">
                                        <?php echo $data['file_05_name'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_06
                                    <?php if($data['file_06_path']): ?>
                                        <span class="text-danger pointer ms-1"
                                              onclick="deleteFile(<?php echo $data['id']?>, 'file_06')">
                                            삭제
                                        </span>
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="file_06" title="이미지_06">
                                <?php if($data['file_06_path']): ?>
                                    <a href="<?php echo $data['file_06_path'] ?>" target="_blank" class="w-100">
                                        <?php echo $data['file_06_name'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_07
                                    <?php if($data['file_07_path']): ?>
                                        <span class="text-danger pointer ms-1"
                                              onclick="deleteFile(<?php echo $data['id']?>, 'file_07')">
                                            삭제
                                        </span>
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="file_07" title="이미지_07">
                                <?php if($data['file_07_path']): ?>
                                    <a href="<?php echo $data['file_07_path'] ?>" target="_blank" class="w-100">
                                        <?php echo $data['file_07_name'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_08
                                    <?php if($data['file_08_path']): ?>
                                        <span class="text-danger pointer ms-1"
                                              onclick="deleteFile(<?php echo $data['id']?>, 'file_08')">
                                            삭제
                                        </span>
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="file_08" title="이미지_08">
                                <?php if($data['file_08_path']): ?>
                                    <a href="<?php echo $data['file_08_path'] ?>" target="_blank" class="w-100">
                                        <?php echo $data['file_08_name'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_09
                                    <?php if($data['file_09_path']): ?>
                                        <span class="text-danger pointer ms-1"
                                              onclick="deleteFile(<?php echo $data['id']?>, 'file_09')">
                                            삭제
                                        </span>
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="file_09" title="이미지_09">
                                <?php if($data['file_09_path']): ?>
                                    <a href="<?php echo $data['file_09_path'] ?>" target="_blank" class="w-100">
                                        <?php echo $data['file_09_name'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>이미지_10
                                    <?php if($data['file_10_path']): ?>
                                        <span class="text-danger pointer ms-1"
                                              onclick="deleteFile(<?php echo $data['id']?>, 'file_10')">
                                            삭제
                                        </span>
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="file_10" title="이미지_10">
                                <?php if($data['file_10_path']): ?>
                                    <a href="<?php echo $data['file_10_path'] ?>" target="_blank" class="w-100">
                                        <?php echo $data['file_10_name'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn info-btn btn-hover" href="/admin/preview">목록</a>
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
                url:"../../controller/preview_proc.php",
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
