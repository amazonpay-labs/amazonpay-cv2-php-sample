<?php
    require_once '../vendor/autoload.php';
    //require_once '../AmazonPayV2/amazon-pay-v2.phar';
    require_once 'ap_sample_config.php';

    $checkout_session_id = $_POST['checkout_session_id'];
    $checkout_review_return_url = $_POST['checkout_review_return_url'];
    $checkout_result_return_url = $_POST['checkout_result_return_url'];
    $payment_intent = $_POST['payment_intent'];
    $can_handle_pending_authorization = $_POST['can_handle_pending_authorization'];
    $charge_amount_amount = $_POST['charge_amount_amount'];
    $charge_amount_currency_code = $_POST['charge_amount_currency_code'];
    $soft_descriptor = $_POST['soft_descriptor'];
    $total_order_amount_amount = $_POST['total_order_amount_amount'];
    $total_order_amount_currency_code = $_POST['total_order_amount_currency_code'];
    $merchant_metadata_merchantReferenceId = $_POST['merchant_metadata_merchantReferenceId'];
    $merchant_metadata_merchantStoreName = $_POST['merchant_metadata_merchantStoreName'];
    $merchant_metadata_noteToBuyer = $_POST['merchant_metadata_noteToBuyer'];
    $merchant_metadata_customInformation = $_POST['merchant_metadata_customInformation'];
    $provider_metadata_providerReferenceId = $_POST['provider_metadata_providerReferenceId'];

    
    $platform_id = $_POST['platform_id'];

    $payload = array(
        'webCheckoutDetails' => array(
            'checkoutReviewReturnUrl' => $checkout_review_return_url,
            'checkoutResultReturnUrl' => $checkout_result_return_url
        ),
        'paymentDetails' => array(
            'paymentIntent' => $payment_intent,
            'canHandlePendingAuthorization' => $can_handle_pending_authorization,
            'chargeAmount' => array(
                'amount' => $charge_amount_amount,
                'currencyCode' => $charge_amount_currency_code
            ),
        'softDescriptor' => $soft_descriptor
        ),
        'merchantMetadata' => array(
            'merchantReferenceId' => $merchant_metadata_merchantReferenceId,
            'merchantStoreName' => $merchant_metadata_merchantStoreName,
            'noteToBuyer' => $merchant_metadata_noteToBuyer,
            'customInformation' => $merchant_metadata_customInformation 
        ),
        'providerMetadata' => array(
            'providerReferenceId' => $provider_metadata_providerReferenceId 
        )
    );
    //MultiAuthで、PaymentIntent:Authorizeを利用する場合にtotalOrderAmountも利用します。
    if (null != $total_order_amount_amount) {
        $payload = array_merge($payload, array(
            "paymentDetails" => array(
                'paymentIntent' => $payment_intent,
                'canHandlePendingAuthorization' => $can_handle_pending_authorization,
                'chargeAmount' => array(
                    'amount' => $charge_amount_amount,
                    'currencyCode' => $charge_amount_currency_code
                ),
                "totalOrderAmount" => array(
                    'amount' => $total_order_amount_amount,
                    'currencyCode' => $total_order_amount_currency_code
                ),
                "softDescriptor" => $soft_descriptor
            )
        )
        );
    }
    if (null != $platform_id) {
        $payload = array_merge($payload, array("platformId" => $platform_id));
    }

    try {
        $client = new Amazon\Pay\API\Client($amazonpay_config);
        $result = $client->updateCheckoutSession($checkout_session_id, $payload);
        $response = '{"status":' . $result['status'] . ',"response":' . $result['response'] . '}';
        echo($response);

    } catch (\Exception $e) {
        // handle the exception
        echo $e . "\n";
    }