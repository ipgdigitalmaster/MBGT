<?php 
include("../include/config.php");
include("../include/function.php");
include("../include/function-line.php");
if(isset($_GET['boardcast_id'])){

  //$d="select * from `".$FTblName . "_boardcast` b inner join `".$FTblName . "_boardcastcard` c on b.boardcastcard_id = c.content_id where b.content_id = '".trim($_GET['boardcast_id'])."' ";
  $d="select * from `".$FTblName . "_boardcast` where content_id = '".trim($_GET['boardcast_id'])."' ";
  $result = $mysqli->query($d);
  $rec = $result->fetch_assoc();
  $num_send = 499;
  $me = explode(",",$rec['content_user_send']);

  $bid = explode(",",$rec['boardcastcard_id']);


  $round = count($me);
  $round_1 = ceil($round / $num_send);

  for($ro=0;$ro<$round_1;$ro++){
    $start = $ro * $num_send;
    $messages['to'] = array_slice($me,$start,$num_send);

  $content_boardtype = $rec['content_boardtype'];

  $datas = [];
  if($content_boardtype=="text"){
    $datas['type'] = 'text';
  }else if ($content_boardtype=="image"){
    $datas['type'] = 'image';
  }else if ($content_boardtype=="video"){
    $datas['type'] = 'video';
  }else{
    $datas['type'] = 'flex';
    //$datas['altText'] = $rr['content_text_1']; //'Boardcast List.';
    $datas['altText'] = 'Boardcast !'; //'Boardcast List.';
    $datas['contents']['type'] = 'carousel';
  }
  $coni = 0;
  #echo $content_boardtype;
  for($a=0;$a<count($bid);$a++){
    // TO
    $dd = "select * from `".$FTblName . "_boardcastcard` where content_id = '".$bid[$a]."' ";
    $res = $mysqli->query($dd);
    while($rr = $res->fetch_assoc()){
      if($content_boardtype=="text"){
        $datas['text'] = $rr['content_text_1'];
      }else if ($content_boardtype=="image"){
        $datas['originalContentUrl'] = $rr['content_image'];
        $datas['previewImageUrl'] = $rr['content_image'];
      }else if ($content_boardtype=="video"){
        $datas['originalContentUrl'] = $rr['content_video'];
        $datas['previewImageUrl'] = $rr['content_image'];
      }else{
        $datas['contents']['contents'][$coni]['type'] = 'bubble';
        if ($rr['content_header'] != ""){
          $datas['contents']['contents'][$coni]['header']['type'] = 'box';
          $datas['contents']['contents'][$coni]['header']['layout'] = 'horizontal';
          $datas['contents']['contents'][$coni]['header']['contents'][0]['type'] = 'text';
          $datas['contents']['contents'][$coni]['header']['contents'][0]['text'] = $rr['content_header'];
          $datas['contents']['contents'][$coni]['header']['contents'][0]['size'] = 'xxs';
          $datas['contents']['contents'][$coni]['header']['contents'][0]['weight'] = 'regular';
          $datas['contents']['contents'][$coni]['header']['contents'][0]['color'] = '#AAAAAA';
        }
        $datas['contents']['contents'][$coni]['hero']['type'] = 'image';
        $datas['contents']['contents'][$coni]['hero']['url'] = $rr['content_image'];
        $datas['contents']['contents'][$coni]['hero']['size'] = 'full';
        $datas['contents']['contents'][$coni]['hero']['aspectRatio'] = '20:13';
        $datas['contents']['contents'][$coni]['hero']['aspectMode'] = 'cover';

        $datas['contents']['contents'][$coni]['body']['type'] = 'box';
        $datas['contents']['contents'][$coni]['body']['layout'] = 'vertical'; 
        $datas['contents']['contents'][$coni]['body']['contents'][0]['type'] = 'text';
        $datas['contents']['contents'][$coni]['body']['contents'][0]['text'] = $rr['content_text_1'];
        $datas['contents']['contents'][$coni]['body']['contents'][0]['weight'] = 'bold';
        $datas['contents']['contents'][$coni]['body']['contents'][0]['wrap'] = true;
        $ci = 1;
        if ($rr['content_text_2'] != ""){
          $datas['contents']['contents'][$coni]['body']['contents'][$ci]['type'] = 'text';
          $datas['contents']['contents'][$coni]['body']['contents'][$ci]['text'] = $rr['content_text_2'];
          $datas['contents']['contents'][$coni]['body']['contents'][$ci]['wrap'] = true;
          $ci+=1;
        }
        if ($rr['content_text_3'] != ""){
          $datas['contents']['contents'][$coni]['body']['contents'][$ci]['type'] = 'text';
          $datas['contents']['contents'][$coni]['body']['contents'][$ci]['text'] = $rr['content_text_3'];
          $datas['contents']['contents'][$coni]['body']['contents'][$ci]['size'] = 'xs';
          $datas['contents']['contents'][$coni]['body']['contents'][$ci]['wrap'] = true;
        }

        $datas['contents']['contents'][$coni]['footer']['type'] = 'box';
        $datas['contents']['contents'][$coni]['footer']['layout'] = 'vertical';
        $datas['contents']['contents'][$coni]['footer']['contents'][0]['type'] = 'button';
        $datas['contents']['contents'][$coni]['footer']['contents'][0]['action']['type'] = 'uri';
        $datas['contents']['contents'][$coni]['footer']['contents'][0]['action']['label'] = $rr['content_button_1'];
        $datas['contents']['contents'][$coni]['footer']['contents'][0]['action']['uri'] = $rr['content_button_1_url'];
        if($rr['content_button_1_color'] != ""){
          $datas['contents']['contents'][$coni]['footer']['contents'][0]['color'] = $rr['content_button_1_color'];
          $datas['contents']['contents'][$coni]['footer']['contents'][0]['style'] = 'primary'; 
        }

        $bi = 1;
        if($rr['content_button_2'] != ""){
          $datas['contents']['contents'][$coni]['footer']['contents'][$bi]['type'] = 'button';
          $datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['type'] = 'uri';
          $datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['label'] = $rr['content_button_2'];
          $datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['uri'] = $rr['content_button_2_url'];
          if($rr['content_button_2_color'] != ""){
            $datas['contents']['contents'][$coni]['footer']['contents'][$bi]['color'] = $rr['content_button_2_color'];
            $datas['contents']['contents'][$coni]['footer']['contents'][$bi]['style'] = 'primary'; 
          }
          $bi+=1;
        }
        if($rr['content_button_3'] != ""){
          $datas['contents']['contents'][$coni]['footer']['contents'][$bi]['type'] = 'button';
          $datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['type'] = 'uri';
          $datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['label'] = $rr['content_button_3'];
          $datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['uri'] = $rr['content_button_3_url'];
          if($rec['content_button_3_color'] != ""){
            $datas['contents']['contents'][$coni]['footer']['contents'][$bi]['color'] = $rr['content_button_3_color'];
            $datas['contents']['contents'][$coni]['footer']['contents'][$bi]['style'] = 'primary'; 
          }
        }
      } 
      $coni = $coni + 1;
    } 
  }
    #print_r($datas);
    #echo "<hr>";

    $messages['messages'][0] = $datas;
    $encodeJson = json_encode($messages);
        // if(isset($_GET['send'])){
        //     $messages['to'] = $_GET['userid'];
        //     $messages['messages'][0] = getFormatTextMessage("ขณะนี้บัญชีใช้งานของท่านได้ถูกอนุมัติเรียบร้อยแล้วค่ะ.");
    $LINEDatas['token'] = $token;
        //     $encodeJson = json_encode($messages);
    $LINEDatas['url'] = "https://api.line.me/v2/bot/message/multicast";
    $results = sentMessage($encodeJson,$LINEDatas);
    //print_r($datas['originalContentUrl']);
    //echo "<br><br>";
    //print_r($results);
  }
}
?>
<script type="text/javascript">
  window.location.href='boardcast.php';
</script>