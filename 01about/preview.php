<?php
include $_SERVER['DOCUMENT_ROOT'].'/include/head.php';
include_once DAO_PATH.'/PreviewDao.class.php';
include_once DAO_PATH.'/BoardDao.class.php';

$dao = new PreviewDao();

$table_b1 = "previews_b1";
$table_1f = "previews_1f";
$table_2f = "previews_2f";
$table_3f = "previews_3f";
$table_4f = "previews_4f";
$table_5f = "previews_5f";
$where = " WHERE 1";

$previews_b1_data = $dao->getDetail($table_b1, $where);
$previews_1f_data = $dao->getDetail($table_1f, $where);
$previews_2f_data = $dao->getDetail($table_2f, $where);
$previews_3f_data = $dao->getDetail($table_3f, $where);
$previews_4f_data = $dao->getDetail($table_4f, $where);
$previews_5f_data = $dao->getDetail($table_5f, $where);

function getPreviewData(PreviewDao $dao, string $table, string $where): array
{
    $previews_data = $dao->getDetail($table, $where);
    $previews_titles = explode(" / ", $previews_data['title']);
    $keys = array_keys($previews_titles);
    $last_key = end($keys);
    $title = $previews_titles[0];
    unset($previews_titles[0]);
    return array($previews_data, $previews_titles, $keys, $last_key, $title);
}

function getFilePathKeyValue($values): array {
    foreach($values as $key => $value) {
        if (substr($key, -4) !== "path") {
            unset($values[$key]);
        }
    }
    return $values;
}

function appendNonEmptyPreviewValues(&$targetArray, $sourceArray) {
    foreach ($sourceArray as $value) {
        if (!empty($value)) {
            $targetArray[] = $value;
        }
    }
}

list($previews_b1_data, $previews_b1_titles, $keys_b1, $last_key_b1, $title_b1) = getPreviewData($dao, $table_b1, $where);
list($previews_1f_data, $previews_1f_titles, $keys_1f, $last_key_1f, $title_1f) = getPreviewData($dao, $table_1f, $where);
list($previews_2f_data, $previews_2f_titles, $keys_2f, $last_key_2f, $title_2f) = getPreviewData($dao, $table_2f, $where);
list($previews_3f_data, $previews_3f_titles, $keys_3f, $last_key_3f, $title_3f) = getPreviewData($dao, $table_3f, $where);
list($previews_4f_data, $previews_4f_titles, $keys_4f, $last_key_4f, $title_4f) = getPreviewData($dao, $table_4f, $where);
list($previews_5f_data, $previews_5f_titles, $keys_5f, $last_key_5f, $title_5f) = getPreviewData($dao, $table_5f, $where);

$previews_b1_data = getFilePathKeyValue($previews_b1_data);
$previews_1f_data = getFilePathKeyValue($previews_1f_data);
$previews_2f_data = getFilePathKeyValue($previews_2f_data);
$previews_3f_data = getFilePathKeyValue($previews_3f_data);
$previews_4f_data = getFilePathKeyValue($previews_4f_data);
$previews_5f_data = getFilePathKeyValue($previews_5f_data);

$previews_total_data = array();
appendNonEmptyPreviewValues($previews_total_data, $previews_b1_data);
appendNonEmptyPreviewValues($previews_total_data, $previews_1f_data);
appendNonEmptyPreviewValues($previews_total_data, $previews_2f_data);
appendNonEmptyPreviewValues($previews_total_data, $previews_3f_data);
appendNonEmptyPreviewValues($previews_total_data, $previews_4f_data);
appendNonEmptyPreviewValues($previews_total_data, $previews_5f_data);
?>
<style>
    @media screen and (max-width: 2000px) {
        #slider .slides>li {
            height: 720px;
        }

        .preview__slider .slides img {
            height: 100%;
            margin: 0 auto;
            border-radius: 0;
            display: block;
        }
    }

    @media screen and (max-width: 660px) {
        #slider .slides>li {
            height: 240px;
        }
    }

    #preview2Box .preBox2 ul li img {
        cursor: pointer;
    }

    #preview2Box .preBox2 ul li img:hover {
        opacity: 1;
        border: #2977ed 5px solid;
    }
</style>
<div id="wrapper">
    <div class="inner2">

        <!-- Place somewhere in the <body> of your page -->
        <div id="slider" class="flexslider flexslider2 preview__slider">
            <ul class="slides">
                <?php foreach($previews_total_data as $key => $value): ?>
                <li><img src="<?=$value?>" /></li>
                <?php endforeach; ?>
                <!-- items mirrored twice, total of 12 -->
            </ul>
        </div>


        <!-- 이미지 사이즈 1300x690 -->

    </div>

    <div id="preview2Box" class="inner2">
        <div class="preBox2">
            <ul>
                <li class="on preview_b1">
                    <dt><?=$title_b1?></dt>
                    <dl>
                        <?php foreach($previews_b1_titles as $key => $title): echo $title; ?>
                        <?php if($key !== $last_key_b1): ?>
                        <br>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </dl>
                </li>
                <li>
                    <?php foreach($previews_b1_data as $key => $value): ?>
                    <a
                        <?php if($key == 'file_01_path') echo "class='on'"; if(!empty($value)) echo "style='background-image: unset;'" ?>>
                        <?php if(!empty($value)): ?>
                        <img src="<?=$value?>" class="preview_b1" />
                        <?php endif; ?>
                    </a>
                    <?php endforeach; ?>
                </li>
            </ul>
            <ul>
                <li class="preview_1f">
                    <dt><?=$title_1f?></dt>
                    <dl>
                        <?php foreach($previews_1f_titles as $key => $title): echo $title; ?>
                        <?php if($key !== $last_key_1f): ?>
                        <br>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </dl>
                </li>
                <li>
                    <?php foreach($previews_1f_data as $key => $value): ?>
                    <a <?php if(!empty($value)) echo "style='background-image: unset;'" ?>>
                        <?php if(!empty($value)): ?>
                        <img src="<?=$value?>" class="preview_1f" />
                        <?php endif; ?>
                    </a>
                    <?php endforeach; ?>
                </li>
            </ul>
            <ul>
                <li class="preview_2f">
                    <dt><?=$title_2f?></dt>
                    <dl>
                        <?php foreach($previews_2f_titles as $key => $title): echo $title; ?>
                        <?php if($key !== $last_key_2f): ?>
                        <br>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </dl>
                </li>
                <li>
                    <?php foreach($previews_2f_data as $key => $value): ?>
                    <a <?php if(!empty($value)) echo "style='background-image: unset;'" ?>>
                        <?php if(!empty($value)): ?>
                        <img src="<?=$value?>" class="preview_2f" />
                        <?php endif; ?>
                    </a>
                    <?php endforeach; ?>
                </li>
            </ul>
            <ul>
                <li class="preview_3f">
                    <dt><?=$title_3f?></dt>
                    <dl>
                        <?php foreach($previews_3f_titles as $key => $title): echo $title; ?>
                        <?php if($key !== $last_key_3f): ?>
                        <br>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </dl>
                </li>
                <li>
                    <?php foreach($previews_3f_data as $key => $value): ?>
                    <a <?php if(!empty($value)) echo "style='background-image: unset;'" ?>>
                        <?php if(!empty($value)): ?>
                        <img src="<?=$value?>" class="preview_3f" />
                        <?php endif; ?>
                    </a>
                    <?php endforeach; ?>
                </li>
            </ul>
            <ul>
                <li class="preview_4f">
                    <dt><?=$title_4f?></dt>
                    <dl>
                        <?php foreach($previews_4f_titles as $key => $title): echo $title; ?>
                        <?php if($key !== $last_key_4f): ?>
                        <br>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </dl>
                </li>
                <li>
                    <?php foreach($previews_4f_data as $key => $value): ?>
                    <a <?php if(!empty($value)) echo "style='background-image: unset;'" ?>>
                        <?php if(!empty($value)): ?>
                        <img src="<?=$value?>" class="preview_4f" />
                        <?php endif; ?>
                    </a>
                    <?php endforeach; ?>
                </li>
            </ul>
            <ul>
                <li class="preview_5f">
                    <dt><?=$title_5f?></dt>
                    <dl>
                        <?php foreach($previews_5f_titles as $key => $title): echo $title; ?>
                        <?php if($key !== $last_key_5f): ?>
                        <br>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </dl>
                </li>
                <li>
                    <?php foreach($previews_5f_data as $key => $value): ?>
                    <a <?php if(!empty($value)) echo "style='background-image: unset;'" ?>>
                        <?php if(!empty($value)): ?>
                        <img src="<?=$value?>" class="preview_5f" />
                        <?php endif; ?>
                    </a>
                    <?php endforeach; ?>
                </li>
            </ul>
        </div>
    </div>

    <div class="preBox01 mt200">
        <div class="inner2">
            <ul>
                <li><img src="/img/01about/pre_img02.png" /></li>
                <li>
                    <dt>당신을 위한 단, 하나의 치과</dt>
                    <dl>치아건강의 처음과 끝을 함께하는 치과가 되겠습니다.</dl>
                    <!--<dl>편안한 마음, 두려움과 긴장 없는 치과 치료로 여러분의 치아 건강을 지켜드립니다.</dl>-->
                </li>
            </ul>
        </div>
    </div>

    <div class="preBox01 preBox01b">
        <div class="inner2">
            <ul>
                <li class="mobile"><img src="/img/01about/pre_img02.png" /></li>
                <li>
                    <dt>숙련된 의료진의 1:1 주치의 시스템</dt>
                    <dl>풍부한 임상경험이 말해주는 임플란트 수술의 차별화,<br>현란한 포장보다는 오직 실력으로 보답하겠습니다.</dl>
                </li>
                <li class="web"><img src="/img/01about/pre_img03.png" /></li>
            </ul>
        </div>
    </div>

    <div class="preBox01 ">
        <div class="inner2">
            <ul>
                <li><img src="/img/01about/pre_img04.png" /></li>
                <li>
                    <dt>편안한 마음으로 부담없는 상담</dt>
                    <dl>따뜻하고 안정된 분위기의 상담실에서 부담 없이 <br class="web">친절하게 상담받으실 수 있습니다.</dl>
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
    $(window).load(function () {
        $('.flexslider').flexslider({
            animation: "slide", // 애니메이션 효과, 'slide' 또는 'fade'
            slideshow: true, // 자동 슬라이드쇼 활성화
            slideshowSpeed: 3000, // 5초 간격으로 슬라이드
            pauseOnAction: true, // 사용자 인터랙션 시 슬라이드쇼 일시 중지
            pauseOnHover: true, // 마우스 호버 시 슬라이드쇼 일시 중지
            asNavFor: '#slider',
            after: function (slider) {
                // 슬라이드가 변경된 후 슬라이드쇼 재시작
                if (!slider.playing) {
                    slider.play();
                }
            }
        });

        const preview2BoxImg = jQuery("#preview2Box ul li a img");

        preview2BoxImg.each(function () {
            jQuery(this).click(function () {
                jQuery("#preview2Box ul li a").removeClass("on")
                jQuery(this).parent().addClass("on");
            });
        });

        preview2BoxImg.on('click', function () {
            let index = jQuery("#preview2Box ul li a img").index(this);
            jQuery('.flexslider').flexslider(index);
            jQuery("#preview2Box ul > li:first-child").removeClass("on");
            jQuery("li." + $(this).attr('class')).addClass("on");
        });
        jQuery(".flex-control-nav").remove();
    });
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/include/bottom.php'; ?>