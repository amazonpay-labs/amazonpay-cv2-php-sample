<?php
    require_once '../vendor/autoload.php';
    //require_once '../AmazonPayV2/amazon-pay-v2.phar';
    require_once 'ap_sample_config.php';

    $checkout_review_return_url = $_POST['checkout_review_return_url'];
    $checkout_result_return_url = $_POST['checkout_result_return_url'];
    $store_id = $_POST['store_id'];
    $idempotency_key = $_POST['idempotency_key'];

    $webCheckoutDetail = array('checkoutReviewReturnUrl' => $checkout_review_return_url);

    if (null != $checkout_result_return_url) {
        $webCheckoutDetail = array_merge($webCheckoutDetail, array('checkoutResultReturnUrl' => $checkout_result_return_url));
    }

    $payload = array_merge(
        array('webCheckoutDetail' => $webCheckoutDetail),
        array('storeId' => $store_id)
    );

    try {

        $client = new Amazon\Pay\API\Client($amazonpay_config);
        $result = $client->createCheckoutSession($payload, $headers);
        $response = $result['response'];

        echo($response);

    } catch (\Exception $e) {
        // handle the exception
        echo $e . "\n";
    }