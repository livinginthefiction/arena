<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'vendor/autoload.php'; // Include the Twilio PHP library

use Twilio\Rest\Client;

$accountSid = 'AC9878dd41e790434ac30ea586ce3d87a0';
$authToken = '29d72eeab3576a1563a149e1246009fa';

$client = new Client($accountSid, $authToken);

echo $roomSid = $_GET['roomSid']; // Get the room SID from the frontend

$client->video->v1->rooms($roomSid)->update('completed');

?>
