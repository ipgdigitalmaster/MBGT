<?php
include("include/config.php");
include("include/function-line.php");

$page = "attendee";
$PK_field = "id";
$tbl_name = $FTblName . "_attend";
$fieldlist = array('member_id', 'course_id', 'admission_time', 'pre_test', 'after_test', 'cooperate_in_class', 'extra_point', 'suggestion');
$pagesize = 25;
if ($_POST['id'] === '') {
  # echo "add"; 
  include "../include/m_add.php";
} else {
  # echo "update";
  include("../include/m_update.php");
}
#echo $sql;


// $messages['to'] = $_POST['userid'];
// $messages['messages'][0] = getFormatTextMessage("ขอบคุณ " . $_POST['emp_name'] . " ที่ลงทะเบียนกับ MBGT#1");
// $LINEDatas['token'] = $token;
// $encodeJson = json_encode($messages);
// $LINEDatas['url'] = "https://api.line.me/v2/bot/message/push";
// $results = sentMessage($encodeJson, $LINEDatas);
// echo $results;
/*Return HTTP Request 200*/
http_response_code(200);
