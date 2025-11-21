<?php 
define('BOT_TOKEN', 'xxx'); //Replace with your bot token
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');
// Program O Params
$bot_id = '1';					//Program O bot ID
$siteurl = 'http://xxx/'; 	// Site url including https where program o installed
$convo_id = ''; 				//Any string to save conversation log
	
// read incoming info and grab the chatID
$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chatID = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];
	$msg = trim($message);
    $result = file_get_contents("" .$siteurl. "/chatbot/conversation_start.php?bot_id=" . $bot_id . "&say=" . urlencode($msg) . "&convo_id=" . $convo_id . "&format=json");
    $jsonop= json_decode($result);
    if($result != '') {    
    	// compose reply
	$reply =  $jsonop->botsay;
		
	// send reply
	$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".$reply;
	file_get_contents($sendto);
    }
?>    