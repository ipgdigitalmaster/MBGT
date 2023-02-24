<?php
function getEmoticon($code)
{
	$bin = hex2bin(str_repeat('0', 8 - strlen($code)) . $code);
	$emoticon =  mb_convert_encoding($bin, 'UTF-8', 'UTF-32BE');
	return $emoticon;
}

function getFormatTextMessage($text)
{
	$datas = [];
	$datas['type'] = 'text';
	$datas['text'] = $text;
	return $datas;
}

function sentMessage($encodeJson, $datas)
{
	$datasReturn = [];
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => $datas['url'],
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $encodeJson,
		CURLOPT_HTTPHEADER => array(
			"authorization: Bearer " . $datas['token'],
			"cache-control: no-cache",
			"content-type: application/json; charset=UTF-8",
		),
	));

	$response = curl_exec($curl);
	// dd($response);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		$datasReturn['result'] = 'E';
		$datasReturn['message'] = $err;
	} else {
		if ($response == "{}") {
			$datasReturn['result'] = 'S';
			$datasReturn['message'] = 'Success';
		} else {
			$datasReturn['result'] = 'E';
			$datasReturn['message'] = $response;
		}
	}

	return $datasReturn;
}

function getLINEProfile($datas)
{
	$datasReturn = [];

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => $datas['url'],
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"Authorization: Bearer " . $datas['token'],
			"Postman-Token: 32d99c7d-9f6e-4413-a4d2-fa0a9f1ecf6d",
			"cache-control: no-cache"
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		$datasReturn['result'] = 'E';
		$datasReturn['message'] = $err;
	} else {
		if ($response == "{}") {
			$datasReturn['result'] = 'S';
			$datasReturn['message'] = 'Success';
		} else {
			$datasReturn['result'] = 'E';
			$datasReturn['message'] = $response;
		}
	}

	return $datasReturn;
}

function linkRichmenu($encodeJson, $datas)
{
	$datasReturn = [];
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => $datas['url'],
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $encodeJson,
		CURLOPT_HTTPHEADER => array(
			"authorization: Bearer " . $datas['token'],
			"cache-control: no-cache",
			"content-type: application/json; charset=UTF-8",
		),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
		$datasReturn['result'] = 'E';
		$datasReturn['message'] = $err;
	} else {
		$datasReturn['result'] = 'S';
		$datasReturn['message'] = 'Success';
		$datasReturn['response'] = $response;
	}
	return $datasReturn;
}
function getNumberFollower($datas, $date_now)
{
	$datasReturn = [];
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api.line.me/v2/bot/insight/followers?date=' . $date_now,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"authorization: Bearer " . $datas['token']
		),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
		$datasReturn['result'] = 'E';
		$datasReturn['message'] = $err;
	} else {
		$datasReturn['result'] = 'S';
		$datasReturn['message'] = 'Success';
		$datasReturn['response'] = $response;
	}
	return $datasReturn;
}
function getContent($datas)
{
	$datasReturn = [];
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.line.me/v2/bot/message/" . $datas['messageId'] . "/content",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_HTTPHEADER => array(
			"Authorization: Bearer " . $datas['token'],
			"cache-control: no-cache"
		),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
		$datasReturn['result'] = 'E';
		$datasReturn['message'] = $err;
	} else {
		$datasReturn['result'] = 'S';
		$datasReturn['message'] = 'Success';
		$datasReturn['response'] = $response;
	}
	return $datasReturn;
}


function getLiveCardEvents($FTblName, $mysqli, $userId)
{
	$int = [];
	$s_int = "SELECT * FROM `" . $FTblName . "_user_interest` where userid = '" . $userId . "' and status = '1' ";
	$s_res = $mysqli->query($s_int);
	while ($s_rr = $s_res->fetch_assoc()) {
		array_push($int, $s_rr['interest']);
	}

	$find_vdo = true;
	$vdo_id = 0;
	$coni = 0;
	$datas = [];
	$datas['type'] = 'flex';
	//$datas['altText'] = $rr['content_text_1']; //'Boardcast List.';
	$datas['altText'] = 'Live Events !'; //'Boardcast List.';
	$datas['contents']['type'] = 'carousel';

	$dd = "select * from `" . $FTblName . "_livecastcard` where content_status = '1' order by content_id desc limit 0,10 ";
	$res = $mysqli->query($dd);
	while ($rr = $res->fetch_assoc()) {
		if (strpos($rr['content_button_1_url'], "vdo.php?id=") !== false) {
			$vdo_ids = explode("vdo.php?id=", $rr['content_button_1_url']);
			$vdo_id = $vdo_ids[1];
			$q_vdo = $mysqli->query("SELECT * FROM `" . $FTblName . "_video` a inner join `" . $FTblName . "_product` b on a.product_id = b.product_id where content_id = '" . $vdo_id . "' ");
			$q_rr = $q_vdo->fetch_assoc();
			if (in_array($q_rr['product_interest'], $int)) {
				$find_vdo = true;
			} else {
				$find_vdo = false;
			}
		}

		if ($find_vdo) {
			$datas['contents']['contents'][$coni]['type'] = 'bubble';
			if ($rr['content_header'] != "") {
				$datas['contents']['contents'][$coni]['header']['type'] = 'box';
				$datas['contents']['contents'][$coni]['header']['layout'] = 'horizontal';
				$datas['contents']['contents'][$coni]['header']['contents'][0]['type'] = 'text';
				$datas['contents']['contents'][$coni]['header']['contents'][0]['text'] = $rr['content_header'];
				$datas['contents']['contents'][$coni]['header']['contents'][0]['size'] = 'xxs';
				$datas['contents']['contents'][$coni]['header']['contents'][0]['weight'] = 'regular';
				$datas['contents']['contents'][$coni]['header']['contents'][0]['color'] = '#AAAAAA';
			}
			if ($rr['content_image'] != "") {
				$datas['contents']['contents'][$coni]['hero']['type'] = 'image';
				$datas['contents']['contents'][$coni]['hero']['url'] = $rr['content_image'];
				$datas['contents']['contents'][$coni]['hero']['size'] = 'full';
				$datas['contents']['contents'][$coni]['hero']['aspectRatio'] = '20:13';
				$datas['contents']['contents'][$coni]['hero']['aspectMode'] = 'cover';
			}

			$datas['contents']['contents'][$coni]['body']['type'] = 'box';
			$datas['contents']['contents'][$coni]['body']['layout'] = 'vertical';
			$datas['contents']['contents'][$coni]['body']['contents'][0]['type'] = 'text';
			$datas['contents']['contents'][$coni]['body']['contents'][0]['text'] = $rr['content_text_1'];
			$datas['contents']['contents'][$coni]['body']['contents'][0]['weight'] = 'bold';
			$datas['contents']['contents'][$coni]['body']['contents'][0]['wrap'] = true;
			$ci = 1;
			if ($rr['content_text_2'] != "") {
				$datas['contents']['contents'][$coni]['body']['contents'][$ci]['type'] = 'text';
				$datas['contents']['contents'][$coni]['body']['contents'][$ci]['text'] = $rr['content_text_2'];
				$datas['contents']['contents'][$coni]['body']['contents'][$ci]['wrap'] = true;
				$ci += 1;
			}
			if ($rr['content_text_3'] != "") {
				$datas['contents']['contents'][$coni]['body']['contents'][$ci]['type'] = 'text';
				$datas['contents']['contents'][$coni]['body']['contents'][$ci]['text'] = $rr['content_text_3'];
				$datas['contents']['contents'][$coni]['body']['contents'][$ci]['size'] = 'xs';
				$datas['contents']['contents'][$coni]['body']['contents'][$ci]['wrap'] = true;
			}

			$datas['contents']['contents'][$coni]['footer']['type'] = 'box';
			$datas['contents']['contents'][$coni]['footer']['layout'] = 'vertical';
			$datas['contents']['contents'][$coni]['footer']['contents'][0]['type'] = 'button';
			if (strpos($rr['content_button_1_url'], 'http') !== false) {
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['action']['type'] = 'uri';
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['action']['label'] = $rr['content_button_1'];
				$url = $rr['content_button_1_url'];
				if (strpos($url, '.php?') !== false) {
					$url = $url . "&userid=" . $userId;
				} else {
					$url = $url . "?userid=" . $userId;
				}
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['action']['uri'] = "https://www.oncologyconnext.com/redirect.php?mode=livecast&refid=" . $rr["content_id"] . "&button=1";
			} else {
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['action']['type'] = 'message';
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['action']['label'] = $rr['content_button_1'];
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['action']['text'] = $rr['content_button_1_url'];
			}
			if ($rr['content_button_1_color'] != "") {
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['color'] = $rr['content_button_1_color'];
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['style'] = 'primary';
			}

			$bi = 1;
			if ($rr['content_button_2'] != "") {
				$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['type'] = 'button';
				if (strpos($rr['content_button_2_url'], 'http') !== false) {
					$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['type'] = 'uri';
					$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['label'] = $rr['content_button_2'];
					$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['uri'] =  "https://www.oncologyconnext.com/redirect.php?mode=livecast&refid=" . $rr["content_id"] . "&button=2";
				} else {
					$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['type'] = 'message';
					$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['label'] = $rr['content_button_2'];
					$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['text'] = $rr['content_button_2_url'];
				}
				if ($rr['content_button_2_color'] != "") {
					$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['color'] = $rr['content_button_2_color'];
					$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['style'] = 'primary';
				}
				$bi += 1;
			}
			if ($rr['content_button_3'] != "") {
				$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['type'] = 'button';
				if (strpos($rr['content_button_3_url'], 'http') !== false) {
					$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['type'] = 'uri';
					$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['label'] = $rr['content_button_3'];
					$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['uri'] =  "https://www.oncologyconnext.com/redirect.php?mode=livecast&refid=" . $rr["content_id"] . "&button=3";
				} else {
					$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['type'] = 'message';
					$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['label'] = $rr['content_button_3'];
					$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['action']['text'] = $rr['content_button_3_url'];
				}
				if ($rr['content_button_3_color'] != "") {
					$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['color'] = $rr['content_button_3_color'];
					$datas['contents']['contents'][$coni]['footer']['contents'][$bi]['style'] = 'primary';
				}
			}
			$coni = $coni + 1;
		}
	}
	return $datas;
}



function getFirstQuestion($FTblName, $mysqli, $q)
{
	$coni = 0;
	$msg = [];
	$datas = [];
	$type = "";
	$ref_id = 0;
	if ($q == "") {
		$dd = "select * from `" . $FTblName . "_chatbot` where content_status = '1' and ref_content_id = '0' order by content_id asc limit 0,1 ";
		$res = $mysqli->query($dd);
		if ($rr = $res->fetch_assoc()) {
			$type = $rr['content_type'];
			$ref_id = $rr['ref_content_id'];
		}
	} else {
		$dd = "select * from `" . $FTblName . "_chatbot` where content_status = '1' and content_header = '" . $q . "' order by content_id asc limit 0,1 ";
		$res = $mysqli->query($dd);
		if ($rr = $res->fetch_assoc()) {
			$type = $rr['content_type'];
			$ref_id = $rr['content_id'];
		}
	}

	if ($type == "text") {
		$datas['type'] = 'text';
	} else if ($type == "image") {
		$datas['type'] = 'image';
	} else if ($type == "video") {
		$datas['type'] = 'video';
	} else {
		$datas['type'] = 'flex';
		//$datas['altText'] = $rr['content_text_1']; //'Boardcast List.';
		$datas['altText'] = 'Bot Chat !'; //'Boardcast List.';
		$datas['contents']['type'] = 'carousel';
	}

	$dd = "select * from `" . $FTblName . "_chatbot` where content_status = '1' and ref_content_id = '" . $ref_id . "' order by content_id asc limit 0,10 ";
	$res = $mysqli->query($dd);
	while ($rr = $res->fetch_assoc()) {

		if ($rr['content_type'] == "text") {
			$datas = [];
			$datas['type'] = 'text';
			$datas['text'] = $rr['content_title'];
		} else if ($rr['content_type'] == "image") {
			$datas = [];
			$datas['type'] = 'image';
			$datas['originalContentUrl'] = $rr['content_image'];
			$datas['previewImageUrl'] = $rr['content_image'];
		} else if ($rr['content_type'] == "video") {
			$datas = [];
			$datas['type'] = 'video';
			$datas['originalContentUrl'] = $rr['content_video'];
			$datas['previewImageUrl'] = $rr['content_image'];
		} else {
			$datas['contents']['contents'][$coni]['type'] = 'bubble';
			if ($rr['content_image']) {
				$datas['contents']['contents'][$coni]['hero']['type'] = 'image';
				$datas['contents']['contents'][$coni]['hero']['url'] = $rr['content_image'];
				$datas['contents']['contents'][$coni]['hero']['size'] = 'full';
				$datas['contents']['contents'][$coni]['hero']['aspectRatio'] = '2:1';
				$datas['contents']['contents'][$coni]['hero']['aspectMode'] = 'cover';
			}
			// $datas['contents']['contents'][$coni]['body']['type'] = 'box';
			// $datas['contents']['contents'][$coni]['body']['layout'] = 'vertical'; 
			// $datas['contents']['contents'][$coni]['body']['contents'][0]['type'] = 'text';
			// $datas['contents']['contents'][$coni]['body']['contents'][0]['text'] = $rr['content_title'];
			// $datas['contents']['contents'][$coni]['body']['contents'][0]['weight'] = 'bold';
			// $datas['contents']['contents'][$coni]['body']['contents'][0]['wrap'] = true;
			$ci = 1;
			if ($rr['content_text_1'] != "") {
				$datas['contents']['contents'][$coni]['body']['contents'][$ci]['type'] = 'text';
				$datas['contents']['contents'][$coni]['body']['contents'][$ci]['text'] = $rr['content_text_1'];
				$datas['contents']['contents'][$coni]['body']['contents'][$ci]['wrap'] = true;
				$ci += 1;
			}
			if ($rr['content_button_1'] != "") {
				$datas['contents']['contents'][$coni]['footer']['type'] = 'box';
				$datas['contents']['contents'][$coni]['footer']['layout'] = 'vertical';
				//$datas['contents']['contents'][$coni]['footer']['contents'][0]['type'] = 'separator';
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['type'] = 'button';
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['action']['type'] = 'message';
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['action']['label'] = $rr['content_button_1'];
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['action']['text'] = $rr['content_button_1_url'];
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['height'] = 'sm';
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['style'] = 'link';
			}

			$coni = $coni + 1;
		}
	}
	return $datas;
}


function getQuestion($FTblName, $mysqli, $q)
{
	$coni = 0;
	$message = [];
	$datas = [];
	$type = "";
	$ref_id = 0;
	if ($q == "") {
		$dd = "select * from `" . $FTblName . "_chatbot` where content_status = '1' and ref_content_id = '0' order by content_id asc limit 0,1 ";
		$res = $mysqli->query($dd);
		if ($rr = $res->fetch_assoc()) {
			$type = $rr['content_type'];
			$ref_id = $rr['ref_content_id'];
		}
	} else {
		$dd = "select * from `" . $FTblName . "_chatbot` where content_status = '1' and content_header = '" . $q . "' order by content_id asc limit 0,1 ";
		$res = $mysqli->query($dd);
		if ($rr = $res->fetch_assoc()) {
			$type = $rr['content_type'];
			$ref_id = $rr['content_id'];
		}
	}

	$datas['type'] = 'flex';
	$datas['altText'] = 'Bot Chat !'; //'Boardcast List.';
	$datas['contents']['type'] = 'carousel';

	$dd = "select * from `" . $FTblName . "_chatbot` where content_status = '1' and ref_content_id = '" . $ref_id . "' order by content_id asc limit 0,10 ";
	$res = $mysqli->query($dd);
	$text_1 = "";
	while ($rr = $res->fetch_assoc()) {

		if ($rr['content_type'] == "text") {
			$datas = [];
			$datas['type'] = 'text';
			$datas['text'] = $rr['content_title'];
		} else if ($rr['content_type'] == "image") {
			if ($rr['content_title'] != "") {
				$datas = [];
				$datas['type'] = 'text';
				$datas['text'] = $rr['content_title'];
				array_push($message, $datas);
			}
			$datas = [];
			$datas['type'] = 'image';
			$datas['originalContentUrl'] = $rr['content_image'];
			$datas['previewImageUrl'] = $rr['content_image'];
		} else if ($rr['content_type'] == "video") {
			if ($rr['content_title'] != "") {
				$datas = [];
				$datas['type'] = 'text';
				$datas['text'] = $rr['content_title'];
				array_push($message, $datas);
			}
			$datas = [];
			$datas['type'] = 'video';
			$datas['originalContentUrl'] = $rr['content_video'];
			$datas['previewImageUrl'] = $rr['content_image'];
		} else {
			if ($text_1 == "" && $rr['content_title'] != "") {
				$text_1 = $rr['content_title'];
				$datas1 = [];
				$datas1['type'] = 'text';
				$datas1['text'] = $text_1;
				array_push($message, $datas1);
			}

			$datas['contents']['contents'][$coni]['type'] = 'bubble';
			if ($rr['content_image']) {
				$datas['contents']['contents'][$coni]['hero']['type'] = 'image';
				$datas['contents']['contents'][$coni]['hero']['url'] = $rr['content_image'];
				$datas['contents']['contents'][$coni]['hero']['size'] = 'full';
				$datas['contents']['contents'][$coni]['hero']['aspectRatio'] = '2:1';
				$datas['contents']['contents'][$coni]['hero']['aspectMode'] = 'cover';
			}
			// $datas['contents']['contents'][$coni]['body']['type'] = 'box';
			// $datas['contents']['contents'][$coni]['body']['layout'] = 'vertical'; 
			// $datas['contents']['contents'][$coni]['body']['contents'][0]['type'] = 'text';
			// $datas['contents']['contents'][$coni]['body']['contents'][0]['text'] = $rr['content_title'];
			// $datas['contents']['contents'][$coni]['body']['contents'][0]['weight'] = 'bold';
			// $datas['contents']['contents'][$coni]['body']['contents'][0]['wrap'] = true;
			$ci = 1;
			if ($rr['content_text_1'] != "") {
				$datas['contents']['contents'][$coni]['body']['contents'][$ci]['type'] = 'text';
				$datas['contents']['contents'][$coni]['body']['contents'][$ci]['text'] = $rr['content_text_1'];
				$datas['contents']['contents'][$coni]['body']['contents'][$ci]['wrap'] = true;
				$ci += 1;
			}
			if ($rr['content_button_1'] != "") {
				$datas['contents']['contents'][$coni]['footer']['type'] = 'box';
				$datas['contents']['contents'][$coni]['footer']['layout'] = 'vertical';

				//$datas['contents']['contents'][$coni]['footer']['contents'][0]['type'] = 'separator';
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['type'] = 'button';
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['action']['type'] = 'message';
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['action']['label'] = $rr['content_button_1'];
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['action']['text'] = $rr['content_button_1_url'];
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['height'] = 'sm';
				$datas['contents']['contents'][$coni]['footer']['contents'][0]['style'] = 'link';
			}

			$coni = $coni + 1;
		}
	}
	array_push($message, $datas);

	return $message;
}

function getLINEQuota($datas)
{
	$datasReturn = [];

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api.line.me/v2/bot/message/quota/consumption',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"Authorization: Bearer " . $datas['token'],
			"Postman-Token: 32d99c7d-9f6e-4413-a4d2-fa0a9f1ecf6d",
			"cache-control: no-cache"
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		$datasReturn['result'] = 'E';
		$datasReturn['message'] = $err;
	} else {
		if ($response == "{}") {
			$datasReturn['result'] = 'S';
			$datasReturn['message'] = 'Success';
		} else {
			$datasReturn['result'] = 'E';
			$datasReturn['message'] = $response;
		}
	}

	return $datasReturn;
}
