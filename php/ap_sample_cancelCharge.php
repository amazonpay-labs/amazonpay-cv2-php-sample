<?php
    require_once '../vendor/autoload.php';
    //require_once '../AmazonPayV2/amazon-pay-v2.phar';
    require_once 'ap_sample_config.php';

    $charge_id = $_POST['charge_id'];
    $cancellation_reason = $_POST['cancellation_reason'];

    $payload = array(
        'cancellationReason' => $cancellation_reason
    );

    try {
        $client = new Amazon\Pay\API\Client($amazonpay_config);
        $result = $client->cancelCharge($charge_id, $payload);
        $response = '{"status":' . $result['status'] . ',"response":' . $result['response'] . '}';
        echo($response);

    } catch (\Exception $e) {
        // handle the exception
        echo $e . "\n";
    }
