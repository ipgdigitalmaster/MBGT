<?php
    include("cms/include/config.php");
    //include("cms/include/function-line.php");

    /*Get Data From POST Http Request*/
    $datas = file_get_contents('php://input');
    /*Decode Json From LINE Data Body*/
    $deCode = json_decode($datas,true);

    file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);

    $replyToken = $deCode['events'][0]['replyToken'];
    $userId = $deCode['events'][0]['source']['userId'];
    $type = $deCode['events'][0]['type'];
    $uniqueIDData = uniqid();

    $LINEProfileDatas['url'] = "https://api.line.me/v2/bot/profile/".$userId;
    $LINEProfileDatas['token'] = $token;

    $resultsLineProfile = getLINEProfile($LINEProfileDatas);

    file_put_contents('log-profile.txt', $resultsLineProfile['message'] . PHP_EOL, FILE_APPEND);

    $LINEUserProfile = json_decode($resultsLineProfile['message'],true);
    $displayName = $LINEUserProfile['displayName'];

    $LINEDatas['token'] = $token;

    
	// // $messages = [];
	//$messages['replyToken'] = $replyToken;
	// // $messages['messages'][0] = getFormatTextMessage("สวัสดีครับ ยินดีต้อนรับ");

	//$encodeJson = json_encode($messages);

	//$LINEDatas['url'] = "https://api.line.me/v2/bot/message/reply";

  	//$results = sentMessage($encodeJson,$LINEDatas);
	// /*Return HTTP Request 200*/
	http_response_code(200);
?>