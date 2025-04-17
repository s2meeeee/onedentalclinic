<?php require_once '../layouts/main.php'; ?>
<section class="section">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title mb-30">
                        <h2>회원등록</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#0">JM 가정의학과</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#0">회원관리</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    회원등록
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <div class="title mb-30">
                    <h6>My Profile</h6>
                </div>
                <form action="#">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>Full Name</label>
                                <input type="text" placeholder="Full Name">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>Email</label>
                                <input type="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>Company</label>
                                <input type="text" placeholder="Company">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>File</label>
                                <input type="file">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>Address</label>
                                <input type="text" placeholder="Address">
                            </div>
                        </div>
                        <div class="col-xxl-4">
                            <div class="input-style-1">
                                <label>City</label>
                                <input type="text" placeholder="City">
                            </div>
                        </div>
                        <div class="col-xxl-4">
                            <div class="input-style-1">
                                <label>Zip Code</label>
                                <input type="text" placeholder="Zip Code">
                            </div>
                        </div>
                        <div class="col-xxl-4">
                            <div class="select-style-1">
                                <label>Country</label>
                                <div class="select-position">
                                    <select class="light-bg">
                                        <option value="">Select category</option>
                                        <option value="">USA</option>
                                        <option value="">UK</option>
                                        <option value="">Canada</option>
                                        <option value="">India</option>
                                        <option value="">Bangladesh</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label>About Me</label>
                                <textarea placeholder="Type here" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="main-btn primary-btn btn-hover">
                                Update Profile
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end card -->
        </div>
    </div>
</section>
<?php require_once '../layouts/bottom.php'; ?>
