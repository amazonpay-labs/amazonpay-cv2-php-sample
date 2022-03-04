<?php
    require_once '../vendor/autoload.php';
    //require_once '../AmazonPayV2/amazon-pay-v2.phar';
    require_once 'ap_sample_config.php';

    $charge_id = $_POST['charge_id'];
    $capture_amount = $_POST['capture_amount'];
    $capture_amount_currency_code = $_POST['capture_amount_currency_code'];
    $soft_descriptor = $_POST['soft_descriptor'];
    $idempotency_key = $_POST['idempotency_key'];

    $payload = array(
        'captureAmount' => array( 
            'amount' => $capture_amount,
            'currencyCode' => $capture_amount_currency_code
        )
    );

    if (null != $soft_descriptor) {
        $payload = array_merge($payload, array("softDescriptor" => $soft_descriptor));
    }

    try {
        $headers = array('x-amz-pay-Idempotency-Key' => $idempotency_key);
        $client = new Amazon\Pay\API\Client($amazonpay_config);
        $result = $client->captureCharge($charge_id, $payload, $headers);
        $response = '{"status":' . $result['status'] . ',"response":' . $result['response'] . '}';
        echo($response);

    } catch (\Exception $e) {
        // handle the exception
        echo $e . "\n";
    }