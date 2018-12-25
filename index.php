<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require('buffer.php');

$client_id = "5c22ab2e75bcc1143b0be0c3";
$client_secret = "84bc52b1000c75b8169b5357af4f31df";
$callBackUrl = "https://moerat.nl/";
$buffer = new BufferApp($client_id, $client_secret, $callBackUrl);

if (!$buffer->ok) {
    echo '<a href="' . $buffer->get_login_url() . '">Connect to Buffer!</a>';
} else {
    //this pulls all of the logged in user's profiles
    $profiles = $buffer->go('/profiles');
    var_dump($profiles);
    echo gettype($profiles);
    
    if (is_array($profiles)) {
        foreach ($profiles as $profile) {
            //this creates a status on each one
            //$buffer->go('/updates/create', array('text' => 'My first status update from bufferapp-php worked!', 'profile_ids[]' => $profile->id));
            $buffer->go('/updates/create', array(
                'text' => 'My article title',
                'profile_ids[]' => $profile));
        }
    }
}

function getTime(){
    $date = new DateTime();
    return $date->getTimestamp();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <div>
        
    </div>
</body>
</html>