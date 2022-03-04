<?php
    require_once '../vendor/autoload.php';
    //require_once '../AmazonPayV2/amazon-pay-v2.phar';
    require_once 'ap_sample_config.php';

    $payload = array(
        'webCheckoutDetail' => array(
            'checkoutReviewReturnUrl' => 'https://d1dzeyz9clfk1h.cloudfront.net/Shima/MAXO_JPScratchPadV22/review_order_page.html'
            ,
            'checkoutResultReturnUrl' => 'https://d1dzeyz9clfk1h.cloudfront.net/Shima/MAXO_JPScratchPadV22/order_confirmation.html'
        ),
        'storeId' => 'amzn1.application-oa2-client.b07d30a807d240faab34760dea47a1c0'
    );
    $headers = array('x-amz-pay-Idempotency-Key' => uniqid());

    try {

        $client = new Amazon\Pay\API\Client($amazonpay_config);
        $result = $client->createCheckoutSession($payload, $headers);
        $response = $result['response'];

        echo($response);

    } catch (\Exception $e) {
        // handle the exception
        echo $e . "\n";
    }
