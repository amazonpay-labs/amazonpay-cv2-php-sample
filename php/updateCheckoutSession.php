<?php
    require_once '../vendor/autoload.php';
    //require_once '../AmazonPayV2/amazon-pay-v2.phar';
    require_once 'ap_sample_config.php';

    $checkout_session_id = $_POST['checkout_session_id'];

    $payload = array(
        'webCheckoutDetails' => array(
            'checkoutResultReturnUrl' => 'https://XXXXXXX/php/result_return.php'
        ),
        'paymentDetails' => array(
            'paymentIntent' => 'Authorize',
            'canHandlePendingAuthorization' => false,
            'chargeAmount' => array(
                'amount' => '123',
                'currencyCode' => "JPY"
            ),
          //"softDescriptor" => "softDescriptor"
        ),
        'merchantMetadata' => array(
            'merchantReferenceId' => '2020-00000001',
            'merchantStoreName' => 'Store Name PHP',
            'noteToBuyer' => 'Thank you for your order!'
            // "customInformation" => "customInformation"
        )
        // "platformId" => "platformID"
    );

    try {
        $client = new Amazon\Pay\API\Client($amazonpay_config);
        $result = $client->updateCheckoutSession($checkout_session_id, $payload);
        $response = '{"status":' . $result['status'] . ',"response":' . $result['response'] . '}';
        echo($response);

    } catch (\Exception $e) {
        // handle the exception
        echo $e . "\n";
    }