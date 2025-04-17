<?php include $_SERVER['DOCUMENT_ROOT'].'/include/head.php';

$id = !empty($_GET['id']) ? "" . $_GET['id'] : 1;
$where = "";
$title = "";
if ($id == 1) {
    include_once DAO_PATH.'/UnpaidActDao.class.php';
    $dao = new UnpaidActDao();
    $table_view = "unpaid_acts";
    $title = "행위료";
} else if ($id == 2) {
    include_once DAO_PATH.'/UnpaidTreatmentDao.class.php';
    $dao = new UnpaidTreatmentDao();
    $table_view = "unpaid_treatments";
    $title = "치료재료대";
} else if ($id == 3) {
    include_once DAO_PATH.'/UnpaidDrugDao.class.php';
    $dao = new UnpaidDrugDao();
    $table_view = "unpaid_drugs";
    $title = "약제비";
} else if ($id == 4) {
    include_once DAO_PATH.'/UnpaidProofDao.class.php';
    $dao = new UnpaidProofDao();
    $table_view = "unpaid_proofs";
    $title = "제증명수수료";
} else if ($id == 5) {
    include_once DAO_PATH.'/UnpaidChoiceDao.class.php';
    $dao = new UnpaidChoiceDao();
    $table_view = "unpaid_choices";
    $title = "선택진료료";
} else {
    alertLocationHref("잘못된 주소입니다.", "/");
}
$search = !empty($_GET['search']) ? $_GET['search'] : "";

if ($search) {
    $where .= " AND designation like '%".$search."%'";
}

$data = $dao->getList($table_view, $where);

?>

<script type="text/JavaScript">
    /*
        function tabSwap(sw) {
            for (i = 1; i < 7; i++) {
                if (sw == i) {
                    document.getElementById('menu'+i+'contents').style.display='';

                } else {
                    document.getElementById('menu'+i+'contents').style.display='none';

                }
            }
        }
        */
    </script>
<div id="wrapper">

    <!-- 탭 1 -->
    <div id="menu<?php echo $id ?>contents" class="inner">
        <div class="subCenterTab subTab05 mt80 mb50">
            <a href="/08counseling/npay.php?id=1" class="<?php if($id ==1) echo 'on' ?>">행위료</a>


            <a href="/08counseling/npay.php?id=4" class="<?php if($id ==4) echo 'on' ?>">제증명수수료</a>

        </div>

        <!-- 검색 -->
        <div class="boardSearch">
            <form method="get">
                <select name="search">
                    <option value="designation">명칭</option>
                </select>
                <input type="text" name="search" value="<?php echo $search ?>" placeholder="검색어를 입력하세요.">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="submit" value="검색">
            </form>
        </div>
        <!-- //검색 -->

        <div class="subTitle01npay"><?php echo $title ?>
            <div class="txtRight">최종수정일 : 2024-06-14</div>
        </div>
        <!-- 내용 -->
        <?php if($id == 1): ?>
        <div class="iteBox00">
            <table class="iteBox01 table01">
                <tbody>
                    <tr>
                        <th>중분류</th>
                        <th>소분류</th>
                        <th>코드</th>
                        <th>명칭</th>
                        <th>구분</th>
                        <th>비용</th>
                        <th>최저비용</th>
                        <th>최대비용</th>
                        <th>치료재료대<br>포함여부</th>
                        <th>약제비<br>포함여부</th>
                        <th>특이사항</th>
                        <th>최종<br>변경일</th>
                    </tr>
                    <?php
                if($data['total_cnt'] > 0):
                    foreach($data['values'] as $value):
                        ?>
                    <tr>
                        <td><?php echo $value['middle_classification'] ?></td>
                        <td><?php echo $value['small_classification'] ?></td>
                        <td><?php echo $value['codename'] ?></td>
                        <td><?php echo $value['designation'] ?></td>
                        <td><?php echo $value['gubun'] ?></td>
                        <td><?php
                                if(strpos($value['cost'], ",")) {
                                    echo $value['cost'];
                                } else {
                                    echo number_format($value['cost']);
                                }
                                ?>
                        </td>
                        <td><?php echo $value['minimum_cost'] == 0 ? "" : number_format($value['minimum_cost']) ?></td>
                        <td><?php echo $value['maximum_cost'] == 0 ? "" : number_format($value['maximum_cost']) ?></td>
                        <td><?php echo $value['treatment_include'] ?></td>
                        <td><?php echo $value['drug_include'] ?></td>
                        <td><?php echo $value['uniqueness'] ?></td>
                        <td><?php echo $value['last_change_date'] ?></td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="12">등록된 데이타가 없습니다. </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- //내용 -->

    </div>
    <?php elseif($id == 2): ?>
    <!-- //탭 1 -->
    <!-- 탭 2 -->
    <!-- 내용 -->
    <!--신옌삭제6.17 치료재료대 삭제<div class="iteBox00">
        <table class="iteBox01 table02">
            <tbody>
            <tr>
                <th>분류</th>
                <th>코드</th>
                <th>명칭</th>
                <th>구분</th>
                <th>비용</th>
                <th>최저비용</th>
                <th>최대비용</th>
                <th>특이사항</th>
                <th>최종변경일</th>
            </tr>
            <?php
            if($data['total_cnt'] > 0):
                foreach($data['values'] as $value):
                    ?>
                    <tr>
                        <td><?php echo $value['middle_classification'] ?></td>
                        <td><?php echo $value['codename'] ?></td>
                        <td><?php echo $value['designation'] ?></td>
                        <td><?php echo $value['gubun'] ?></td>
                        <td><?php
                            if(strpos($value['cost'], ",")) {
                                echo $value['cost'];
                            } else {
                                echo number_format($value['cost']);
                            }
                            ?>
                        </td>
                        <td><?php echo $value['minimum_cost'] == 0 ? "" : number_format($value['minimum_cost']) ?></td>
                        <td><?php echo $value['maximum_cost'] == 0 ? "" : number_format($value['maximum_cost']) ?></td>
                        <td><?php echo $value['uniqueness'] ?></td>
                        <td><?php echo $value['last_change_date'] ?></td>
                    </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="9">등록된 데이타가 없습니다. </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        </div>-->
    <!-- //내용 -->

</div>
<!-- //탭 2 -->
<?php elseif($id == 3): ?>

<!-- 탭 3 -->
<!-- 내용 -->
<!--신옌수정6.17약제비 삭제<div class="iteBox00">
    <table class="iteBox01 table03">
        <tbody>
        <tr>
            <th>코드</th>
            <th>명칭</th>
            <th>비용</th>
            <th>특이사항</th>
            <th>최종변경일</th>
        </tr>
        <?php
        if($data['total_cnt'] > 0):
            foreach($data['values'] as $value):
                ?>
                <tr>
                    <td><?php echo $value['codename'] ?></td>
                    <td><?php echo $value['designation'] ?></td>
                    <td><?php
                        if(strpos($value['cost'], ",")) {
                            echo $value['cost'];
                        } else {
                            echo number_format($value['cost']);
                        }
                        ?>
                    </td>
                    <td><?php echo $value['gubun'] ?></td>
                    <td><?php echo $value['last_change_date'] ?></td>
                </tr>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="5">등록된 데이타가 없습니다. </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>-->
<!-- //내용 -->

</div>
<!-- //탭 3 -->

<!-- 탭 4 -->
<?php elseif($id == 4): ?>
<!-- 내용 -->
<div class="iteBox00">
    <table class="iteBox01 table04">
        <tbody>
            <tr>
                <th>코드</th>
                <th>명칭</th>
                <th>구분</th>
                <th>비용</th>
                <th>최저비용</th>
                <th>최대비용</th>
                <th>특이사항</th>
                <th>최종변경일</th>
            </tr>
            <?php
        if($data['total_cnt'] > 0):
            foreach($data['values'] as $value):
                ?>
            <tr>
                <td><?php echo $value['codename'] ?></td>
                <td><?php echo $value['designation'] ?></td>
                <td><?php echo $value['gubun'] ?></td>
                <td><?php
                        if(strpos($value['cost'], ",")) {
                            echo $value['cost'];
                        } else {
                            echo number_format($value['cost']);
                        }
                        ?>
                </td>
                <td><?php echo $value['minimum_cost'] == 0 ? "" : number_format($value['minimum_cost']) ?></td>
                <td><?php echo $value['maximum_cost'] == 0 ? "" : number_format($value['maximum_cost']) ?></td>
                <td><?php echo $value['uniqueness'] ?></td>
                <td><?php echo $value['last_change_date'] ?></td>
            </tr>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="8">등록된 데이타가 없습니다. </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<!-- //내용 -->

</div>
<!-- //탭 4 -->

<!-- 탭 5 -->
<!-- 내용 -->
<?php elseif($id == 5): ?>
<!--신옌삭제6.18 선택진료료 삭제<div class="iteBox00">
    <table class="iteBox01 table05">

        <tbody>
        <tr>
            <th>코드</th>
            <th>명칭</th>
            <th>구분</th>
            <th>비용</th>
            <th>최저비용</th>
            <th>최대비용</th>
            <th>특이사항</th>
            <th>최종변경일</th>
        </tr>
        <?php
        if($data['total_cnt'] > 0):
            foreach($data['values'] as $value):
                ?>
                <tr>
                    <td><?php echo $value['codename'] ?></td>
                    <td><?php echo $value['designation'] ?></td>
                    <td><?php echo $value['gubun'] ?></td>
                    <td><?php
                        if(strpos($value['cost'], ",")) {
                            echo $value['cost'];
                        } else {
                            echo number_format($value['cost']);
                        }
                        ?>
                    </td>
                    <td><?php echo $value['minimum_cost'] == 0 ? "" : number_format($value['minimum_cost']) ?></td>
                    <td><?php echo $value['maximum_cost'] == 0 ? "" : number_format($value['maximum_cost']) ?></td>
                    <td><?php echo $value['uniqueness'] ?></td>
                    <td><?php echo $value['last_change_date'] ?></td>
                </tr>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="8">등록된 데이타가 없습니다. </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>-->
<?php endif; ?>
<!-- //내용 -->

</div>
<!-- //탭 5 -->
</div>
</div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>