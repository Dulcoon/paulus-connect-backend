<?php

// Firebase Cloud Messaging Authorization Key
define('FCM_AUTH_KEY', '308291f0b7944d6471c8de7390d6152aa60c6a38e09f005874f0bd1cec8f196cd2d998b1698e714f');

function sendPush($to, $title, $body, $icon, $url) {
    $postdata = json_encode([
        'notification' => [
            'title' => $title,
            'body' => $body,
            'icon' => $icon,
            'click_action' => $url
        ],
        'to' => $to
    ]);

    $opts = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/json' . "\r\n" .
                        'Authorization: key=' . FCM_AUTH_KEY . "\r\n",
            'content' => $postdata
        ]
    ];

    $context = stream_context_create($opts);

    $result = @file_get_contents('https://fcm.googleapis.com/fcm/send', false, $context); // @supress warnings

    if ($result === FALSE) {
        $error = error_get_last();
        echo "Error sending push notification: " . $error['message'];
        return false;
    } else {
        return json_decode($result, true); // Decode to associative array
    }
}

$keyclient = "dlVAH0LUS_m_sml8D-WiFm:APA91bFIEGi8KgP50BZdiVh-_Spn4hUSmsooP6-F0JMjL5VugE-tzTQ8M8soCcTZkElIjqwBBfIcr9idf0XGb0PPLqIaX-D8AkHVfBodnhqNN9nxgLct5ew";
$title = "Cobalah saja ini";
$body = "Ini adalah body notifikasi yang lebih panjang dan informatif.";
$icon = "https://www.gstatic.com/mobilesdk/240501_mobilesdk/firebase_28dp.png";
$url = ""; // URL yang ingin dibuka saat notifikasi diklik
$response = sendPush($keyclient, $title, $body, $icon, $url);

if ($response) {
    print_r($response); // Print the response to debug
}

?>