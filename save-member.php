<?php
include("include/config.php");
include("include/function-line.php");


if($_POST['userid']!='' && $_POST['emp_code']!='' && $_POST['emp_name']!=''){
  // $s="update `".$FTblName."_member` set emp_code='".$_POST['emp_code']."', emp_name='".$_POST['emp_name']."' where userid='".$_POST['userid']."'";
  $s="update `".$FTblName."_member` set emp_code='".$_POST['emp_code']."', 
                                        emp_name='".$_POST['emp_name']."', 
                                        emp_surname='".$_POST['emp_surname']."', 
                                        emp_nickname='".$_POST['emp_nickname']."', 
                                        member_email='".$_POST['member_email']."', member_position='".$_POST['member_position']."',
                                        brand_agency='".$_POST['brand_agency']."' where userid='".$_POST['userid']."'";
  $mysqli->query($s);
  
  $messages['to'] = $_POST['userid'];
  $messages['messages'][0] = getFormatTextMessage("ขอบคุณ " . $_POST['emp_name'] . " ที่ลงทะเบียนกับ MB Academy");
  $LINEDatas['token'] = $token;
  $encodeJson = json_encode($messages);
  $LINEDatas['url'] = "https://api.line.me/v2/bot/message/push";
  $results = sentMessage($encodeJson,$LINEDatas);
  echo $results;
  
	/*Return HTTP Request 200*/
	http_response_code(200);
}

?>