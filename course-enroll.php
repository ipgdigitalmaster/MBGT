<?php
include("include/config.php");
include("include/function-line.php");
if ($_GET['userid'] != '' && $_GET['cid'] != '') {
    $gs = "select * from `" . $FTblName . "_course` where content_id = '" . $_GET['cid'] . "' ";
    $gq = $mysqli->query($gs);
    $gr = $gq->fetch_assoc();

    $s = "insert into `" . $FTblName . "_enroll` (userid,course_id,enroll_date) values ('" . $_GET['userid'] . "','" . $_GET['cid'] . "',NOW()) ";
    $mysqli->query($s);
    #echo $s;

    $sql_member = "select * from mbgt_member where userid = '" . $_GET['userid'] . "'";
    $query_member = $mysqli->query($sql_member);
    while ($result_member = $query_member->fetch_assoc()) {
        $member_id = $result_member['member_id'];
    }

    $sql_course = "select * from mbgt_course where content_id = '" . $_GET['cid'] . "'";
    $query_course = $mysqli->query($sql_course);
    while ($result_course = $query_course->fetch_assoc()) {
        $assign_member = json_decode($result_course['assign_member']);
        array_push($assign_member, $member_id);
    }
    $sql_update_course = "update mbgt_course set assign_member = '" . json_encode($assign_member) . "' where content_id = '" . $_GET['cid'] . "'";
    #echo $sql_update_course;
    $mysqli->query($sql_update_course);

    $messages['to'] = $_GET['userid'];
    $messages['messages'][0] = getFormatTextMessage("คุณได้ลงทะเบียน " . $gr['content_name'] . " MBGT#1");
    $LINEDatas['token'] = $token;
    $encodeJson = json_encode($messages);
    $LINEDatas['url'] = "https://api.line.me/v2/bot/message/push";
    $results = sentMessage($encodeJson, $LINEDatas);
    echo $results;
    /*Return HTTP Request 200*/
    http_response_code(200);
}
?>
<script>
    window.location.href = "my-course.php?userid=<?php echo $_GET['userid']; ?>&alert=true";
</script>