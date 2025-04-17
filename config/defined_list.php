<?php

$answer_status = array('wait' => '예약대기', 'hold' => '예약보류',
    'approval' => '예약승인', 'cancel' => '예약취소', 'call' => '통화완료');

$kind = array('thanks' => '칭찬/감사', 'unkind' => '불친절/불편사항', 'proposal' => '제안/건의');

$user_status = array('active' => '활성', 'deleted' => '탈퇴', 'blocked' => '비활성');

$userAgent = $_SERVER['HTTP_USER_AGENT'];

// 간단한 모바일 디바이스 탐지를 위한 패턴
$mobilePattern = '/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i';