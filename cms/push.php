<?php
include("../include/config.php");
include("../include/function-line.php");

if($_POST['id']!=''){
  $s="select * from `".$FTblName."_response` where content_id='".$_POST['id']."' limit 0,1";
  $q = $mysqli->query($s);
  while($r=$q->fetch_assoc()){
    $userid = $r['userid'];
    $content_detail = $r['content_detail'];
    $messages['to'] = $userid;
    $messages['messages'][0] = getFormatTextMessage($content_detail);
    $LINEDatas['token'] = $token;
    $encodeJson = json_encode($messages);
    $LINEDatas['url'] = "https://api.line.me/v2/bot/message/push";
    $results = sentMessage($encodeJson,$LINEDatas);
    #echo $results;
  }
}
/*Return HTTP Request 200*/
http_response_code(200);
?>