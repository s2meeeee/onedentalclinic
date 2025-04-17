<?php
function send_toast_sms($number, $msg, $appKey, $secretKey) {
    $url = "https://api-sms.cloud.toast.com/sms/v3.0/appKeys/$appKey/sender/sms";
    $data = array();
    $data["body"] = $msg;
    $data["sendNo"] = "01084650221";
    $data["recipientList"][]["recipientNo"] = $number;
    $data = json_encode($data);

    $header = array('Content-Type: application/json;charset=UTF-8', "X-Secret-Key: $secretKey");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    $res = curl_exec($ch);
    curl_close($ch);
    print_r($res);
}



send_toast_sms("01084650221", "NHN SMS API", "d8DmjAGybbXQgtEd", "SfsbzuAe6gS1brHc");