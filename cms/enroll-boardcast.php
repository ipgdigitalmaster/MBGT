<?php
include("../include/config.php");
include("../include/function.php");
include("../include/function-line.php");

//$d="select * from `".$FTblName . "_boardcast` b inner join `".$FTblName . "_boardcastcard` c on b.boardcastcard_id = c.content_id where b.content_id = '".trim($_GET['boardcast_id'])."' ";
$d = "select * from `" . $FTblName . "_course`, mbgt_instructor where mbgt_course.course_instructor = mbgt_instructor.instructor_id and mbgt_course.content_id = '" . trim($_POST[$PK_field]) . "' ";
$result = $mysqli->query($d);
$rec = $result->fetch_assoc();

// echo '<pre>--rec';
// print_r($rec['assign_member']);
// echo '<pre>--post';
// print_r($_POST['assign_member']);

if ($_POST['assign_member'] != 'null') {

  $dif = array_diff(json_decode($_POST['assign_member']), json_decode($rec['assign_member']));
  $diff_member = [];
  if ($dif) {

    foreach ($dif as $value) {
      array_push($diff_member, $value);
    }

    $imploded_arr = implode(',', $diff_member);
    //get user id 
    $user_query = "select * from " . $FTblName . "_member where member_id in ( " . $imploded_arr . " )";
    //echo $user_query;
    $result_user = $mysqli->query($user_query);
    $userID = [];
    while ($rec_user = $result_user->fetch_assoc()) {
      array_push($userID, $rec_user['userid']);
      $s = "insert into `" . $FTblName . "_enroll` (userid,course_id,enroll_date) values ('" . $rec_user['userid'] . "','" . $rec['content_id'] . "',NOW()) ";
      $mysqli->query($s);
    }
    $messages['to'] = $userID;
    $datas = [];
    $datas['type'] = 'text';
    //$datas['altText'] = 'Boardcast !'; //'Boardcast List.';
    // $datas['contents']['type'] = 'carousel';

    $datas['text'] = 'Course Name: ' . $rec['content_name'] . ' 
Instructor: ' . $rec['instructor_name'] . ' 
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
}

?>
<script type="text/javascript">
  window.location.href = 'course.php';
</script>