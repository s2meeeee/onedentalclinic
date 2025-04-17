<?php
    require_once dirname(__FILE__).'/../layouts/main.php';
    include_once CLASS_PATH.'/MysqlDB.class.php';
    include_once DAO_PATH.'/BoardDao.class.php';
    include_once DAO_PATH.'/NewsLetterDao.class.php';
    $backUrl = "/admin/news-letter";


    $where = !empty($_GET['id']) ? " WHERE id = " . $_GET['id'] : "";

    if (!$where) {
        alertLocationHref("잘못된 주소입니다.", $backUrl);
    }

    $dao = new NewsLetterDao();

    $data = $dao->getDetail("news_letters", $where);

    if (!$data) {
        alertLocationHref("게시글이 존재하지 않습니다.", $backUrl);
    }
?>
<script src="../cheditor/cheditor.js"></script>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("뉴스레터 수정", "뉴스레터 관리", "뉴스레터 수정"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="update" readonly>
                    <input type="hidden" name="id" value=<?php echo $data['id'] ?> readonly>
                    <input type="hidden" name="written_by" value="<?php echo $userInfo['name'] ?? "원치과"; ?>" readonly>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-style-1">
                                <label class="text-danger">제목</label>
                                <input type="text" name="title" title="제목" class="required"
                                       placeholder="제목를 입력해주세요" value="<?php echo $data['title'] ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label class="text-danger">썸네일
                                    <?php if($data['file_01_path']): ?>
                                        <span class="text-danger pointer ms-1"
                                              onclick="deleteFile(<?php echo $data['id']?>, 'file_01')">
                                            삭제
                                        </span>
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="file_01" title="썸네일 이미지" class="required">
                                <?php if($data['file_01_path']): ?>
                                    <a href="<?php echo $data['file_01_path'] ?>" download class="w-100">
                                        <?php echo $data['file_01_name'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label class="text-danger">파일 (348*208)
                                    <?php if($data['file_02_path']): ?>
                                        <span class="text-danger pointer ms-1"
                                              onclick="deleteFile(<?php echo $data['id']?>, 'file_02')">
                                            삭제
                                        </span>
                                    <?php endif; ?>
                                </label>
                                <input type="file" name="file_02" title="파일" class="required">
                                <?php if($data['file_02_path']): ?>
                                    <a href="<?php echo $data['file_02_path'] ?>" download class="w-100">
                                        <?php echo $data['file_02_name'] ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn info-btn btn-hover" href="/admin/news-letter">목록</a>
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
                url:"../../controller/news_letter_proc.php",
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
                url:"../../controller/news_letter_proc.php",
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
