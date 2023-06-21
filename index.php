<?php
require __DIR__ . '/vendor/autoload.php';

require 'validateEmail.php';

return function ($event) {
    // Receive post body data from the request object
    $postData = json_decode($event['body'], true);
    // Default values for negative status
    $response = [
        'status' => false,
    ];
    $statusCode = 500;
    // Getting the email value from the post data
    // Calling validateEmail method to validate mx email
    if ($postData && isset($postData['email']) && validateEmail($postData['email'])) {
        $response['status'] = true;
        $statusCode = 200;
    }

    return [
        'statusCode' => $statusCode,
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode($response),
    ];
};
?>