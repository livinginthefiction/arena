<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// require __DIR__ . '/vendor/autoload.php';
require 'vendor/autoload.php';

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use Twilio\Rest\Client;

$accountSid = 'AC9878dd41e790434ac30ea586ce3d87a0';
$authToken = '29d72eeab3576a1563a149e1246009fa';
$twilioApiSecret = 'O1W8LmXokqJYzO4C7YVoyBeHjQZQgXDy';
$twilioApiKey = 'SK13a87a00c6c8d34ec669ced434f13930';

$twilioClient = new Client($accountSid, $authToken);

$identity = 'shubhamn'; // Replace with actual user identity
$roomName = 'my-room'.uniqid(); // Replace with desired room name

// Generate Access Token
$ttl = 60; // Time-to-live in seconds
$token = new AccessToken($accountSid, $twilioApiKey, $twilioApiSecret, $ttl, $identity);
$videoGrant = new VideoGrant();
$videoGrant->setRoom($roomName);
$token->addGrant($videoGrant);

// Create Room using Twilio REST API
$room = $twilioClient->video->v1->rooms->create([
    'uniqueName' => $roomName
]);

// Create Participant using Twilio REST API
$participant = $twilioClient->video->v1->rooms($room->sid)->participants
                                                            ->create(['identity' => 'new_user_identity']);
                                                            ->fetch();

echo json_encode([
    'token' => $token->toJWT(),
    'roomSid' => $room->sid
    'participantSid' => $participant->sid
]);