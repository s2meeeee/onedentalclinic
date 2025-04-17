<?php include $_SERVER['DOCUMENT_ROOT'].'/include/head.php'; 


include_once DAO_PATH.'/DoctorDao.class.php';

$dao = new DoctorDao();

$where = "";

$data = $dao->getList("doctors");
?>


<style>
    .docterPop ul,
    .docterPop ul li,
    .docterPop ul li img {
        height: 100%;
    }
</style>
<div id="wrapper">
  <div class="inner1100">
	  <!-- 내용 -->
  	<div class="doctorBox01">
		<ul>
    <?php
        if($data['total_cnt'] > 0):
            foreach($data['values'] as $value):
                ?>
			<li onclick = "document.all['docterPop<?=$value["id"]?>'].style.display = 'inline';">
				<img src="<?= $value['file_01_path'] ?>">
				<dt><?= $value['name'] ?> <span><?= $value['position'] ?></span></dt>
				<dl>진료내용</dl>
				<dd><?= $value['sub_department'] ?></dd>
			</li>
            <?php endforeach; endif; ?>
		</ul>
	</div>
	  <!-- //내용 -->
  </div>
</div>
<?php
if($data['total_cnt'] > 0):
    foreach($data['values'] as $value):
        ?>
        <div class="docterPop" id="docterPop<?=$value["id"]?>">
            <div class="docterPop01">
                <a onclick="document.all['docterPop<?=$value["id"]?>'].style.display = 'none';"><img src="/img/about/doctor_img02.png"></a>
                <ul>
                    <li><img style="width: 100%;" src="<?= $value['file_01_path'] ?>"></li>
                    <li>
                        <dt><?= $value['name'] ?> <span><?= $value['position'] ?></span></dt>
                        <dl>진료내용</dl>
                        <dd><?= $value['sub_department'] ?></dd>
                        <?php echo nl2br($value['career']) ?>
                    </li>
                </ul>
            </div>
            <div class="bg"></div>
        </div>
    <?php endforeach; endif; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>