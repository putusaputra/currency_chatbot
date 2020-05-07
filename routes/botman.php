<?php
use App\Http\Controllers\BotManController;

use App\Classes\HearingAttachment;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');

//test putra

//single reply
$botman->hears('call me {name}', function($bot, $name){
	$bot->reply('Your name is: ' . $name);
});

//fallback when no command specified
$botman->fallback(function($bot){
	$bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: call me myname');
});

//receive image only
$botman->receivesImages(function($bot, $images){
	foreach ($images as $image) {
		$url = $image->getUrl();
		$title = $image->getTitle();
		$payload = $image->getPayload();
	}
});

// hear command and reply with text and image
$botman->hears('image attachment', function($bot){
	// Create attachment
	$attachment = new Image('https://botman.io/img/logo.png');
	// Build message object
	$message = OutgoingMessage::create('This is my text')
				->withAttachment($attachment);

	// Reply message object
	$bot->reply($message);
});

$botman->hears('test typing indicator', function($bot){
	$bot->typesAndWaits(2);
	$bot->reply("Tell me more!");
});

// test conversation 1
$botman->hears('Hello Onboard', BotManController::class . '@helloAboard');

// test conversation 2
$botman->hears('check currency', BotManController::class . '@checkCurrency');
//end test putra
