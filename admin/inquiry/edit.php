<?php
    require_once dirname(__FILE__).'/../layouts/main.php';
    include_once CLASS_PATH.'/MysqlDB.class.php';
    include_once DAO_PATH.'/DefaultDao.class.php';
    include_once DAO_PATH.'/ConsultDao.class.php';
    include_once DAO_PATH.'/ConsultCommentDao.class.php';
    $backUrl = "/admin/inquiry";


    $where = !empty($_GET['id']) ? " WHERE id = " . $_GET['id'] : "";

    if (!$where) {
        alertLocationHref("잘못된 주소입니다.", $backUrl);
    }

    $dao = new ConsultDao();
    $consultCommentDao = new ConsultCommentDao();

    $data = $dao->getDetail("consult", $where);

    if (!$data) {
        alertLocationHref("게시글이 존재하지 않습니다.", $backUrl);
    }

    $consultCommentsWhere = " WHERE consult_id = ".$data['id'];
    $consultCommentData = $consultCommentDao->getList('consult_comment', $consultCommentsWhere);
?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("온라인 문의 수정", "온라인 문의 관리", "온라인 문의 수정"); ?>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <form id="_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="update" readonly>
                    <input type="hidden" name="id" value=<?php echo $data['id'] ?> readonly>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>제목</label>
                                <input type="text" name="title" title="제목"
                                       placeholder="제목를 입력해주세요" value="<?php echo $data['title'] ?>" readonly disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>전화번호</label>
                                <input type="text" name="phone" title="전화번호"
                                       placeholder="전화번호를 입력해주세요" value="<?php echo $data['phone'] ?>" readonly disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>작성자</label>
                                <input type="text" name="written_by" title="작성자"
                                       placeholder="작성자를 입력해주세요" value="<?php echo $data['written_by'] ?>" readonly disabled>
                            </div>
                        </div>
                        <?php if($data['file_01_name']): ?>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>업로드 파일</label>
                                <a href="<?php echo $data['file_01_path'] ?>" readonly disabled><?php echo $data['file_01_name'] ?></a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-6">
                            <div class="select-style-1">
                                <label class="text-danger">상태</label>
                                <div class="select-position">
                                    <select name="status" class="required">
                                        <option value="wait" <?php if($data['status'] == "wait") echo 'selected' ?>>답변대기</option>
                                        <option value="hold" <?php if($data['status'] == "hold") echo 'selected' ?>>답변보류</option>
                                        <option value="ok" <?php if($data['status'] == "ok") echo 'selected' ?>>답변완료</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-style-1">
                                <label>답변수정</label>
                                <input type="submit" style="background-color: #4a6cf7; color: #fff;" value="수정" />
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="input-style-1">
                                <label>내용</label>
                                <textarea
                                        id="content" name="content" cols="30" rows="4" title="내용"
                                        placeholder="내용을 입력해주세요" readonly disabled><?php echo $data['content'] ?></textarea>
                            </div>
                        </div>
                        </form>
                        <form id="comment_form" method="post">
                            <input type="hidden" name="mode" value="insert" readonly>
                            <input type="hidden" name="consult_id" value="<?php echo $data['id'] ?>" readonly>
                            <input type="hidden" name="written_by" value="<?php echo $userInfo['name'] ?>" readonly>
                            <div class="col-12 mt-4">
                                <div class="input-style-1">
                                    <label>댓글등록하기</label>
                                    <input type="text" name="comment" required>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end mb-5">
                                <input type="submit" class="btn btn-info btn-hover text-white" value="댓글등록" >
                            </div>
                        </form>
                        <?php if($consultCommentData['total_cnt'] > 0): foreach($consultCommentData['values'] as $value): ?>
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>
                                        댓글
                                        <span class="ms-3">작성자 - <?php echo $value['written_by'] ?></span>
                                        <span
                                                class="mx-4 pointer" style="color: blue;"
                                                onclick="updateComment(<?= $value['id'] ?>)">수정</span>
                                        <span class="pointer text-danger" onclick="deleteComment(<?= $value['id'] ?>)">삭제</span>
                                    </label>
                                    <input type="text" id="comment" value="<?php echo $value['comment'] ?>">
                                </div>
                            </div>
                        <?php endforeach; endif; ?>
                        <div class="col-12 d-flex justify-content-between">
                            <a class="btn info-btn btn-hover" href="/admin/inquiry">목록</a>
                        </div>
                    </div>

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
                url:"../../controller/consult_proc.php",
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

    const updateComment = (id) => {
        const comment = jQuery("#comment").val();

        if (comment === "") {
            alert("댓글을 입력해주세요");
            return false;
        }
        data = {
            mode: "update",
            id,
            comment
        }
        jQuery.ajax({
            url:"../../controller/consult_comment_proc.php",
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

    const deleteComment = (id) => {
        if(confirm("삭제하시겠습니까?")) {
            data = {
                mode: "delete",
                id
            }
            jQuery.ajax({
                url:"../../controller/consult_comment_proc.php",
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

    jQuery("#comment_form").submit(function(event){
        event.preventDefault();
        let data = jQuery(this).serializeArray();
        jQuery.ajax({
            url:"../../controller/consult_comment_proc.php",
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
    })
</script>
<?php require_once dirname(__FILE__).'/../layouts/bottom.php'; ?>
