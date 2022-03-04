<?php
    require_once '../vendor/autoload.php';
    //require_once '../AmazonPayV2/amazon-pay-v2.phar';
    require_once 'ap_sample_config.php';

    $buyer_token = $_POST['buyer_token'];

    try {
        $client = new Amazon\Pay\API\Client($amazonpay_config);
        $result = $client->getBuyer($buyer_token);
        $response = '{"status":' . $result['status'] . ',"response":' . $result['response'] . '}';
        echo($response);

    } catch (\Exception $e) {
        // handle the exception
        echo $e . "\n";
    }
