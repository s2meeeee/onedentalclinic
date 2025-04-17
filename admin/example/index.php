<?php require_once '../layouts/main.php'; ?>
<section class="section">
    <div class="container-fluid">
        <?php echo sectionTitle("회원목록", "회원관리", "회원등록"); ?>
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-style mb-30">
                        <div class="d-none d-md-flex justify-content-between align-items-center mb-10">
                            <h6>전체 회원목록</h6>
                            <div class="d-flex">
                                <form action="#" method="get" class="d-flex position-relative bg-light board-search">
                                    <input type="text" class="form-control pl-35" placeholder="Search...">
                                    <button class="position-absolute top-0 border-0 bg-transparent"
                                            style="height:38px; left:10px;">
                                        <i class="lni lni-search-alt"></i>
                                    </button>
                                </form>
                                <form action="#" method="get">
                                    <select name="" id="" class="form-select ms-2">
                                        <option value="">1</option>
                                    </select>
                                </form>

                            </div>
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><h6>Lead</h6></th>
                                    <th><h6>Email</h6></th>
                                    <th><h6>Phone No</h6></th>
                                    <th><h6>Company</h6></th>
                                    <th><h6>Action</h6></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="min-width">
                                        <div class="lead">
                                            <div class="lead-text">
                                                <p>Courtney Henry</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="min-width">
                                        <p><a href="#0">yourmail@gmail.com</a></p>
                                    </td>
                                    <td class="min-width">
                                        <p>(303)555 3343523</p>
                                    </td>
                                    <td class="min-width">
                                        <p>UIdeck digital agency</p>
                                    </td>
                                    <td>
                                        <div class="action">
                                            <button class="text-danger">
                                                <i class="lni lni-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <a href="/adm/super/user/create.php" class="btn primary-btn btn-hover">Insert</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php require_once '../layouts/bottom.php'; ?>
