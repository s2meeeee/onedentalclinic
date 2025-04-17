<?php

function sectionTitle($mainTitle, $subTitle, $subSubTitle, $branchName = "원치과")
{
    return sprintf('
        <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>%s</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a>%s</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a>%s</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                %s
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    ', $mainTitle, $branchName, $subTitle, $subSubTitle);
}

function alert($message=null) {
    echo "<script>";
    echo "alert('".$message."');";
    echo "</script>";
}

function reload() {
    echo "<script>";
    echo "window.location.reload();";
    echo "</script>";
}

function alertReload($message) {
    echo "<script>";
    echo "alert('".$message."');";
    echo "window.location.reload();";
    echo "</script>";
}

function alertLocationHref($message, $locationHref) {
    echo "<script>";
    echo "alert('".$message."');";
    echo "window.location.href = '" . $locationHref . "';";
    echo "</script>";
}

function alertLocationBack($message) {
    echo "<script>";
    echo "alert('".$message."');";
    echo "window.history.back();";
    echo "</script>";
}

function statusText($value) {
    $status = "";
    if ($value === 'Y'):
        $status = '답변완료';
    elseif ($value === 'N'):
        $status = '답변대기';
    elseif ($value === "W"):
        $status = '답변보류';
    endif;
    return $status;
}

function printPaging($total_count, $query_string, $page_variable='page', $lpp=10, $ppp=10)
{
    parse_str($query_string, $parameter);

    $parameter[$page_variable] = !empty($parameter[$page_variable]) ? $parameter[$page_variable] : 1;
    $total_page = ceil($total_count/$lpp);
    $page_block = ceil($parameter[$page_variable]/$ppp);
    $offset = ( ($page_block-1)*$ppp ) + 1;
    $limit = ($total_page==1) ? $total_page+1 : ($offset+$ppp>$total_page ? $total_page+1 : $offset+$ppp);

    if($total_count>0)
    {
        $curr_page = $parameter[$page_variable];
        $prev_page = $parameter[$page_variable]-1;
        $next_page = $parameter[$page_variable]+1;

        if($prev_page>0)
        {
            $parameter[$page_variable] = $prev_page;
            echo '<li class="page-item"><a href="'.$_SERVER['PHP_SELF'].
                 '?'.htmlentities(http_build_query($parameter)).
                 '" class="page-link">'.
                 '<span aria-hidden="true">&laquo;</span>'.
                 '</a></li>';
        }

        for($p=$offset; $p<$limit; $p++)
        {
            $curr = ($curr_page == $p) ? 'active"' : '';

            $parameter[$page_variable] = $p;
            echo '<li class="page-item '.$curr.'">';

            echo '<a href="'.$_SERVER['PHP_SELF'].'?'.
                 htmlentities(http_build_query($parameter)).
                 '"class="page-link">'.$p.'</a>';
            echo '</li>';
        }

        if($total_page>=$next_page)
        {
            $parameter[$page_variable] = $next_page;
            echo '<li class="page-item"><a href="'.$_SERVER['PHP_SELF'].'?'.
                 htmlentities(http_build_query($parameter)).
                 '" class="page-link">'.
                 '<span aria-hidden="true">&raquo;</span>'.
                 '</a></li>';
        }
    }
}

function array_key_last_7_0_0($array) {
    if (!is_array($array) || empty($array)) {
        return null;
    }

    end($array);
    return key($array);
}


