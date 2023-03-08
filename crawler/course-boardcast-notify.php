<?php
include("include/config.php");
include("include/function.php");
include("include/function-line.php");

//$d="select * from `".$FTblName . "_boardcast` b inner join `".$FTblName . "_boardcastcard` c on b.boardcastcard_id = c.content_id where b.content_id = '".trim($_GET['boardcast_id'])."' ";
$d = "select * from `mbgt_course` where course_start_date BETWEEN NOW() - INTERVAL 1 HOUR AND NOW()";

$result = $mysqli->query($d);
$rec = $result->fetch_assoc();
$time = explode(' ', $rec['course_start_date'])[1];

$timestamp = strtotime($time);

if ($timestamp) {
  // invalid time format


  // echo '<pre>';
  // print_r(json_decode($rec['assign_member']));
  //get user id
  $assign_member = '';
  $count = count(json_decode($rec['assign_member']));
  // echo 'count : ' . $count;
  foreach (json_decode($rec['assign_member']) as $key => $value) {

    $assign_member .= $value;
    if ($key + 1 < $count) {
      $assign_member .=  ',';
    }
  }

  //echo $assign_member;
  //get user id 
  $user_query = "select * from " . $FTblName . "_member where member_id in ( " . $assign_member . " )";
  // echo $user_query;
  // exit;

  $result_user = $mysqli->query($user_query);
  $userID = [];
  while ($rec_user = $result_user->fetch_assoc()) {
    array_push($userID, $rec_user['userid']);
  }
  $messages['to'] = $userID;

  $datas = [];
  $datas['type'] = 'text';
  //$datas['altText'] = 'Boardcast !'; //'Boardcast List.';
  // $datas['contents']['type'] = 'carousel';

  $datas['text'] = 'For reminders, This course will start soon. 
Course Name: ' . $rec['content_name'] . '
Detail: ' . $rec['content_detail'] . '
Click Here To Enroll: https://www.ensemblethailand.com/mbgt/course-detail.php?cid=' . $rec['content_id'];

  $messages['messages'][0] = $datas;
  $encodeJson = json_encode($messages);

  // if(isset($_GET['send'])){
  //     $messages['to'] = $_GET['userid'];
  //     $messages['messages'][0] = getFormatTextMessage("ขณะนี้บัญชีใช้งานของท่านได้ถูกอนุมัติเรียบร้อยแล้วค่ะ.");
  $LINEDatas['token'] = $token;
  //     $encodeJson = json_encode($messages);
  #echo $encodeJson;

  $LINEDatas['url'] = "https://api.line.me/v2/bot/message/multicast";
  $results = sentMessage($encodeJson, $LINEDatas);
  //print_r($datas['originalContentUrl']);
  //echo "<br><br>";
  //print_r($results); 
}
