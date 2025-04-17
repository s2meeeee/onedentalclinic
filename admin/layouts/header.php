<?php
    /** @var $userInfo  */
?>
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
                <div class="header-left d-flex align-items-center">
                    <div class="menu-toggle-btn mr-20">
                        <button
                            id="menu-toggle"
                            class="main-btn primary-btn btn-hover"
                        >
                            <i class="lni lni-chevron-left me-2"></i> Menu
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
                <div class="header-right">
                    <div class="profile-box ml-15">
                        <button
                            class="dropdown-toggle bg-transparent border-0"
                            type="button"
                            id="profile"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <div class="profile-info">
                                <div class="info">
                                    <h6><? echo $userInfo['name'] ?></h6>
                                </div>
                            </div>
                            <i class="lni lni-chevron-down"></i>
                        </button>
                        <ul
                            class="dropdown-menu dropdown-menu-end"
                            aria-labelledby="profile"
                        >
                            <li>
                                <a href="/admin/profile/edit.php">
                                    <i class="lni lni-user"></i> 내 정보
                                </a>
                            </li>
                            <li>
                                <a href="/admin/profile/password.php">
                                    <i class="lni lni-lock"></i> 비밀번호 변경
                                </a>
                            </li>
                            <li>
                                <form id="logoutForm" method="post">
                                    <input type="hidden" name="mode" value="log_out">
                                    <a>
                                        <i class="lni lni-exit"></i>
                                        <input type="submit" value="로그아웃" style="border:inherit; background-color:inherit;">
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<script>
    jQuery("#logoutForm").submit(function(event){
        event.preventDefault();
        let data = $(this).serializeArray();
        jQuery.ajax({
            url:"../../controller/login_proc.php",
            type:"post",
            dataType:"json",
            data,
            success: function(response) {
                alert(response.msg);
                location.href = '/admin';
            }
        })
    })
</script>
<?php
