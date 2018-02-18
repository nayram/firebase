<?php

error_reporting(-1);
ini_set('display_errors', 'On');

require_once __DIR__ . '/firebase.php';
require_once __DIR__ . '/push.php';


$firebase = new Firebase();
$push = new Push();


$title=($_GET['title']);
$message=($_GET['message']);
$regIds=($_GET['reg_id']);
$payload = array();
$regTokens = explode(',', $regIds);
if (sizeof($regTokens)==1) {
  # code...
  $regTokens=$regIds;
}
if (isset($_GET['meetup_id'])) {
  # code...
    $payload['meetup_id']=$_GET['meetup_id'];
}

if (isset($_GET['type'])) {
  # code...
  $payload['type']=($_GET['type']);
}

$push->setTitle($title);
$push->setMessage($message);
$push->setPayload($payload);

$json = '';
$response = '';

$json = $push->getPush();
 $response = $firebase->sendMultiple($regTokens, $json);
echo json_encode($response);
 ?>
