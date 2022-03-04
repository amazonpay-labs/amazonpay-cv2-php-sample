<?php
    require_once '../vendor/autoload.php';
    //require_once '../AmazonPayV2/amazon-pay-v2.phar';
    require_once 'ap_sample_config.php';

    $checkout_session_id = $_POST['checkout_session_id'];
    $charge_amount_amount = $_POST['charge_amount_amount'];
    $charge_amount_currency_code = $_POST['charge_amount_currency_code'];
    $total_order_amount_amount = $_POST['total_order_amount_amount'];
    $total_order_amount_currency_code = $_POST['total_order_amount_currency_code'];

    $payload = array(
        'chargeAmount' => array(
            'amount' => $charge_amount_amount,
            'currencyCode' => $charge_amount_currency_code
        ),
    );
    //MultiAuthで、PaymentIntent:Authorizeを利用する場合にtotalOrderAmountも利用します。
    if (null != $total_order_amount_amount) {
        $payload = array_merge($payload, array(
            "totalOrderAmount" => array(
                'amount' => $total_order_amount_amount,
                'currencyCode' => $total_order_amount_currency_code
                )
            )
        );
    }
    try {
        $client = new Amazon\Pay\API\Client($amazonpay_config);
        $result = $client->completeCheckoutSession($checkout_session_id, $payload);
        $response = '{"status":' . $result['status'] . ',"response":' . $result['response'] . '}';
        echo($response);

    } catch (\Exception $e) {
        // handle the exception
        echo $e . "\n";
    }