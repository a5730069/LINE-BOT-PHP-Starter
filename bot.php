<?php
 require("pub.php");
$access_token = 'qLip9omRdSnsaKFlsWmCCx9pdvAcRd1CGb6XfH/K3aKVgmHS4Eh/a35I8S1q8XVCZQVJUVIPa2B/c1ZJHfEyA8vUgqlUeIfqTkw607IKQ7yCasUHW34wj+CGzB6bOafYNDSGkh87GIr+Tns7fqFqVAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON

$events = json_decode($content, true);
// Validate parsed JSON data
function send_data_LINE(){
	$messages = [
				'type' => 'text',
				'text' => $events['sensorType']
				//'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/push';
			$data = [

				'to' => 'Ue77a191627f6ac91899e75d92264310c',
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
}
 if( !is_null($_GET['name'])){
 
			$messages = [
				'type' => 'text',
				'text' => $_GET['name']
				//'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/push';
			$data = [

				'to' => 'Ue77a191627f6ac91899e75d92264310c',
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		//}
	//}
//}
echo "OK";
}


if (!is_null($events['sensorType'])) {
	echo "json pass";
	send_data_LINE();
		/*$messages = [
				'type' => 'text',
				'text' => $events['sensorType']
				//'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/push';
			$data = [

				'to' => 'Ue77a191627f6ac91899e75d92264310c',
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		//}
	//}
//} */
echo "OK";
	}
if (!is_null($events['events'])) {
	echo "line bot";
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back

			 $pos = strpos($text, ":");
			    if($pos){
			      $splitMsg = explode(":", $text);
			      $topic = $splitMsg[0];
			      $msg = $splitMsg[1];
			      getMqttfromlineMsg($msg);
			    }else{
				getMqttfromlineMsg($text);
			    }
			

		}
	}
}
echo "OK";
