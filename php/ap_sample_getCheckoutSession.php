<?php
    require_once '../vendor/autoload.php';
    //require_once '../AmazonPayV2/amazon-pay-v2.phar';
    require_once 'ap_sample_config.php';

    $checkout_session_id = $_POST['checkout_session_id'];

    try {
        $client = new Amazon\Pay\API\Client($amazonpay_config);
        $result = $client->getCheckoutSession($checkout_session_id);
        $response = '{"status":' . $result['status'] . ',"response":' . $result['response'] . '}';
        echo($response);

    } catch (\Exception $e) {
        // handle the exception
        echo $e . "\n";
    }
