<?php
require 'vendor/autoload.php'; // Include the Twilio PHP library
// require __DIR__ . '/vendor/autoload.php';
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use Twilio\Rest\Client;

$accountSid = 'AC9878dd41e790434ac30ea586ce3d87a0';
$authToken = '29d72eeab3576a1563a149e1246009fa';

$twilioClient = new Client($accountSid, $authToken);

$roomSid = $_GET['roomSid']; // Room SID obtained from the frontend

// Create Participant using Twilio REST API
$participant = $twilioClient->video->v1->rooms($roomSid)->participants->create([
    'identity' => 'new_user_identity' // Replace with the identity of the new participant
]);

echo json_encode(['participantSid' => $participant->sid]);

?>
