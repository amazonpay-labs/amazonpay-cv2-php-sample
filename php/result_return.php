<?php
    require_once '../vendor/autoload.php';
    //require_once '../AmazonPayV2/amazon-pay-v2.phar';
    require_once 'ap_sample_config.php';

    $checkout_session_id = $_GET['amazonCheckoutSessionId'];
    $payload = array(
        'chargeAmount' => array(
            'amount' => '123',
            'currencyCode' => "JPY"
            )
    );
    try {
        $client = new Amazon\Pay\API\Client($amazonpay_config);
        $result = $client->completeCheckoutSession($checkout_session_id, $payload);
        $json_result = json_decode($result['response']);
        $state = $json_result->statusDetails->state;

        if ('Completed' == $state) {
            header('location: ../order_confirmation.html?chargeId=' . $json_result->chargeId);
            exit();
        } else {
            header('location: ../order_error.html');
            exit();
        }

    } catch (\Exception $e) {
        // handle the exception
        echo $e . "\n";
    }

